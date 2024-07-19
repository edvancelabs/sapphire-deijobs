<?php
/**
 * CityPay uses checksum signature to ensure that API requests and responses shared between your 
 * application and CityPay over network have not been tampered with. We use SHA256 hashing and 
 * AES128 encryption algorithm to ensure the safety of transaction data.
 *
 */



class phonepe{

	// ["SUCCESS", "NOT_ATTEMPTED", "FAILED", "USER_DROPPED", "VOID", "CANCELLED", "PENDING"]

	private static $pg_config = array(
		'test' => array(
					'mid'=>'EZIPIKSERVICESONLINE',
					'key'=>'a36ecc2a-a822-49c9-b691-dd2be8d288db',
					'host'=>'https://api.phonepe.com/apis/hermes'
				),
		'test1' => array(
					'mid'=>'EZIPIKSERVICESONLINE',
					'key'=>'a36ecc2a-a822-49c9-b691-dd2be8d288db',
					'host'=>'https://api-preprod.phonepe.com/apis/merchant-simulator'
				)
		);

	private static $env;

	public function __construct(){
		// Check compat first
		$ci =& get_instance();
		self::$env = $ci->config->item('pg_env');
	}

	static private function post_data($post_data,$path){

		$creds = self::$pg_config[self::$env];

		$post_data['merchantId'] = $creds['mid'];

		$enc_data = base64_encode(json_encode($post_data));		
		$xverify = hash('sha256', $enc_data.$path.$creds['key'])."###1";

		$header= array('accept: application/json',
					    'content-type: application/json',					   
					    'X-VERIFY: '.$xverify
					);

		$url = $creds['host'].$path;
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POST, true); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt( $ch, CURLOPT_HTTPHEADER, $header);		

