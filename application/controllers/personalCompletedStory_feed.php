<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PersonalCompletedStory_feed extends CI_Controller
{

	public function index()
	{
            //$this->load->view('PersonalCompletedStory_feed_view');
           $this->load(0,5,2);
           // $this->getFullStory(2);
	}

        public function test()
	{
            echo "TESTING<BR/>";
         //   $this->load->view('story_feed_view');

            $start=0;
            $count=3;
            $nid=1;

             $arr= $this->load($start,$count,$nid);
             $arr= json_encode($arr,JSON_FORCE_OBJECT);
             print_r($arr);

	}


        public function getCompletedStoriesFeedFromAndroid()
        {
             $json=$_SERVER['HTTP_JSON'];
             $data=json_decode($json);

             $nid=intval($data->{'nid'});
             $start=intval($data->{'start'});
             $count=intval($data->{'count'});

             $arr= $this->load($start,$count,$nid);
             $arr= json_encode($arr,JSON_FORCE_OBJECT);
             print_r($arr);
        }

        public function load($start,$count,$nid)
        {
            
            $this->load->model('post_model');
            $completed_story=$this->post_model->get_pid_nid_text_AllCompleted_PersonalStory($start,$count,$nid);

            for($i=$start;$i<$start+$count;$i++)
            {
                if($i<$start+count($completed_story))
                {
                   $completed_story[$i]['vote']=$this->get_vote_count($completed_story[$i]['pid']);
                }

            }


         // return $completed_story;
          // print_r($completed_story);
         return $completed_story;//array structure $completed_story['index']['pid']
                                                              //['index']['text']
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