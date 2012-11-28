    <?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Post_model extends CI_Model
{

    //inserts the first post into database
    public function insertPost($nid,$parent,$text)
    {
            $this->db->set('nid',$nid);
            $this->db->set('parent',$parent);
            $this->db->set('text',$text);

            $this->db->insert('post');
    }

   public function mark_is_append_true($pid)
   {
       $this->db->query('UPDATE post SET  isAppended = TRUE WHERE pid = ?', $pid);
   }

   public function mark_isEnd_true($pid)
   {
       $this->db->query('UPDATE post SET  isEnd = TRUE WHERE pid = ?', $pid);
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


    
}

?>
