<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class User_model extends CI_Model
{
   private function process($str)
    {
         return sha1($str.$this->config->item('encryption_key'));
    }

    public function getNativeId($mail,$password)
    {
                $this->db->select('nid');
                $this->db->where('mail', $mail);
		$this->db->where('password',  $this->process($password));
		$query = $this->db->get('user');

		if($query->num_rows == 1)
		{
                       $row = $query->row();
                       return  $row->nid;

		}
                return NULL;
                //echo "False";
    }


   
}


?>
