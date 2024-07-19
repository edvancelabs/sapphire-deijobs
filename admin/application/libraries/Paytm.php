<?php
require_once(APPPATH . 'libraries/paytm/PaytmHelper.php');
require_once(APPPATH . 'libraries/paytm/PaytmChecksum.php');

class paytm {
	private static $pg_config = array(
		'prod' => array(
					'mid'=>'PfQyrM62428488276569',
					'website'=>'DEFAULT',
					'secret'=>'3FzhimRG0ODE_MYR',
					'host'=>'https://securegw.paytm.in/',
					// 'cburl'=>'https://ezipay.in/webhook/py_payment/iflxZXvrXk3FBZbgWm2tEoraYkvbLla9NaQn2xAk',
					'cburl'=>'',
				),
		'test' => array(
					'mid'=>'DONWaf69148749769253',
					'website'=>'WEBSTAGING',
					'secret'=>'_COkqvNqptsHVlP7',
					'host'=>'https://securegw-stage.paytm.in/',
					'cburl'=>'http://test.ezipay.in/webhook/py_payment/iflxZXvrXk3FBZbgWm2tEoraYkvbLla9NaQn2xAk',
				)
		);

	private static $env;

	public function __construct(){
		// Check compat first
		$ci =& get_instance();
		self::$env = $ci->config->item('pg_env');
	}

	static public function create_order($data) {

		$creds = self::$pg_config[self::$env];

		$post_data = array(
			"requestType"   => "Payment",
			"mid"           => $creds['mid'],
			"websiteName"   => $creds['website'],
			"orderId"       => $data['m_ref_id'],
			"callbackUrl"   => $creds['cburl'],
			"txnAmount"     => array(
				"value"     => $data['amount'],
				"currency"  => "INR",
			),
			"userInfo"      => array(
				"custId"    => $data['customer_id'],
			),
		);
		$path = $creds['host'].'theia/api/v1/initiateTransaction?mid='.$creds['mid'].'&orderId='.$data['m_ref_id'];
		$res = self::post_data_sign($post_data,$path,$creds['secret']);

		if($res){
			
			if(@$res['body']['resultInfo']['resultStatus'] == "S"){
				return array('1','success',json_encode($res['body']));
			}else{
				return array('0',$res['body']['resultInfo']['resultMsg'],json_encode($res['body']));
			}
		}else{
			return array('0','something went wrong. try again','{"message":"something went wrong. try again"}');
		}
	}


	static public function create_payment($data,$order_data){

		$creds = self::$pg_config[self::$env];

		
		$path = $creds['host'].'theia/api/v1/processTransaction?mid='.$creds['mid'].'&orderId='.$order_data->reference_id;

		$post_data["head"] = array(
			"txnToken"	=> json_decode($order_data->pg_res_data)->txnToken
		);

		$post_data['body'] = array(
			"requestType"   => "NATIVE",
			"mid"           => $creds['mid'],
			"orderId"       => $order_data->reference_id,
        	"paymentMode"	=> "UPI_INTENT",
        	"osType"		=> "IOS",
        	"pspApp"		=> 'BHIM',
		);

		$res = self::post_data($post_data,$path);

		if($res){
			if(@$res['body']['resultInfo']['resultStatus'] == "S"){
				return array('1',str_replace('paytmmp://upi/','upi://',$res['body']['deepLinkInfo']['deepLink']),json_encode($res['body']));
			}else{
				return array('0',$res['body']['resultInfo']['resultMsg'],json_encode($res['body']));
			}
		}else{
			return array('0','something went wrong. try again','{"message":"something went wrong. try again"}');
		}

	}

	static public function payment_status($orderid,$txn_data){		
		if($txn_data->txn_status == "pending" || $txn_data->txn_status == "failed"){


			$creds = self::$pg_config[self::$env];

			$post_data = array(
				"mid"   => $creds['mid'],
				"orderId"           => $orderid
			);
			$path = $creds['host'].'v3/order/status';
			$res = self::post_data_sign($post_data,$path,$creds['secret']);



			if($res){
				$status = self::my_status_by_code($res['body']['resultInfo']['resultCode']);
				$msg = $res['body']['resultInfo']['resultMsg'];
				if($status != "ERROR"){
					return array('1', $status, json_encode($res['body']), $msg);
				}else{
					return array('0', $msg, json_encode($res['body']));
				}
			}else{
				return array('0','something went wrong. try again','{"message":"something went wrong. try again"}');
			}

		}else{
			return array('2',$txn_data->txn_status,json_decode($txn_data->pg_res_data)->resultInfo->resultMsg);
		}
		
	}

	static public function update_payment($txn_data){

		
		if($txn_data->ORDERID){
			$event_time = new DateTime($txn_data->TXNDATETIME);

		

			return  array(
						'mtxnid' => $txn_data->ORDERID,
						'txn_status' => self::my_status_by_code($txn_data->RESPCODE),
						'txn_message' => $txn_data->RESPMSG,
						'bank_refrence' => $txn_data->BANKTXNID,
						'event_time' => $event_time->format('U'),
						'db_update_data' => array('resultInfo'=>array('resultStatus'=>$txn_data->STATUS,'resultCode'=>$txn_data->RESPCODE,'resultMsg'=>$txn_data->RESPMSG),'txnId'=>$txn_data->TXNID,'bankTxnId'=>$txn_data->BANKTXNID,'orderId'=>$txn_data->ORDERID,'txnAmount'=>$txn_data->TXNAMOUNT,'txnType'=>'sale','gatewayName'=>$txn_data->GATEWAYNAME,'mid'=>$txn_data->MID,'paymentMode'=>$txn_data->PAYMENTMODE,'refundAmt'=>'0.0','txnDate'=>$txn_data->TXNDATE);
					);
		}else{
			return false;
		}
		
	}
	static public function update_refund($txn_data){		
		// if($txn_data->data->refund->cf_refund_id){
		// 	$refund_txn_data = $txn_data->data->refund;
		// 	$event_time = new DateTime($txn_data->event_time);
		// 	return  array(
		// 				'mtxnid' => $refund_txn_data->order_id,
		// 				'refund_status' => self::my_status($refund_txn_data->refund_status),
		// 				'refund_message' => $refund_txn_data->status_description,
		// 				'refund_arn' => $refund_txn_data->refund_arn,
		// 				'event_time' => $event_time->format('U'),
		// 				'db_update_data' => array($refund_txn_data)
		// 			);
		// }else{
		// 	return false;
		// }
		
	}

	static public function create_refund($post,$txn_data){		

		$creds = self::$pg_config[self::$env];

		$txn_pg_data = json_decode($txn_data->pg_res_data);

		$post_data = array(
			"mid"          => $creds['mid'],
		    "txnType"      => "REFUND",
		    "orderId"      => $txn_data->reference_id,
		    "txnId"        => $txn_pg_data->txnId,
		    "refId"        => $post['m_refund_id'],
		    "refundAmount" => $post['refund_amount']
		);
		$path = $creds['host'].'refund/apply';
		$res = self::post_data_sign($post_data,$path,$creds['secret']);

		if($res){
			
			$status = self::my_status_by_code($res['body']['resultInfo']['resultCode']);
			$msg = $res['body']['resultInfo']['resultMsg'];
			if($status != "ERROR"){
				return array('1','pending',json_encode($res['body']),$msg,'');
			}else{
				return array('0',$msg,json_encode($res['body']));
			}
		}else{
			return array('0','something went wrong. try again','{"message":"something went wrong. try again"}');
		}	
		
	}

	static public function get_refund($refundid,$rfnd_txn_data){
		$txn_pg_data = json_decode($rfnd_txn_data->pg_res_data);		
		if($rfnd_txn_data->txn_status == "pending"){

			$creds = self::$pg_config[self::$env];
			$order_id  = $txn_pg_data->orderId;

			$post_data = array(
				"mid"          => $creds['mid'],
			    "orderId"      => $order_id,
			    "refId"        => $refundid
			);
			$path = $creds['host'].'v2/refund/status';
			$res = self::post_data_sign($post_data,$path,$creds['secret']);

			if($res){			
				$status = self::my_status_by_code($res['body']['resultInfo']['resultCode']);
				$msg = $res['body']['resultInfo']['resultMsg'];
				if($status != "ERROR"){
					return array('1',$status,json_encode($res),$msg,$res['body']['refundId']);
				}else{
					return array('0',$msg,json_encode($res));
				}
			}else{
				return array('0','something went wrong. try again','{"message":"something went wrong. try again"}');
			}
		}else{
			
			return array('2',$rfnd_txn_data->txn_status,$txn_pg_data->resultInfo->resultMsg,@$txn_pg_data->resultInfo->refundId);
		}
		
	}

