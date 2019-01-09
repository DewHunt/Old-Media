<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 header('Content-Type: text/html; charset=utf-8'); 

	
function print_list($data=NULL,$icon=NULL)
		{
			if($data==NULL) return; 
			$str = "";
			$str .='<ul>';
			foreach($data as $list)
			{
				if($icon=='icon'){
				$str .= "<li><a href='".site_url().$list['link']."'>"."<i class='glyphicon ".$list['icon']."'></i> ".$list['nama']."</a>";
				}else{
				$str .= "<li><a href='".site_url().$list['link']."'>".$list['nama']."</a>";
				 }
				$subchild = print_list($list['child']);
				if($subchild != '')
					$str .= "<ul>".$subchild."</ul>";
				$str .= "</li>";
			}
			$str .= '</ul>';
			return $str;
		}
		



function getipadd(){
/*	exec("ipconfig /all", $output);
	return $output;*/
}			
function getMacc(){
/*	exec("ipconfig /all", $output);
	return $output;*/
}

function getMac_number(){
/*	exec("ipconfig /all", $output);
	foreach($output as $line){
		if (preg_match("/(.*)Physical Address(.*)/", $line)){
		$mac = $line;
		$mac = str_replace("Physical Address. . . . . . . . . :","",$mac);
		}
	}
	return $mac;*/
}	

function replace($data =NULL){
	$ci=& get_instance();
	$name = trim(preg_replace("/[^A-Za-z0-9]/i", "", $ci->input->post($data)));
	return $name;
}
function replaceg($data =NULL){
	$ci=& get_instance();
	$name = trim(preg_replace("/[^A-Za-z0-9]/i", "", $_GET[$data]));
	return $name;
}
function replaces($data =NULL){
	$ci=& get_instance();
	$news_title = urldecode($data);
	$name = trim(preg_replace("![^a-z0-9]+!i", "", $news_title));
	return $name;
}
	

function getreadmore($data=NULL,$sl=NULL){
	$pattern = '<hr id="system-readmore" />';
	$piecesh = explode($pattern, $data); echo $piecesh[0];
	if (isset($piecesh[1])) {
		echo '<p><a href="'.base_url().'content/action/7/'.$sl.'">Read More</a></p>';
	} 
}

function mail_to($email=NULL,$title =NULL,$message=NULL){
	$ci=& get_instance();
	$ci->load->library('email');
	$config['charset'] = 'utf-8';
	$config['newline']    = "\r\n";
	$config['wordwrap'] = TRUE;
	$config['mailtype'] = 'html';
	
	$ci->email->initialize($config);
	
	$ci->email->from('mamunmo21@gmail.com', 'shoping');
	$ci->email->to($email);
	$ci->email->subject($title);
	$ci->email->set_mailtype("html");
	$ci->email->message($message);
	$ci->email->send();
	
	//echo $ci->email->print_debugger();
 }
	
	

function view($table=NULL,$sl=NULL)
	{
		$ci=& get_instance();
		$ci->load->database(); 
		$sls = trim(preg_replace("/[^0-9]/i", "", $sl));
		$ci->db->where('sl', $sls); 
		$query=$ci->db->get($table);
    	$result = $query->result();
		return $result;	
	}
function viewcat($table=NULL,$field=NULL,$sl=NULL)
	{
		$ci=& get_instance();
		$ci->load->database(); 
		$sls = trim(preg_replace("/[^0-9]/i", "", $sl));
		$ci->db->where($field, $sls); 
		$query=$ci->db->get($table);
    	$result = $query->result();
		return $result;	
	}
	
function viewleft($table=NULL,$cat=NULL,$sl=NULL,$title=NULL)
	{
		$ci=& get_instance();
		$ci->load->database(); 
		if($sl == '')return;
		$ci->db->where($cat, $sl); 
		$query=$ci->db->get($table);
    	$result = $query->result();
		foreach($result as $row){
			echo $titels = $row->$title;
		}	
	}

 function delete($table=NULL,$sl)
	{
		$ci=& get_instance();
		$ci->load->database(); 
		$sls = trim(preg_replace("/[^0-9]/i", "", $sl));
		$ci->db->delete($table, array('sl' => $sls));
	} 
	
 function alldelete($table=NULL,$input=NULL) 
		{
		$ci=& get_instance();
		$ci->load->database();
		$sl = $ci->input->post('sl');
		$row = array(); 
			$ro_count = count($sl);
			for ($i=0; $i < $ro_count; $i++) { 
			$ci->db->delete($table,array('sl' => $sl[$i]));
			}
		}
	
 function status($table=NULL,$sl=NULL)
	{  
		$ci=& get_instance();
		$ci->load->database(); 
		$sls = trim(preg_replace("/[^0-9]/i", "", $sl));
		$sql = "SELECT * FROM $table WHERE sl=$sls";
		$query = $ci->db->query($sql);
    	$result = $query->result();
		foreach ($result as $row) { $status=$row->status; }
		if ($status==1){
			$data = array('status' => '0');
			$ci->db->update($table,$data, array('sl' => $sl));
		}
		 else {
			$data = array('status' => '1');
			$ci->db->update($table,$data, array('sl' => $sl));
		
		}
	} 
	
  function statuscount($table=NULL,$field=NULL,$sl=NULL)
	{  
		$ci=& get_instance();
		$ci->load->database(); 
		$sls = trim(preg_replace("/[^0-9]/i", "", $sl));
		$sql = "SELECT * FROM $table WHERE sl=$sls";
		$query = $ci->db->query($sql);
    	$result = $query->result(); $sta =0;
		foreach ($result as $row) { $sta=$row->$field+1;}
		 $sql2 = "UPDATE $table SET $field='$sta' WHERE sl = '$sl'";
		$query2 = $ci->db->query($sql2);
		
	} 
	
 function statuscountarray($table=NULL,$field=NULL,$sl=NULL)
	{  
		$ci=& get_instance();
		$ci->load->database(); 
		$id = $ci->input->post('id');
		$rows = array(); 
		$row_count = count($id);
			for ($i=0; $i < $row_count; $i++) { 
				$rows= $id[$i];
				$sql = "SELECT * FROM $table WHERE sl=$rows";
				$query = $ci->db->query($sql);
				$result = $query->result(); $sta =0;
				foreach ($result as $row) { $sta=$row->$field+1;}
				$sql2 = "UPDATE $table SET $field='$sta' WHERE sl = '$rows'";
				$query2 = $ci->db->query($sql2);
						
			} 
	} 
	
 function statuscountbetw($table=NULL,$status=NULL,$datefrom=NULL,$dateto=NULL)
	{  
		$ci=& get_instance();
		$ci->load->database();
		$sql = "SELECT  * FROM $table WHERE status = $status and createdate BETWEEN '$datefrom'  AND  '$dateto'";
		$query = $ci->db->query($sql);
    	return $query->result();
		
	} 
	
	
  function get_table($table=NULL)
		{
			$ci=& get_instance();
			$ci->load->database();
			$ci->db->order_by('sl','desc');
			//$ci->db->where('status',1); 
			$query=$ci->db->get($table);
			return $query->result();
		} 
		
function viewdata($table=NULL,$cat=NULL,$sl=NULL,$title=NULL)
	{
		$ci=& get_instance();
		$ci->load->database(); 
		$sql = "SELECT * from $table WHERE  $cat=$sl";	
		$query = $ci->db->query($sql);
    	$result = $query->result();
		foreach($result as $row){
			return $titels = $row->$title;
		}	
	}   
        

function fromlevel($label=NULL){
	echo '<label for="'.$label.'">'.$label.'</label>';
}
	
function fromdata($type=NULL,$name=NULL,$value=NULL,$class=NULL,$id=NULL,$extra=NULL){
	echo '<input '.$type.' '.$name.' '.$value.' '.$class.' '.$id.' '.$extra .'/>';
}

function from_get($label=NULL,$match=NULL){
	
	$pieces = explode("#".$match.":", $label);
	  foreach($pieces as $ttt) {
	  	
	  }
}


function getformat($date=NULL)
	{
	    if(!empty($date)){
	    $var="";
	    $var=explode('/',$date);
		$returndate=$var[2];
		return $returndate;}
		
	 } 



function get_all_country(){  	
	$ci=& get_instance();
	$ci->load->database(); 
	$str = "SELECT * from common_tbl WHERE status  = 1";
	$allvalue= 0;
	$query = $ci->db->query($str);
	 if($allvalue==""){$val=array('0'=>'Select');}
	 else { $val=array('0'=>'All'); }
	 foreach($query->result() as $row)
	   { $val[$row->country_name]=$row->country_name;}
	   return $val;
}

function getsysusercat($permission=NULL) {
	$ci=& get_instance();
	$ci->load->database(); 
	$sql = "SELECT * FROM set_right WHERE  status = 1"; 
    $query = $ci->db->query($sql);
    $result = $query->result(); //5555
	return $result;	
	
}

function user_right($parent=NULL) {
	$ci=& get_instance();
	$ci->load->database(); 
	$sql = "SELECT * FROM user_right WHERE parent=$parent and  status = 1 order by order_by ASC"; 
    $query = $ci->db->query($sql);
    $result = $query->result();
	return $result;	
	
}

function getsysusercatspi($sl=NULL,$permission=NULL) {
	$ci=& get_instance();
	$ci->load->database(); 
	$sql = "SELECT * FROM user WHERE sl=$sl and status = 1"; 
    $query = $ci->db->query($sql);
    $result = $query->result();
	$pieces = "";
	foreach($result as $row){
		 $per = $row->$permission;//555
		 $pieces = explode("#,", $per);
	}
	return $pieces;	
}



