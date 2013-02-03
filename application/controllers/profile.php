<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller
{


    public function index()
    {
		
		
		$this->get_point(1);
		
		
	}
	
	
	
	public function get_point($nid)
	{
		$this->load->model('user_model');
		$point=$this->user_model->get_point($nid);
		
		//echo $point;
		return $point;
		
	}
	
	
}
	
	
	
	
	