	static public function my_status_by_code($code){
		$status_array = array(
							'01' => 'success',
							'10' => 'success',
							'227' => 'failed',
							'235' => 'failed',
							'295' => 'failed',
							'331' => 'ERROR',
							'334' => 'ERROR',
							'335' => 'ERROR',
							'400' => 'pending',
							'401' => 'failed',
							'402' => 'pending',
							'501' => 'ERROR',
							'601' => 'pending',
							'810' => 'failed'
						);
		if(@$status_array[$code]){
			return $status_array[$code];
		}else{
			return "ERROR";
		}
		

	}

	static private function post_data($post_data,$path){
		
		$postData = json_encode($post_data, JSON_UNESCAPED_SLASHES);

		$response = PaytmHelper::executecUrl($path, $postData);
		log_message("error", "Paytm res ".$path." : ".json_encode($response));
		return $response;
	}

	static private function post_data_sign($post_data,$path,$key){
		$paytmParams = array();
		$paytmParams["body"] = $post_data;
		$checksum = PaytmChecksum::generateSignature(json_encode($paytmParams["body"], JSON_UNESCAPED_SLASHES), $key);

		$paytmParams["head"] = array(
			"signature"	=> $checksum,
			"clientId" => "C11"
		);

		$postData = json_encode($paytmParams, JSON_UNESCAPED_SLASHES);
		log_message("error", "Paytm req ".$path." : ".json_encode($postData));
		$response = PaytmHelper::executecUrl($path, $postData);
		log_message("error", "Paytm res ".$path." : ".json_encode($response));
		return $response;
	}

	
	
	
	/**
	* paytm sends response to callback
	*/
	public function callback(){

		// load language and model
		$this->load->model('extension/payment/paytm');
		$this->load->language('extension/payment/paytm');

		$data['title'] 				= sprintf($this->language->get('heading_title'), $this->config->get('config_name'));
		$data['language'] 			= $this->language->get('code');
		$data['direction'] 			= $this->language->get('direction');
		$data['heading_title'] 		= sprintf($this->language->get('heading_title'), $this->config->get('config_name'));
		
		$data['payment_status'] = (!empty($this->request->post['STATUS']))? $this->request->post['STATUS'] : 'TXN_FAILURE';

		if(!empty($this->request->post['RESPMSG'])){
			$data['text_response'] 	= sprintf($this->language->get('text_response'), $this->request->post['RESPMSG']);
		} else {
			$data['text_response'] 	= sprintf($this->language->get('text_response'), '');
		}

		if(!empty($this->request->post)){
			
			if(!empty($this->request->post['CHECKSUMHASH'])){
				$post_checksum = $this->request->post['CHECKSUMHASH'];
				unset($this->request->post['CHECKSUMHASH']);	
			}else{
				$post_checksum = "";
			}
		
			$isValidChecksum = PaytmChecksum::verifySignature($this->request->post, $this->config->get("payment_paytm_merchant_key"), $post_checksum);

			if($isValidChecksum === true){

				$order_id = !empty($this->request->post['ORDERID'])? PaytmHelper::getOrderId($this->request->post['ORDERID']) : 0;
				
				$this->load->model('checkout/order');
				$order_info = $this->model_checkout_order->getWalletOrder($order_id);

				if($order_info) {

					if(!empty($this->request->post['STATUS'])) {
					
						$reqParams = array(
											"MID" 		=> $this->config->get('payment_paytm_merchant_id'),
											"ORDERID" 	=> $this->request->post['ORDERID']
										);
						
						$reqParams['CHECKSUMHASH'] = PaytmChecksum::generateSignature($reqParams, $this->config->get("payment_paytm_merchant_key"));
						
						if($data['payment_status'] == 'TXN_SUCCESS' || $data['payment_status'] == 'PENDING'){
							/* number of retries untill cURL gets success */
							$retry = 1;
							do{
								$postData = 'JsonData='.urlencode(json_encode($reqParams));
								$resParams = PaytmHelper::executecUrl(PaytmHelper::getPaytmURL(PaytmConstants::ORDER_STATUS_URL, $this->config->get('payment_paytm_environment')), $postData);
								$retry++;
							} while(!$resParams['STATUS'] && $retry < PaytmConstants::MAX_RETRY_COUNT);
							/* number of retries untill cURL gets success */
						}

						if(!isset($resParams['STATUS'])){
							$resParams = $this->request->post;
						}
						
						$data['payment_status'] = (!empty($resParams['STATUS']))? $resParams['STATUS'] : $data['payment_status'];
			
						/* save paytm response in db */
						if(PaytmConstants::SAVE_PAYTM_RESPONSE && !empty($resParams['STATUS'])){
							$this->model_extension_payment_paytm->saveTxnResponse($resParams, PaytmHelper::getOrderId($resParams['ORDERID']));
						}
						/* save paytm response in db */

						// if curl failed to fetch response
						if(!isset($resParams['STATUS'])){
							$this->addOrderHistory($order_id, $this->config->get('payment_paytm_order_failed_status_id'));

							$this->session->data['error'] = $this->language->get('error_server_communication');
							$this->preRedirect($data);

						} else {
							if($resParams['STATUS'] == 'TXN_SUCCESS'){
                            
                            	if($order_info['order_status_id'] != 22){
                                $comment = sprintf($this->language->get('text_transaction_id'), $resParams['TXNID']) .'<br/>'. sprintf($this->language->get('text_paytm_order_id'), $resParams['ORDERID']);



                                $loadComment = "Order ID #".$order_id." wallet load of Rs".$order_info['total'];
                                $this->load->model('bms/bms');
                                $res = $this->model_bms_bms->addRefund($order_id,$order_info['customer_id'],$order_info['total'],$loadComment);     



                                $this->addOrderHistory($order_id, 22, $comment);
                                }
								$this->preRedirect($data);

							}else if($resParams['STATUS'] == 'PENDING'){
								$this->addOrderHistory($order_id, $this->config->get('payment_paytm_order_pending_status_id'));

								$this->session->data['error'] = $this->language->get('text_pending');
								if(isset($resParams['RESPMSG']) && !empty($resParams['RESPMSG'])){
									$this->session->data['error'] .= $this->language->get('text_reason').$resParams['RESPMSG'];
								}
								$this->preRedirect($data);

							}else {
								$this->addOrderHistory($order_id, $this->config->get('payment_paytm_order_failed_status_id'));

								$this->session->data['error'] = $this->language->get('text_failure');
								if(isset($resParams['RESPMSG']) && !empty($resParams['RESPMSG'])){
									$this->session->data['error'] .= $this->language->get('text_reason').$resParams['RESPMSG'];
								}
								$this->preRedirect($data);
							}
						}

					} else {
				
						$this->session->data['error'] = $this->language->get('text_failure');
						if(isset($this->request->post['RESPMSG']) && !empty($this->request->post['RESPMSG'])){
							$this->session->data['error'] .= $this->language->get('text_reason').$this->request->post['RESPMSG'];
						}
						$this->preRedirect($data);
					}

				} else {
					$this->session->data['error'] = $this->language->get('error_invalid_order');
					$this->preRedirect($data);
				}

			} else {
				$this->session->data['error'] = $this->language->get('error_checksum_mismatch');
				$this->preRedirect($data);
			}
		}else{
			$this->preRedirect($data);
		}
	}

	
	/**
	* show template while response 
	*/
	private function preRedirect($data,$ajax=false){
		
		$data['continue'] = "/add_money";

		if(!empty($data['payment_status'])){
			if($data['payment_status'] == 'TXN_SUCCESS'){
				// $data['continue'] 			= $this->url->link('account/refer/add_money&s=1');
				$data['continue'] 			= "/wallet";
				$data['text_message'] 		= $this->language->get('text_success');
				$data['text_message_wait'] 	= sprintf($this->language->get('text_success_wait'), "/wallet");
			}else if($data['payment_status'] == 'PENDING'){
				$data['text_message'] 		= $this->language->get('text_pending');
				$data['text_message_wait'] 	= sprintf($this->language->get('text_pending_wait'), "/add_money");
			}else{
				$data['text_message'] 		= $this->language->get('text_failure');
				$data['text_message_wait'] 	= sprintf($this->language->get('text_failure_wait'), "/add_money");
			}
		}
		if($ajax){
        	return $data;
        }else{
        	$this->response->setOutput($this->load->view('extension/payment/paytm_response', $data));
        }
		
	}
	
