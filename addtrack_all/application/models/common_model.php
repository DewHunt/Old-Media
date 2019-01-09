<?php	
	class common_model extends CI_Model
	{		
		function __construct()
		{
			parent::__construct();
			$this->load->library('session');			
		}
		
		/////load menu right////
		
		function user_activities($tbleName = NULL, $RowId = NULL, $Operation = NULL, $fieldname = NULL)
		{
			$data = array($fieldname => $RowId,
            'OD_Id' => $Operation,
            'Ip' => $this->input->ip_address(),
            'OperationBy' => $this->session->userdata("user_administaror"),
            'OperationDateTime' => date('Y-m-d H:i:s'));
			$str = $this->db->insert_string($tbleName, $data);
			$status1 = $this->db->query($str);
		}
		
		
		function getlimit($limit = NULL)
		{
			if ($limit == "")
			{
				$limitsl = 5;
			}
			else
			{
				$limitsl = $limit;
			}
			$sel1 = "";
			$sel2 = "";
			$sel3 = "";
			$sel4 = "";
			if ($limitsl == 5)
			{
				$sel1 = "selected='selected'";
			}
			else if ($limitsl == 10)
			{
				$sel2 = "selected='selected'";
			}
			else if ($limitsl == 20)
			{
				$sel3 = "selected='selected'";
			}else if ($limitsl == 50)
			{
				$sel4 = "selected='selected'";
			}
			$str = "<select id='limit' name='limit'>
			<option value='5'  $sel1 >5</option>
			<option value='10' $sel2>10</option>
			<option value='20' $sel3>20</option>
			<option value='50' $sel4>50</option>
			</select>";
			return $str;
		}
		
		function dropdownvaluenull($tablename = NULL, $field = NULL, $where = NULL)
		{
			$arry[0] = "Select";
			$w = "";
			if ($where != NULL)
			{
				$w = "and " . $where;
			}
			$str = "Select Id,$field from $tablename where State='1' " . $w;
			
			$query = $this->db->query($str);
			foreach ($query->result() as $row)
			{
				$arry[$row->Id] = $row->$field;
			}
			return $arry;
		}
		
		function get_all_post_value()
		{
			foreach ($_POST as $key => $value)
			{
				if (array_key_exists($key, $_POST))
				{
					$this->session->set_flashdata($key, $_POST[$key]);
				}
			}
		}
		
		function show_all_error_message()
		{
			$var1 = str_replace(array('<span>', '</span>'), array('', '*'), $this->session->flashdata('error'));
			$a = explode('*', $var1);
			$i = 0;
			foreach ($a as $err)
			{
				if ($err != '')
				{
					echo $err;
					break;
				}
			}
		}
		
		function dropdownvalue($table = NULL, $field = NULL, $all = NULL)
		{
			// echo "<br>".
			$str = "SELECT Id, $field FROM $table WHERE State='1' ORDER BY $field ASC";
			$query = $this->db->query($str);
			
			if ($all == "")
			{
				$all = "Select";
			}
			
			$drop[0] = "$all";
			
			foreach ($query->result() as $row)
			{
				// echo "<br>".
				$drop[$row->Id] = $row->$field;
			}
			// exit();
			
			return $drop;
		}
		
		function keyDropDownValue($table = NULL, $field = NULL, $all = NULL)
		{
			// echo "<br>".
			$str = "SELECT Id, $field FROM $table WHERE State='1' ORDER BY $field ASC";
			$query = $this->db->query($str);
			
			return $query->result();
		}
		
		function dropdownvalue12($table = NULL, $field = NULL, $all = NULL)
		{
			$str = "Select Id,$field  from  $table where State='1'";
			$query = $this->db->query($str);
			if ($all == "")
			{
				$all = "Select";
			}
			$drop[0] = "$all";
			foreach ($query->result() as $row)
			{
				$drop[$row->Name] = $row->$field;
			}
			return $drop;
		}
		
		function dropdownvalueposi($table = NULL, $field = NULL, $all = NULL, $ceid = 0)
		{
			$str = "Select Id,$field  from  $table where State='1' and Id!='$ceid' order by $field ASC";
			$query = $this->db->query($str);
			if ($all == "")
			{
				$all = "Select";
			}
			$drop[0] = "$all";
			foreach ($query->result() as $row)
			{
				$drop[$row->Id] = $row->$field;
			}
			return $drop;
		}
		
		function menufileupload($name = NULL, $prefix = NULL, $uploadfolder = NULL, $thumbs = NULL, $width = NULL, $height = NULL)
		{
			$imgname = '';
			$image = '';
			$image = $_FILES[$name]['name'];
			$file_Size = $_FILES[$name]['size'];
			if ($image)
			{
				$filename = stripslashes($_FILES[$name]['name']);
				$i = strrpos($filename, ".");
				if (!$i)
				{
					$text = 4;
				}
				$l = strlen($filename) - $i;
				$extension = substr($filename, $i + 1, $l);
				$extension = strtolower($extension);
				$imgname = $prefix . '_' . rand(0, 10000) . date('Y-m-d') . '_' . time() . '.' . $extension;
			}
			if ($image == true)
			{
				if (($extension == "jpg" || $extension == "jpeg" || $extension == "png" || $extension == "gif") || $extension == "png" || $extension == "PNG" || $extension == "GIF" || $extension == "JPG" || $extension == "JPEG" && ($file_Size > 0))
				{
					$copied = copy($_FILES[$name]['tmp_name'], $uploadfolder . '/' . $imgname);
					sleep(5);
				}
				if ($thumbs == 1)
				{
					$this->load->library('image_lib');
					$config = array();
					$config['image_library'] = 'gd2';
					$config['source_image'] = $uploadfolder . '/' . $imgname;
					$config['create_thumb'] = TRUE;
					$config['maintain_ratio'] = true;
					$config['quality'] = 100;
					$config['width'] = $width;
					$config['height'] = $height;
					
					$this->image_lib->initialize($config);
					if (!$this->image_lib->resize())
					{
						echo $this->image_lib->display_errors();
					}
					$this->image_lib->clear();
				}
			}
			return $imgname;
		}
		
		function fileupload($medialogo = NULL, $datetime = NULL, $Cols = NULL,  $Inchs = NULL, $PageId = NULL, $PageNo = NULL, $PositionId = Null,$MediaId=NULL,  $name = NULL, $prefix = NULL, $uploadfolder = NULL, $thumbs = NULL, $width = NULL, $height = NULL)
		{
			$medialogo;		
			$MediaId;		 
			$Cols;
			$Inchs;
			$PageId;
			$PageNo;
			$PositionId;
			$imgname = '';
			$image = '';
			
			// echo "Media Logo = ".$medialogo.'<br>';
			// echo "Date Time = ".$datetime.'<br>';
			// echo "Cols = ".$Cols.'<br>';
			// echo "Inchs = ".$Inchs.'<br>';
			// echo "Page Id = ".$PageId.'<br>';
			// echo "Page No = ".$PageNo.'<br>';
			// echo "Position Id = ".$PositionId.'<br>';
			// echo "Media Id = ".$MediaId.'<br>';
			// echo "Name = ".$name.'<br>';
			// echo "Prefix = ".$prefix.'<br>';
			// echo "Upload Folder = ".$uploadfolder.'<br>';
			// echo "Thumbs = ".$thumbs.'<br>';
			// echo "Width = ".$width.'<br>';
			// echo "Height = ".$height.'<br>';
			// exit();
			
			$image = $_FILES[$name]['name'];
			$file_Size = $_FILES[$name]['size'];
			if($image)
			{
				$filename = stripslashes($_FILES[$name]['name']);
				$i = strrpos($filename, ".");
				if (!$i)
				{
					$text = 4;
				}
				$l = strlen($filename) - $i;
				$extension = substr($filename, $i + 1, $l);
				$extension = strtolower($extension);
				//$imgname = $prefix . '_' . rand(0, 10000) . date('Y-m-d') . '_' . time() . '.' . $extension;
				$imgname =  date('Y-m-d') . '_' . time() . '.' . $extension;
			}
			
			if ($image == true)
			{
				if (($extension == "jpg" || $extension == "jpeg" || $extension == "swf" || $extension == "png" || $extension == "gif") || $extension == "png" || $extension == "PNG" || $extension == "GIF" || $extension == "JPG" || $extension == "JPEG" && ($file_Size > 0))
				{
					$copied = copy($_FILES[$name]['tmp_name'], $uploadfolder . '/' . $imgname);
					sleep(5);
				}
				
				if ($thumbs == 1)
				{
					$this->load->library('image_lib');
					$config = array();
					$config['image_library'] = 'gd2';
					$config['source_image'] = $uploadfolder . '/' . $imgname;
					$config['create_thumb'] = TRUE;
					$config['maintain_ratio'] = true;
					$config['quality'] = 100;
					$config['width'] = $width;
					$config['height'] = $height;
					
					$this->image_lib->initialize($config);
					if (!$this->image_lib->resize())
					{
						echo $this->image_lib->display_errors();
					}
					$this->image_lib->clear();
				}
				$media = imagecreatefrompng('logo.png');
				// $dest = imagecreatefromjpeg($uploadfolder . '/' . $imgname);
				$dest = imagecreatefromjpeg($uploadfolder . '/' . $imgname);
				
				$links = array($uploadfolder . '/' . $imgname);
				$sizearray = array();
				$count = count($links);
				
				for ($i = 0; $i < $count; $i++)
				{
					$size = getimagesize($links[$i]);
					list($width, $height) = $size;
					$sizearray[$links[$i]] = array("width" => $width, "height" => $height);
					
					$back = ImageCreate($width, $height+130);
					$black = ImageColorAllocate($back, 255, 255, 255);
					header('content-Type:image/png');
					$src = imagecreatefrompng($uploadfolder . '/' . $medialogo);
					
					$color = imagecolorallocate($back, 0, 0, 0);
					
					$font_path = 'cleanvertising.TTF';
					$text = ('Date:' . $datetime);
					$text5 = ('Prepared By:');
					
					$text1 = ('Page Number:' . $PageNo);
					$text3 = ('Page Name:' . $PageId);
					$text4 = ('Position:' . $PositionId);
					
					$text6 = ('Size:' . $Cols * $Inchs);
					
					imagettftext($back, 10, 0, 210, 40, $color, $font_path, $text);
					imagettftext($back, 10, 0, 20, 90, $color, $font_path, $text5);
					imagettftext($back, 10, 0, 210, 55, $color, $font_path, $text1);
					imagettftext($back, 10, 0, 210, 75, $color, $font_path, $text3);
					imagettftext($back, 10, 0, 210, 95, $color, $font_path, $text4);
					imagettftext($back, 10, 0, 210, 115, $color, $font_path, $text6);
					
					$im =  imagecreate (200,150);
					$blue = imagecolorallocate($im, 255, 255, 255);
					
					imagealphablending($back, false);
					imagesavealpha($back, true);               
					
					imagecopymerge($back, $src, 10, 20, 0, 0, 181, 50, 100);
					imagecopymerge($back, $media, 10, 100, 0, 0, 150, 30, 100);
					
					imagecopymerge ($back, $dest, 10, 140, 0, 0, 2500, 2500, 100);
					
					header('content-Type:image/png');
					
					$imgname = $MediaId.'_PN_'.$PageId.'_PNO_'.$PageNo.'_POS_'. $PositionId.'_SZ_'. $Cols * $Inchs.'_DT_'.date('d-m-Y_').time().'.'.$extension;
					
					// $imgname =$MediaId.$PageId .$PageNo.$PositionId . '-Date-'  .date('d-m-Y') . '_' . time() . '.' . $extension;
					// $imgname = $MediaId.'PN_'.$PageNo.date('d-m-Y_').time().'.'.$extension;
					// $imgname = $MediaId .PN.$PageId. Pno.$PageNo.date('Y-m-d') . '_' . time() . '.' . $extension;				
					
					$uniquesavename = $imgname;
					imagejpeg($back, "images/$uniquesavename");
					imagejpeg($back, "imagecopymerge/$uniquesavename");
				}
			}
			return $imgname;
		}
		
		
		function getImage($mdid = null)
		{
			$data = $this->db->query("SELECT  Image,Id FROM `media` WHERE Id='$mdid' ");
			
			$value = $data->result();
			
			if ($value)
			{
				foreach ($value as $datas)
				{
					$datas->Image;
					$medialogo = $datas->Image;
					return $medialogo;
				}
			}
			else
			{
				return false;
			}
		}
		
	    function getdate()
		{
			$date = $this->db->query("SELECT  EntrydateTime,Id FROM `dataentrydetails` WHERE Id");			
			$value = $date->result();
			
			if ($value)
			{
				foreach ($value as $dates)
				{
					$dates->EntrydateTime;
					$datetime = $dates->EntrydateTime;
					return $datetime;
				}
			}
			else
			{
				return false;
			}
		}
		
		function downloadfile($name = NULL, $prefix = NULL, $uploadfolder = NULL)
		{
			$imgname = '';
			$image = '';
			$image = $_FILES[$name]['name'];
			$file_Size = $_FILES[$name]['size'];
			if ($image)
			{
				$filename = stripslashes($_FILES[$name]['name']);
				$i = strrpos($filename, ".");
				if (!$i)
				{
					$text = 4;
				}
				$l = strlen($filename) - $i;
				$extension = substr($filename, $i + 1, $l);
				$extension = strtolower($extension);
				$imgname = $prefix . '_' . rand(0, 10000) . date('Y-m-d') . '_' . time() . '.' . $extension;
			}
			if ($image == true)
			{
				if (($extension == "doc" || $extension == "docx" || $extension == "pdf") || $extension == "DOC" || $extension == "DOCX" || $extension == "PDF" && ($file_Size > 0))
				{
					$copied = copy($_FILES[$name]['tmp_name'], $uploadfolder . '/' . $imgname);
					sleep(5);
				}
			}
			
			return $imgname;
		}
		
		function fileupload2($name = NULL, $prefix = NULL, $uploadfolder = NULL)
		{
			$imgname = '';
			$image = '';
			$image = $_FILES[$name]['name'];
			$file_Size = $_FILES[$name]['size'];
			if ($image)
			{
				$filename = stripslashes($_FILES[$name]['name']);
				$i = strrpos($filename, ".");
				if (!$i)
				{
					$text = 4;
				}
				$l = strlen($filename) - $i;
				$extension = substr($filename, $i + 1, $l);
				$extension = strtolower($extension);
				$imgname = $prefix . '_' . rand(0, 10000) . date('Y-m-d') . '_' . time() . '.' . $extension;
			}
			if ($image == true)
			{
				if (($extension == "doc" || $extension == "docx" || $extension == "pdf") || $extension == "DOC" || $extension == "DOCX" || $extension == "PDF" && ($file_Size > 0))
				{
					$copied = copy($_FILES[$name]['tmp_name'], $uploadfolder . '/' . $imgname);
					sleep(5);
				}
			}
			
			return $imgname;
		}
		
		function fileuploadvideo($name = NULL, $prefix = NULL, $uploadfolder = NULL)
		{
			$imgname = '';
			$image = '';
			$image = $_FILES[$name]['name'];
			
			$file_Size = $_FILES[$name]['size'];
			if ($image)
			{
				$filename = stripslashes($_FILES[$name]['name']);
				$i = strrpos($filename, ".");
				if (!$i)
				{
					$text = 4;
				}
				$l = strlen($filename) - $i;
				$extension = substr($filename, $i + 1, $l);
				$extension = strtolower($extension);
				$imgname = $prefix . '_' . rand(0, 10000) . date('Y-m-d') . '_' . time() . '.' . $extension;
			}
			
			if ($image == true)
			{
				$copied = copy($_FILES[$name]['tmp_name'], $uploadfolder . '/' . $imgname);
				if (($extension == "flv" || $extension == "FLV") && ($file_Size > 0))
				{
					
				}
			}
			
			return $imgname;
		}
		
		function fileuploadsmall($name = NULL, $prefix = NULL, $uploadfolder = NULL, $thumbs = NULL, $width = NULL, $height = NULL, $width1 = NULL, $height1 = NULL, $status = true)
		{
			$imgname = '';
			$image = '';
			$image = $_FILES[$name]['name'];
			$file_Size = $_FILES[$name]['size'];
			if ($image)
			{
				$filename = stripslashes($_FILES[$name]['name']);
				$i = strrpos($filename, ".");
				if (!$i)
				{
					$text = 4;
				}
				$l = strlen($filename) - $i;
				$extension = substr($filename, $i + 1, $l);
				$extension = strtolower($extension);
				$imgname = $prefix . '_' . rand(0, 10000) . date('Y-m-d') . '_' . time() . '.' . $extension;
			}
			
			if ($image == true)
			{
				if (($extension == "jpg" || $extension == "jpeg" || $extension == "png" || $extension == "gif") || $extension == "png" || $extension == "PNG" || $extension == "GIF" || $extension == "JPG" || $extension == "JPEG" && ($file_Size > 0))
				{
					$copied = copy($_FILES[$name]['tmp_name'], $uploadfolder . '/' . $imgname);
					sleep(1);
				}
				
				if ($thumbs == 1)
				{
					$this->load->library('image_lib');
					$config['image_library'] = 'gd2';
					$config['source_image'] = $uploadfolder . '/' . $imgname;
					$config['create_thumb'] = TRUE;
					$config['maintain_ratio'] = $status;
					$config['new_image'] = $uploadfolder . '/thumbs/' . $imgname;
					$config['quality'] = 100;
					$config['width'] = $width;
					$config['height'] = $height;
					
					$this->image_lib->initialize($config);
					if (!$this->image_lib->resize())
					{
						echo $this->image_lib->display_errors();
					}
					
					$this->image_lib->clear();
				}
			}
			
			return $imgname;
		}
		
		function get_between($input, $start, $end)
		{
			$substr = substr($input, strlen($start) + strpos($input, $start), (strlen($input) - strpos($input, $end)) * (-1));
			return $substr;
		}
		
		function getdateformat($date = NULL)
		{
			if (!empty($date))
			{
				$var = "";
				$var = explode('/', $date);
				$returndate = $var[2] . "-" . $var[1] . "-" . $var[0];
				return $returndate;
			}
		}
		
		function dateformat($date = NULL)
		{
			if (!empty($date))
			{
				$var = "";
				$var = explode('-', $date);
				$returndate = $var[2] . "/" . $var[1] . "/" . $var[0];
				return $returndate;
			}
		}
		
		function userlocghistory($insid = NULL, $operationid = NULL)
		{
			$where = "  MemberId='$insid' and State='1' ";
			$ustr = $this->db->update_string('userac_op_log_history', array('State' => 0), $where);
			$this->db->query($ustr);
			$data = array(
            'MemberId' => $insid,
            'Od_Id' => $operationid,
            'Type' => 'Admin',
            'OperationBy' => $this->session->userdata("user_administaror"),
            'Ip' => $this->session->userdata('ip_address'),
            'DateTime' => date('Y-m-d H:i:s'),
			);
			$str = $this->db->insert_string('userac_op_log_history', $data);
			$this->db->query($str);
		}
		
		function limit()
		{
			$data = array('5' => '5', '10' => '10', '20' => '20', '50' => '50');
			return $data;
		}
		
		function getmaxsortorder($field = NULL, $table = NULL, $statusfield = NULL, $status = NULL)
		{
			$str = "select Max($field) as maxsot  from $table where $statusfield='$status'";
			$query = $this->db->query($str);
			foreach ($query->result() as $row)
			{
				$maxsot = $row->maxsot;
			}
			return $maxsot + 1;
		}
		
		function cleanhtml($str = NULL)
		{
			$data = array('<br />', '<hr>', '<br>', '<hr />', '<p>&nbsp;</p>');
			$data1 = array("");
			$repstr = str_replace($data, $data1, $str);
			return stripslashes($repstr);
		}
		
		function unlink_file($Id, $table, $field, $upload_folder, $thumbsrem)
		{
			$file = "";
			$str = "select * from $table where Id='" . $Id . "' and State='1'";
			$query = $this->db->query($str);
			foreach ($query->result() as $row)
			{
				$file = $row->$field;
			}
			$path = $upload_folder . '/' . $file;
			
			if ($file != '')
			{
				if (file_exists($path))
				{
					chmod($path, 0777);
					unlink($path);
				}
				
				if ($thumbsrem == 1)
				{
					$thumbs = explode('.', $file);
					$th = $upload_folder . '/' . $thumbs[0] . '_thumb.' . $thumbs[1];
					if (file_exists($th))
					{
						chmod($th, 0777);
						unlink($th);
					}
				}
			}
		}
		
		function getalldata($table = NULL)
		{
			$str = "select * from $table where State='1'";
			$query = $this->db->query($str);
			return $query->result();
		}
		
		function dropdownvaluewithoutselect($tablename = NULL, $field = NULL)
		{
			$arry = "";
			$str = "Select Id,$field from $tablename where State='1' order by SortOrder asc";
			$query = $this->db->query($str);
			foreach ($query->result() as $row)
			{
				$arry[$row->Id] = $row->$field;
			}
			return $arry;
		}
		
		function get_menu_name()
		{
			$str = "select * from sysuserrightcat where State='1' order by sysuserrightcat.Order asc";
			$query = $this->db->query($str);
			return $query->result();
		}
		
		function get_sub_menu_name($id = NULL)
		{
			$str = "select * from sysuserright where State='1' and    SysUserCatId='$id' order by sysuserright.Order asc";
			$query = $this->db->query($str);
			return $query->result();
		}
		
		function dropdownvaluewhere($table = NULL, $field = NULL, $where = NULL)
		{
			$str = "Select Id,$field  from  $table where State='1' " . $where;
			$query = $this->db->query($str);
			$drop[0] = "Select";
			foreach ($query->result() as $row)
			{
				$drop[$row->Id] = $row->$field;
			}
			return $drop;
		}
	}
?>
