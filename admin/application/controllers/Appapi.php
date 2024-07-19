<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Appapi extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library('CityPayChecksum');
		$this->load->library('CityPayErrorCode');
		$this->load->helper('url');

	}

	
	// public function contacts($mkey){	
	// 	$data['code'] = 0;
	// 	if($mkey != ""){
 //        	$raw_req = file_get_contents('php://input');
 //        	log_message("error", "contacts: ".$raw_req);
	// 		$post = json_decode($raw_req, true);
        	
	// 		// print_r($post);exit;
	// 		$s = $post['signature'];
	// 		$n = $post['name'];
	// 		$e = $post['email'];
	// 		$c = $post['contact'];
	// 		$t = $post['type'];
	// 		$r = $post['reference_id'];
	// 		if($this->contact_validation($post)){
	// 			$mid = $this->GetVerifySignature($post,$s,$mkey);
	// 			if($mid){

	// 				$m_refid = CityPayChecksum::createMRefrenceID($mid,$r);
	// 				$query = $this->db->query('SELECT id FROM contacts where reference_id = "'.$m_refid.'"');

	// 				if($query->num_rows() == 0){
	// 					$this->db->trans_start();
	// 						$insert_data = array(
	// 									"reference_id"=>$m_refid,
	// 									"merchant_id"=>$mid,
	// 									"name"=>$n,
	// 									"email"=>$e,
	// 									"contact"=>$c,
	// 									"type"=>$t
	// 								);
						
	// 						$this->db->insert('contacts',$insert_data);	
	// 						// $this->callRazorPay();	
	// 					$this->db->trans_complete();

	// 					$query = $this->db->query('SELECT id FROM contacts where reference_id = "'.$m_refid.'"');
	// 					$newContact = $query->row();
	// 					$data['contact_id'] = sprintf("%010d", $newContact->id);
	// 					$data['code'] = 200;
	// 				}else{
	// 					$data['code'] = 104;
	// 				}
	// 			}else{
	// 				$data['code'] = 103;
	// 			}

	// 		}else{
	// 			$data['code'] = 102;
	// 		}


	// 	}else{
	// 		$data['code'] = 101;
	// 	}
	// 	$data['message'] = CityPayErrorCode::getErrorMessage($data['code']);
	// 	$json_res = json_encode($data);
 //    	log_message("error", "contacts response: ".$json_res);
	// 	$this->output->set_content_type('application/json')->set_status_header(200)->set_output($json_res);
		
	// }

	

	// public function contact_update($mkey){	

	// 	$data['code'] = 0;
	// 	if($mkey != ""){
	// 		$raw_req = file_get_contents('php://input');
 //        	log_message("error", "contact_update req: ".$raw_req);
	// 		$post = json_decode($raw_req, true);
	// 		// print_r($post);exit;
	// 		$s = $post['signature'];
	// 		$cid = $post['contact_id'];
	// 		$n = $post['name'];
	// 		$e = $post['email'];
	// 		$c = $post['contact'];
	// 		$t = $post['type'];
	// 		$r = $post['reference_id'];
	// 		if($this->contact_validation($post) && trim($cid) != ""){
	// 			$mid = $this->GetVerifySignature($post,$s,$mkey);
	// 			if($mid){
	// 				$m_refid = CityPayChecksum::createMRefrenceID($mid,$r);
	// 				$query = $this->db->query('SELECT id FROM contacts where reference_id = "'.$m_refid.'"');

	// 				if($query->num_rows() == 0){

	// 					$query = $this->db->query('SELECT id FROM contacts where id = '.$cid.' and merchant_id = '.$mid);
	// 					$isContact = $query->num_rows();

	// 					if($isContact){
	// 						$this->db->trans_start();
	// 							$update_data = array(
	// 										"reference_id"=>$m_refid,
	// 										"name"=>$n,
	// 										"email"=>$e,
	// 										"contact"=>$c,
	// 										"type"=>$t
	// 									);
	// 							$this->db->where('id',$cid);
	// 							$this->db->update('contacts',$update_data);	
	// 							// $this->callRazorPay();	
	// 						$this->db->trans_complete();
	// 						$data['contact_id'] = sprintf("%010d", $cid);
	// 						$data['code'] = 200;
	// 					}else{
	// 						$data['code'] = 105;
	// 					}

						
						
	// 				}else{
	// 					$data['code'] = 104;
	// 				}
	// 			}else{
	// 				$data['code'] = 103;
	// 			}

	// 		}else{
	// 			$data['code'] = 102;
	// 		}


	// 	}else{
	// 		$data['code'] = 101;
	// 	}
	// 	$data['message'] = CityPayErrorCode::getErrorMessage($data['code']);
	// 	$json_res = json_encode($data);
 //    	log_message("error", "contact_update response: ".$json_res);
	// 	$this->output->set_content_type('application/json')->set_status_header(200)->set_output($json_res);
	// }

	// public function contact_validation($post){
	// 	// var_dump($post);

	// 	if(trim($post['name']) == "" || strlen($post['name']) > 50 || !preg_match("/^[a-zA-Z- ']*$/", $post['name'])){
	// 		return false;
	// 	}

	// 	if(trim($post['email']) != "" && !filter_var($post['email'], FILTER_VALIDATE_EMAIL)){
	// 		return false;
	// 	}

	// 	if(!preg_match("/^[6-9][0-9]{9}$/", $post['contact'])){
	// 		return false;
	// 	}

	// 	if(!in_array($post['type'], array('vendor','customer','employee','self'))){
	// 		return false;
	// 	}

	// 	if(trim($post['reference_id']) == "" || strlen($post['reference_id']) > 38){
	// 		return false;
	// 	}
	// 	if(trim($post['signature']) == ""){
	// 		return false;
	// 	}


	// 	return true;


	// }


	// public function fund_accounts($mkey){
	// 	$data['code'] = 0;
	// 	if($mkey != ""){
	// 		$raw_req = file_get_contents('php://input');
 //        	log_message("error", "fund_accounts req: ".$raw_req);
	// 		$post = json_decode($raw_req, true);

	// 		// print_r($post);exit;
	// 		$s = $post['signature'];
	// 		$at = $post['account_type'];
	// 		$cid = $post['contact_id'];
	// 		// $vpa = $post['vpa'];
	// 		$r = $post['reference_id'];
	// 		if($this->fund_validation($post)){
	// 			$mid = $this->GetVerifySignature($post,$s,$mkey);
	// 			if($mid){

	// 				$m_refid = CityPayChecksum::createMRefrenceID($mid,$r);
	// 				$query = $this->db->query('SELECT id FROM fund_account where reference_id = "'.$m_refid.'"');

	// 				if($query->num_rows() == 0){

	// 					$isContact = $this->db->query('SELECT id FROM contacts where id = '.$cid.' and merchant_id = '.$mid) ;
	// 					if($isContact->num_rows() == 1){
	// 						if($at == "VPA"){
	// 							$ac_data = $post['vpa']['address'];
	// 						}else{
	// 							$ac_data = json_encode($post['bank_account']);
	// 						}

	// 						$this->db->trans_start();
	// 							$insert_data = array(
	// 										"reference_id"=>$m_refid,
	// 										"contact_id"=>$cid,
	// 										"account_type"=>$at,
	// 										"account_details"=>$ac_data
	// 									);
							
	// 							$this->db->insert('fund_account',$insert_data);	
	// 							// $this->callRazorPay();	
	// 						$this->db->trans_complete();

	// 						$query = $this->db->query('SELECT id FROM fund_account where reference_id = "'.$m_refid.'"');
	// 						$newFa = $query->row();
	// 						$data['fund_account_id'] = sprintf("%010d", $newFa->id);
	// 						$data['code'] = 200;
	// 					}else{
	// 						$data['code'] = 105;
	// 					}
	// 				}else{
	// 					$data['code'] = 104;
	// 				}
	// 			}else{
	// 				$data['code'] = 103;
	// 			}

	// 		}else{
	// 			$data['code'] = 102;
	// 		}


	// 	}else{
	// 		$data['code'] = 101;
	// 	}
	// 	$data['message'] = CityPayErrorCode::getErrorMessage($data['code']);
	// 	$json_res = json_encode($data);
 //    	log_message("error", "fund_accounts response: ".$json_res);
	// 	$this->output->set_content_type('application/json')->set_status_header(200)->set_output($json_res);

	// }

	// public function fund_validation($post){

	// 	if(trim($post['signature']) == ""){
	// 		return false;
	// 	}

	// 	if(!in_array($post['account_type'], array('VPA','BANK'))){
	// 		return false;
	// 	}

	// 	if(trim($post['contact_id']) == ""){
	// 		return false;
	// 	}

	// 	if($post['account_type'] == "VPA"){
	// 		if(!is_array(@$post['vpa']) ||trim(@$post['vpa']['address']) == "" || !preg_match("/^[a-zA-Z0-9.-]{2,256}@[a-zA-Z][a-zA-Z]{2,64}$/",@$post['vpa']['address'])){
	// 			return false;
	// 		}
	// 	}elseif ($post['account_type'] == "BANK"){
	// 		if(
	// 			!is_array(@$post['bank_account']) 
	// 			|| trim(@$post['bank_account']['account_name']) == "" 
	// 			|| trim(@$post['bank_account']['ifsc']) == "" 
	// 			|| trim(@$post['bank_account']['account_number']) == "" 
	// 			|| trim(@$post['bank_account']['bank_name']) == "" 
	// 			|| !preg_match("/^[a-zA-Z0-9]*$/",@$post['bank_account']['account_number']) 
	// 			|| !preg_match("/^[a-zA-Z ']*$/",@$post['bank_account']['account_name'] ) 
	// 			|| !preg_match("/^[a-zA-Z ]*$/",@$post['bank_account']['bank_name'] )
	// 			|| !preg_match("/^[a-zA-Z0-9]{11}$/",@$post['bank_account']['ifsc'])				
	// 		){
				
	// 			return false;
	// 		}
	// 	}



	// 	if(trim($post['reference_id']) == "" || strlen($post['reference_id']) > 38){
	// 		return false;
	// 	}	

	// 	return true;


	// }



	// public function payouts($mkey){
	// 	$data['code'] = 0;
	// 	if($mkey != ""){
	// 		$raw_req = file_get_contents('php://input');
 //        	log_message("error", "payouts req: ".$raw_req);
	// 		$post = json_decode($raw_req, true);

	// 		$s = $post['signature'];
	// 		$fid = $post['fund_account_id'];
	// 		$amt = $post['amount'];
	// 		$p = $post['purpose'];
	// 		$n = $post['narration'];
	// 		$r = $post['reference_id'];
	// 		if($this->payout_validation($post)){
	// 			$mid = $this->GetVerifySignature($post,$s,$mkey);
	// 			if($mid){

	// 				$m_refid = CityPayChecksum::createMRefrenceID($mid,$r);
	// 				$query = $this->db->query('SELECT id FROM payout_txn where reference_id = "'.$m_refid.'"');

	// 				if($query->num_rows() == 0){

	// 					$isFund = $this->db->query('SELECT f.id FROM fund_account f left join contacts c on f.contact_id = c.id where f.id = '.$fid.' and c.merchant_id = '.$mid) ;
	// 					if($isFund->num_rows() == 1){

	// 						$this->db->trans_start();
	// 							unset($post['signature']);
	// 							$insert_data = array(
	// 										"merchant_id"=>$mid,
	// 										"fund_account_id"=>$fid,
	// 										"amount"=>$amt,
	// 										"settlement_status"=>"pending",
	// 										"mer_req_data"=>json_encode($post),
	// 										"reference_id"=>$m_refid
	// 									);
							
	// 							$this->db->insert('payout_txn',$insert_data);	
	// 							// $this->callRazorPay();	
	// 						$this->db->trans_complete();


	// 						$data['fund_account_id'] = $fid;
	// 						$data['status'] = "pending";
	// 						$data['status_details'] = array("description"=>"This transaction will be processed in next batch");							
	// 						$data['code'] = 200;
							
	// 					}else{
	// 						$data['code'] = 106;
	// 					}
	// 				}else{
	// 					$data['code'] = 104;
	// 				}
	// 			}else{
	// 				$data['code'] = 103;
	// 			}

	// 		}else{
	// 			$data['code'] = 102;
	// 		}

	// 	}else{
	// 		$data['code'] = 101;
	// 	}
	// 	$data['message'] = CityPayErrorCode::getErrorMessage($data['code']);
	// 	$data['signature'] = $this->GetSignature($data,$mkey);

	// 	$json_res = json_encode($data);
 //    	log_message("error", "payouts response: ".$json_res);
	// 	$this->output->set_content_type('application/json')->set_status_header(200)->set_output($json_res);

		
	// }


	// public function payout_validation($post){

	// 	if(trim($post['signature']) == ""){
	// 		return false;
	// 	}

	// 	if(trim($post['fund_account_id']) == ""){
	// 		return false;
	// 	}

	// 	if($post['amount'] < 100){
	// 		return false;
	// 	}

	// 	if(!in_array($post['purpose'], array('refund', 'cashback', 'payout', 'salary', 'utility bill', 'vendor bill'))){
	// 		return false;
	// 	}

	// 	if(trim($post['narration']) == "" || strlen($post['narration']) > 30 || preg_match("/([%\$#\*]+)/", $post['narration'])){
	// 		return false;
	// 	}


	// 	if(trim($post['reference_id']) == "" || strlen($post['reference_id']) > 38){
	// 		return false;
	// 	}
		
	// 	return true;


	// }



	// public function payoutTxnStatus($mkey){
	// 	$data['code'] = 0;
	// 	if($mkey != ""){
	// 		$raw_req = file_get_contents('php://input');
 //        	log_message("error", "payoutTxnStatus req: ".$raw_req);
	// 		$post = json_decode($raw_req, true);

	// 		$s = $post['signature'];	
	// 		$r = $post['reference_id'];
	// 		if($s != "" && $r !=""){
	// 			$mid = $this->GetVerifySignature($post,$s,$mkey);
	// 			if($mid){
	// 				$m_refid = CityPayChecksum::createMRefrenceID($mid,$r);
					
	// 				$query = $this->db->query('SELECT settlement_status, pg_res_data FROM payout_txn where reference_id = "'.$m_refid.'"');



	// 				if($query->num_rows() == 1){
	// 						$res = $query->row();

	// 						$data['reference_id'] = $r;
	// 						$data['status'] = $res->settlement_status;
	// 						$data['status_details'] = array("description"=>CityPayErrorCode::getStatusMessage($res->settlement_status));	

	// 						if($res->pg_res_data){
	// 							$data['status_details']['utr'] = json_decode($res->pg_res_data)->utr;
	// 						}
	// 						$data['code'] = 200;
						
	// 				}else{
	// 					$data['code'] = 107;
	// 				}
	// 			}else{
	// 				$data['code'] = 103;
	// 			}

	// 		}else{
	// 			$data['code'] = 102;
	// 		}

	// 	}else{
	// 		$data['code'] = 101;
	// 	}
	// 	$data['message'] = CityPayErrorCode::getErrorMessage($data['code']);
	// 	$data['signature'] = $this->GetSignature($data,$mkey);

	// 	$json_res = json_encode($data);
 //    	log_message("error", "payoutTxnStatus response: ".$json_res);
	// 	$this->output->set_content_type('application/json')->set_status_header(200)->set_output($json_res);
	// }




	public function GetVerifySignature($postParams,$postSignature,$mkey){
		
		unset($postParams['signature']);
		$this->db->select(array('merchant_secret','merchant_id'));
		$this->db->where('merchant_key',$mkey);
		$a = $this->db->get('merchant_details')->row();
		// print_r($a);

		if($a && CityPayChecksum::verifySignature(json_encode($postParams, JSON_UNESCAPED_SLASHES), $a->merchant_secret, $postSignature)){
				return $a->merchant_id;
		}		
		return false;
	}

	public function GetSignature($postParams,$mkey){
		
		unset($postParams['signature']);
		$this->db->select(array('merchant_secret','merchant_id'));
		$this->db->where('merchant_key',$mkey);
		$a = $this->db->get('merchant_details')->row();

		return CityPayChecksum::generateSignature(json_encode($postParams, JSON_UNESCAPED_SLASHES), $a->merchant_secret);
	
		
		
		// return false;
	}

	public function callRazorPay(){
		throw new Exception('Exception message');
	}

	


    //////// payIN //////////

    public function get_pgcode($amt=0){
    	// $pg_array = array(
    	// //'0' => 'cashfree', 
    	// '1' => 'cashfree', 
    	// '2' => 'razorpay', 
    	// '3' => 'paytm', 
    	// //'4'=>'paytm',
    	// // '5'=>'paytm'
    	// );
    	// $random_key = array_rand($pg_array,1);
    	// //decide which PG to use
    	// // if($_SERVER['REMOTE_ADDR'] == '115.96.218.25'){
    	// // return 'paytm';
    	// // }
    	// return $pg_array[$random_key];
    
    	return 'cashfree';
    	return 'billdesk';
    	return 'easebuzz';
    	return 'nimbbl';
    
        $pg_array = array('cashfree','razorpay','paytm','cashfree','paytm','razorpay');
        // $pg_array = array('cashfree','paytm');
		$file_name = APPPATH.'libraries/pg_code.txt';
		$i = file_get_contents($file_name);

		if($i < (count($pg_array)-1)){
     		$i = $i+1;
		}else{
    		$i = 0;
		}
		file_put_contents($file_name, $i);
		return $pg_array[$i];

    }

    public function order($mkey){
    	$data['code'] = 0;
		if($mkey != ""){
			// $post = json_decode(file_get_contents('php://input'), true);
            $raw_req = file_get_contents('php://input');
        	log_message("error", "order req: ".$raw_req);
			$post = json_decode($raw_req, true);
			
			if($this->order_validate($post)){
				$mid = $this->GetVerifySignature($post,$post['signature'],$mkey);
				if($mid){				

					$m_refid = CityPayChecksum::createMRefrenceID($mid,$post['txnid']);
					$query = $this->db->query('SELECT id FROM orders where reference_id = "'.$m_refid.'"');

					if($query->num_rows() == 0){
						$pgcode = $this->get_pgcode($post['amount']);

						$this->db->trans_begin();
							unset($post['signature']);
							$insert_data = array(
										"merchant_id"=>$mid,
										"amount"=>$post['amount'],
										"order_data"=>json_encode($post),
										"reference_id"=>$m_refid,
										"pg_code"=>$pgcode,
										"date_added"=>date('Y-m-d H:i:s')
									);

							$post['m_ref_id'] = $m_refid;
						
							$this->db->insert('orders',$insert_data);
							$response = $this->create_order($post,$pgcode);	
							if(!$response[0]){
								$this->db->trans_rollback();
								$data['code'] = 801;
								$data['error'] = $response[1];								
							}else{
								$this->db->where('reference_id',$m_refid);
								$this->db->update('orders',array('pg_res_data'=>$response[2]));
								$this->db->trans_complete();
								$data['code'] = 200;
								$data['txnid'] = $post['txnid'];
								$data['status'] = $response[1];							
							}
													
							
					}else{
						$data['code'] = 104;
					}
				}else{
					$data['code'] = 103;
				}

			}else{
				$data['code'] = 102;
			}

		}else{
			$data['code'] = 101;
		}
		$data['message'] = CityPayErrorCode::getErrorMessage($data['code']);
		$data['signature'] = $this->GetSignature($data,$mkey);

    	$json_res = json_encode($data);
    	log_message("error", "Order res: ".$json_res);
		$this->output->set_content_type('application/json')->set_status_header(200)->set_output($json_res);
    }

    public function payment($mkey){
    	$data['code'] = 0;
		if($mkey != ""){
			$raw_req = file_get_contents('php://input');
        	log_message("error", "payment req: ".$raw_req);
			$post = json_decode($raw_req, true);
			
			if($this->pay_validate($post)){
				$mid = $this->GetVerifySignature($post,$post['signature'],$mkey);
				if($mid){				

					$m_refid = CityPayChecksum::createMRefrenceID($mid,$post['txnid']);
					$query = $this->db->query('SELECT * FROM orders where reference_id = "'.$m_refid.'"');

					if($query->num_rows() == 1){
						$order_data = $query->row();

						
						$pgcode = $order_data->pg_code;
						$this->db->trans_begin();
							unset($post['signature']);
							$query2 = $this->db->query('SELECT id FROM payin_txn where reference_id = "'.$m_refid.'"');


							$insert_data = array(
										"merchant_id"=>$mid,
										"amount"=>$order_data->amount,
										"mer_req_data"=>json_encode($post),
										"reference_id"=>$order_data->reference_id,
										"pg_code"=>$pgcode,
										"order_id"=>$order_data->id,
										"date_added"=>date('Y-m-d H:i:s')
									);

							if($query2->num_rows() == 0){
								$this->db->insert('payin_txn',$insert_data);				
							}else{
								$this->db->where('reference_id',$m_refid);
								$this->db->update('payin_txn',$insert_data);				
							}
						
							$post['reference_id'] = $m_refid;
							
							$response = $this->create_payment($post,$order_data,$pgcode);


							if(!$response[0]){
								$this->db->trans_rollback();
								$data['code'] = 801;
								$data['error'] = $response[1];								
							}else{
								$this->db->where('reference_id',$m_refid);
								$this->db->update('payin_txn',array('pg_res_data'=>$response[2]));
								$this->db->trans_complete();
								$data['code'] = 200;
								$data['txnid'] = $post['txnid'];
								$data['uri'] = $response[1];							
							}
													
							
					}else{
						$data['code'] = 108;
					}
				}else{
					$data['code'] = 103;
				}

			}else{
				$data['code'] = 102;
			}

		}else{
			$data['code'] = 101;
		}
		$data['message'] = CityPayErrorCode::getErrorMessage($data['code']);
		$data['signature'] = $this->GetSignature($data,$mkey);

		$json_res = json_encode($data);
    	log_message("error", "Order res: ".$json_res);
		$this->output->set_content_type('application/json')->set_status_header(200)->set_output($json_res);
    }

    public function txnStatus($mkey){
		$data['code'] = 0;
		if($mkey != ""){
			$raw_req = file_get_contents('php://input');
        	log_message("error", "txnStatus req: ".$raw_req);
			$post = json_decode($raw_req, true);
			// print_r($post);
			if(trim($post['txnid']) != "" && trim($post['signature']) != ""){
				$mid = $this->GetVerifySignature($post,$post['signature'],$mkey);
				if($mid){

					$m_refid = CityPayChecksum::createMRefrenceID($mid,$post['txnid']);
					$query = $this->db->query('SELECT txn_status, pg_res_data, pg_code FROM payin_txn where reference_id = "'.$m_refid.'"');

					if($query->num_rows() == 1){
						$db_data = $query->row();
						$data['code'] = 200;
						$data['txnid'] = $post['txnid'];

						$res_data = $this->get_payment_status($m_refid,$db_data);

						if($res_data[0] == '1'){
							if($res_data[1] != 'pending'){
								$this->db->where('reference_id',$m_refid);
								$this->db->update('payin_txn',array('txn_status'=>$res_data[1],'pg_res_data'=>$res_data[2]));
								
								$data['payment_status'] = $res_data[1];
								$data['payment_message'] = $res_data[3];
							}else{
								$data['payment_status'] = 'pending';
								$data['payment_message'] = 'Transaction is pending';
							}

						}elseif ($res_data[0] == '2') {
							$data['payment_status'] = $res_data[1];
							$data['payment_message'] = $res_data[2];
						}else{
							$data['code'] = 801;
							$data['error'] = $res_data[1];
						}

					}else{
						$data['code'] = 107;
					}
				}else{
					$data['code'] = 103;
				}

			}else{
				$data['code'] = 102;
			}

		}else{
			$data['code'] = 101;
		}
		$data['message'] = CityPayErrorCode::getErrorMessage($data['code']);
		$data['signature'] = $this->GetSignature($data,$mkey);

		$json_res = json_encode($data);
		log_message("error", "TxnStatus res: ".$json_res);
		$this->output->set_content_type('application/json')->set_status_header(200)->set_output($json_res);
		

	}

	

	public function refund($mkey){
    	$data['code'] = 0;
		if($mkey != ""){
			$raw_req = file_get_contents('php://input');
        	log_message("error", "refund req: ".$raw_req);
			$post = json_decode($raw_req, true);
			
			if($this->refund_validate($post)){
				$mid = $this->GetVerifySignature($post,$post['signature'],$mkey);
				if($mid){				

					$m_refid = CityPayChecksum::createMRefrenceID($mid,$post['txnid']);
					$query = $this->db->query('SELECT * FROM payin_txn where reference_id = "'.$m_refid.'"');

					$payment_data = $query->row();

					if($query->num_rows() == 1 && $payment_data->txn_status == "success"){
						if($post['refund_amount'] <= $payment_data->amount){
							$m_refund_id = CityPayChecksum::createMRefrenceID($mid,$post['refund_txnid']);
							$query2 = $this->db->query('SELECT id FROM refund_txn where reference_id = "'.$m_refund_id.'" or payment_id = "'.$payment_data->id.'"');

							if($query2->num_rows() == 0){							
								$pgcode = $payment_data->pg_code;
								$this->db->trans_begin();
								unset($post['signature']);
								$insert_data = array(
											"merchant_id"=>$mid,
											"pg_code"=>$pgcode,
											"amount"=>$post['refund_amount'],
											"mer_req_data"=>json_encode($post),
											"reference_id"=>$m_refund_id,	
											"payment_id"=>$payment_data->id,
											"date_added"=>date('Y-m-d H:i:s')
										);
								$this->db->insert('refund_txn',$insert_data);
								$post['m_refund_id'] = $m_refund_id;
								$response = $this->create_refund($post,$payment_data,$pgcode);


								if(!$response[0]){
									$this->db->trans_rollback();
									$data['code'] = 801;
									$data['error'] = $response[1];								
								}else{
									$this->db->where('reference_id',$m_refund_id);
									$this->db->update('refund_txn',array('txn_status'=>$response[1],'pg_res_data'=>$response[2]));
									$this->db->trans_complete();
									$data['code'] = 200;
									$data['refund_txnid'] = $post['refund_txnid'];
									$data['refund_status'] = $response[1];	
									$data['refund_description'] = $response[3];		
									$data['refund_arn'] = $response[4];		
								}
							}else{
								$data['code'] = 110;
							}
						}else{
							$data['code'] = 111;
						}
					}else{
						$data['code'] = 109;
					}
				}else{
					$data['code'] = 103;
				}

			}else{
				$data['code'] = 102;
			}

		}else{
			$data['code'] = 101;
		}
		$data['message'] = CityPayErrorCode::getErrorMessage($data['code']);
		$data['signature'] = $this->GetSignature($data,$mkey);

		$json_res = json_encode($data);
    	log_message("error", "Refund res: ".$json_res);
		$this->output->set_content_type('application/json')->set_status_header(200)->set_output($json_res);
    }

    public function refundStatus($mkey){
		$data['code'] = 0;
		if($mkey != ""){
			$post = json_decode(file_get_contents('php://input'), true);
			if(trim($post['refund_txnid']) != "" && trim($post['signature']) != ""){
				$mid = $this->GetVerifySignature($post,$post['signature'],$mkey);
				if($mid){

					$m_refid = CityPayChecksum::createMRefrenceID($mid,$post['refund_txnid']);
					$query = $this->db->query('SELECT * FROM refund_txn where reference_id = "'.$m_refid.'"');

					if($query->num_rows() == 1){
						$db_data = $query->row();
						$data['code'] = 200;
						$data['refund_txnid'] = $post['refund_txnid'];

						$res_data = $this->get_refund_status($m_refid,$db_data);

						if($res_data[0] == '1'){
							if($res_data[1] != 'pending'){
								$this->db->where('reference_id',$m_refid);
								$this->db->update('refund_txn',array('txn_status'=>$res_data[1],'pg_res_data'=>$res_data[2]));
								
								$data['refund_status'] = $res_data[1];
								$data['refund_message'] = $res_data[3];
								$data['refund_arn'] = $res_data[4];
							}else{
								$data['refund_status'] = 'pending';
								$data['refund_message'] = 'Transaction is pending';
							}

						}elseif ($res_data[0] == '2') {
							$data['refund_status'] = $res_data[1];
							$data['refund_message'] = $res_data[2];
							$data['refund_arn'] = $res_data[3];
						}else{
							$data['code'] = 801;
							$data['error'] = $res_data[1];
						}

					}else{
						$data['code'] = 107;
					}
				}else{
					$data['code'] = 103;
				}

			}else{
				$data['code'] = 102;
			}

		}else{
			$data['code'] = 101;
		}
		$data['message'] = CityPayErrorCode::getErrorMessage($data['code']);
		$data['signature'] = $this->GetSignature($data,$mkey);

		$this->output->set_content_type('application/json')->set_status_header(200)->set_output(json_encode($data));
	}

	public function get_refund_status($rfnd_txnid,$rfnd_db_data){		
    	$this->load->library($rfnd_db_data->pg_code);
		return $rfnd_db_data->pg_code::get_refund($rfnd_txnid,$rfnd_db_data);		
    }


    public function create_refund($post,$order_data,$pgcode){
    	$this->load->library($pgcode);
    	if($pgcode == "phonepe"){
    		$this->db->select('order_data');
    		$this->db->where('id',$order_data->order_id);
    		$o_data = $this->db->get('orders')->row();
    		$order_data->merchantUserId = json_decode($o_data->order_data)->customer_id;
    	}
		return $pgcode::create_refund($post,$order_data);
    }


	public function get_payment_status($txnid,$db_data){		
    	$this->load->library($db_data->pg_code);
		return $db_data->pg_code::payment_status($txnid,$db_data);		
    }

    
    public function create_payment($post,$order_data,$pgcode){
    	$this->load->library($pgcode);
		return $pgcode::create_payment($post,$order_data);
    }

    public function create_order($post,$pgcode){
    	$this->load->library($pgcode);
		return $pgcode::create_order($post);
    }



    
    public function pay_validate($post){
		$required_param = array('txnid','user_ip','user_agent');

		foreach ($required_param as $key => $value) {

			if(trim(@$post[$value]) == ""){				
				return false;
			}
		}

		if(trim($post['user_ip']) != "" && !filter_var($post['user_ip'], FILTER_VALIDATE_IP)){
			return false;
		}

		if(strlen($post['txnid']) > 38){
			return false;
		}

		
		return true;
	}
    

    public function order_validate($post){
		$required_param = array('txnid','amount','customer_id','customer_firstname','customer_lastname','customer_email','customer_phone','productinfo');

		foreach ($required_param as $key => $value) {

			if(trim(@$post[$value]) == ""){				
				return false;
			}
		}

		if(trim($post['customer_email']) != "" && !filter_var($post['customer_email'], FILTER_VALIDATE_EMAIL)){
			return false;
		}

		if(trim($post['customer_phone']) != "" && !preg_match("/^[6-9][0-9]{9}$/", $post['customer_phone'])){
			return false;
		}

		if(strlen($post['productinfo']) > 50){
			return false;
		}

		if(strlen($post['txnid']) > 38){
			return false;
		}

		
		return true;
	}

	public function refund_validate($post){
		$required_param = array('txnid','refund_amount','refund_txnid','signature');

		foreach ($required_param as $key => $value) {

			if(trim(@$post[$value]) == ""){				
				return false;
			}
		}

		if(strlen($post['txnid']) > 38){
			return false;
		}

		if(strlen($post['refund_txnid']) > 38){
			return false;
		}

		
		return true;
	}


	


























///////////old//////////////////////


	// public function payin_upi($mkey){
	// 	$data['code'] = 0;
	// 	if($mkey != ""){
	// 		$post = json_decode(file_get_contents('php://input'), true);
			
	// 		if($this->payment_validate($post)){
	// 			$mid = $this->GetVerifySignature($post,$post['signature'],$mkey);
	// 			if($mid){
	// 				$post['pg'] = "UPI";

	// 				$m_refid = CityPayChecksum::createMRefrenceID($mid,$post['txnid']);
	// 				$query = $this->db->query('SELECT id FROM payin_txn where reference_id = "'.$m_refid.'"');

	// 				if($query->num_rows() == 0){
	// 					$this->db->trans_begin();
	// 						unset($post['signature']);
	// 						$insert_data = array(
	// 									"merchant_id"=>$mid,
	// 									"amount"=>$post['amount'],
	// 									"mer_req_data"=>json_encode($post),
	// 									"reference_id"=>$m_refid
	// 								);
						
	// 						$this->db->insert('payin_txn',$insert_data);
	// 						$response = $this->payu_payment($post,$mid);	
	// 						// print_r($response);
							
	// 						if(!$response[0]){
	// 							$data['code'] = 801;
	// 							$this->db->trans_rollback();
	// 						}else{
	// 							$data['code'] = 200;
	// 							if(@$response[1]->intentURIData){
	// 								$data['intent_uri_data'] = $response[1]->intentURIData;
	// 							}								
	// 							$this->db->trans_complete();
	// 							$data['status'] = $response[1]->status;							
	// 						}
													
							
	// 				}else{
	// 					$data['code'] = 104;
	// 				}
	// 			}else{
	// 				$data['code'] = 103;
	// 			}

	// 		}else{
	// 			$data['code'] = 102;
	// 		}

	// 	}else{
	// 		$data['code'] = 101;
	// 	}
	// 	$data['message'] = CityPayErrorCode::getErrorMessage($data['code']);
	// 	$data['signature'] = $this->GetSignature($data,$mkey);

	// 	$this->output->set_content_type('application/json')->set_status_header(200)->set_output(json_encode($data));
		
	// }

	// public function payment_status($mkey){
	// 	$data['code'] = 0;
	// 	if($mkey != ""){
	// 		$post = json_decode(file_get_contents('php://input'), true);
	// 		if(trim($post['txnid']) != "" && trim($post['signature']) != ""){
	// 			$mid = $this->GetVerifySignature($post,$post['signature'],$mkey);
	// 			if($mid){

	// 				$m_refid = CityPayChecksum::createMRefrenceID($mid,$post['txnid']);
	// 				$query = $this->db->query('SELECT txn_status, pg_res_data FROM payin_txn where reference_id = "'.$m_refid.'"');

	// 				if($query->num_rows() == 1){
	// 					$db_data = $query->row();
	// 					$data['code'] = 200;
	// 					$data['txnid'] = $post['txnid'];
	// 					if($db_data->txn_status == "pending"){
	// 						unset($post['signature']);
	// 						$res_data = $this->getTxnStatus($post);
	// 						if($res_data[0] && $res_data[1]->status != "pending"){
	// 							//update in db
	// 							$this->db->where('reference_id',$m_refid);
	// 							$this->db->update('payin_txn',array('txn_status'=>$res_data[1]->status,'pg_res_data'=>json_encode($res_data[1])));
								
	// 							$data['txn_status'] = $res_data[1]->status;
	// 							$data['status_message'] = $res_data[1]->field9;
	// 						}else{
	// 							$data['txn_status'] = "pending";
	// 							$data['status_message'] = "Transaction is pending";
	// 						}
	// 					}else{
							
	// 						$data['txn_status'] = $db_data->txn_status;
	// 						$data['status_message'] = json_decode($db_data->pg_res_data)->field9;
	// 					}
	// 				}else{
	// 					$data['code'] = 107;
	// 				}
	// 			}else{
	// 				$data['code'] = 103;
	// 			}

	// 		}else{
	// 			$data['code'] = 102;
	// 		}

	// 	}else{
	// 		$data['code'] = 101;
	// 	}
	// 	$data['message'] = CityPayErrorCode::getErrorMessage($data['code']);
	// 	$data['signature'] = $this->GetSignature($data,$mkey);

	// 	$this->output->set_content_type('application/json')->set_status_header(200)->set_output(json_encode($data));
		

	// }
	// public function getTxnStatus($post){
	// 	$creds = $this->config->item('payu')['test'];
	// 	$url = $creds['status_url'];	
	// 	$str = $creds['key'].'|check_upi_txn_status|'.$post['txnid'].'|'.$creds['salt'];
	// 	// echo $str; exit;
	// 	$data = "key=".$creds['key']."&command=check_upi_txn_status&var1=".$post['txnid']."&hash=".hash('sha512',$str);
	// 	// echo $data;
	// 	$res = $this->payu_call($data,$url);
	// 	$res = json_decode($res);
	// 	// echo "Ret Data: ";
	// 	// print_r($res);
	// 	if($res->result){
	// 		$res_data = json_decode(base64_decode($res->result));
	// 		return array(true,$res_data);
	// 	}else{
	// 		return array(false,array("message"=>"Something went wrong"));
	// 		// print_r($res);
	// 	}
	// }

	// public function payu_payment($post,$mid){
	// 	$creds = $this->config->item('payu')[$this->config->item('payu_env')];				

	// 	$key = $creds['key'];
	// 	$salt = $creds['salt'];
	// 	$url = $creds['url'];
	// 	// $txn_flow = array("UPI"=>2,"INTENT"=>2);
	// 	// $txn_flow = 2;
	// 	$post['udf1'] = $mid;
	// 	$hash = $key.'|'.$post['txnid'].'|'.$post['amount'].'|'.$post['productinfo'].'|'.$post['firstname'].'|'.$post['email'].'|'.$post['udf1'].'||||||||||'.$salt;

	// 	$post['txn_s2s_flow'] = 2;
		
	// 	$post['hash'] = hash('sha512',$hash);
	// 	// $post['mihpayid'] = $key;
	// 	$post['key'] = $key;
		
	// 	$post['surl'] = base_url()."webhook/page/success";
	// 	$post['furl'] = base_url()."webhook/page/fail";
		

	// 	$post_data = http_build_query($post);
	
	// 	$res = $this->payu_call($post_data,$url);	
	

	// 	if($post['bankcode'] == "UPI"){
	// 		return $this->get_payu_collect_response($res,$salt,$key);
	// 	}else{
	// 		return $this->get_payu_intent_response($res,$salt,$key);
	// 	}
	// }

	// public function get_payu_intent_response($res,$salt,$key){
	// 	$ret = json_decode($res);
	// 	if(@$ret->status == 1){
		
	// 		unset($ret->apps);
	// 		return array(true,$ret);
			
	// 	}else{
	// 		unset($ret->apps);
	// 		return array(false,$ret);
	// 	}		
	// }

	// public function get_payu_collect_response($res,$salt,$key){
	// 	//echo $res;
	// 	if($ret = base64_decode($res, true)){
	// 		$ret = json_decode($ret);
			
	// 		$hash_str = $salt.'|'.$ret->result->status.'||||||||||'.$ret->result->udf1.'|'.$ret->result->email.'|'.$ret->result->firstname.'|'.$ret->result->productinfo.'|'.$ret->result->amount.'|'.$ret->result->txnid.'|'.$key;
			
	// 		$my_hash = hash('sha512',$hash_str);
			
	// 		if($my_hash != $ret->result->hash){
	// 			return array(false,array("message"=>"Something went wrong","status"=>"failed"));
	// 		}
	// 	}else{
	// 		$ret = json_decode($res);
	// 	}


	// 	if(@$ret->status == "success"){
	// 		$ret->message = $ret->result->field9;
	// 		return array(true,$ret);
	// 	}else{
	// 		return array(false,$ret);
	// 	}
	// }

	// public function payu_call($data,$url){

	// 	// echo "Data: ".$data."<br>";
	// 	$ch = curl_init($url);
	// 	// curl_setopt($req, CURLOPT_URL, $url);
	// 	curl_setopt($ch, CURLOPT_POST, true); 
	// 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	// 	// $headers = array( "Content-Type: application/x-www-form-urlencoded", ); 
	// 	// curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
	// 	curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/x-www-form-urlencoded'));		

	// 	// echo $data;
	// 	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	// 	$resp = curl_exec($ch);
	// 	curl_close($ch);
	// 	log_message("error", "payu_call res: ".$resp);
	// 	return $resp;


	// }

	// public function payment_validate($post){
	// 	$required_param = array('txnid','amount','firstname','productinfo','bankcode','surl','furl');

	// 	foreach ($required_param as $key => $value) {

	// 		if(trim(@$post[$value]) == ""){				
	// 			return false;
	// 		}
	// 	}

	

	// 	if(!in_array($post['bankcode'], array("UPI","INTENT"))){			
	// 		return false;
	// 	}elseif ($post['bankcode'] == "UPI" && trim(@$post['vpa']) == "") {
	// 		return false;
	// 	}


	// 	if(strlen($post['firstname']) > 50 || !preg_match("/^[a-zA-Z- ']*$/", $post['firstname'])){
	// 		return false;
	// 	}

	// 	if(trim($post['email']) != "" && !filter_var($post['email'], FILTER_VALIDATE_EMAIL)){
	// 		return false;
	// 	}

	// 	if(trim($post['phone']) != "" && !preg_match("/^[6-9][0-9]{9}$/", $post['phone'])){
	// 		return false;
	// 	}

	// 	if(strlen($post['productinfo']) > 50){
	// 		return false;
	// 	}

	// 	if(strlen($post['txnid']) > 38){
	// 		return false;
	// 	}

	// 	if(!filter_var($post['surl'], FILTER_VALIDATE_URL)){
	// 		return false;
	// 	}

	// 	if(!filter_var($post['furl'], FILTER_VALIDATE_URL)){
	// 		return false;
	// 	}
	// 	return true;
	// }


	// public function payin_page($mkey){
	// 	$data['code'] = 0;
	// 	if($mkey != ""){
	// 		$post = json_decode(file_get_contents('php://input'), true);
			
	// 		if($this->payment_validate($post)){
	// 			$mid = $this->GetVerifySignature($post,$post['signature'],$mkey);
	// 			if($mid){
	// 				$post['pg'] = "UPI";
	// 				$m_refid = CityPayChecksum::createMRefrenceID($mid,$post['txnid']);
	// 				$query = $this->db->query('SELECT id FROM payin_txn where reference_id = "'.$m_refid.'"');

	// 				if($query->num_rows() == 0){
	// 					$this->db->trans_begin();
	// 						unset($post['signature']);
											
	// 						$response = $this->payu_page_payment($post,$mid);	
	// 						$insert_data = array(
	// 									"merchant_id"=>$mid,
	// 									"amount"=>$post['amount'],
	// 									"mer_req_data"=>json_encode($post),
	// 									"reference_id"=>$m_refid,
	// 									"pg_res_data"=>json_encode($response[1])
	// 								);
	// 						$this->db->insert('payin_txn',$insert_data);
							
							
	// 						if(!$response[0]){
	// 							$data['code'] = 801;
	// 							$this->db->trans_rollback();
	// 						}else{
	// 							$data['code'] = 200;
	// 							if(@$response[1]->result->acsTemplate){
	// 								$data['html_template'] = $response[1]->result->acsTemplate;
	// 							}								
	// 							$this->db->trans_complete();
	// 						}
													
							
	// 				}else{
	// 					$data['code'] = 104;
	// 				}
	// 			}else{
	// 				$data['code'] = 103;
	// 			}

	// 		}else{
	// 			$data['code'] = 102;
	// 		}

	// 	}else{
	// 		$data['code'] = 101;
	// 	}
	// 	$data['message'] = CityPayErrorCode::getErrorMessage($data['code']);
	// 	$data['signature'] = $this->GetSignature($data,$mkey);

	// 	$this->output->set_content_type('application/json')->set_status_header(200)->set_output(json_encode($data));
		
	// }

	// public function payu_page_payment($post,$mid){
	// 	$creds = $this->config->item('payu')[$this->config->item('payu_env')];				

	// 	$key = $creds['key'];
	// 	$salt = $creds['salt'];
	// 	$url = $creds['url'];
	// 	// $txn_flow = array("UPI"=>2,"INTENT"=>2);
	// 	// $txn_flow = 2;
	// 	$post['udf1'] = $mid;
	// 	$hash = $key.'|'.$post['txnid'].'|'.$post['amount'].'|'.$post['productinfo'].'|'.$post['firstname'].'|'.$post['email'].'|'.$post['udf1'].'||||||||||'.$salt;

	// 	$post['txn_s2s_flow'] = 4;
		
	// 	$post['hash'] = hash('sha512',$hash);
	// 	// $post['mihpayid'] = $key;
	// 	$post['key'] = $key;
		
	// 	$post['surl'] = base_url()."webhook/page/success";
	// 	$post['furl'] = base_url()."webhook/page/fail";
		

	// 	$post_data = http_build_query($post);
	
	// 	$res = $this->payu_call($post_data,$url);

	// 	log_message("error", "payu_page_payment pg res: ".$res);
	// 	$res_json = json_decode($res);

	// 	if((array)$res_json->result){
	// 		return array(true,$res_json);
	// 	}else{
	// 		return array(false,array("message"=>"Something went wrong","status"=>"failed"));
	// 	}
		
	// }

	// public function testres(){
	// 	// $post = file_get_contents('php://input');
	// 	// log_message("error", "testres: ".$post);
	// 	//echo $this->get_pgcode();
	// }

	

}