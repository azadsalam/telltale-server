<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PersonalOngoingStory_feed extends CI_Controller
{

	public function index()
	{
            $this->load->view('story_feed_view');
            $this->load(0,10,2);
            
	}
	public function test()
	{
            echo "TESTING<BR/>";
            $this->load->view('story_feed_view');

            $start=0;
            $count=5;
            $nid=1;
            $arr= $this->load($start,$count,$nid);
            print_r($arr);

              echo "<BR/>---<BR/>";
             $arr= json_encode($arr,JSON_FORCE_OBJECT);
             print_r($arr);


	}


        public function my_ongoing_feed_from_android()
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

        
        public function load($start,$count,$nid)//what is $start??? $count??
        {

            $this->load->model('post_model');
            $ongoing_story=$this->post_model->get_ongoing_personalStory($start,$count,$nid);
           
           
            for($i=$start;$i<$start+$count;$i++)
            {
                if($i<$start+count($ongoing_story))
                {
                   
                   $ongoing_story[$i]['vote']=$this->get_vote_count($ongoing_story[$i]['pid']);
                }
                
            }


       
           // print_r($ongoing_story);
          return $ongoing_story;//array structure $ongoing_story['index']['pid']
                                                              
                                                              //['index']['text']
                                                             
                                                              //['index']['vote']
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