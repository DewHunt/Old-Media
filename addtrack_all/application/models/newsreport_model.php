<?php

class newsreport_model extends CI_model
{


    public function __construct()
    {
        parent::__construct();

    }


    function get_all_query_row($Date=NULL, $Date1=NULL , $MediaId=NULL, $PublicationId=NULL,$BrandName=NULL,$ProductName=NULL, $Keyword=NULL)
    {


        $where="";

        $Media =$this->getname('media',$MediaId);


        $publication =$this->getname('publication',$PublicationId);

        $Brand =$this->getname('brand',$BrandName);

        $keyword =$this->getname('keyword',$Keyword);

        $Product =$this->getname('product',$ProductName);


        $Dateto =$this->common_model->getdateformat($Date);

        $Datefrom =$this->common_model->getdateformat($Date1);

        if($Media!="1")
        {
            $where.=" and  MediaId='$Media'";
        }
        if($Brand!="1")
        {
            $where.=" and BrandName='$Brand'";
        }



        if($Product!="1")
        {
            $where.=" and ProductName='$Product'";
        }


        if($keyword!="1")
        {
            $where.=" and Keyword='$keyword'";
        }



        if($publication!="1")
        {
            $where.=" and  PublicationName='$publication' ";
        }

        if($Dateto!="" && $Datefrom!="" )
        {
            $where.=" and dataentryreport.Date between  '$Dateto' and  '$Datefrom'   ";
        }




        $str = " select   * from  dataentryreport   where State='1' " . $where;




        $query = $this->db->query($str);
        return $query->result();
    }


    function get_all_query_row1($Date = NULL, $Date1 = NULL, $MediaId = NULL, $PublicationId = NULL, $BrandId = NULL, $ProductId = NULL)
    {

        $where = "";

        $Media = $this->getname('media', $MediaId);

        $Brand = $this->getname('Brand', $BrandId);

        $Product = $this->getname('Product', $ProductId);

        $publication = $this->getname('publication', $PublicationId);


        $Dateto = $this->getdateformat1($Date);
        $Datefrom = $this->getdateformat1($Date1);
        if ($Media != "1") {
            $where .= " and  MediaId='$Media'";
        }

        if ($Brand != "1") {
            $where .= " and  BrandId='$Brand'";
        }

        if ($Product != "1") {
            $where .= " and  ProductId='$Product' ";
        }

    if ($publication != "1") {
            $where .= " and  PublicationName='$publication' ";
        }

        if ($Dateto != "" && $Datefrom != "") {
            $where .= " and dataentryreport.Date between  '$Dateto' and  '$Datefrom'   ";
        }


        $str = " select   Image  from  dataentryreport   where State='1' " . $where;
        $strr = " select   * from  adentryreport   where State='1' " . $where;

        $query = $this->db->query($str);
        return $query->result();
    }
    function getdateformat1($date = NULL)
    {
        if (!empty($date)) {
            $var = "";
            $var = explode('/', $date);
            $returndate = $var[2] . "-" . $var[1] . "-" . $var[0];
            return $returndate;
        }

    }

    function dateformat1($date = NULL)
    {
        if (!empty($date)) {
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


    function getallpublication($media = NULL)
    {
        $str = "select * from publication where State='1' and MediaId='$media' ";
        $query = $this->db->query($str);
        return $query->result();

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




    public function downloadall($Image = NULL)
    {
        $zip = new ZipArchive();

        $result = $zip->open("imagecopymerge.zip", ZIPARCHIVE::CREATE);
        if ($result) {

            $d = dir("imagecopymerge/");

            while (false !== ($entry = $d->read())) {

                if (preg_match("/\w*\.jpg/", $entry)) {

                    $zip->addFile("imagecopymerge/" . $entry, $entry);
                }
            }

            $d->close();
            $zip->close();


        } else {

            echo "Failed: $result.\n";
        }
    }





}

?>
