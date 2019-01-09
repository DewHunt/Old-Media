<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class parameter extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
	    $this->load->model('parameter_model','',TRUE);
	   if($this->session->userdata('login')!=TRUE){ redirect('user/index/1');}
	}    
         
    public function index($msg=NULL,$setext=NULL,$tab=NULL,$limit=NULL)
    {
            $search=isset($_POST['search'])?$this->input->post('search'):$setext; 
		    $search=$search==""?'_':$search;
		    if($this->input->post("module")==NULL) {$tab=$tab;} else {  $tab=$this->input->post("module"); }	
		    if($tab==NULL){$tab="product";}
		    $totalrow=$this->parameter_model->get_all_query_row_countall(addslashes($search),$tab);
		    $config['base_url'] = base_url().'index.php/parameter/index/_/'.$search.'/'.$tab.'/';
			$config['total_rows'] =  $totalrow; 
			$config['per_page'] = 10;
			$config['num_links'] = 4;
			$config['uri_segment'] = 6;
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
			$limit=$this->uri->segment(6);
			if($limit=="_"||$limit=="" ){$limit=0;}
			$this->pagination->initialize($config);
			 
			
		   $array=array(
					'msg' => $msg ,
					'title' =>'Add Parameter',
					'result' =>$this->parameter_model->get_all_query_row($limit,addslashes($search),$tab),
					'sl' =>$limit==0?1:$limit+1,
					'totalrow' =>  $totalrow,
					'operation' =>'add' ,
					'search'=>$search ,
					'array'=>$this->common_model->dropdownvalue('brand','Name',0),
					'tab' =>$tab
				 
		    );
		  $this->load->view('parameter_view',$array);
    }
    
	 public function add()
	   {  
			     $inser_id= $this->parameter_model->insert_mgt();
				 if($inser_id==1)
					{
					  redirect('parameter/index/1/_/'.$this->input->post("module"));
					}
				  else
					 {
					  redirect('parameter/index/2/_/'.$this->input->post("module"));
					 
					 }	
			 
		
	   }
	 function edit($Eid=NULL,$tab=NULL,$msg=NULL,$setext=NULL,$limit=NULL)
	 
	    {
	        $search=isset($_POST['search'])?$this->input->post('search'):'_'; 
			$totalrow=$this->parameter_model->get_all_query_row_countall(addslashes($search),$tab);
		    $config['base_url'] = base_url().'index.php/parameter/index/_/'.$search.'/';
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
			
			$querybyid=$this-> parameter_model->get_all_info_by_id($Eid,$tab);
			$Name='';
			$BrandId='0';
			$Description='';
			
			foreach($querybyid as $rfE)
			  {
					 $Name=$rfE->Name; 
                     $Description=$rfE->Description;
			   
			   }
		   
		 
		   $array=array(
					'msg' => $msg ,
					'title' =>'Edit Parameter',
					'result' =>$this->parameter_model->get_all_query_row($limit,addslashes($search),$tab),
					'sl' =>$limit==0?1:$limit,
					'totalrow' =>  $totalrow,					
					'operation' =>'edit' ,
					'Eid' =>$Eid,
					'search'=>$search,					  
					'Name'=>$Name,
					'BrandId'=>$BrandId,
					'Description'=>$Description,
					'array'=>$this->common_model->dropdownvalue('brand','Name',0),
					'tab'=>$tab
					 
		    );
		  $this->load->view('parameter_view',$array);
	   
	   
	    }
	   function edit_ac()
	     {
		         $inser_id= $this->parameter_model->edit_mgt();
				 if($inser_id==1)
					{
					  redirect('parameter/index/1/_/'.$this->input->post("module"));
					}
				  else
					 {
					  redirect('parameter/index/2/_/'.$this->input->post("module"));
					 
					 }	
		 
		 } 
	
	
		
	 function delete($Eid=NULL,$tab=NULL)
	   {
	      
		 
		 if($Eid=="") { 
		 if(isset($_POST['allvalue']) ){ 
		         for($i=0;$i<$_POST['allvalue'];$i++)
				    {
						   if(isset($_POST['chk_'.$i])) {  $this->parameter_model->deleteInfo($_POST['chk_'.$i],$tab); }
				 	}
		         }
		  
		  }
		  
		  else{
		   
			$this->parameter_model->deleteInfo($Eid,$tab); 
		   }
		   
		   redirect('parameter/index/1/_/'.$tab)	; 
	   
	   }  
 	 
     
	   
	 
	 
	 
	 
	 
	 
}

?>
