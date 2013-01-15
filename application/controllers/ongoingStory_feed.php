<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class OngoingStory_feed extends CI_Controller
{

	public function index()
	{
            $this->load->view('story_feed_view');
          //  $this->load(0,10);
          //  $this->getFullStory(1);
	}

        public function androidQuery()
        {
                         $json=$_SERVER['HTTP_JSON'];
                         $data=json_decode($json);


                          $start=intval($data->{'start'});
                          $count =intval( $data->{'count'});

                          $arr = $this->load($start,$count);
                          $i=$start;
                          foreach($arr as $a)
                          {
                              $ret["R".$i] = $a;
                              $i++;
                          }
                          print_r(json_encode($ret));
        }

         public function getFullStoryFromAndroid()
        {
                         $json=$_SERVER['HTTP_JSON'];
                         $data=json_decode($json);
                         
                          $pid=intval($data->{'pid'});
                          
                          $array =  $this->getFullStory($pid);


                          $tmp = $array['appended_post_array'];
                          $count = count($tmp);
                          $array['appended_post_count'] = $count;
                          //$array['Unappended_part_array']
                          $tmp = $array['Unappended_part_array'];
                          $count = count($tmp);
                          $array['Unappended_part_count'] = $count;

                          print_r(json_encode($array,JSON_FORCE_OBJECT));
        }

        public function testStory()
        {
            $array = $this->getFullStory(9);


            $tmp = $array['appended_post_array'];
            $count = count($tmp);
            $array['appended_post_count'] = $count;
            //$array['Unappended_part_array']
            $tmp = $array['Unappended_part_array'];
            $count = count($tmp);
            $array['Unappended_post_count'] = $count;

            print_r(json_encode($array));
//JSON_NUMERIC_CHECK
                        echo "<br/>";            echo "<br/>";echo "<br/>";

                                    print_r(json_encode($array,JSON_FORCE_OBJECT));
//JSON_NUMERIC_CHECK
                        echo "<br/>";            echo "<br/>";echo "<br/>";

                        
            print_r($array);
        }
        public function test()
        {
            
            $arr = $this->load(2,2);

            print_r($arr);
            echo "<br/><br/>";
            foreach($arr as $a){
                print_r($a);
                echo "<br>";
            }

             echo "<br/><br/>";

                    $start=intval("2");
                          $count =intval( "2");

                          $arr = $this->load($start,$count);
                          $i=$start;
                          
                          foreach($arr as $a)
                          {
                              $ret["R".$i] = $a;
                              $i++;
                              echo "$i \n";
                          }
                          print_r(json_encode($ret));
        }
        public function load($start,$count)//what is $start??? $count??
        {

            $this->load->model('post_model');
            $ongoing_story=$this->post_model->get_ongoing_story($start,$count);
           
           
            for($i=$start;$i<$start+$count;$i++)
            {
                if($i<$start+count($ongoing_story))
                {
                   $ongoing_story[$i]['name']=$this->get_nameBynid($ongoing_story[$i]['nid']);
                   $ongoing_story[$i]['vote']=$this->get_vote_count($ongoing_story[$i]['pid']);
                }
                
            }


         // return $ongoing_story;
          //  print_r($ongoing_story);
           return $ongoing_story;//array structure $ongoing_story['index']['pid']
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
         $appended_post_array=$this->post_model->get_upto_completed_part_ofStory($root);
        // print_r($post_array);
         for($i=0;$i<count($appended_post_array);$i++)
         {
             $appended_post_array[$i]['name']=$this->get_nameBynid($appended_post_array[$i]['nid']);
             $appended_post_array[$i]['vote']=$this->get_vote_count($appended_post_array[$i]['pid']);
         }
         //uporere etotukute appended post gular post shb ber kora hoise
         $last_appended_pid=$appended_post_array[count($appended_post_array)-1];
         $Unappended_part_array=$this->post_model->get_UnappendedPart_of_OngoingStory($last_appended_pid);
        // print_r($Unappended_part_array);
         for($i=0;$i<count($Unappended_part_array);$i++)
         {
             $Unappended_part_array[$i]['name']=$this->get_nameBynid($Unappended_part_array[$i]['nid']);
             $Unappended_part_array[$i]['vote']=$this->get_vote_count($Unappended_part_array[$i]['pid']);
         }//array structure               $Unappended_part_array['index']['pid']
                                                              //['index']['nid']
                                                              //['index']['text']
                                                              //['index']['name']
                                                              //['index']['vote']

        // uporer part e last appended post r child gula ber kora hoise

         $ongoing_story['appended_post_array']=$appended_post_array;
         $ongoing_story['Unappended_part_array']= $Unappended_part_array;

       //  print_r($ongoing_story);
        return $ongoing_story;

     }

        
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */