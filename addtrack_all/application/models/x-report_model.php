<?php

class report_model extends CI_model
{


    public function __construct()
    {
        parent::__construct();

    }


    function get_all_query_row($Date = NULL, $Date1 = NULL, $MediaId = NULL, $PublicationId = NULL)
    {

        $where = "";
        $Media = $this->getname('media', $MediaId);
        $publication = $this->getname('publication', $PublicationId);
        $Dateto = $this->common_model->getdateformat($Date);
        $Datefrom = $this->common_model->getdateformat($Date1);
        if ($Media != "1") {
            $where .= " and  MediaId='$Media'";
        }
        if ($publication != "1") {
            $where .= " and  PublicationName='$publication' ";
        }

        if ($Dateto != "" && $Datefrom != "") {
            $where .= " and adentryreport.Date between  '$Dateto' and  '$Datefrom'   ";
        }


        $str = " select   * from  adentryreport   where State='1' " . $where;

        $query = $this->db->query($str);
        return $query->result();
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


    function downloadall()
    {
        $img = explode('~', $_POST['hidimg']);
        $foldername = 'de_' . date('dmy');
        $folderpath = './images/' . 'de_' . date('dmy');
        if (!file_exists($folderpath)) {
            mkdir($folderpath, 0777, true);
        }
        foreach ($img as $i) {

            if ($i != "") {
                copy('./images/' . $i, $folderpath . '/' . $i);
            }

        }

        $this->zip->read_dir($folderpath . "/");
        $this->zip->archive('./images/' . $foldername . ".zip");
        $this->zip->download('./images/' . $foldername . ".zip");

    }

    function downloadxl()
    {


    }


}

?>