function getsysusercatrit($parent = NULL){

	$ci=& get_instance();
	$ci->load->database(); 
	$sql = "SELECT * FROM user_right WHERE parent = $parent and status = 1"; 
    $query = $ci->db->query($sql);
    $result = $query->result(); //555
	return $result;	
}




 function get_max_number($table=NULL,$field=NULL)
 	{	
		$ci=& get_instance();
		$ci->load->database();
		$sql = "SELECT   MAX($field) FROM $table";
		$query = $ci->db->query($sql);
    	$result = $query->result_array();
		foreach($result as $row){
		$fields = $row['MAX('.$field.')'];
		$c = 1 + $fields;
		return $c;
		}
	}

 function get_max_count($table=NULL,$field=NULL,$value=NULL,$sta=NULL)
 	{	
		$ci=& get_instance();
		$ci->load->database();
		if($sta==1){
		return $ci->db->where($field,$value)->count_all_results($table);
		}else{
		return $ci->db->count_all($table);
		}
	}
	
	
 function getnumbercount($str=NULL)
	  {
	     if(strlen($str)==1){ return  $str='00000000';}
		 if(strlen($str)==2){ return  $str='0000000';}
		 if(strlen($str)==3){ return  $str='000000';}
	     if(strlen($str)==4){ return  $str='00000';}
	     if(strlen($str)==5){ return  $str='0000';}
		 if(strlen($str)==6){ return  $str='000';}
	     if(strlen($str)==7){ return  $str='00';}
	     if(strlen($str)==8){ return  $str='0';}
	  }
	
	
function dropdownlistall($table=NULL,$field=NULL,$sl=NULL,$allvalue=NULL,$sta=NULL,$select=NULL,$extra=NULL)
	  {
	  	$ci=& get_instance();
		$ci->load->database();
	    $str="select $sl, $field from $table WHERE  $allvalue = $sta  ORDER BY $sl DESC";
		 $query=$ci->db->query($str);
		 if($select==""){$val=array('0'=>'Select '.$extra);}
		 else { $val=array('0'=>'Choose '.$extra); }
		 foreach($query->result() as $row)
		   {
		   $val[$row->$sl]=$row->$field;
		   
		   }
		   return $val;
	 }
		

	
	/* -------------------------     Characer and images        ------------*/	
	function firstXChars($string, $chars = NULL)
		{
				if(strlen($string)<=$chars) return $string;
	
				$text = $string." "; 
				$text = substr($text,0,$chars); 
				$text = substr($text,0,strrpos($text,' ')); 
				$text = $text."..."; 
				return $text; 
			
		}
		
	 function getImage($text, $matches="") {	
			preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $text, $matches);
			 if(isset($matches[1])!=''){
				  $matches[1];
				}else  { 
				 $matches[1]= base_url().'asset/no-image.jpg';
				}
			return $matches[1];	
		}
		
	function viewread($table=NULL,$field=NULL,$sl=NULL,$limit=NULL,$ofset=NULL)
	{
		$ci=& get_instance();
		$ci->load->database(); 
		$sls = trim(preg_replace("/[^0-9]/i", "", $sl));
		$ci->db->where($field, $sls); 
		$query=$ci->db->get($table,$limit,$ofset);
    	$result = $query->result();
		return $result;	
	}
	
	
	function do_uploads_img($folder=NULL,$input=NULL,$fields=NULL,$width=NULL,$height=NULL,$true=NULL) {
			$ci=& get_instance();
			$path = 'imgs';
			$gallery = 'imgs';
		
		
			if($_FILES[$fields]['name']!=''){
		
				$config = array('allowed_types' => 'jpg|jpeg|gif|png|pdf','upload_path' => $path,'max_size' => 2000);     
				$ci->load->library('upload');
				$ci->upload->initialize($config); 
				
				$ci->upload->do_upload($fields);
				$image_data = $ci->upload->data();
				$config = array('source_image' => $image_data['full_path'],'new_image' => $gallery . '/'.$folder,'maintain_ration' => FALSE,'width' => $width,'height' => $height); 
				$ci->load->library('image_lib', $config);

				$ci->image_lib->initialize($config);
				$ci->image_lib->resize();
				$ci->image_lib->clear();
				if($true==1) { unlink($path.'/'.$image_data['file_name']); }
				
				$config = array('source_image' => $image_data['full_path'],'new_image' => $gallery . '/thumblise','maintain_ration' => FALSE,'width' => 80,'height' => 40); 
				$ci->load->library('image_lib', $config);
				$ci->image_lib->initialize($config);
				$ci->image_lib->resize();
				$ci->image_lib->clear();

				return $image_data['file_name']; 
			}
		}
		
			
		
	function uesr_field($field,$seion){
		 $set_right = user_right($field);
			  foreach($set_right as $rows){
				$set2 = getsysusercatspi($seion,'say_cat'); 
					foreach($set2 as $val2){ if($val2 == $rows['sl']){ 
					if($rows['set_status']==2){?>
					<a class="cr_invoice" href="<?=site_url($rows['link']) ?>"><span><?=$rows['nama']?></span></a>	
					<?php	} 
					} 
				}
			} 
		}	
		