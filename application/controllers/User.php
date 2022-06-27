<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __Construct() {
		parent::__Construct();	
		//$this->load->model("user_model"); 
		$this->load->model("user_model");  
	}
	 
	 
	public function index()
	{
		$this->load->view('header');
		$this->load->view('login');
		$this->load->view('footer');
	}

	/*
		Login form submit post data, validate for login for both user / admin 
	*/
	public function validateLogin() {
		$this->load->helper("form");
		$this->load->library("form_validation");
		$this->form_validation->set_rules("email","Email","required");
		$this->form_validation->set_rules("password","Password","required");
		

		if($this->form_validation->run() == false) {
			$this->session->set_flashdata("error","All fields are required");
			redirect(base_url("user"));
		}
		/* Reurn array with status (200  for loged in, 300,400 for error) and message*/
		$validated = $this->user_model->validateLogin();
		
		if($validated["status"] != 200 ) {
			//print_r($validated);
			$this->session->set_flashdata("error",$validated["message"]);
			 
			redirect(base_url("user"));	
		}else {
			$this->session->set_flashdata("success",$validated["message"]);
			redirect(base_url("home"));
		}
		 
	}


	/* User registration */
	public function signup() {
		//$this->session->set_flashdata("error","Errorrrrr");
		$this->load->view('header');
		$this->load->view('signup');
		$this->load->view('footer');
	}
	 
	  

	/*check email exist on user signup
	@param : post email
	*/
	public function checkEmailExist() {
		$email 				= $this->input->get("email");
		$emailExist 		=  $this->user_model->checkEmailExist($email);
		echo ($emailExist) 	? "false" : "true";
	}

	/*Save user data (sign up data )*/
	public function save() {
		$this->load->helper("form");
		$this->load->library("form_validation");
		$this->form_validation->set_rules("name","Name","required");
		$this->form_validation->set_rules("email","Email","required");
		$this->form_validation->set_rules("password","Password","required");
		$this->form_validation->set_rules("confirm_password","Confirm Password","required");

		if($this->form_validation->run() == false) {
			$this->session->set_flashdata("error","All fields are required");
			redirect(base_url("user/signup"));
		}
		$email = $this->input->post("email");
		/*server side validate for email exits or not */
		$emailExist 		= $this->user_model->checkEmailExist($email);

		if($emailExist) {
			$this->session->set_flashdata("form_error","Email already exist");
			redirect(base_url("user/signup"));
		}

		/*Save user record if  validate  return status (200 for  user created, 500 user not created) and message*/
		$saveRes = $this->user_model->saveUserRecord();
		/* */
		if($saveRes["status"] != 200 ) {	
			//echo "error"; exit;
			$this->session->set_flashdata("error",$saveRes["message"]);
			redirect(base_url("user/signup"));
		}else{
			//echo "success"; exit;
			$this->session->set_flashdata("success",$saveRes["message"]);
			//echo $this->session->flashdata("success");;exit;
			redirect(base_url("user"));
		}	
	}

	/* Profile pages*/
	public function profile() {
		if(!$this->session->isLogin) {
			redirect(base_url("home"));
		}

		$user_id 			= $this->session->id;
		$data['row'] 		=  $this->user_model->getRecordById($user_id);
		$this->load->view('header');
		$this->load->view('my_profile', $data);
		$this->load->view('footer');		
		
	}

	/*clent side validate email on edit profile*/
	public function checkEmailOnEdit() {
		$validateEmail = $this->user_model->checkEmailById();
		echo ($validateEmail)  ? "false" : "true";
	}

	/* Post data from profile page */
	public function updateProfile() {
		$this->load->helper("form");
		$this->load->library("form_validation");
		$this->form_validation->set_rules("name","Name","required");
		$this->form_validation->set_rules("email","Email","required");

		if($this->form_validation->run() == false) {
			$this->session->set_flashdata("error","All fields are required");
			redirect(base_url("user/profile"));
		}
        
		/* on updated return true else false*/
		$rowUpdated = $this->user_model->updateProfile();
		if($rowUpdated) {
			$this->session->set_flashdata("success","Profile details updated");
		}else{
			$this->session->set_flashdata("success","Profile details not updated");
		}
		redirect(base_url("user/profile"));
	}

	#################
	# Change Password 
	###############	
	public function change_password() {
		if(!$this->session->isLogin) {
			redirect(base_url("home"));
		}
		$data['heading'] = "Change Password";
		$this->load->view('header');
		$this->load->view('change_password',$data);
		$this->load->view('footer');		
	}

	/*Validate old password */
	public function validateOldPassword() {
		$password 	= $this->input->get("current_password");
		$id 		= $this->input->get("id");
		$validated  = $this->user_model->validateOldPassword($id, $password);  
		echo ($validated) ? "true" : "false";
	}

	/* Post form data (Update Password)*/
	public function updatePassword () {
	$this->load->helper("form");
		$this->load->library("form_validation");
		$this->form_validation->set_rules("current_password","Current Password","trim|required");
		$this->form_validation->set_rules("password","Password","trim|required");
		$this->form_validation->set_rules("confirm_password","Confirm Password","trim|required");

		if($this->form_validation->run() == false) {
			$this->session->set_flashdata("form_error","All fields are required");
			redirect(base_url("user/change_password"));
		}

		/*Servre side validate for current password*/
		$password 	= $this->input->post("current_password");
		$id 		= $this->input->post("id");

		$validated  = $this->user_model->validateOldPassword($id, $password);	
		//print_r($_POST); print_r($validated);exit;
		if(!$validated) {
			$this->session->set_flashdata("form_error","Invalid current password");
			redirect(base_url("user/change_password"));
		}

        
		/* on updated return true else false*/
		$rowUpdated = $this->user_model->updatePassword();
		if($rowUpdated) {
			$this->session->set_flashdata("success","Password updated successfully");
		}else{
			$this->session->set_flashdata("error","Profile not not updated");
		}
		redirect(base_url("user/change_password"));

	}





	/* Logout */
	public function logout() {
		$this->session->sess_destroy();
		redirect(base_url("user"));
	}
	

}
