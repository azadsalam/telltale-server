<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Like extends CI_Controller
{


    public function index()
    {
		//$this->load->model('vote_model');
	    //$this->vote_model->insert_like_of_post(2,37);
		
		
		
	}
	
	public function get_count_like_of_post($pid)//kono post er koita like ase return korbe
	{
		$this->load->model('vote_model');
	    
		$count=$this->vote_model->get_vote_count($pid);
		
		//echo $count;
		
		
	}
	
	
	public function like_from_android()
        {

             $json=$_SERVER['HTTP_JSON'];
             $data=json_decode($json);

             $nid=intval($data->{'nid'});

            $pid=intval($data->{'pid'});

            $this->like_comment($nid, $pid);


        }


        public function like_comment($nid,$pid)// kono pid te kono nid eshe like dile sheta insert hbe
	{
		
                $this->load->model('vote_model');
                $this->vote_model->insert_like_of_post($nid,$pid);
		
		
		
    }
	
}