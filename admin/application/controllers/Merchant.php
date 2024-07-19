<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Merchant extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('Grocery_CRUD');

		if(!$this->ion_auth->in_group('merchant') && !$this->ion_auth->in_group('staff')){
			redirect('auth/login');
			die();
		}
		$this->load->library('grocery_CRUD');
		$this->load->library('CityPayChecksum');
		$this->load->library('CityPayErrorCode');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('session');

	}

	public function index(){
    
    	
    	

		// echo $this->ion_auth->is_merchant();exit;

		// $data['subs_count'] = $this->db->from("subscription")->count_all_results();

		// $res = $this->db->query("select count(u.id) as users from users u left join users_groups ug on u.id = ug.user_id where ug.group_id = 3")->row();
		// $data['user_count'] = $res->users;

		// $res = $this->db->query("select count(u.id) as users from users u left join users_groups ug on u.id = ug.user_id where ug.group_id = 4")->row();
		// $data['mentor_count'] = $res->users;
		$data['rec_sett'] = array("amount"=>"0.00","date_added"=>"coming soon");
		$res = $this->db->query("select amount, date(date_added) as date_added from payin_settlement_txn where merchant_id = '".$this->ion_auth->get_merchant_id()."' and settlement_status = 'success' order by id desc limit 1")->row_array();

		
		if($res){
			$data['rec_sett'] = $res;
		}
		
		

		

	

		$this->load->view('admin/dashboard',$data);
	}

	public function dashboard_chart_data(){

		if(!@$_GET['startDate']){
			$_GET['startDate'] = date('Y-m-d')." 00:00:00";
			$_GET['endDate'] = date('Y-m-d')." 23:59:59";
		}

		$start = $_GET['startDate'];
		$end = $_GET['endDate'];

		$datetime1 = new DateTime($start);

		$datetime2 = new DateTime($end);

		$difference = $datetime1->diff($datetime2);

		// echo 'Difference: '.$difference->y.' years, ' 
  //                  .$difference->m.' months, ' 
  //                  .$difference->d.' days';

                   // print_r($difference);

		if($difference->days == 0){
			// $aAxis = "HOUR(date_added)";
			$aAxis = "floor(hour(date_added) / 2)";

			$data['type'] = 'HR';
		}else{
			$aAxis = "date(date_added)";
			$data['type'] = 'DATE';
		}



		$sql = "select count(id) as cnt, sum(amount) as amt, avg(amount) as y, $aAxis as x from payin_txn where merchant_id = '".$this->ion_auth->get_merchant_id()."' and txn_status = 'success' and date_added between '".$start."' and '".$end."' group by $aAxis";
    
    // if($this->ion_auth->in_group('staff')){
    //     	echo $sql;
    //     exit;
    //     }
    
    
    
		$data['data'] = $this->db->query($sql)->result();

		$sql2 = "select count(id) as cnt, sum(amount) as y, $aAxis as x from refund_txn where merchant_id = '".$this->ion_auth->get_merchant_id()."' and (txn_status = 'success' or txn_status = 'pending') and date_added between '".$start."' and '".$end."' group by $aAxis";
		$data['refundData'] = $this->db->query($sql2)->result();

		echo json_encode($data);
	}



	public function profile(){

		$this->db->select(array('u.email','m.name','m.mobile','m.merchant_key','m.merchant_secret','m.webhook','m.account_name','m.bank_name','m.ifsc_code','m.account_number'));
		$this->db->from('merchant_details m');
		$this->db->join('users u','m.user_id = u.id');
		$this->db->where('m.user_id',$this->ion_auth->get_user_id());
		$data['info'] = $this->db->get()->row();



		$this->load->view('admin/profile',$data);

	}

	public function contacts(){

		$crud = new grocery_CRUD();
		$crud->set_theme('tablestrap');
		$crud->set_table('contacts');		
		$crud->set_subject('Contacts');	


		// $this->db->select('merchant_id');
		// $this->db->where('user_id',$this->ion_auth->get_user_id());
		// $mrow = $this->db->get('merchant_details')->row();
		// $mid = $mrow->merchant_id;
		$crud->where('merchant_id',$this->ion_auth->get_merchant_id());
		$crud->order_by('id','desc');

		$crud->columns('id','reference_id','name', 'email', 'contact', 'type', 'date_added','date_modified');
	

		$crud->callback_column('id', function ($value, $primary_key) {	
			$num_padded = sprintf("%010d", $value);
			return $num_padded; 
        });
        $crud->callback_column('reference_id', function ($value, $primary_key) {	
			$refid = CityPayChecksum::getMRefrenceID($value);
			return $refid;
        });

        $crud->callback_read_field('reference_id', function ($value, $primary_key,$a,$b) {      
        	if($b->merchant_id != $this->ion_auth->get_merchant_id()){        		
        		echo "Invalid ";exit;
        	}
        	
        	$refid = CityPayChecksum::getMRefrenceID($value);
			return $refid;
        });

 
        $crud->unset_fields('merchant_id');
		$crud->display_as('id','contact Id');

		$crud->unset_add();
		$crud->unset_edit();
		$crud->unset_delete();
		$data = $crud->render();
		$this->load->view('admin/crud_view',$data);
	}

	public function fund_accounts(){

		$crud = new grocery_CRUD();
		$crud->set_theme('tablestrap');
		$crud->set_table('fund_account');		
		$crud->set_subject('Fund Accounts');	
		$crud->where('merchant_id',$this->ion_auth->get_merchant_id());
		$crud->order_by('id','desc');
		$crud->set_relation('contact_id','contacts','merchant_id');


		$crud->columns('id','Contact ID','account_type', 'account_details', 'date_added','date_modified');

		$crud->callback_column('Contact ID', function ($value, $primary_key) {				
			$num_padded = sprintf("%010d", $primary_key->contact_id);
			return $num_padded; 
            // return '+30 ' . $value;
        });

        $crud->callback_read_field('contact_id', function ($value, $primary_key,$a, $b) {	
			$num_padded = sprintf("%010d", $b->contact_id);
			return $num_padded; 
            // return '+30 ' . $value;
        });
   //      $crud->callback_read_field('id', function ($value, $primary_key,$a, $b) {	
			// $num_padded = sprintf("%010d", $b->contact_id);
			// return $num_padded; 
   //          // return '+30 ' . $value;
   //      });

        $crud->callback_column('id', function ($value, $primary_key) {			
			$num_padded = sprintf("%010d", $value);
			return $num_padded; 
            // return '+30 ' . $value;
        });

   //      $crud->callback_column('id', function ($value, $primary_key) {	
			// $num_padded = sprintf("%010d", $value);
			// return $num_padded; 
   //      });
        $crud->callback_read_field('reference_id', function ($value, $primary_key,$a,$b) {   
        	if(explode('_', $value)[0] != $this->ion_auth->get_merchant_id()){        		
        		echo "Invalid ";exit;
        	}        	
        	$refid = CityPayChecksum::getMRefrenceID($value);
			return $refid;
        });
		$crud->display_as('id','fund account Id');
		// $crud->unset_fields('contact_id');

		$crud->unset_add();
		$crud->unset_edit();
		$crud->unset_delete();
		$data = $crud->render();
		$this->load->view('admin/crud_view',$data);
	}


	public function payout_transactions(){

		$crud = new grocery_CRUD();
		$crud->set_theme('tablestrap');
		$crud->set_table('payout_txn');		
		$crud->set_subject('Payout Transactions');	


		if($crud->getState() == "list" || $crud->getState() == "ajax_list" || $crud->getState() == "ajax_list_info"){
        	
        	if(!@$_GET['status']){
        		$_GET['status'] = "pending";
        	}

        	if ($_GET['status'] != "all") {        		
        		$crud->where("payout_txn.settlement_status",$_GET['status']);   
        		$where[] = "t.settlement_status = '".$_GET['status']."'";     		
        	}
        	

        	$date_today = date('Y-m-d');
        	// $date_today = '2023-02-06';
        	if(!@$_GET['start_date']){
        		
        		$start_date = $date_today." 00:00:00";
        		$end_date = $date_today." 23:59:59";
        	}else{
        		$start_date = $_GET['start_date'];
        		$end_date = $_GET['end_date'];
        	}


			$crud->where("payout_txn.date_added >=",$start_date);
        	$crud->where("payout_txn.date_added <=",$end_date);

        	$where[] = "t.date_added >= '".$start_date."'";
        	$where[] = "t.date_added <= '".$end_date."'";
        	$where[] = "t.merchant_id = ".$this->ion_auth->get_merchant_id();

        	$where = implode(" AND ", $where);
        	$s = "select count(t.id) as total_txn, sum(t.amount) as total_amt from payout_txn t where $where";

        	$q = $this->db->query($s);
        	$tbl = $q->row();

        	$rfu = array("admin"=>"merchant","show_filters"=>true,"tbl"=>$tbl,"export"=>"hide");

        	$crud->set_rfu_data($rfu);
        	// $crud->display_as('fund_account_id','Customer ID');
        }
        if($crud->getState() == "read"){
        	$crud->set_rfu_data(array("filter_list_url"=>true));        	
        }


		$crud->where('merchant_id',$this->ion_auth->get_merchant_id());

		$crud->set_relation('fund_account_id','fund_account','contact_id');
		$crud->order_by('id','desc');


		$crud->columns('reference_id','Fund ID','Contact ID', 'amount', 'settlement_status', 'date_added','date_modified');

		 


		$crud->callback_column('Fund ID', function ($value, $primary_key) {

			$num_padded = sprintf("%010d", $primary_key->fund_account_id);
			return $num_padded; 
        });

        $crud->callback_column('reference_id', function ($value, $primary_key) {	
			$refid = CityPayChecksum::getMRefrenceID($value);
			return $refid;
        });
        


        $crud->callback_column('Contact ID', function ($value, $primary_key) {	        	
			$array = array_keys((array) $primary_key);
			$num_padded = sprintf("%010d", $primary_key->{$array[10]});
			return $num_padded; 
        });



        $crud->callback_column('settlement_status', function ($value, $primary_key) {	
			
			return "<span class='badge badge-$value'>$value</span>";
        });

        $crud->callback_field('reference_id', function ($value, $primary_key) {	
			$refid = CityPayChecksum::getMRefrenceID($value);
			return $refid;
        });




		$crud->set_read_fields('reference_id','fund_account_id','Contact Details','amount','Purpose', 'settlement_status','UTR','date_added','date_modified');
		// $crud->set_read_fields('fund_account_id','reference_id','amount', 'settlement_status', 'date_added','date_modified');

        $crud->callback_read_field('fund_account_id', function ($value, $primary_key,$a,$b) {	
			$num_padded = sprintf("%010d", $b->fund_account_id);
			return $num_padded; 
            // return '+30 ' . $value;
        });

        $crud->callback_read_field('Contact Details', function ($value, $primary_key,$a,$b) {
        	$row = $this->db->query('select f.*, c.* from fund_account f left join contacts c on c.id = f.contact_id where f.id = '.$b->fund_account_id)->row();
			// print_r($row);
			
			return '<div class="col-sm-3 pl-0"><label>Contact ID</label><div>'.sprintf("%010d", $row->contact_id).'</div></div><div class="col-sm-3 pl-0"><label>Contact Name</label><div>'.$row->name.'</div></div><div class="col-sm-3 pl-0"><label>Contact Mobile</label><div>'.$row->contact.'</div></div><div class="col-sm-3 pl-0"><label>Account Type</label><div>'.$row->account_type.'</div></div>';
            
        });

        $crud->callback_read_field('UTR', function ($value, $primary_key,$a,$b) {
        	
			if($b->pg_res_data){
				$data = json_decode($b->pg_res_data);
				return $data->utr;

			}
            
        });
        $crud->callback_read_field('Purpose', function ($value, $primary_key,$a,$b) {	
			if($b->mer_req_data){
				$data = json_decode($b->mer_req_data);
				return $data->purpose;

			}
        });


        $crud->callback_read_field('reference_id', function ($value, $primary_key,$a,$b) {      
        	if($b->merchant_id != $this->ion_auth->get_merchant_id()){        		
        		echo "Invalid ";exit;
        	}
        	
        	$refid = CityPayChecksum::getMRefrenceID($value);
			return $refid;
        });

 
        $crud->unset_fields('merchant_id','mer_req_data','pg_res_data');
		// $crud->display_as('id','contact Id');

		$crud->unset_add();
		$crud->unset_edit();
		$crud->unset_delete();

		// $crud->unset_export();
		$crud->unset_print();
		$data = $crud->render();
		$this->load->view('admin/crud_view',$data);
	}


	public function payin_transactions(){

		$crud = new grocery_CRUD();
		// $crud->set_theme('tablestrap');
		$crud->set_theme('bootstrap-v4');
		$crud->set_table('payin_txn');		
		$crud->set_subject('Payin Transactions');	


		if($crud->getState() == "list" || $crud->getState() == "ajax_list" || $crud->getState() == "ajax_list_info"){
        	
        	if(!@$_GET['status']){
        		$_GET['status'] = "pending";
        	}

        	if ($_GET['status'] != "all") {        		
        		$crud->where("payin_txn.txn_status",$_GET['status']);   
        		$where[] = "t.txn_status = '".$_GET['status']."'";     		
        	}
        	

        	$date_today = date('Y-m-d');
        	// $date_today = '2023-02-06';
        	if(!@$_GET['start_date']){
        		
        		$start_date = $date_today." 00:00:00";
        		$end_date = $date_today." 23:59:59";
        	}else{
        		$start_date = $_GET['start_date'];
        		$end_date = $_GET['end_date'];
        	}


			$crud->where("payin_txn.date_added >=",$start_date);
        	$crud->where("payin_txn.date_added <=",$end_date);

        	$where[] = "t.date_added >= '".$start_date."'";
        	$where[] = "t.date_added <= '".$end_date."'";
        	$where[] = "t.merchant_id = ".$this->ion_auth->get_merchant_id();

        	$where = implode(" AND ", $where);
        	$s = "select count(t.id) as total_txn, sum(t.amount) as total_amt from payin_txn t where $where";

        	$q = $this->db->query($s);
        	$tbl = $q->row();

        	$rfu = array("admin"=>"merchant","show_filters"=>true,"tbl"=>$tbl,"export"=>"hide","payin"=>true,"status"=>CityPayErrorCode::payInTxnStatus());

        	$crud->set_rfu_data($rfu);
        	// $crud->display_as('fund_account_id','Customer ID');
        }
        if($crud->getState() == "read"){
        	$crud->set_rfu_data(array("filter_list_url"=>true));        	
        }


		$crud->where('merchant_id',$this->ion_auth->get_merchant_id());

		// $crud->set_relation('fund_account_id','fund_account','contact_id');
		$crud->order_by('id','desc');
		$crud->display_as('reference_id','Txn ID');
		$crud->display_as('date_added','Txn Date');

		$crud->columns('reference_id', 'amount', 'txn_status', 'date_added');

		 


		
        $crud->callback_column('reference_id', function ($value, $primary_key) {	
			$refid = CityPayChecksum::getMRefrenceID($value);
			return $refid;
        });
        


    


        $crud->callback_column('txn_status', function ($value, $primary_key) {	
			
			return "<span class='badge badge-$value'>$value</span>";
        });

        $crud->callback_field('reference_id', function ($value, $primary_key) {	
			$refid = CityPayChecksum::getMRefrenceID($value);
			return $refid;
        });




		$crud->set_read_fields('reference_id','amount', 'txn_status','date_added', 'Customer Details');

     


        $crud->callback_read_field('reference_id', function ($value, $primary_key,$a,$b) {      
        	if($b->merchant_id != $this->ion_auth->get_merchant_id()){        		
        		echo "Invalid ";exit;
        	}
        	
        	$refid = CityPayChecksum::getMRefrenceID($value);
			return $refid;
        });

        $crud->callback_read_field('Customer Details', function ($value, $primary_key,$a,$row) {
        	
        	//$m_data = json_decode($row->mer_req_data);
        	$this->db->select('order_data');
        	$this->db->where('id',$row->order_id);
        	$order_data = $this->db->get('orders')->row()->order_data;
        	$order_data = json_decode($order_data);
			

			$extra = '';
			if($order_data->productinfo){
				$extra = '<div class="col-sm-3 pl-0"><label>Product Info</label><div>'.$order_data->productinfo.'</div></div>';
			}

			return '<div class="col-sm-3 pl-0"><label>Name</label><div>'.$order_data->customer_firstname.'</div></div><div class="col-sm-3 pl-0"><label>Phone</label><div>'.preg_replace('~[+\d-](?=[\d-]{4})~', '*', $order_data->customer_phone).'</div></div><div class="col-sm-3 pl-0"><label>Email</label><div>'.substr_replace($order_data->customer_email, "****", 0, 4).'</div></div>'.$extra;
            
        });

 
        $crud->unset_fields('merchant_id','mer_req_data','pg_res_data');
		// $crud->display_as('id','contact Id');

		$crud->order_by('date_added','desc');

		$crud->unset_add();
		$crud->unset_edit();
		$crud->unset_delete();

		// $crud->unset_export();
		$crud->unset_print();
		$data = $crud->render();
		$this->load->view('admin/crud_view',$data);
	}


	public function refund_transactions(){

		$crud = new grocery_CRUD();
		$crud->set_theme('tablestrap');
		$crud->set_table('refund_txn');		
		$crud->set_subject('Refund Transactions');	


		if($crud->getState() == "list" || $crud->getState() == "ajax_list" || $crud->getState() == "ajax_list_info"){
        	
        	if(!@$_GET['status']){
        		$_GET['status'] = "pending";
        	}

        	if ($_GET['status'] != "all") {        		
        		$crud->where("refund_txn.txn_status",$_GET['status']);   
        		$where[] = "t.txn_status = '".$_GET['status']."'";     		
        	}
        	

        	$date_today = date('Y-m-d');
        	// $date_today = '2023-02-06';
        	if(!@$_GET['start_date']){
        		
        		$start_date = $date_today." 00:00:00";
        		$end_date = $date_today." 23:59:59";
        	}else{
        		$start_date = $_GET['start_date'];
        		$end_date = $_GET['end_date'];
        	}


			$crud->where("refund_txn.date_added >=",$start_date);
        	$crud->where("refund_txn.date_added <=",$end_date);

        	$where[] = "t.date_added >= '".$start_date."'";
        	$where[] = "t.date_added <= '".$end_date."'";
        	$where[] = "t.merchant_id = ".$this->ion_auth->get_merchant_id();

        	$where = implode(" AND ", $where);
        	$s = "select count(t.id) as total_txn, sum(t.amount) as total_amt from refund_txn t where $where";

        	$q = $this->db->query($s);
        	$tbl = $q->row();

        	$rfu = array("admin"=>"merchant","show_filters"=>true,"tbl"=>$tbl,"export"=>"hide","payin"=>true,"status"=>CityPayErrorCode::payInTxnStatus());

        	$crud->set_rfu_data($rfu);
        	// $crud->display_as('fund_account_id','Customer ID');
        }
        if($crud->getState() == "read"){
        	$crud->set_rfu_data(array("filter_list_url"=>true));        	
        }


		$crud->where('merchant_id',$this->ion_auth->get_merchant_id());

		// $crud->set_relation('fund_account_id','fund_account','contact_id');
		$crud->order_by('id','desc');
		$crud->display_as('reference_id','Txn ID');
		$crud->display_as('date_added','Txn Date');

		$crud->columns('reference_id', 'amount', 'txn_status', 'date_added');

		 


		
        $crud->callback_column('reference_id', function ($value, $primary_key) {	
			$refid = CityPayChecksum::getMRefrenceID($value);
			return $refid;
        });
        


    


        $crud->callback_column('txn_status', function ($value, $primary_key) {	
			
			return "<span class='badge badge-$value'>$value</span>";
        });

        $crud->callback_field('reference_id', function ($value, $primary_key) {	
			$refid = CityPayChecksum::getMRefrenceID($value);
			return $refid;
        });




		$crud->set_read_fields('reference_id','amount', 'txn_status','date_added');
		// $crud->set_read_fields('fund_account_id','reference_id','amount', 'txn_status', 'date_added','date_modified');

     


        $crud->callback_read_field('reference_id', function ($value, $primary_key,$a,$b) {      
        	if($b->merchant_id != $this->ion_auth->get_merchant_id()){        		
        		echo "Invalid ";exit;
        	}
        	
        	$refid = CityPayChecksum::getMRefrenceID($value);
			return $refid;
        });

 
        $crud->unset_fields('merchant_id','mer_req_data','pg_res_data');
		// $crud->display_as('id','contact Id');

		$crud->order_by('date_added','desc');

		$crud->unset_add();
		$crud->unset_edit();
		$crud->unset_delete();

		// $crud->unset_export();
		$crud->unset_print();
		$data = $crud->render();
		$this->load->view('admin/crud_view',$data);
	}


	public function payin_settlements(){

		$crud = new grocery_CRUD();
		$crud->set_theme('tablestrap');
		$crud->set_table('payin_settlement_txn');		
		$crud->set_subject('Payin Settlement Transactions');	

		$state = $crud->getState();

		if($state == "list" || $state == "ajax_list" || $state == "ajax_list_info" || $state == "export"){

        	if(!@$_GET['status']){
        		$_GET['status'] = "pending";
        	}

        	if ($_GET['status'] != "all") {        		
        		$crud->where("payin_settlement_txn.settlement_status",$_GET['status']);   
        		$where[] = "t.settlement_status = '".$_GET['status']."'";     		
        	}
        	

        	$date_today = date('Y-m-d');
        	// $date_today = '2023-02-06';
        	if(!@$_GET['start_date']){        		
        		$start_date = $date_today." 00:00:00";
        		$end_date = $date_today." 23:59:59";
        	}else{
        		$start_date = $_GET['start_date'];
        		$end_date = $_GET['end_date'];
        	}


			$crud->where("payin_settlement_txn.date_added >=",$start_date);
        	$crud->where("payin_settlement_txn.date_added <=",$end_date);

        	$where[] = "t.date_added >= '".$start_date."'";
        	$where[] = "t.date_added <= '".$end_date."'";
        	$where[] = "t.merchant_id = ".$this->ion_auth->get_merchant_id();
        	
        	        	

        	
        	$where = implode(" AND ", $where);
        	
        	$s = "select count(t.id) as total_txn, sum(t.amount) as total_amt, t.settlement_status from payin_settlement_txn t where $where";




        	$q = $this->db->query($s);
        	$tbl = $q->result();

        	
        	$rfu = array("admin"=>"merchant","show_filters"=>true,"tbl"=>$tbl,"export"=>"hide","payin"=>2,"s_msg"=>@$s_msg,"status"=>CityPayErrorCode::payInSettlementStatus());

        	$crud->set_rfu_data($rfu);
        	// $crud->display_as('fund_account_id','Customer ID');
        }
        if($crud->getState() == "read"){
        	$crud->set_rfu_data(array("filter_list_url"=>true,"get_txns_btn"=>true));        	
        }


		$crud->where('merchant_id',$this->ion_auth->get_merchant_id());

		// $crud->set_relation('fund_account_id','fund_account','contact_id');
		$crud->order_by('id','desc');
		$crud->display_as('id','Settlement ID');
		$crud->display_as('date_added','Settlement Date');
		$crud->display_as('date_modified','Last Settlement Update');

		$crud->columns('id','amount','settlement_status','utr','date_added');
		

        $crud->callback_column('id', function ($value, $primary_key) {	
			$num_padded = sprintf("%020d", $value);
			return $num_padded; 
        });

        $crud->callback_column('txn_status', function ($value, $primary_key) {	
			
			return "<span class='badge badge-$value'>$value</span>";
        });

        



		$crud->set_read_fields('id', 'settlement_status', 'utr', 'txn_count', 'amount','deduction','Total Transactions Amount','date_added');
		


     	$crud->callback_field('id', function ($value, $primary_key) {	
			$num_padded = sprintf("%020d", $value);
			return $num_padded; 
        });

     	

		$crud->callback_read_field('Total Transactions Amount', function ($value, $primary_key,$a,$row) {
        	
        	return $row->deduction + $row->amount;
            
        });


        $crud->callback_read_field('deduction', function ($value, $primary_key,$a,$row) {
        	
        	$m_data = json_decode($row->deduction_details);
			return '<div class="col-sm-2 pl-0"><label>Total Deduction</label><div>'.$value.'</div></div><div class="col-sm-2 pl-0"><label>Commison</label><div>'.$m_data->Commison.'</div></div><div class="col-sm-2 pl-0"><label>GST</label><div>'.$m_data->GST.'</div></div> <div class="col-sm-2 pl-0"><label>Refund</label><div>'.$m_data->Refund.'</div></div>';
            
        });


 
        // $crud->unset_fields('mer_req_data','pg_res_data');
		// $crud->display_as('id','contact Id');

		$crud->unset_add();
		$crud->unset_edit();
		$crud->unset_delete();

		// $crud->unset_export();
		$crud->unset_print();
		$data = $crud->render();


		

		$this->load->view('admin/crud_view_admin',$data);


	}

		public function getSettlemtTxns($settl_id){
		$this->db->select(array('reference_id','amount','ROUND((amount*0.0475),2) as Commison','ROUND((amount*0.0475*0.18),2) as GST','txn_status','date_added'));
		$this->db->where('settlement_id',$settl_id);
		$this->db->order_by('date_added','DESC');
		$res = $this->db->get('payin_txn')->result();
    
    
    	$this->db->select(array('reference_id','amount','txn_status','date_added'));
		$this->db->where('settlement_id',$settl_id);
		$this->db->order_by('date_added','DESC');
		$resRef = $this->db->get('refund_txn')->result();

    	$data['payin'] = $res;
    	$data['refund'] = $resRef;
		echo json_encode($data);

	}

	public function DownloadSettlementTxns($settl_id){
		$this->db->select(array('reference_id','amount','ROUND((amount*0.0475),2) as Commison','ROUND((amount*0.0475*0.18),2) as GST','"Payin" as Type','txn_status','date_added as TxnDate'));
		$this->db->where('settlement_id',$settl_id);
		$this->db->order_by('date_added','DESC');
		$res = $this->db->get('payin_txn')->result_array();
    
    	// print_r($res);
    
    	$this->db->select(array('reference_id','amount','"0" as Commision','"0" as GST','"Refund" as Type','txn_status','date_added as TxnDate'));
		$this->db->where('settlement_id',$settl_id);
		$this->db->order_by('date_added','DESC');
		$resRef = $this->db->get('refund_txn')->result_array();
	
    
    	$array = array_merge($res,$resRef);
    
    	header( 'Content-Type: application/csv' );
	    header( 'Content-Disposition: attachment; filename="SettlementTxn-'.sprintf("%020d", $settl_id).'.csv";' );

	    // clean output buffer
	    ob_end_clean();
	    
	    $handle = fopen( 'php://output', 'w' );
	    $delimiter  = ",";

	    // use keys as column titles
	    fputcsv( $handle, array_keys( $array['0'] ), $delimiter );
	    foreach ( $array as $value ) {
	        fputcsv( $handle, $value, $delimiter );
	    }

	    fclose( $handle );
    	

	}

	
	
  	



}
