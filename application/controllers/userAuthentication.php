<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserAuthentication extends CI_Controller
{
        public function index()
        {
           // $this->load->view('initiate_view');
        }
        
        public function getNativeId($mail,$password)
        {

            $this->load->model('user_model');
            $nid=$this->user_model->getNativeId($mail,$password);
            
        }



}