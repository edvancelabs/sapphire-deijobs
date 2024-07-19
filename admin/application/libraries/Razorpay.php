<?php
/**
 * CityPay uses checksum signature to ensure that API requests and responses shared between your 
 * application and CityPay over network have not been tampered with. We use SHA256 hashing and 
 * AES128 encryption algorithm to ensure the safety of transaction data.
 *
 */
require_once APPPATH.'libraries/razorpay/Razorpay.php';
use Razorpay\Api\Api;
use Razorpay\Api\Errors;

class razorpay{


	private static $pg_config = array(
		'prod' => array(
					'key'=>'rzp_live_oodGu7ciHAM0Dd',
					'secret'=>'WGZERnKpnpXr06JHdB1eKFhG'
				),
		'test' => array(
					'key'=>'rzp_test_GIvR9HhLYQbCNL',
					'secret'=>'Z5rdaPi0hJdteR51iufqF28Y'
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
		$api = new Api($creds['key'], $creds['secret']);


		try {
			$rdata = $api->order->create(array('receipt' => $data['m_ref_id'], 'amount' => $data['amount']*100, 'currency' => 'INR'));

			if($rdata){
				$res = json_encode($rdata->toArray());
				log_message("error", "Razorpay res create_order : ".$res);
				if(@$rdata->id){
					return array('1','success',$res);
				}
			}else{
				return array('0','something went wrong. try again','{"message":"something went wrong. try again"}');
			}
		} catch (Exception $e) {
			log_message("error", "Razorpay res create_order : ".$e->getMessage());
			return array('0',$e->getMessage(),'{"message":'.$e->getMessage().'}');
		}

		
	}

	static public function create_payment($data,$order_data){
		$creds = self::$pg_config[self::$env];
		$api = new Api($creds['key'], $creds['secret']);

		$o_data = json_decode($order_data->order_data);

		try {
			$rdata = $api->payment->createUpi(array(
						"amount" => $order_data->amount*100,
						"currency" => "INR",
						"order_id" => json_decode($order_data->pg_res_data)->id,
						"email" => $o_data->customer_email,
						"contact" => $o_data->customer_phone,
						"method" => "upi",
						"ip" => $data['user_ip'],
						"referer" => "http",
						"user_agent" => $data['user_agent'],
						"description" => $o_data->productinfo,
						"upi" => array("flow" => "intent"),
						"notes"=>array("txnid"=>$data['reference_id'])
					));
	

			if($rdata){
				$res = json_encode($rdata->toArray());
				log_message("error", "Razorpay res create_payment : ".$res);
				if(@$rdata->razorpay_payment_id){
					return array('1',$rdata->link,$res);
				}
			}else{
				return array('0','something went wrong. try again','{"message":"something went wrong. try again"}');
			}
		} catch (Exception $e) {
			log_message("error", "Razorpay res create_payment : ".$e->getMessage());
			return array('0',$e->getMessage(),'{"message":'.$e->getMessage().'}');						
		}

	}

	// upi://pay?pa=upi@razopay&pn=EZIPIKSERVICESPRIVATELIMITED&tr=FRvraxmlVRskIJW&tn=razorpay&am=12.2&cu=INR&mc=5411

	static public function update_payment($txn_data){	

		if($txn_data->payload->payment->entity->order_id){
			$payment_entity = $txn_data->payload->payment->entity;
			$txn_status = self::my_status($payment_entity->status);
			$payment_entity->payment_message = self::my_status_msg($txn_status);
			return  array(
						'mtxnid' => $payment_entity->notes->txnid,
						'txn_status' => $txn_status,
						'txn_message' => $payment_entity->payment_message,
						'bank_refrence' => $payment_entity->acquirer_data->rrn,
						'event_time' => $payment_entity->created_at,
						'db_update_data' => array($payment_entity)
					);
		}else{
			return false;
		}
		
	}

	static public function payment_status($orderid,$txn_data){		
		if($txn_data->txn_status == "pending" || $txn_data->txn_status == "failed"){
			$creds = self::$pg_config[self::$env];
			$api = new Api($creds['key'], $creds['secret']);

			try {
				if($txn_data->txn_status == "pending"){
					$paymentId = json_decode($txn_data->pg_res_data)->razorpay_payment_id;
				}else{
					$paymentId = json_decode($txn_data->pg_res_data)[0]->id;
				}
				
				$rdata = $api->payment->fetch($paymentId);

				if(@$rdata->id){					
					
					$rdata = (object) $rdata->toArray();
					$my_status = self::my_status($rdata->status);
					$rdata->payment_message = self::my_status_msg($my_status);
					$res = json_encode($rdata);
					log_message("error", "Razorpay res payment_status : ".$res);
					return array('1',$my_status,$res,$rdata->payment_message);					
				}

			} catch (Exception $e) {
				log_message("error", "Razorpay res payment_status : ".$e->getMessage());
				// return array('0',$e->getMessage(),'{"message":'.$e->getMessage().'}');
            	return array('2',$txn_data->txn_status,'');
			}

		}else{
			return array('2',$txn_data->txn_status,json_decode($txn_data->pg_res_data)[0]->payment_message);
		}
		
	}	

	static public function my_status($status){
		$status_array = array(
							'created' => 'pending',
							'authorized' => 'pending',
							'captured' => 'success',
							'refunded' => 'success',
							'failed' => 'failed'
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

	//TODO this is live working but for refund fix we have created new below this
	static public function create_refund_hack($post,$txn_data_db){	
		$post = (array)$post;
		$creds = self::$pg_config[self::$env];
		$api = new Api($creds['key'], $creds['secret']);

		$txn_data = json_decode($txn_data_db->pg_res_data)[0];

		try {
			$rdata = $api->payment->fetch($txn_data->id)->refund(array("amount"=> $post['refund_amount']*100, "speed"=>"normal", "receipt"=>$post['m_refund_id'],"notes"=>array("txnid"=>$post['m_refund_id'])));
	

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
			log_message("error", "Razorpay res create_refund : ".$e->getMessage());
			return array('0',$e->getMessage(),'{"message":'.$e->getMessage().'}');						
		}
		
	}
	static public function create_refund($post,$txn_data_db){	
		// $creds = self::$pg_config[self::$env];
		// $api = new Api($creds['key'], $creds['secret']);

		$txn_data = json_decode($txn_data_db->pg_res_data)[0];

		try {
			// $rdata = $api->payment->fetch($txn_data->id)->refund(array("amount"=> $post['refund_amount']*100, "speed"=>"normal", "receipt"=>$post['m_refund_id'],"notes"=>array("txnid"=>$post['m_refund_id'])));
	

			// if($rdata){
			// 	$res = json_encode($rdata->toArray());
			// 	log_message("error", "Razorpay res create_refund : ".$res);
			// 	if(@$rdata->id){
			// 		return array('1',self::my_refund_status($rdata->status),$res,self::my_refund_status_msg($rdata->status),$rdata->acquirer_data->rrn);
			// 	}
			// }else{
			// 	return array('0','something went wrong. try again','{"message":"something went wrong. try again"}');
			// }

			return array('1','pending',json_encode($post),'Transaction is under process','');



		} catch (Exception $e) {
			log_message("error", "Razorpay res create_refund : ".$e->getMessage());
			return array('0',$e->getMessage(),'{"message":'.$e->getMessage().'}');						
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

	static public function get_refund_hack($rfid,$txn_data){		
		
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