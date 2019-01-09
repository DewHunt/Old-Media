<?php

class brand_model extends CI_model{


	public function __construct()
	{
		parent::__construct();

	}    

	function get_all_query_row_countall($search=NULL)
	{  
		// if($search!='_') {$searchtext=" and Name like '%$search%'";}else {$searchtext="";}
		if($search!='_') {$searchtext=" and CompanyId like '%$search%'";}else {$searchtext="";}
		$str="select   * from  brand    where  State='1' ".$searchtext ;
		$query=$this->db->query($str); 
		return $query->num_rows(); 
	}

	function get_all_query_row($p=NULL,$search=NULL)
	{  
		$limit="limit $p,10"; 
		// if($search!='_') {$searchtext=" and   Name like '%".$search."%'";}else {$searchtext="";}
		if($search!='_') {$searchtext=" and   CompanyId like '%".$search."%'";}else {$searchtext="";}
		$str=" SELECT   * FROM  brand   WHERE State='1' ".$searchtext." ORDER BY Id DESC";
		$query=$this->db->query($str); 
		return $query->result(); 
	}

	public function GetCompanyName($c_id)
	{
		$get_company_data = $this->db->get_where('company',['Id'=>$c_id]);

		if ($get_company_data->num_rows() > 0)
		{
			return $get_company_data->row('Name');
		}
	}

	function insert_mgt()
	{
		$data=array(

			'Name'=>$this->input->post("Name"),
			'CompanyId'=>$this->input->post("CompanyId"),
    // 'SubBrandId'=>$this->input->post("SubBrandId"),
			'Description'=>$this->input->post("Description"),
			'EntryBy'=>$this->session->userdata("eid"),
			'EntryDateTime'=>date('Y-m-d H:i:s') , 
		);
		$str=$this->db->insert_string("brand",$data);		
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
    // 'SubBrandId'=>$this->input->post("SubBrandId"),
			'Description'=>$this->input->post("Description"),
			'UpdateBy'=>$this->session->userdata("eid"),
			'UpdateTime'=>date('Y-m-d H:i:s') , 
		);
		$str=$this->db->update_string("brand",$data,$where);
		$query=$this->db->query($str);				
		return  $this->db->affected_rows();

	} 






	function deleteInfo($Eid=NULL)
	{
		$where="delete from brand where  Id=".$Eid." and State='1' ";
		$str=$this->db->query( $where);
		return  $this->db->affected_rows();

	}   
	function get_all_info_by_id($eid=NULL)
	{
		$query=$this->db->get_where('brand',array('Id'=>$eid,'State'=>'1'));
		return $query->result();

	}   
	function getsubbrand($Eid=NULL)
	{
		$where="select *  from subbrand where  CompanyId=".$Eid." and State='1' ";
		$query=$this->db->query( $where);
		return   $query->result();


	}   

}

?>