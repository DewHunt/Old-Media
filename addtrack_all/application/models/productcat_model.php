<?php

class productcat_model extends CI_model{
   
   
    public function __construct()
	{
		parent::__construct();
	   
	}    
        
   function get_all_query_row_countall($search=NULL)
	   {  
			  if($search!='_') {$searchtext=" and product_cat.Name like '%$search%'";}else {$searchtext="";}
			  $str="select   product_cat.*,product.Name as pname from  product_cat left join product on product_cat.ProductId=product.Id    where  product_cat.State='1' ".$searchtext ;
			  $query=$this->db->query($str); 
			  return $query->num_rows(); 
	   }
    function get_all_query_row($p=NULL,$search=NULL)
	   {  
			  $limit="limit $p,10"; 
			  if($search!='_') {$searchtext=" and   product_cat.Name like '%".$search."%'";}else {$searchtext="";}
			  $str=" select   product_cat.*,product.Name as pname from  product_cat left join product on product_cat.ProductId=product.Id    where  product_cat.State='1' ".$searchtext.$limit;
			  $query=$this->db->query($str); 
			  return $query->result(); 
	   }
   function insert_mgt()
       {
				 $data=array(				
							'ProductId'=>$this->input->post("ProductId"),
							'Name'=>$this->input->post("Name"),
							'Description'=>$this->input->post("Description"),
							'EntryBy'=>$this->session->userdata("eid"),
							'EntryDateTime'=>date('Y-m-d H:i:s') , 
			         	);
				 $str=$this->db->insert_string("product_cat",$data);		
				$query=$this->db->query($str);
				$insert_id=$this->db->insert_id();				
				return  $this->db->affected_rows();
    
	   }
	   
	  function edit_mgt()
       {
				$where=" Id='".$_POST['eid']."' and State='1' ";				
				$data=array(
							'ProductId'=>$this->input->post("ProductId"),
							'Name'=>$this->input->post("Name"),
							'Description'=>$this->input->post("Description"),
							'UpdateBy'=>$this->session->userdata("eid"),
							'UpdateTime'=>date('Y-m-d H:i:s') , 
						);
                $str=$this->db->update_string("product_cat",$data,$where);
				$query=$this->db->query($str);				
				return  $this->db->affected_rows();
    
	   } 
	   
	   
	   
	   
	   
	   
	function deleteInfo($Eid=NULL)
	  {
			$where="delete from product_cat where  Id=".$Eid." and State='1' ";
 
 $str=$this->db->query( $where);
			 
			return  $this->db->affected_rows();
		 
	  }   
	function get_all_info_by_id($eid=NULL)
	  {
	    $query=$this->db->get_where('product_cat',array('Id'=>$eid,'State'=>'1'));
		return $query->result();
	  
	  }   
	   
    
}

?>