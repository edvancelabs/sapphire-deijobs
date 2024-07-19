<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

public function __construct(){

    parent::__construct();
    $this->load->database();
    $this->load->model('Home_model');  
    $this->load->library('session');      
    $this->load->helper('url');

}

	public function login(){

	}

	public function dashboard(){
		
	}


	


	// public function get_mentor(){

	// 	# Get The Logged In User Intereset and Prefred Diagnosis

	// 	$postdata = json_decode(file_get_contents('php://input'), true);

	// 	$prefered_gender = '';
	// 	$this->db->select('prefered_gender');
	// 	$this->db->where('id', $postdata['userId']);
	// 	$this->db->from('users');
	// 	$query = $this->db->get();
	// 	if($query->num_rows() > 0){
	// 		$prefered_gender = $query->result_array()[0]['prefered_gender'];
	// 	}

	// 	print($prefered_gender);

	// 	$this->db->select('interest_id');
	// 	$this->db->where('user_id', $postdata['userId']);
	// 	$this->db->from('user_interest');
	// 	$query = $this->db->get();

	// 	if($query->num_rows() > 0){
	//         foreach($query->result_array() as $row){
 //        		$interest_array[] = $row['interest_id']; // add each user id to the array
 //    		}
	//     }


	//     $this->db->select('diagnos_id');
	// 	$this->db->where('user_id', $postdata['userId']);
	// 	$this->db->from('user_interest');
	// 	$query = $this->db->get();
	// 	if($query->num_rows() > 0){
	// 		foreach($query->result_array() as $row){
 //        		$diagnosis_array[] = $row['diagnos_id']; // add each user id to the array
 //    		}
	//     }

	//     $interest_array = implode(",",$interest_array);
	//     $diagnosis_array = implode(",",array_unique($diagnosis_array));


	//     $query = $this->db->query("SELECT DISTINCT users.* FROM users JOIN users_groups ON users.id = users_groups.user_id JOIN user_interest ON users.id = user_interest.user_id where users_groups.group_id = 4 and users.sex = '".$prefered_gender."' and (user_interest.interest_id in ('".$interest_array."') or  user_interest.diagnos_id in ('".$diagnosis_array."'))")->result();

	//     print_r(json_encode($query));
	// }


	// public function payment(){
	// 	// $postdata = json_decode(file_get_contents('php://input'), true);
	// 	# Get The Logged In User Intereset and Prefred Diagnosis
	// 	$user_id = $this->input->post('user_id');
	// 	$mentor_id = $this->input->post('mentor_id');
	// 	$amount = $this->input->post('amount');

	// 	$this->db->select('user_amount');
	// 	$this->db->from('amount_config');
	// 	$query = $this->db->get();
	// 	if($query->num_rows() > 0){
	//         $row = $query->row_array();
	//         $user_amount = $row['user_amount'];
	//         if($user_amount != $amount){
	//         	print('incorrect amount');
	//         }else{
	//         	$data = array(
 //        			'user_id'=>$user_id,
 //        			'mentor_id'=>$mentor_id,
	// 			);
 //    			$this->db->insert('subscription',$data);
	//         }


	// 	}
	// }


	// function active_deactive_users() {

	// 	if($this->input->post('table') == 'subscription'){
	// 		if($this->input->post('type') == 'Approve'){
	// 			$end_date = date('Y-m-d', strtotime('+30 day'));
	// 			$this->db->where('id', $this->input->post('id'));
	// 			$this->db->update('subscription',
	// 	    	array(
	// 	    	 	'start_date' => date('Y-m-d'),
	// 	    	 	'end_date' => $end_date,
	// 	    	 	'activate' => $this->input->post('activate')
	// 	    	));
	// 	    	$data['msg'] = "Approve successfully";
	// 	    	$data['url'] = base_url()."admin/subscription";
	// 			echo json_encode($data);
	// 	    }else{
	// 	    	$this->db->where('id', $this->input->post('id'));
	// 			$this->db->update('subscription',
	// 	    	array(
	// 	    	 	'activate' => $this->input->post('activate')
	// 	    	));
	// 	    	$data['msg'] = "Unapprove successfully";
	// 	    	$data['url'] = base_url()."admin/subscription";
	// 			echo json_encode($data);
	// 	    }
	// 	}else{
	// 		if($this->input->post('table') == 'user'){
	// 			$url = base_url()."admin/user_management";
	// 		}else{
	// 			$url = base_url()."admin/mentor_management";
	// 		}
	// 		if($this->input->post('type') == 'Approve'){
	// 			$this->db->where('id', $this->input->post('id'));
	// 			$this->db->update('users',
	// 	    	array('active' => $this->input->post('activate')));
	// 			$data['msg'] = "Unapprove successfully";
	// 	    	$data['url'] = $url;
	// 			echo json_encode($data);
	// 	    }else{
	// 	    	$this->db->where('id', $this->input->post('id'));
	// 			$this->db->update('users',
	// 	    	array('active' => $this->input->post('activate')));
	// 	    	$data['msg'] = "Unapprove successfully";
	// 	    	$data['url'] = $url;
	// 			echo json_encode($data);
	// 	    }
	// 	}
	// }

}