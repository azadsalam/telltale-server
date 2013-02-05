<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Vote_model extends CI_Model
{
     function get_vote_count($pid)///
     {

        $query="SELECT count(pid) AS count FROM vote WHERE pid=?";



         $q=$this->db->query($query,$pid);

		if($q->num_rows == 1)
		{
                       $row = $q->row();
                       return  $row->count;
		}
                return 0;
     }
	 
	 
	 function like_exist($nid,$pid)
	 {
		 
		  $query="SELECT pid  FROM vote WHERE pid=? AND nid=?";
		  $array['pid']=$pid;
		  $array['nid']=$nid;



        $q=$this->db->query($query,$array);

		if($q->num_rows == 1)
		{
                      return 1;
		}
                return 0;
		 
	 }
	 
	 function insert_like_of_post($nid,$pid)// kono pid te kono nid eshe like dile sheta insert hbe
	 {
		 
		     $this->db->set('pid',$pid);
		 
		     $this->db->set('nid',$nid);
		    
            
             $this->db->insert('vote');
			
		 
	}



}


?>
