<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('sign_in');
	}

	public function sendMentorChat(){

		$data['code'] = 0;
  		if (!$this->session->userdata['user_id']){
  			$data['code'] = 99;
  		}else{  
  			$u_id = $this->session->userdata['user_id'];
  			$m_id = $this->input->post('mid');
  			$msg = $this->input->post('msg');

  			$this->db->insert('chat_msgs',array("from_id"=>$u_id,"to_id"=>$m_id,"msg"=>$msg));
  			$data['code'] = 1;

  		}
  		echo json_encode($data);

  	}

	public function getMentorChat(){

		$data['code'] = 0;
  		if (!@$this->session->userdata['user_id']){
  			$data['code'] = 99;
  		}else{  
  			$u_id = $this->session->userdata['user_id'];
  			$m_id = $this->input->post('m_id');
  			$this->db->where("is_read",0);
  			$this->db->where("from_id",$m_id);
  			$this->db->where("to_id",$u_id);
  			$this->db->update("chat_msgs",array("is_read"=>1));

  			$data['chat'] = $this->db->query('select * from chat_msgs where (from_id = "'.$u_id.'" and to_id = "'.$m_id.'") or (to_id = "'.$u_id.'" and from_id = "'.$m_id.'") order by id asc')->result();
  			$data['code'] = 1;

  		}
  		echo json_encode($data);   

  	}

	

}