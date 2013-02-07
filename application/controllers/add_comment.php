<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Add_comment extends CI_Controller
{


    public function index()
	{
       // $this->add_comment_to_story(3,NULL,'Hunny Bunny',0);   
			 
			   
			
		//	$this->append(50);
			
			

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
			 
			 $this->point_for_append_to_story($pid);//append er jonno point pabe
			 
			 $this->load->model('post_model');
			 $isSuggestedEnd=$this->post_model->get_isSuggestedEnd($pid);
			 
			 
			 if($isSuggestedEnd)
			 {
				  $this->post_model->mark_isEnd_true($pid);
				  $this->load->model('post_model');
                 $array= $this->post_model->find_root_contributer_of_story($pid);
				
				 $root=$array['root'];
				 $contributer=$array['contributer'];
				 
				 
				 $this->load->model('published_model');
				
				 $this->published_model->publishStory($root,3,5,10);//ekhane future e thik korte hbe
				 
				 $this->point_for_every_contributer_of_story($contributer);//story te jara jara contribute korse shbai point pabe..
				 															//point r distribution function tai likha ase	
				 
				 
			 }
			 
			 
		 }



       public function point_for_append_to_story($pid)//karo comment append hole 10 point pabe
	   {
		
		  $this->load->model('post_model');
		  $nid=$this->post_model->get_nid($pid);
		
		  $this->load->model('user_model');
		  $this->user_model->add_point($nid,10);
		
		
     	}
		
		public function point_for_every_contributer_of_story( $contributer)//ei pid ta hoche last post er pid
																	//ekta story shesh hole shb contributer 10 kore pabe	
		{															//but initiator 50 point pabe	and end je korbe she pabe 20 point	
																						
			
			 $this->load->model('user_model');
			  
			 
		     $this->user_model->add_point($contributer[0],30);// je shesh korse she 30 point pabe
			 
			 for($i=1;$i<count($contributer)-1;$i++)
			    $this->user_model->add_point($contributer[$i],10);//baki shobai 10 kore pabe
				
			
			  
			  $this->user_model->add_point($contributer[count($contributer)-1],50);// initiator 50 point pabe
			 
			
			
			
			
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