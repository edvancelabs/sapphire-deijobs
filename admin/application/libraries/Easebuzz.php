<?php
/**
 * CityPay uses checksum signature to ensure that API requests and responses shared between your 
 * application and CityPay over network have not been tampered with. We use SHA256 hashing and 
 * AES128 encryption algorithm to ensure the safety of transaction data.
 *
 */

class easebuzz{

	// ["SUCCESS", "NOT_ATTEMPTED", "FAILED", "USER_DROPPED", "VOID", "CANCELLED", "PENDING"]

	private static $pg_config = array(
		'prod' => array(
					'key'=>'10563910723ce4c82191fc7c6c936501',
					'salt'=>'9df377705689b10ffecad44581de4474d8c4bc38',
					'host'=>'https://pay.easebuzz.in/'
				),
		'test' => array(
					'key'=>'2PBP7IABZ2',
					'salt'=>'DAH88E3UWQ',
					'host'=>'https://testpay.easebuzz.in/'
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
		$path = 'payment/initiateLink';
		$post_data = array(
						"key"=>$creds['key'],
						"txnid"=>$data['m_ref_id'],
						"amount"=>$data['amount'],
						"productinfo"=>$data['customer_phone'],
						"firstname"=>$data['customer_firstname'],
						"phone"=>$data['customer_phone'],
						"email"=>$data['customer_email'],
						"surl"=>"http://test.ezipay.in/webhook/ar_payment",
						"furl"=>"http://test.ezipay.in/webhook/ar_payment",	
						"udf1"=>$data['txnid'],			
						// "request_flow"=>"SEAMLESS"
					);

		$hash = $post_data['key'].'|'.$post_data['txnid'].'|'.$post_data['amount'].'|'.$post_data['productinfo'].'|'.$post_data['firstname'].'|'.$post_data['email'].'|'.$post_data['udf1'].'||||||||||'.$creds['salt'];

		$post_data['hash'] = hash('sha512',$hash);

		$res = self::post_data($post_data,$path);

		if($res){
			$rdata = json_decode($res);
			if(@$rdata->status == 1){
				return array('1','success',$res);
			}else{
				return array('0',$rdata->error_desc,$res);
			}
		}else{
			return array('0','something went wrong. try again','{"message":"something went wrong. try again"}');
		}
	}

	


	static private function post_data($post_data,$path){
		$creds = self::$pg_config[self::$env];
		$url = $creds['host'].$path;

		// $url = "https://pay.easebuzz.in/initiate_seamless_payment/";

		

		$curl = curl_init();

		curl_setopt_array($curl, [
		  CURLOPT_URL => $url,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => http_build_query($post_data),
		  CURLOPT_HTTPHEADER => [
		    "Content-Type: application/x-www-form-urlencoded"
		  ],
		]);

		$resp = curl_exec($curl);
		$err = curl_error($curl);

		print_r($err);
		curl_close($curl);
		log_message("error", "EaseBuzz res ".$path." : ".$resp);
		return $resp;
	}

	static private function post_data_payment($post_data,$path){
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://testpay.easebuzz.in/initiate_seamless_payment/',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_REFERER => 'http://test.ezipay.in/',
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS => http_build_query($post_data),
		  CURLOPT_HTTPHEADER => array(
		    'Content-Type: application/x-www-form-urlencoded'
		  ),
		));

		$resp = curl_exec($curl);
		$err = curl_error($curl);

		print_r($err);
		curl_close($curl);
		log_message("error", "EaseBuzz res ".$path." : ".$resp);
		return $resp;
	}

	static public function create_payment($data,$order_data){

		$path = 'initiate_seamless_payment/';

		// '{"payment_method":{"upi":{"channel":"link"}},"payment_session_id":"session_s2u62ZqG2RL9bx7-ON1b_0bS7EUSL33g9Y00YzXhLgDi0cTZ5hS_wDu3VstgCI4x-iYQ7f9OffmAnTeUV4MP9EntzO8dQXj4PGnhaqa5ONH3"}';

		// bhim://upi/pay?pa=cf.ezipikservicesprivatelim@icici&pn=ezipik%20services%20private%20limited&tr=ATC1173875426&am=2.20&cu=INR&mode=00&purpose=00&mc=5411&tn=1173875426


		$post_data = array(
						'access_key'=>json_decode($order_data->pg_res_data)->data,
						// 'amount' => $order_data->amount,						
						'payment_mode'=>'UPI',
						'upi_qr'=>true,
						'request_mode'=>'SUVA'
					);

		$res = self::post_data($post_data,$path);

		if($res){
			$rdata = json_decode($res);
			if(@$rdata->status){
				$rdata->order_data = $order_data;
				return array('1',$rdata->qr_link,json_encode($rdata));
			}else{
				return array('0',$rdata->msg_desc,$res);
			}
		}else{
			return array('0','something went wrong. try again','{"message":"something went wrong. try again"}');
		}

	}


	static public function payment_status($orderid,$txn_data){		
		if($txn_data->txn_status == "pending" || $txn_data->txn_status == "failed"){

			$txn_order_data = json_decode($txn_data->pg_res_data)->order_data;
			$path = 'transaction/v1/retrieve';

			$post_data = array(
						"key"=>$creds['key'],
						"txnid"=>$orderid,
						"amount"=>$txn_order_data->amount,						
						"phone"=>$txn_order_data->customer_phone,
						"email"=>$txn_order_data->customer_email
					);

			$hash = $post_data['key'].'|'.$post_data['txnid'].'|'.$post_data['amount'].'|'.$post_data['email'].'|'.$post_data['phone'].'|'.$creds['salt'];

			$post_data['hash'] = hash('sha512',$hash);


			$res = self::post_json_data($post_data,$path);

			if($res){
				$rdata = json_decode($res);
				if(@$rdata->status){
					return array('1',self::my_status($rdata->msg->status),$res,$rdata->msg->error_Message);
				}else{
					return array('0',$rdata->msg,$res);
				}
			}else{
				return array('0','something went wrong. try again','{"message":"something went wrong. try again"}');
			}

		}else{
			return array('2',$txn_data->txn_status,json_decode($txn_data->pg_res_data)->msg->error_Message);
		}
		
	}

	static private function post_json_data($post_data,$path){
		$creds = self::$pg_config[self::$env];
		$url = $creds['host'].$path;
		$curl = curl_init();

		$json_data = json_encode($post_data);
		log_message("error", "EaseBuzz Req ".$path." : ".$json_data);

		curl_setopt_array($curl, [
		  CURLOPT_URL => $url,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => $json_data,
		  CURLOPT_HTTPHEADER => [
		    "Content-Type: application/json"
		  ],
		]);

		$resp = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);
		log_message("error", "EaseBuzz res ".$path." : ".$resp);
		return $resp;
	}

	static public function update_payment($txn_data){		
		if($txn_data->txnid){
			$event_time = new DateTime($txn_data->addedon);

			return  array(
						'mtxnid' => $txn_data->txnid,
						'txn_status' => self::my_status($txn_data->status),
						'txn_message' => $txn_data->error,
						'bank_refrence' => $txn_data->bank_ref_num,
						'event_time' => $event_time->format('U'),
						'db_update_data' => $txn_data
					);
		}else{
			return false;
		}
		
	}

	static public function update_refund($txn_data){		
		if(@$txn_data->data->txnid){
			$refund_txn_data = $txn_data->data;
			$event_time = new DateTime($txn_data->refund_request_date);
			return  array(
						'mtxnid' => $refund_txn_data->txnid,
						'refund_status' => self::my_status($refund_txn_data->refund_status),
						'refund_message' => "",
						'refund_arn' => @$refund_txn_data->Arn_number,
						'event_time' => $event_time->format('U'),
						'db_update_data' => $refund_txn_data
					);
		}else{
			return false;
		}
		
	}

	static public function my_status($status){
		$status_array = array(
							'success' => 'success',
							'failed' => 'failed',
							'pending' => 'pending',
							'userCancelled' => 'failed',
							'queued' => 'pending',
							'accepted' => 'success',
							'refunded' => 'success'
						);
		return $status_array[$status];

	}

	static public function create_refund($post,$txn_data){		
		
			$path = 'https://dashboard.easebuzz.in/transaction/v1/refund';
			$txn_order_data = json_decode($txn_data->pg_res_data)->order_data;
			$post_data = array(
						"key"=>$creds['key'],
						"txnid"=>$txn_data->reference_id,
						"refund_amount"=>$post['refund_amount'],						
						"phone"=>$txn_order_data->customer_phone,
						"email"=>$txn_order_data->customer_email,
						"amount"=> $txn_data->amount
					);

			$hash = $post_data['key'].'|'.$post_data['txnid'].'|'.$post_data['amount'].'|'.$post_data['refund_amount'].'|'.$post_data['email'].'|'.$post_data['phone'].'|'.$creds['salt'];

			$post_data['hash'] = hash('sha512',$hash);


			$res = self::post_json_data($post_data,$path);



			if($res){
				$rdata = json_decode($res);
				if(@$rdata->status){
					return array('1','success',$res,$rdata->reason,$rdata->refund_id);
				}else{
					return array('0',$rdata->reason,$res);
				}
			}else{
				return array('0','something went wrong. try again','{"message":"something went wrong. try again"}');
			}		
		
	}

	static public function get_refund($refundid,$rfnd_txn_data){		
		if($rfnd_txn_data->txn_status == "pending"){
			$path = 'https://dashboard.easebuzz.in/transaction/v1/refund';
			$txn_data = json_decode($rfnd_txn_data->pg_res_data);
			$post_data = array(
						"key"=>$creds['key'],
						"easebuzz_id"=>$txn_data->easebuzz_id
					);

			$hash = $post_data['key'].'|'.$post_data['easebuzz_id'].'|'.$creds['salt'];

			$post_data['hash'] = hash('sha512',$hash);
			$res = self::post_json_data($post_data,$path);


			if($res){
				$rdata = json_decode($res);
				if(@$rdata->status){
					return array('1',self::my_status($rdata->refunds[0]->refund_status),$res,"",$rdata->refunds[0]->Arn_number);
				}else{
					return array('0',$rdata->reason,$res);
				}
			}else{
				return array('0','something went wrong. try again','{"message":"something went wrong. try again"}');
			}
		}else{
			$txn_pg_data = json_decode($rfnd_txn_data->pg_res_data);
			return array('2',$rfnd_txn_data->txn_status,$txn_pg_data->status_description,$txn_pg_data->refund_arn);
		}
		
	}



	


	

}