<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Registration extends CI_Controller {

    function __construct()
    {
            parent::__construct();
            $this->load->library('form_validation');
    }
    public function index()
    {
        $this->load->view('registration_view');
    }

    public function submit()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|trim|xss_clean');
        $this->form_validation->set_rules('mail', 'Mail', 'required|trim|xss_clean|valid_email|callback_mail_already_exists_error');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|xss_clean|min_length[6]');
        $this->form_validation->set_rules('country', 'Country', 'required|trim|xss_clean');

        $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');

        if ($this->form_validation->run() == FALSE) // validation hasn't been passed
        {
              $this->load->view('registration_view');
        }
        else // passed validation proceed to post success logic
        {
                // build array for the model
                $name = set_value('name');
                $mail = set_value('mail');
                $password = set_value('password');
                $country = set_value('country');

                // run insert model to write data to db

                $message = $this->do_registration($name, $mail, $password, $country);

                if ($message['success'])
                {
                    $nid = $this->getNativeId($mail, $password);
                    $arr['nid'] = $nid;
                    redirect('Registration/success'); 
                } 
                else
                {
                    $this->load->view('registration_view');
                }
        }
    }

    function success()
    {
                    echo ' REDIRECT TO PROFILE 
                        this form has been successfully submitted with all validation being passed. All messages or logic here. Please note
                    sessions have not been used and would need to be added in to suit your app';
    }
    public function do_registration_from_android()
    {
        $json = $_SERVER['HTTP_JSON'];
        $data = json_decode($json);


        $mail = $data->{'mail'};
        $password = $data->{'password'};
        $name = $data->{'name'};


        $message = $this->do_registration($name, $mail, $password, "");

        if ($message['success'])
        {
            $arr['success'] = "true";
            $arr['msg'] = "Successfully Registered";


            $nid = $this->getNativeId($mail, $password);

            $arr['nid'] = $nid;
        } else {
            $arr['success'] = "false";
            $arr['nid'] = "";
            if ($message['already_exist']) {//true mane age theke ase
                $arr['msg'] = "This mail already exist";
            } else {
                if (!$message['mail_valid'])
                    $arr['msg'] = "Invalid mail";
                if (!$message['name_valid'])
                    $arr['msg'] = "Invalid name";
                if (!$message['password_valid'])
                    $arr['msg'] = "Invalid password";
            }
        }

        $arr = json_encode($arr, JSON_FORCE_OBJECT);
        print_r($arr);
    }

    public function getNativeId($mail, $password) {
        $this->load->model('user_model');
        $nid = $this->user_model->getNativeId($mail, $password);
        return $nid;
    }

    public function test() {
        $mail = "azadsalam2611@gmail.com";
        $password = "pass";
        $name = "Azad";

        $message = $this->do_registration($name, $mail, $password, "");

        if ($message['success']) {
            $arr['success'] = "true";
            $arr['msg'] = "Successfully Registered";


            $nid = $this->getNativeId($mail, $password);

            $arr['nid'] = $nid;
        } else {
            $arr['success'] = "false";
            $arr['nid'] = "";
            if ($message['already_exist']) {//true mane age theke ase
                $arr['msg'] = "This mail already exist";
            } else {
                if (!$message['mail_valid'])
                    $arr['msg'] = "Invalid mail";
                if (!$message['name_valid'])
                    $arr['msg'] = "Invalid name";
                if (!$message['password_valid'])
                    $arr['msg'] = "Invalid password";
            }
        }

        $arr = json_encode($arr, JSON_FORCE_OBJECT);
        print_r($arr);
    }

    ////country NULL pathano jabe na database error khabi kisu ekta pathaia dis..
    // databse change kora lagbe ta na hole..country is NOT NULL dea..
    // ei function ekta message array return korbe...check :                                                         //  1. $message[success]=true mane shb thik ase and daatabase e notun user dhukse
    //	2. jodi success false hoi check korbi $message['already_exist'] true kina..true                                                                 mne same mail id exist kore . true hole baki field dekhr dorkar nai ..
    //	 3.  $message[success] and $message['already_exist'] jodi false hoi tahole

    function do_registration($name, $mail, $password, $country)
    {
        $message['success'] = false;
        $message['already_exist'] = false;    // name, mail ,password($message['name_valid'],$message['mail_valid'],$message['password_valid'])   							                      // shb check kore  dekhbi konta valid na ...true mane valid..
        $message['mail_valid'] = false;          // country null dile prb nai..

        $message['name_valid'] = false;  //index function e validation er demo dea ase ei function return korle kivabe check korbi
        $message['password_valid'] = false;

        if ($this->validate_email($mail))
        {
            $message['mail_valid'] = true;
            if ($this->User_Already_Exist($mail))
            {
                $message['already_exist'] = true;
                return $message;
            }
        }

        if ($this->validate_name($name)) {
            $message['name_valid'] = true;
        }

        if ($this->validate_password($password)) {
            $message['password_valid'] = true;
        }


        if ($message['mail_valid'] && $message['name_valid'] && $message['password_valid'])
        {
            $message['success'] = true;

            $this->load->model('user_model');
            $this->user_model->SignUp($name, $mail, $password, $country);
            return $message;
        }
        else
            return $message;
    }

    function validate_name($name) {
        if ($name != NULL)
            return true;

        return false;
    }

    function validate_password($password) {
        if ($password != NULL)
            return true;

        else
            return false;
    }

    function validate_email($address) {
        if (!filter_var($address, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        return true;
    }

    function User_Already_Exist($mail) {

        $this->load->model('user_model');

        if ($this->user_model->User_Already_Exist($mail)) {
            return true; //user of this mail id already exist
        }

        return false;
    }

    function mail_already_exists_error($mail)
    {
        $this->load->model('user_model');

        if ($this->user_model->User_Already_Exist($mail)) {
            $this->form_validation->set_message("mail_already_exists_error", "The mail address is already taken!");
            return false; //user of this mail id already exist
        }

        return true;
    }
}