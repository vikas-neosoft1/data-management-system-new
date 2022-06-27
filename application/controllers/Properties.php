<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Properties extends CI_Controller {





	public function property_search() {
		$data['records'] = $this->property_model->getPropertyRecordsBySeaach();
		$this->load->view('header');
		$this->load->view('property_grid', $data);
		$this->load->view('footer');
	}

	public function property_detail($id = "") {
		if( empty($id) ) {
			redirect(base_url("home"));
		}

		$data['row'] = $this->property_model->getPropertyDetailById($id);
		$this->load->view('header');
		$this->load->view('property_detail', $data);
		$this->load->view('footer');
		
	}


	/* Save user message on enquiry */
	public function saveUserMessage() {

		$property_id = $this->input->post("property_id");
		/* validate for login */
		if(!$this->session->isLogin) {
			$this->session->set_flashdata("error","Please login to send message.");
			redirect(base_url("properties/property_detail/".$property_id));
		}

		$this->load->helper("form");
		$this->load->library("form_validation");
		$this->form_validation->set_rules("name","Name","trim|required");
		$this->form_validation->set_rules("mobile","Mobile","required");
		$this->form_validation->set_rules("message","message","trim|required");

		if($this->form_validation->run() == false) {
			$this->session->set_flashdata("error","All fields are required");
			redirect(base_url("properties/property_detail/".$property_id));
		}

		$messageRes = $this->property_model->saveUserMessage();
		$property_id = $this->input->post("property_id");
		if($messageRes["status"] != 200 ) {	
			$this->session->set_flashdata("error",$messageRes["message"]);
		}else{
			$this->session->set_flashdata("success",$messageRes["message"]);
		}	

		redirect(base_url("properties/property_detail/".$property_id));

	}





	##########################
	## Admin 
	#########################


	public function __Construct() {
		parent::__Construct();	
		$this->load->model(["user_model","property_model"]);  
	}
	 
	/* show property tale listing to admin*/ 
	public function index()
	{

		//print_r($this->session->userdata()); exit;
		if($this->session->user_type != ADMIN ) {
			redirect(base_url("home"));
		}

		$data['heading'] = "Properties List";
		$data['records'] = $this->property_model->getPropertyRecords();
		$this->load->view('header');
		$this->load->view('property_listing', $data);
		$this->load->view('footer');
	}

	

	
	/* Add Edit property */
	public function add_edit($id = "") {
		$data['row'] = false;
		$data["row"] = false;
		$data["heading"] = "Add Property";
		if(!empty($id)) {
			$data["heading"] = "Edit Property";  
			$data["row"] = $this->property_model->getPropertyById($id);
		}

		$this->load->view('header');
		$this->load->view('add_edit_property',$data);
		$this->load->view('footer');
	}
	 
	  

	
	/* Save Property  record  */
	public function save() {
		$this->load->helper("form");
		$this->load->library("form_validation");
		$this->form_validation->set_rules("title","title","trim|required");
		$this->form_validation->set_rules("price","Price","required");
		$this->form_validation->set_rules("floor_area","Floor area","required");
		
		$this->form_validation->set_rules("bedroom","bedroom","trim|required");
		$this->form_validation->set_rules("bathroom","bathroom","required");
		$this->form_validation->set_rules("city","city","required");

		$this->form_validation->set_rules("address","address","trim|required");
		$this->form_validation->set_rules("description","description","required");
		$this->form_validation->set_rules("near_by","Near by","required");



		$id = $this->input->post("id");
		if($this->form_validation->run() == false) {
			$this->session->set_flashdata("error","All fields are required");
			redirect(base_url("properties/add_edit/".$id));
		}
		
		/*Save user record if  validate  return status (200 for  user created, 500 user not created) and message*/
		$saveRes = $this->property_model->saveProperty();
		
		/* upload images */
		$id = $saveRes["id"];
		if(!empty($id)) { 
			if( isset($_FILES['featured_images'])  && $_FILES['featured_images']['error'][0] == 0  ) {
				$uploadImges = $this->property_model->multiUpload("featured_images", $id,FEATURED_IMAGE,"./uploads/featured_images");
				/*show error if image not uploaded */	
				if($uploadImges["status"] != 200 ) {	
					$this->session->set_flashdata("error",$uploadImges["message"]);
					redirect(base_url("properties/add_edit/".$id));
				}
		}

		if( isset($_FILES['gallery_images'] ) && $_FILES['gallery_images']['error'][0] == 0 ) {
				$uploadImges =  $this->property_model->multiUpload("gallery_images", $id,GALLERY_IMAGE,"./uploads/gallery_images");
				/*show error if image not uploaded */
				if($uploadImges["status"] != 200 ) {	
					$this->session->set_flashdata("error",$uploadImges["message"]);
					redirect(base_url("properties/add_edit/".$id));
				}
			}
		}

		/* */
		if($saveRes["status"] != 200 ) {	
			$this->session->set_flashdata("error",$saveRes["message"]);
			redirect(base_url("properties/add_edit/".$id));
		}else{
			$this->session->set_flashdata("success",$saveRes["message"]);
			redirect(base_url("properties"));
		}			
	}

	/* Show property messages list , message sends by users */
	public function property_messages() {
		$data['heading'] = "Property Messages";
		$data['records'] = $this->property_model->getPropertMessages();
		$this->load->view('header');
		$this->load->view('property_messages',$data);
		$this->load->view('footer');	
	}

	public function get_property_images() {
		$property_id 	=  $this->input->get("id");
		$image_type 	=  $this->input->get("image_type");

		$data['records'] = $this->property_model->getPropertyImages($property_id, $image_type);
		echo $this->load->view("property_image_popup",$data, true);
	}

	

	
	

}
