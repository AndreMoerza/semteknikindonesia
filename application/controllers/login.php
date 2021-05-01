<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->load->model("user_model");
		$this->load->model("account_model");
        $this->load->library('form_validation');
	}
	
	public function index()
	{
		$this->load->view('login');
	}

	public function forgotpassword()
	{
		  
		$this->load->view('forgotpassword');
	}

	function aksi_resetpassword() {
		$username = $this->input->post('username');
		$clean = $this->security->xss_clean($username);  
		$userInfo = $this->account_model->getUserInfo($clean);  
		  
		if(!$userInfo){  
			$this->session->set_flashdata('errorreset', 'Username salah, silakan coba lagi.');  
			$this->load->view("forgotpassword");  
		}  
		else
		{
			 //build token   
                       
             $token = $this->account_model->insertToken($userInfo->username);              
             $qstring = $this->base64url_encode($token);           
             $url = base_url() . '/login/reset_password/token/' . $qstring;  
             $link = '<a href="' . $url . '">' . $url . '</a>';   
               
             $message = '';             
             $message .= '<strong>Hai, anda menerima email ini karena ada permintaan untuk memperbaharui  
                 password anda.</strong><br>';  
             $message .= '<strong>Silakan klik link ini:</strong> ' . $link;         
			
			 $from_email = "andre.moerza@gmail.com";
			 $to_email = "fatihabdulhanif@gmail.com";
			 //Load email library
			 $this->load->library('email');
			 $this->email->from($from_email, 'Identification');
			 $this->email->to($to_email);
			 $this->email->subject('Reset Password');
			 $this->email->message($message);

			 //Send mail
			if($this->email->send())
			{
				$this->session->set_flashdata("successreset","Congratulation Email Send Successfully.");
			} 
			else 
			{
				$this->session->set_flashdata("errorreset","You have encountered an error");
			}
			
			$this->load->view("forgotpassword");
		}
	}

	function aksi_login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		// $where = array(
		// 	'username' => $username,
		// 	'password' => md5($password)
		// 	);

		$cek = $this->user_model->cek_login($username, md5($password));

		if($cek->num_rows() > 0){
			$data_session = array(
				'nama' => $username,
				'type' => $cek->row(0)->type,
				'status' => 'login'
				);
 
			$this->session->set_userdata($data_session);
 
			redirect(base_url("admin"));
 
		}else{
			$this->session->set_flashdata('error', 'Username dan password salah !');
			$this->load->view("login");
		}
	}

	function logout(){
		$this->session->sess_destroy();
		redirect(base_url('login'));
	}

	public function reset_password()  
     {  
       $token = $this->base64url_decode($this->uri->segment(4));           
       $cleanToken = $this->security->xss_clean($token);  
         
       $user_info = $this->account_model->isTokenValid($cleanToken); //either false or array();          
         
       if(!$user_info){  
         $this->session->set_flashdata('sukses', 'Token tidak valid atau kadaluarsa');  
         redirect(base_url('login'),'refresh');   
       }    
   
	   $data["username"] = $user_info->username;
	   
	   $validation = $this->form_validation;
    	$validation->set_rules($this->account_model->rules());
		
       if ($validation->run() == FALSE) {    
         $this->load->view('reset_password', $data);  
       }else{  
                           
         $post = $this->input->post(NULL, TRUE);          
         $cleanPost = $this->security->xss_clean($post);              
         if(!$this->user_model->updatepwd($cleanPost)){  
           $this->session->set_flashdata('error', 'Update password gagal.');  
         }else{  
           $this->session->set_flashdata('success', 'Password anda sudah diperbaharui. Silakan login.');  
         }  
         $this->load->view("login");        
       }  
     }  


	public function base64url_encode($data) {   
		return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');   
	}   
	
	public function base64url_decode($data) {   
	return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));   
	}    
}
