<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class User extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
	    $this->load->model('user_model','',TRUE);
	}    
         
    public function index($msg=NULL)
    {
          $array=array(
		    'msg' => $msg
		    );
		  $this->load->view('login',$array);
    }
    
	function checklogin()
	{
	   $result=$this->user_model->check_login();
	   if(count($result)=='1')
	    {
		   foreach( $result as $row)
		      {
			    $userId=$row->UserId;
			    $eid=$row->Id;
				$username=$row->Name;
			  
			  }
		   
		   $data=array(
		     'userId' =>$userId,
			 'eid' =>$eid,
			 'username' =>$username,
			 'login' =>TRUE
			  
		   
		    );
		   
		   $this->session->set_userdata($data);
		   
		   redirect('welcome/index/');
		}
		else
		 {
		    redirect('user/index/1');
		 
		 }
		
	}
	
 	 function logout($msg=NULL)
	  {
	      $data=array(
		     'userId' =>"",
			 'eid' =>"",
			 'username' =>"",
			 'login' =>FALSE 
		    );
		   
		   $this->session->unset_userdata($data);
		   $this->session->sess_destroy();
	      $array=array(
		    'msg' => $msg
		    );
		  $this->load->view('login',$array); 
	  
	  
	  }
     
}

?>
