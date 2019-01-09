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

    public function index($Date = NULL, $Date1 = NULL, $MediaId = NULL, $PublicationId = NULL, $msg = NULL, $Keyword = NULL, $BrandName = NULL, $ProductId = NULL)
    {

        $Date = isset($_POST['Date']) ? $this->input->post('Date') : $Date;
        $Date1 = isset($_POST['Date1']) ? $this->input->post('Date1') : $Date1;
        $MediaId = isset($_POST['MediaId']) ? $this->input->post('MediaId') : $MediaId;
        $BrandName = isset($_POST['BrandName']) ? $this->input->post('BrandName') : $BrandName;

        $Keyword = isset($_POST['Keyword']) ? $this->input->post('Keyword') : $Keyword;

        $ProductId = isset($_POST['ProductId']) ? $this->input->post('ProductId') : $ProductId;
        $PublicationId = isset($_POST['PublicationId']) ? $this->input->post('PublicationId') : $PublicationId;



        $array = array(
            'msg' => $msg,
            'title' => 'newsreport ',
            'result' => $this->newsreport_model->get_all_query_row($Date, $Date1, $MediaId, $PublicationId, $BrandName, $ProductId,$Keyword),
            'operation' => 'add',
            'PublicationId' => $PublicationId,
            'ProductId'=>$ProductId,
            'MediaId' => $MediaId,
            'BrandName'=>$BrandName,
            'Keyword'=>$Keyword,
            'array' => $this->common_model->dropdownvalue('media', 'Name', 0),
            'carray' => $this->common_model->dropdownvalue('Brand', 'Name', 0),
            'karray' => $this->common_model->dropdownvalue('keyword', 'Name', 0),
            'poarray' => $this->common_model->dropdownvalue('product', 'Name', 0),
            'pbarray' => $this->common_model->dropdownvaluenull('publication', 'Name', " MediaId='$MediaId' "),
            'a' => array('0' => 'Select'),
            'Date' => $this->common_model->getdateformat($Date),
            'Date1' => $this->common_model->getdateformat($Date1),


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

    // function generatexl ($Date=NULL, $Date1=NULL , $MediaId=NULL, $PublicationId=NULL, $BrandName=NULL, $ProductName=NULL, $Keyword=NULL)
    // {
		// $this->load->library('excel');
        // $Date =$this->common_model->dateformat($Date);
        // $Date1=$this->common_model->dateformat($Date1) ;
        // $qr= $this->newsreport_model->get_all_query_row($Date, $Date1, $MediaId, $PublicationId,$BrandName, $ProductName,$Keyword);		
        // header("Pragma: public");		
        // header("Expires: 0");
        // header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        // header("Content-Type: application/force-download");
        // header("Content-Type: application/octet-stream");
        // header("Content-Type: application/download");
        // //this line is important its makes the file name
        // header("Content-Disposition: attachment;filename=export_".date('d_m_Y_H_i_s').".xls");
        // header("Content-Transfer-Encoding: binary ");
        // header('Content-Type: text/html; charset=utf-8' );
        // // start the file
        // $this->xlsBOF();
        // // these will be used for keeping things in order.
        // $col = 0;
        // $row = 1;
        // // This tells us that we are on the first row
        // $first = true;		
		// $this->xlsWriteLabel(0, 0, 'Date');
        // $this->xlsWriteLabel(0, 1, 'Media Name');
        // $this->xlsWriteLabel(0, 2, 'Publication Name');
        // $this->xlsWriteLabel(0, 3, 'Publication Type');
        // $this->xlsWriteLabel(0, 4, 'Publication Place');
        // $this->xlsWriteLabel(0, 5, 'Publication Frequency');
        // $this->xlsWriteLabel(0, 6, 'Publication Language');	
        // $this->xlsWriteLabel(0,7,' Brand ');
        // $this->xlsWriteLabel(0,8,' subBrand ');
        // $this->xlsWriteLabel(0,9,' Company ');		
        // $this->xlsWriteLabel(0,10,' Product Category');
        // $this->xlsWriteLabel(0,11,' Product');		
        // $this->xlsWriteLabel(0,12,' Caption');		
		// $this->xlsWriteLabel(0,13,' News Type');
		// $this->xlsWriteLabel(0,14,' News Category ');		
		// $this->xlsWriteLabel(0,15,' Page Number');
		// $this->xlsWriteLabel(0,16,'Page ');
		// $this->xlsWriteLabel(0,17,' Position ');		
		// $this->xlsWriteLabel(0,18,'Hue ');
        // $this->xlsWriteLabel(0,19,' Column');
        // $this->xlsWriteLabel(0,20,' Inche');
        // $this->xlsWriteLabel(0,21,'ColumnXInch');
        // $this->xlsWriteLabel(0,22,' Cost(BDT)');
		// $this->xlsWriteLabel(0,23,' PR Values (BDT) ');		
		// $this->xlsWriteLabel(0,24,'Keywords '); 
        // $i=1;
        // foreach( $qr  as  $qrow   )
        // {
			// $this->xlsWriteLabel( $row, 0,  $qrow->Date  );
            // $this->xlsWriteLabel( $row, 1,  $qrow->MediaId );
            // $this->xlsWriteLabel( $row, 2,   $qrow->PublicationName);
            // $this->xlsWriteLabel( $row, 3,   $qrow->PublicationType );
            // $this->xlsWriteLabel( $row, 4,  $qrow->PublicationPlace );
            // $this->xlsWriteLabel( $row, 5,   $qrow->PublicationFreq);
            // $this->xlsWriteLabel( $row, 6,   $qrow->PublicationLan );			
            // $this->xlsWriteLabel( $row, 7,   $qrow->BrandName );
            // $this->xlsWriteLabel( $row, 8,   $qrow->subBrand );
            // $this->xlsWriteLabel( $row, 9,   $qrow->Company );
 			// $this->xlsWriteLabel( $row, 10,   $qrow->ProductName );//It is Product Category Name
            // $this->xlsWriteLabel( $row, 11,   $qrow->ProductCatName );//It is Product Category Name		 
			// $this->xlsWriteLabel( $row, 12,   $qrow->Caption );			
			// $this->xlsWriteLabel( $row, 13,   $qrow->NewstypeName );
			// $this->xlsWriteLabel( $row, 14,   $qrow->outlook );
			// $this->xlsWriteLabel( $row, 15,   $qrow->PageNo );
			// $this->xlsWriteLabel( $row, 16,   $qrow->PageId );
			// $this->xlsWriteLabel( $row, 17,   $qrow->PositionName );			
            // $this->xlsWriteLabel( $row, 18,   $qrow->HueName );            
            // $this->xlsWriteLabel( $row, 19,   $qrow->Cols );
            // $this->xlsWriteLabel( $row, 20,   $qrow->Inchs );
            // $this->xlsWriteLabel( $row, 21,   $qrow->Cols * $qrow->Inchs  );			
            // $this->xlsWriteLabel( $row, 22,   $qrow->Price * $qrow-> Cols * $qrow->Inchs  );            
            // $this->xlsWriteLabel( $row, 23,   $qrow->Price * $qrow-> Cols * $qrow->Inchs *3 );			
			// $this->xlsWriteLabel( $row, 24,   $qrow->Keyword );
            // $row++;
            // $i++;
        // }

        // $this->xlsEOF();
        // exit();
    // }
	
	
    public function generatexl ($Date=NULL, $Date1=NULL , $MediaId=NULL, $PublicationId=NULL, $BrandName=NULL, $ProductName=NULL, $Keyword=NULL)
    {
		$this->load->library('excel');

        // $qr= $this->newsreport_model->get_all_query_row($Date, $Date1, $MediaId, $PublicationId,$BrandName, $ProductName,$Keyword);
		
		$object = new PHPExcel();
		
		$object->setActiveSheetIndex(0);
		
		$table_columns = array('Date','Media Name','Publication Name','Publication Type','Publication Place','Publication Frequency','Publication Language','Brand','subBrand','Company','Product Category','Product','Caption','News Type','News Category','Page Number','Page','Position','Hue','Column','Inche','Column X Inch','Cost(BDT)','PR Values (BDT)','Keywords');
		$column = 0;
		
		foreach ($table_columns as $field)
		{
			$object->getActiveSheet()->setCellValueByColumnAndRow($column,1,$field);
			$column++;
		}

        $Date =$this->common_model->dateformat($Date);
        $Date1=$this->common_model->dateformat($Date1) ;
        $data['all_info'] = $this->newsreport_model->get_all_query_row($Date,$Date1,$MediaId,$PublicationId,$BrandName,$ProductName,$Keyword);
		
		// print_r($data['all_info']);
		// exit();
		$excel_row = 2;
    
		foreach ($data['all_info'] as $element)
		{
		  $object->getActiveSheet()->setCellValueByColumnAndRow(0,$excel_row,$element->Date);
		  $object->getActiveSheet()->setCellValueByColumnAndRow(1,$excel_row,$element->MediaId);
		  $object->getActiveSheet()->setCellValueByColumnAndRow(2,$excel_row,$element->PublicationName);
		  $object->getActiveSheet()->setCellValueByColumnAndRow(3,$excel_row,$element->PublicationType);
		  $object->getActiveSheet()->setCellValueByColumnAndRow(4,$excel_row,$element->PublicationPlace);
		  $object->getActiveSheet()->setCellValueByColumnAndRow(5,$excel_row,$element->PublicationFreq);
		  $object->getActiveSheet()->setCellValueByColumnAndRow(6,$excel_row,$element->PublicationLan);
		  $object->getActiveSheet()->setCellValueByColumnAndRow(7,$excel_row,$element->BrandName);
		  $object->getActiveSheet()->setCellValueByColumnAndRow(8,$excel_row,$element->subBrand);
		  $object->getActiveSheet()->setCellValueByColumnAndRow(9,$excel_row,$element->Company);
		  $object->getActiveSheet()->setCellValueByColumnAndRow(10,$excel_row,$element->ProductName);
		  $object->getActiveSheet()->setCellValueByColumnAndRow(11,$excel_row,$element->ProductCatName);
		  $object->getActiveSheet()->setCellValueByColumnAndRow(12,$excel_row,$element->Caption);
		  $object->getActiveSheet()->setCellValueByColumnAndRow(13,$excel_row,$element->NewstypeName);
		  $object->getActiveSheet()->setCellValueByColumnAndRow(14,$excel_row,$element->outlook);
		  $object->getActiveSheet()->setCellValueByColumnAndRow(15,$excel_row,$element->PageNo);
		  $object->getActiveSheet()->setCellValueByColumnAndRow(16,$excel_row,$element->PageId);
		  $object->getActiveSheet()->setCellValueByColumnAndRow(17,$excel_row,$element->PositionName);
		  $object->getActiveSheet()->setCellValueByColumnAndRow(18,$excel_row,$element->HueName);
		  $object->getActiveSheet()->setCellValueByColumnAndRow(19,$excel_row,$element->Cols);
          $object->getActiveSheet()->setCellValueByColumnAndRow(20,$excel_row,$element->Inchs);
		  $object->getActiveSheet()->setCellValueByColumnAndRow(21,$excel_row,$element->Cols * $element->Inchs);
		  $object->getActiveSheet()->setCellValueByColumnAndRow(22,$excel_row,$element->Price * $element->Cols * $element->Inchs);
		  $object->getActiveSheet()->setCellValueByColumnAndRow(23,$excel_row,$element->Price * $element->Cols * $element->Inchs * 3);
		  $object->getActiveSheet()->setCellValueByColumnAndRow(24,$excel_row,$element->Keyword);
		  
		  $excel_row++;
		}
        
        $object_writer = PHPExcel_IOFactory::createWriter($object,'Excel5');
        header('Content-type: application/vnd.ms-excel');
        
        $file_names = 'expoert_'.date("d/m/Y/H/i/s");
        header('content-disposition: attachment;filename='.$file_names.'.xls');
        
        // header('Cache-Control: max-age=0');
        $object_writer->save('php://output');
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


    public function download2($Date=NULL, $Date1=NULL , $MediaId=NULL, $PublicationId=NULL,$BrandName=NULL,$ProductName=NULL, $Keyword=NULL)
    {

        $where = "";
        $Media = $this->getname('media', $MediaId);
        $publication = $this->getname('publication', $PublicationId);
        $Brand =$this->getname('brand',$BrandName);


        $keyword =$this->getname('keyword',$Keyword);

        $Product =$this->getname('product',$ProductName);


        if ($Media != "1") {
            $where .= " and  MediaId='$Media'";
        }
        if ($publication != "1") {
            $where .= " and  PublicationName='$publication' ";
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






        $data = $this->db->query("SELECT Image FROM dataentryreport where State='1'" . $where)->result();



      //  echo("<pre>");  
	//print_r($data);
      // die();



        if ($data) {

            foreach ($data as $datas) {
                //echo  $datas->Image;

                $destt = 'C:/xampp/htdocs/media/addtrack_all/images/';

                $file = ($destt . $datas->Image);


                $to_file = ($destt . 'download/' . $datas->Image);


                copy($file, $to_file);


            }


            // Get real path for our folder
            $rootPath = realpath('C:/xampp/htdocs/media/addtrack_all/images/download');

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


            $zip->close();


        }


        function SureRemoveDir($dir, $DeleteMe) {
            $dir ='C:/xampp/htdocs/media/addtrack_all/images/download';
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




        redirect('http://localhost/media/addtrack_all/index.php/newsreport');


    }


}


?>