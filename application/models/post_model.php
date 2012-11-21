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

    
}

?>
