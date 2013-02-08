<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class GroupMembership extends CI_Controller
{


    public function index()
    {
		
		
		//echo $this->list_of_group(3);
		
		
		
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

        public function list_of_group_from_android()
        {
                    $json=$_SERVER['HTTP_JSON'];
                     $data=json_decode($json);

                  $nid=intval($data->{'nid'});

   //         $nid=1;
                   $data = $this->list_group_helper($nid);

                print_r(json_encode($data, JSON_FORCE_OBJECT));
        }
        public function list_group_helper($nid)
        {
            $arr = $this->list_of_group($nid);


            $tmp['count'] = count($arr);
            $tmp['data' ] = $arr;

            return $tmp;
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