<?php
require_once APPPATH.'libraries/razorpay/Razorpay.php';
use Razorpay\Api\Api;
use Razorpay\Api\Errors;


require_once APPPATH.'libraries/php-qrcode/lib/QrReader.php';

defined('BASEPATH') OR exit('No direct script access allowed');

class Developers extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		// if (!$this->ion_auth->logged_in())
		// {
		// 	redirect('auth/login', 'refresh');
		// }
		$this->load->library('CityPayChecksum');
		
	}
	public function signatures(){
		$this->load->view('admin/dev_signature');
	}

	public function generate_signature(){
		$this->load->view('admin/dev_generate_signature');
	}
	public function payout_api_doc(){
		$data['page'] = '';
		$this->load->view('admin/dev_api_doc',$data);
	}
	public function payin_api_doc(){
		$data['page'] = 'dev_payin_api.php';
		$this->load->view('admin/dev_api_doc',$data);
	}

	public function set_env($type){
		$config['test']['url'] = "https://test.payu.in/_payment";
		$config['test']['status_url'] = "https://test.payu.in/_payment";
		$config['test']['key'] = "eE5XQM";
		$config['test']['salt'] = "FK77sanHUdVZbSbIirKK8kkvKegOhojx";

		$config['prod']['url'] = "https://secure.payu.in/_payment";
		$config['prod']['status_url'] = "https://info.payu.in/merchant/postservice.php?form=2";
		$config['prod']['key'] = "GBAfVw";
		$config['prod']['salt'] = "bbIRmX3gum8bGYIbKbBnLGgmHH7jO8CV";	
		return $config[$type];
	}

	public function getStatus(){
		$env_conf = $this->set_env('test');

		$url = $env_conf['status_url'];		
		$str = $env_conf['key'].'|check_upi_txn_status|1xnid109282634890|'.$env_conf['salt'];
		// echo $str; exit;
		$data = "key=".$env_conf['key']."&command=check_upi_txn_status&var1=1xnid109282634890&hash=".hash('sha512',$str);


		// echo $data;
		$res = $this->make_call($data,$url);
		$res = json_decode($res);
		if($res->result){
			$res_data = json_decode(base64_decode($res->result));
			$txn_status = $res_data->status;
			echo $txn_status."<br><pre>";
			print_r($res_data);
		}else{
			print_r($res);
		}

	}

	public function upi_intent(){
		//get env
		$env_conf = $this->set_env('prod');

		$url = $env_conf['url'];
		$str = $env_conf['key'].'|1xnid109282634810|11.00|iPhone|RajaUser|nj248591@gmail.com|||||||||||'.$env_conf['salt'];
		// echo $str; exit;
		$data = "key=".$env_conf['key']."&txnid=1xnid109282634810&amount=11.00&firstname=RajaUser&email=nj248591@gmail.com&phone=9867248591&productinfo=iPhone&txn_s2s_flow=2&pg=UPI&bankcode=INTENT&surl=https://apiplayground-response.herokuapp.com/&furl=https://apiplayground-response.herokuapp.com/&s2s_client_ip=49.36.96.54&s2s_device_info=Mozilla/5.0 (iPhone; CPU iPhone OS 16_1_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148&hash=".hash('sha512',$str);


		//echo $data;
		$res = $this->make_call($data,$url);

		echo $res;



	}

	public function pg_page(){
		$data['token'] = "";
		$this->load->view('front/cashfree',$data);
	}


	public function upi_collect(){
		// //get env
		$env_conf = $this->set_env('test');

		// $url = $env_conf['url'];
		// $str = $env_conf['key'].'|1xnid109282634890|10.00|iPhone|RajaUser|nj248591@gmail.com|||||||||||'.$env_conf['salt'];
		// // echo $str; exit;
		// $data = "key=".$env_conf['key']."&txnid=1xnid109282634890&amount=10.00&firstname=RajaUser&email=nj248591@gmail.com&phone=9867248591&productinfo=iPhone&txn_s2s_flow=2&pg=UPI&bankcode=UPI&vpa=9867248591@paytm&surl=https://apiplayground-response.herokuapp.com/&furl=https://apiplayground-response.herokuapp.com/&s2s_client_ip=49.36.96.54&s2s_device_info=Mozilla/5.0 (iPhone; CPU iPhone OS 16_1_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148&hash=".hash('sha512',$str);


		// //echo $data;
		// $res = $this->make_call($data,$url);

		// echo $res;


		// // validate response hash
		// $res = json_decode(base64_decode("eyJzdGF0dXMiOiJzdWNjZXNzIiwicmVzdWx0Ijp7Im1paHBheWlkIjoiNDAzOTkzNzE1NTI4Mjk2MDc5IiwibW9kZSI6IlVQSSIsInN0YXR1cyI6InBlbmRpbmciLCJrZXkiOiJlRTVYUU0iLCJ0eG5pZCI6IjF4bmlkMTA5MjgyNjM0ODkwIiwiYW1vdW50IjoiMTAuMDAiLCJhZGRlZG9uIjoiMjAyMy0wMi0xMSAxNTowMTo1MCIsInByb2R1Y3RpbmZvIjoiaVBob25lIiwiZmlyc3RuYW1lIjoiUmFqYVVzZXIiLCJsYXN0bmFtZSI6IiIsImFkZHJlc3MxIjoiIiwiYWRkcmVzczIiOiIiLCJjaXR5IjoiIiwic3RhdGUiOiIiLCJjb3VudHJ5IjoiIiwiemlwY29kZSI6IiIsImVtYWlsIjoibmoyNDg1OTFAZ21haWwuY29tIiwicGhvbmUiOiI5ODY3MjQ4NTkxIiwidWRmMSI6IiIsInVkZjIiOiIiLCJ1ZGYzIjoiIiwidWRmNCI6IiIsInVkZjUiOiIiLCJ1ZGY2IjoiIiwidWRmNyI6IiIsInVkZjgiOiIiLCJ1ZGY5IjoiIiwidWRmMTAiOiIiLCJjYXJkX3Rva2VuIjoiIiwiY2FyZF9ubyI6IiIsImZpZWxkMCI6IiIsImZpZWxkMSI6Ijk4NjcyNDg1OTFAcGF5dG0iLCJmaWVsZDIiOiIiLCJmaWVsZDMiOiIiLCJmaWVsZDQiOiJOaXRlc2ggUiBOYWhhciIsImZpZWxkNSI6IiIsImZpZWxkNiI6IiIsImZpZWxkNyI6IiIsImZpZWxkOCI6IiIsImZpZWxkOSI6IlRyYW5zYWN0aW9uIEluaXRpYXRlZCBTdWNjZXNzZnVsbHkiLCJwYXltZW50X3NvdXJjZSI6InBheXVQdXJlUzJTIiwiUEdfVFlQRSI6IlVQSS1QRyIsImVycm9yIjoiRTAwMCIsImVycm9yX01lc3NhZ2UiOiJObyBFcnJvciIsIm5ldF9hbW91bnRfZGViaXQiOiIwIiwiZGlzY291bnQiOiIwLjAwIiwib2ZmZXJfa2V5IjoiIiwib2ZmZXJfYXZhaWxlZCI6IiIsInVubWFwcGVkc3RhdHVzIjoiaW4gcHJvZ3Jlc3MiLCJoYXNoIjoiZjA5MzI1NTZiZWQzNDE2NmJlMTFhY2E0NjhhOGU3YTg4ZWM3OWQwNzk1ZDNjZjcxOWI2NmFjMTQzYTcwOTM2NmI1ODM3M2U0N2MzMjkyNjg0MjNkYzY5Yjk2ZDY3YWExMzYwYmY3ZTI3NmIyNjJjZmY4ODI5NWJkZmVmZTg4YzgiLCJiYW5rX3JlZl9ubyI6IiIsImJhbmtfcmVmX251bSI6IiIsImJhbmtjb2RlIjoiVVBJIiwic3VybCI6Imh0dHBzOlwvXC9hcGlwbGF5Z3JvdW5kLXJlc3BvbnNlLmhlcm9rdWFwcC5jb21cLyIsImN1cmwiOiJodHRwczpcL1wvYXBpcGxheWdyb3VuZC1yZXNwb25zZS5oZXJva3VhcHAuY29tXC8iLCJmdXJsIjoiaHR0cHM6XC9cL2FwaXBsYXlncm91bmQtcmVzcG9uc2UuaGVyb2t1YXBwLmNvbVwvIiwibWVDb2RlIjoie1wiXCI6bnVsbH0ifX0="));

		// $str = $env_conf['salt']."|".$res->result->status."|||||||||||nj248591@gmail.com|RajaUser|iPhone|10.00|1xnid109282634890|".$env_conf['key'];


		// echo hash('sha512',$str);



	}

	public function make_call($data,$url){

		$ch = curl_init($url);
		// curl_setopt($req, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		// $headers = array( "Content-Type: application/x-www-form-urlencoded", ); 
		// curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/x-www-form-urlencoded'));		

		//echo $data;
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		$resp = curl_exec($ch);
		curl_close($ch);
		// print_r($resp);
		return $resp;


	}


	public function test(){
		// echo $this->config->item('webhook')['surl'];exit;
		$mystring = 'eyJzdGF0dXMiOiJzdWNjZXNzIiwicmVzdWx0Ijp7Im1paHBheWlkIjoiNzYwMTI2NTU4NSIsIm1vZGUiOiJVUEkiLCJzdGF0dXMiOiJwZW5kaW5nIiwia2V5IjoiTWVyY2hhbnRLZXkiLCJ0eG5pZCI6IjZiMmYzZDY4NWVjMWJiYTdkZDRiIiwiYW1vdW50IjoiMTAuMDAiLCJhZGRlZG9uIjoiMjAxOC0xMS0wMSAxOTo1NjozMiIsInByb2R1Y3RpbmZvIjoiUHJvZHVjdCBJbmZvIiwiZmlyc3RuYW1lIjoiUGF5dS1Vc2VyIiwibGFzdG5hbWUiOiIiLCJhZGRyZXNzMSI6IiIsImFkZHJlc3MyIjoiIiwiY2l0eSI6IiIsInN0YXRlIjoiIiwiY291bnRyeSI6IiIsInppcGNvZGUiOiIiLCJlbWFpbCI6InRlc3RAZXhhbXBsZS5jb20iLCJwaG9uZSI6IjEyMzQ1Njc4OTAiLCJ1ZGYxIjoiIiwidWRmMiI6IiIsInVkZjMiOiIiLCJ1ZGY0IjoiIiwidWRmNSI6IiIsInVkZjYiOiIiLCJ1ZGY3IjoiIiwidWRmOCI6IiIsInVkZjkiOiIiLCJ1ZGYxMCI6IiIsImNhcmRfdG9rZW4iOiIiLCJjYXJkX25vIjoiIiwiZmllbGQwIjoiIiwiZmllbGQxIjoiYWJjZEB1cGkiLCJmaWVsZDIiOiIiLCJmaWVsZDMiOiIiLCJmaWVsZDQiOiIiLCJmaWVsZDUiOiIiLCJmaWVsZDYiOiIiLCJmaWVsZDciOiIiLCJmaWVsZDgiOiIiLCJmaWVsZDkiOiIiLCJwYXltZW50X3NvdXJjZSI6InBheXVQdXJlUzJTIiwiUEdfVFlQRSI6IkFYSVNVIiwiZXJyb3IiOiJFMDAwIiwiZXJyb3JfTWVzc2FnZSI6Ik5vIEVycm9yIiwibmV0X2Ftb3VudF9kZWJpdCI6IjAiLCJhZGRpdGlvbmFsQ2hhcmdlcyI6IjI5LjUiLCJ1bm1hcHBlZHN0YXR1cyI6ImluIHByb2dyZXNzIiwiaGFzaCI6IjU2NzQ3OGE5ZDUyMzhlZTIyZGFhMDM2ZWMwMjAxMzk0OGY2YjgwNGUzMWNhYzNkYmQyMDc1NmU5ZjFkNDFlMjI4ZTQxYzJkYjcwZmU4ZWRlZmMyNDBiOTQwODZlN2QzN2Y4ZDQ2OTA4MzU4Y2NjNzA4Y2JjNWVlNTJjMjlkYWEwIiwiYmFua19yZWZfbm8iOiJBWEk5MTEwMDAwMDAwMDQ5MTg0NzY2MTU0MTc5OTcwNTY5OCIsImJhbmtfcmVmX251bSI6IkFYSTkxMTAwMDAwMDAwNDkxODQ3NjYxNTQxNzk5NzA1Njk4IiwiYmFua2NvZGUiOiJVUEkiLCJzdXJsIjoiaHR0cHM6XC9cL2FkbWluLnBheXUuaW5cL3Rlc3RfcmVzcG9uc2UiLCJjdXJsIjoiaHR0cHM6XC9cL2FkbWluLnBheXUuaW5cL3Rlc3RfcmVzcG9uc2UiLCJmdXJsIjoiaHR0cHM6XC9cL2FkbWluLnBheXUuaW5cL3Rlc3RfcmVzcG9uc2UifX0
';


		//$mystring = '{"result":null,"status":"failed","error":"E1617","message":"Invalid vpa"}';
		if($a = base64_decode($mystring, true)){
			$a = json_decode($a);
		}else{
			$a = json_decode($mystring);
		}
		echo "<pre>";
		print_r($a);

		// $post = json_decode(file_get_contents('php://input'), true);

		// print_r($post);

		// $paytmParams['name'] = "Nitesh";
		// $paytmParams['contact'] = "9123456781";
		// $paytmParams['type']['name'] = "customer";
		// $paytmParams['reference_id'] = "12345678901";

		// // $paytmChecksum = CityPayChecksum::generateSignature($paytmParams, 'uMH4A6yyLtvlgAfOdt48tCI0Vd6EvZgH');

		// $paytmChecksum =  "O1Qf4t59R4JHc0Hz6ce0NJ+MqZrobSvFUI03DEhGKojTpAxomPcf+vgYm9QQeff8f6WP0azskJRcJp9+lHQ9eNayCUXe2GuR9PdS5r6YPZ0=";


		// $verifySignature = CityPayChecksum::verifySignature($paytmParams, 'uMH4A6yyLtvlgAfOdt48tCI0Vd6EvZgH', $paytmChecksum);

		// echo @$paytmChecksum;
		// echo @$verifySignature;

	}

	public function test2(){
		
		$paytmParams['type']['gender'] = "male";
		$paytmParams['type']['name'] = "customer";	
		$paytmParams['name'] = "Nitesh";	
		$paytmParams['reference_id'] = "12345678901";
		
		$paytmParams['contact'] = "9123456781";

		// // ksort($paytmParams);
		// // echo json_encode($paytmParams);
		// $a = '{"contact":"9123456781","name":"Nitesh","reference_id":"12345678901","type":{"name":"customer","gender":"male"}}';
		// $b = '{"contact":"9123456781","name":"Nitesh","reference_id":"12345678901","type":{"gender":"male","name":"customer"}}';

		// $paytmChecksum = CityPayChecksum::generateSignature($a, 'uMH4A6yyLtvlgAfOdt48tCI0Vd6EvZgH');

		// $verifySignature = CityPayChecksum::verifySignature($b, 'uMH4A6yyLtvlgAfOdt48tCI0Vd6EvZgH', $paytmChecksum);

		// echo @$paytmChecksum."<br>";
		// echo @$verifySignature;



			
			$post['name'] = "gautam khanna";
			$post['email'] = "gautam@khanna.com";
			$post['contact'] = "9000000000";
			$post['type'] = "customer";
			$post['reference_id'] = "13123123123123123";

			$post['signature'] = $this->generateSignature($post);

			echo "<pre>";
			print_r($post);


			echo $this->verifySignature($post);
		




		// ksort($paytmParams);
		// // echo "<pre>";
		// // print_r($paytmParams);

		// $paytmParams = array_map(function ($value){
		// 	echo $value;
		// 	return ($value !== null && strtolower($value) !== "null") ? $value : "";
	 //  	}, $paytmParams);

	 //  	// print_r($paytmParams);
	 //  	// $final = implode("|", $paytmParams);

	 //  	// print_r($final);

	}


	function test12(){
		
		    // $post["account_type"] = "VPA";
		    // $post["contact_id"] =  "0000000002";		    
		    // $post["vpa"]['address'] = "8850631237@ybl";
		    // $post["reference_id"] =  "XYZ-Transaction-ID-502";

		    // echo $this->generateSignature($post);
		// $vpa = "a@paytm";
		// echo preg_match("/^[a-zA-Z0-9.-]{2,256}@[a-zA-Z][a-zA-Z]{2,64}$/",$vpa);

		$page = 'PGh0bWw+PGJvZHk+PGZvcm0gbmFtZT0icGF5bWVudF9wb3N0IiBpZD0icGF5bWVudF9wb3N0IiBhY3Rpb249Imh0dHBzOi8vYXBpdGVzdC5wYXl1LmluL3B1YmxpYy8jL2M5ZDNlZTFjY2U1NmM4OTY4YmRhNmY2MzlkZmJhMjVmYWEwNjFiN2EyMWI5NjM0YWI0ZDQzZDRiY2ZhZjdmOWQvdXBpTG9hZGVyIiBtZXRob2Q9ImdldCI+PC9mb3JtPjxzY3JpcHQgdHlwZT0ndGV4dC9qYXZhc2NyaXB0Jz4KICAgICAgICAgICAgICAgICAgICAgICAgICAgIHdpbmRvdy5vbmxvYWQ9ZnVuY3Rpb24oKXsKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBkb2N1bWVudC5mb3Jtc1sncGF5bWVudF9wb3N0J10uc3VibWl0KCk7CiAgICAgICAgICAgICAgICAgICAgICAgICAgICB9CiAgICAgICAgICAgICAgICAgICAgICAgIDwvc2NyaXB0PjwvYm9keT48L2h0bWw+';

		echo base64_decode($page);


		


	}

	public function generateSignature($post_array){
		$string = json_encode($post_array);
		return hash('sha512', $string.'icXknGlJtuKy1gS2cQ9Z4oPLVNx1vl9q');
	}

	public function verifySignature($response_array){
		$signature = $response['signature'];
		unset($response['signature']);
		$string = json_encode($response);
		$hash = hash('sha512', $string.'icXknGlJtuKy1gS2cQ9Z4oPLVNx1vl9q');

		if($hash == $signature){
			return true;
		}
		return false;
	}

	public function test13($status=0){
		log_message("error", "merchant webhook post: ".$status.json_encode($_POST));
		echo $status;

	}

	public function test14(){
		// echo '<html><body><form name="payment_post" id="payment_post" action="https://apitest.payu.in/public/#/da7fd1363dddb5a48e9cd6af67c4b0668c1269c53e095e2d6ad057b470ab9280/upiLoader" method="get"></form><script type="text/javascript">
  //                           window.onload=function(){
  //                               document.forms["payment_post"].submit();
  //                           }
  //                       </script></body></html>';

		
		
		$this->load->view('pay-page',$_GET);	
	}
	public function test15($txnid,$mid){
		// $m_refid = CityPayChecksum::createMRefrenceID($mid,$txnid);
		// $this->db->where('reference_id',$m_refid);
		// $this->db->select('pg_res_data');
		// $row = $this->db->get('payin_txn')->row();

		// if($row->pg_res_data){
		// 	$pg_res = base64_decode(json_decode($row->pg_res_data)->result->acsTemplate);
		// 	echo $pg_res;
		// }
		header('X-Frame-Options: *');
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
		echo '<html><body><form name="payment_post" id="payment_post" action="https://apitest.payu.in/public/#/89dfa872455c5ff51936827d11b450fbe12f4ecb190c56f9b092f9c0bdec83eb/upiLoader" method="get"></form><script type="text/javascript">
                            window.onload=function(){
                                document.forms["payment_post"].submit();
                            }
                        </script></body></html>';

		
		

	}

	public function test16(){
		echo '<html><body><form name="payment_post" id="payment_post" action="http://localhost:8888/citypay/developers/test14" method="get"><input name="txnid" value="txn_00000CC00130" type="hidden"><input name="code" value="7" type="hidden"></form><script type="text/javascript">window.onload=function(){document.forms["payment_post"].submit();}</script></body></html>';



	}


	public function test19(){

		$client_id = '10563910723ce4c82191fc7c6c936501';
		$client_secret = '9df377705689b10ffecad44581de4474d8c4bc38';
		$host = 'https://api.cashfree.com/';


		$curl = curl_init();

		curl_setopt_array($curl, [
		  CURLOPT_URL => "https://cac-api.cashfree.com/cac/v1/authorize",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_HTTPHEADER => [
		    'x-client-id: '.$client_id,
			'x-client-secret: '.$client_secret,
		    "accept: application/json"
		  ],
		]);

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  echo $response;
		}

	}



	public function test20(){
		// //test
		// $client_id = '599849edc21d81dec42ad668f48995';
		// $client_secret = '315e0c23d1418ea331a40281ed9f560463aab68f';
		//$host = 'https://sandbox.cashfree.com/'

		//prod3
		$client_id = '10563910723ce4c82191fc7c6c936501';
		$client_secret = '9df377705689b10ffecad44581de4474d8c4bc38';
		$host = 'https://api.cashfree.com/';

		$url = $host.'pg/orders';
		$data = '{"customer_details":{"customer_id":"1233","customer_email":"nj@nj.com","customer_phone":"1231231231"},"order_id":"1231231231","order_amount":11.12,"order_currency":"INR"}';


		// {"cf_order_id":1801002757,"created_at":"2023-03-13T21:16:14+05:30","customer_details":{"customer_id":"1233","customer_name":null,"customer_email":"nj@nj.com","customer_phone":"1231231231"},"entity":"order","order_amount":11.12,"order_currency":"INR","order_expiry_time":"2023-04-12T21:16:14+05:30","order_id":"1231231231","order_meta":{"return_url":null,"notify_url":null,"payment_methods":null},"order_note":null,"order_splits":[],"order_status":"ACTIVE","order_tags":null,"payment_session_id":"session_s2u62ZqG2RL9bx7-ON1b_0bS7EUSL33g9Y00YzXhLgDi0cTZ5hS_wDu3VstgCI4x-iYQ7f9OffmAnTeUV4MP9EntzO8dQXj4PGnhaqa5ONH3","payments":{"url":"https://api.cashfree.com/pg/orders/1231231231/payments"},"refunds":{"url":"https://api.cashfree.com/pg/orders/1231231231/refunds"},"settlements":{"url":"https://api.cashfree.com/pg/orders/1231231231/settlements"},"terminal_data":null}



		$url = $host.'pg/orders/sessions';
		$data = '{"payment_method":{"upi":{"channel":"link"}},"payment_session_id":"session_s2u62ZqG2RL9bx7-ON1b_0bS7EUSL33g9Y00YzXhLgDi0cTZ5hS_wDu3VstgCI4x-iYQ7f9OffmAnTeUV4MP9EntzO8dQXj4PGnhaqa5ONH3"}';



		//$url = $host.'pg/orders/1231231231';
		

		$header= array('accept: application/json',
					    'content-type: application/json',
					    'x-api-version: 2022-09-01',
					    'x-client-id: '.$client_id,
					    'x-client-secret: '.$client_secret
					);





		$ch = curl_init($url);
		// curl_setopt($req, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		// $headers = array( "Content-Type: application/x-www-form-urlencoded", ); 
		// curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		curl_setopt( $ch, CURLOPT_HTTPHEADER, $header);		

		//echo $data;
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		$resp = curl_exec($ch);
		curl_close($ch);
		print_r($resp);
		// return $resp;

// {"cf_order_id":3835257,"created_at":"2023-03-12T22:44:40+05:30","customer_details":{"customer_id":"1233","customer_name":null,"customer_email":"nj@nj.com","customer_phone":"1231231231"},"entity":"order","order_amount":11.12,"order_currency":"INR","order_expiry_time":"2023-04-11T22:44:40+05:30","order_id":"1231231231","order_meta":{"return_url":null,"notify_url":null,"payment_methods":null},"order_note":null,"order_splits":[],"order_status":"ACTIVE","order_tags":null,"payment_session_id":"session_MBxKVwyxYTOhIJAq2VOLA-NS3S-akqw1TKgEDoZ9bFxK4Z2u4ef5cGRiJoQvS7gLZi7BFaf9fUeGWrkwWIEVvq7JnpPx8Dswr4D6YEFpqsJ_","payments":{"url":"https://sandbox.cashfree.com/pg/orders/1231231231/payments"},"refunds":{"url":"https://sandbox.cashfree.com/pg/orders/1231231231/refunds"},"settlements":{"url":"https://sandbox.cashfree.com/pg/orders/1231231231/settlements"},"terminal_data":null}



		// {
		// 	"action": "custom",
		// 	"cf_payment_id": 1490108720,
		// 	"channel": "link",
		// 	"data": {
		// 		"url": null,
		// 		"payload": {
		// 			"bhim": "https://payments-test.cashfree.com/pgbillpayuiapi/simulator/1490108720?txnId=1490108720\u0026amount=11.12\u0026pa=cashfree@testbank\u0026pn=Cashfree\u0026tr=1490108720\u0026am=11.12\u0026cu=INR\u0026mode=00\u0026purpose=00\u0026mc=5732\u0026tn=Cashfree%20Simulator%20Payment",
		// 			"default": "https://payments-test.cashfree.com/pgbillpayuiapi/simulator/1490108720?txnId=1490108720\u0026amount=11.12\u0026pa=cashfree@testbank\u0026pn=Cashfree\u0026tr=1490108720\u0026am=11.12\u0026cu=INR\u0026mode=00\u0026purpose=00\u0026mc=5732\u0026tn=Cashfree%20Simulator%20Payment",
		// 			"gpay": "https://payments-test.cashfree.com/pgbillpayuiapi/simulator/1490108720?txnId=1490108720\u0026amount=11.12\u0026pa=cashfree@testbank\u0026pn=Cashfree\u0026tr=1490108720\u0026am=11.12\u0026cu=INR\u0026mode=00\u0026purpose=00\u0026mc=5732\u0026tn=Cashfree%20Simulator%20Payment",
		// 			"paytm": "https://payments-test.cashfree.com/pgbillpayuiapi/simulator/1490108720?txnId=1490108720\u0026amount=11.12\u0026pa=cashfree@testbank\u0026pn=Cashfree\u0026tr=1490108720\u0026am=11.12\u0026cu=INR\u0026mode=00\u0026purpose=00\u0026mc=5732\u0026tn=Cashfree%20Simulator%20Payment",
		// 			"phonepe": "https://payments-test.cashfree.com/pgbillpayuiapi/simulator/1490108720?txnId=1490108720\u0026amount=11.12\u0026pa=cashfree@testbank\u0026pn=Cashfree\u0026tr=1490108720\u0026am=11.12\u0026cu=INR\u0026mode=00\u0026purpose=00\u0026mc=5732\u0026tn=Cashfree%20Simulator%20Payment",
		// 			"web": "https://sandbox.cashfree.com/pg/view/upi/1cd2g9g.session_MBxKVwyxYTOhIJAq2VOLA-NS3S-akqw1TKgEDoZ9bFxK4Z2u4ef5cGRiJoQvS7gLZi7BFaf9fUeGWrkwWIEVvq7JnpPx8Dswr4D6YEFpqsJ_.1dd1df7e98eecb4e00e8cab3acbe7497"
		// 		},
		// 		"content_type": null,
		// 		"method": null
		// 	},
		// 	"payment_amount": 11.12,
		// 	"payment_method": "upi"
		// }


		// {
		//   "cf_order_id": 3835257,
		//   "created_at": "2023-03-12T22:44:40+05:30",
		//   "customer_details": {
		//     "customer_id": "1233",
		//     "customer_name": null,
		//     "customer_email": "nj@nj.com",
		//     "customer_phone": "1231231231"
		//   },
		//   "entity": "order",
		//   "order_amount": 11.12,
		//   "order_currency": "INR",
		//   "order_expiry_time": "2023-04-11T22:44:40+05:30",
		//   "order_id": "1231231231",
		//   "order_meta": {
		//     "return_url": null,
		//     "notify_url": null,
		//     "payment_methods": null
		//   },
		//   "order_note": null,
		//   "order_splits": [],
		//   "order_status": "PAID",
		//   "order_tags": null,
		//   "payment_session_id": "session_fNN9aaHGr0H2c_gFhf3hyDFkL_z8vFpBFTJUhzMlqStn2hpcJjrP3ChtzMtJ9sJXHGQXhqpHPM1YNdvJdG3ljPKGkLH9a_S_7EpZavUHvXQ1",
		//   "payments": {
		//     "url": "https://sandbox.cashfree.com/pg/orders/1231231231/payments"
		//   },
		//   "refunds": {
		//     "url": "https://sandbox.cashfree.com/pg/orders/1231231231/refunds"
		//   },
		//   "settlements": {
		//     "url": "https://sandbox.cashfree.com/pg/orders/1231231231/settlements"
		//   },
		//   "terminal_data": null
		// }


	}


	public function test21(){

		// "upi://pay?ver=01&mode=15&pa=rzr.qrezipikserv24771729@icic&pn=EZIPIKSERVICESPRIVATELIMITED&tr=RZPLQiSgYkwZINfV4qrv2&cu=INR&mc=5411&qrMedium=04&tn=PaymenttoEZIPIKSERVICESPRIVATELIMITED&am=10"

		//echo APPPATH;

		

		// $key_id = 'rzp_test_GIvR9HhLYQbCNL';
		// $secret = 'Z5rdaPi0hJdteR51iufqF28Y';

		// $key_id = 'rzp_test_iwxXJD8kADAbGE';
		// $secret = 'reNqmsLFVP9Nc7YcSZ3DzRWC';

		// //prod
		$key_id = 'rzp_live_oodGu7ciHAM0Dd';
		$secret = 'WGZERnKpnpXr06JHdB1eKFhG';

		$api = new Api($key_id, $secret);

		//$res = $api->qrCode->create(array("type" => "upi_qr", "usage" => "single_use","fixed_amount" => 1,"payment_amount" => 3,"description" => "For Store 1","close_by" => 1681615838,"notes" => array("purpose" => "Test UPI QR code notes")));


		// https://api.razorpay.com/v1/payments/qr_codes/Razorpay\Api\QrCode Object ( [attributes:protected] => Array ( [id] => qr_LR2uYPn1ytTyH6 [entity] => qr_code [created_at] => 1678718656 [name] => [usage] => single_use [type] => upi_qr [image_url] => https://rzp.io/i/fvSF2Y7N [payment_amount] => 2 [status] => active [description] => For Store 1 [fixed_amount] => 1 [payments_amount_received] => 0 [payments_count_received] => 0 [notes] => Razorpay\Api\QrCode Object ( [attributes:protected] => Array ( [purpose] => Test UPI QR code notes ) ) [customer_id] => [close_by] => 1681615838 [tax_invoice] => Razorpay\Api\QrCode Object ( [attributes:protected] => Array ( ) ) ) )

		// print_r($res);
		// Razorpay\Api\QrCode Object ( [attributes:protected] => Array ( [id] => qr_LQinjCH9em8Fkb [entity] => qr_code [created_at] => 1678647835 [name] => Store Front Display [usage] => single_use [type] => upi_qr [image_url] => https://rzp.io/i/0Jy1Bnm8 [payment_amount] => 300 [status] => active [description] => For Store 1 [fixed_amount] => 1 [payments_amount_received] => 0 [payments_count_received] => 0 [notes] => Razorpay\Api\QrCode Object ( [attributes:protected] => Array ( [purpose] => Test UPI QR code notes ) ) [customer_id] => [close_by] => 1681615838 [tax_invoice] => Razorpay\Api\QrCode Object ( [attributes:protected] => Array ( ) ) ) )


		//$res = $api->qrCode->fetch('qr_LQinjCH9em8Fkb');




		// $res = $api->order->create(array('receipt' => '1234', 'amount' => 100, 'currency' => 'INR', 'notes'=> array('key1'=> 'value3','key2'=> 'value2')));

		// https://api.razorpay.com/v1/orders/Razorpay\Api\Order Object ( [attributes:protected] => Array ( [id] => order_LRJzAfbxRm9HE3 [entity] => order [amount] => 100 [amount_paid] => 0 [amount_due] => 100 [currency] => INR [receipt] => 1234 [offer_id] => [status] => created [attempts] => 0 [notes] => Razorpay\Api\Order Object ( [attributes:protected] => Array ( [key1] => value3 [key2] => value2 ) ) [created_at] => 1678778785 ) )


		$res = $api->payment->createUpi(array("amount" => 100,"currency" => "INR","order_id" => "order_LRJzAfbxRm9HE3","email" => "gaurav.kumar@example.com","contact" => "9123456789","method" => "upi","ip" => "192.168.0.103","referer" => "http","user_agent" => "Mozilla/5.0","description" => "Test flow","notes" => array("note_key" => "value1"),"upi" => array("flow" => "intent")));

		//$res = $api->payment->createUpi(array("amount" => 200,"currency" => "INR","order_id" => "order_Jhgp4wIVHQrg5H","email" => "gaurav.kumar@example.com","contact" => "9123456789","method" => "upi","ip" => "192.168.0.103","referer" => "http","user_agent" => "Mozilla/5.0","description" => "Test flow","notes" => array("note_key" => "value1"),"upi" => array("flow" => "collect","vpa" => "gauravkumar@exampleupi","expiry_time" => 5)));


		// $api = new Api($key_id,""); // // Use Only razorpay key

		// $res = $api->payment->validateVpa(array('vpa'=>'9867248591@paytm'));

		print_r($res);
	}

	public function test22(){
		$qrcode = new QrReader(APPPATH.'libraries/QrCode-1.jpeg');
		$text = $qrcode->text();

		print_r($text);

	}

	public function removeParam($url, $param) {
	    $url = preg_replace('/(&|\?)'.preg_quote($param).'=[^&]*$/', '', $url);
	    $url = preg_replace('/(&|\?)'.preg_quote($param).'=[^&]*&/', '$1', $url);
	    return $url;
	}

	public function test33(){
		
		$url = 'upi://pay?pa=EZIPIKSERVICESONLINE@ybl&pn=Ezipik%20Services%20&am=370.92&mam=370.92&tr=2_tx_2OUq4t35nyRGbbbeqbCJO6TyLOK&tn=Payment%20for%202_tx_2OUq4t35nyRGbbbeqbCJO6TyLOK&mc=8999&mode=04&purpose=00&utm_campaign=B2B_PG&utm_medium=EZIPIKSERVICESONLINE&utm_source=2_tx_2OUq4t35nyRGbbbeqbCJO6TyLOK';
		echo $url;
		echo "<br>";
		echo "<br>";

		echo $this->removeParam($url, "mam");
		// tx_2OVMv0JbWzWd6auSywCeBBUEqxL
		// echo $url;
		// echo "<br>";
		// echo "<br>";
		
		// parse_str($url, $txn_data);
		// unset($txn_data['mam']);
		// // print_r($txn_data);
		// $new = http_build_query($txn_data);
		// echo "<br>";
		// echo "<br>";
		// // $new = implode('&', $txn_data);
		// echo $new;

		










		// $now = date('Y-m-d H:i:s', strtotime("+2 min"));		
		// $expiry = (new DateTime("2023-03-30T18:03:00.301642"))->format('Y-m-d H:i:s');
		
		// if($now <= $expiry){
		// 	echo "success";
		// }else{
		// 	echo "fail";
		// }

		// echo date('Y-m-d H:i:s');
		// $date = new DateTime("2023-03-18T12:59:40+05:30s");
		// echo $date->format('U'); 
		// echo $_SERVER['REMOTE_ADDR'];
// 		$res = 'CURRENCY=INR&GATEWAYNAME=PPBL&RESPMSG=Txn+Success&BANKNAME=&PAYMENTMODE=UPI&CUSTID=cust_2L5hNaf0dZ6SOun835zePsbKgZM&MID=PfQyrM62428488276569&MERC_UNQ_REF=&RESPCODE=01&TXNID=20230322010450000845235344550463804&TXNAMOUNT=249.46&ORDERID=2_tx_2NLzzAc5WcPhGDsu1GuT0u7Wwa4&STATUS=TXN_SUCCESS&BANKTXNID=308188744988&TXNDATETIME=2023-03-22+09%3A43%3A29.0&TXNDATE=2023-03-22';

// 		parse_str($res, $params);

// 		//print_r($params);

// $params = (object)$params;
// 		echo $params->CURRENCY;

	}


	////////////////payin///////////////////




// preg_match("/^[a-zA-Z0-9.-]{2,256}@[a-zA-Z][a-zA-Z]{2,64}$/",$post['vpa']['address'])


}
