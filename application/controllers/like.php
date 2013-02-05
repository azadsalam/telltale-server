<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Like extends CI_Controller
{


    public function index()
    {
		$this->load->model('vote_model');
	   echo $this->vote_model->like_exist(1,2);
		
		
		
	}
	
	public function get_count_like_of_post($pid)//kono post er koita like ase return korbe
	{
		$this->load->model('vote_model');
	    
		$count=$this->vote_model->get_vote_count($pid);
		
		echo $count;
		
		
	}
	
	
	
	public function like_comment($nid,$pid)// kono pid te kono nid eshe like dile sheta insert hbe
	{
		
		$this->load->model('vote_model');
	    $this->vote_model->insert_like_of_post($nid,$pid);
		
		
		
    }
	
}