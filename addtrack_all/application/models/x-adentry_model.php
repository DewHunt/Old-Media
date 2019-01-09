<?php

class adentry_model extends CI_model
{


    public function __construct()
    {
        parent::__construct();

    }

    function get_all_query_row_countall($search = NULL)
    {
        //  if($search!='_') {$searchtext=" and Name like '%$search%'";}else {$searchtext="";}
        $str = "select   * from  adentry    where  State='1' ";
        $query = $this->db->query($str);
        return $query->num_rows();
    }

    function get_all_query_row($p = NULL, $search = NULL)
    {
        $limit = "limit $p,10";
        //  if($search!='_') {$searchtext=" and   Name like '%".$search."%'";}else {$searchtext="";}
        $str = " select   * from  adentry   where State='1' " . $limit;
        $query = $this->db->query($str);
        return $query->result();
    }


    function insert_mgt()
    {
        $data = array(
            'BatchId' => $this->input->post("Batch"),
            'MediaId' => $this->input->post("MediaId"),
            'PublicationId' => $this->input->post("PublicationId"),
            'Date' => $this->common_model->getdateformat($this->input->post("Date")),
            'EntryBy' => $this->session->userdata("eid"),
            'EntryDateTime' => date('Y-m-d H:i:s'),
        );
        $str = $this->db->insert_string("adentry", $data);
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


        for ($i = 1; $i <= $_POST['rowcount']; $i++) {

            $caption = "";
            $BrandId = "";
            $SubBrandId = "";
            $CompanyId = "";
            $Notes = "";
            $ProductId = "";
            $ProduId = "";
            $AtypeId = "";
            $AdTheme = "";
            $Image = "";


            $res = $this->getallinfobyid($this->input->post("ID" . $i));
            foreach ($res as $row) {
                $caption = $row->Title;
                $BrandId = $row->BrandId;
                $SubBrandId = $row->SubBrandId;
                $CompanyId = $row->CompanyId;
                $Notes = $row->Notes;
                $ProductId = $row->ProductId;
                $ProduId = $row->Id;
                $Name = $row->Name;
                $AtypeId = $row->AtypeId;
                $AdTheme = $row->AdTheme;
                $Image = $row->Image;

				//________________________________________________________________________________reza--28-08-2017 Start
				
				
               // $str = "SELECT * FROM product_cat WHERE product_cat.Id = $ProductId";

               // $query = $this->db->query($str);

               // foreach ($query->result() as $row) {
                //    $pId = $row->ProductId;

               // }
			   //________________________________________________________________________________reza--28-08-2017 End
				
				
				
				
				
				
				
				
				
				
				
				
//                echo ("<pre>");
//                print_r($pId);
//                die();


            }




            $data = array(
                'adentryId' => $insert_id,
                'ProductId' => $ProductId,
                'ProductCatId' => $pId,
                'AdinfoId' => $this->input->post("ID" . $i),
                'CompanyId' => $CompanyId,
                'Caption' => $caption,
                'AdType' => $AtypeId,
                'Image' => $Image,
                'HueId' => $this->input->post("Hue" . $i),
                'PlaceingId' => $this->input->post("placing" . $i),
                'PositionId' => $this->input->post("placingtype" . $i),
                'PageId' => $this->input->post("PageId" . $i),
                'Cols' => $this->input->post("Cols" . $i),
                'Inchs' => $this->input->post("Inchs" . $i),
                'PageNo' => $this->input->post("pageno" . $i),
                //'NewstypeId'=>$this->input->post("NewstypeId".$i),
                'Keyword' => $this->input->post("Keyword" . $i),
                'Remarks' => $this->input->post("Remarks" . $i),
                'EntryBy' => $this->session->userdata("eid"),
                'EntryDateTime' => date('Y-m-d H:i:s'),
            );
            $str = $this->db->insert_string("adentrydetails", $data);
            $query = $this->db->query($str);

            //$price=0;
            //$str=" select Price from  price left join pricedetails on(price.Id= pricedetails.PriceId)
//where MediaId='".$this->input->post("MediaId")."' and PublicationId='".$this->input->post("PublicationId")."' and Col='".$this->input->post("Cols".$i)."' and Inch='".$this->input->post("Inchs".$i)."' and  pricedetails.State='1'";

//echo $this->input->post("PageId".$i) . $this->input->post("Hue".$i); exit;


            $price = 0;
			
			//__________________________________________________________reza 28-08-2017 Start
			
            //$str = " select Price from  price left join pricedetails on(price.Id= pricedetails.PriceId)
//where MediaId='" . $this->input->post("MediaId") . "' and PublicationId='" . $this->input->post("PublicationId") . "' and Col='2' and Inch='2' and  Hue='" . $this->input->post("Hue" . $i) . "' and PageNoId='" . $this->input->post("PageId" . $i) . "' and  pricedetails.State='1'";




            //$query = $this->db->query($str);
            //foreach ($query->result() as $row) {
              //  $price = $row->Price;
            //}
          //  $com = "";
           // $bnd = "";
          //  $sbnd = "";
          //  $adname = "";
           // $pcname = "";
          //  $adtypen = "";
           // $AdTheme = "";
           // $Caption = "";

//__________________________________________________________reza --28-08-2017 End

//__________________________________________________________reza --28-08-2017 Add

  $str=" select Price from  price left join pricedetails on(price.Id= pricedetails.PriceId)
where MediaId='".$this->input->post("MediaId")."' and PublicationId='".$this->input->post("PublicationId")."' and Col='1' and Inch='1' and  Hue='".$this->input->post("Hue".$i)."' and PageNoId='".$this->input->post("PageId".$i)."' and  pricedetails.State='1'"; 

				  	
			    $query=$this->db->query($str);
				foreach($query->result() as $row)
				  {
				   $price=$row->Price;
				  } 
					$com=""; 
					$bnd="";
					$sbnd="";
					$adname="";
					$pname="";
					$adtypen="";
					$AdTheme=""; 
					$Caption=""; 



//_________________________________________________________reza End

















            $str = " SELECT adinfo.Title as Caption , company.Name AS cname,brand.Name AS bname,subbrand.Name AS sname, adcategory.Name AS adname, product_cat.ProductId AS pcat
  ,adcategory.Name AS adtypen,adinfo.AdTheme   FROM  adinfo  
LEFT JOIN company ON (adinfo.CompanyId =company.Id)
LEFT JOIN brand ON (adinfo.BrandId =brand.Id)
LEFT JOIN subbrand ON (adinfo.SubBrandId =subbrand.Id)	
LEFT JOIN product_cat ON (adinfo.ProductId =product_cat.Id)
LEFT JOIN adcategory ON (adinfo.AtypeId =adcategory.Id)			 
				   where adinfo.AD_ID='" . $this->input->post("ID" . $i) . "'  and adinfo.State='1' ";

            $query = $this->db->query($str);


            foreach ($query->result() as $rows) {
                $com = $rows->cname;
                $bnd = $rows->bname;
                $sbnd = $rows->sname;
                $adname = $rows->adname;
                $pcat = $rows->pcat;

               // echo $pcat;
               // die();


                $str = "SELECT * FROM product WHERE product.Id = $pcat";

                $query = $this->db->query($str);

                foreach ($query->result() as $row) {
                    $pId = $row->Name;

                }

//                echo ("<pre>");
//                print_r($pId);
//                die();

                $AdTheme = $rows->AdTheme;
                $Caption = $rows->Caption;


            }


            $str = " SELECT product_cat.Name AS pcat FROM  adinfo 
LEFT JOIN product_cat ON (adinfo.ProductId =product_cat.Id)		 
LEFT JOIN product ON (adinfo.ProductId =product.Id)		 
				   where adinfo.AD_ID='" . $this->input->post("ID" . $i) . "'  and adinfo.State='1' ";

            $query = $this->db->query($str);

            foreach ($query->result() as $rows) {

                $pcat = $rows->pcat;
//                $pId = $rows->pId;


            }


            $dataa = array(
                "adentryId" => $insert_id,
                "BatchId" => $this->input->post("Batch"),
                "MediaId" => $this->getname('media', $this->input->post("MediaId")),
                "PublicationName" => $this->getname('publication', $this->input->post("PublicationId")),
                "Date" => $this->common_model->getdateformat($this->input->post("Date")),
                "Brand" => $bnd,
                "Subbrand" => $sbnd,
                "Company" => $com,
                "Caption" => $Caption,
                "AdType" => $adname,
                "HueName" => $this->getname('hue', $this->input->post("Hue" . $i)),
                "PlaceingName" => $this->getname('placing', $this->input->post("placing" . $i)),
                "PositionName" => $this->getname('placingtype', $this->input->post("placingtype" . $i)),
                "PageName" => $this->getname('page', $this->input->post("PageId" . $i)),
                "Cols" => $this->input->post("Cols" . $i),
                "Inchs" => $this->input->post("Inchs" . $i),
                "PageNo" => $this->input->post("pageno" . $i),
                "Price" => $price,
                "Adtheme" => $AdTheme,
                "ProductName" => $pId,
                "ProductCatName" => $pcat,
//                'ProductCatName' => $this->getname('product_cat', $this->input->post("ProductId" . $i)),
                "PublicationType" => $ptype,
                "PublicationPlace" => $pplace,
                "PublicationFreq" => $freq,
                "PublicationLan" => $lan,
                "EntryBy" => $this->session->userdata("eid"),
                "EntrydateTime" => date('Y-m-d H:i:s'),
            );
            $str = $this->db->insert_string("adentryreport", $dataa);


            $query = $this->db->query($str);


        }


        return $this->db->affected_rows();

    }

