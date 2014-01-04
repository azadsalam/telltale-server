<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller
{


    public function index()
    {
		
		
		
		
		
		
	}

        public function view()
        {
            echo uri_string();
        }




        public function get_point_from_android()
        {
            ///*
              $json=$_SERVER['HTTP_JSON'];
             
             $data=json_decode($json);

              $nid=$data->{'nid'};
//*/
              //$nid=1;
              $point = $this->get_point($nid);
              $name = $this->get_name($nid);
              $arr = $this->count_initiate_comment_appended($nid);
              $arr['point'] = $point;
              $arr['name'] = $name;


              $arr= json_encode($arr,JSON_FORCE_OBJECT);
              print_r($arr);

        }
        public function get_name($nid)
		{

			$this->load->model('user_model');
			$name=$this->user_model->getName($nid);

			return $name;

		}
     public function get_point($nid)
	{
		$this->load->model('user_model');
		$point=$this->user_model->get_point($nid);
		
		//echo $point;
		return $point;
		
	}
	public function count_initiate_comment_appended($nid)//ei $nid koita intiate korse koita comment korse koita append hoise return kore
	{
		
		
		$this->load->model('post_model');
		$array['initiate_count']=$this->post_model->get_count_initiate_story($nid);
		$array['comment_count']=$this->post_model->get_count_comment_in_story($nid);
		$array['appended_count']=$this->post_model->get_count_appended_comment($nid);
		
		
	//	print_r($array);
		
		return $array;
		
		
		
	}
	
	
	
	
}
	
	
	
	
	