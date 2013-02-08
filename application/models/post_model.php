 <?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Post_model extends CI_Model
{


   function post_delete($pid)
   {
	   $parent=$pid;

	   $this->db->delete('post', array('pid' => $pid));



	   while($parent!= NULL)
	   {


		   $query="SELECT pid  FROM post WHERE isAppended = 1 AND parent = ? ";

		   $q=$this->db->query($query,$parent);

			if($q->num_rows == 1)
			{
					$row = $q->row();

					$new_parent= $row->pid;

			}
			else $new_parent=NULL;


			$query="SELECT pid FROM post WHERE parent = ?";
			$q=$this->db->query($query,$parent);
			   if($q->num_rows()>0)
			   {
				foreach($q->result() as $row)
				{
					//echo $row->pid;
					$this->db->delete('post', array('pid' => $row->pid));
				}
			   }




	     $parent=$new_parent;




	   }



   }
    //inserts the first post into database\

	public function find_root_contributer_of_story($pid)///ei pid ta last post er pid..ekta array reutrn korbe jar modhe shb contributer r nid thakbe
	{
		$index=-1;
		$parent=$pid;
		while($parent!=NULL)
		{
			$index++;
			$pid=$parent;

			$contributer[$index]=$this->get_nid($pid);

	      	$query="SELECT parent FROM post WHERE pid=?";
			$q=$this->db->query($query,$pid);
		   if($q->num_rows()>0)
		   {
			foreach($q->result() as $row)
			{
				$parent=$row->parent;
			}
		   }



		}



		$array['contributer']=$contributer;
		$array['root']=$pid;


		return $array;

	}
	public function get_isSuggestedEnd($pid)
	{
		$query="SELECT isSuggestedEnd FROM post WHERE pid=?";
		  $q=$this->db->query($query,$pid);
		   if($q->num_rows()>0)
		   {
			foreach($q->result() as $row)
			{
				return $row->isSuggestedEnd;
			}
		   }
		   else return ;

	}

	public function get_nid($pid)//eta ashole point add r shomoy lagtese
 	{
		$query="SELECT nid FROM post WHERE pid=?";
		  $q=$this->db->query($query,$pid);
		   if($q->num_rows()>0)
		   {
			foreach($q->result() as $row)
			{
				return $row->nid;
			}
		   }
		   else return ;

	}


    public function insertPost($nid,$parent,$text)
    {
            $this->db->set('nid',$nid);
            $this->db->set('parent',$parent);
            $this->db->set('text',$text);
            $this->db->insert('post');

			return $this->db->insert_id();
    }

   public function mark_is_append_true($pid)
   {
       $this->db->query('UPDATE post SET  isAppended = 1 WHERE pid = ?', $pid);
   }

   function attach_post_to_group($pid,$grpid)
   {
	   $array['grpid']=$grpid;
	   $array['pid']=$pid;
	   $this->db->query('UPDATE post SET  grpid = ? WHERE pid = ?',$array);
   }

   function   detach_post_from_group($pid)
   {

	   $this->db->query('UPDATE post SET  grpid = NULL WHERE pid = ?',$pid);
   }


   public function mark_isEnd_true($pid)
   {
       $this->db->query('UPDATE post SET  isEnd = 1 WHERE pid = ?', $pid);
   }

    public function insertPost_ByAttribute($attribute)
    {
            $this->db->set('nid',$attribute['nid']);
            $this->db->set('parent',$attribute['parent']);
            $this->db->set('text',$attribute['text']);
            $this->db->set('isSuggestedEnd',$attribute['isSuggestedEnd']);
            $this->db->set('isEnd',$attribute['isEnd']);
            $this->db->set('isAppended',$attribute['isAppended']);


            $this->db->insert('post');
    }

    function get_ongoing_story($start,$count)
    {

        $query="SELECT pid,nid,text FROM post WHERE parent IS NULL AND pid NOT IN
            (SELECT pid FROM published)ORDER BY timeStamp DESC ";

        //$query="SELECT pid,nid,text FROM post WHERE parent = ?";
        $c=0;
        $q=$this->db->query($query);
         if($q->num_rows()>0)
		{
			foreach($q->result() as $row)
			{

                            if($c>=$start && $c<$start+$count)
                            {

                             $data[$c]['pid']=$row->pid;
                             $data[$c]['nid']=$row->nid;
                             $data[$c]['text']=$row->text;
                            }
                           if($c>=$start+$count)
                            {
                               if(isset($data))
                                return $data;
                            }
                            $c++;

			}


		}else return;
               if (isset($data))
                 return $data;
               else return;

    }


	function get_ongoing_stories_of_this_group($start,$count,$grpid)
	{

		 $query="SELECT pid,nid,text FROM post WHERE parent IS NULL AND grpid = ? AND pid NOT IN
            (SELECT pid FROM published)ORDER BY timeStamp DESC ";

        //$query="SELECT pid,nid,text FROM post WHERE parent = ?";
        $c=0;
        $q=$this->db->query($query,$grpid);
         if($q->num_rows()>0)
		{
			foreach($q->result() as $row)
			{

                            if($c>=$start && $c<$start+$count)
                            {

                             $data[$c]['pid']=$row->pid;
                             $data[$c]['nid']=$row->nid;
                             $data[$c]['text']=$row->text;
                            }
                           if($c>=$start+$count)
                            {
                               if(isset($data))
                                return $data;
                            }
                            $c++;

			}


		}else return;
               if (isset($data))
                 return $data;
               else return;






	}



    function get_ongoing_personalStory($start,$count,$nid)// ekta nidrishto nid er jonno tar shb ongoing story er feed
    {

        $query="SELECT pid,text FROM post WHERE parent IS NULL AND pid NOT IN
            (SELECT pid FROM published) AND nid=? ORDER BY timeStamp DESC ";

        //$query="SELECT pid,nid,text FROM post WHERE parent = ?";
        $c=0;
        $q=$this->db->query($query,$nid);
              if($q->num_rows()>0)
		{
			foreach($q->result() as $row)
			{

                            if($c>=$start && $c<$start+$count)
                            {

                             $data[$c]['pid']=$row->pid;
                             $data[$c]['text']=$row->text;
                            }
                           if($c>=$start+$count)
                            {
                               if(isset($data))
                                return $data;
                            }
                            $c++;

			}


		}else return;
               if (isset($data))
                 return $data;
               else return;

    }

  function  get_pid_nid_text_AllCompleted_PersonalStory($start,$count,$nid)//karo personal profile er shb story dekhar jonno
  {

     $query="SELECT pid,text FROM post WHERE parent IS NULL AND pid
         IN (SELECT pid FROM published) AND nid=? ORDER BY timeStamp DESC ";
      $q=$this->db->query($query,$nid);
      $c=0;
       if($q->num_rows()>0)
		{
			foreach($q->result() as $row)
			{

                            if($c>=$start && $c<$start+$count)
                            {

                             $data[$c]['pid']=$row->pid;
                             $data[$c]['text']=$row->text;
                            }
                            if($c>=$start+$count)
                            {
                               if(isset($data))
                                return $data;
                            }
                            $c++;
			}


		}else return;
               if (isset($data))
                 return $data;
               else return;


  }


  function  get_pid_nid_text_AllCompleted_story($start,$count)
  {

     $query="SELECT pid,nid,text FROM post WHERE parent IS NULL AND pid
         IN (SELECT pid FROM published) ORDER BY timeStamp DESC ";

      $c=0;
        $q=$this->db->query($query);
              if($q->num_rows()>0)
		{
			foreach($q->result() as $row)
			{

                            if($c>=$start && $c<$start+$count)
                            {

                             $data[$c]['pid']=$row->pid;
                             $data[$c]['nid']=$row->nid;
                             $data[$c]['text']=$row->text;
                            }
                            if($c>=$start+$count)
                            {
                               if(isset($data))
                                return $data;
                            }
                            $c++;
			}


		}else return;
               if (isset($data))
                 return $data;
               else return;


  }


  function get_completed_stories_of_this_group($start,$count,$grpid)
  {


     $query="SELECT pid,nid,text FROM post WHERE parent IS NULL AND grpid = ? AND pid
         IN (SELECT pid FROM published) ORDER BY timeStamp DESC ";

      $c=0;
        $q=$this->db->query($query,$grpid);
        if($q->num_rows()>0)
		{
			foreach($q->result() as $row)
			{

                            if($c>=$start && $c<$start+$count)
                            {

                             $data[$c]['pid']=$row->pid;
                             $data[$c]['nid']=$row->nid;
                             $data[$c]['text']=$row->text;
                            }
                            if($c>=$start+$count)
                            {
                               if(isset($data))
                                return $data;
                            }
                            $c++;
			}


		}else return;
               if (isset($data))
                 return $data;
               else return;



  }



  function get_nid_text_isEnd($pid)
  {
      $query="SELECT nid,text,isEnd FROM post WHERE pid=?";

        $q=$this->db->query($query,$pid);

		if($q->num_rows == 1)
		{
                       $row = $q->row();
                       $attribute['nid']=$row->nid;
                       $attribute['text']=$row->text;
                       $attribute['isEnd']=$row->isEnd;
                       return $attribute;

		}
                return NULL;

  }

  function get_nid_text_isSuggestedEnd_isEnd($pid)//isSuugestionEnd jog korar jonno unappended part e
  {
      $query="SELECT nid,text,isSuggestedEnd,isEnd FROM post WHERE pid=?";

        $q=$this->db->query($query,$pid);

		if($q->num_rows == 1)
		{
                       $row = $q->row();
                       $attribute['nid']=$row->nid;
                       $attribute['text']=$row->text;
                       $attribute['isSuggestedEnd']=$row->isSuggestedEnd;
					   $attribute['isEnd']=$row->isEnd;

                       return $attribute;

		}
                return NULL;

  }


  function get_upto_completed_part_ofStory($root)//eta jekono story r root dile jototuku appende part
                                                 //ase tototuku return korbe jodi completed hoi taile puratai return korbe
  {                                               // jodi ongoing hoi tahole jototuku appended tototuku korbe
      $node=$root;
      $post_array;$index=0;
     while(true)
     {
         $attribute=$this->get_nid_text_isEnd($node);
         $post_array[$index]['pid']=$node;
         $post_array[$index]['nid']=$attribute['nid'];
         $post_array[$index]['text']=$attribute['text'];
         if($attribute['isEnd'])
              break;

         $index++;
         $node=$this->get_nextChildrenThatisAppended($node);
         if($node==NULL)break;
     }

    if(isset($post_array))
        return $post_array;
    else return;


  }

 function get_UnappendedPart_of_OngoingStory($lastAppendedPostId)//last jei post ta ongoing story r append hoise oita dile er child gula ferot korbe
  {
        $query="SELECT pid FROM post WHERE parent = ? AND isAppended = 0";

        $q=$this->db->query($query,$lastAppendedPostId);
        $index=0;
         if($q->num_rows()>0)
	  {
	       foreach($q->result() as $row)
        	{
                        $attribute=$this->get_nid_text_isSuggestedEnd_isEnd($row->pid);
                        $post_array[$index]['pid']=$row->pid;
                         $post_array[$index]['nid']=$attribute['nid'];
                         $post_array[$index]['text']=$attribute['text'];
                         $index++;
                  }
          }
          else return;

      if(isset($post_array))
        return $post_array;
       else return;

  }


  function get_UnappendedPart_of_OngoingStory2($lastAppendedPostId)//isSuugestionEnd shoho
  {
        $query="SELECT pid FROM post WHERE parent = ? AND isAppended = 0";

        $q=$this->db->query($query,$lastAppendedPostId);
        $index=0;
      if($q->num_rows()>0)
	  {
	       foreach($q->result() as $row)
        	{
                        $attribute=$this->get_nid_text_isSuggestedEnd_isEnd($row->pid);
                        $post_array[$index]['pid']=$row->pid;
                         $post_array[$index]['nid']=$attribute['nid'];
                         $post_array[$index]['text']=$attribute['text'];
						 $post_array[$index]['isSuggestedEnd']=$attribute['isSuggestedEnd'];

                         $index++;
                  }
          }
          else return;

      if(isset($post_array))
        return $post_array;
       else return;

  }


   function get_nextChildrenThatisAppended($parentid)
   {
       $query="SELECT pid FROM post WHERE parent = ? AND isAppended = 1";

        $q=$this->db->query($query,$parentid);

		if($q->num_rows == 1)
		{
                       $row = $q->row();

                       return $row->pid;

		}
                return NULL;


   }


//// ******************************* Profile**********************************

 function get_count_initiate_story($nid)//ekta nid dile she koita initiate korse tar count dibe
 {

       $query="SELECT COUNT(pid) as initiate_count FROM post WHERE nid=? AND parent IS NULL ";

        $q=$this->db->query($query,$nid);

		if($q->num_rows ==1)
		{
                       $row = $q->row();

                       return $row->initiate_count;

		}
        else return 0;

 }

 function get_count_comment_in_story($nid)
 {

	  $query="SELECT COUNT(pid) as comment_count FROM post WHERE nid=? AND parent IS NOT NULL ";

        $q=$this->db->query($query,$nid);

		if($q->num_rows ==1)
		{
                       $row = $q->row();

                       return $row->comment_count;

		}
        else return 0;


 }


 function get_count_appended_comment($nid)
 {

	  $query="SELECT COUNT(pid) as appended_count FROM post WHERE nid=? AND parent IS NOT NULL  AND isAppended = 1";

        $q=$this->db->query($query,$nid);

		if($q->num_rows ==1)
		{
                       $row = $q->row();

                       return $row->appended_count;

		}
        else return 0;


 }



}

?>
