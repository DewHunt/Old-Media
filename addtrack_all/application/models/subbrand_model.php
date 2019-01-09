<?php

class subbrand_model extends CI_model{


	public function __construct()
	{
		parent::__construct();

	}    

	function get_all_query_row_countall($search=NULL)
	{  
		if($search!='_') {$searchtext=" and subbrand.Name like '%$search%'";}else {$searchtext="";}
		$str="select   subbrand.*,company.Name as bane from  subbrand left join company on subbrand.CompanyId=company.Id    where  subbrand.State='1' ".$searchtext ;
		$query=$this->db->query($str); 
		return $query->num_rows(); 
	}

	function get_all_query_row($p=NULL,$search=NULL)
	{  
		$limit="limit $p,10"; 
		if($search!='_')
		{
			$searchtext=" and   subbrand.Name like '%".$search."%'";
		}
		else
		{
			$searchtext="";
		}

		$str="SELECT subbrand.*,company.Name AS bane FROM subbrand LEFT JOIN company ON subbrand.CompanyId=company.Id WHERE subbrand.State='1' ".$searchtext.$limit;
		$query=$this->db->query($str); 
		return $query->result(); 
	}

	function insert_mgt()
	{
		$data=array(				
			'Name'=>$this->input->post("Name"),
			'CompanyId'=>$this->input->post("CompanyId"),
			'BrandId'=>$this->input->post("BrandId"),
			'Description'=>$this->input->post("Description"),
			'EntryBy'=>$this->session->userdata("eid"),
			'EntryDateTime'=>date('Y-m-d H:i:s') , 
		);
		$str=$this->db->insert_string("subbrand",$data);		
		$query=$this->db->query($str);
		$insert_id=$this->db->insert_id();				
		return  $this->db->affected_rows();

	}

	function edit_mgt()
	{
		$where=" Id='".$_POST['eid']."' and State='1' ";				
		$data=array(
			'Name'=>$this->input->post("Name"),
			'CompanyId'=>$this->input->post("CompanyId"),
			'BrandId'=>$this->input->post("BrandId"),
			'Description'=>$this->input->post("Description"),
			'UpdateBy'=>$this->session->userdata("eid"),
			'UpdateTime'=>date('Y-m-d H:i:s') , 
		);
		$str=$this->db->update_string("subbrand",$data,$where);
		$query=$this->db->query($str);				
		return  $this->db->affected_rows();

	} 






	function deleteInfo($Eid=NULL)
	{
		$where="delete from subbrand where  Id=".$Eid." and State='1' ";

		$str=$this->db->query( $where);

		return  $this->db->affected_rows();

	}   
	function get_all_info_by_id($eid=NULL)
	{
		$query=$this->db->get_where('subbrand',array('Id'=>$eid,'State'=>'1'));
		return $query->result();

	}   
	function getsubbrand($Eid=NULL)
	{
		$where="select *  from brand where  CompanyId=".$Eid." and State='1' ";
		$query=$this->db->query( $where);
		return   $query->result();


	}   

}

?>