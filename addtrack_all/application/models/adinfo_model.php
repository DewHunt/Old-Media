<?php

class adinfo_model extends CI_model{
   
   
    public function __construct()
	{
		parent::__construct();
	   
	}    
        
   function get_all_query_row_countall($search=NULL)
	   {  
			  if($search!='_') {$searchtext=" and adinfo.Title like '%$search%'";}else {$searchtext="";}
			  $str="select adinfo.*,Brand.Name As bname from  adinfo left join Brand On (adinfo.BrandId=Brand.Id) where adinfo.State='1' ".$searchtext ;
			  $query=$this->db->query($str); 
			  return $query->num_rows(); 
	   }
    function get_all_query_row($p=NULL,$search=NULL)
	   {  
			  $limit="limit $p,10"; 
			  if($search!='_') {$searchtext=" and  adinfo.Title like '%".$search."%'";}else {$searchtext="";}
			  $str="select adinfo.*,Brand.Name As bname from  adinfo left join Brand On (adinfo.BrandId=Brand.Id) where adinfo.State='1' ".$searchtext.$limit;
			  $query=$this->db->query($str); 
			  return $query->result(); 
	   }
   function insert_mgt()
       {
	   
	        $image=$this->common_model->fileupload('Image','adinfo','images',0,0,0  );
			$data=array(
						'Image'=>$image,
						'AD_ID'=>$this->input->post("AD_ID"),
						'Title'=>$this->input->post("Title"),
						'BrandId'=>$this->input->post("BrandId"),
						'SubBrandId'=>$this->input->post("SubBrandId"),
						'CompanyId'=>$this->input->post("CompanyId"),
						'Notes'=>$this->input->post("Notes"),						
						'ProductId'=>$this->input->post("ProductId"),
						'AtypeId'=>$this->input->post("AtypeId"),
						'AdTheme'=>$this->input->post("AdTheme"),
						'EntryBy'=>$this->session->userdata("eid"),
						'EntryDateTime'=>date('Y-m-d H:i:s'),
						);
 $str=$this->db->insert_string("adinfo",$data);
				 $query=$this->db->query($str);
				 $insert_id=$this->db->insert_id();
				 
			   return  $this->db->affected_rows();
    
	   }
	   
	  function edit_mgt()
       {
				
			  
			if($_FILES['Image']['name']!=""){ $image=$this->common_model->fileupload('Image','adinfo','images',0,0,0  );} else {$image=$_POST['hidImage']; }	
				
				$where=" Id='".$_POST['eid']."' and State='1' ";				
				$data=array(
								'Image'=>$image,
								'AD_ID'=>$this->input->post("AD_ID"),
								'Title'=>$this->input->post("Title"),
								'BrandId'=>$this->input->post("BrandId"),
								'SubBrandId'=>$this->input->post("SubBrandId"),
								'CompanyId'=>$this->input->post("CompanyId"),
								'Notes'=>$this->input->post("Notes"),						
								'ProductId'=>$this->input->post("ProductId"),
								'AtypeId'=>$this->input->post("AtypeId"),
								'AdTheme'=>$this->input->post("AdTheme"),
								'UpdateBy'=>$this->session->userdata("eid"),
								'UpdateTime'=>date('Y-m-d H:i:s'),
				);
				$str=$this->db->update_string("adinfo",$data,$where);
				$query=$this->db->query($str);				
				return  $this->db->affected_rows();
    
	   } 
	   
	   
	   
	   
	   
	   
	function deleteInfo($Eid=NULL)
	  {
			$where="delete from adinfo where  Id='$Eid' and State='1' ";
			$str=$this->db->query($where);
			 return  $this->db->affected_rows();
		 
	  }   
	function get_all_info_by_id($eid=NULL)
	  {
	    $query=$this->db->get_where('adinfo',array('Id'=>$eid,'State'=>'1'));
		return $query->result();
	  
	  }   
	  
	  function getsubbrandid($eid=NULL,$sid=NULL)
	  {
	    $query=$this->db->get_where('subbrand',array('CompanyId'=>$eid,'BrandId'=>$sid, 'State'=>'1'));
		return $query->result();
	  
	  }   
	  function getbrand($eid=NULL)
	  {
	    $query=$this->db->get_where('brand',array('CompanyId'=>$eid, 'State'=>'1'));
		return $query->result();
	  
	  }   
	   
    
}

?>