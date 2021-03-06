<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Group extends CI_Controller
{


    public function index()
    {
		
	}

        public function create_group_from_android()
        {
             $json=$_SERVER['HTTP_JSON'];
             $data=json_decode($json);


              $name=$data->{'name'};
              $nid = intval($data->{'nid'});

              $this->create_group($name, $nid);
        }


        public function list_group_from_android()
        {
            
             $json=$_SERVER['HTTP_JSON'];
             $data=json_decode($json);

              $nid=intval($data->{'nid'});

//                $nid=1;
 //             $data = $this->list_group_helper($nid);

                $arr = $this->list_of_owned_group($nid);

   //         print_r($arr);

             $tmp['count'] = count($arr);
             $tmp['data' ] = $arr;
              
                print_r(json_encode($tmp, JSON_FORCE_OBJECT));
        }
        public function list_group_helper($nid)
        {
            $arr = $this->list_of_owned_group($nid);

   //         print_r($arr);

            $tmp['count'] = count($arr);
            $tmp['data' ] = $arr;

            return $tmp;
        }

        public function delete_group_from_android()
        {
             $json=$_SERVER['HTTP_JSON'];
             $data=json_decode($json);

              $grpid=intval($data->{'grpid'});

            $this->delete_group($grpid);
        }

   public function create_group($name,$nid)//group name+ creator r nid//group ekoi nid+name agei exist korle return false or success hole 				                                                  return true
	{
		
		$this->load->model('groupspace_model');
		$grpid=$this->groupspace_model->create_group($name,$nid);
		 if($grpid != 0)
		 {
			 $this->load->model('membership_model');
			 $dummy=$this->membership_model->add_member($grpid,$nid);
			 
		   return 1;
		 }
		 else return 0; 
	}
	
	public function delete_group($grpid)//group  na thakle return 0 or success hole 				                                                  return korbe 1
	{
		
		 $this->load->model('groupspace_model');
		 if($this->groupspace_model->delete_group($grpid))
		  return 1;
		 else return 0; 
	}
	
	public function list_of_owned_group($nid)//ei owner kn kn group create korse group r list return korbe r na thakle NULL return korbe
	{
		$this->load->model('groupspace_model');
		$data=$this->groupspace_model->list_of_owned_group($nid);
		print_r($data);
		
		//return $data;//$data['index']['grpid']
					//	$data['index']['name']
                                        //
           }

        public function attach()
        {
                   $json=$_SERVER['HTTP_JSON'];
             $data=json_decode($json);


              $pid=$data->{'pid'};
              $grpid = intval($data->{'grpid'});

              $this->attach_post_to_group($pid, $grpid);
        }
        public function attach_post_to_group($pid,$grpid)
	{
		$this->load->model('post_model');
		$this->post_model->attach_post_to_group($pid,$grpid);
	}
	
	public function detach_post_from_group($pid)//set null
	{
		$this->load->model('post_model');
		$this->post_model->detach_post_from_group($pid);
	}
	
	
	
}