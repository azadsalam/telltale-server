<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{
	public function index()
	{
                $this->load->view('login_view');
	}

        function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(!isset($is_logged_in) || $is_logged_in != true)
		{
                    echo "YOU ARE NOT LOGGED IN !! PLEASE LOGIN IN!!";
                    redirect('adminArea', 'refresh');
		}
	}

        function validate_credentials()
	{

             $this->load->library('form_validation');

             $this->form_validation->set_rules('mail', 'Mail', 'required|trim|xss_clean|valid_email');
             $this->form_validation->set_rules('pass', 'Password', 'required|trim|xss_clean');

             $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
             if ($this->form_validation->run() == FALSE)
             {
                     $this->load->view('login_view');
             }

             else
             {
                $this->load->model('user_model');

                $mail = $this->input->post('mail');
                $pass = $this->input->post('pass');


                $success = $this->user_model->validate($mail,$pass);

                if($success != FALSE) // if the user's credentials validated...
                {
                        $data = array(
                                'nid' => $success['nid'],
                                'mail' => $mail,
                                'name' =>  $success['name'],
                                'is_logged_in' => true
                        );

                        $this->session->set_userdata($data);

                        redirect('welcome');
                }
                else // incorrect id or password
                {
                    //$this->form_validation->set_message("Incorrect Password or Mail is not registered");
                    $this->load->view('login_view');
                }

             }

	}

        function logout()
	{
		$this->session->sess_destroy();
		$this->index();
	}
        
}

