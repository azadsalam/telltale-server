<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class GroupMembership extends CI_Controller
{


    public function index()
    {
		
		
		echo $this->delete_member(2,3);
		
		
		
	}

        public function  add_member_from_android()
        {
                         $json=$_SERVER['HTTP_JSON'];
                 $data=json_decode($json);

              $grpid=intval($data->{'grpid'});
              $mail = $data->{'mail'};

              echo "add $grpid -> $mail";

        }
        public function remove_member_from_android()
        {
                                         $json=$_SERVER['HTTP_JSON'];
                 $data=json_decode($json);

              $grpid=intval($data->{'grpid'});
              $mail = $data->{'mail'};

              echo "remove $grpid -> $mail";
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
	
	
	
}