    function edit_mgt($Eid = NULL)
    {


        $where = "delete from adentry where  Id=" . $Eid . " and State='1' ";
        $query = $this->db->query($where);
        $row = $this->db->affected_rows();
        $where = "delete from adentrydetails where  adentryId=" . $Eid . " and State='1' ";
        $query = $this->db->query($where);
        $where = "delete from adentryreport where  AdentryId=" . $Eid . " and State='1' ";
        $query = $this->db->query($where);


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

        for ($i = 1; $i <= $_POST['rowcount']; $i++) {

            $caption = "";
            $BrandId = "";
            $SubBrandId = "";
            $CompanyId = "";
            $Notes = "";
            $ProductId = "";
            $AtypeId = "";
            $AdTheme = "";
            $Image = "";


            $res = $this->getallinfobyid($this->input->post("ID" . $i));
            foreach ($res as $row) {
                $caption = $row->Title;
                $BrandId = $row->BrandId;
                $SubBrandId = $row->SubBrandId;
                $CompanyId = $row->CompanyId;
                $Notes = $row->Notes;
                $ProductId = $row->ProductId;
                $AtypeId = $row->AtypeId;
                $AdTheme = $row->AdTheme;
                $Image = $row->Image;

            }


            $data = array(
                'adentryId' => $insert_id,
                'ProductId' => $ProductId,
                'ProductCatId' => $this->input->post("ProductCatId" . $i),
                'AdinfoId' => $this->input->post("ID" . $i),
                'CompanyId' => $CompanyId,
                'Caption' => $caption,
                'AdType' => $AtypeId,
                'Image' => $Image,
                'HueId' => $this->input->post("Hue" . $i),
                'PlaceingId' => $this->input->post("placing" . $i),
                'PositionId' => $this->input->post("placingtype" . $i),
                'PageId' => $this->input->post("PageId" . $i),
                'Cols' => $this->input->post("Cols" . $i),
                'Inchs' => $this->input->post("Inchs" . $i),
                'PageNo' => $this->input->post("pageno" . $i),
                //'NewstypeId'=>$this->input->post("NewstypeId".$i),
                'Keyword' => $this->input->post("Keyword" . $i),
                'Remarks' => $this->input->post("Remarks" . $i),
                'EntryBy' => $this->session->userdata("eid"),
                'EntryDateTime' => date('Y-m-d H:i:s'),
            );
            $str = $this->db->insert_string("adentrydetails", $data);
            $query = $this->db->query($str);

            $price = 0;
            $str = " select Price from  price left join pricedetails on(price.Id= pricedetails.PriceId)
where MediaId='" . $this->input->post("MediaId") . "' and PublicationId='" . $this->input->post("PublicationId") . "' and Col='1' and Inch='1' and  Hue='" . $this->input->post("Hue" . $i) . "' and PageNoId='" . $this->input->post("pageno" . $i) . "' and  pricedetails.State='1' ";
            $query = $this->db->query($str);
            foreach ($query->result() as $row) {
                $price = $row->Price;
            }


            $com = "";
            $bnd = "";
            $sbnd = "";
            $adname = "";
            $pname = "";
            $Name = "";
            $adtypen = "";
            $AdTheme = "";
            $Caption = "";

            $str = " SELECT   adinfo.Title as Caption,company.Name AS cname,brand.Name AS bname,subbrand.Name AS sname, adcategory.Name AS adname ,product.Name AS pname
  ,adcategory.Name AS adtypen,adinfo.AdTheme   FROM  adinfo  
LEFT JOIN company ON (adinfo.CompanyId =company.Id)
LEFT JOIN brand ON (adinfo.BrandId =brand.Id)
LEFT JOIN subbrand ON (adinfo.SubBrandId =subbrand.Id)	
LEFT JOIN product ON (adinfo.ProductId =product.Id)
LEFT JOIN adcategory ON (adinfo.AtypeId =adcategory.Id)			 
				   where adinfo.AD_ID='" . $this->input->post("ID" . $i) . "'  and adinfo.State='1' ";

            $query = $this->db->query($str);

            foreach ($query->result() as $rows) {
                $com = $rows->cname;
                $bnd = $rows->bname;
                $sbnd = $rows->sname;
                $adname = $rows->adname;
                $pname = $rows->pname;
                $AdTheme = $rows->AdTheme;
                $Caption = $rows->Caption;
            }





            $dataa = array(

                "adentryId" => $insert_id,
                "BatchId" => $this->input->post("Batch"),
                "MediaId" => $this->getname('media', $this->input->post("MediaId")),
                "PublicationName" => $this->getname('publication', $this->input->post("PublicationId")),
                "Date" => $this->common_model->getdateformat($this->input->post("Date")),
                "Brand" => $bnd,
                "Subbrand" => $sbnd,
                "Company" => $com,
                "Caption" => $Caption,
                "AdType" => $adname,
                "HueName" => $this->getname('hue', $this->input->post("Hue" . $i)),
                "PlaceingName" => $this->getname('placing', $this->input->post("placing" . $i)),
                "PositionName" => $this->getname('placingtype', $this->input->post("placingtype" . $i)),
//                "PageName"=> $this->getname('page',$this->input->post("PageId".$i)),
                "Cols" => $this->input->post("Cols" . $i),
                "Inchs" => $this->input->post("Inchs" . $i),
                "PageNo" => $this->input->post("pageno" . $i),
                "Price" => $price,
                "Adtheme" => $AdTheme,
                "ProductName" => $pname,
                'ProductCatName' => $this->getname('product_cat', $this->input->post("ProductId" . $i)),
                "PublicationType" => $ptype,
                "PublicationPlace" => $pplace,
                "PublicationFreq" => $freq,
                "PublicationLan" => $lan,
                "UpdateBy" => $this->session->userdata("eid"),
                "UpdateDateTime" => date('Y-m-d H:i:s'),
            );


            $str = $this->db->insert_string("adentryreport", $dataa);
            $query = $this->db->query($str);


        }

        return $this->db->affected_rows();
    }


