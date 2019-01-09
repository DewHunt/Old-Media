<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class publication extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
	    $this->load->model('publication_model','',TRUE);
	   if($this->session->userdata('login')!=TRUE){ redirect('user/index/1');}
	}    
         
    public function index($msg=NULL,$setext=NULL,$limit=NULL)
    {
            $search=isset($_POST['search'])?$this->input->post('search'):$setext; 
		    $search=$search==""?'_':$search;
		    $totalrow=$this->publication_model->get_all_query_row_countall(addslashes($search));
		    $config['base_url'] = base_url().'index.php/publication/index/_/'.$search.'/';
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
					'title' =>'Add Publication',
					'result' =>$this->publication_model->get_all_query_row($limit,addslashes($search)),
					'sl' =>$limit==0?1:$limit+1,
					'totalrow' =>  $totalrow,
					'operation' =>'add' ,
					'search'=>$search ,
					'array'=>$this->common_model->dropdownvalue('media','Name',0),
					'parray'=>$this->common_model->dropdownvalue('pubtype','Name',0),
					'pparray'=>$this->common_model->dropdownvalue('pubplace','Name',0),
					'pfarray'=>$this->common_model->dropdownvalue('pubfrequency','Name',0),
				 
		    );
		  $this->load->view('publication_view',$array);
    }
    
	 public function add()
	   {  
			     $inser_id= $this->publication_model->insert_mgt();
				 if($inser_id==1)
					{
					  redirect('publication/index/1');
					}
				  else
					 {
					  redirect('publication/index/2');
					 
					 }	
			 
		
	   }
	 function edit($Eid=NULL,$msg=NULL,$setext=NULL,$limit=NULL)
	 
	    {
	        $search=isset($_POST['search'])?$this->input->post('search'):'_'; 
			$totalrow=$this->publication_model->get_all_query_row_countall(addslashes($search));
		    $config['base_url'] = base_url().'index.php/publication/index/_/'.$search.'/';
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
			
			$querybyid=$this-> publication_model->get_all_info_by_id($Eid);
			$Name='';
   $MediaId='0';
   $PublicationType='0';
   $PubPlaceId='0';
   $PubFreQuencyId='0';
   $PublicationLan='0';
   $Description='';
   $Logo="";
			
			foreach($querybyid as $rfE)
			  {
					 $Name=$rfE->Name;
   $MediaId=$rfE->MediaId;
   $PublicationType=$rfE->PublicationType;
   $PubPlaceId=$rfE->PubPlaceId;
   $PubFreQuencyId=$rfE->PubFreQuencyId;
   $PublicationLan=$rfE->PublicationLan;
   $Description=$rfE->Description;
  $Logo=$rfE->Logo;		   
			   }
		   
		 
		   $array=array(
					'msg' => $msg ,
					'title' =>'Edit Publication',
					'result' =>$this->publication_model->get_all_query_row($limit,addslashes($search)),
					'sl' =>$limit==0?1:$limit,
					'totalrow' =>  $totalrow,					
					'operation' =>'edit' ,
					'Eid' =>$Eid,
					'search'=>$search,					  
					'Name'=>$Name,
					'MediaId'=>$MediaId,
					'PublicationType'=>$PublicationType,
					'PubPlaceId'=>$PubPlaceId,
					'PubFreQuencyId'=>$PubFreQuencyId,
					'PublicationLan'=>$PublicationLan,
					'Description'=>$Description,
					'Logo' => $Logo ,
			    	'array'=>$this->common_model->dropdownvalue('media','Name',0),
					'parray'=>$this->common_model->dropdownvalue('pubtype','Name',0),
					'pparray'=>$this->common_model->dropdownvalue('pubplace','Name',0),
					'pfarray'=>$this->common_model->dropdownvalue('pubfrequency','Name',0),
					 
		    );
		  $this->load->view('publication_view',$array);
	   
	   
	    }
	   function edit_ac()
	     {
		         $inser_id= $this->publication_model->edit_mgt();
				 if($inser_id==1)
					{
					  redirect('publication/index/1');
					}
				  else
					 {
					  redirect('publication/index/2');
					 
					 }	
		 
		 } 
	
	
		
	 function delete($Eid=NULL)
	   {
	      
		 
		 if($Eid=="") { 
		 if(isset($_POST['allvalue']) ){ 
		         for($i=0;$i<$_POST['allvalue'];$i++)
				    {
						   if(isset($_POST['chk_'.$i])) {  $this->publication_model->deleteInfo($_POST['chk_'.$i]); }
				 	}
		         }
		  
		  }
		  
		  else{
		   
			$this->publication_model->deleteInfo($Eid); 
		   }
		   
		   redirect('publication/index/1')	; 
	   
	   }  
 	 
 
	   
	 
	 
	 
	 
	 
	 
}

?>
