<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mark_end extends CI_Controller
{
	public function index()
	{
          //      $this->load->view('welcome_message');
            // $this->mark_isEnd_true(1);//test
	}

        // ei pid er isEnd true kore dite hobe
        public function mark_end_from_post()
        {
                 $pid = $this->input->post('pid');
                 $this->mark_isEnd_true($pid);
                

        }

        public function mark_isEnd_true($pid)
        {
             $this->load->model('post_model');
             $this->post_model->mark_isEnd_true($pid);
        }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */