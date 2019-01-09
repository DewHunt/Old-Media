<?php
	
	class medianame_model extends CI_model{
		
		
		public function __construct()
		{
			parent::__construct();
			
		}    
        
		function get_all_query_row_countall($search=NULL)
		{  
			if($search!='_') {$searchtext=" and Name like '%$search%'";}else {$searchtext="";}
			$str="select * from  media where State='1' ".$searchtext ;
			$query=$this->db->query($str); 
			return $query->num_rows(); 
		}

		function get_all_query_row($p=NULL,$search=NULL)
		{  
			$limit="limit $p,10";

			if($search!='_')
			{
				$searchtext=" and  Name like '%".$search."%'";}else {$searchtext="";
			}

			$str="SELECT * FROM  media  WHERE State = '1' ORDER BY Id DESC ".$searchtext.$limit;
			$query=$this->db->query($str); 
			return $query->result(); 
		}

		function insert_mgt()
		{
			// $image=$this->common_model->fileupload('','','','','','','','','Image','med','images','',70,70 );
			// $image=$this->common_model->fileupload('Image','med','images','',70,70 );
			$image=$this->common_model->menufileupload('Image','med','images','',70,70 );

			$data=array(
			
			'Name'=>$this->input->post("Name"),
			'Owner'=>$this->input->post("Owner"),
			'Phone'=>$this->input->post("Phone"),
			'Email'=>$this->input->post("Email"),
			'Address'=>$this->input->post("Address"),
			'Image'=>$image,
			'EntryBy'=>$this->session->userdata("eid"),
			'EntryDateTime'=>date('Y-m-d H:i:s'),
			);

			// print_r($data);
			// exit();

			$str=$this->db->insert_string("media",$data);
			$query=$this->db->query($str);
			$insert_id=$this->db->insert_id();
			
			return $this->db->affected_rows();
			
		}
		
		function edit_mgt()
		{
			
			if($_FILES['Image']['name']!="") { $image=$this->common_model->fileupload ('Image','med','images','','70','70'); } else {
				$image=$this->input->post('hidlogo');
			}
			
			$where=" Id='".$_POST['eid']."' and State='1' ";				
			$data=array(
			'Name'=>$this->input->post("Name"),
			'Owner'=>$this->input->post("Owner"),
			'Phone'=>$this->input->post("Phone"),
			'Email'=>$this->input->post("Email"),
			'Address'=>$this->input->post("Address"),
			'Image'=> $image,
			'EntryBy'=>$this->input->post("EntryBy"),
			'UpdateBy'=>$this->session->userdata("eid"),
			'UpdateTime'=>date('Y-m-d H:i:s'),
			);
			$str=$this->db->update_string("media",$data,$where);
			$query=$this->db->query($str);				
			return  $this->db->affected_rows();
			
		} 
		
		
		
		
		
		
		function deleteInfo($Eid=NULL)
		{
			$where="delete from media where  Id='$Eid' and State='1' ";
			$str=$this->db->query($where);
			return  $this->db->affected_rows();
			
		}   
		function get_all_info_by_id($eid=NULL)
		{
			$query=$this->db->get_where('media',array('Id'=>$eid,'State'=>'1'));
			return $query->result();
			
		}   
		
		
	}
	
?>