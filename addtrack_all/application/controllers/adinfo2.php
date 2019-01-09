<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class adinfo extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
	    $this->load->model('adinfo_model','',TRUE);
	   if($this->session->userdata('login')!=TRUE){ redirect('user/index/1');}
	}    
         
    public function index($msg=NULL,$setext=NULL,$limit=NULL)
    {
            $search=isset($_POST['search'])?$this->input->post('search'):$setext; 
		    $search=$search==""?'_':$search;
		    $totalrow=$this->adinfo_model->get_all_query_row_countall(addslashes($search));
		    $config['base_url'] = base_url().'index.php/adinfo/index/_/'.$search.'/';
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
					'title' =>'Add Media Name',
					'result' =>$this->adinfo_model->get_all_query_row($limit,addslashes($search)),
					'sl' =>$limit==0?1:$limit,
					'totalrow' =>  $totalrow,
					'operation' =>'add' ,
					'search'=>$search ,
					'carray'=>$this->common_model->dropdownvalue('company','Name',0),
					'parray'=>$this->common_model->dropdownvalue('product_cat','Name',0),
					'aarray'=>$this->common_model->dropdownvalue('adcategory','Name',0),
					'array'=>array('0'=>'Select')
					 
				 
		    );
		  $this->load->view('adinfo_view',$array);
    }
    
	 public function add()
	   {  
			     $inser_id= $this->adinfo_model->insert_mgt();
				 if($inser_id==1)
					{
					  redirect('adinfo/index/1');
					}
				  else
					 {
					  redirect('adinfo/index/2');
					 
					 }	
			 
		
	   }
	 function edit($Eid=NULL,$msg=NULL,$setext=NULL,$limit=NULL)
	 
	    {
	        $search=isset($_POST['search'])?$this->input->post('search'):'_'; 
			$totalrow=$this->adinfo_model->get_all_query_row_countall(addslashes($search));
		    $config['base_url'] = base_url().'index.php/adinfo/index/_/'.$search.'/';
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
			
			$querybyid=$this-> adinfo_model->get_all_info_by_id($Eid);
	 $AD_ID='';
   $Title='';
   $BrandId='';
   $SubBrandId='';
   $CompanyId='';
   $Notes='';
   $Image='';
   $ProductId='';
   $AtypeId='';
   $AdTheme='';
			foreach($querybyid as $rfE)
			  {
				$AD_ID=$rfE->AD_ID;
   $Title=$rfE->Title;
   $BrandId=$rfE->BrandId;
   $SubBrandId=$rfE->SubBrandId;
   $CompanyId=$rfE->CompanyId;
   $Notes=$rfE->Notes;
   $Image=$rfE->Image;
   $ProductId=$rfE->ProductId;
   $AtypeId=$rfE->AtypeId;
   $AdTheme=$rfE->AdTheme;
			   }
		   
		 
		   $array=array(
							'msg' => $msg ,
							'title' =>'Edit  Media Name',
							'result' =>$this->adinfo_model->get_all_query_row($limit,addslashes($search)),
							'sl' =>$limit==0?1:$limit,
							'totalrow' =>  $totalrow,					
							'operation' =>'edit' ,
							'Eid' =>$Eid,
							'search'=>$search,					  
							'AD_ID'=>$AD_ID,
							'Title'=>$Title,
							'BrandId'=>$BrandId,
							'SubBrandId'=>$SubBrandId,
							'CompanyId'=>$CompanyId,
							'Notes'=>$Notes,
							'Image'=>$Image,
							'ProductId'=>$ProductId,
							'AtypeId'=>$AtypeId,
							'AdTheme'=>$AdTheme,
							'carray'=>$this->common_model->dropdownvalue('company','Name',0),
							'parray'=>$this->common_model->dropdownvalue('product_cat','Name',0),
							'aarray'=>$this->common_model->dropdownvalue('adcategory','Name',0),
							'barray'=>$this->common_model->dropdownvaluewhere('brand','Name'," and CompanyId='".$CompanyId."'  and  SubBrandId='".$SubBrandId."'"),
							'sbarray'=>$this->common_model->dropdownvaluewhere('subbrand','Name'," and CompanyId='".$CompanyId."' "),
							'array'=>array('0'=>'Select')
					 
		              );
		  $this->load->view('adinfo_view',$array);
	   
	   
	    }
	   function edit_ac()
	     {
		         $inser_id= $this->adinfo_model->edit_mgt();
				 if($inser_id==1)
					{
					  redirect('adinfo/index/1');
					}
				  else
					 {
					  redirect('adinfo/index/2');
					 
					 }	
		 
		 } 
	
	
		
	 function delete($Eid=NULL)
	   {
	      
		 
		 if($Eid=="") { 
		 if(isset($_POST['allvalue']) ){ 
		         for($i=0;$i<$_POST['allvalue'];$i++)
				    {
						   if(isset($_POST['chk_'.$i])) {  $this->adinfo_model->deleteInfo($_POST['chk_'.$i]); }
				 	}
		         }
		  
		  }
		  
		  else{
		   
			$this->adinfo_model->deleteInfo($Eid); 
		   }
		   
		   redirect('adinfo/index/1')	; 
	   
	   }  
 	 
     function ajaxsubbrand($cid=NULL,$sid=NULL)
	  {
	    $res=$this->adinfo_model->getsubbrandid($cid,$sid);
	    $arr[0]="Select";
		foreach($res as $row)
		  {
		   $arr[$row->Id]=$row->Name;
		  }
		echo form_dropdown('SubBrandId', $arr,'0' ,"tabindex='4'  id='SubBrandId'");
		
	  }
	   
	 
	 
	 
	  function ajaxbrand($cid=NULL)
	  {
	    $res=$this->adinfo_model->getbrand($cid );
	    $arr[0]="Select";
		foreach($res as $row)
		  {
		   $arr[$row->Id]=$row->Name;
		  }
		echo form_dropdown('BrandId', $arr,'0' ,"tabindex='3' onchange='getbrand()' id='BrandId'");
		
	  }
	   
	 
	 
	 
}

?>