	/**
	* check cURL working or able to communicate with Paytm 
	*/
	public function curltest(){

		$debug = array();

		if(!function_exists("curl_init")){
			$debug[0]["info"][] = "cURL extension is either not available or disabled. Check phpinfo for more info.";

		// if curl is enable then see if outgoing URLs are blocked or not
		} else {

			// if any specific URL passed to test for
			if(!empty($this->request->get["url"])){
				$testing_urls = array(urldecode($this->request->get["url"]));
			} else {

				// this site homepage URL
				$server = (!empty($this->request->server['HTTPS'])? HTTPS_SERVER : HTTP_SERVER);

				$testing_urls = array(
									$server,
									"https://www.gstatic.com/generate_204",
									PaytmConstants::PRODUCTION_HOST.PaytmConstants::ORDER_STATUS_URL , PaytmConstants::STAGING_HOST.PaytmConstants::ORDER_STATUS_URL
								);
			}

			// loop over all URLs, maintain debug log for each response received
			foreach($testing_urls as $key => $url){

				$debug[$key]["info"][] = "Connecting to <b>" . $url . "</b> using cURL";

				$ch = curl_init($url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

				$res = curl_exec($ch);
				$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
				if (!curl_errno($ch)) {
					$debug[$key]["info"][] = "cURL executed succcessfully.";
					$debug[$key]["info"][] = "HTTP Response Code: <b>". $http_code . "</b>";
				} else {
					$debug[$key]["info"][] = "Connection Failed !!";
					$debug[$key]["info"][] = "Error Code: <b>" . curl_errno($ch) . "</b>";
					$debug[$key]["info"][] = "Error: <b>" . curl_error($ch) . "</b>";
				}

				if((!empty($this->request->get["url"])) || (in_array($url, array(PaytmConstants::PRODUCTION_HOST.PaytmConstants::ORDER_STATUS_URL , PaytmConstants::STAGING_HOST.PaytmConstants::ORDER_STATUS_URL)))){
					$debug[$key]["info"][] = "Response: <br/><!----- Response Below ----->" . $res;
				}

				curl_close($ch);
			}
		}

		foreach($debug as $k => $v){
			echo "<ul>";
			foreach($v["info"] as $info){
				echo "<li>". $info ."</li>";
			}
			echo "</ul>";
			echo "<hr/>";
		}
	}

	public function getTxnStatus(){        					     
                    // $paytmOrderID = "326_20220717123437";
                    $paytmOrderID = $this->request->post['ORDERID'];
    
                    $order_id = explode("_",$paytmOrderID)[0];
    
                    $reqParams = array(
											"MID" 		=> $this->config->get('payment_paytm_merchant_id'),
											"ORDERID" 	=> $paytmOrderID
										);
						
                    $reqParams['CHECKSUMHASH'] = PaytmChecksum::generateSignature($reqParams, $this->config->get("payment_paytm_merchant_key"));						

                    $postData = 'JsonData='.urlencode(json_encode($reqParams));
                    $resParams = PaytmHelper::executecUrl(PaytmHelper::getPaytmURL(PaytmConstants::ORDER_STATUS_URL, $this->config->get('payment_paytm_environment')), $postData);							
                    if(@$resParams['STATUS'] && $resParams['STATUS'] == "TXN_SUCCESS"){
                        $this->load->model('checkout/order');
                        $order_info = $this->model_checkout_order->getWalletOrder($order_id);
                            
                        if($order_info['order_status_id'] != 22){                                
                            $loadComment = "Order ID #".$order_id." wallet load of Rs".$order_info['total'];
                            $this->load->model('bms/bms');
                            $res = $this->model_bms_bms->addRefund($order_id,$order_info['customer_id'],$order_info['total'],$loadComment);     
                            $this->addOrderHistory($order_id, 22, "");
                        }                            
                    }elseif(@$resParams['STATUS'] && $resParams['STATUS'] == "TXN_FAILURE"){
                    	$this->addOrderHistory($order_id, $this->config->get('payment_paytm_order_failed_status_id'));
						$this->session->data['error'] = $this->language->get('text_failure');                    	
                    }
					echo $resParams['STATUS'];exit;
                    
    
    }
}
?>