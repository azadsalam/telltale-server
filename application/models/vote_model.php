<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Vote_model extends CI_Model
{
     function get_vote_count($pid)
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
	 
	 
	 function insert_like_of_post($nid,$pid)
	 {
		 
		     $this->db->set('pid',$pid);
		 
		     $this->db->set('nid',$nid);
		    
            
             $this->db->insert('vote');
			
		 
	}



}


?>
