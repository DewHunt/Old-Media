<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class welcome extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
	    if($this->session->userdata('login')!=TRUE){ redirect('user/index');} 
	}    
         
    public function index($msg=NULL)
    { 
		  $this->load->view('welcome_view' );
    }
    
	 
	 
     
}

?>
