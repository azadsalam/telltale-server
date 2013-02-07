<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class GroupMembership extends CI_Controller
{


    public function index()
    {
		
		
		echo $this->add_member(2,3);
		
		
		
	}
	
	public function add_member($grpid,$nid)//group grpid+nid dile notun row khulbe//group ekoi nid+grpid agei exist korle return 0 or success 																                                               //hole return 1
	{
		
		
		 $this->load->model('membership_model');
		 if($this->membership_model->add_member($grpid,$nid))
		  return 1;
		 else return 0; 
		
		
	}
	
	
	
}