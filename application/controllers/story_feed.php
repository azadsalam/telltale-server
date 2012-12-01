<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Story_feed extends CI_Controller
{

	public function index()
	{
            $this->load->view('story_feed_view');
           // $this->load(5,5);
	}

        public function load($start,$count)//what is $start??? $count??
        {

            $this->load->model('post_model');
            $ongoing_story=$this->post_model->get_ongoing_story($start,$count);
            for($i=$start;$i<$start+$count;$i++)
            {
                if($i<count($ongoing_story))
                {
                   $ongoing_story[$i]['name']=$this->get_nameBynid($ongoing_story[$i]['nid']);
                   $ongoing_story[$i]['vote']=$this->get_vote_count($ongoing_story[$i]['pid']);
                }
                
            }


          return $ongoing_story;
           // print_r($ongoing_story);
          // return $ongoing_story;//array structure $ongoing_story['index']['pid']
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

        
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */