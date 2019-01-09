<?php
	class ShowNewsAlertModel extends CI_model
	{
		public function __construct()
		{
			parent::__construct();			
		}
		
		function getDateFormate($Date=NULL, $Date1=NULL)
		{
			$result = array();			
			$result['Dateto'] =$this->common_model->getdateformat($Date);			
			$result['Datefrom'] =$this->common_model->getdateformat($Date1);

            return $result;
		}

        function searchInfo()
        {
            $where = "";            
            $MediaName = $this->getname('media', $this->input->post('MediaId',true));         
            $BrandName = $this->getname('Brand', $this->input->post('BrandName',true));     
            $keywordName =$this->getname('keyword',$this->input->post('Keyword',true));         
            $ProductName = $this->getname('Product', $this->input->post('ProductId',true));           
            $PublicationName = $this->getname('publication', $this->input->post('PublicationId',true));
            $DateToFormate = $this->getdateformat1($this->input->post('Date',true));
            $DateFromFormate = $this->getdateformat1($this->input->post('Date1',true));
            
            if($MediaName!="1")
            {
                $where.=" AND  dataentryreport.MediaId='$MediaName'";
            }
            
            if($BrandName!="1")
            {
                $where.=" AND dataentryreport.BrandName='$BrandName'";
            }       
            
            if($ProductName!="1")
            {
                $where.=" AND dataentryreport.ProductName='$ProductName'";
            }
            
            if($keywordName!="1")
            {
                $where.=" AND dataentryreport.Keyword='$keywordName'";
            }
            
            if($PublicationName!="1")
            {
                $where.=" AND  dataentryreport.PublicationName='$PublicationName' ";
            }
            
            if($DateToFormate!="" && $DateFromFormate!="" )
            {
                $where.=" AND dataentryreport.Date between '$DateToFormate' AND '$DateFromFormate'";
            }

            $str = "SELECT dataentryreport.MediaId, synopsis.Id, synopsis.SummaryId, synopsis.Title, synopsis.Summary FROM dataentryreport INNER JOIN synopsis ON dataentryreport.Id = synopsis.DataEntryReportId ".$where;
            
            // $str = "SELECT * FROM dataentryreport WHERE State ='1'".$where;         
            $query = $this->db->query($str);

            return $query->result();
        }

        function saveInfo()
        {
	    	$CheckBox = $this->input->post('chk');
	    	$TitleInfo = $this->input->post('title',true);
	    	$TextAreaInfo = $this->input->post('synopsis',true);
	    	$arrayLength = count($CheckBox);
	    	$summaryId = mt_rand();

			$EntryBy = $this->session->userdata("eid");
			$EntryDateTime = date('Y-m-d H:i:s');

	    	foreach ($CheckBox as $value)
	    	{
	    		$data['DataEntryReportId'] = $value;
	    		$data['SummaryId'] = $summaryId;
	    		$data['Title'] = $TitleInfo;
	    		$data['Summary'] = $TextAreaInfo;
	    		$data['EntryBy'] = $EntryBy;
	    		$data['EntryDateTime'] = $EntryDateTime;

				$str = $this->db->insert_string("synopsis",$data);
				$query = $this->db->query($str);
	    	}

			return $this->db->affected_rows();
        }

        function updateInfo()
        {
        	$Id = $this->input->post('id',true);
        	$SummaryId = $this->input->post('summary_id',true);

			$where = "SummaryId = '".$SummaryId."'";

	    	$data['Title'] = $this->input->post('title',true);
	    	$data['Summary'] = $this->input->post('synopsis',true);
			$data['EntryBy'] = $this->input->post("EntryBy");
			$data['UpdateBy'] = $this->session->userdata("eid");
			$data['UpdateTime'] = date('Y-m-d H:i:s');

			$str=$this->db->update_string("synopsis",$data,$where);
			$query=$this->db->query($str);

			return  $this->db->affected_rows();
        }    
        
		function rowCounter($search=NULL)
		{  
			if($search!='_')
			{
				$searchtext=" and Name like '%$search%'";
			}
			else
			{
				$searchtext="";
			}

			$str = "SELECT * FROM synopsis WHERE State = '1' ".$searchtext ;
			$query=$this->db->query($str); 
			return $query->num_rows(); 
		}

        function getAllInfo($p=NULL,$search=NULL)
        {  
			$limit="limit $p,10";

			if($search!='_')
			{
				$searchtext=" and  Title like '%".$search."%'";
			}
			else
			{
				$searchtext="";
			}

			$str = "SELECT dataentryreport.Date, dataentryreport.MediaId, dataentryreport.Caption, synopsis.Id, synopsis.SummaryId, synopsis.Title, synopsis.Summary FROM dataentryreport INNER JOIN synopsis ON dataentryreport.Id = synopsis.DataEntryReportId ORDER BY synopsis.ID DESC";

			// $str = "SELECT * FROM synopsis WHERE State = '1' ORDER BY Id DESC ".$searchtext.$limit;

			$query=$this->db->query($str);

			// print_r($query->result());
			// exit();

			return $query->result();        	
        }

        function getAllInfoById($SummaryId, $Id)
        {
			$str = "SELECT * FROM synopsis WHERE SummaryId = '$SummaryId' AND Id = '$Id'";
			$query=$this->db->query($str);
			$result = $query->row();

			return $result;       	
        }		
		
		function deleteInfo($Eid=NULL)
		{
			$where="DELETE FROM synopsis WHERE  Id='$Eid' AND State='1' ";
			$str=$this->db->query($where);

			return $this->db->affected_rows();			
		}
		
		function getdateformat1($date = NULL)
		{
			if (!empty($date))
			{
				$var = "";
				$var = explode('/', $date);
				$returndate = $var[2] . "-" . $var[1] . "-" . $var[0];
				return $returndate;
			}
			
		}
		
		function dateformat1($date = NULL)
		{
			if (!empty($date))
			{
				$var = "";
				$var = explode('-', $date);
				$returndate = $var[2] . "/" . $var[1] . "/" . $var[0];
				return $returndate;
			}
			
		}		
		
		function get_all_info_by_id($eid = NULL)
		{
			$query = $this->db->get_where('dataentry', array('Id' => $eid, 'State' => '1'));
			return $query->result();			
		}		
		
		function getAllSubBrand($brand = NULL)
		{
			$str = "SELECT * FROM subbrand WHERE State='1' and BrandId='$brand' ";
			$query = $this->db->query($str);

			// print_r($query->result());
			// exit();
			return $query->result();			
		}
		
		function getname($table = NULL, $id = NULL)
		{
			$bat = 1;
			$str = "select Name   from  $table where Id='$id' ";			
			$query = $this->db->query($str);
			
			foreach ($query->result() as $row)
			{
				$bat = $row->Name;
			}
			return $bat;
		}		
		
		public function downloadall($Image = NULL)
		{
			$zip = new ZipArchive();
			$result = $zip->open("imagecopymerge.zip", ZIPARCHIVE::CREATE);
			
			if ($result)
			{
				$d = dir("imagecopymerge/");
				
				while (false !== ($entry = $d->read()))
				{
					if (preg_match("/\w*\.jpg/", $entry)) {
						
						$zip->addFile("imagecopymerge/" . $entry, $entry);
					}
				}
				$d->close();
				$zip->close();
			}
			else
			{
				echo "Failed: $result.\n";
			}
		}
	}
?>
