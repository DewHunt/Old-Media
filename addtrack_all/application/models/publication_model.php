<?php

class publication_model extends CI_model{
   
   
    public function __construct()
	{
		parent::__construct();
	   
	}    
        
   function get_all_query_row_countall($search=NULL)
	   {  
			  if($search!='_') {$searchtext=" and publication.Name like '%$search%'";}else {$searchtext="";}
			  $str=" SELECT     pubfrequency.Name AS fname    , publication.*    , pubplace.Name AS ppname
    , pubtype.Name AS ptname    , media.Name AS mname
FROM    
   publication
    LEFT JOIN   pubfrequency    ON (publication.PubFreQuencyId =  pubfrequency.Id)
    LEFT JOIN  pubplace    ON (publication.PubPlaceId = pubplace.Id)
    LEFT JOIN  pubtype       ON (publication.PublicationType = pubtype.Id)
    LEFT JOIN  media 
        ON (publication.MediaId = media.Id) WHERE publication.State='1'  ".$searchtext ;
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

		   	$str=" SELECT pubfrequency.Name AS fname, publication. * , pubplace.Name AS ppname, pubtype.Name AS ptname, media.Name AS mname FROM publication
		   	LEFT JOIN pubfrequency ON (publication.PubFreQuencyId =  pubfrequency.Id)
		   	LEFT JOIN pubplace ON (publication.PubPlaceId = pubplace.Id)
		   	LEFT JOIN pubtype ON (publication.PublicationType = pubtype.Id)
		   	LEFT JOIN media ON (publication.MediaId = media.Id)
		   	WHERE publication.State='1' ORDER BY Id DESC ".$searchtext.$limit;

		   	$query=$this->db->query($str); 
		   	return $query->result(); 
	   }

   function insert_mgt()
       {
	   
	          $image=$this->common_model->fileupload ('Logo','_logo','images','','70','70');
				$data=array(				
						'Name'=>$this->input->post("Name"),
						'MediaId'=>$this->input->post("MediaId"),
						'PublicationType'=>$this->input->post("PublicationType"),
						'PubPlaceId'=>$this->input->post("PubPlaceId"),
						'PubFreQuencyId'=>$this->input->post("PubFreQuencyId"),
						'PublicationLan'=>$this->input->post("PublicationLan"),
						'Description'=>$this->input->post("Description"),
						'Logo'=>$image,
						'EntryBy'=>$this->session->userdata("userId"),
						'EntryDateTime'=>date('Y-m-d H:i:s') , 
				);
				$str=$this->db->insert_string("publication",$data);				
				$query=$this->db->query($str);
				$insert_id=$this->db->insert_id();				
				return  $this->db->affected_rows();
    
	   }
	   
	  function edit_mgt()
       {
				$where=" Id='".$_POST['eid']."' and State='1' ";				
				
				 $image=$this->common_model->fileupload ('Logo','_logo','images','','70','70');
				if($_FILES['Logo']['name']!="") { $image=$this->common_model->fileupload ('Logo','_logo','images','','70','70'); } else {
				 $image=$this->input->post('hidlogo');
				}
				$data=array(

						'Name'=>$this->input->post("Name"),
						'MediaId'=>$this->input->post("MediaId"),
						'PublicationType'=>$this->input->post("PublicationType"),
						'PubPlaceId'=>$this->input->post("PubPlaceId"),
						'PubFreQuencyId'=>$this->input->post("PubFreQuencyId"),
						'PublicationLan'=>$this->input->post("PublicationLan"),
						'Description'=>$this->input->post("Description"),
						'Logo'=>$image,
						'UpdateBy'=>$this->session->userdata("userId"),
						'UpdateTime'=>date('Y-m-d H:i:s') , 
						);
                $str=$this->db->update_string("publication",$data,$where);
				$query=$this->db->query($str);				
				return  $this->db->affected_rows();
    
	   } 
	   
	   
	   
	   
	   
	   
	function deleteInfo($Eid=NULL)
	  {
			$where=" Id=".$Eid." and State='1' ";
$data=array(

     'DeleteBy'=>$this->session->userdata("eid"),
     'DeleteDateTime'=>date('Y-m-d H:i:s') , 
     'State'=>$this->input->post("State"),
);
 $str=$this->db->update_string("publication",$data,$where);
			$query=$this->db->query($str);
			return  $this->db->affected_rows();
		 
	  }   
	function get_all_info_by_id($eid=NULL)
	  {
	    $query=$this->db->get_where('publication',array('Id'=>$eid,'State'=>'1'));
		return $query->result();
	  
	  }   
	   
    
}

?>