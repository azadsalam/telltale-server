<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CompletedStory_feed extends CI_Controller
{

	public function index()
	{
           // $this->load->view('completedStory_feed_view');
          // $this->load(0,5);
           $this->loadWithLike(1,5,1);
	}


        public function getCompletedStoriesFeedFromAndroid()
        {
                         $json=$_SERVER['HTTP_JSON'];
                         $data=json_decode($json);


                          $start=intval($data->{'start'});
                          $count =intval( $data->{'count'});

                          $array = $this->load($start, $count);


            $array = json_encode($array, JSON_FORCE_OBJECT);

            print_r( $array );
        }


        public function getFullStoryFromAndroid()
        {
                         $json=$_SERVER['HTTP_JSON'];
                         $data=json_decode($json);

                          $pid=intval($data->{'pid'});

                          $array['post_array'] =  $this->getFullStory($pid);

                          $tmp = $array['post_array'];
                          $count = count($tmp);
                          $array['post_count'] = $count;
                          //$array['Unappended_part_array']
                        

                          print_r(json_encode($array,JSON_FORCE_OBJECT));
        }

        public function test()
        {
            
            $pid= 44;

  $array['post_array'] =  $this->getFullStory($pid);

                          $tmp = $array['post_array'];
                          $count = count($tmp);
                          $array['post_count'] = $count;
                          //$array['Unappended_part_array']


                          print_r(json_encode($array,JSON_FORCE_OBJECT));
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
		
		
		public function loadWithLike($start,$count,$nid) //what is $start??? $count??
        {
            


            $this->load->model('post_model');
			$this->load->model('vote_model');
			
            $completed_story=$this->post_model->get_pid_nid_text_AllCompleted_story($start,$count);

          
            for($i=$start;$i<$start+$count;$i++)
            {
                if($i<$start+count($completed_story))
                {
                   $completed_story[$i]['name']=$this->get_nameBynid($completed_story[$i]['nid']);
                   $completed_story[$i]['vote']=$this->get_vote_count($completed_story[$i]['pid']);
				    $completed_story[$i]['is_liked']=$this->vote_model->like_exist($nid,$completed_story[$i]['pid']);
                }

            }


         // return $completed_story;
          // print_r($completed_story);
           return $completed_story;//array structure $completed_story['index']['pid']
                                                              //['index']['nid']
                                                              //['index']['text']
                                                              //['index']['name']
                                                              //['index']['vote']
															  //['index']['is_liked']
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

         return ($post_array);
      //  return $post_array;//array structure        $post_array['index']['pid']
                                                              //['index']['nid']
                                                              //['index']['text']
                                                              //['index']['name']
                                                              //['index']['vote']
        
     }
	 
	 
	 function getFullStoryWithLike($root,$nid)
     {
         $this->load->model('post_model');
		  $this->load->model('vote_model');
         $post_array=$this->post_model->get_upto_completed_part_ofStory($root);
        // print_r($post_array);
         for($i=0;$i<count($post_array);$i++)
         {
             $post_array[$i]['name']=$this->get_nameBynid($post_array[$i]['nid']);
             $post_array[$i]['vote']=$this->get_vote_count($post_array[$i]['pid']);
			 $post_array[$i]['is_liked']=$this->vote_model->like_exist($nid,$post_array[$i]['pid']);
         }

        // print_r($post_array);
       return $post_array;//array structure        $post_array['index']['pid']
                                                              //['index']['nid']
                                                              //['index']['text']
                                                              //['index']['name']
                                                              //['index']['vote']
															  //['index']['is_liked']
        
     }


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */