<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {


	public function __construct() {
		parent::__construct();
		// $this->load->library('Grocery_CRUD');

		if(!$this->ion_auth->is_admin()){
			redirect('auth/login');
			die();
		}
		$this->load->library('grocery_CRUD');
		$this->load->library('CityPayErrorCode');
		// $this->load->library('image_CRUD');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('session');

	}

	public function index(){
		$data = array();
    
    
    	$this->db->where('is_active',1);
    	$data['total_users'] = $this->db->get('student_profiles')->num_rows();
		
    
    	$data['total_companies'] = $this->db->get('employer_details')->num_rows();
    
    

		// redirect('admin/companies');
		$this->load->view('admin/dashboard',$data);
	}


	public function featured_jobs(){
		$data = array();
    	$this->db->where('is_featured',1);
    	$f_jobs = $this->db->get('jobs')->result();
    	$data['jobs'] = $f_jobs;
		$this->load->view('admin/custom_crud',$data);
	}


	public function searchJobs($term){
    
    	$data = array();
    	$this->db->like('job_title',$term);
    	$f_jobs = $this->db->get('jobs')->result();
    	$data['jobs'] = $f_jobs;
		echo json_encode($data);
    
    }

	public function saveFJobs(){
    
    	print_r($_POST['f_jobs']);
    	$this->db->where('is_featured',1);
		$this->db->update('jobs',array('is_featured'=>0));   
    
    
    	$this->db->where_in('id',$_POST['f_jobs']);
		$this->db->update('jobs',array('is_featured'=>1));
    
    	redirect('admin/featured_jobs');
    }

	

	public function companies(){
		$crud = new grocery_CRUD();
		$crud->set_theme('tablestrap');
		// $crud->set_theme('bootstrap-v4');
		$crud->set_table('employer_details');
		$crud->set_subject('Companies');
		$state = $crud->getState();
		
		if($state == "list" || $state == "ajax_list" || $state == "ajax_list_info" || $state == "export" || $state == "success" ){

			$crud->set_theme('bootstrap-v4');
		}
		
		$crud->columns('company_logo','company_name','company_website','created_at');
	
	   // echo BASEPATH.'../../public_html/uploads/employer_logo';exit;
	   // $crud->set_field_upload('company_logo', BASEPATH.'../../public_html/uploads/employer_logo');
	    
	    $crud->set_field_upload('company_logo', '/uploads/employer_logo');
	    
	    
	
	
	
	    $crud->unset_edit_fields('created_at','updated_at');
	    $crud->unset_add_fields('created_at','updated_at');
		$data = $crud->render();
		$this->load->view('admin/crud_view_admin',$data);
	}

	public function company_types(){
		$crud = new grocery_CRUD();
		$crud->set_theme('tablestrap');
		$crud->set_table('company_types');
		$crud->set_subject('Company Types');
		$state = $crud->getState();
		if($state == "list" || $state == "ajax_list" || $state == "ajax_list_info" || $state == "export"){

			$crud->set_theme('bootstrap-v4');
		}

	    $crud->unset_edit_fields('created_at','updated_at');
	    $crud->unset_add_fields('created_at','updated_at');
		$data = $crud->render();
		$this->load->view('admin/crud_view_admin',$data);
	}

	public function job_roles(){
		$crud = new grocery_CRUD();
		$crud->set_theme('tablestrap');
		// $crud->set_theme('bootstrap-v4');
		$crud->set_table('job_roles');
		$crud->set_subject('Job Roles');
		$state = $crud->getState();
		if($state == "list" || $state == "ajax_list" || $state == "ajax_list_info" || $state == "export"){

			$crud->set_theme('bootstrap-v4');
		}

	    $crud->unset_edit_fields('created_at','updated_at');
	    $crud->unset_add_fields('created_at','updated_at');
		
		$data = $crud->render();
		$this->load->view('admin/crud_view_admin',$data);
	}

	public function job_skills(){
		$crud = new grocery_CRUD();
		$crud->set_theme('tablestrap');
		// $crud->set_theme('bootstrap-v4');
		$crud->set_table('job_skills');
		$crud->set_subject('Job Skills');
		$state = $crud->getState();
		if($state == "list" || $state == "ajax_list" || $state == "ajax_list_info" || $state == "export"){

			$crud->set_theme('bootstrap-v4');
		}

	    $crud->unset_edit_fields('created_at','updated_at');
	    $crud->unset_add_fields('created_at','updated_at');
		
		$data = $crud->render();
		$this->load->view('admin/crud_view_admin',$data);
	}

	public function work_modes(){
		$crud = new grocery_CRUD();
		$crud->set_theme('tablestrap');
		// $crud->set_theme('bootstrap-v4');
		$crud->set_table('work_modes');
		$crud->set_subject('Work Modes');
		$state = $crud->getState();
		if($state == "list" || $state == "ajax_list" || $state == "ajax_list_info" || $state == "export"){

			$crud->set_theme('bootstrap-v4');
		}

	    $crud->unset_edit_fields('created_at','updated_at');
	    $crud->unset_add_fields('created_at','updated_at');
		$data = $crud->render();
		$this->load->view('admin/crud_view_admin',$data);
	}











	public function home_banner(){
		$crud = new grocery_CRUD();
		$crud->set_theme('tablestrap');
		// $crud->set_theme('bootstrap-v4');
		$crud->set_table('promotions');
		$crud->set_subject('Home banner');
		$state = $crud->getState();
		if($state == "list" || $state == "ajax_list" || $state == "ajax_list_info" || $state == "export" || $state == "success"){

			$crud->set_theme('bootstrap-v4');
		}

        $crud->set_field_upload('image', '/uploads/promotional');
        
	    $crud->unset_edit_fields('created_at','updated_at');
	    $crud->unset_add_fields('created_at','updated_at');
		
		$data = $crud->render();
		$this->load->view('admin/crud_view_admin',$data);
	}

	public function testimonials(){
		$crud = new grocery_CRUD();
		$crud->set_theme('tablestrap');
		// $crud->set_theme('bootstrap-v4');
		$crud->set_table('testimonials');
		$crud->set_subject('Testimonials');
		$state = $crud->getState();
		if($state == "list" || $state == "ajax_list" || $state == "ajax_list_info" || $state == "export" || $state == "success"){

			$crud->set_theme('bootstrap-v4');
		}
		$crud->set_field_upload('image', '/uploads/testimonials');
		

	    $crud->unset_edit_fields('created_at','updated_at');
	    $crud->unset_add_fields('created_at','updated_at');
		
		$data = $crud->render();
		$this->load->view('admin/crud_view_admin',$data);
	}

	public function candidates(){
		$crud = new grocery_CRUD();
		$crud->set_theme('tablestrap');
		// $crud->set_theme('bootstrap-v4');
		$crud->set_table('student_profiles');
		$crud->set_subject('Candidates');
		$state = $crud->getState();
    	$upload_msg = "";
		if($state == "list" || $state == "ajax_list" || $state == "ajax_list_info" || $state == "export"){
        
        	if(@$_FILES["input_file_xls"]["tmp_name"]){
            	$upload_msg = $this->upload_candidate_profiles($_FILES["input_file_xls"]["tmp_name"]);
            }
        
        	$rfu = array("upload"=>true);

        	$crud->set_rfu_data($rfu);

			$crud->set_theme('bootstrap-v4');
		}
		$crud->set_relation('user_id','users','name');

		$crud->columns('user_id','gender', 'dni_category', 'job_role', 'experience','resume','status');
		$crud->callback_column('status', array($this, 'custom_status_column'));
		
		$crud->callback_column('resume', array($this, 'custom_resume_column'));
// 		$crud->add_action('Resume', '', 'admin/download_resume', 'fa-download');

		$crud->display_as('user_id','Name');
		$crud->display_as('dni_category','DnI Category');
		$crud->display_as('experience','Exp (Years)');
		$crud->display_as('created_at','Registered on');
		$crud->display_as('logo','Profile Photo');
		$crud->order_by('id','desc');
		
		

        $crud->set_read_fields('logo','user_id', 'dni_category','dob','gender','job_role','experience','skill','bio','location','hobbies','languages','resume','jobs_applied','is_active','desired_salary','preferred_location','preferred_job_type','created_at');
        
        $crud->callback_read_field('jobs_applied',function ($value, $primary_key,$a,$b) {
            $row = $this->db->query('select count(id) as cnt from user_jobs where user_id = "'.$b->user_id.'" and applied_flag = "Applied" ')->row();
            
            
            
        	return '<a target="_blank" href="/admin/applied_jobs/'.$b->user_id.'">'.$row->cnt.' (view all)</a>';
        });
        
        $crud->callback_read_field('is_active',function($value){
        	if ($value == 1) {
                return '<span class="label label-success">Active</span>';
            } elseif ($value == 0) {
                return '<span class="label label-danger">Inactive</span>';
            }
            return $value;
        });
        
        $crud->callback_read_field('resume',function($value){
        	
        	
        	if($value != ""){
        	    return '<a target="_blank" href="'.$this->config->item('resume_path').$value.'"><iframe src="'.$this->config->item('resume_path').$value.'" style="width:200px;height:200px;" ></iframe></a>';
        	}
        	
        	return $value;
        });
        
        $crud->callback_read_field('logo',function($value){
            if($value){
        	return '<img src="'.$this->config->item('profile_path').$value.'" class="" style="width:100px;height:100px;object-fit:cover;"> ';
            }else{
                return "";
            }
        });
        
        $crud->callback_read_field('gender', function ($value, $primary_key,$a,$b){
            
            if($b->is_private){
                return $value.', (Private)';
            }else{
                return $value;
            }
            
        });

		$crud->unset_add();
		$crud->unset_edit();
		$crud->unset_delete();
		$data = $crud->render();
    	$data->success_message = $upload_msg;
		// echo "<pre>";print_r($data);exit;
		$this->load->view('admin/crud_view_admin',$data);
	}
	
	public function applied_jobs($user_id){
	    	$crud = new grocery_CRUD();
    		$crud->set_theme('tablestrap');
    		$crud->set_table('user_jobs');
    		$crud->set_subject('Applied Jobs');
    		$crud->where("user_id",$user_id);  
    		$crud->where("applied_flag","Applied");  
    		$state = $crud->getState();
    		
    		
    		if($state == "list" || $state == "ajax_list" || $state == "ajax_list_info" || $state == "export"){
    
    			$crud->set_theme('bootstrap-v4');
    		}
    		
    		
    		$crud->set_relation('user_id','users','name');
    		$crud->set_relation('job_id','jobs','job_title');
    		
    		$crud->columns('user_id','job_id', 'created_at', 'employee_action');
    		
    		$crud->display_as('user_id','Name');
    		$crud->display_as('job_id','Job Title');
    		$crud->display_as('created_at','Applied on');
    		$crud->display_as('employee_action','Status');
    		
    		
    		
    		$crud->unset_add();
    		$crud->unset_edit();
    		$crud->unset_delete();
    		$data = $crud->render();
    		$this->load->view('admin/crud_view_admin',$data);
    		
	}
	public function custom_resume_column($value, $row){
	    if($row->resume){
	        
	        return '<a target="_blank" href="'.$this->config->item('resume_path').$row->resume.'" class="btn btn-secondary btn-xs"><i class="fa fa-download"></i>Resume</a>';
	    }else{
	        return '';
	    }
	}
	public function custom_status_column($value, $row){
        // Display active/deactivate button based on the current value
        if ($row->is_active == 1) {
            return '<span class="label label-success">Active</span> <a href="#" class="deactivate-btn cust_btn" data-fun="deactivate_candidate" data-id="'.$row->id.'">Deactivate</a>';
        } elseif ($row->is_active == 0) {
            return '<span class="label label-danger">Inactive</span> <a href="#" class="activate-btn cust_btn" data-fun="activate_candidate" data-id="'.$row->id.'">Activate</a>';
        }
    
        return $value;
    }
    public function activate_candidate($id){
        $this->db->where('id',$id);
        $this->db->update('student_profiles',array("is_active" => 1));
    
        echo json_encode(array("code"=>200, "cid"=>$id));
    }
    public function deactivate_candidate($id){
        $this->db->where('id',$id);
        $this->db->update('student_profiles',array("is_active" => 0));
        echo json_encode(array("code"=>200, "cid"=>$id));
    }
	public function recruiters(){
		$crud = new grocery_CRUD();
		$crud->set_theme('tablestrap');
		// $crud->set_theme('bootstrap-v4');
		$crud->set_table('employee_profile_details');
		$crud->set_subject('Recruiters');
		$state = $crud->getState();
		if($state == "list" || $state == "ajax_list" || $state == "ajax_list_info" || $state == "export"){

			$crud->set_theme('bootstrap-v4');
		}
		$crud->set_relation('user_id','users','name');
		$crud->set_relation('industry_id','industry_expertises','name');

		$crud->columns('user_id','organization', 'registered_as', 'industry_id', 'hiring_exp', 'status');
		$crud->display_as('user_id','Name');
		$crud->display_as('logo','Profile Photo');		
		$crud->display_as('industry_id','Industry');
		
		$crud->display_as('created_at','Registered at');
		
		$crud->order_by('id','desc');
		
		$crud->callback_column('status', array($this, 'custom_rec_status_column'));
		
		$crud->add_action('Job Posts', '', 'admin/job_posts', 'fa-upload');
		
		 $crud->set_read_fields('logo','user_id','stand_for','designation','organization','industry','registered_as','is_active','created_at');
		 
		$crud->callback_read_field('is_active',function($value){
        	if ($value == 1) {
                return '<span class="label label-success">Active</span>';
            } elseif ($value == 0) {
                return '<span class="label label-danger">Inactive</span>';
            }
            return $value;
        });
        
        $crud->callback_read_field('organization',function($value, $row, $a, $b){
      
                return '<a href="/admin/company_profile/read/'.$b->employer_id.'">'.$value.'</a>';
          
        });
		 
		 
		 $crud->callback_read_field('logo',function($value){
            if($value){
        	return '<img src="'.$this->config->item('profile_path').$value.'" class="" style="width:100px;height:100px;object-fit:cover;"> ';
            }else{
                return "";
            }
        });

		
		$crud->unset_add();
		$crud->unset_edit();
		$crud->unset_delete();
		$data = $crud->render();
		// echo "<pre>";print_r($data);exit;
		$this->load->view('admin/crud_view_admin',$data);
	}
	
	public function job_posts($rec_id=0){
	        $rec_id = intval($rec_id);
	       // var_dump($rec_id);
	    	$crud = new grocery_CRUD();
    		$crud->set_theme('tablestrap');
    		$crud->set_table('jobs');
    		$crud->set_subject('Job Posts');
    		if($rec_id != 0 && is_int($rec_id)){
    		    
    		    $crud->where("employee_id",$rec_id);  
    		}
    		
    		$state = $crud->getState();
    
    		$upload_msg = "";
    		if($state == "list" || $state == "ajax_list" || $state == "ajax_list_info" || $state == "export"){
            
            	if(@$_FILES["input_file_xls"]["tmp_name"]){
                	$upload_msg = $this->upload_job_postings($_FILES["input_file_xls"]["tmp_name"]);
            	}

            	$rfu = array("upload"=>true,"sample_url"=>'/uploads/job_posting_sample.csv',"upload_msg"=>$upload_msg);

            	$crud->set_rfu_data($rfu);

    
    			$crud->set_theme('bootstrap-v4');
    		}
    		
    		
    		$crud->set_relation('job_role_id','job_roles','name');
    		$crud->set_relation('industry_id','industry_expertises','name');
    		$crud->set_relation('employer_id','employer_details','company_name');
    		
    		$crud->columns('employer_id','job_title','job_role_id','industry_id','city', 'created_at','is_active', 'Applications');
    		
    		$crud->callback_column('is_active', function($value, $row){
    		    if ($value == 1) {
                    return '<span class="label label-success">Active</span>';
                } elseif ($value == 0) {
                    return '<span class="label label-danger">Inactive</span>';
                }
                return $value;
    		});
    		
    		$crud->callback_column('Applications', function($value, $row){
    		    $cnt = $this->db->query('select count(id) as cnt from user_jobs where job_id = "'.$row->id.'" and applied_flag = "Applied"')->row();
    		    
    		    if($cnt){
    		        return '<a target="_blank" href="/admin/applied_candidates/'.$row->id.'/'.urlencode($row->job_title).'">'.$cnt->cnt.' (view all)</a>';
    		    }else{
    		        return "0";
    		    }
                
    		});
    		
    		$crud->set_read_fields('employer_id','job_title','job_role_id','preference_category','industry_id','city','job_details','key_responsibilities','employement_type','education','minimum_exp','maximum_exp','salary','skill_required','applied_job_link','is_active','job_expiry','created_at');
    		
    		$crud->display_as('employer_id','Company');
    		$crud->display_as('job_role_id','Role');
    		$crud->display_as('industry_id','Industry');
    		$crud->display_as('created_at','Posted on');
    		$crud->display_as('is_active','Status');
    		$crud->display_as('city','location');
    		$crud->display_as('applied_job_link','External Apply Link');
    		
    		
    		$crud->callback_read_field('is_active',function($value){
            	if ($value == 1) {
                    return '<span class="label label-success">Active</span>';
                } elseif ($value == 0) {
                    return '<span class="label label-danger">Inactive</span>';
                }
                return $value;
            });
    		
    		
    		
    		$crud->order_by('id','desc');
    		
    		$crud->unset_add();
    		$crud->unset_edit();
    		$crud->unset_delete();
    		$data = $crud->render();
    
    		// $data->success_message = $upload_msg;
    		$this->load->view('admin/crud_view_admin',$data);
    		
	}
	
	public function applied_candidates($job_id, $job_title){
	   // $this->db->select('GROUP_CONCAT(user_id) as users');
	   // $this->db->where('job_id',$job_id);
	   // $this->db->where('applied_flag',"Applied");
	   // $res = $this->db->get('user_jobs')->result();
	    
	    $crud = new grocery_CRUD();
		$crud->set_theme('tablestrap');
		$crud->set_table('user_jobs');
		$crud->set_subject('Applied Candidates for Job: '.urldecode($job_title));
		$crud->where("job_id",$job_id);  
		$crud->where("applied_flag","Applied");  
		$state = $crud->getState();
		
		
		if($state == "list" || $state == "ajax_list" || $state == "ajax_list_info" || $state == "export"){

			$crud->set_theme('bootstrap-v4');
		}
		
		$crud->set_relation('user_id','users','{name}');
		$crud->set_relation('job_id','jobs','job_title');
		
		$crud->columns('user_id','job_id', 'created_at', 'employee_action','action');
		
		$crud->display_as('user_id','Name');
		$crud->display_as('job_id','Job Title');
		$crud->display_as('created_at','Applied on');
		$crud->display_as('employee_action','Status');
		
		$crud->callback_column('action', function($value, $row){
		  
		    return '<div class="" style="white-space: nowrap"><a href="/admin/candidates_user_route/'.$row->user_id.'" class="btn btn-secondary btn-xs"><i class="fa fa-eye"></i> View Profile</a></div>';
            
		});
		
		
		$crud->unset_add();
		$crud->unset_read();
		$crud->unset_edit();
		$crud->unset_delete();
		$data = $crud->render();
		$this->load->view('admin/crud_view_admin',$data);
	    
	    
	}
	
	public function candidates_user_route($user_id){
	    $this->db->select('id');
	    $this->db->where('user_id',$user_id);
	    $row = $this->db->get('student_profiles')->row();
	    redirect('admin/candidates/read/'.$row->id);
	}
	
	public function custom_rec_status_column($value, $row){
        // Display active/deactivate button based on the current value
        if ($row->is_active == 1) {
            return '<span class="label label-success">Active</span> <a href="#" class="deactivate-btn cust_btn" data-fun="deactivate_recruiter" data-id="'.$row->id.'">Deactivate</a>';
        } elseif ($row->is_active == 0) {
            return '<span class="label label-danger">Inactive</span> <a href="#" class="activate-btn cust_btn" data-fun="activate_recruiter" data-id="'.$row->id.'">Activate</a>';
        }
    
        return $value;
    }
    
    public function activate_recruiter($id){
        $this->db->where('id',$id);
        $this->db->update('employee_profile_details',array("is_active" => 1));
    
        echo json_encode(array("code"=>200, "cid"=>$id));
    }
    public function deactivate_recruiter($id){
        $this->db->where('id',$id);
        $this->db->update('employee_profile_details',array("is_active" => 0));
        echo json_encode(array("code"=>200, "cid"=>$id));
    }






private function upload_candidate_profiles($file){

        ini_set('memory_limit', '512M');

        $errorCountResume = 0;

        $data = $this->getJobsFromFile($file,"candidate"); // Get the data from the Excel file

		if($data == null){
        	return "Invalid Data format  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; ";
        }

        array_shift($data);
		
		

		$i=0;
        foreach ($data as $key => $dataDetails) {

            try {
            	$dni_category = $dataDetails[28];
                $phoneNumber = $dataDetails[23];
                // Remove any non-digit characters
                $cleanedNumber = preg_replace('/\D/', '', $phoneNumber);

                // Extract the last 10 digits
                if (strlen($cleanedNumber) >= 10) {
                    $cleanedNumber = substr($cleanedNumber, -10);
                } else {
                    $cleanedNumber = '';
                }


            	$cleanedExperience = $this->extractYears($dataDetails[7]);

                $cleanedAnnualSalary = preg_replace('/\D/', '', $dataDetails[25]);

                $numericSalary = 0;

                // Extract the numeric part from the string
                preg_match('/(\d+(\.\d+)?)/', $cleanedAnnualSalary, $matches);

                if (!empty($matches)) {
                    // Convert the extracted value to numeric format
                    $numericSalary = floatval($matches[1]) * 1000; // Convert lakhs to units

                }

                // Check if a user with role 2 and the given mobile number already exists
               
            
            	$email = trim($dataDetails[21]);

                $this->db->select('users.*');
		        $this->db->join('user_roles', 'users.id = user_roles.user_id', 'left');
		        $this->db->where('users.mobile', $cleanedNumber);
		        $this->db->where('users.email', $email);
		        $this->db->where('user_roles.role_id', 2);
		        $existingUser = $this->db->get('users')->row();



                if (!$existingUser) {

                    $userData = [
                        'name'       => trim($dataDetails[1]),
                        'mobile'     => $cleanedNumber,
                        'email'      => !empty($email) ? $email : '',
                        'password'   => "",
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ];

                    $this->db->insert("users",$userData);
                    $user_id = $this->db->insert_id();

                    $this->db->insert("user_roles",[
                        'user_id' => $user_id,
                        'role_id' => 2,
                    	'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
                } else {
                    $user_id = $existingUser->id;


                    $this->updateOrCreate(['user_id' => $user_id],['role_id' => 2],'user_roles');


                }

                // echo ($key + 1) . '==' . $user_id . PHP_EOL;

                $date = date_create_from_format('j F Y', $dataDetails[3]);

                $formattedDob = null;
                if ($date) {
                    $formattedDob = date_format($date, 'Y-m-d');
                }

                $this->addEducation($dataDetails[6], $user_id);

                $this->addCandidateWorkExperience($dataDetails[8], $dataDetails[2], 1, $user_id);


                $previousEmployer = $dataDetails[9];

                $companies = explode("\n", $previousEmployer);

                // Remove empty values and trim whitespace
                $companies = array_map('trim', array_filter($companies));

                // Output the individual company names
                foreach ($companies as $company) {
                    $this->addCandidateWorkExperience($company, $dataDetails[2], 0, $user_id);
                }


                $studentProfile = [
                    'resume'         => $this->downloadFile($dataDetails[29]),
                    'dni_category'   => $dni_category,
                    'gender'         => ucwords(strtolower($dataDetails[4])),
                    'job_role'       => empty($dataDetails[2]) ? rtrim($dataDetails[15], ',') : $dataDetails[2],
                    'location'       => $dataDetails[11],
                    'experience'     => $cleanedExperience,
                    'bio'            => '',
                    'skill'          => $dataDetails[10],
                    'dob'            => $formattedDob,
                    'desired_salary' => $numericSalary,
                    'created_at'     => date('Y-m-d H:i:s'),
                    'updated_at'     => date('Y-m-d H:i:s')
                ];


            	$i++;
                $this->updateOrCreate(['user_id' => $user_id],$studentProfile,'student_profiles');





            } catch (\Illuminate\Database\QueryException $e) {
                // Handle the exception for duplicate rows

                print_r($e->getMessage());

                if ($e->errorInfo[1] === 1062) {
                    // continue; // Skip the current row and continue with the next one
                } else {

                    //throw $e; // Re-throw the exception to terminate the script or handle it accordingly
                }
            } catch (Exception $e) {
                //throw $e; // Re-throw the exception to terminate the script or handle it accordingly
            }

        }

		return $i." Records uploaded successfully";

    }

	private function extractYears($text) {
    // Regular expression to match various spellings and pluralizations of "year"
    if (preg_match('/(\d+)\s*(?:years?|yrs?|y(?:\.)?)\b/i', $text, $matches)) {
        // Return the matched number of years as an integer
        return (int)$matches[1];
    }

    // Return null if no match is found
    return 0;
}




	private function downloadFile($url) {
    // Initialize cURL session
    $ch = curl_init($url);

    // Set cURL options
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_NOBODY, true); // We only want the headers

    // Execute cURL request
    $response = curl_exec($ch);

    // Check for cURL errors
    if (curl_errno($ch)) {
        echo 'cURL error: ' . curl_error($ch);
        return false;
    }

    // Get the headers size
    $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);

    // Extract the headers from the response
    $headers = substr($response, 0, $headerSize);

    // Parse headers to find the Content-Disposition header
    $fileName = null;
    foreach (explode("\r\n", $headers) as $header) {
        if (preg_match('/^Content-Disposition:.*filename="(.+)"$/i', $header, $matches)) {
            $fileName = $matches[1];
            break;
        }
    }

    // If filename is not found, use a default name
    if (!$fileName) {
        $fileName = basename(parse_url($url, PHP_URL_PATH));
    }

	$saveDirectory = '/var/www/html/uploads/resume/';
    // Set the full path to save the file
    $savePath = rtrim($saveDirectory, '/') . '/' . $fileName;

    // Reinitialize cURL to download the file content
    $ch = curl_init($url);
    $fp = fopen($savePath, 'w+');
    curl_setopt($ch, CURLOPT_FILE, $fp);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_FAILONERROR, true);

    // Execute cURL request to download the file
    $success = curl_exec($ch);

    // Close cURL and file handle
    curl_close($ch);
    fclose($fp);

    // Check for errors
    if ($success === false) {
        unlink($savePath); // Remove the file if download failed
        // echo "cURL Error: " . curl_error($ch);
        return false;
    }

    return $fileName;
}


    public function getResumeName($resume_id){
        // Directory where resumes are stored on the server
        $source_directory = '/var/www/html/uploads/resume/';

        // Create an empty array to store resume names
        $resume_data = '';

        $extensions = ['doc', 'docx', 'pdf'];
        $found = false; // Flag to indicate whether a valid file was found

        foreach ($extensions as $extension) {
            $source_file_name = $resume_id . '.' . $extension;
            $source_file_path = $source_directory . $source_file_name;

            if (file_exists($source_file_path)) {
                // Generate a new file name based on the current timestamp
                $new_file_name = $resume_id . '.' . $extension;


                $resume_data = $new_file_name;
                $found = true;
                break; // Exit the inner loop
            } else {
                $resume_data = $resume_id;
            }
        }

    	// echo $resume_data;
        // if (!$found) {
        //     $resume_data = '';
        // }

        return $resume_data;
    }

    private function addEducation($educationData, $userId){

        $cleanedEducation = $educationData;

        $pattern = '/\b(Institute\s*:\s*|institute\s*:\s*|Institute\s*:\s*|institute\s*:\s*)\b/';
        $splitData = preg_split($pattern, $cleanedEducation);

        $newDegree = $splitData[0];
        $newUniversity = isset($splitData[1]) ? $splitData[1] : '';


        $education = [
            'degree_id'     => $newDegree,
            'university_id' => $newUniversity,
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s')
        ];


        $this->updateOrCreate(['user_id' => $userId],$education,'student_education');


    }

    private function addCandidateWorkExperience($companyName, $jobRole, $isCurrent, $userId){

        if (empty($companyName)) {
            return;
        }

        if (!empty($companyName)) {

        	$this->db->where('company_name', $companyName);
        	$company_data = $this->db->get('employer_details')->row();


            // $company_data = EmployerDetail::where('company_name', $companyName)->first();

            if (empty($company_data)) {


            	$this->db->insert('employer_details',[
                    'company_name' => substr($companyName, 0, 255),
                    'created_at'   => date('Y-m-d H:i:s'),
                    'updated_at'   => date('Y-m-d H:i:s'),
                ]);
                $employer_id = $this->db->insert_id();

                
            } else {
                $employer_id = $company_data->id;
            }
        }

        // if (!empty($jobRole)) {

        $this->db->where('name', $jobRole);
        $role_data = $this->db->get('job_roles')->row();

       
        if (empty($role_data)) {

        	$this->db->insert('job_roles',[
                'name' => $jobRole
            ]);
            $role_id = $this->db->insert_id();

            $job_role_id = $role_id;
        } else {
            $job_role_id = $role_data->id;
        }
        // }

        $this->updateOrCreate(['user_id' => $userId, 'employer_id' => $employer_id],[
                'job_role_id'        => $job_role_id,
                'is_current_company' => $isCurrent == 1 ? 1 : 0,
                'description'        => null,
                'start_date'         => null,
                'end_date'           => null,
            ],'student_work_experiences');
    }








	public function upload_job_postings($file){
        ini_set('memory_limit', '512M');

        $data = $this->getJobsFromFile($file,"jobs"); // Get the data from the Excel file
    
    	if($data == null){
        	return "Invalid Data format  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; ";
        }

        $data = array_slice($data, 1); // Remove the header row

    	$i=0;
        foreach ($data as $dataDetails) {
            try {

                $jobRoleDetails = !empty($dataDetails[3]) ? $this->firstOrCreate(['name' => $dataDetails[3]], 'job_roles') : null;

                $employerDetails = $this->updateOrCreate(
                    ['company_name' => $dataDetails[0]],
                    ['company_details' => $dataDetails[1]],'employer_details'
                );

                $industryDetails = !empty($dataDetails[2]) ? $this->firstOrCreate(['name' => $dataDetails[2]],'industry_expertises') : null;

                $experienceDetails = explode('-', $dataDetails[6]);

                $pattern = '/\d+/';


                $min_experience = isset($experienceDetails[0]) ? $experienceDetails[0] : 0;


                if (preg_match_all($pattern, $min_experience, $matches)) {
                    // $matches[0] will contain an array of all matched integer values
                    $intValues = $matches[0];

                    $min_experience = isset($intValues[0]) ? $intValues[0] : 0;
                } else {
                    $min_experience = 0;
                }

                $max_experience = isset($experienceDetails[1]) ? $experienceDetails[1] : 100;

                if (preg_match_all($pattern, $max_experience, $matches)) {
                    // $matches[0] will contain an array of all matched integer values
                    $intValues = $matches[0];

                    $max_experience = isset($intValues[0]) ? $intValues[0] : 100;
                } else {
                    $max_experience = 100;
                }


                $pwd = strtolower($dataDetails[12]) == 'y' ? "PWD" : "";
                $lgbtq = strtolower($dataDetails[13]) == 'y' ? "LGBTQ+" : "";
                $veterans = strtolower($dataDetails[14]) == 'y' ? "Veterans" : "";
                $elderly = strtolower($dataDetails[15]) == 'y' ? "Elderly" : "";
                $women = strtolower($dataDetails[16] == 'y') ? 'Women' : "";

                $preference_category = implode(', ', array_filter([$pwd, $lgbtq, $veterans, $elderly, $women]));

                $jobDetails = [
                    'job_role_id'         => isset($jobRoleDetails->id) ? $jobRoleDetails->id : null,
                    'employee_id'         => 1,
                    'employer_id'         => isset($employerDetails->id) ? $employerDetails->id : null,
                    'industry_id'         => isset($industryDetails->id) ? $industryDetails->id : null,
                    'job_title'           => !empty($dataDetails[3]) ? $dataDetails[3] : null,
                    'city'                => !empty($dataDetails[10]) ? $dataDetails[10] : null,
                    'job_details'         => !empty($dataDetails[5]) ? $dataDetails[5] : null,
                    'skill_required'      => !empty($dataDetails[7]) ? $dataDetails[7] : null,
                    'minimum_exp'         => $min_experience,
                    'maximum_exp'         => $max_experience,
                    'salary'              => isset($dataDetails[9]) ? $dataDetails[9] : 0,
                    'employement_type'    => !empty($dataDetails[8]) ? $dataDetails[8] : null,
                    'education'           => '',
                    'job_expiry'          => null,
                    'applied_job_link'    => !empty($dataDetails[4]) ? $dataDetails[4] : null,
                    'vacancy'             => 0,
                    'preference_category' => $preference_category,
                    'created_at'          => date('Y-m-d H:i:s'),
                    'updated_at'          => date('Y-m-d H:i:s')
                ];
				$i++;
                $this->db->insert("jobs",$jobDetails);
	

            } catch (\Illuminate\Database\QueryException $e) {
                // Handle the exception for duplicate rows
                if ($e->errorInfo[1] === 1062) {
                    continue; // Skip the current row and continue with the next one
                } else {
                    //throw $e; // Re-throw the exception to terminate the script or handle it accordingly
                }
            } catch (Exception $e) {
                //throw $e; // Re-throw the exception to terminate the script or handle it accordingly
            }
        }
    	return $i." Records uploaded successfully";
    

    }


    private function getJobsFromFile($file,$type){
        $file = fopen($file,"r");
		// $filedata = fgetcsv($file);  
		// print_r($filedata);     
		$returnArray = Array(); 
		
		while (($filedata = fgetcsv($file)) !== FALSE) {
			if(trim($filedata[0]) == ""){
				break;
			}
        	$returnArray[] = $filedata;
        }
    
    	if($type == "jobs"){
        	if(!$this->arraysMatchExactly($returnArray[0], Array("Organisation","Overview","Sector","Job Role","URL link","Job Description","Experience","Skills","Job Type","Salary","Location","PWD","LGBTQ","Veterans","Elderly","Women","Logo URL:"))){
            	return null;
            }
        }else if($type == "candidate"){
        
        	if(!$this->arraysMatchExactly($returnArray[0], Array("Resume ID","Name","Designation","Date of Birth","Gender","Resume Title","Education","Exp. (Yrs)","Current Employer","Previous Employer(s)","Key Skills","Current Location","Nationality","Work Authorization","Category","Roles","Industry","Status","Source","Received Date","Address","Email","Phone","Mobile","Mobile Verified","Current Annual Salary (Rs. in Lacs)","Last Active","Notes","Categoty","Resume link"))){
            	return null;
            }
        }
    
    	
    
    
        return $returnArray;
    }


