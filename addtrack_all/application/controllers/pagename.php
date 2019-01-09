<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class pagename extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
	    $this->load->model('pagename_model','',TRUE);
	   if($this->session->userdata('login')!=TRUE){ redirect('user/index/1');}
	}    
         
    public function index($msg=NULL,$setext=NULL,$limit=NULL)
    {
            $search=isset($_POST['search'])?$this->input->post('search'):$setext; 
		    $search=$search==""?'_':$search;
		    $totalrow=$this->pagename_model->get_all_query_row_countall(addslashes($search));
		    $config['base_url'] = base_url().'index.php/pagename/index/_/'.$search.'/';
			$config['total_rows'] =  $totalrow; 
			$config['per_page'] = 10;
			$config['num_links'] = 4;
			$config['uri_segment'] = 5;
			$config['full_tag_open'] = '<ul>';
			$config['full_tag_close'] = '</ul>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$config['first_tag_open'] = '<li>'; 
			$config['first_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li>'; 
			$config['last_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="active"><a>';			 
			$config['cur_tag_close'] = '</a></li>';
			$config['last_tag_open'] = '<li>';			
			$config['last_tag_close'] = '</li>';
			$config['next_tag_open'] = '<li>';			 
			$config['next_tag_close'] = '</li>';
			$config['prev_tag_open'] = '<li>';			 
			$config['prev_tag_close'] = '</li>';			
			$config['next_link'] = '&raquo;';
			$config['prev_link'] = '&laquo;';			
			$limit=$this->uri->segment(5);
			if($limit=="_"||$limit=="" ){$limit=0;}
			$this->pagination->initialize($config);
			 
			
		   $array=array(
					'msg' => $msg ,
					'title' =>'Add Page and Price',
					'result' =>$this->pagename_model->get_all_query_row($limit,addslashes($search)),
					'sl' =>$limit==0?1:$limit,
					'totalrow' =>  $totalrow,
					'operation' =>'add' ,
					'search'=>$search ,
					 'marray'=>$this->common_model->dropdownvalue('media','Name',0),
					'parray'=>$this->common_model->dropdownvalue('publication','Name',0),	
					'harray'=>$this->common_model->dropdownvalue('hue','Name',0),	
					'ppage'=>$this->common_model->dropdownvalue('page','Name',0),				 
					'dayarray'=>array(
										'AllDays'=>"All Days" ,
										'SaterDay'=>"Saturday" ,
										'Sunday'=>"Sunday" ,
										'Monday'=>"Monday",
										'Tuesday'=>"Tuesday",
										'Wednesday'=>"Wednesday",
										'Thursday'=>"Thursday",
										'Friday'=>"Friday",
										 
					                ),
				 
		    );
		  $this->load->view('pagename_view',$array);
    }
    
	 public function add()
	   {  
			     $inser_id= $this->pagename_model->insert_mgt();
				 if($inser_id==1)
					{
					  redirect('pagename/index/1');
					}
				  else
					 {
					  redirect('pagename/index/2');
					 
					 }	
			 
		
	   }
	 function edit($Eid=NULL,$msg=NULL,$setext=NULL,$limit=NULL)
	 
	    {
	        $search=isset($_POST['search'])?$this->input->post('search'):'_'; 
			$totalrow=$this->pagename_model->get_all_query_row_countall(addslashes($search));
		    $config['base_url'] = base_url().'index.php/pagename/index/_/'.$search.'/';
			$config['total_rows'] =  $totalrow; 
			$config['per_page'] = 10;
			$config['num_links'] = 4;
			$config['uri_segment'] = 5;
			$config['full_tag_open'] = '<ul>';
			$config['full_tag_close'] = '</ul>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$config['first_tag_open'] = '<li>'; 
			$config['first_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li>'; 
			$config['last_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="active"><a>';			 
			$config['cur_tag_close'] = '</a></li>';
			$config['last_tag_open'] = '<li>';			
			$config['last_tag_close'] = '</li>';
			$config['next_tag_open'] = '<li>';			 
			$config['next_tag_close'] = '</li>';
			$config['prev_tag_open'] = '<li>';			 
			$config['prev_tag_close'] = '</li>';			
			$config['next_link'] = '&raquo;';
			$config['prev_link'] = '&laquo;';			
			$limit=$this->uri->segment(5);
            if($limit=="_"||$limit=="" ){$limit=0;}
			$this->pagination->initialize($config);
			
			$querybyid=$this-> pagename_model->get_all_info_by_id($Eid);
			 $Name='';
   $MediaId='';
   $PublicationId='';
   $Day='';
			
			foreach($querybyid as $rfE)
			  {
					$Name=$rfE->Name;
   $MediaId=$rfE->MediaId;
   $PublicationId=$rfE->PublicationId;
   $Day=$rfE->Day;
			   
			   }
		   
		 
		   $array=array(
					'msg' => $msg ,
					'title' =>'Edit Page and Price',
					'result' =>$this->pagename_model->get_all_query_row($limit,addslashes($search)),
					'sl' =>$limit==0?1:$limit,
					'totalrow' =>  $totalrow,					
					'operation' =>'edit' ,
					'Eid' =>$Eid,
					'search'=>$search,					  
					'Name'=>$Name,
					'MediaId'=>$MediaId,
					'PublicationId'=>$PublicationId,
				    'Day'=>$Day,
				    'marray'=>$this->common_model->dropdownvalue('media','Name',0),
					'parray'=>$this->common_model->dropdownvalue('publication','Name',0),	
					'harray'=>$this->common_model->dropdownvalue('hue','Name',0),	
					'ppage'=>$this->common_model->dropdownvalue('page','Name',0),					 
					'dayarray'=>array(
										'AllDays'=>"All Days" ,
										'SaterDay'=>"Sater day" ,
										'Sunday'=>"Sun day" ,
										'Monday'=>"Mon day",
										'Tuesday'=>"Tues day",
										'Wednesday'=>"Wednes day",
										'Thursday'=>"Thurs day",
										'Friday'=>"Fri day",
										 
					                ),
					 
		    );
		  $this->load->view('pagename_view',$array);
	   
	   
	    }
	   function edit_ac()
	     {
		         $inser_id= $this->pagename_model->edit_mgt();
				 if($inser_id==1)
					{
					  redirect('pagename/index/1');
					}
				  else
					 {
					  redirect('pagename/index/2');
					 
					 }	
		 
		 } 
	
	
		
	 function delete($Eid=NULL)
	   {
	      
		 
		 if($Eid=="") { 
		 if(isset($_POST['allvalue']) ){ 
		         for($i=0;$i<$_POST['allvalue'];$i++)
				    {
						   if(isset($_POST['chk_'.$i])) {  $this->pagename_model->deleteInfo($_POST['chk_'.$i]); }
				 	}
		         }
		  
		  }
		  
		  else{
		   
			$this->pagename_model->deleteInfo($Eid); 
		   }
		   
		   redirect('pagename/index/1')	; 
	   
	   }  
 	 
     function addmorerow($i=NULL)
	   {
		$harray=$this->common_model->dropdownvalue('hue','Name',0);	
		$ppage=$this->common_model->dropdownvalue('page','Name',0);	
		 $next=$i+1;
		  $str="<tr id='tr$next'>
		  
         
        <td width='11%'>$next</td>
        <td width='12%'><input name='Name$next' id='Name$next' type='text' value='' size='40' /></td>
         
        <td width='11%'>".form_dropdown("PageNoId$next",$ppage,0," id='PageNoId$next' " )."</td>
        <td width='10%'>".form_dropdown("Hue$next",$harray,0," id='Hue$next'  style=\"width:100px\" ")."</td>
        <td width='8%'><input name='Col$next' id='Col$next' type='text'  style='width:20px' value='1' size='5' /></td>
        <td width='9%'>X</td>
        <td width='18%'><input name='Inch$next'  id='Inch$next' type='text' value='1' style='width:20px' size='5' /></td>
         
        <td width='35%'><input name='Price$next' id='Price$next' type='text' value='' size='10'  style='width:80px' /></td>
		 
        <td width='17%'><input name='Description$next' id='Description$next' type='text' value='' size='25' /></td>
        <td width='18%'></td>
      </tr>";
	    echo $str;
	   
	   }
	   function loadpublication($mid=NULL)
         {
		  $res= $this->pagename_model->loadpub($mid); 
		  $arr=array('0' => "Select");
		  foreach($res as $row)
		    {
			 $arr[$row->Id] =$row->Name;
			}
		  echo form_dropdown('PublicationId', $arr,'0' ,"tabindex='3', id='PublicationId'");
		 
		 }
        	 
	 
	 
	 
	 
	 
}

?>
