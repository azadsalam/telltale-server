<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PostModification extends CI_Controller
{


    public function index()
    {
		
		//$this->post_delete(37);		
		
	}


        public function post_delete_from_android()
        {
                         $json=$_SERVER['HTTP_JSON'];
                         $data=json_decode($json);


                          $pid=intval($data->{'pid'});
                          $this->post_delete($pid);

        }


        public function post_delete($pid)//kono ekta post id dile oi post shoho tar nicher shb post delete kore dibe
	{
		$this->load->model('post_model');
		$this->post_model->post_delete($pid);
		
	}
	
	
}