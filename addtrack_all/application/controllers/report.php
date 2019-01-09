<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class report extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('report_model', '', TRUE);
        $this->load->library('zip');
        $this->load->helper('file');
        $this->load->helper('download');
        if ($this->session->userdata('login') != TRUE) {
            redirect('user/index/1');
        }
    }

    public function index($Date = NULL, $Date1 = NULL, $MediaId = NULL, $PublicationId = NULL, $msg = NULL, $batid = NULL, $setext = NULL, $limit = NULL)
    {

        $Date = isset($_POST['Date']) ? $this->input->post('Date') : $Date;
        $Date1 = isset($_POST['Date1']) ? $this->input->post('Date1') : $Date1;
        $MediaId = isset($_POST['MediaId']) ? $this->input->post('MediaId') : $MediaId;
        $PublicationId = isset($_POST['PublicationId']) ? $this->input->post('PublicationId') : $PublicationId;

        $array = array(
            'msg' => $msg,
            'title' => 'Report ',
            'result' => $this->report_model->get_all_query_row($Date, $Date1, $MediaId, $PublicationId),
            'operation' => 'add',
            'PublicationId' => $PublicationId,
            'MediaId' => $MediaId,
            'array' => $this->common_model->dropdownvalue('media', 'Name', 0),
            'pbarray' => $this->common_model->dropdownvaluenull('publication', 'Name', " MediaId='$MediaId' "), 'a' => array('0' => 'Select'),
            'Date' => $this->common_model->getdateformat($Date),
            'Date1' => $this->common_model->getdateformat($Date1),
            'MediaId' => $MediaId,
            'PublicationId' => $PublicationId,

        );
        $this->load->view('report_view', $array);

    }


    function getallpublication()
    {
        $media = $_POST['media'];
        $result = $this->report_model->getallpublication($media);
        $arr = array('0' => 'Select');
        foreach ($result as $row) {
            $arr[$row->Id] = $row->Name;

        }

        echo form_dropdown('PublicationId', $arr, '0', "tabindex='3', id='PublicationId'");

    }


    function getallprice()
    {
        $media = $_POST['media'];
        $result = $this->report_model->getallprice($media);
        $arr = array('0' => 'Select');
        foreach ($result as $row) {
            $arr[$row->Id] = $row->Name;

        }

        echo form_dropdown('PriceId', $arr, '0', "tabindex='10', id='PriceId'");

    }

    function download()
    {

        $this->report_model->downloadall();
    }

    function xlsBOF()
    {
        echo pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0);
        return;
    }

    // This one makes the end of the xls file
    function xlsEOF()
    {
        echo pack("ss", 0x0A, 0x00);
        return;
    }

    // this will write text in the cell you specify
    function xlsWriteLabel($Row, $Col, $Value)
    {
        $L = strlen($Value);
        echo pack("ssssss", 0x204, 8 + $L, $Row, $Col, 0x0, $L);
        echo $Value;
        return;
    }

    function generatexl($Date = NULL, $Date1 = NULL, $MediaId = NULL, $PublicationId = NULL)
    {

        $Date = $this->common_model->dateformat($Date);
        $Date1 = $this->common_model->dateformat($Date1);


        $qr = $this->report_model->get_all_query_row($Date, $Date1, $MediaId, $PublicationId);
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");

        //this line is important its makes the file name
        header("Content-Disposition: attachment;filename=export_" . date('d_m_Y_H_i_s') . ".xls");

        header("Content-Transfer-Encoding: binary ");

        // start the file
        $this->xlsBOF();

        // these will be used for keeping things in order.
        $col = 0;
        $row = 1;

        // This tells us that we are on the first row
        $first = true;


        $this->xlsWriteLabel(0, 0, 'Date');
        $this->xlsWriteLabel(0, 1, 'Media Name');
        $this->xlsWriteLabel(0, 2, 'Publication Name');
        $this->xlsWriteLabel(0, 3, 'Publication Type');
        $this->xlsWriteLabel(0, 4, 'Publication Place');
        $this->xlsWriteLabel(0, 5, 'Publication Freq');
        $this->xlsWriteLabel(0, 6, 'Publication Language');
        $this->xlsWriteLabel(0, 7, 'Brand');
        $this->xlsWriteLabel(0, 8, 'Sub-Brand');


        $this->xlsWriteLabel(0, 9, 'Title');

        $this->xlsWriteLabel(0, 10, 'Company');
		$this->xlsWriteLabel(0, 11, 'Product');
        
        $this->xlsWriteLabel(0, 12, 'ProductCatName');
		


        $this->xlsWriteLabel(0, 13, 'Page Name');
        $this->xlsWriteLabel(0, 14, 'Page No');


        $this->xlsWriteLabel(0, 15, 'Hue');


        $this->xlsWriteLabel(0, 16, 'Placing');
        $this->xlsWriteLabel(0, 17, 'Placing type');
        $this->xlsWriteLabel(0, 18, 'Column');
        $this->xlsWriteLabel(0, 19, 'Inch');
        $this->xlsWriteLabel(0, 20, 'ColumnXInch');

        $this->xlsWriteLabel(0, 21, 'Cost');


        $this->xlsWriteLabel(0, 22, 'Ad-type ');
        $this->xlsWriteLabel(0, 23, 'Ad-theme');


        $i = 1;
        foreach ($qr as $qrow) {


            $this->xlsWriteLabel($row, 0, $qrow->Date);
            $this->xlsWriteLabel($row, 1, $qrow->MediaId);
            $this->xlsWriteLabel($row, 2, $qrow->PublicationName);
            $this->xlsWriteLabel($row, 3, $qrow->PublicationType);
            $this->xlsWriteLabel($row, 4, $qrow->PublicationPlace);
            $this->xlsWriteLabel($row, 5, $qrow->PublicationFreq);
            $this->xlsWriteLabel($row, 6, $qrow->PublicationLan);
            $this->xlsWriteLabel($row, 7, $qrow->Brand);
            $this->xlsWriteLabel($row, 8, $qrow->Subbrand);

            $this->xlsWriteLabel($row, 9, $qrow->Caption);

            $this->xlsWriteLabel($row, 10, $qrow->Company);
            
            $this->xlsWriteLabel($row, 11, $qrow->ProductCatName);
			$this->xlsWriteLabel($row, 12, $qrow->ProductName);


            $this->xlsWriteLabel($row, 13, $qrow->PageName);
            $this->xlsWriteLabel($row, 14, $qrow->PageNo);


            $this->xlsWriteLabel($row, 15, $qrow->HueName);


            $this->xlsWriteLabel($row, 16, $qrow->PlaceingName);
            $this->xlsWriteLabel($row, 17, $qrow->PositionName);
            $this->xlsWriteLabel($row, 18, $qrow->Cols);
            $this->xlsWriteLabel($row, 19, $qrow->Inchs);
            $this->xlsWriteLabel($row, 20, $qrow->Cols * $qrow->Inchs);

            $this->xlsWriteLabel($row, 21, $qrow->Price * $qrow->Cols * $qrow->Inchs);

            $this->xlsWriteLabel($row, 22, $qrow->AdType);
            $this->xlsWriteLabel($row, 23, $qrow->Adtheme);


            $row++;
            $i++;


        }

        $this->xlsEOF();
        exit();

    }


}

?>
