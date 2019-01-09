<?php

class User_model extends CI_model{
   
   
    public function __construct()
	{
		parent::__construct();
	   
	}    
        
    function check_login()
	   { 
	      $str="select * from users where UserId='".$this->input->post('userid')."' and Password='".$this->input->post('txtpass').		
		  "' and   State='1' ";	   
		  $query=$this->db->query($str);
		  return $query->result();
	     
	   }
   
    
}

?>