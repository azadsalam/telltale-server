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
                return NULL;
     }



}


?>
