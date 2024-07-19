<?php
/**
 * CityPay uses checksum signature to ensure that API requests and responses shared between your 
 * application and CityPay over network have not been tampered with. We use SHA256 hashing and 
 * AES128 encryption algorithm to ensure the safety of transaction data.
 *
 */

class cashfree{

	// ["SUCCESS", "NOT_ATTEMPTED", "FAILED", "USER_DROPPED", "VOID", "CANCELLED", "PENDING"]

	private static $pg_config = array(
		'prod' => array(
					'key'=>'10563910723ce4c82191fc7c6c936501',
					'secret'=>'9df377705689b10ffecad44581de4474d8c4bc38',
					'host'=>'https://api.cashfree.com/'
				),
		'test' => array(
					'key'=>'599849edc21d81dec42ad668f48995',
					'secret'=>'315e0c23d1418ea331a40281ed9f560463aab68f',
					'host'=>'https://sandbox.cashfree.com/'
				)
		);

	private static $env;

	public function __construct(){
		// Check compat first
		$ci =& get_instance();
		self::$env = $ci->config->item('pg_env');
	}

	


	static public function create_order($data) {

		$path = 'pg/orders';
		$post_data = array(
						'customer_details'=>array(
							'customer_id'=>$data['customer_id'],
							'customer_email'=>$data['customer_email'],
							'customer_phone'=>$data['customer_phone']
						),
						'order_id'=>$data['m_ref_id'],
						'order_amount'=>$data['amount'],
						'order_currency'=>'INR'
					);

		$res = self::post_data($post_data,$path);

		if($res){
			$rdata = json_decode($res);
			if(@$rdata->cf_order_id){
				return array('1','success',$res);
			}else{
				return array('0',$rdata->message,$res);
			}
		}else{
			return array('0','something went wrong. try again','{"message":"something went wrong. try again"}');
		}
	}

	static public function create_payment($data,$order_data){

		$path = 'pg/orders/sessions';

		// '{"payment_method":{"upi":{"channel":"link"}},"payment_session_id":"session_s2u62ZqG2RL9bx7-ON1b_0bS7EUSL33g9Y00YzXhLgDi0cTZ5hS_wDu3VstgCI4x-iYQ7f9OffmAnTeUV4MP9EntzO8dQXj4PGnhaqa5ONH3"}';

		upi://pay?pa=cf.ezipikservicesprivatelim@icici&pn=ezipik%20services%20private%20limited&tr=ATC1173875426&am=2.20&cu=INR&mode=00&purpose=00&mc=5411&tn=1173875426

		

		upi://pay?pa=EZIPIKSERVICESONLINE@ybl&pn=Ezipik%20Services%20&am=11.20&mam=11.20&tr=1_txn_LE0000CC00190000000000000000003&tn=Payment%20for%201_txn_LE0000CC00190000000000000000003&mc=8999&mode=04&purpose=00&utm_campaign=B2B_PG&utm_medium=EZIPIKSERVICESONLINE&utm_source=1_txn_LE0000CC00190000000000000000003


		$post_data = array(
						'payment_method'=>array(
							'upi'=>array('channel'=>'link')						
						),
						'payment_session_id'=>json_decode($order_data->pg_res_data)->payment_session_id
					);

		$res = self::post_data($post_data,$path);

		if($res){
			$rdata = json_decode($res);
			if(@$rdata->cf_payment_id){
				return array('1',$rdata->data->payload->default,$res);
			}else{
				return array('0',$rdata->message,$res);
			}
		}else{
			return array('0','something went wrong. try again','{"message":"something went wrong. try again"}');
		}

	}


// 	static public function payment_status($orderid,$txn_data){		
// 		if($txn_data->txn_status == "pending" || $txn_data->txn_status == "failed"){

// 			$path = 'pg/orders/'.$orderid.'/payments';
// 			$res = self::get_data($path);

// 			if($res){
// 				$rdata = json_decode($res);
// 				if(@$rdata[0]->cf_payment_id){
// 					return array('1',self::my_status($rdata[0]->payment_status),$res,$rdata[0]->payment_message);
// 				}else{
// 					return array('0',$rdata[0]->message,$res);
// 				}
// 			}else{
// 				return array('0','something went wrong. try again','{"message":"something went wrong. try again"}');
// 			}

// 		}else{
// 			return array('2',$txn_data->txn_status,json_decode($txn_data->pg_res_data)[0]->payment_message);
// 		}
		
// 	}