private function arraysMatchExactly($array1, $array2) {
    // Check if the arrays have the same length
    if (count($array1) !== count($array2)) {
        return false;
    }

    // Check if the arrays have the same keys
    if (array_keys($array1) !== array_keys($array2)) {
        return false;
    }

    // Check if the arrays have the same elements in the same order
    foreach ($array1 as $key => $value) {
        if ($array2[$key] !== $value) {
            return false;
        }
    }

    return true;
}


	public function firstOrCreate($data,$tbl){
    // echo "IN ".$tbl."<br>";
        // Check if a record with the given criteria exists
        $jobRole = $this->db->where($data)->get($tbl)->row();

        if ($jobRole) {
            // If record exists, return it
            return $jobRole;
        } else {
            // If record does not exist, create a new one
            $this->db->insert($tbl,$data);
            return $this->db->where($data)->get($tbl)->row();
        }
    }

     public function updateOrCreate($criteria, $data, $tbl){
     
     // echo "Up ".$tbl."<br>";
   
        // Check if a record with the given criteria exists
        $jobRole = $this->db->where($criteria)->get($tbl)->row();
     
     	// print_r($jobRole);
     
     
        if ($jobRole) {
            // If record exists, update it
            $this->db->where($criteria);
            $this->db->update($tbl,$data);
        } else {
            // If record does not exist, create a new one
        	
        
            $this->db->insert($tbl,array_merge($data,$criteria));
        }

     	// echo "Done <br>";
        // Return the updated or created record
        return $this->db->where($criteria)->get($tbl)->row();
    }























	
}
