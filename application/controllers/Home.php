<?php
class Home extends CI_Controller 
{
	public function __construct()
	{
	parent::__construct();

	$this->load->database();
	
	$this->load->model('home_model');
	}

	public function index()
	{
		$this->load->view('home');
	
		if($this->input->post('save'))
		{
		$n=$this->input->post('name');
		$p=$this->input->post('password');
		
		$this->home_model->saverecords($n,$p);		
		echo "Records Saved Successfully";
		}
	}
}
?>