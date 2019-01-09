<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Menucategory extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
	    $this->load->model('menucategory_model','',TRUE);
	     if($this->session->userdata('login')!=TRUE){ redirect('user/index/1');}
	}    
         
    public function index($msg=NULL,$setext=NULL,$limit=NULL)
    {
            $search=isset($_POST['search'])?$this->input->post('search'):$setext; 
		    $search=$search==""?'_':$search;
		    $totalrow=$this->menucategory_model->get_all_query_row_countall(addslashes($search));
		    $config['base_url'] = base_url().'index.php/menucategory/index/_/'.$search.'/';
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
			'title' =>'Add Menu Category',
			'result' =>$this->menucategory_model->get_all_query_row($limit,addslashes($search)),
			 'sl' =>$limit==0?1:$limit,
			 'totalrow' =>  $totalrow,
			 'operation' =>'add' ,
			 'search'=>$search
		    );
		  $this->load->view('menucategory_view',$array);
    }
    
	 public function add()
	   {  
			     $inser_id= $this->menucategory_model->insert_mgt();
				 if($inser_id==1)
					{
					  redirect('menucategory/index/1');
					}
				  else
					 {
					  redirect('menucategory/index/2');
					 
					 }	
			 
		
	   }
	 function edit($Eid=NULL,$msg=NULL,$setext=NULL,$limit=NULL)
	 
	    {
	        $search=isset($_POST['search'])?$this->input->post('search'):'_'; 
			$totalrow=$this->menucategory_model->get_all_query_row_countall(addslashes($search));
		     $config['base_url'] = base_url().'index.php/menucategory/index/_/'.$search.'/';
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
			
			$querybyid=$this-> menucategory_model->get_all_info_by_id($Eid);
			$Name='';
			$Url='';
			$Order='';
			
			foreach($querybyid as $row)
			  {
					$Name=$row->Name;
					$Url=$row->Url;
					$Order=$row->Order;
			   
			   }
		   
		 
		   $array=array(
					'msg' => $msg ,
					'title' =>'Edit Menu Category',
					'result' =>$this->menucategory_model->get_all_query_row($limit,addslashes($search)),
					'sl' =>$limit==0?1:$limit,
					'totalrow' =>  $totalrow,					
					'operation' =>'edit' ,
					'Eid' =>$Eid,
					'Name'=>$Name,
					'Url'=>$Url,
					'Order'=>$Order,
					 'search'=>$search
		    );
		  $this->load->view('menucategory_view',$array);
	   
	   
	    }
	   function edit_ac()
	     {
		         $inser_id= $this->menucategory_model->edit_mgt();
				 if($inser_id==1)
					{
					  redirect('menucategory/index/1');
					}
				  else
					 {
					  redirect('menucategory/index/2');
					 
					 }	
		 
		 } 
	
	
		
	 function delete($Eid=NULL)
	   {
	      
		 
		 if($Eid=="") { 
		 if(isset($_POST['allvalue']) ){ 
		         for($i=0;$i<$_POST['allvalue'];$i++)
				    {
						   if(isset($_POST['chk_'.$i])) {  $this->menucategory_model->deleteInfo($_POST['chk_'.$i]); }
				 	}
		         }
		  
		  }
		  
		  else{
		   
			$this->menucategory_model->deleteInfo($Eid); 
		   }
		   
		   redirect('menucategory/index/1')	; 
	   
	   }  
 	 
     
	   
	 
	 
	 
	 
	 
	 
}

?>
