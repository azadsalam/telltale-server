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



}


?>
