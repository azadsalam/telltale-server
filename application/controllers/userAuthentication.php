<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserAuthentication extends CI_Controller
{
        public function index()
        {
           // $this->load->view('initiate_view');
        }

        // return nid if authenticated, else return null
        public function getNativeId($mail,$password)
        {
            $this->load->model('user_model');
            $nid=$this->user_model->getNativeId($mail,$password);
            return $nid;
        }


        public function androidQuery()
        {
                         $json=$_SERVER['HTTP_JSON'];
                         $data=json_decode($json);


                          $mail=$data->{'mail'};
                          $password = $data->{'password'};

                          $ret['nid'] = $this->getNativeId($mail, $password);

                          print_r(json_encode($ret));
        }


}