<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Webhook extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('CityPayChecksum');
		
	}

	
	public function ap_payment($status,$secret=""){
		$code = 500;
		log_message("error", "ap_payment webhook POST ".$status." res: ".json_encode($_POST));    
    	$txn_data = (object) $_POST;

    	if($txn_data->TRANSACTIONTYPE == "340"){
        	$code = $this->ap_refund($txn_data);
        }else{
        	$this->load->library('airpay');
        	$ret_data = airpay::update_payment($txn_data);
        	log_message("error", "ap_payment webhook data : ".json_encode($ret_data));

        	if($ret_data){
            	$this->db->where('reference_id',$ret_data['mtxnid']);
            	$r = $this->db->update('payin_txn',array("txn_status"=>$ret_data['txn_status'],"pg_res_data"=>json_encode($ret_data['db_update_data'])));

            	if($r){
                	$sql = 'select pt.mer_req_data as mrd, md.merchant_secret ms, md.webhook from payin_txn pt left join merchant_details md on pt.merchant_id = md.merchant_id where pt.reference_id = "'.$ret_data['mtxnid'].'"';
                	$db_rec = $this->db->query($sql)->row();

                	$txnid = CityPayChecksum::getMRefrenceID($ret_data['mtxnid']);
                	unset($ret_data['mtxnid']);
                	unset($ret_data['db_update_data']);
                	$ret_data['txn_type'] = 'payment';
                	$ret_data['txnid'] = $txnid;
                	$ret_data['signature'] = $this->GetSignature($ret_data,$db_rec->ms);
					if($this->send_request($db_rec->webhook,$ret_data)){
						$code = 200;
					}
            	}

        	}

        	
        }	
   		$this->output->set_content_type('application/json')->set_status_header($code)->set_output('{"msg":"OK"}');
	}

	public function ap_refund($txn_data){		
		$code = 500;
		$this->load->library('airpay');
		$ret_data = airpay::update_payment($txn_data);
    	log_message("error", "ap_refund webhook data : ".json_encode($ret_data));
    
		if($ret_data){
			$this->db->where('reference_id',$ret_data['mtxnid']);
			$r = $this->db->update('refund_txn',array("txn_status"=>$ret_data['refund_status'],"pg_res_data"=>json_encode($ret_data['db_update_data'])));

			if($r){
				$sql = 'select pt.mer_req_data as mrd, md.merchant_secret ms, md.webhook from refund_txn pt left join merchant_details md on pt.merchant_id = md.merchant_id where pt.reference_id = "'.$ret_data['mtxnid'].'"';
				$db_rec = $this->db->query($sql)->row();

				$txnid = CityPayChecksum::getMRefrenceID($ret_data['mtxnid']);
				unset($ret_data['mtxnid']);
				unset($ret_data['db_update_data']);
				$ret_data['txn_type'] = 'refund';
				$ret_data['refund_txnid'] = $txnid;
				$ret_data['signature'] = $this->GetSignature($ret_data,$db_rec->ms);
				if($this->send_request($db_rec->webhook,$ret_data)){
					$code = 200;
				}
			}

		}
    	return $code;
	}
	public function pe_payment($secret=""){
		$code = 500;
		$post_js = file_get_contents('php://input');
		log_message("error", "pe_payment ".$status." res: ".$post_js);

		$this->load->library('phonepe');
		$ret_data = phonepe::update_payment(json_decode($post_js));
    	log_message("error", "pe_payment webhook data : ".json_encode($ret_data));
    	
		if($ret_data){
			$this->db->where('reference_id',$ret_data['mtxnid']);
			$r = $this->db->update('payin_txn',array("txn_status"=>$ret_data['txn_status'],"pg_res_data"=>json_encode($ret_data['db_update_data'])));

			if($r){
				$sql = 'select pt.mer_req_data as mrd, md.merchant_secret ms, md.webhook from payin_txn pt left join merchant_details md on pt.merchant_id = md.merchant_id where pt.reference_id = "'.$ret_data['mtxnid'].'"';
				$db_rec = $this->db->query($sql)->row();

				$txnid = CityPayChecksum::getMRefrenceID($ret_data['mtxnid']);
				unset($ret_data['mtxnid']);
				unset($ret_data['db_update_data']);
				$ret_data['txn_type'] = 'payment';
				$ret_data['txnid'] = $txnid;
				$ret_data['signature'] = $this->GetSignature($ret_data,$db_rec->ms);
				if($this->send_request($db_rec->webhook,$ret_data)){
					$code = 200;
				}
			}

		}

    	$this->output->set_content_type('application/json')->set_status_header($code)->set_output('{"msg":"OK"}');
	}

	public function pe_refund($secret=""){
		$code = 500;
		$post_js = file_get_contents('php://input');
		log_message("error", "pe_refund  res: ".$post_js);

		$this->load->library('phonepe');
		$ret_data = phonepe::update_refund(json_decode($post_js));
		if($ret_data){
			$this->db->where('reference_id',$ret_data['mtxnid']);
			$r = $this->db->update('refund_txn',array("txn_status"=>$ret_data['refund_status'],"pg_res_data"=>json_encode($ret_data['db_update_data'])));

			if($r){
				$sql = 'select pt.mer_req_data as mrd, md.merchant_secret ms, md.webhook from refund_txn pt left join merchant_details md on pt.merchant_id = md.merchant_id where pt.reference_id = "'.$ret_data['mtxnid'].'"';
				$db_rec = $this->db->query($sql)->row();

				$txnid = CityPayChecksum::getMRefrenceID($ret_data['mtxnid']);
				unset($ret_data['mtxnid']);
				unset($ret_data['db_update_data']);
				$ret_data['txn_type'] = 'refund';
				$ret_data['refund_txnid'] = $txnid;
				$ret_data['signature'] = $this->GetSignature($ret_data,$db_rec->ms);
				if($this->send_request($db_rec->webhook,$ret_data)){
					$code = 200;
				}
			}

		}
    	$this->output->set_content_type('application/json')->set_status_header($code)->set_output('{"msg":"OK"}');
	}

	public function bd_payment($secret=""){
		$code = 500;
    	$post_js = file_get_contents('php://input');
		log_message("error", "bd_payment webhook res: ".$post_js);
    
    	$this->output->set_content_type('application/json')->set_status_header($code)->set_output('{"msg":"OK"}');
    }

	public function bd_refund($secret=""){
		$code = 500;
    	$post_js = file_get_contents('php://input');
		log_message("error", "bd_refund webhook res: ".$post_js);
    
    	$this->output->set_content_type('application/json')->set_status_header($code)->set_output('{"msg":"OK"}');
    }

	public function ez_payment($secret=""){
		// if($secret != "iflxZXvrXk3FBZbgWm2tEoraYkvbLla9NaQn2xAk"){
		// 	echo "ok";exit;
		// }
		$code = 500;
		$post_js = file_get_contents('php://input');
		log_message("error", "ez_payment webhook res: ".$post_js);

		$this->load->library('easebuzz');
		$ret_data = easebuzz::update_payment($post_js);
		if($ret_data){
			$this->db->where('reference_id',$ret_data['mtxnid']);
			$r = $this->db->update('payin_txn',array("txn_status"=>$ret_data['txn_status'],"pg_res_data"=>json_encode($ret_data['db_update_data'])));

			if($r){
				$sql = 'select pt.mer_req_data as mrd, md.merchant_secret ms, md.webhook from payin_txn pt left join merchant_details md on pt.merchant_id = md.merchant_id where pt.reference_id = "'.$ret_data['mtxnid'].'"';
				$db_rec = $this->db->query($sql)->row();

				$txnid = CityPayChecksum::getMRefrenceID($ret_data['mtxnid']);
				unset($ret_data['mtxnid']);
				unset($ret_data['db_update_data']);
				$ret_data['txn_type'] = 'payment';
				$ret_data['txnid'] = $txnid;
				$ret_data['signature'] = $this->GetSignature($ret_data,$db_rec->ms);
				if($this->send_request($db_rec->webhook,$ret_data)){
					$code = 200;
				}
			}

		}

    	$this->output->set_content_type('application/json')->set_status_header($code)->set_output('{"msg":"OK"}');
	}

	public function ez_refund($secret=""){
		// if($secret != "iflxZXvrXk3FBZbgWm2tEoraYkvbLla9NaQn2xAk"){
		// 	echo "ok";exit;
		// }
		$code = 500;
		$post_js = file_get_contents('php://input');
		log_message("error", "ez_refund  res: ".$post_js);

		$this->load->library('easebuzz');
		$ret_data = easebuzz::update_refund(json_decode($post_js));
		if($ret_data){
			$this->db->where('reference_id',$ret_data['mtxnid']);
			$r = $this->db->update('refund_txn',array("txn_status"=>$ret_data['refund_status'],"pg_res_data"=>json_encode($ret_data['db_update_data'])));

			if($r){
				$sql = 'select pt.mer_req_data as mrd, md.merchant_secret ms, md.webhook from refund_txn pt left join merchant_details md on pt.merchant_id = md.merchant_id where pt.reference_id = "'.$ret_data['mtxnid'].'"';
				$db_rec = $this->db->query($sql)->row();

				$txnid = CityPayChecksum::getMRefrenceID($ret_data['mtxnid']);
				unset($ret_data['mtxnid']);
				unset($ret_data['db_update_data']);
				$ret_data['txn_type'] = 'refund';
				$ret_data['refund_txnid'] = $txnid;
				$ret_data['signature'] = $this->GetSignature($ret_data,$db_rec->ms);
				if($this->send_request($db_rec->webhook,$ret_data)){
					$code = 200;
				}
			}

		}
    	$this->output->set_content_type('application/json')->set_status_header($code)->set_output('{"msg":"OK"}');
	}

	public function py_payment($secret=""){
		// if($secret != "iflxZXvrXk3FBZbgWm2tEoraYkvbLla9NaQn2xAk"){
		// 	echo "ok";exit;
		// }
		$code = 500;
		$post_js = file_get_contents('php://input');
		log_message("error", "py_payment webhook res: ".$post_js);

		$this->load->library('paytm');
		$ret_data = paytm::update_payment($post_js);
		if($ret_data){
			$this->db->where('reference_id',$ret_data['mtxnid']);
			$r = $this->db->update('payin_txn',array("txn_status"=>$ret_data['txn_status'],"pg_res_data"=>json_encode($ret_data['db_update_data'])));

			if($r){
				$sql = 'select pt.mer_req_data as mrd, md.merchant_secret ms, md.webhook from payin_txn pt left join merchant_details md on pt.merchant_id = md.merchant_id where pt.reference_id = "'.$ret_data['mtxnid'].'"';
				$db_rec = $this->db->query($sql)->row();

				$txnid = CityPayChecksum::getMRefrenceID($ret_data['mtxnid']);
				unset($ret_data['mtxnid']);
				unset($ret_data['db_update_data']);
				$ret_data['txn_type'] = 'payment';
				$ret_data['txnid'] = $txnid;
				$ret_data['signature'] = $this->GetSignature($ret_data,$db_rec->ms);
				if($this->send_request($db_rec->webhook,$ret_data)){
					$code = 200;
				}
			}

		}

    	$this->output->set_content_type('application/json')->set_status_header($code)->set_output('{"msg":"OK"}');
	}
	public function py_refund(){
		$code = 500;
		$post_js = file_get_contents('php://input');
		log_message("error", "py_refund  res: ".$post_js);

		$this->load->library('paytm');
		$ret_data = paytm::update_refund(json_decode($post_js));
		if($ret_data){
			$this->db->where('reference_id',$ret_data['mtxnid']);
			$r = $this->db->update('refund_txn',array("txn_status"=>$ret_data['refund_status'],"pg_res_data"=>json_encode($ret_data['db_update_data'])));

			if($r){
				$sql = 'select pt.mer_req_data as mrd, md.merchant_secret ms, md.webhook from refund_txn pt left join merchant_details md on pt.merchant_id = md.merchant_id where pt.reference_id = "'.$ret_data['mtxnid'].'"';
				$db_rec = $this->db->query($sql)->row();

				$txnid = CityPayChecksum::getMRefrenceID($ret_data['mtxnid']);
				unset($ret_data['mtxnid']);
				unset($ret_data['db_update_data']);
				$ret_data['txn_type'] = 'refund';
				$ret_data['refund_txnid'] = $txnid;
				$ret_data['signature'] = $this->GetSignature($ret_data,$db_rec->ms);
				if($this->send_request($db_rec->webhook,$ret_data)){
					$code = 200;
				}
			}

		}
    	$this->output->set_content_type('application/json')->set_status_header($code)->set_output('{"msg":"OK"}');
	}

	public function cf_payment($status){
		$code = 500;
		$post_js = file_get_contents('php://input');
		log_message("error", "cf_payment ".$status." res: ".$post_js);

		$this->load->library('cashfree');
		$ret_data = cashfree::update_payment(json_decode($post_js));
		if($ret_data){
			$this->db->where('reference_id',$ret_data['mtxnid']);
			$r = $this->db->update('payin_txn',array("txn_status"=>$ret_data['txn_status'],"pg_res_data"=>json_encode($ret_data['db_update_data'])));

			if($r){
				$sql = 'select pt.mer_req_data as mrd, md.merchant_secret ms, md.webhook from payin_txn pt left join merchant_details md on pt.merchant_id = md.merchant_id where pt.reference_id = "'.$ret_data['mtxnid'].'"';
				$db_rec = $this->db->query($sql)->row();

				$txnid = CityPayChecksum::getMRefrenceID($ret_data['mtxnid']);
				unset($ret_data['mtxnid']);
				unset($ret_data['db_update_data']);
				$ret_data['txn_type'] = 'payment';
				$ret_data['txnid'] = $txnid;
				$ret_data['signature'] = $this->GetSignature($ret_data,$db_rec->ms);
				if($this->send_request($db_rec->webhook,$ret_data)){
					$code = 200;
				}
			}

		}

    	$this->output->set_content_type('application/json')->set_status_header($code)->set_output('{"msg":"OK"}');
	}

	public function cf_refund(){
		$code = 500;
		$post_js = file_get_contents('php://input');
		log_message("error", "cf_refund  res: ".$post_js);

		$this->load->library('cashfree');
		$ret_data = cashfree::update_refund(json_decode($post_js));
		if($ret_data){
			$this->db->where('reference_id',$ret_data['mtxnid']);
			$r = $this->db->update('refund_txn',array("txn_status"=>$ret_data['refund_status'],"pg_res_data"=>json_encode($ret_data['db_update_data'])));

			if($r){
				$sql = 'select pt.mer_req_data as mrd, md.merchant_secret ms, md.webhook from refund_txn pt left join merchant_details md on pt.merchant_id = md.merchant_id where pt.reference_id = "'.$ret_data['mtxnid'].'"';
				$db_rec = $this->db->query($sql)->row();

				$txnid = CityPayChecksum::getMRefrenceID($ret_data['mtxnid']);
				unset($ret_data['mtxnid']);
				unset($ret_data['db_update_data']);
				$ret_data['txn_type'] = 'refund';
				$ret_data['refund_txnid'] = $txnid;
				$ret_data['signature'] = $this->GetSignature($ret_data,$db_rec->ms);
				if($this->send_request($db_rec->webhook,$ret_data)){
					$code = 200;
				}
			}

		}
    	$this->output->set_content_type('application/json')->set_status_header($code)->set_output('{"msg":"OK"}');
	}

	public function rzp_payment($status){
		$code = 500;
		$post_js = file_get_contents('php://input');
		log_message("error", "rzp_payment ".$status." res: ".$post_js);

		$this->load->library('razorpay');
		$ret_data = razorpay::update_payment(json_decode($post_js));
		if($ret_data){
			$this->db->where('reference_id',$ret_data['mtxnid']);
			$r = $this->db->update('payin_txn',array("txn_status"=>$ret_data['txn_status'],"pg_res_data"=>json_encode($ret_data['db_update_data'])));

			if($r){
				$sql = 'select pt.mer_req_data as mrd, md.merchant_secret ms, md.webhook from payin_txn pt left join merchant_details md on pt.merchant_id = md.merchant_id where pt.reference_id = "'.$ret_data['mtxnid'].'"';
				$db_rec = $this->db->query($sql)->row();

				$txnid = CityPayChecksum::getMRefrenceID($ret_data['mtxnid']);
				unset($ret_data['mtxnid']);
				unset($ret_data['db_update_data']);
				$ret_data['txn_type'] = 'payment';
				$ret_data['txnid'] = $txnid;
				$ret_data['signature'] = $this->GetSignature($ret_data,$db_rec->ms);
				if($this->send_request($db_rec->webhook,$ret_data)){
					$code = 200;
				}
			}

		}


    	$this->output->set_content_type('application/json')->set_status_header($code)->set_output('{"msg":"OK"}');
	}

	public function rzp_refund(){
		$code = 500;
		$post_js = file_get_contents('php://input');
		log_message("error", "rzp_refund  res: ".$post_js);

		$this->load->library('razorpay');
		$ret_data = razorpay::update_refund(json_decode($post_js));
		if($ret_data){
			$this->db->where('reference_id',$ret_data['mtxnid']);
			$r = $this->db->update('refund_txn',array("txn_status"=>$ret_data['refund_status'],"pg_res_data"=>json_encode($ret_data['db_update_data'])));

			if($r){
				$sql = 'select pt.mer_req_data as mrd, md.merchant_secret ms, md.webhook from refund_txn pt left join merchant_details md on pt.merchant_id = md.merchant_id where pt.reference_id = "'.$ret_data['mtxnid'].'"';
				$db_rec = $this->db->query($sql)->row();

				$txnid = CityPayChecksum::getMRefrenceID($ret_data['mtxnid']);
				unset($ret_data['mtxnid']);
				unset($ret_data['db_update_data']);
				$ret_data['txn_type'] = 'refund';
				$ret_data['refund_txnid'] = $txnid;
				$ret_data['signature'] = $this->GetSignature($ret_data,$db_rec->ms);
				if($this->send_request($db_rec->webhook,$ret_data)){
					$code = 200;
				}
			}

		}


    	$this->output->set_content_type('application/json')->set_status_header($code)->set_output('{"msg":"OK"}');
	}

	

	// public function page($page){
	// 	// $post_js = file_get_contents('php://input');       
 //  //       $_POST =  json_decode($post_js, true);
 //  //       print_r($_POST);
	// 	$post_js = json_encode($_POST);
	// 	log_message("error", "Callback ".$page." res: ".$post_js);

	// 	$creds = $this->config->item('payu')[$this->config->item('payu_env')];				
	// 	$str = $creds['salt'].'|'.$_POST['status'].'||||||||||'.$_POST['udf1'].'|'.$_POST['email'].'|'.$_POST['firstname'].'|'.$_POST['productinfo'].'|'.$_POST['amount'].'|'.$_POST['txnid'].'|'.$creds['key'];
		
	// 	$myHash = hash('sha512',$str);
	// 	log_message("error", "Callback ".$page." res  myHash: ".$myHash);
	// 	if($myHash == $_POST['hash']){
	// 		$m_refid = CityPayChecksum::createMRefrenceID($_POST['udf1'],$_POST['txnid']);
	// 		$this->db->where('reference_id',$m_refid);
	// 		$this->db->where('merchant_id',$_POST['udf1']);
	// 		$r = $this->db->update('payin_txn',array("txn_status"=>$_POST['status'],"pg_res_data"=>$post_js));

	// 		if($r){

	// 			$sql = 'select pt.mer_req_data as mrd, md.merchant_secret ms from payin_txn pt left join merchant_details md on pt.merchant_id = md.merchant_id where pt.reference_id = "'.$m_refid.'"';
	// 			$db_rec = $this->db->query($sql)->row();

	// 			$req_data = json_decode($db_rec->mrd);
	// 			$payload = array();
				
	// 			if($page == "fail"){
	// 				$payload['post_url'] = $req_data->furl;
	// 			}else{
	// 				$payload['post_url'] = $req_data->surl;
	// 			}
	// 			$payload['post']['txn_type'] = 'payin';
	// 			$payload['post']['txnid'] = $_POST['txnid'];
	// 			$payload['post']['txn_status'] = $_POST['status'];
	// 			$payload['post']['status_message'] = $_POST['field9'];
	// 			$payload['post']['signature'] = $this->GetSignature($payload['post'],$db_rec->ms);
	// 			$this->load->view('pay-page',$payload);
	// 		}

	// 	}else{
	// 		log_message("error", "Callback ".$page." res Hash mismatch");
	// 	}

	// }


	// public function success(){
	// 	$post_js = json_encode($_POST);
	// 	log_message("error", "webhook success res: ".$post_js);

	// 	$creds = $this->config->item('payu')[$this->config->item('payu_env')];				
	// 	$str = $creds['salt'].'|'.$_POST['status'].'||||||||||'.$_POST['udf1'].'|'.$_POST['email'].'|'.$_POST['firstname'].'|'.$_POST['productinfo'].'|'.$_POST['amount'].'|'.$_POST['txnid'].'|'.$creds['key'];
		
	// 	$myHash = hash('sha512',$str);
	// 	log_message("error", "webhook success res  myHash: ".$myHash);
	// 	if($myHash == $_POST['hash']){
	// 		$m_refid = CityPayChecksum::createMRefrenceID($_POST['udf1'],$_POST['txnid']);
	// 		$this->db->where('reference_id',$m_refid);
	// 		$this->db->where('merchant_id',$_POST['udf1']);
	// 		$r = $this->db->update('payin_txn',array("txn_status"=>$_POST['status'],"pg_res_data"=>$post_js));

	// 		if($r){

	// 			$sql = 'select pt.mer_req_data as mrd, md.merchant_secret ms from payin_txn pt left join merchant_details md on pt.merchant_id = md.merchant_id where pt.reference_id = "'.$m_refid.'"';
	// 			$db_rec = $this->db->query($sql)->row();

	// 			$req_data = json_decode($db_rec->mrd);
	// 			$payload = array();
	// 			$payload['txn_type'] = 'payin';
	// 			$payload['txnid'] = $_POST['txnid'];
	// 			$payload['txn_status'] = $_POST['status'];
	// 			$payload['status_message'] = $_POST['field9'];
	// 			$payload['signature'] = $this->GetSignature($payload,$db_rec->ms);
	// 			$this->send_request($req_data->furl,$payload);
	// 		}

	// 	}else{
	// 		log_message("error", "webhook success res Hash mismatch");
	// 	}
	// 	echo "Ok";
	// }

	// public function fail(){
	// 	// $post = file_get_contents('php://input');
		
	// 	// $post = json_decode($post, true);
	// 	// print_r($_POST);
	// 	$post_js = json_encode($_POST);
	// 	log_message("error", "webhook fail res: ".$post_js);
	// 	$creds = $this->config->item('payu')[$this->config->item('payu_env')];

	// 	$str = $creds['salt'].'|'.$_POST['status'].'||||||||||'.$_POST['udf1'].'|'.$_POST['email'].'|'.$_POST['firstname'].'|'.$_POST['productinfo'].'|'.$_POST['amount'].'|'.$_POST['txnid'].'|'.$creds['key'];
		
	// 	$myHash = hash('sha512',$str);
	// 	log_message("error", "webhook fail res  myHash: ".$myHash);
	// 	if($myHash == $_POST['hash']){

	// 		$m_refid = CityPayChecksum::createMRefrenceID($_POST['udf1'],$_POST['txnid']);
	// 		$this->db->where('reference_id',$m_refid);
	// 		$this->db->where('merchant_id',$_POST['udf1']);
	// 		$r = $this->db->update('payin_txn',array("txn_status"=>$_POST['status'],"pg_res_data"=>$post_js));

	// 		if($r){
				

	// 			$sql = 'select pt.mer_req_data as mrd, md.merchant_secret ms from payin_txn pt left join merchant_details md on pt.merchant_id = md.merchant_id where pt.reference_id = "'.$m_refid.'"';
	// 			$db_rec = $this->db->query($sql)->row();

	// 			$req_data = json_decode($db_rec->mrd);
	// 			$payload = array();
	// 			$payload['txn_type'] = 'payin';
	// 			$payload['txnid'] = $_POST['txnid'];
	// 			$payload['txn_status'] = $_POST['status'];
	// 			$payload['status_message'] = $_POST['field9'];
	// 			$payload['signature'] = $this->GetSignature($payload,$db_rec->ms);
	// 			$this->send_request($req_data->furl,$payload);
	// 		}
	// 	}else{
	// 		log_message("error", "webhook success res Hash mismatch");
	// 	}
	// 	echo "Ok";
	// }

	public function GetSignature($postParams,$msec){
		
		unset($postParams['signature']);
		// $this->db->select(array('merchant_secret','merchant_id'));
		// $this->db->where('merchant_key',$mkey);
		// $a = $this->db->get('merchant_details')->row();

		return CityPayChecksum::generateSignature(json_encode($postParams, JSON_UNESCAPED_SLASHES), $msec);
	
	}

	function send_request($url,$payload){
		$ch = curl_init( $url );
		# Setup request to send json via POST.
		$payload = json_encode($payload);

		log_message("error", "webhook post to merchant: ".$url."===".$payload); 

		curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
		# Return response instead of printing.
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt($ch, CURLOPT_TIMEOUT_MS, 500);
		# Send request.
		$result = curl_exec($ch);
    	$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		# Print response.
		// echo "<pre>$result</pre>";
		log_message("error", "webhook post to merchant res: ".$httpcode."===".$result);
		if($httpcode == 200){
			return true;
		}
		return false;
	}





}
