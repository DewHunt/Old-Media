<?php

class pagename_model extends CI_model{


	public function __construct()
	{
		parent::__construct();

	}    

	function get_all_query_row_countall($search=NULL)
	{  
		if($search!='_')
		{
			$searchtext=" and price.Name like '%$search%'";
		}
		else
		{
			$searchtext="";
		}

		$str="SELECT price.*,pricedetails.Price,publication.Name AS pname,media.Name AS mname FROM price
		LEFT JOIN pricedetails ON (price.Id=pricedetails.PriceId)
		LEFT JOIN media ON (media.Id=price.MediaId)
		LEFT JOIN publication ON (publication.Id=price.PublicationId)
		WHERE price.State='1'".$searchtext." GROUP BY pricedetails.PriceId";
		$query=$this->db->query($str); 
		return $query->num_rows(); 
	}

	function get_all_query_row($p=NULL,$search=NULL)
	{  
		$limit="limit $p,10"; 
		if($search!='_')
		{
			$searchtext=" and  publication.Name like '%".$search."%'";
		}
		else
		{
			$searchtext="";
		}

		$str="SELECT price.*,pricedetails.Price,publication.Name AS pname,media.Name AS mname FROM price
		LEFT JOIN pricedetails ON (price.Id=pricedetails.PriceId)
		LEFT JOIN media ON (media.Id=price.MediaId)
		LEFT JOIN publication ON (publication.Id=price.PublicationId)
		WHERE price.State='1' ".$searchtext." GROUP BY pricedetails.PriceId ".$limit;

		$query=$this->db->query($str); 
		return $query->result(); 
	}
	
	function insert_mgt()
	{
		$data=array( 
			'Name'=>$this->input->post("Name"),
			'MediaId'=>$this->input->post("MediaId"),
			'PublicationId'=>$this->input->post("PublicationId"),
			'Day'=>$this->input->post("Day"),
			'EntryBy'=>$this->session->userdata("eid"),
			'EntryDateTime'=>date('Y-m-d H:i:s') , 
		);
		$str=$this->db->insert_string("price",$data);			
		$query=$this->db->query($str);
		$insert_id=$this->db->insert_id();


		for($i=1;$i<=$_POST['rowcount'];$i++)
		{
			$data=array( 
				'PriceId'=>$insert_id,
				'Name'=>$this->input->post("Name".$i),
				'Hue'=>$this->input->post("Hue".$i),
				'PageNoId'=>$this->input->post("PageNoId".$i),
				'Price'=>$this->input->post("Price".$i),
				'Col'=>$this->input->post("Col".$i),
				'Inch'=>$this->input->post("Inch".$i),
				'Description'=>$this->input->post("Description".$i),
				'EntryBy'=>$this->session->userdata("eid"),
				'EntryDateTime'=>date('Y-m-d H:i:s') , 
			);
			$str=$this->db->insert_string("pricedetails",$data);			
			$query=$this->db->query($str);


		}


		return  $this->db->affected_rows();

	}

	function edit_mgt()
	{
		$where=" Id=".$_POST['eid']." and State='1' ";
		$data=array(							
			'Name'=>$this->input->post("Name"),
			'MediaId'=>$this->input->post("MediaId"),
			'PublicationId'=>$this->input->post("PublicationId"),
			'Day'=>$this->input->post("Day"),
			'UpdateBy'=>$this->session->userdata("eid"),
			'UpdateTime'=>date('Y-m-d H:i:s') , 
		);
		$str=$this->db->update_string("price",$data,$where);
		$query=$this->db->query($str);				


		$where=" delete from pricedetails where  PriceId=".$_POST['eid']." and State='1' ";			 
		$str=$this->db->query( $where); 


		for($i=1;$i<=$_POST['rowcount'];$i++)
		{
			$data=array( 
				'PriceId'=>$_POST['eid'],
				'Name'=>$this->input->post("Name".$i),
				'Hue'=>$this->input->post("Hue".$i),
				'PageNoId'=>$this->input->post("PageNoId".$i),
				'Price'=>$this->input->post("Price".$i),
				'Col'=>$this->input->post("Col".$i),
				'Inch'=>$this->input->post("Inch".$i),
				'Description'=>$this->input->post("Description".$i),
				'EntryBy'=>$this->session->userdata("eid"),
				'EntryDateTime'=>date('Y-m-d H:i:s') , 
			);
			$str=$this->db->insert_string("pricedetails",$data);			
			$query=$this->db->query($str);


		}


		return  $this->db->affected_rows();

	} 

	function deleteInfo($Eid=NULL)
	{
		$where="delete from price where Id=".$Eid." and State='1' ";			 
		$str=$this->db->query( $where);			
		$where=" delete from pricedetails where  PriceId=".$Eid." and State='1' ";			 
		$str=$this->db->query( $where); 
		return  $this->db->affected_rows();

	}   
	function get_all_info_by_id($eid=NULL)
	{
		$query=$this->db->get_where('price',array('Id'=>$eid,'State'=>'1'));
		return $query->result();

	}  
	function loadpub($eid=NULL)
	{
		$query=$this->db->query("select * from publication where MediaId='".$eid."' and State='1' ");
		return $query->result();

	}   

	function getallparicedetails($eid=NULL)
	{
		$query=$this->db->query("select * from pricedetails where PriceId='".$eid."' and State='1' ");
		return $query->result();

	}   



}

?>