	static public function payment_status($orderid,$txn_data){	
		$txn_pg_res_data = json_decode($txn_data->pg_res_data);	
		if($txn_data->txn_status == "pending" || $txn_data->txn_status == "failed"){

			$path = 'pg/orders/'.$orderid.'/payments';
			$res = self::get_data($path);               	
    
        	if(is_array($txn_pg_res_data)){
            	$txn_pg_res_data = $txn_pg_res_data[0];
            }
        
			if($res){
				$rdata = json_decode($res);
            
            	if(is_array($rdata)){
                	$rdata = $rdata[0];
                }
            
				if(@$rdata->cf_payment_id){
					$status = self::my_status($rdata->payment_status);
					
					if($txn_data->txn_status == $status){
						return array('2',$txn_data->txn_status,$txn_pg_res_data->payment_message);
					}else{
						return array('1',$status,$res,$rdata->payment_message);
					}					
				}else{
					return array('0',$rdata->message,$res);
				}
			}else{
				return array('0','something went wrong. try again','{"message":"something went wrong. try again"}');
			}

		}else{
			return array('2',$txn_data->txn_status,$txn_pg_res_data->payment_message);
		}
		
	}
	static public function update_payment($txn_data){		
		if($txn_data->data->order->order_id){
			$event_time = new DateTime($txn_data->event_time);

			$status = self::my_status($txn_data->data->payment->payment_status);
			$msg  = $txn_data->data->payment->payment_message;
			if($status == "failed" && @$txn_data->data->error_details){
				$msg = $txn_data->data->error_details->error_description;
			}
			return  array(
						'mtxnid' => $txn_data->data->order->order_id,
						'txn_status' => $status,
						'txn_message' => $msg,
						'bank_refrence' => $txn_data->data->payment->bank_reference,
						'event_time' => $event_time->format('U'),
						'db_update_data' => array($txn_data->data->payment,@$txn_data->data->error_details)
					);
		}else{
			return false;
		}
		
	}

	static public function update_refund($txn_data){		
		if($txn_data->data->refund->cf_refund_id){
			$refund_txn_data = $txn_data->data->refund;
			$event_time = new DateTime($txn_data->event_time);
			return  array(
						'mtxnid' => $refund_txn_data->order_id,
						'refund_status' => self::my_status($refund_txn_data->refund_status),
						'refund_message' => $refund_txn_data->status_description,
						'refund_arn' => $refund_txn_data->refund_arn,
						'event_time' => $event_time->format('U'),
						'db_update_data' => array($refund_txn_data)
					);
		}else{
			return false;
		}
		
	}

	static public function my_status($status){
		$status_array = array(
							'SUCCESS' => 'success',
							'NOT_ATTEMPTED' => 'pending',
							'FAILED' => 'failed',
							'USER_DROPPED' => 'failed',
							'VOID' => 'failed',
							'CANCELLED' => 'failed',
							'PENDING' => 'pending'
						);
		return $status_array[$status];

	}

	static public function create_refund($post,$txn_data){		
		
			$path = 'pg/orders/'.$txn_data->reference_id.'/refunds';
			
			$post_data = array('refund_amount'=>$post['refund_amount'],'refund_id'=>$post['m_refund_id']);

			$res = self::post_data($post_data,$path);

			if($res){
				$rdata = json_decode($res);
				if(@$rdata->cf_refund_id){
					return array('1',self::my_status($rdata->refund_status),$res,$rdata->status_description,$rdata->refund_arn);
				}else{
					return array('0',$rdata->message,$res);
				}
			}else{
				return array('0','something went wrong. try again','{"message":"something went wrong. try again"}');
			}		
		
	}

	static public function get_refund($refundid,$rfnd_txn_data){		
		if($rfnd_txn_data->txn_status == "pending"){
			$txnid = json_decode($rfnd_txn_data->pg_res_data)->order_id;
			$path = 'pg/orders/'.$txnid.'/refunds/'.$refundid;
			$res = self::get_data($path);
			if($res){
				$rdata = json_decode($res);
				if(@$rdata->cf_refund_id){
					return array('1',self::my_status($rdata->refund_status),$res,$rdata->status_description,$rdata->refund_arn);
				}else{
					return array('0',$rdata->message,$res);
				}
			}else{
				return array('0','something went wrong. try again','{"message":"something went wrong. try again"}');
			}
		}else{
			$txn_pg_data = json_decode($rfnd_txn_data->pg_res_data);
			return array('2',$rfnd_txn_data->txn_status,$txn_pg_data->status_description,$txn_pg_data->refund_arn);
		}
		
	}



	static private function post_data($post_data,$path){
		// $post_data['cf_order_id'] = "1231231231312";
		// return json_encode($post_data);

		// $env = $this->config->item('pg_env');
		$creds = self::$pg_config[self::$env];


		$header= array('accept: application/json',
					    'content-type: application/json',
					    'x-api-version: 2022-09-01',
					    'x-client-id: '.$creds['key'],
					    'x-client-secret: '.$creds['secret']
					);

		$url = $creds['host'].$path;
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POST, true); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt( $ch, CURLOPT_HTTPHEADER, $header);		

		$req_data = json_encode($post_data);
    	log_message("error", "Cashfree req ".$path." : ".$req_data);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $req_data);
		$resp = curl_exec($ch);
		curl_close($ch);
		log_message("error", "Cashfree res ".$path." : ".$resp);
		return $resp;
	}

	static private function get_data($path){
		$creds = self::$pg_config[self::$env];


		$header= array('accept: application/json',
					    'content-type: application/json',
					    'x-api-version: 2022-09-01',
					    'x-client-id: '.$creds['key'],
					    'x-client-secret: '.$creds['secret']
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
		log_message("error", "Cashfree res ".$path." : ".$resp);
		curl_close($ch);
		return $resp;
	}

	// static public function test(){
	// 	echo self::my_status('SUCCESS');
	// }	
	

}