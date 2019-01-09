<?php

class menucategory_model extends CI_model{
   
   
    public function __construct()
	{
		parent::__construct();
	   
	}    
        
   function get_all_query_row_countall($search=NULL)
	   {  
			  if($search!='_') {$searchtext=" and Name like '%$search%'";}else {$searchtext="";}
			  $str="select * from  sysuserrightcat where State='1' ".$searchtext ;
			  $query=$this->db->query($str); 
			  return $query->num_rows(); 
	   }
    function get_all_query_row($p=NULL,$search=NULL)
	   {  
			  $limit="limit $p,10"; 
			  if($search!='_') {$searchtext=" and Name like '%".$search."%'";}else {$searchtext="";}
			  $str="select * from  sysuserrightcat where State='1' ".$searchtext.$limit;
			  $query=$this->db->query($str); 
			  return $query->result(); 
	   }
   function insert_mgt()
       {
			
			$data=array(			
				'Name'=>$this->input->post("Name"),
				'Url'=>$this->input->post("Url"),
				'Order'=>$this->input->post("Order"),
			);
			$str=$this->db->insert_string("sysuserrightcat",$data);
			$query=$this->db->query($str);
			$insert_id=$this->db->insert_id();
			return  $this->db->affected_rows();
    
	   }
	   
	  function edit_mgt()
       {
			$where=" Id='".$this->input->post('eid')."' and State='1' ";
			$data=array(			
				'Name'=>$this->input->post("Name"),
				'Url'=>$this->input->post("Url"),
				'Order'=>$this->input->post("Order"),
			);
		    $str=$this->db->update_string("sysuserrightcat",$data,$where);
			 
			$query=$this->db->query($str);
			return  $this->db->affected_rows();
    
	   } 
	   
	   
	   
	   
	   
	   
	function deleteInfo($Eid=NULL)
	  {
			$where=" Id='$Eid' and State='1' ";
			$data=array(			
			    'State'=>0,
			 );
		    $str=$this->db->update_string("sysuserrightcat",$data,$where);			 
			$query=$this->db->query($str);
			return  $this->db->affected_rows();
		 
	  }   
	function get_all_info_by_id($eid=NULL)
	  {
	    $query=$this->db->get_where('sysuserrightcat',array('Id'=>$eid,'State'=>'1'));
		return $query->result();
	  
	  }   
	   
    
}

?>