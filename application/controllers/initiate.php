<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Initiate extends CI_Controller
{
        public function index()
        {
            //$this->load->view('initiate_view');
			
			//$this->initiateStory(2,'point point point..');
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

          public function androidQuery()
          {
                     $json=$_SERVER['HTTP_JSON'];
                     $data=json_decode($json);

                     $nid = $data->{'nid'};
                     $text= $data->{'text'};
                     
                     $this->initiateStory($nid, $text);

                     //return null;
          }


          
          public function  initiateStory($nid,$text)
          {
                $this->load->model('post_model');
                $parent=NULL;
                $this->post_model->insertPost($nid,$parent,$text);
				
				$this->point_for_initiate_story($nid);
				
          }
		  
		  
     public function point_for_initiate_story($nid)//story initiate r jonno 10 point pabe
	 {
		
		
		
		  $this->load->model('user_model');
		 $this->user_model->add_point($nid,10);//initiate korar jonno 50 point
		
		
		
		
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