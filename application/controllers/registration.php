<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Registration extends CI_Controller
{


    public function index()

    {
		$message=$this->registration("Sid","issid@gmail.com","amisid","");
		
		if($message['success'])
		echo "successfull";
		else 
		{
			if($message['already_exist'])//true mane age theke ase
			{
				echo "This mail already exist";
			}
			else
			{
				if(!$message['mail_valid'])
				 echo "Invalid mail";
				if(!$message['name_valid'])
				 echo "Invalid name";
				 if(!$message['password_valid'])
				 echo "Invalid password";
				 
				
			}
			
		}
		
		
		
    }
	 
    public function do_registration_from_android()
    {


                $message=$this->do_registration("bla","blabla","amisid","");

		if($message['success'])
		{
                    $arr['success'] = "true";
                    $arr['msg'] ="Successfully Registered";
                }
		else
		{
                        $arr['success'] = "false";

			if($message['already_exist'])//true mane age theke ase
			{
				 $arr['msg'] = "This mail already exist";
			}
			else
			{
				if(!$message['mail_valid'])
				  $arr['msg'] = "Invalid mail";
				if(!$message['name_valid'])
				  $arr['msg'] = "Invalid name";
				 if(!$message['password_valid'])
				  $arr['msg'] = "Invalid password";
			}

		}

                 $arr= json_encode($arr,JSON_FORCE_OBJECT);
                 print_r($arr);


    }
    public function test()
    {

        	$message=$this->do_registration("bla","blabla","amisid","");

		if($message['success'])
		{
                    $arr['success'] = "true";
                    $arr['msg'] ="Successfully Registered";
                }
		else
		{
                        $arr['success'] = "false";

			if($message['already_exist'])//true mane age theke ase
			{
				 $arr['msg'] = "This mail already exist";
			}
			else
			{
				if(!$message['mail_valid'])
				  $arr['msg'] = "Invalid mail";
				if(!$message['name_valid'])
				  $arr['msg'] = "Invalid name";
				 if(!$message['password_valid'])
				  $arr['msg'] = "Invalid password";
			}

		}

                 $arr= json_encode($arr,JSON_FORCE_OBJECT);
                 print_r($arr);


    }

    function do_registration($name,$mail,$password,$country)//country NULL pathano jabe na database error khabi kisu ekta pathaia dis..
  																// databse change kora lagbe ta na hole..country is NOT NULL dea..		
																
  															// ei function ekta message array return korbe...check :
  {                                                         //  1. $message[success]=true mane shb thik ase and daatabase e notun user dhukse
       														//	2. jodi success false hoi check korbi $message['already_exist'] true kina..true                                                                 mne same mail id exist kore . true hole baki field dekhr dorkar nai ..
															//	 3.  $message[success] and $message['already_exist'] jodi false hoi tahole 
	   $message['success']=false;
	   $message['already_exist']=false;		  // name, mail ,password($message['name_valid'],$message['mail_valid'],$message['password_valid'])   							                      // shb check kore  dekhbi konta valid na ...true mane valid..
           $message['mail_valid']=false;          // country null dile prb nai..
	   
	   $message['name_valid']=false;		//index function e validation er demo dea ase ei function return korle kivabe check korbi
	   $message['password_valid']=false;
	   
	   if($this->validate_email($mail))
	   {
		   $message['mail_valid']=true;
		   if( $this->User_Already_Exist($mail))
		   {
			   $message['already_exist']=true;
			   return $message; 
		   }
			   
	   }
	   
	   if($this->validate_name($name))
	   {
		   $message['name_valid']=true;
	   }
	   
	   if($this->validate_password($password))
	   {
		   $message['password_valid']=true;
	   }
	   
	   
	   if($message['mail_valid'] && $message['name_valid'] && $message['password_valid'])
	   {
		   $message['success']=true;
		   
		   $this->load->model('user_model');
		   
		  
		   
		   $this->user_model->SignUp($name,$mail,$password,$country);
		   
		   return $message;
		   
	   }
	   else return $message;
	   
	  
	  
	  
  }
		
		
  function validate_name($name)
  {
	  if($name != NULL)
	   return true;
	   
	   return false;
	  
  }
		
  function validate_password($password)
  {
	  if($password != NULL)
	    return true;
		
	  else return false;
	  
	  
  }
   	 	
  function validate_email($address)
  {
	  if (!filter_var($address, FILTER_VALIDATE_EMAIL)) {
               return false;
         }
		 
	 return true;
	  
  }
  
  function User_Already_Exist($mail)
  {
	  
	 $this->load->model('user_model');
	 
	 if($this->user_model->User_Already_Exist($mail))
	 {
		 return true; //user of this mail id already exist
	 }
	 
	 return false;
	  
	  
	  
  }
  
 
		
}