<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class User_model extends CI_Model
{
    private function process($str)
    {
        return $str;
        // return sha1($str.$this->config->item('encryption_key'));
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
     function getName($nid)
     {
         $this->db->select('name');
         $this->db->where('nid', $nid);
         $query = $this->db->get('user');

		if($query->num_rows == 1)
		{
                       $row = $query->row();
                       return  $row->name;
		}
                return NULL;
     }
	 
	 
	 public function User_Already_Exist($mail)
	 {
		 
		 $query="SELECT * FROM user WHERE mail = ?";
		 $q=$this->db->query($query,$mail);
		   if($q->num_rows()>0)
		   {
			 return true;
		   }
		   return false;
	 }
	 
	 
	 public function SignUp($name,$mail,$password,$country)
     {
		 
            $this->db->set('name',$name);
            $this->db->set('mail',$mail);
            $this->db->set('password',md5($password));
            $this->db->set('country',$country);
           


            $this->db->insert('user');
    }
		 
	 

   
}


?>
