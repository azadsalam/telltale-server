<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Published_model extends CI_Model
{
     function get_pid_completedStory()
     {

        $query="SELECT pid  FROM published";



         $q=$this->db->query($query);
               $pid_array=array();
		if($q->num_rows()>0)
		{
			foreach($q->result() as $row)
			{
                            $pid_array[]=$row->pid;

                        }
                 }
                 else return;

                 return $pid_array;
     }
	 
	 function publishStory($pid,$like,$share,$view)
	 {
		  $this->db->set('pid',$pid);
            $this->db->set('likeCount',$like);
            $this->db->set('shareCount',$share);
			$this->db->set('viewCount',$view);
            $this->db->insert('published');
		 
		 
	 }



}


?>
