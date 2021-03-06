<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Initiate extends CI_Controller
{

    public function index() {

        $this->load->view('initiate_view');
    }

    
    // SAVES A INITIAL STORY IN DATABASE
    // SHOULD BE CALLED WITH AJAX
    public function submit()
    {
     
        $nid = $this->input->post("nid");
        $text = $this->input->post("starting_post");
        
        $pid = $this->initiateStory($nid, $text);

        if($pid == FALSE || $pid == NULL)
        {
            echo "<br/><br/><br/>ERROR<br/><br/><br/>";
        }
        else
        {
            echo "<br/><br/><br/>PID : $pid<br/><br/><br/>";
        }

    }

    public function ajax_test() {

        $text = $this->input->post("starting_post");
        echo "Initiated Story : " . $text;
        //echo $starting_post;
    }

    public function androidQuery() {
        $json = $_SERVER['HTTP_JSON'];
        $data = json_decode($json);

        $nid = $data->{'nid'};
        $text = $data->{'text'};

        $pid = $this->initiateStory($nid, $text);

        $array['pid'] = $pid;

        print_r(json_encode($array, JSON_FORCE_OBJECT));
        //return null;
    }

    public function initiateStory($nid, $text)
    {
        $this->load->model('post_model');
        $parent = NULL;
        $pid = $this->post_model->insertPost($nid, $parent, $text);
        //$this->point_for_initiate_story($nid);
        
        return $pid;
    }

    public function point_for_initiate_story($nid)
    {//story initiate r jonno 10 point pabe
        $this->load->model('user_model');
        $this->user_model->add_point($nid, 10); //initiate korar jonno 50 point
    }

    public function start_story_from_post($nid, $parent, $text) {
        $this->load->model('post_model');

        $nid = $this->input->post("nid");
        $parent = NULL;
        $text = $this->input->post("starting_post");

        $this->post_model->insertPost($nid, $parent, $text);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */