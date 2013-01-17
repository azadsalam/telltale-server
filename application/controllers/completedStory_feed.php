<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CompletedStory_feed extends CI_Controller
{

	public function index()
	{
            $this->load->view('completedStory_feed_view');
          // $this->load(0,5);
           // $this->getFullStory(2);
	}

       
        public function load($start,$count)//what is $start??? $count??
        {
            


            $this->load->model('post_model');
            $completed_story=$this->post_model->get_pid_nid_text_AllCompleted_story($start,$count);

          
            for($i=$start;$i<$start+$count;$i++)
            {
                if($i<$start+count($completed_story))
                {
                   $completed_story[$i]['name']=$this->get_nameBynid($completed_story[$i]['nid']);
                   $completed_story[$i]['vote']=$this->get_vote_count($completed_story[$i]['pid']);
                }

            }


         // return $completed_story;
          //  print_r($completed_story);
           return $completed_story;//array structure $completed_story['index']['pid']
                                                              //['index']['nid']
                                                              //['index']['text']
                                                              //['index']['name']
                                                              //['index']['vote']
        }

        function get_nameBynid($nid)
        {
             $this->load->model('user_model');
             $name=$this->user_model->getName($nid);
             return $name;
        }
        function get_vote_count($pid)
        {
             $this->load->model('vote_model');
             $count=$this->vote_model->get_vote_count($pid);
             return $count;

        }

     function getFullStory($root)
     {
         $this->load->model('post_model');
         $post_array=$this->post_model->get_upto_completed_part_ofStory($root);
        // print_r($post_array);
         for($i=0;$i<count($post_array);$i++)
         {
             $post_array[$i]['name']=$this->get_nameBynid($post_array[$i]['nid']);
             $post_array[$i]['vote']=$this->get_vote_count($post_array[$i]['pid']);
         }

         //print_r($post_array);
        return $post_array;//array structure        $post_array['index']['pid']
                                                              //['index']['nid']
                                                              //['index']['text']
                                                              //['index']['name']
                                                              //['index']['vote']
        
     }


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */