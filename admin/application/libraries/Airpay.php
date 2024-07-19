<?php

class airpay{

	// ["SUCCESS", "NOT_ATTEMPTED", "FAILED", "USER_DROPPED", "VOID", "CANCELLED", "PENDING"]

	private static $pg_config = array(
		'prod' => array(
					'username'=>'8256600',
					'password'=>'n5aw9NDh',
					'secret'=>'uvEW9MpkTRjyMVwq',
					'mercid'=>'279017',
					'pvt_key'=>'6d8b86d0cfe000557f71a26802a778511c84ce50b898ab155a30d6a2b8a13f23',
					'checksum_key'=>'5dff77a7b1a7d9d8ed5915054f9acfb414b6add593baab0c2df6a555862d80de',
					'mer_dom' => 'aHR0cHM6Ly9lemlwaWsuY29t'
				),
		'test' => array(
					'username'=>'8256600',
					'password'=>'n5aw9NDh',
					'secret'=>'uvEW9MpkTRjyMVwq',
					'mercid'=>'279017',
					'pvt_key'=>'6d8b86d0cfe000557f71a26802a778511c84ce50b898ab155a30d6a2b8a13f23',
					'checksum_key'=>'5dff77a7b1a7d9d8ed5915054f9acfb414b6add593baab0c2df6a555862d80de',
					'mer_dom' => 'aHR0cHM6Ly9lemlwaWsuY29t'
				)
		);

	private static $env;

	public function __construct(){
		// Check compat first
		$ci =& get_instance();
		self::$env = $ci->config->item('pg_env');
	}



	static public function create_order($data) {

		return array('1','success','{"data":"DummyData"}');
		
	}

	static public function enc_data($secret,$json_data){
		$encKey = md5($secret);
		$iv = bin2hex(openssl_random_pseudo_bytes(8));
		$raw = openssl_encrypt( $json_data , "AES-256-CBC" , $encKey, $options=OPENSSL_RAW_DATA , $iv);
		return  $iv . base64_encode($raw);

	}
	static public function dec_data($secret,$json_data){
    	$encKey = md5($secret);
		$encryptedData = $json_data->data;

		$iv = substr($encryptedData, 0, 16);
		$data = substr($encryptedData, 16);


		return openssl_decrypt(base64_decode($data), 'AES-256-CBC', $encKey, $options=OPENSSL_RAW_DATA, $iv);

	}

	static public function payment_request($post_data){
		$curl = curl_init();
		log_message("error", "Airpay req payment_request : ".$post_data);
		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://kraken.airpay.co.in/airpay/api/generateorder',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS =>$post_data,
		  CURLOPT_HTTPHEADER => array(
		    'Content-Type: application/json'
		  ),
		));

		$response = curl_exec($curl);
		log_message("error", "Airpay res payment_request : ".$response);
		curl_close($curl);

		return $response;

		
	}

	static public function create_payment($data,$order_data){
		$creds = self::$pg_config[self::$env];
		$o_data = json_decode($order_data->order_data);

		$call_type = "upiqr";
		$buyerEmail = "ezipik.alerts@gmail.com";	

		$new_orderid = sprintf("%06d", $order_data->id).substr($order_data->reference_id, -24);;

		$alldata = $creds['mercid'].$new_orderid.($order_data->amount*100).$o_data->customer_phone.$buyerEmail.$creds['mer_dom'].$call_type;

		$checksum = hash('SHA256', $creds['checksum_key'].'@'.$alldata.date('Y-m-d'));

		$json_data = '{"mercid":"'.$creds['mercid'].'","orderid":"'.$new_orderid.'","amount":"'.($order_data->amount*100).'","buyerPhone":"'.$o_data->customer_phone.'","buyerEmail":"'.$buyerEmail.'","mer_dom":"'.$creds['mer_dom'].'","call_type":"'.$call_type.'"}';


		$enc_data = self::enc_data($creds['secret'],$json_data);

		$res = self::payment_request('{"encData":"'.$enc_data.'","checksum":"'.$checksum.'","mercid":"'.$creds['mercid'].'"}');

		$res = self::dec_data($creds['secret'],json_decode($res));
    
    	log_message("error", "Airpay res Dec Data : ".$res);

		$rdata = json_decode($res);
		if($rdata){			
			if(@$rdata->status == 200){
				return array('1',$rdata->QRCODE_STRING,$res);
			}else{
				return array('0',$rdata->message,$res);
			}
		}else{
			return array('0','something went wrong. try again','{"message":"something went wrong. try again"}');
		}

	}



	static public function status_request($post_data){
		$curl = curl_init();
		log_message("error", "Airpay req status_request : ".json_encode($post_data));
		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://kraken.airpay.co.in/airpay/order/verify.php',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS => $post_data,
		  CURLOPT_HTTPHEADER => array(
		    'Accept: application/xml'
		  ),

		));


		$response = curl_exec($curl);
		curl_close($curl);

		try {
			$xml = simplexml_load_string($response, 'SimpleXMLElement', LIBXML_NOCDATA);	
	    	$json_data = json_encode($xml,true);;
	    	log_message("error", "Airpay res status_request : ".$json_data);
			return $json_data;
		} catch (Exception $e) {
			log_message("error", "Airpay res status_request raw : ".$response);
			return false;
		}
		
	}


	static public function payment_status($orderid,$txn_data){		
		$txn_pg_res_data = json_decode($txn_data->pg_res_data);
		if($txn_data->txn_status == "pending" || $txn_data->txn_status == "failed"){			
			$processer_id = (@$txn_pg_res_data->RID ? $txn_pg_res_data->RID : $txn_pg_res_data->TRANSACTION->APTRANSACTIONID);

			$creds = self::$pg_config[self::$env];
			$orderid = "";
			$alldata = $creds['mercid'].$orderid.$processer_id;

			$checksum = hash('SHA256', $creds['checksum_key'].'@'.$alldata.date('Y-m-d'));

			$post_data = array('merchant_id' => $creds['mercid'],'merchant_txn_id' => $orderid,'processor_id'=>$processer_id,'private_key' => $creds['pvt_key'],'checksum' => $checksum);

			$res = self::status_request($post_data);

    
			if($res){
				$rdata = json_decode($res);
                        	
				if(@$rdata->TRANSACTION){
					$status = self::my_status($rdata->TRANSACTION->TRANSACTIONSTATUS);

					if($status != "ERROR"){
						if($txn_data->txn_status == $status){
							return array('2',$txn_data->txn_status,$txn_pg_res_data->TRANSACTION->TRANSACTIONPAYMENTSTATUS);
						}else{
							return array('1',$status,$res,$rdata->TRANSACTION->TRANSACTIONPAYMENTSTATUS);
						}		
					}else{
						return array('0','No Record Found',$res);
					}
					
				}else{
					return array('0',$rdata->message,$res);
				}
			}else{
				return array('0','something went wrong. try again','{"message":"something went wrong. try again"}');
			}

		}else{
			return array('2',$txn_data->txn_status,$txn_pg_res_data->TRANSACTION->TRANSACTIONPAYMENTSTATUS);
		}
		
	}

	static public function get_refund($refundid,$rfnd_txn_data){

		$txn_pg_data = json_decode($rfnd_txn_data->pg_res_data);	
		if($rfnd_txn_data->txn_status == "pending"){
			$processer_id = $txn_pg_data->refundairpayid;

			$creds = self::$pg_config[self::$env];
			$refundid = "";
			$alldata = $creds['mercid'].$refundid.$processer_id;

			$checksum = hash('SHA256', $creds['checksum_key'].'@'.$alldata.date('Y-m-d'));

			$post_data = array('merchant_id' => $creds['mercid'],'merchant_txn_id' => $refundid,'processor_id'=>$processer_id,'private_key' => $creds['pvt_key'],'checksum' => $checksum);

			$res = self::status_request($post_data);


			if($res){
				$rdata = json_decode($res);
                        	
				if(@$rdata->TRANSACTION){
					$status = self::my_status($rdata->TRANSACTION->TRANSACTIONSTATUS);

					if($status != "ERROR"){
						
						return array('1',$status,$res,$rdata->TRANSACTION->TRANSACTIONPAYMENTSTATUS, $rdata->TRANSACTION->RRN);
						
					}else{
						return array('0','No Record Found',$res);
					}
					
				}else{
					return array('0',$rdata->message,$res);
				}
			}else{
				return array('0','something went wrong. try again','{"message":"something went wrong. try again"}');
			}
			
		}else{
			
			return array('2',$rfnd_txn_data->txn_status,$txn_pg_res_data->TRANSACTION->TRANSACTIONPAYMENTSTATUS,@$txn_pg_res_data->TRANSACTION->RRN);
		}
		
	}

	static public function refund_request($post_data){
		$curl = curl_init();
		log_message("error", "Airpay req refund_request : ".$post_data);
		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://kraken.airpay.co.in/airpay/api/refundtxn.php',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS => $post_data,
		  CURLOPT_HTTPHEADER => array(
			    'Content-Type: application/json'
			  ),
		));

		$response = curl_exec($curl);
		curl_close($curl);
		log_message("error", "Airpay res refund_request : ".$response);
		return $response;
	}
	static public function create_refund($post,$txn_data_db){	
		$creds = self::$pg_config[self::$env];

		$airpayid = json_decode($txn_data_db->pg_res_data)->TRANSACTION->APTRANSACTIONID;

		$txns = array(array("amount"=>$post['refund_amount'],"airpayid"=>$airpayid));		
		$alldata = $creds['mercid']."refund".json_encode($txns);

		$checksum = hash('SHA256', $creds['checksum_key'].'@'.$alldata.date('Y-m-d'));


		$post_data = json_encode(array('merchant_id' => $creds['mercid'],'mode' => 'refund','private_key' => $creds['pvt_key'],'checksum' => $checksum, 'transactions'=> $txns ));

		$res = self::refund_request($post_data);

		if($res){
			$rdata = json_decode($res);
			if(@$rdata[0]->success && $rdata[0]->transactions[0]->success){
				$res = json_encode($rdata[0]->transactions[0]);
				return array('1','pending',$res,'Refund initiated successfully');
			}else{
				return array('0',$rdata[0]->message.@$rdata[0]->transactions[0]->message,$res);
			}
		}else{
			return array('0','something went wrong. try again','{"message":"something went wrong. try again"}');
		}		
			
		
	}
	// static public function update_payment($txn_data){	

	// 	$txn_data = json_decode(base64_decode($txn_data->response));

	// 	if($txn_data->success){
	// 		//$event_time = new DateTime($txn_data->event_time);

	// 		$status = self::my_status($txn_data->code);
	// 		$msg  = $txn_data->message;			
	// 		return  array(
	// 					'mtxnid' => $txn_data->data->merchantTransactionId,
	// 					'txn_status' => $status,
	// 					'txn_message' => $msg,
	// 					'bank_refrence' => $txn_data->data->paymentInstrument->utr,
	// 					'event_time' => '',
	// 					'db_update_data' => $txn_data
	// 				);
	// 	}else{
	// 		return false;
	// 	}
		
	// }

	// static public function update_refund($txn_data){		
	// 	$txn_data = json_decode(base64_decode($txn_data->response));
	// 	if($txn_data->success){
	// 		//$event_time = new DateTime($txn_data->event_time);
	// 		return  array(
	// 					'mtxnid' => $txn_data->data->merchantTransactionId,
	// 					'refund_status' => self::my_status($txn_data->code),
	// 					'refund_message' => $txn_data->message,
	// 					'refund_arn' => $txn_data->data->paymentInstrument->utr,
	// 					'event_time' => '',
	// 					'db_update_data' => $txn_data
	// 				);
	// 	}else{
	// 		return false;
	// 	}
		
	// }

	static public function my_status($status){


		$status_array = array(
							'200' => 'success',
							'211' => 'pending',
							'450' => 'pending',
							'503' => 'ERROR',
							'400' => 'failed',
							'401'=> 'failed',
							'402'=> 'failed',
							'403' =>'failed',
							'405' =>'failed'							
						);



		return $status_array[$status];

	}



	


}