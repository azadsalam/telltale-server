<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Group extends CI_Controller
{


    public function index()
    {
		
		
		$this->list_group(2);
		
		
		
	}
	
	public function create_group($name,$nid)//group name+ creator r nid//group ekoi nid+name agei exist korle return false or success hole 				                                                  return true
	{
		
		$this->load->model('groupspace_model');
		 if($this->groupspace_model->create_group($name,$nid))
		  return 1;
		 else return 0; 
	}
	
	public function delete_group($grpid)//group  na thakle return 0 or success hole 				                                                  return korbe 1
	{
		
		 $this->load->model('groupspace_model');
		 if($this->groupspace_model->delete_group($grpid))
		  return 1;
		 else return 0; 
	}
	
	public function list_group($nid)//ei owner r group r list return korbe r na thakle NULL return korbe
	{
		$this->load->model('groupspace_model');
		$data=$this->groupspace_model->count_group($nid);
		//print_r($data);
		
		return $data;//$data['index']['grpid']
					//	$data['index']['name']
		
		
	}
	
	
}