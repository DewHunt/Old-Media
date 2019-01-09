<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class newsreport extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('newsreport_model', '', TRUE);
        $this->load->library('zip');
        $this->load->helper('file');
        $this->load->helper('download');
        if ($this->session->userdata('login') != TRUE) {
            redirect('user/index/1');
        }
    }

    public function index($Date = NULL, $Date1 = NULL, $MediaId = NULL, $PublicationId = NULL, $msg = NULL, $BrandId=NULL, $ProductId = NULL, $batid = NULL, $setext = NULL, $limit = NULL)
    {

        $Date = isset($_POST['Date']) ? $this->input->post('Date') : $Date;
        $Date1 = isset($_POST['Date1']) ? $this->input->post('Date1') : $Date1;
        $MediaId = isset($_POST['MediaId']) ? $this->input->post('MediaId') : $MediaId;
        $BrandId = isset($_POST['BrandId']) ? $this->input->post('BrandId') : $BrandId;
        $ProductId = isset($_POST['ProductId']) ? $this->input->post('ProductId') : $ProductId;
        $PublicationId = isset($_POST['PublicationId']) ? $this->input->post('PublicationId') : $PublicationId;



        $array = array(
            'msg' => $msg,
            'title' => 'newsreport ',
            'result' => $this->newsreport_model->get_all_query_row($Date, $Date1, $MediaId, $PublicationId, $BrandId, $ProductId),
            'operation' => 'add',
            'PublicationId' => $PublicationId,
            'MediaId' => $MediaId,
            'array' => $this->common_model->dropdownvalue('media', 'Name', 0),
            'carray' => $this->common_model->dropdownvalue('Brand', 'Name', 0),
            'poarray' => $this->common_model->dropdownvalue('product', 'Name', 0),
            'pbarray' => $this->common_model->dropdownvaluenull('publication', 'Name', " MediaId='$MediaId' "), 'a' => array('0' => 'Select'),
            'Date' => $this->common_model->getdateformat($Date),
            'Date1' => $this->common_model->getdateformat($Date1),
            'MediaId' => $MediaId,
            'PublicationId' => $PublicationId,

        );
        $this->load->view('newsreport_view', $array);

    }


    function getallpublication()
    {
        $media = $_POST['media'];
        $result = $this->newsreport_model->getallpublication($media);
        $arr = array('0' => 'Select');
        foreach ($result as $row) {
            $arr[$row->Id] = $row->Name;

        }

        echo form_dropdown('PublicationId', $arr, '0', "tabindex='3', id='PublicationId'");

    }


    function getallprice()
    {
        $media = $_POST['media'];
        $result = $this->newsreport_model->getallprice($media);
        $arr = array('0' => 'Select');
        foreach ($result as $row) {
            $arr[$row->Id] = $row->Name;

        }

        echo form_dropdown('PriceId', $arr, '0', "tabindex='10', id='PriceId'");

    }

    function download()
    {

        $this->newsreport_model->downloadall( );
    }

    function xlsBOF() {
        echo pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0);
        return;
    }

    // This one makes the end of the xls file
    function xlsEOF() {
        echo pack("ss", 0x0A, 0x00);
        return;
    }

    // this will write text in the cell you specify
    function xlsWriteLabel($Row, $Col, $Value ) {
        $L = strlen($Value);
        echo pack("ssssss", 0x204, 8 + $L, $Row, $Col, 0x0, $L);
        echo $Value;
        return;
    }

    function generatexl ($Date=NULL, $Date1=NULL,$MediaId=NULL,$PublicationId=NULL)
    {

        $Date =$this->common_model->dateformat($Date);
        $Date1=$this->common_model->dateformat($Date1) ;


        $qr= $this->newsreport_model->get_all_query_row( $Date,$Date1,$MediaId,$PublicationId);
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");

        //this line is important its makes the file name
        header("Content-Disposition: attachment;filename=export_".date('d_m_Y_H_i_s').".xls");

        header("Content-Transfer-Encoding: binary ");

        // start the file
        $this->xlsBOF();

        // these will be used for keeping things in order.
        $col = 0;
        $row = 1;

        // This tells us that we are on the first row
        $first = true;


        $this->xlsWriteLabel(0,0,'Date');
        $this->xlsWriteLabel(0,1,'Media Name');
        $this->xlsWriteLabel(0,2,'Publication Name');
        $this->xlsWriteLabel(0,3,'Publication Type');
        $this->xlsWriteLabel(0,4,'Publication Place');
        $this->xlsWriteLabel(0,5,'Publication Freq');
        $this->xlsWriteLabel(0,6,'Publication Lan');
        $this->xlsWriteLabel(0,7,' Brand ');
        //$this->xlsWriteLabel(0,8,' Product ');
        $this->xlsWriteLabel(0,8,'Hue ');
        $this->xlsWriteLabel(0,9,' Product Category');
        $this->xlsWriteLabel(0,10,' Caption');
        $this->xlsWriteLabel(0,11,' Column');
        $this->xlsWriteLabel(0,12,' Inche');
        $this->xlsWriteLabel(0,13,'ColumnXInch');
        $this->xlsWriteLabel(0,14,' Cost');
        $this->xlsWriteLabel(0,15,' Page Number');
        $this->xlsWriteLabel(0,16,' Ad-type ');
        $this->xlsWriteLabel(0,17,' Position ');
        $this->xlsWriteLabel(0,18,'Page ');
        $this->xlsWriteLabel(0,19,'Keywords ');


        //$this->xlsWriteLabel(0,23,'Company ');



        $i=1;
        foreach( $qr  as  $qrow   )
        {


            $this->xlsWriteLabel( $row, 0,  $qrow->Date  );
            $this->xlsWriteLabel( $row, 1,  $qrow->MediaId );
            $this->xlsWriteLabel( $row, 2,   $qrow->PublicationName);
            $this->xlsWriteLabel( $row, 3,   $qrow->PublicationType );
            $this->xlsWriteLabel( $row, 4,  $qrow->PublicationPlace );
            $this->xlsWriteLabel( $row, 5,   $qrow->PublicationFreq);
            $this->xlsWriteLabel( $row, 6,   $qrow->PublicationLan );
            $this->xlsWriteLabel( $row, 7,   $qrow->BrandName );


            //$this->xlsWriteLabel( $row, 8,   $qrow->ProductCatName );

            $this->xlsWriteLabel( $row, 8,   $qrow->HueName );

            $this->xlsWriteLabel( $row, 9,   $qrow->ProductName );//It is Product Category Name
            $this->xlsWriteLabel( $row, 10,   $qrow->Caption );
            $this->xlsWriteLabel( $row, 11,   $qrow->Cols );
            $this->xlsWriteLabel( $row, 12,   $qrow->Inchs );

            $this->xlsWriteLabel( $row, 13,   $qrow->Cols * $qrow->Inchs  );

            $this->xlsWriteLabel( $row, 14,   $qrow->Price * $qrow-> Cols * $qrow->Inchs  );
            $this->xlsWriteLabel( $row, 15,   $qrow->PageNo );
            $this->xlsWriteLabel( $row, 16,   $qrow->AdType );
            $this->xlsWriteLabel( $row, 17,   $qrow->PositionName );
            $this->xlsWriteLabel( $row, 18,   $qrow->PageId );
            $this->xlsWriteLabel( $row, 19,   $qrow->Keyword );




            //$this->xlsWriteLabel( $row, 23,   $qrow->CompanyId );






            $row++;
            $i++;




        }

        $this->xlsEOF();
        exit();

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


    public function download2($Date = NULL, $Date1 = NULL, $MediaId = NULL, $PublicationId = NULL)
    {

        $where = "";
        $Media = $this->getname('media', $MediaId);
        $publication = $this->getname('publication', $PublicationId);
        if ($Media != "1") {
            $where .= " and  MediaId='$Media'";
        }
        if ($publication != "1") {
            $where .= " and  PublicationName='$publication' ";
        }

        $data = $this->db->query("SELECT Image FROM dataentryreport where State='1'" . $where)->result();

//
//        echo("<pre>");
//        print_r($data);
//        die();


        if ($data) {

            foreach ($data as $datas) {
                //echo  $datas->Image;

                $destt = 'D:/xampp/htdocs/media/addtrack_all/images/';

                $file = ($destt . $datas->Image);

//                echo $file;
//                die();


                $to_file = ($destt . 'download/' . $datas->Image);


                copy($file, $to_file);


            }


            // Get real path for our folder
            $rootPath = realpath('D:/xampp/htdocs/media/addtrack_all/images/download');

// Initialize archive object
            $zip = new ZipArchive();
            $zip->open('imagefile.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);

// Create recursive directory iterator
            /** @var SplFileInfo[] $files */
            $files = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($rootPath),
                RecursiveIteratorIterator::LEAVES_ONLY
            );

            foreach ($files as $name => $file) {
                // Skip directories (they would be added automatically)
                if (!$file->isDir()) {
                    // Get real and relative path for current file
                    $filePath = $file->getRealPath();
                    $relativePath = substr($filePath, strlen($rootPath) + 1);

                    // Add current file to archive
                    $zip->addFile($filePath, $relativePath);
                }
            }

// Zip archive will be created only after closing object
            $zip->close();


        }


        function SureRemoveDir($dir, $DeleteMe) {
            $dir ='D:/xampp/htdocs/media/addtrack_all/images/download';
            $DeleteMe = '';
            if(!$dh = @opendir($dir)) return;
            while (false !== ($obj = readdir($dh))) {
                if($obj=='.' || $obj=='..') continue;
                if (!@unlink($dir.'/'.$obj)) SureRemoveDir($dir.'/'.$obj, true);
            }

            closedir($dh);
            if ($DeleteMe){
                @rmdir($dir);
            }
        }

        SureRemoveDir('EmptyMe', false);
        SureRemoveDir('RemoveMe', true);




        //redirect('http://localhost/media/addtrack_all/index.php/newsreport');


    }


}


?>