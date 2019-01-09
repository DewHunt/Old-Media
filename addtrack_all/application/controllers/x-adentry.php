<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class adentry extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('adentry_model','',TRUE);
        if($this->session->userdata('login')!=TRUE){ redirect('user/index/1');}
    }

    public function index($msg=NULL,$batid=NULL,$setext=NULL,$limit=NULL)
    {
        $search=isset($_POST['search'])?$this->input->post('search'):$setext;
        $search=$search==""?'_':$search;
        $totalrow=$this->adentry_model->get_all_query_row_countall(addslashes($search));
        $config['base_url'] = base_url().'index.php/adentry/index/_/'.$search.'/';
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
        if($batid==NULL){$bat=$this->adentry_model->getmaxbatch(); } else {$bat=$batid; }

        $array=array(
            'msg' => $msg,
            'title' => 'Add adentry Type',
            'result' => $this->adentry_model->get_all_query_row($limit, addslashes($search)),
            'sl' => $limit == 0 ? 1 : $limit,
            'totalrow' => $totalrow,
            'operation' => 'add',
            'search' => $search,
            'array' => $this->common_model->dropdownvalue('media', 'Name', 0),
            'paarray' => $this->common_model->dropdownvalue('page', 'Name', 0),
            'poarray' => $this->common_model->dropdownvalue('product', 'Name', 0),
            'pbarray' => $this->common_model->dropdownvalue('publication', 'Name', 0),
            'pricearray' => $this->common_model->dropdownvalue('price', 'Name', 0),
            'carray' => $this->common_model->dropdownvalue('Brand', 'Name', 0),
            'harray' => $this->common_model->dropdownvalue('hue', 'Name', 0),
            'ntypearray' => $this->common_model->dropdownvalue('newstype', 'Name', 0),
            'placarray' => $this->common_model->dropdownvalue('position', 'Name', 0),
            'pcatarray' => $this->common_model->dropdownvalue('product_cat', 'Name', 0),
            'plac' => $this->common_model->dropdownvalue('placing', 'Name', 0),
            'pltype' => $this->common_model->dropdownvalue('placingtype', 'Name', 0),
            'cap' => $this->common_model->dropdownvalue('adinfo', 'Title', 0),
            'a' => array('0' => 'Select')

        );
        $this->load->view('adentry_view',$array);
    }

    public function add()
    {

        $inser_id= $this->adentry_model->insert_mgt();
        $batid=$this->input->post("BatchId");
        if($inser_id==1)
        {
            redirect('adentry/index/1/'.$batid);
        }
        else
        {
            redirect('adentry/index/2');

        }


    }
    function edit($Eid=NULL,$msg=NULL,$setext=NULL,$limit=NULL)
    {
        $search=isset($_POST['search'])?$this->input->post('search'):'_';
        $totalrow=$this->adentry_model->get_all_query_row_countall(addslashes($search));
        $config['base_url'] = base_url().'index.php/adentry/index/_/'.$search.'/';
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


        $querybyid=$this->adentry_model->get_all_info_by_id($Eid);
        $BatchId='';
        $MediaId='';
        $PublicationId='';
        $Date='';



        foreach($querybyid as $rfE)
        {
            $BatchId=$rfE->BatchId;
            $MediaId=$rfE->MediaId;
            $PublicationId=$rfE->PublicationId;
            $Date=$rfE->Date;


        }


        $array=array(
            'msg' => $msg ,
            'title' =>'Edit adentry Type',
            'result' =>$this->adentry_model->get_all_query_row($limit,addslashes($search)),
            'sl' =>$limit==0?1:$limit,
            'totalrow' =>  $totalrow,
            'operation' =>'edit' ,
            'Eid' =>$Eid,
            'search'=>$search,
            'BatchId'=>$BatchId,
            'MediaId'=>$MediaId,
            'PublicationId'=>$PublicationId,
            'Date'=>$Date,
            'array'=>$this->common_model->dropdownvalue('media','Name',0),
            'paarray'=>$this->common_model->dropdownvalue('page','Name',0),
            'poarray'=>$this->common_model->dropdownvalue('product','Name',0),
            'pbarray'=>$this->common_model->dropdownvaluenull('publication','Name'," MediaId='$MediaId' "),
            'pricearray'=>$this->common_model->dropdownvalue('price','Name',0),
            'carray'=>$this->common_model->dropdownvalue('Brand','Name',0),
            'harray'=>$this->common_model->dropdownvalue('hue','Name',0),
            'ntypearray'=>$this->common_model->dropdownvalue('newstype','Name',0),
            'placarray'=>$this->common_model->dropdownvalue('position','Name',0),
            'pcatarray'=>$this->common_model->dropdownvalue('product_cat','Name',0),
            'plac'=>$this->common_model->dropdownvalue('placing','Name',0),
            'pltype'=>$this->common_model->dropdownvalue('placingtype','Name',0),
            'cap'=>$this->common_model->dropdownvalue('adinfo','Title',0),
            'a'=>array('0'=>'Select')


        );
        $this->load->view('adentry_view',$array);




    }
    function edit_ac($Eid=NULL)
    {

        $inser_id= $this->adentry_model->edit_mgt($Eid);
        if($inser_id==1)
        {
            redirect('adentry/index/1');
        }
        else
        {
            redirect('adentry/index/2');

        }

    }



    function delete($Eid=NULL)
    {


        if($Eid=="") {
            if(isset($_POST['allvalue']) ){
                for($i=0;$i<$_POST['allvalue'];$i++)
                {
                    if(isset($_POST['chk_'.$i])) {  $this->adentry_model->deleteInfo($_POST['chk_'.$i]); }
                }
            }

        }

        else{

            $this->adentry_model->deleteInfo($Eid);
        }

        redirect('adentry/index/1')	;

    }

    function getallpublication()
    {
        $media=$_POST['media'];
        $result=$this->adentry_model->getallpublication($media);
        $arr=array('0'=>'Select');
        foreach($result as $row)
        {
            $arr[$row->Id]=$row->Name;

        }

        echo  form_dropdown('PublicationId',  $arr,'0' ,"tabindex='3', id='PublicationId'");

    }


    function getallprice()
    {
        $media=$_POST['media'];
        $result=$this->adentry_model->getallprice( $media);
        $arr=array('0'=>'Select');
        foreach($result as $row)
        {
            $arr[$row->Id]=$row->Name;

        }

        echo  form_dropdown('PriceId', $arr,'0' ,"tabindex='10', id='PriceId'");

    }

    function addmorerow($i=NULL )
    {
        $array=$this->common_model->dropdownvalue('media','Name',0);
        $paarray=$this->common_model->dropdownvalue('page','Name',0);
        $poarray=$this->common_model->dropdownvalue('product','Name',0);
        $pbarray=$this->common_model->dropdownvalue('publication','Name',0);
        $pricearray=$this->common_model->dropdownvalue('price','Name',0);
        $carray=$this->common_model->dropdownvalue('Brand','Name',0);
        $harray=$this->common_model->dropdownvalue('hue','Name',0);
        $ntypearray=$this->common_model->dropdownvalue('newstype','Name',0);
        $placarray=$this->common_model->dropdownvalue('position','Name',0);
        $pcatarray=$this->common_model->dropdownvalue('product_cat','Name',0);
        $plac=$this->common_model->dropdownvalue('placing','Name',0);
        $pltype=$this->common_model->dropdownvalue('placingtype','Name',0);
        $cap=$this->common_model->dropdownvalue('adinfo','Title',0);
        $a=array('0'=>'Select');
        $next=$i+1;


        $str="<tr id=\"tr$next\"> 
        
        <td width=\"42\">$next</td>
        <td width=\"100\" ><input  tabindex=\"$next"."16\" name=\"ID$next\" id=\"ID$next\" onblur=\"loadcap($next)\" type=\"text\" value=\"\" size=\"20\"  style=\"width:30px\" /></td>
       <td width=\"100\" > ".form_dropdown("Caption$next", $cap,'0' ,"tabindex='".$next."17' onchange='loadid(".$next.")'  class='chzn-select' id='Caption$next' ")."</td>
	   
        <td width=\"41\"> ".form_dropdown("PageId$next", $paarray,'0' ,"tabindex='".$next."18'  class='a' id='PageId$next' ")."</td>
		<td width=\"52\"><select  tabindex=\"".$next."19\" name=\"pageno$next\" id=\"pageno$next\" class='a' style=\"width:50px\">
		  <option value=\"1\">1</option>
		  <option value=\"2\">2</option>
		  <option value=\"3\">3</option>
		  <option value=\"4\">4</option>
		  <option value=\"5\">5</option>
		  <option value=\"6\">6</option>
		  <option value=\"7\">7</option>
		  <option value=\"8\">8</option>
		  <option value=\"9\">9</option>
		  <option value=\"10\">10</option>
		  <option value=\"11\">11</option>
		  <option value=\"12\">12</option>
		  <option value=\"13\">13</option>
		  <option value=\"15\">14</option>
		  <option value=\"17\">16</option>
		  <option value=\"18\">18</option>
		  <option value=\"19\">19</option>
		  <option value=\"20\">20</option>
		  <option value=\"21\">21</option>
		  <option value=\"22\">22</option>
		  <option value=\"24\">23</option>
		  <option value=\"25\">25</option>
		  <option value=\"27\">26</option>
		  <option value=\"28\">28</option>
		  <option value=\"29\">29</option>
		  <option value=\"30\">30</option>
		    </select>		  </td>

        
        <td width=\"25\">".form_dropdown("placing$next",$plac,0," id='placing$next' tabindex='".$next."21' class='a' style='width:100px' ")."</td>
        

        
        
		<td width=\"25\">".form_dropdown("placingtype$next",$pltype,0," id='placingtype$next' tabindex='".$next."21' class='a' style='width:100px' ")."</td>
		
		<td width=\"25\">".form_dropdown("Hue$next",$harray,0," id='Hue$next' tabindex='".$next."21' class='a' style='width:100px' ")."</td>
               
        <td width=\"65\"><input name=\"Cols$next\" id=\"Cols$next\" type=\"text\" value=\"\"  tabindex=\"".$next."23\" style=\"width:10px\" /></td>

<td width=\"41\">X</td>
		
        <td width=\"67\"><input name=\"Inchs$next\" id=\"Inchs$next\" type=\"text\" value=\"\" tabindex=\"".$next."24\"  style=\"width:10px\" /></td>
        
         
          
      </tr>";
        echo $str;

    }

    function loadcaption($id=NULL)
    {
        $caption="";
        $res=$this->adentry_model->getallinfobyid($id);
        foreach($res as $row)
        {
            $caption=$row->Id;


        }

        echo $caption;


    }
    function getbyid($id=NULL)
    {

        echo $term = $this->input->post('term');

        if (strlen($term) < 2);

        $rows = $this->adentry_model->getadinfodatabyid( $term );

        $chcategory_title = array();
        foreach ($rows as $row)
        { array_push($chcategory_title, $row->Id);}

        echo json_encode($chcategory_title);
    }

    function getid( )
    {
        $val=$_POST['val'];

        $adid="";
        $rows = $this->adentry_model->getidbycaption( $val );
        foreach($rows as $row)
        {
            $adid=$row->AD_ID;
        }
        echo  $adid;
    }

}

?>
