<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class GroupMembership extends CI_Controller
{


    public function index()
    {
		
		
		//echo $this->list_of_group(3);
		
		
		
	}
	
	public function add_member($grpid,$nid)//group grpid+nid dile notun row khulbe//group ekoi nid+grpid agei exist korle return 0 or success 																                                               //hole return 1
	{
		
		
		 $this->load->model('membership_model');
		 if($this->membership_model->add_member($grpid,$nid))
		  return 1;
		 else return 0; 
		
		
	}
	
	public function delete_member($grpid,$nid)//success hole return 1 or return 0 mne nai table e
	{
		 $this->load->model('membership_model');
		 if($this->membership_model->delete_member($grpid,$nid))
		  return 1;
		 else return 0; 
		
		
	}
	
	public function list_of_group($nid)//ami kon kon group e asi tar list 
	{
		
		$this->load->model('membership_model');
		$data=$this->membership_model->list_of_group($nid);
		
		$this->load->model('groupspace_model');
		
		for($index=0;$index<count($data);$index++)
		{
			
			$data[$index]['name']=$this->groupspace_model->get_name($data[$index]['grpid']);
		}
		
		
		//print_r($data);
		
		return $data;//$data['index']['grpid']
					//	$data['index']['name']
		
		
	}
	
	
	
}