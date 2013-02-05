<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Like extends CI_Controller
{


    public function index()
    {
		$this->get_count_like_of_post(2);
		
		
		
	}
	
	public function get_count_like_of_post($pid)
	{
		$this->load->model('vote_model');
	    
		$count=$this->vote_model->get_vote_count($pid);
		
		echo $count;
		
		
	}
	
	
	
	public function like_comment($nid,$pid)
	{
		
		$this->load->model('vote_model');
	    $this->vote_model->insert_like_of_post($nid,$pid);
		
		
		
    }
	
}