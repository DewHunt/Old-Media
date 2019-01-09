<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');


	class ShowNewsAlert extends CI_Controller {
		
		public function __construct()
		{
			parent::__construct();
	        $this->load->model('ShowNewsAlertModel', '', TRUE);
	        $this->load->library('zip');
	        $this->load->helper('file');
	        $this->load->helper('download');
	        if ($this->session->userdata('login') != TRUE)
	        {
	            redirect('user/index/1');
	        }
		}    
	         
	    public function index($msg = NULL, $Date = NULL, $Date1 = NULL, $MediaId = NULL, $SubBrandId = NULL, $Keyword = NULL, $BrandName = NULL, $ProductId = NULL, $setext=NULL, $limit=NULL)
	    {

	        $Date = isset($_POST['Date']) ? $this->input->post('Date') : $Date;
	        $Date1 = isset($_POST['Date1']) ? $this->input->post('Date1') : $Date1;
	        $MediaId = isset($_POST['MediaId']) ? $this->input->post('MediaId') : $MediaId;
	        $BrandName = isset($_POST['BrandName']) ? $this->input->post('BrandName') : $BrandName;
	        $SubBrandName = isset($_POST['SubBrandId']) ? $this->input->post('SubBrandId') : $SubBrandId;
	        $Keyword = isset($_POST['Keyword']) ? $this->input->post('Keyword') : $Keyword;
	        $ProductId = isset($_POST['ProductId']) ? $this->input->post('ProductId') : $ProductId;

	        $search = isset($_POST['search'])?$this->input->post('search'):$setext; 
		    $search = $search==""?'_':$search;
		    $totalrow = $this->ShowNewsAlertModel->rowCounter(addslashes($search));
		    $config['base_url'] = base_url().'index.php/ShowNewsAlert/index/_/'.$search.'/';
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
			if($limit=="_"||$limit=="" )
			{
				$limit=0;
			}
			$this->pagination->initialize($config);

	        $array = array(
	            'msg' => $msg,
	            'title' => 'News Alert ',
	            'result' => $this->ShowNewsAlertModel->getDateFormate($Date, $Date1, $MediaId, $SubBrandId, $BrandName, $ProductId,$Keyword),
	            'allInfo' => $this->ShowNewsAlertModel->getAllInfo($limit,addslashes($search)),
				'sl' =>$limit==0?1:$limit,
				'totalrow' =>  $totalrow,
	            'operation' => 'add',
	            'SubBrandId' => $SubBrandId,
	            'ProductId'=>$ProductId,
	            'MediaId' => $MediaId,
	            'BrandName'=>$BrandName,
	            'Keyword'=>$Keyword,
	            'array' => $this->common_model->dropdownvalue('media', 'Name', 0),
	            'carray' => $this->common_model->dropdownvalue('Brand', 'Name', 0),
	            'karray' => $this->common_model->dropdownvalue('keyword', 'Name', 0),
	            'poarray' => $this->common_model->dropdownvalue('product', 'Name', 0),
	            'subarray' => $this->common_model->dropdownvaluenull('subbrand', 'Name', " BrandId='$SubBrandId' "),
	            'a' => array('0' => 'Select'),
	            'Date' => $this->common_model->getdateformat($Date),
	            'Date1' => $this->common_model->getdateformat($Date1),
	        );
	    	$this->load->view('shownewsalert_view',$array);
	    }

	    public function searchInfo($Date = NULL, $Date1 = NULL, $MediaId = NULL, $SubBrandId = NULL, $msg = NULL, $Keyword = NULL, $BrandName = NULL, $ProductId = NULL, $setext=NULL, $limit=NULL)
	    {

	        $Date = isset($_POST['Date']) ? $this->input->post('Date') : $Date;
	        $Date1 = isset($_POST['Date1']) ? $this->input->post('Date1') : $Date1;
	        $MediaId = isset($_POST['MediaId']) ? $this->input->post('MediaId') : $MediaId;
	        $BrandName = isset($_POST['BrandName']) ? $this->input->post('BrandName') : $BrandName;
	        $SubBrandId = isset($_POST['SubBrandId']) ? $this->input->post('SubBrandId') : $SubBrandId;
	        $Keyword = isset($_POST['Keyword']) ? $this->input->post('Keyword') : $Keyword;
	        $ProductId = isset($_POST['ProductId']) ? $this->input->post('ProductId') : $ProductId;

            $search=isset($_POST['search'])?$this->input->post('search'):$setext; 
		    $search=$search==""?'_':$search;
		    $totalrow=$this->ShowNewsAlertModel->rowCounter(addslashes($search));
		    $config['base_url'] = base_url().'index.php/ShowNewsAlert/index/_/'.$search.'/';
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
			if($limit=="_"||$limit=="" )
			{
				$limit=0;
			}
			$this->pagination->initialize($config);

	        $array = array(
	            'msg' => $msg,
	            'title' => 'News Alert ',
	            'result' => $this->ShowNewsAlertModel->getDateFormate($Date, $Date1, $MediaId, $SubBrandId, $BrandName, $ProductId, $Keyword),
	            'allInfo' => $this->ShowNewsAlertModel->getAllInfo($limit,addslashes($search)),
	            'searchInfo' => $this->ShowNewsAlertModel->searchInfo(),
				'sl' =>$limit==0?1:$limit,
				'totalrow' =>  $totalrow,
	            'operation' => 'add',
	            'SubBrandId' => $SubBrandId,
	            'ProductId'=>$ProductId,
	            'MediaId' => $MediaId,
	            'BrandName'=>$BrandName,
	            'Keyword'=>$Keyword,
	            'array' => $this->common_model->dropdownvalue('media', 'Name', 0),
	            'carray' => $this->common_model->dropdownvalue('Brand', 'Name', 0),
	            'karray' => $this->common_model->dropdownvalue('keyword', 'Name', 0),
	            'poarray' => $this->common_model->dropdownvalue('product', 'Name', 0),
	            'subarray' => $this->common_model->dropdownvaluenull('subbrand', 'Name', " BrandId='$SubBrandId' "),
	            'a' => array('0' => 'Select'),
	            'Date' => $this->common_model->getdateformat($Date),
	            'Date1' => $this->common_model->getdateformat($Date1),
	        );
	        
	    	$this->load->view('shownewsalert_view',$array);
	    }     
	}
?>
