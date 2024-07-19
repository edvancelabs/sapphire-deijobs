<?php

class decentro{

	private static $pg_config = array(
		'test' => array(
					'client_id'=>'ezipik_prod',
					'client_secret'=>'5zZXLIYQvlyRWfp5yaLBJKEEX3P1vPiQ',
					'module_secret'=>'NFLaLgcTjyrTTpIb7EClfWHdcn0brYRc',
					'provider_secret'=>'KvduSU8n1hRmAFhmZmgUSjoQIR0BdBD6',
					'host'=>'https://in.staging.decentro.tech/v2/'
				),
		'prod' => array(
					'client_id'=>'ezipik_prod',
					'client_secret'=>'5zZXLIYQvlyRWfp5yaLBJKEEX3P1vPiQ',
					'module_secret'=>'NFLaLgcTjyrTTpIb7EClfWHdcn0brYRc',
					'provider_secret'=>'KvduSU8n1hRmAFhmZmgUSjoQIR0BdBD6',
					'host'=>'https://in.decentro.tech/v2/'
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

		$url = $creds['host'].$path;
		$req_data = json_encode($post_data);

		log_message("error", "Decentro req ".$path." : ".$req_data);

		$curl = curl_init();

		curl_setopt_array($curl, [
		  CURLOPT_URL => $url,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => $req_data,
		  CURLOPT_HTTPHEADER => [
		    "accept: application/json",
		    "client_id: ".$creds['client_id'],
		    "client_secret: ".$creds['client_secret'],
		    "content-type: application/json",
		    "module_secret: ".$creds['module_secret'],
		    "provider_secret: ".$creds['provider_secret'],
		  ],
		]);

		
		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);
		log_message("error", "Decentro res ".$path." : ".$response);
		return $response;
	}

	static private function get_data($path){
		$creds = self::$pg_config[self::$env];

		$curl = curl_init();

		$url = $creds['host'].$path;
		curl_setopt_array($curl, [
		  CURLOPT_URL => $url,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => [
		    "accept: application/json",
		    "client_id: ezipik_prod",
		    "client_secret: 5zZXLIYQvlyRWfp5yaLBJKEEX3P1vPiQ",
		    "content-type: application/json",
		    "module_secret: NFLaLgcTjyrTTpIb7EClfWHdcn0brYRc",
		    "provider_secret: KvduSU8n1hRmAFhmZmgUSjoQIR0BdBD6"
		  ],
		]);

		$response = curl_exec($curl);
		$err = curl_error($curl);
		//echo $resp;
		log_message("error", "Decentro res ".$path." : ".$response);
		curl_close($ch);
		return $response;
	}


	static public function create_order($data) {

		return array('1','success','{"data":"DummyData"}');
		
	}

	static public function create_payment($data,$order_data){

		$o_data = json_decode($order_data->order_data);
		$path = 'payments/upi/link';
		$post_data = array(						
						"reference_id" => $order_data->reference_id,	
						"amount" => floatval($order_data->amount),
						"payee_account"=> "462511781732385739",
						"purpose_message"=> "payment for ".$order_data->reference_id,
						"generate_qr"=> 0,
						"generate_uri"=>1,
						"expiry_time"=>15
					);		

		$res = self::post_data($post_data,$path);

		if($res){
			$rdata = json_decode($res);
			if(@$rdata->responseCode == "S00000"){
				return array('1',$rdata->data->upiUri,$res);
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

			$path = 'payments/transaction/status?transaction_id='.$txn_pg_res_data->decentroTxnId;
			$res = self::get_data($path);
    
			if($res){
				$rdata = json_decode($res);
                        	
				if(@$rdata->responseCode == "S00000"){
					$status = self::my_status($rdata->data->transactionStatus);

					$statusMsg = @$rdata->data->transactionStatusDescription;
					if($statusMsg == ""){
						$statusMsg = self::my_status_msg($status);
					}

					if($txn_data->txn_status == $status){
						return array('2',$txn_data->txn_status,$statusMsg);
					}else{                    	
						return array('1',$status,$res,$statusMsg);
					}					
				}else{
					return array('0',$rdata->message,$res);
				}
			}else{
				return array('0','something went wrong. try again','{"message":"something went wrong. try again"}');
			}

		}else{
			$statusMsg = self::my_status_msg($txn_data->txn_status);
			return array('2',$txn_data->txn_status,$statusMsg);
		}
		
	}



	static public function update_payment($txn_data){		

		if($txn_data->decentroTxnId){
			$event_time = new DateTime($txn_data->timestamp);

			$status = self::my_status($txn_data->transactionStatus);
			$statusMsg = self::my_status_msg($status);

			$msg  = $txn_data->message;			
			return  array(
						'mtxnid' => $txn_data->referenceId,
						'txn_status' => $status,
						'txn_message' => $statusMsg,
						'bank_refrence' => $txn_data->bankReferenceNumber,
						'event_time' => $event_time->format('U'),
						'db_update_data' => array("decentroTxnId"=>$txn_data->decentroTxnId,"data"=>$txn_data)
					);
		}else{
			return false;
		}
		
	}

	static public function update_refund($txn_data){		
		// if($txn_data->success){
		// 	//$event_time = new DateTime($txn_data->event_time);
		// 	return  array(
		// 				'mtxnid' => $txn_data->data->merchantTransactionId,
		// 				'refund_status' => self::my_status($txn_data->code),
		// 				'refund_message' => $txn_data->message,
		// 				'refund_arn' => $txn_data->data->paymentInstrument->utr,
		// 				'event_time' => '',
		// 				'db_update_data' => $txn_data
		// 			);
		// }else{
		// 	return false;
		// }
		
	}


	static public function create_refund($post,$txn_data){		
		
			$path = 'payments/upi/refund';
			
			// $post_data = array('refund_amount'=>$post['refund_amount'],'refund_id'=>$post['m_refund_id']);

			// {\"reference_id\":\"txn_EZ_RF1234567890qwertyuiopasdfghjklzxy\",\"transaction_id\":\"10A01EEE30344D5A97E1570E5C14E442\",\"purpose_message\":\"test payment\"}
			
			$post_data = array(
			    "merchantUserId"=>$txn_data->merchantUserId,
			    "reference_id"=>$txn_data->reference_id,
			    "transaction_id"=>$post['m_refund_id'],
			    "purpose_message"=>""			    
			);

			$res = self::post_data($post_data,$path);

			if($res){
				$rdata = json_decode($res);
				if(@$rdata->responseCode == "S00000"){
					return array('1',self::my_status($rdata->data->transactionStatus),$res,$rdata->data->transactionStatusDescription,$rdata->data->bankReferenceNumber);
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


	static public function my_status($status){
		$status_array = array(
							'SUCCESS' => 'success',
							'success' => 'success',
							'PENDING' => 'pending',
							'pending' => 'pending',
							'EXPIRED' => 'failed',
							'expired' => 'failed',
							'FAILED'  =>  'failed',
							'failed'  =>  'failed',
        					'failure' => 'failed',
        					'FAILURE' => 'failed'
						);



		return $status_array[$status];

	}

	static public function my_status_msg($code){
		$status_array = array(
							'EXPIRED' => 'customer has not completed transaction',
							'PENDING' => 'we are procceing your payment',
							'SUCCESS' => 'transaction Successful'
						);


		if(@$status_array[$code]){
        	return $status_array[$code];
        }
		return 'fail';

	}

	

	

}