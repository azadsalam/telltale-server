<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller
{
        function __construct()
	{
		parent::__construct();
		$this->is_logged_in();
	}
        function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(!isset($is_logged_in) || $is_logged_in != true)
		{
                    echo "YOU ARE NOT LOGGED IN !! PLEASE LOGIN IN!!";
                    redirect('adminArea', 'refresh');
		}
	}
	public function index()
	{
                $this->load->view('welcome_message');

                
	}

        public function post()
        {
                $this->load->view('post_view');
        }

        
}

