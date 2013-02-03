<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller
{


    public function index()
    {
		
		
		$this->get_point(1);
		
		
	}
	
	
        public function get_point_from_android()
        {
            /* $json=$_SERVER['HTTP_JSON'];
             $data=json_decode($json);

              $nid=$data->{'nid'};
*/
              $nid=1;
              $point = $this->get_point($nid);
              
              $arr['point'] = $point;


              $arr= json_encode($arr,JSON_FORCE_OBJECT);
              print_r($arr);

        }
        public function get_point($nid)
	{
		$this->load->model('user_model');
		$point=$this->user_model->get_point($nid);
		
		//echo $point;
		return $point;
		
	}
	
	
}
	
	
	
	
	