		$req_data = '{"request":"'.$enc_data.'"}';
    	log_message("error", "PhonePE req (".$xverify.") ".$path." : ".$req_data);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $req_data);
		$resp = curl_exec($ch);
		curl_close($ch);
		log_message("error", "PhonePE res ".$path." : ".$resp);
		return $resp;
	}

	static private function get_data($path){
		$creds = self::$pg_config[self::$env];

		$path = str_replace('@mid@', $creds['mid'], $path);		

		$xverify = hash('sha256',$path.$creds['key'])."###1";

		$header= array('accept: application/json',
					    'content-type: application/json',
					    'X-VERIFY: '.$xverify,
					    'X-MERCHANT-ID: '.$creds['mid'],
					);

		$url = $creds['host'].$path;
		$ch = curl_init($url);
		// curl_setopt($ch, CURLOPT_POST, true); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt( $ch, CURLOPT_HTTPHEADER, $header);		

		//echo $data;
		// curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
		$resp = curl_exec($ch);
		//echo $resp;
		log_message("error", "PhonePE res ".$path." : ".$resp);
		curl_close($ch);
		return $resp;
	}


	static public function create_order($data) {

		return array('1','success','{"data":"DummyData"}');
		
	}

	static public function create_payment($data,$order_data){

		$o_data = json_decode($order_data->order_data);
		$path = '/pg/v1/pay';
		$post_data = array(
						// "merchantId"=>"MERCHANTUAT",
						"merchantTransactionId"=>$order_data->reference_id,
						//"merchantUserId"=>$o_data->customer_id,
						"amount"=>$order_data->amount*100,
						"callbackUrl"=>"https://ezipay.in/webhook/pe_payment",
						//"mobileNumber"=>$o_data->customer_phone,
						"deviceContext"=>array(
						  "deviceOS"=>"ANDROID"
						),
						"paymentInstrument"=>array(
						  "type"=>"UPI_INTENT",
						  "targetApp"=>"com.phonepe.app"
						)
					);

		$res = self::post_data($post_data,$path);

		if($res){
			$rdata = json_decode($res);
			if(@$rdata->success){
				return array('1',$rdata->data->instrumentResponse->intentUrl,$res);
			}else{
				return array('0',$rdata->message,$res);
			}
		}else{
			return array('0','something went wrong. try again','{"message":"something went wrong. try again"}');
		}

	}



	static public function payment_status($orderid,$txn_data){		
		$txn_pg_res_data = json_decode($txn_data->pg_res_data);
		if($txn_data->txn_status == "pending" || $txn_data->txn_status == "failed"){

			$path = '/pg/v1/status/@mid@/'.$orderid;
			$res = self::get_data($path);
        
        	
    
			if($res){
				$rdata = json_decode($res);
                        	
				if(@$rdata->code){
					$status = self::my_status($rdata->code);

					if($status != "ERROR"){
						if($txn_data->txn_status == $status){
							return array('2',$txn_data->txn_status,$txn_pg_res_data->message);
						}else{
							return array('1',$status,$res,$rdata->message);
						}		
					}else{
						return array('0',$rdata->message,$res);
					}
					
				}else{
					return array('0',$rdata->message,$res);
				}
			}else{
				return array('0','something went wrong. try again','{"message":"something went wrong. try again"}');
			}

		}else{
			return array('2',$txn_data->txn_status,$txn_pg_res_data->message);
		}
		
	}
	static public function update_payment($txn_data){	

		$txn_data = json_decode(base64_decode($txn_data->response));

		if($txn_data->success){
			//$event_time = new DateTime($txn_data->event_time);

			$status = self::my_status($txn_data->code);
			$msg  = $txn_data->message;			
			return  array(
						'mtxnid' => $txn_data->data->merchantTransactionId,
						'txn_status' => $status,
						'txn_message' => $msg,
						'bank_refrence' => $txn_data->data->paymentInstrument->utr,
						'event_time' => '',
						'db_update_data' => $txn_data
					);
		}else{
			return false;
		}
		
	}

	static public function update_refund($txn_data){		
		$txn_data = json_decode(base64_decode($txn_data->response));
		if($txn_data->success){
			//$event_time = new DateTime($txn_data->event_time);
			return  array(
						'mtxnid' => $txn_data->data->merchantTransactionId,
						'refund_status' => self::my_status($txn_data->code),
						'refund_message' => $txn_data->message,
						'refund_arn' => $txn_data->data->paymentInstrument->utr,
						'event_time' => '',
						'db_update_data' => $txn_data
					);
		}else{
			return false;
		}
		
	}

	static public function my_status($status){
		$status_array = array(
							'PAYMENT_SUCCESS' => 'success',
							'PAYMENT_PENDING' => 'pending',
							'BAD_REQUEST' => 'ERROR',
							'AUTHORIZATION_FAILED' => 'ERROR',
							'INTERNAL_SERVER_ERROR' => 'ERROR',
							'TRANSACTION_NOT_FOUND' => 'ERROR',
							'PAYMENT_ERROR' => 'failed',
							'PAYMENT_DECLINED'=> 'failed',
							'TIMED_OUT'=> 'failed',
							'REVERSAL_WINDOW_EXCEEDED' =>'failed'
						);



		return $status_array[$status];

	}

	static public function create_refund($post,$txn_data){		
		
			$path = '/pg/v1/refund';
			
			// $post_data = array('refund_amount'=>$post['refund_amount'],'refund_id'=>$post['m_refund_id']);
			
			$post_data = array(
			    "merchantUserId"=>$txn_data->merchantUserId,
			    "originalTransactionId"=>$txn_data->reference_id,
			    "merchantTransactionId"=>$post['m_refund_id'],
			    "amount"=>$post['refund_amount']*100,
			    "callbackUrl"=>"https://ezipay.in/webhook/pe_refund"
			);

			$res = self::post_data($post_data,$path);

			if($res){
				$rdata = json_decode($res);
				if(@$rdata->success){
					return array('1',self::my_status($rdata->code),$res,$rdata->message,'');
				}else{
					return array('0',$rdata->message,$res);
				}
			}else{
				return array('0','something went wrong. try again','{"message":"something went wrong. try again"}');
			}		
		
	}

	static public function get_refund($refundid,$rfnd_txn_data){	
		
		if($rfnd_txn_data->txn_status == "pending"){
			
			$path = '/pg/v1/status/@mid@/'.$refundid;
			$res = self::get_data($path);

			if($res){
				$rdata = json_decode($res);
				if(@$rdata->code){
					$status = self::my_status($rdata->code);

					if($status != "ERROR"){
				
						return array('1',$status,$res,$rdata->message,@$rdata->data->paymentInstrument->utr);
						
					}else{
						return array('0',$rdata->message,$res);
					}
					
				}else{
					return array('0',$rdata->message,$res);
				}
			}else{
				return array('0','something went wrong. try again','{"message":"something went wrong. try again"}');
			}
		}else{
			$txn_pg_data = json_decode($rfnd_txn_data->pg_res_data);	
			return array('2',$rfnd_txn_data->txn_status,$txn_pg_data->message,@$txn_pg_data->data->paymentInstrument->utr);
		}
		
	}



	

	

	// static public function test(){
	// 	echo self::my_status('SUCCESS');
	// }	
	

}