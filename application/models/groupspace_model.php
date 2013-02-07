<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Groupspace_model extends CI_Model
{
	
	
	 function group_exist($name,$nid)
	 {
		 
		  $query="SELECT grpid  FROM groupspace WHERE name=? AND nid=?";
		  $array['name']=$name;
		  $array['nid']=$nid;



        $q=$this->db->query($query,$array);

		if($q->num_rows == 1)
		{
                      return 1;
		}
                return 0;
		 
	 }
	
	
	function create_group($name,$nid)
	{
		if(!$this->group_exist($name,$nid))
		 {
		     $this->db->set('name',$name);
		 
		     $this->db->set('nid',$nid);
		    
             $this->db->insert('groupspace');
			 
			 return 1;
		
		 }
		 else return 0;
		
	}
	
	function delete_group($grpid)
	{
		 $query="SELECT grpid  FROM groupspace WHERE  grpid=?";
		
		$q=$this->db->query($query,$grpid);

		if($q->num_rows == 1)
		{
			 $this->db->delete('groupspace', array('grpid' => $grpid));
             return 1;
		}
        return 0;
		 
		 
		
		
	}
	
	function count_group($nid)
	{
		 $query="SELECT grpid,name FROM groupspace WHERE nid=?";


		 $index=0;	
         $q=$this->db->query($query,$nid);
		 

		if($q->num_rows()>0)
		{
			foreach($q->result() as $row)
			{
				
				$data[$index]['grpid']=$row->grpid;
				$data[$index]['name']=$row->name;
				$index++;
			}
			
			return $data;
		}
		
		else return NULL;
                 
		
		
	}
	
	
	
	
	
}