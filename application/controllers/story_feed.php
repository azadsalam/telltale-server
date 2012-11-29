<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Story_feed extends CI_Controller
{

	public function index()
	{
                $this->load->view('story_feed_view');
	}

        public function load($start,$count)//what is $start??? $count??
        {

        }

        
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */