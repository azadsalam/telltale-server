<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Membership_model extends CI_Model
{
	
	
	 function row_exist($grpid,$nid)
	 {
		 
		  $query="SELECT grpid  FROM groupspace WHERE grpid=? AND nid=?";
		  $array['grpid']=$grpid;
		  $array['nid']=$nid;



        $q=$this->db->query($query,$array);

		if($q->num_rows == 1)
		{
                      return 1;
		}
                return 0;
		 
	 }
	
	
	
	function add_member($grpid, $nid)
	{
		if(!$this->row_exist($grpid,$nid))
		 {
		     $this->db->set('grpid',$grpid);
		 
		     $this->db->set('nid',$nid);
		    
             $this->db->insert('membership');
			 
			 return 1;
		
		 }
		 else return 0;
		
	}
	
	
	
	
	
}