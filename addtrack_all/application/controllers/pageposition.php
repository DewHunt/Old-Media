<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class pageposition extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
	    $this->load->model('pageposition_model','',TRUE);
	   if($this->session->userdata('login')!=TRUE){ redirect('user/index/1');}
	}    
         
    public function index($msg=NULL,$setext=NULL,$limit=NULL)
    {
            $search=isset($_POST['search'])?$this->input->post('search'):$setext; 
		    $search=$search==""?'_':$search;
		    $totalrow=$this->pageposition_model->get_all_query_row_countall(addslashes($search));
		    $config['base_url'] = base_url().'index.php/pageposition/index/_/'.$search.'/';
			$config['total_rows'] =  $totalrow; 
			$config['per_page'] = 10;
			$config['num_links'] = 4;
			$config['uri_segment'] = 5;
			$config['full_tag_open'] = '<ul>';
			$config['full_tag_close'] = '</ul>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$config['first_tag_open'] = '<li>'; 
			$config['first_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li>'; 
			$config['last_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="active"><a>';			 
			$config['cur_tag_close'] = '</a></li>';
			$config['last_tag_open'] = '<li>';			
			$config['last_tag_close'] = '</li>';
			$config['next_tag_open'] = '<li>';			 
			$config['next_tag_close'] = '</li>';
			$config['prev_tag_open'] = '<li>';			 
			$config['prev_tag_close'] = '</li>';			
			$config['next_link'] = '&raquo;';
			$config['prev_link'] = '&laquo;';			
			$limit=$this->uri->segment(5);
			if($limit=="_"||$limit=="" ){$limit=0;}
			$this->pagination->initialize($config);
			 
			
		   $array=array(
					'msg' => $msg ,
					'title' =>'Add Placing Type',
					'result' =>$this->pageposition_model->get_all_query_row($limit,addslashes($search)),
					'sl' =>$limit==0?1:$limit+1,
					'totalrow' =>  $totalrow,
					'operation' =>'add' ,
					'search'=>$search ,
					'array'=>$this->common_model->dropdownvalue('media','Name',0),
				 
		    );
		  $this->load->view('pageposition_view',$array);
    }
    
	 public function add()
	   {  
			     $inser_id= $this->pageposition_model->insert_mgt();
				 if($inser_id==1)
					{
					  redirect('pageposition/index/1');
					}
				  else
					 {
					  redirect('pageposition/index/2');
					 
					 }	
			 
		
	   }
	 function edit($Eid=NULL,$msg=NULL,$setext=NULL,$limit=NULL)
	 
	    {
	        $search=isset($_POST['search'])?$this->input->post('search'):'_'; 
			$totalrow=$this->pageposition_model->get_all_query_row_countall(addslashes($search));
		    $config['base_url'] = base_url().'index.php/pageposition/index/_/'.$search.'/';
			$config['total_rows'] =  $totalrow; 
			$config['per_page'] = 10;
			$config['num_links'] = 4;
			$config['uri_segment'] = 5;
			$config['full_tag_open'] = '<ul>';
			$config['full_tag_close'] = '</ul>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$config['first_tag_open'] = '<li>'; 
			$config['first_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li>'; 
			$config['last_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="active"><a>';			 
			$config['cur_tag_close'] = '</a></li>';
			$config['last_tag_open'] = '<li>';			
			$config['last_tag_close'] = '</li>';
			$config['next_tag_open'] = '<li>';			 
			$config['next_tag_close'] = '</li>';
			$config['prev_tag_open'] = '<li>';			 
			$config['prev_tag_close'] = '</li>';			
			$config['next_link'] = '&raquo;';
			$config['prev_link'] = '&laquo;';			
			$limit=$this->uri->segment(5);
            if($limit=="_"||$limit=="" ){$limit=0;}
			$this->pagination->initialize($config);
			
			$querybyid=$this-> pageposition_model->get_all_info_by_id($Eid);
			  $Name='';

   $Description='';
			
			foreach($querybyid as $rfE)
			  {
					$Name=$rfE->Name;
				
					$Description=$rfE->Description;
			   
			   }
		   
		 
		   $array=array(
					'msg' => $msg ,
					'title' =>'Edit Placing Type',
					'result' =>$this->pageposition_model->get_all_query_row($limit,addslashes($search)),
					'sl' =>$limit==0?1:$limit,
					'totalrow' =>  $totalrow,					
					'operation' =>'edit' ,
					'Eid' =>$Eid,
					'search'=>$search,					  
					'Name'=>$Name,				
					'Description'=>$Description,
				
					 
		    );
		  $this->load->view('pageposition_view',$array);
	   
	   
	    }
	   function edit_ac()
	     {
		         $inser_id= $this->pageposition_model->edit_mgt();
				 if($inser_id==1)
					{
					  redirect('pageposition/index/1');
					}
				  else
					 {
					  redirect('pageposition/index/2');
					 
					 }	
		 
		 } 
	
	
		
	 function delete($Eid=NULL)
	   {
	      
		 
		 if($Eid=="") { 
		 if(isset($_POST['allvalue']) ){ 
		         for($i=0;$i<$_POST['allvalue'];$i++)
				    {
						   if(isset($_POST['chk_'.$i])) {  $this->pageposition_model->deleteInfo($_POST['chk_'.$i]); }
				 	}
		         }
		  
		  }
		  
		  else{
		   
			$this->pageposition_model->deleteInfo($Eid); 
		   }
		   
		   redirect('pageposition/index/1')	; 
	   
	   }  
 	 
     
	   
	 
	 
	 
	 
	 
	 
}

?>
