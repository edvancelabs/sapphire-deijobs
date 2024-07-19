<?php
/**
 * CityPay uses checksum signature to ensure that API requests and responses shared between your 
 * application and CityPay over network have not been tampered with. We use SHA256 hashing and 
 * AES128 encryption algorithm to ensure the safety of transaction data.
 *
 */

class Nimbbl{

	// ["SUCCESS", "NOT_ATTEMPTED", "FAILED", "USER_DROPPED", "VOID", "CANCELLED", "PENDING"]

	private static $pg_config = array(
		'prod' => array(
					'key'=>'access_key_mnk0RpgbKzARbvbX',
					'secret'=>'access_secret_BrQv9eO8ee2NDvzg',
					'host'=>'https://api.nimbbl.tech/api/v2/'
				),
		'test' => array(
					'key'=>'access_key_BmO74lMr8jX2O7qx',
					'secret'=>'access_secret_RoQ7Z52BEDBWA0rg',
					'host'=>'https://api.nimbbl.tech/api/v2/'
				)
		);

	private static $env;

	public function __construct(){
		// Check compat first
		$ci =& get_instance();
		self::$env = $ci->config->item('pg_env');
	}

	
	static public function create_order($data) {

		$path = 'create-order';
		$post_data = array(
						'amount_before_tax' => $data['amount'],
						'callback_mode' => 'callback_url_noredirect',
						// 'callback_url' => '',
						"currency" => "INR",
						"invoice_id" => $data['m_ref_id'],
						"tax" => 0,

						'user'=>array(
							'first_name'=>$data['customer_firstname'],
							'last_name'=>$data['customer_lastname'],
							'email'=>$data['customer_email'],
							'mobile_number'=>$data['customer_phone']
						),
						'total_amount' => $data['amount']
					);

		$res = self::post_data($post_data,$path);

		if($res){
			$rdata = json_decode($res);
			if(@$rdata->order_id){
				return array('1','success',$res);
			}else{
				return array('0',$rdata->error->message,$res);
			}
		}else{
			return array('0','something went wrong. try again','{"message":"something went wrong. try again"}');
		}
	}

	static public function create_payment($data,$order_data){
// upi://pay?pa=upi@razopay&pn=BIGITALTECHNOLOGIESPRIVATELIMITED&tr=WzBQKZQI9QRhJUZ&tn=razorpay&am=2.2&cu=INR&mc=5411
		$path = 'payment';

		$order_pg_data = json_decode($order_data->pg_res_data);
		$post_data = array(
						'payment_mode'=>'UPI',
						'flow'=>'intent',
						'order_id'=> $order_pg_data->order_id
					);


		$header_data = array(
							'x-nimbbl-key: '.$order_pg_data->sub_merchant->sub_merchant_id,
							'x-nimbbl-user-token: '.$order_pg_data->user->token
						);

		$res = self::post_data($post_data,$path,$header_data);

		if($res){
			$rdata = json_decode($res);
			if(@$rdata->order_id){
				return array('1',$rdata->extra_info->data->redirectUrl,$res);
			}else{
				return array('0',$rdata->error->message,$res);
			}
		}else{
			return array('0','something went wrong. try again','{"message":"something went wrong. try again"}');
		}

	}

	static public function payment_status($orderid,$txn_data){		
		if($txn_data->txn_status == "pending" || $txn_data->txn_status == "failed"){

			$path = 'transaction-enquiry';

			$txn_pg_data = json_decode($txn_data->pg_res_data);
			$post_data = array(
							'payment_mode'=>'UPI',
							'transaction_id'=>(@$txn_pg_data->transaction_id?$txn_pg_data->transaction_id:$txn_pg_data->nimbbl_transaction_id),
							'order_id'=> (@$txn_pg_data->order_id?$txn_pg_data->order_id:$txn_pg_data->nimbbl_order_id)
						);

			$res = self::post_data($post_data,$path);

			if($res){
				$rdata = json_decode($res);
				if(@$rdata->nimbbl_order_id){
                	$status = self::my_status($rdata->status);
                	if($status == $txn_data->txn_status){
                    	return array('2',$txn_data->txn_status,json_decode($txn_data->pg_res_data)->message);
                    }else{
                    	return array('1',$status,$res,$rdata->message);
                    }
				}else{
					return array('0',$rdata->error->message,$res);
				}
			}else{
				return array('0','something went wrong. try again','{"message":"something went wrong. try again"}');
			}

		}else{
			return array('2',$txn_data->txn_status,json_decode($txn_data->pg_res_data)->message);
		}
		
	}

	static public function update_payment($txn_data){		
		if($txn_data->nimbbl_order_id){
			// $event_time = new DateTime($txn_data->event_time);
			$event_time = '';

			return  array(
						'mtxnid' => $txn_data->order->invoice_id,
						'txn_status' => self::my_status($txn_data->status),
						'txn_message' => $txn_data->message,
						'bank_refrence' => $txn_data->transaction->psp_transaction_id,
						'event_time' => $event_time,
						'db_update_data' => $txn_data
					);
		}else{
			return false;
		}
		
	}

	static public function update_refund($txn_data){		
		if($txn_data->nimbbl_order_id){
			$event_time = '';
			return  array(
						'mtxnid' => $txn_data->order->invoice_id,
						'refund_status' => self::my_status($txn_data->status),
						'refund_message' => $txn_data->message,
						'refund_arn' => $txn_data->transaction->refund_arn,
						'event_time' => $event_time,
						'db_update_data' => $txn_data
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
							'captured' => 'success',
							'succeeded' => 'success' 
						);
		return $status_array[$status];

	}

	static public function create_refund($post,$txn_data_db){				
			$path = 'refund';

			$txn_data = json_decode($txn_data_db->pg_res_data);			
			$post_data = array(
							'refund_amount'=>$post['refund_amount'],
							'transaction_id'=>$txn_data->nimbbl_transaction_id,
							'order_id'=>$txn_data->nimbbl_order_id
						);

			$res = self::post_data($post_data,$path);

			if($res){
				$rdata = json_decode($res);
				if(@$rdata->id){
					$rdata->txn_order_id = $txn_data->nimbbl_order_id;
					return array('1',self::my_status($rdata->status),json_encode($rdata),$rdata->extra_info->data->respMessage,$rdata->extra_info->data->lpTxnId);
				}else{
					return array('0',$rdata->error->message,$res);
				}
			}else{
				return array('0','something went wrong. try again','{"message":"something went wrong. try again"}');
			}		
		
	}

	static public function get_refund($refundid,$rfnd_txn_data){		
		if($rfnd_txn_data->txn_status == "pending"){
			$rfndtxn_pg_data = json_decode($rfnd_txn_data->pg_res_data);
		
			$path = 'order/fetch-refunds/'.$rfndtxn_pg_data->txn_order_id;
			$res = self::get_data($path);
			if($res){
				$rdata = json_decode($res);
				if(@$rdata->success == true){
					return array('1',self::my_status($rdata->refunds[0]->status),$res,$rdata->refunds[0]->nimbbl_consumer_message,$rdata->refunds[0]->refund_arn);
				}else{
					return array('0',$rdata->message,$res);
				}
			}else{
				return array('0','something went wrong. try again','{"message":"something went wrong. try again"}');
			}
		}else{
			$txn_pg_data = json_decode($rfnd_txn_data->pg_res_data);
			return array('2',$rfnd_txn_data->txn_status,$txn_pg_data->refunds[0]->nimbbl_consumer_message,$txn_pg_data->refunds[0]->refund_arn);
		}
		
	}

	static private function post_data($post_data,$path,$header_data=false){
		// $post_data['cf_order_id'] = "1231231231312";
		// return json_encode($post_data);

		// $env = $this->config->item('pg_env');
		$creds = self::$pg_config[self::$env];


		$header= array(
				    'Authorization: Bearer '.self::get_auth_token(),
				    'Content-Type: application/json'
				);
		if($header_data){
			$header = array_merge($header_data,$header);
		}

		$url = $creds['host'].$path;
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POST, true); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt( $ch, CURLOPT_HTTPHEADER, $header);		
		log_message("error", "Nimbbl Req ".$path." : ".json_encode($post_data));
		//echo $data;
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
		$resp = curl_exec($ch);
		curl_close($ch);
		log_message("error", "Nimbbl res ".$path." : ".$resp);
		return $resp;
	}

	static private function get_data($path){
		$creds = self::$pg_config[self::$env];


		$header= array(
				    'Authorization: Bearer '.self::get_auth_token(),
				    'Content-Type: application/json'
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
		log_message("error", "Nimbbl res ".$path." : ".$resp);
		curl_close($ch);
		return $resp;
	}

	static public function get_auth_token(){

		$file_name = APPPATH.'libraries/nimbbl_token.txt';
		$token = file_get_contents($file_name);

		if($token){
			$token = explode('###', $token);
			$expiry = $token[1];

			$now = gmdate('Y-m-d H:i:s', strtotime("+2 min"));		
			$expiry = (new DateTime($expiry))->format('Y-m-d H:i:s');
			// echo $now."<br>".$expiry;
			if($now <= $expiry){
				return $token[0];
			}
		}

		$creds = self::$pg_config[self::$env];


		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://api.nimbbl.tech/api/v2/generate-token',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS =>'{"access_key": "'.$creds['key'].'","access_secret": "'.$creds['secret'].'"}',
		  CURLOPT_HTTPHEADER => array(
		    'Content-Type: application/json'
		  ),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		// echo $response;

		$data = json_decode($response);
		if($data->token){
			file_put_contents($file_name, $data->token."###".$data->expires_at);
			return $data->token;
		}else{
			return false;
		}


	}
	

}