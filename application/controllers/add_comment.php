<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Add_comment extends CI_Controller
{


        public function index()
	{
                $this->mark_is_append_true(1);
	}
        // post method a input nite hobe
        // parent er isAppended True korte hobe
        // notun post add korte hobe
        // isSuggestedEnd hisebe 0 asle false , 1 asle true 

        public function add_comment_from_post()
        {
            $parent = $this->input->post('parent');
            $text = $this->input->post('text');
            $nid = $this->input->post('nid');
            $isSuggestedEnd = $this->input->post('isSuggestedEnd');

            if($isSuggestedEnd == "0")
                $isSuggestedEnd = false;
            else
                $isSuggestedEnd = true;

            $this->add_comment($nid, $parent, $text,$isSuggestedEnd);
            $this->mark_is_append_true($parent);//why???leaf asche mane to agei parent append hoise....
        }

        //Mark the isAppend field True
        public function mark_is_append_true($pid)
        {
            $this->load->model('post_model');
            $this->post_model->mark_is_append_true($pid);
        }

        //ekta post er id (parent) dile oitar pore append kore dibe
        //comment er parent holo parent
        public function add_comment($nid,$parent,$text,$isSuggestedEnd)
        {

        }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */