<?php

class menusubcategory_model extends CI_model{
   
   
    public function __construct()
	{
		parent::__construct();
	   
	}    
        
   function get_all_query_row_countall($search=NULL)
	   {  
			  if($search!='_') {$searchtext=" and sysuserright.Name like '%$search%'";}else {$searchtext="";}
			  $str="select * from  sysuserright where State='1' ".$searchtext ;
			  $query=$this->db->query($str); 
			  return $query->num_rows(); 
	   }
    function get_all_query_row($p=NULL,$search=NULL)
	   {  
			  $limit="limit $p,10"; 
			  if($search!='_') {$searchtext=" and sysuserright.Name like '%".$search."%'";}else {$searchtext="";}
			  $str="select sysuserright.*,sysuserrightcat.Name as catname from  sysuserright left join sysuserrightcat on 
			   sysuserright.SysUserCatId=sysuserrightcat.Id  where sysuserright.State='1' ".$searchtext.$limit;
			  $query=$this->db->query($str); 
			  return $query->result(); 
	   }
   function insert_mgt()
       {
			
			$data=array(
			
				'SysUserCatId'=>$this->input->post("SysUserCatId"),
				'OperationId'=>$this->input->post("OperationId"),
				'Name'=>$this->input->post("Name"),
				'Url'=>$this->input->post("Url"),
				'Title'=>$this->input->post("Title"),
			);
			$str=$this->db->insert_string("sysuserright",$data);
			$query=$this->db->query($str);
			$insert_id=$this->db->insert_id();
			return  $this->db->affected_rows();
    
	   }
	   
	  function edit_mgt()
       {
			 	$where=" Id='".$_POST['eid']."' and State='1' ";
				$data=array(
				
					 'SysUserCatId'=>$this->input->post("SysUserCatId"),
					 'OperationId'=>$this->input->post("OperationId"),
					 'Name'=>$this->input->post("Name"),
					 'Url'=>$this->input->post("Url"),
					 'Title'=>$this->input->post("Title"),
				);
			   $str=$this->db->update_string("sysuserright",$data,$where);
			  
			 $query=$this->db->query($str);
			 
			return  $this->db->affected_rows();
    
	   } 
	   
	   
	   
	   
	   
	   
	function deleteInfo($Eid=NULL)
	  {
			$where=" Id='$Eid' and State='1' ";
			$data=array(			
			   'State'=>$this->input->post("State"),
			);
			$str=$this->db->update_string("sysuserright",$data,$where);
			$query=$this->db->query($str);
			return  $this->db->affected_rows();
		 
	  }   
	function get_all_info_by_id($eid=NULL)
	  {
	    $query=$this->db->get_where('sysuserright',array('Id'=>$eid,'State'=>'1'));
		return $query->result();
	  
	  }   
	   
    
}

?>