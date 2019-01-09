<?php
	
	class dataentry_model extends CI_model
	{
		
		
		public function __construct()
		{
			parent::__construct();
			
		}
		
		function get_all_query_row_countall($search = NULL)
		{
			if($search!='_')
			{
				$searchtext=" and MediaId like '%$search%'";
			}
			else
			{
				$searchtext="";
			}

			$str = "SELECT * FROM dataentry WHERE State='1' ".$searchtext;
			$query = $this->db->query($str);
			return $query->num_rows();
		}
		
		
		function get_all_query_row($p = NULL, $search = NULL)
		{
			$limit = "limit $p,10";
			if($search!='_')
			{
				$searchtext=" AND MediaId like '%".$search."%'";
			}
			else
			{
				$searchtext="";
			}
			
			// $str = "SELECT * FROM dataentry WHERE State='1' ".$searchtext.$limit;

			$str = "SELECT dataentry.*, media.Name AS MediaName, dataentrydetails.Caption AS Caption FROM dataentry
			LEFT JOIN media ON (dataentry.MediaId = media.Id)
			LEFT JOIN dataentrydetails ON (dataentry.Id = dataentrydetails.DataentryId)			
			WHERE dataentry.State = '1' ".$searchtext.$limit;
			$query = $this->db->query($str);
			return $query->result();
		}
		
		
		function insert_mgt()
		{
			// Start Save Information to "dataentry" Table Section
			$MediaId = $this->getname('media', $this->input->post("MediaId"));
			
			$data = array(
            'BatchId' => $this->input->post("Batch"),
            'MediaId' => $this->input->post("MediaId"),
            'PublicationId' => $this->input->post("PublicationId"),
            'Date' => $this->common_model->getdateformat($this->input->post("Date")),
            'EntryBy' => $this->session->userdata("eid"),
            'EntryDateTime' => date('Y-m-d H:i:s'),
			);
			
			$medialogo = $this->common_model->getImage($this->input->post("MediaId"));
			$datetime = $this->input->post("Date");
			
			$str = $this->db->insert_string("dataentry", $data);
			$query = $this->db->query($str);
			$insert_id = $this->db->insert_id();
			
			$str = "SELECT pubfrequency.Name AS freq, publication.PublicationLan AS lan, pubtype.Name AS ptype, pubplace.Name AS pplace FROM publication
			LEFT JOIN pubfrequency ON (publication.PubFreQuencyId = pubfrequency.Id)
			LEFT JOIN pubplace ON (publication.PubPlaceId = pubplace.Id)
			LEFT JOIN pubtype ON (publication.PublicationType = pubtype.Id)
			WHERE publication.State ='1' AND publication.Id='".$this->input->post("PublicationId")."'";
			
			$freq = "";
			$lan = "";
			$ptype = "";
			$pplace = "";
			
			$query = $this->db->query($str);
			foreach ($query->result() as $row1)
			{				
				$freq = $row1->freq;
				$lan = $row1->lan;
				$ptype = $row1->ptype;
				$pplace = $row1->pplace;
			}
			
			// End Save Information to "dataentry" Table Section 
			
			for ($i = 1; $i <= $_POST['rowcount']; $i++)
			{
				$keyWordValue = '';
				foreach ($_POST["keyWord"] as $value)
				{
					$keyWordValue .= $value. ', ';
				}

				// echo $keyWordValue;
				// exit();

				$Cols = $this->input->post("Cols" . $i);
				$Inchs = $this->input->post("Inchs" . $i);
				$PageId = $this->getname('page', $this->input->post("PageId" . $i));
				
				$PageNo = $this->input->post("PageNo" . $i);
				$PositionName = $this->input->post("PositionName" . $i);
				
				$image = "";
				$image = $this->common_model->fileupload($medialogo, $datetime, $Cols, $Inchs, $PageId, $PageNo, $PositionName,$MediaId, 'Image' . $i, 'data', 'images', 0, 0, 0);
				
				$data = array(
                'DataentryId' => $insert_id,
                'ProductId' => $this->input->post("ProductId" . $i),
                'ProductCatId' => $this->input->post("ProductCatId" . $i),
                'CompanyId' => $this->input->post("BrandId" . $i),
				
                'Caption' => $this->input->post("Caption" . $i),
                'AdType' => $this->input->post("AdType" . $i),
				
                "subBrandId" => $this->input->post("subBrandId" . $i),
                'Image' => $image,
                'HueId' => $this->input->post("Hue" . $i),
                'PositionName' => $this->input->post("PositionName" . $i),
                'Cols' => $this->input->post("Cols" . $i),
                'Inchs' => $this->input->post("Inchs" . $i),
                'PageNo' => $this->input->post("PageNo" . $i),
                'NewstypeId' => $this->input->post("NewstypeId" . $i),				
				
                // 'Keyword' => $this->input->post("Keyword" . $i),
                'Keyword' => $keyWordValue,
				'outlook' => $this->input->post("outlook" . $i),				
				
                'Remarks' => $this->input->post("Remarks" . $i),
                'EntryBy' => $this->session->userdata("eid"),
                'EntryDateTime' => date('Y-m-d H:i:s'),
                'PageId' => $this->input->post("PageId" . $i),				
				
				);
				
				// print_r($data);
				// exit();

				$str = $this->db->insert_string("dataentrydetails", $data);
				$query = $this->db->query($str);
				
				$price = 0;
				
				$str = " select Price from  price left join pricedetails on(price.Id= pricedetails.PriceId)
				where MediaId='" . $this->input->post("MediaId") . "' and PublicationId='" . $this->input->post("PublicationId") . "' and Col='1' and Inch='1' and  Hue='" . $this->input->post("Hue" . $i) . "' and PageNoId='" . $this->input->post("PageId" . $i) . "' and  pricedetails.State='1'";
				
				
				//reza
				
				
				// $str = " select Price from  price left join pricedetails on(price.Id= pricedetails.PriceId)
				//where MediaId='" . $this->input->post("MediaId") . "' and PublicationId='" . $this->input->post("PublicationId") . "' and Col='" . $this->input->post("Cols" . $i) . "' and Inch='" . $this->input->post("Inchs" . $i) . "' and  pricedetails.State='1'";
				
				
				$query = $this->db->query($str);
				foreach ($query->result() as $row) {
					$price = $row->Price;
				}
				
				$pp = 0;
				$str = "SELECT  *  FROM subbrand INNER JOIN brand ON subbrand.BrandId=brand.Id  WHERE subbrand.Id  = '" . $this->input->post("subBrandId" . $i) . "' ";
				
				$query = $this->db->query($str);
				
				
				foreach ($query->result() as $row) {
					$pp = $row->Name;
				}
				
				$pc = 0;
				$str = "SELECT  *  FROM product_cat INNER JOIN product ON product_cat.ProductId=product.Id  WHERE product_cat.Id  = '" . $this->input->post("ProductId" . $i) . "' ";
				
				$query = $this->db->query($str);
				
				
				foreach ($query->result() as $row) {
					$pc = $row->Name;
				}
				
				$ct = 0;
				$str = "SELECT  *  FROM subbrand INNER JOIN company ON subbrand.CompanyId=company.Id  WHERE subbrand.Id  = '" . $this->input->post("subBrandId" . $i) . "' ";
				
				$query = $this->db->query($str);
				//
				//        echo'<pre>';
				//            print_r($query);
				//            die();
				
				foreach ($query->result() as $row) {
					$ct = $row->Name;
				}
				
				
				$dataa = array(
                "DataEntryId" => $insert_id,
                "BatchId" => $this->input->post("Batch"),
                "MediaId" => $this->getname('media', $this->input->post("MediaId")),
                "PublicationName" => $this->getname('publication', $this->input->post("PublicationId")),
                "Date" => $this->common_model->getdateformat($this->input->post("Date")),
                "ProductName" => $pc,
				//                "ProductCatName" => $this->getname('product_cat', $this->input->post("ProductCatId" . $i)),
				
                "ProductCatName" => $this->getname('product_cat', $this->input->post("ProductId" . $i)),
				
                "subBrand" => $this->getname('subbrand', $this->input->post("subBrandId" . $i)),
                "Company" => $ct,
                "BrandName" => $pp,
				
                "Caption" => $this->input->post("Caption" . $i),
                "AdType" => $this->getname('newstype', $this->input->post("AdType" . $i)),
                "HueName" => $this->getname('hue', $this->input->post("Hue" . $i)),
                "PositionName" => $this->input->post("PositionName" . $i),
                "PageId" => $this->getname('page', $this->input->post("PageId" . $i)),
                "Cols" => $this->input->post("Cols" . $i),
                "Inchs" => $this->input->post("Inchs" . $i),
                "Price" => $price,
                "PageNo" => $this->input->post("PageNo" . $i),
                "NewstypeName" => $this->getname('newstype', $this->input->post("NewstypeId" . $i)),
                "Image" => $image,
				
				// "Keyword" => $this->getname('keyword', $this->input->post("Keyword" . $i)),
				"Keyword" => $keyWordValue,
				"outlook" => $this->getname('outlook', $this->input->post("outlook" . $i)),				 
				
                "Remarks" => $this->input->post("Remarks" . $i),
                "PublicationType" => $ptype,
                "PublicationPlace" => $pplace,
                "PublicationFreq" => $freq,
                "PublicationLan" => $lan,
                "EntryBy" => $this->session->userdata("eid"),
                "EntrydateTime" => date('Y-m-d H:i:s'),
				);
				
				$str = $this->db->insert_string("dataentryreport", $dataa);
				$query = $this->db->query($str);				
				
			}
			
			
			return $this->db->affected_rows();
		}
		
		
		function edit_mgt($Eid = NULL)
		{
			
			
			$where = "delete from dataentry where  Id=" . $Eid . " and State='1' ";
			$query = $this->db->query($where);
			
			
			$data = array(
            'BatchId' => $this->input->post("Batch"),
            'MediaId' => $this->input->post("MediaId"),
            'PublicationId' => $this->input->post("PublicationId"),
            'Date' => $this->common_model->getdateformat($this->input->post("Date")),
            'EntryBy' => $this->session->userdata("eid"),
            'EntryDateTime' => date('Y-m-d H:i:s'),
			);
			
			
			$str = $this->db->insert_string("dataentry", $data);
			$query = $this->db->query($str);
			
			$insert_id = $this->db->insert_id();
			
			
			$str = "SELECT     pubfrequency.Name AS freq  , publication.PublicationLan AS lan   , pubtype.Name AS ptype
			, pubplace.Name AS pplace
			FROM
			publication   LEFT JOIN pubfrequency   ON (publication.PubFreQuencyId = pubfrequency.Id)
			LEFT JOIN  pubplace      ON (publication.PubPlaceId = pubplace.Id)
			LEFT JOIN  pubtype     ON (publication.PublicationType = pubtype.Id)
			WHERE publication.State  ='1'  AND publication.Id='" . $this->input->post("PublicationId") . "'";
			
			
			$freq = "";
			$lan = "";
			$ptype = "";
			$pplace = "";
			
			
			$query = $this->db->query($str);
			foreach ($query->result() as $row1) {
				$freq = $row1->freq;
				$lan = $row1->lan;
				$ptype = $row1->ptype;
				$pplace = $row1->pplace;
			}
			
			
			$str = "SELECT     pubfrequency.Name AS freq  , publication.PublicationLan AS lan   , pubtype.Name AS ptype
			, pubplace.Name AS pplace
			FROM
			publication   LEFT JOIN pubfrequency   ON (publication.PubFreQuencyId = pubfrequency.Id)
			LEFT JOIN  pubplace      ON (publication.PubPlaceId = pubplace.Id)
			LEFT JOIN  pubtype     ON (publication.PublicationType = pubtype.Id)
			WHERE publication.State  ='1'  AND publication.Id='" . $this->input->post("PublicationId") . "'";
			
			
			$freq = "";
			$lan = "";
			$ptype = "";
			$pplace = "";
			
			
			$query = $this->db->query($str);
			foreach ($query->result() as $row1) {
				
				$freq = $row1->freq;
				$lan = $row1->lan;
				$ptype = $row1->ptype;
				$pplace = $row1->pplace;
			}
			
			
			$where = "delete from dataentrydetails where  DataentryId=" . $Eid . " and State='1' ";
			$query = $this->db->query($where);
			
			
			$where = "delete from dataentryreport where  DataentryId=" . $Eid . " and State='1' ";
			$query = $this->db->query($where);
			
			
			for ($i = 1; $i <= $_POST['rowcount']; $i++) {
				
				
				$Cols = $this->input->post("Cols" . $i);
				$Inchs = $this->input->post("Inchs" . $i);
				$PageId = $this->getname('page', $this->input->post("PageId" . $i));
				
				$PageNo = $this->input->post("PageNo" . $i);
				$PositionName = $this->input->post("PositionName" . $i);
				
				
				$image = "";
				$image = $this->common_model->fileupload($medialogo, $datetime, $Cols, $Inchs, $PageId, $PageNo, $PositionName, 'Image' . $i, 'data', 'images', 0, 0, 0);
				
				$data = array(
                'DataentryId' => $insert_id,
                'ProductId' => $this->input->post("ProductId" . $i),
                'ProductCatId' => $this->input->post("ProductCatId" . $i),
                'CompanyId' => $this->input->post("BrandId" . $i),
				
                "subBrandId" => $this->input->post("subBrandId" . $i),
				
                'Caption' => $this->input->post("Caption" . $i),
                'AdType' => $this->input->post("AdType" . $i),
                'Image' => $image,
                'HueId' => $this->input->post("Hue" . $i),
                'PositionName' => $this->input->post("PositionName" . $i),
                'Cols' => $this->input->post("Cols" . $i),
                'Inchs' => $this->input->post("Inchs" . $i),
                'PageNo' => $this->input->post("PageNo" . $i),
                'NewstypeId' => $this->input->post("NewstypeId" . $i),
				
                'Keyword' => $this->input->post("Keyword" . $i),
				'outlook' => $this->input->post("outlook" . $i),
				
				
				
				
				
                'Remarks' => $this->input->post("Remarks" . $i),
                'EntryBy' => $this->session->userdata("eid"),
                'EntryDateTime' => date('Y-m-d H:i:s'),
                'PageId' => $this->input->post("PageId" . $i),
				);
				
				
				$str = $this->db->insert_string("dataentrydetails", $data);
				$query = $this->db->query($str);
				
				
				$price = 0;
				
				
				$str = " select Price from  price left join pricedetails on(price.Id= pricedetails.PriceId)
				where MediaId='" . $this->input->post("MediaId") . "' and PublicationId='" . $this->input->post("PublicationId") . "' and Col='1' and Inch='1' and  Hue='" . $this->input->post("Hue" . $i) . "' and PageNoId='" . $this->input->post("PageId" . $i) . "' and  pricedetails.State='1'";
				
				
				$query = $this->db->query($str);
				foreach ($query->result() as $row) {
					$price = $row->Price;
				}
				
				
				$pp = 0;
				$str = "SELECT  *  FROM subbrand INNER JOIN brand ON subbrand.BrandId=brand.Id  WHERE subbrand.Id  = '" . $this->input->post("subBrandId" . $i) . "' ";
				
				$query = $this->db->query($str);
				
				
				foreach ($query->result() as $row) {
					$pp = $row->Name;
				}
				
				$pc = 0;
				$str = "SELECT  *  FROM product_cat INNER JOIN product ON product_cat.ProductId=product.Id  WHERE product_cat.Id  = '" . $this->input->post("ProductId" . $i) . "' ";
				
				
				$query = $this->db->query($str);
				
				
				foreach ($query->result() as $row) {
					$pc = $row->Name;
				}
				
				
				$ct = 0;
				$str = "SELECT  *  FROM subbrand INNER JOIN company ON subbrand.CompanyId=company.Id  WHERE subbrand.Id  = '" . $this->input->post("subBrandId" . $i) . "' ";
				
				$query = $this->db->query($str);
				//
				//        echo'<pre>';
				//            print_r($query);
				//            die();
				
				foreach ($query->result() as $row) {
					$ct = $row->Name;
				}
				
				
				$dataa = array(
				
                "DataEntryId" => $insert_id,
                "BatchId" => $this->input->post("Batch"),
                "MediaId" => $this->getname('media', $this->input->post("MediaId")),
                "PublicationName" => $this->getname('publication', $this->input->post("PublicationId")),
                "Date" => $this->common_model->getdateformat($this->input->post("Date")),
                "ProductName" => $pc,
				//                "ProductCatName" => $this->getname('product_cat', $this->input->post("ProductCatId" . $i)),
				
                "ProductCatName" => $this->getname('product_cat', $this->input->post("ProductId" . $i)),
				
				
                "subBrand" => $this->getname('subbrand', $this->input->post("subBrandId" . $i)),
                "Company" => $ct,
                "BrandName" => $pp,
				
                "Caption" => $this->input->post("Caption" . $i),
                "AdType" => $this->getname('newstype', $this->input->post("AdType" . $i)),
				
                "HueName" => $this->getname('hue', $this->input->post("Hue" . $i)),
				
                "PositionName" => $this->input->post("PositionName" . $i),
                "PageId" => $this->getname('page', $this->input->post("PageId" . $i)),
                "Cols" => $this->input->post("Cols" . $i),
                "Inchs" => $this->input->post("Inchs" . $i),
                "Price" => $price,
                "PageNo" => $this->input->post("PageNo" . $i),
                "NewstypeName" => $this->getname('newstype', $this->input->post("NewstypeId" . $i)),
                "Image" => $image,
				
				
                "Keyword" => $this->getname('keyword', $this->input->post("Keyword" . $i)),
				"outlook" => $this->getname('outlook', $this->input->post("outlook" . $i)),
				
				
				
				
				
				
				
				
                "Remarks" => $this->input->post("Remarks" . $i),
                "PublicationType" => $ptype,
                "PublicationPlace" => $pplace,
                "PublicationFreq" => $freq,
                "PublicationLan" => $lan,
                "EntryBy" => $this->session->userdata("eid"),
                "EntrydateTime" => date('Y-m-d H:i:s'),
				);
				
				
				$str = $this->db->insert_string("dataentryreport", $dataa);
				$query = $this->db->query($str);
				
				
			}
			
			
			return $this->db->affected_rows();
			
			
		}
		
		
		function deleteInfo($Eid = NULL)
		{
			$where = "delete from dataentry where  Id=" . $Eid . " and State='1' ";
			$query = $this->db->query($where);
			$row = $this->db->affected_rows();
			$where = "delete from dataentrydetails where  DataentryId=" . $Eid . " and State='1' ";
			$query = $this->db->query($where);
			$row = $this->db->affected_rows();
			$where = "delete from dataentryreport where  DataentryId=" . $Eid . " and State='1' ";
			$query = $this->db->query($where);
			return $row;
			
			
		}
		
		function get_all_info_by_id($eid = NULL)
		{
			$query = $this->db->get_where('dataentry', array('Id' => $eid, 'State' => '1'));
			return $query->result();
			
		}
		
		function getallhue()
		{
			$str = "select * from hue where State='1'";
			$query = $this->db->query($str);
			return $query->result();
			
		}
		
		function getalladtype()
		{
			$str = "select * from adcategory where State='1'";
			$query = $this->db->query($str);
			return $query->result();
			
		}
		
		function getallpublication($media = NULL)
		{
			$str = "select * from publication where State='1' and MediaId='$media' ";
			$query = $this->db->query($str);
			return $query->result();
			
		}
		
		function getallprice($media = NULL)
		{
			$str = "select * from price where State='1' and MediaId='$media' ";
			$query = $this->db->query($str);
			return $query->result();
			
		}
		
		function getdatails($id = NULL)
		{
			$str = "select * from dataentrydetails where State='1' and DataentryId='$id' ";
			$query = $this->db->query($str);
			return $query->result();
			
		}
		
		
		function getmaxbatch()
		{
			$bat = 1;
			$str = "select max(BatchId)+1 as maxbat from  dataentry ";
			$query = $this->db->query($str);
			foreach ($query->result() as $row) {
				$bat = $row->maxbat;
				
			}
			if ($bat == "") {
				$bat = 1;
			}
			
			
			return $bat;
		}
		
		
		function getname($table = NULL, $id = NULL)
		{
			$bat = 1;
			$str = "SELECT Name FROM $table WHERE Id='$id' ";
			$query = $this->db->query($str);
			foreach ($query->result() as $row) {
				$bat = $row->Name;
				
			}
			
			return $bat;
		}
		
		function getsubbname()
		{
			$srt = 'SELECT subbrand.Name,brand.Name as sbm FROM subbrand INNER JOIN brand ON subbrand.BrandId=brand.Id ';
			$query = $this->db->query($srt);
			
			
			return $query->result();
		}
		
		
	}
	
?>