<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	public function index()
	{
          //      $this->load->view('welcome_message');
	}

        // ei pid er isEnd true kore dite hobe
        public function mark_end_from_post()
        {
                $pid = $this->input->post('pid');
        }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */