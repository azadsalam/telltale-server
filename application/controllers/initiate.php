<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Initiate extends CI_Controller
{
        public function index()
        {
            $this->load->view('initiate_view');
        }

        // SAVES A INITIAL STORY IN DATABASE
        public function submit()
        {

            $this->load->model('post_model');
            
        
            // FOR NOW LET NID = 1
            $nid = $this->input->post("nid");;
            $parent=NULL;
            $text = $this->input->post("starting_post");

            $this->post_model->insertPost($nid,$parent,$text);           
            //echo "called submit with  $starting_post";

            $this->start_story_from_post($nid,$parent,$text);
            echo "Initiated Story : $text";
            //echo $starting_post;
          }



        
        public function start_story_from_post($nid,$parent,$text)
        {
            $this->load->model('post_model');

            $nid = $this->input->post("nid");
            $parent=NULL;
            $text = $this->input->post("starting_post");

            $this->post_model->insertPost($nid,$parent,$text);
        }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */