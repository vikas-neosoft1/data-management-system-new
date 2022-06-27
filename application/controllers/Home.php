<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __Construct() {
		parent::__Construct();	 
		$this->load->model("property_model");
	}
	 
	 
	public function index()
	{
		$data['cityRecords'] 		= $this->property_model->getProperyStats("city");	
		$data['bedroomRecords']		= $this->property_model->getProperyStats("bedroom");
		$data['priceRecords']		= $this->property_model->getProperyStats("price");

		$this->load->view('header');
		$this->load->view('home',$data);
		$this->load->view('footer');
	}

	 
}
