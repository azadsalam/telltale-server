<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Group extends CI_Controller
{


    public function index()
    {
		
		
		//$this->list_group(2);
		$this->detach_post_from_group(1);
		
		
		
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

              $data = $this->list_group_helper($nid);
              
                print_r(json_encode($data, JSON_FORCE_OBJECT));
        }
        public function list_group_helper($nid)
        {
            $arr = $this->list_group($nid);


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