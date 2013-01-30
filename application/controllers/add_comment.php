<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Add_comment extends CI_Controller
{


    public function index()
	{
               // $this->mark_is_append_true(1);
           // $this->add_comment_to_story(1, 1,"an apple fallen on his head..", false);
           // $this->add_comment_to_story(2,1,"Queen Alizabeth saw this incident..", false);
            //$this->add_comment_to_story(3,1,"Newton saw Alizabeth..",true);

           // $this->add_comment_to_story(1, 7,"an angel came in his dream", false);
            //$this->add_comment_to_story(2,7,"An earthquake happened..", false);
            //$this->add_comment_to_story(3,7,"He saw that he felt asleep in a dream..:P",true);
			//$this->append(33);

	}
        // post method a input nite hobe
        // parent er isAppended True korte hobe?????
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

            $this->add_comment_to_story($nid, $parent, $text,$isSuggestedEnd);

        }


         public function append($pid)//ekta pid dile append kore dibe
		 {
			 $this->mark_is_append_true($pid);
			 $this->load->model('post_model');
			 $isSuggestedEnd=$this->post_model->get_isSuggestedEnd($pid);
			 $this->post_model->mark_isEnd_true($pid);
			 
			 if($isSuggestedEnd)
			 {
				 
				  $this->load->model('post_model');
                 $root= $this->post_model->find_root($pid);
				
				 $this->load->model('published_model');
				
				 $this->published_model->publishStory($root,3,5,10);//ekhane future e thik korte hbe
				 
				 
				 
			 }
			 
			 
		 }




         public function appendFromAndroid()
        {
                         $json=$_SERVER['HTTP_JSON'];
                         $data=json_decode($json);

                          $pid=intval($data->{'pid'});

                          $this->append($pid);


        }



        //Mark the isAppend field True
        public function mark_is_append_true($pid)
        {
            $this->load->model('post_model');
            $this->post_model->mark_is_append_true($pid);
        }


        public function addSuggestionFromAndroid()
        {
                     $json=$_SERVER['HTTP_JSON'];
                     $data=json_decode($json);

                     $nid = $data->{'nid'};
                     $parent  = $data->{'parent'};
                     $text = $data->{'text'};
                     $isSuggestedEnd = $data->{'isSuggestedEnd'};

                     $this->add_comment_to_story($nid, $parent, $text, $isSuggestedEnd);
        }
        //
        
        //ekta post er id (parent) dile oitar pore append kore dibe
        //comment er parent holo parent
        public function add_comment_to_story($nid,$parent,$text,$isSuggestedEnd)
        {
            $attribute['nid']=$nid;
            $attribute['parent']=$parent;
            $attribute['text']=$text;
            $attribute['isSuggestedEnd']=$isSuggestedEnd;
            $attribute['isEnd']=false;
            $attribute['isAppended']=false;

            $this->load->model('post_model');
            $this->post_model->insertPost_ByAttribute($attribute);

        }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */