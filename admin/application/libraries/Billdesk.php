<?php
/**
 * CityPay uses checksum signature to ensure that API requests and responses shared between your 
 * application and CityPay over network have not been tampered with. We use SHA256 hashing and 
 * AES128 encryption algorithm to ensure the safety of transaction data.
 *
 */
require __DIR__ . '/vendor/autoload.php';

use Jose\Factory\JWEFactory;
use Jose\Factory\JWKFactory;
use Jose\Factory\JWSFactory;
use Jose\Loader;

class billdesk{


	private static $pg_config = array(
		'prod' => array(
					'clientid'=>'bookmysab2',
					'bdpublic'=>'KR_l_R6lUicre_soJgrYG3nYRhXp6mz-92IQy6IXLaU',
					'ekpublic'=>'vTTFOl3jE5pt9p8QKCwiQtQ_SFO57UXMGuyZMkte3vg',
					'host'=>'https://pguat.billdesk.io/'
				),
		'test' => array(
					'mercid'=>'EZIPIK2UAT',
					'clientid'=>'ezipik2uat',
					'bdpublic'=>'fe6Yllu-ApvCWt9t0CeOw89vBuTY9hmZIVXXBkhVAbI',
					'ekpublic'=>'B4jxOmDMNQkaS_pW996YXkzLc3foyeYpmjCy8CYHlV4',
					'host'=>'https://pguat.billdesk.io/'
				)
		);

	private static $env;

	public function __construct(){
		// Check compat first
		$ci =& get_instance();
		self::$env = $ci->config->item('pg_env');
	}

	static public function create_order($data) {
		return array('1','success',json_encode($data));		
	}

	static public function create_order_test($data) {
		$payment_json ='{"mercid":"EZIPIK2UAT","orderid":"UPIODR00000005'.time().'","amount":"2.00","currency":"356","txn_process_type":"intent","itemcode":"DIRECT", "bankid":"789","payment_method_type":"upi","additional_info":{"additional_info1":"Details1","additional_info2":"Details2","additional_info3":"Details3","additional_info4":"Details4","additional_info5":"Details5","additional_info6":"Details6","additional_info7":"Details7","additional_info8":"Details8","additional_info9":"Details9","additional_info10":"Details10"},"device":{"init_channel":"internet","ip":"124.124.1.1","user_agent":"Mozilla/5.0(Windows NT 10.0; WOW64;rv:51.0)"}}';

		$paymentUrl = 'payments/ve1_2/transactions/create';
		

		$res = self::post_data($payment_json, $paymentUrl);
		print_r($res);		
	}

	static private function post_data($post_data,$path,$post_header=false){
		$creds = self::$pg_config[self::$env];
		$url = $creds['host'].$path;

		$post_data['mercid'] = $creds['mercid'];
		$bdPublickey = JWKFactory::createFromCertificateFile(
		    __DIR__ .'/certs/rsa.cer'
		);
		
		$ekPrivateKey = JWKFactory::createFromKeyFile(
		    __DIR__ .'/certs/uat_server.key'
		);

		$jwepayload = JWEFactory::createJWEToCompactJSON(
		    $post_data,                    // The message to encrypt
		    $bdPublickey,                        // The key of the recipient
		    [
		        'alg' => 'RSA-OAEP-256',
		        'enc' => 'A128GCM',
		    	'x5t#S256' => $creds['bdpublic'],
		    	'clientid' => $creds['clientid']
		    ]
		);

		$signedReqPayload = JWSFactory::createJWSToCompactJSON($jwepayload, $ekPrivateKey,  [
        	'alg' => 'PS256',
        	'x5t#S256' => $creds['ekpublic'],
        	'clientid' => $creds['clientid']
    	]);

    	// return $signedReqPayload;

		$header = array(
					'Accept: application/jose',
				    'Content-Type: application/jose',
				    'BD-Traceid: ahdquwhd1823y1234'.time(),
				    'BD-Timestamp: '.time()
				);
		// if($post_header){
		// 	$header = array_merge($header,$post_header);
		// }

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POST, true); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt( $ch, CURLOPT_HTTPHEADER, $header);		

		//echo $data;
		curl_setopt($ch, CURLOPT_POSTFIELDS, $signedReqPayload);
		$resp = curl_exec($ch);
		curl_close($ch);

		$loader = new Loader();
		$encData = $loader->loadAndVerifySignatureUsingKey(
		    $resp,
		    $bdPublickey,
		    ['PS256'],
		    $signature_index
		);



		$decData = $loader->loadAndDecryptUsingKey(
		    $encData->getPayload(),            // The input to load and decrypt
		    $ekPrivateKey,              // The symmetric or private key 
		    ['RSA-OAEP-256'],      // A list of allowed key encryption algorithms
		    ['A256GCM'],       // A list of allowed content encryption algorithms
		    $recipient_index   // If decrypted, this variable will be set with the recipient index used to decrypt
		);

		// print_r($decData->getPayload());
		return $decData->getPayload();




	}

	static public function create_payment($data,$order_data){

		$path = 'payments/ve1_2/transactions/create';
		
		$post_data = array(
						//"mercid"=>"EZIPIK2UAT",
						"orderid" => $order_data->reference_id,
						"amount" => $order_data->amount,
						"currency" =>"356",
						"txn_process_type" =>"intent",
						"itemcode" =>"DIRECT",
						"bankid" =>"789",
						"payment_method_type" =>"upi",
						"device" => array(
									"init_channel"=>"internet",
									"ip"=> $data['user_ip'],
									"user_agent"=>$data['user_agent']
								)
					);

		$rdata = self::post_data($post_data,$path);

		if($rdata){		
			if(@$rdata['intent']){
				return array('1',base64_decode($rdata['intent']),json_encode($rdata));
			}else{
				return array('0',$rdata['transaction_error_desc'],json_encode($rdata));
			}
		}else{
			return array('0','something went wrong. try again','{"message":"something went wrong. try again"}');
		}

	}

	// upi://pay?pa=upi@razopay&pn=EZIPIKSERVICESPRIVATELIMITED&tr=FRvraxmlVRskIJW&tn=razorpay&am=12.2&cu=INR&mc=5411

	static public function update_payment($txn_data){	

		// if($txn_data->payload->payment->entity->order_id){
		// 	$payment_entity = $txn_data->payload->payment->entity;
		// 	$txn_status = self::my_status($payment_entity->status);
		// 	$payment_entity->payment_message = self::my_status_msg($txn_status);
		// 	return  array(
		// 				'mtxnid' => $payment_entity->notes->txnid,
		// 				'txn_status' => $txn_status,
		// 				'txn_message' => $payment_entity->payment_message,
		// 				'bank_refrence' => $payment_entity->acquirer_data->rrn,
		// 				'event_time' => $payment_entity->created_at,
		// 				'db_update_data' => array($payment_entity)
		// 			);
		// }else{
		// 	return false;
		// }
		
	}

	static public function payment_status($orderid,$txn_data){		
		if($txn_data->txn_status == "pending" || $txn_data->txn_status == "failed"){

			$path = 'payments/ve1_2/transactions/get';
			$rdata = self::post_data(array('orderid'=>$orderid),$path);

			if($rdata){				
				if(@$rdata['transactionid']){
					$status = self::my_status($rdata['transaction_error_code']);
					
					if($txn_data->txn_status == $status){
						return array('2',$txn_data->txn_status,json_decode($txn_data->pg_res_data)->transaction_error_desc);
					}else{
						return array('1',$status,json_encode($rdata),$rdata['transaction_error_desc']);
					}

					
				}else{
					return array('0',$rdata['transaction_error_desc'],json_encode($rdata));
				}
			}else{
				return array('0','something went wrong. try again','{"message":"something went wrong. try again"}');
			}

		}else{
			return array('2',$txn_data->txn_status,json_decode($txn_data->pg_res_data)->transaction_error_desc);
		}
		
	}

	static public function my_status($status){
		$status_array = array(
							'TRP0000' => 'pending',
							'TRS0000' => 'success',
							'TRF0000' => 'failed'
						);
		return $status_array[$status];

	}

	static public function my_status_msg($status){
		$status_array = array(
							'pending' => 'Transaction is under process',
							'pending' => 'Transaction is under process',
							'success' => 'Transaction is successful',
							'success' => 'Transaction is successful',
							'failed' => 'Transaction is failed'
						);
		return $status_array[$status];

	}

	static public function create_refund($post,$txn_data_db){	
		$path = 'payments/ve1_2/refunds/create';

		$txn_pg_json = $txn_data_db->pg_res_data;
		$post_data = array(
						"transactionid" => $txn_pg_json['transactionid'],
						"orderid" => $txn_pg_json['orderid'],						
						"transaction_date" => $txn_pg_json['transaction_date'],
						"txn_amount" => $txn_data_db->amount,
						"refund_amount" => $post['refund_amount'],
						"currency" => "356",
						"merc_refund_ref_no" => $post['m_refund_id']
					);

		$rdata = self::post_data($post_data,$path);

		if($rdata){

			if(@$rdata['refundid']){
				return array('1',self::my_status($rdata['refund_status']),json_encode($rdata),self::my_status_msg($rdata['refund_status']),"");
			}else{
				return array('0',$rdata['transaction_error_desc'],json_encode($rdata));
			}
		}else{
			return array('0','something went wrong. try again','{"message":"something went wrong. try again"}');
		}
		
	}

	static public function get_refund($rfid,$txn_data){		
		
		if($txn_data->txn_status == "pending"){
			$creds = self::$pg_config[self::$env];
			$api = new Api($creds['key'], $creds['secret']);

			try {
				$txn_pg_data = json_decode($txn_data->pg_res_data);
				$refundId = $txn_pg_data->id;
				$paymentId = $txn_pg_data->payment_id;
				$rdata = $api->payment->fetch($paymentId)->fetchRefund($refundId);

				if($rdata){
					$res = json_encode($rdata->toArray());
					log_message("error", "Razorpay res create_refund : ".$res);
					if(@$rdata->id){
						return array('1',self::my_refund_status($rdata->status),$res,self::my_refund_status_msg($rdata->status),$rdata->acquirer_data->rrn);
					}
				}else{
					return array('0','something went wrong. try again','{"message":"something went wrong. try again"}');
				}

			} catch (Exception $e) {
				log_message("error", "Razorpay res payment_status : ".$e->getMessage());
				return array('0',$e->getMessage(),'{"message":'.$e->getMessage().'}');
			}

		}else{
			$txn_pg_data = json_decode($txn_data->pg_res_data);
			return array('2',$txn_data->txn_status,self::my_refund_status_msg($txn_data->txn_status),$txn_pg_data->acquirer_data->rrn);
		}
		
		
	}

	static public function update_refund($txn_data){	

		if($txn_data->payload->refund->entity->id){
			$refund_entity = $txn_data->payload->refund->entity;
			$txn_status = self::my_status($refund_entity->status);
			$refund_entity->payment_message = self::my_status_msg($txn_status);
			return  array(
						'mtxnid' => $refund_entity->notes->txnid,
						'refund_status' => $txn_status,
						'refund_message' => $refund_entity->payment_message,
						'refund_arn' => $refund_entity->acquirer_data->arn,
						'event_time' => $refund_entity->created_at,
						'db_update_data' => array($refund_entity)
					);
		}else{
			return false;
		}
		
	}

	static public function my_refund_status($status){
		$status_array = array(
							'pending' => 'pending',
							'processed' => 'success',
							'failed' => 'failed'						
						);
		return $status_array[$status];

	}

	static public function my_refund_status_msg($status){
		$status_array = array(
							'pending' => 'Transaction is under process',
							'processed' => 'Transaction is successful',
							'failed' => 'Transaction is failed',
							'success' => 'Transaction is successful'
						);
		return $status_array[$status];

	}

}