    function deleteInfo($Eid = NULL)
    {
        $where = "delete from adentry where  Id=" . $Eid . " and State='1' ";
        $query = $this->db->query($where);
        $row = $this->db->affected_rows();
        $where = "delete from adentrydetails where  adentryId=" . $Eid . " and State='1' ";
        $query = $this->db->query($where);
        return $row;


    }

    function get_all_info_by_id($eid = NULL)
    {
        $query = $this->db->get_where('adentry', array('Id' => $eid, 'State' => '1'));
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
        $str = "SELECT af.*,af.ID as afid,ad.Caption, ad.PlaceingId ,ad.PositionId,ad.PageId, ad.Cols,  ad.Inchs, ad.PageNo, ad.HueId FROM adentrydetails ad
LEFT JOIN adinfo af ON  ad.AdinfoId=af.AD_ID
 WHERE ad.State='1' AND ad.AdentryId='$id' ";
        $query = $this->db->query($str);
        return $query->result();

    }

    function getdatailsbyid($id = NULL)
    {
        $str = "SELECT ad.*  FROM adentrydetails ad
 
 WHERE ad.State='1' AND ad.AdentryId='$id' ";
        $query = $this->db->query($str);
        return $query->result();

    }


    function getmaxbatch()
    {
        $bat = 1;
        $str = "SELECT MAX(p) as maxbat FROM 
 (SELECT MAX(BatchId)+1 AS p     FROM  adentry GROUP BY  BatchId   ) AS r ";
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
        $str = "select Name   from  $table where Id='$id' ";
        $query = $this->db->query($str);
        foreach ($query->result() as $row) {
            $bat = $row->Name;

        }


        return $bat;
    }

    function getallinfobyid($id = NULL)
    {
        $str = "select * from adinfo where AD_ID='" . $id . "' and State='1'";
        $query = $this->db->query($str);
        return $query->result();

    }

    function getadinfodatabyid($id = NULl)
    {
        $str = "select * from adinfo where AD_ID='" . $id . "' and State='1'";
        $query = $this->db->query($str);
        return $query->result();

    }

    function getidbycaption($id = NULl)
    {
        $str = "select AD_ID from adinfo where Id='" . $id . "' and State='1'";
        $query = $this->db->query($str);
        return $query->result();

    }



}

?>