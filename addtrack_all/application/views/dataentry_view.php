<?php include("include/header.php"); ?>
<?php include("include/topmenu.php"); ?>
<?php //include("include/leftmenu.php"); ?>
<?php $controller = "dataentry"; ?>

<?php $msg = ''; ?>

<script>
	//reza::::::::::::::::::::::::::::::
	$(document).keypress(function(event){
		
		if(event.keyCode == 13){
			$("#Enter").click();
		}
	});
</script>

<script>
  $(document).ready(function(){
    $('#keyword1').multiselect({
      nonSelectedText: 'Select Keywords',
      enableFiltering: true,
      enableCaseInsensitiveFiltering: true,
      buttonWidth: '95px',
    });
  });
</script>	

<script>
	$().ready(function () {
		
		
		$('#BatchId').focus();
		$("#Date").datepicker({dateFormat: 'dd/mm/yy'});
		
		$('#MediaId').change(function () {
			$.post("<?php echo base_url()?>index.php/<?php echo $controller?>/getallpublication/", {'media': $('#MediaId').val()}, function (data) {
				
				if (data) {
					$('#ptype').html(data);
				}
				
			})
		})
		
	})
	
	
	function addrow() {
		$('#addmore').hide();
		var i = $('#tab').find('tr').size();
		// alert($('#tab').find('tr').size());
		$('#rowcount').val(i);
		$.post('<?php echo base_url()?>index.php/<?php echo $controller?>/addmorerow/' + $('#rowcount').val(), {}, function (data) {
			if (data) {
				
				var j = parseInt(i);
				var next = j + 1;
				$('#rowcount').val(next);
				$('#tr' + j).after(data);
				$('#Caption' + next).focus();
				$("select").chosen({no_results_text: "No results matched"});
				$('#addmore').show();
			}
			
		})
		$(".a").chosen({no_results_text: "No results matched"});
	}

	function removerow() {
		
		var i = parseInt($('#rowcount').val());
		if (i > 1) {
			var next = i - 1;
			$('#rowcount').val(next);
			$('#tr' + i).remove();
			
		}
		else {
			alert("You Cannot Delete This Row");
		}
		
	}
	
	
	function isNumberKey(evt) {
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))
		return false;
		
		return true;
	}
	
	
	function validation() {
		if ($('#BatchId').val() == '') {
			alert('Please enter Batch');
			$('#BatchId').focus();
			return false;
		}
		if ($('#MediaId').val() == '0') {
			alert('Please enter Media');
			$('#MediaId').focus();
			return false;
		}
		if ($('#PublicationId').val() == '0') {
			alert('Please enter Publication');
			$('#PublicationId').focus();
			return false;
		}
		if ($('#Date').val() == '') {
			alert('Please enter Date');
			$('#Date').focus();
			return false;
		}
		if ($('#ProductId').val() == '0') {
			alert('Please enter Product');
			$('#ProductId').focus();
			return false;
		}
		if ($('#Company').val() == '0') {
			alert('Please enter Company');
			$('#Company').focus();
			return false;
		}
		if ($('#Caption').val() == '') {
			alert('Please enter Caption');
			$('#Caption').focus();
			return false;
		}
		if ($('#PriceId').val() == '0') {
			alert('Please enter Price');
			$('#PriceId').focus();
			return false;
		}
		if ($('#PageId').val() == '0') {
			alert('Please enter Page');
			$('#PageId').focus();
			return false;
		}
		if ($('#Cols').val() == '') {
			alert('Please enter Columns');
			$('#Cols').focus();
			return false;
		}
		if ($('#Inchs').val() == '') {
			alert('Please enter Inchs');
			$('#Inchs').focus();
			return false;
		}
		
	}
	
</script>

<div class="span12" id="content">
	<div class="row-fluid">
		<div class="navbar">
			<div class="navbar-inner">
				<ul class="breadcrumb">
					<i class="icon-chevron-left hide-sidebar"><a href='#' title="Hide Sidebar" rel='tooltip'>
					&nbsp;</a></i>
					<i class="icon-chevron-right show-sidebar" style="display:none;"><a href='#'
						title="Show Sidebar"
					rel='tooltip'>&nbsp;</a></i>
					
					<!------  Page Title  -------->
					<li><a href="<?php echo  base_url() ?>index.php/welcome/index">Home</a><span class="divider">/</span>
					</li>					
					<!------  Page Title  end  -------->					
				</ul>
			</div>
		</div>
	</div>
	<!------  massage  -------->
	
	<?php if ($msg == 1) { ?>
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<h4>Success</h4>
			The operation completed successfully
		</div>
        <?php } else if ($msg == 2) { ?>
		
		<div class="alert alert-error">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<h4>Error</h4>
			Operation was not successful
		</div>
		
        <?php }
		
		
	?>
	<!------  massage end  -------->	
	
	<div class="row-fluid">
		<!-- <div class="span8" style="width:100%"> -->
			<div class="block">
				<div class="navbar navbar-inner block-header"></div>
				<div class="block-content collapse in">
					<!------  Page  Data Entry  Table   -------->					
					<?php
						if ($operation == 'add')
						{
					?>
					<form method="post" action="<?php echo  base_url() ?>index.php/<?php echo $controller ?>/add" enctype="multipart/form-data">
						<table class="table table-striped table-bordered" width="100%">
							<!-----  insert tr here      ------->
							<tr>
								<td>Batch Id</td>
								<td>
									<?php
									$batch = $this->dataentry_model->getmaxbatch();
									?>
									<input type='text' name='Batch' value='<?php echo  $batch ?>' maxlength='50' tabindex='1' id='Batch'/>
								</td>
							</tr>

							<tr>
								<td>Date</td>
								<td>
									<input type='text' name='Date' value='<?php echo  date('d/m/Y') ?>' maxlength='50' tabindex='2' id='Date'/>
								</td>
							</tr>

							<tr>
								<td>Media</td>
								<td>
									<?php echo  form_dropdown('MediaId', $array, '0', " tabindex='3', id='MediaId' class='datain_1' "); ?>
								</td>
							</tr>

							<tr>
								<td>Publication</td>
								<td id="ptype">
									<?php echo  form_dropdown('PublicationId', array('0' => "Select"), '0', " tabindex='4', id='PublicationId'"); ?>
								</td>
							</tr>
						</table>

						<table class="table table-striped table-bordered" border="1px" width="100%">
							<thead>
								<tr><th colspan="15"><h3>Data Entry Details</h3></th></tr>
								<tr>
									<th>SL</th>
									<th>Caption</th>
									<th>News Types</th>
									<th>News Category</th>
									<th>Page Name</th>
									<th>Page No</th>
									<th>Position</th>
									<th>Hue</th>
									<!-- <td>Product</td> -->
									<th>product</th>
									<th colspan="3">Colum X Inch</th>
									<th>SubBrand</th>
									<!-- <td>Company</td> -->
									<th>Keyword</th>
									<th colspan="2">Image</th>
								</tr>
							</thead>

							<tbody id="tab">
								<tr id="tr1">
									<td>1</td>
									<td>
										<input tabindex="5" name="Caption1" id="Caption1" type="text" value="" size="2100" style="width:100px"/>
									</td>

									<td>
										<?php echo form_dropdown('NewstypeId1', $ntypearray, '0', "tabindex='6'  class='a' id='NewstypeId1' style='width:80px' "); ?> 
									</td>

									<td>
										<?php echo form_dropdown("outlook1", $outlook, 0, " id='outlook1' tabindex='7' class='a' style='width:80px'  "); ?>
									</td>

									<td>
										<?php echo form_dropdown('PageId1', $paarray, '0', "tabindex='8'  class='a'  id='PageId1' style='width:100px'"); ?>
									</td>

									<td>
										<select tabindex="9" name="PageNo1" id="PageNo" style="width:50px">
											<?php
											for ($i=1; $i<=700;$i++)
											{
												?>
												<option value="<?php echo $i?>">
													<?php echo $i?>
												</option>
												<?php
											}
											?>
										</select>
									</td>


									<td style="width:15px">
										<input type="text" name="PositionName1" id="PositionName1" style="width:30px"  tabindex="10"/> 
									</td>

									<td>
										<?php echo form_dropdown("Hue1", $harray, 0, " id='Hue1' tabindex='11' class='a' style='width:80px'  "); ?>
									</td>

									<td>
										<?php echo form_dropdown('ProductId1', $pcatarray, '0',  "tabindex='12' class='a' id='ProductId1' style='width:95px' "); ?>
									</td>

									<td>
										<input name="Cols1" id="Cols1" type="text" value="" tabindex="13" style="width:20px"/>
									</td>

									<td>X</td>

									<td>
										<input name="Inchs1" id="Inchs1" type="text" value="" tabindex="14" style="width:20px"/>
									</td>

									<td> 
										<?php echo form_dropdown('subBrandId1', $carray, '0',  "tabindex='15' class='a' id='subBrandId1' style='width:95px'"); ?>
									</td>

									<td>
										<?php echo form_dropdown("Keyword1", $karray, 0, " id='Keyword1' tabindex='16' class='a' style='width:95px'  "); ?>
									</td>

<!-- 									<td>
										<div class="form-group">
											<?php echo form_dropdown("keyword1[]", $karray, 0, "id='keyword1' tabindex='16' multiple class='form-control'"); ?>
										</div>
									</td> -->

									<td>
										<input name="Image1" id="Image1" type="file" value="" tabindex="17" size="5" style="width: 185px;" />
									</td>
								</tr>
							</tbody>

							<tfoot>

								<tr id="addmore">
									<td colspan="15" align="left">
										<a  style="cursor:pointer" id="Enter" tabindex="18" onclick="addrow()">Add More</a> || 
										<a  style="cursor:pointer"   onclick="removerow()">Remove</a>
										<input type="hidden" id="rowcount" name="rowcount" value="1" />
									</td>													
								</tr>
								<!-----  end of insert tr here      ------->

								<tr>
									<td  colspan="15" align="center" >
										<p>  								 
											<input type="submit" tabindex="19" value="Save" onclick="return validation()" class="btn btn-primary" />
											<input type="reset" value="Reset" tabindex="20
											"    class="btn btn-danger" />
										</p>
									</td>
								</tr>
							</tfoot>
						</table>
					</form>
					<?php } ?>
					
					<?php
						if ($operation == 'edit')
						{
					?>
							<form method="post" action="<?php echo  base_url() ?>index.php/<?php echo  $controller ?>/edit_ac/<?php echo  $Eid ?>" enctype="multipart/form-data">
								<table class="table table-striped table-bordered" width="100%">
									<tr>
										<td width="24%">Batch Id</td>
										<td width="76%">
											<input type='text' name='Batch' value='<?php echo  $BatchId ?>' maxlength='50'
											tabindex='1' id='Batch'/>
										</td>
									</tr>

									<tr>
										<td>Date</td>
										<td>
											<input type='text' name='Date' value='<?php echo  $Date ?>' maxlength='50'
											tabindex='2' id='Date'/>
										</td>
									</tr>

									<tr>
										<td>Media</td>
										<td>
											<?php echo  form_dropdown('MediaId', $array, $MediaId, " tabindex='3', id='MediaId' class='datain_1' "); ?>
										</td>
									</tr>

									<tr>
										<td>Publication</td>
										<td id="ptype">
											<?php echo  form_dropdown('PublicationId', $pbarray, $PublicationId, " tabindex='4', id='PublicationId'"); ?>
										</td>
									</tr>
								</table>

								<table class="table table-striped table-bordered" width="100%">
									<thead>
										<tr>
											<th colspan="15"><h3>Data Entry Details</h3></th>
										</tr>
										<tr>
											<th>SL</th>
											<th>Caption</th>
											<th>News Types</th>
											<th>News Category</th>
											<th>Page Name</th>
											<th>Page No</th>
											<th>Position</th>
											<th>Hue</th>
											<th>Product</th>
											<th colspan="3"><strong>Colum X Inch</strong></th>
											<th>SubBrand</th>
											<th>Keyword</th>
											<th colspan="2">Image</th>
										</tr>										
									</thead>

									<tbody id="tab">
								<?php
									$eres = $this->dataentry_model->getdatails($Eid);
									$i = 1;
									foreach ($eres as $row)
									{
								?>
										<tr id="tr<?php echo  $i ?>">
											<td width="42"><?php echo  $i ?></td>

											<td width="100">
												<input tabindex="5" name="Caption<?php echo  $i ?>"id="Caption<?php echo  $i ?>" type="text"
												value="<?php echo  $row->Caption ?>" size="20"
												style="width:100px"/>
											</td>

											<td width="40"> 
												<?php echo  form_dropdown('NewstypeId' . $i, $ntypearray, $row->NewstypeId, "tabindex='7'  class='a'   id='NewstypeId$i' "); ?>
											</td>

											<td width="25">
												<?php echo  form_dropdown("outlook$i", $outlook, $row->outlook, " id='outlook$i' tabindex='6' class='a' style='width:100px'  "); ?>
											</td>

											<td width="40"> 
												<?php echo  form_dropdown('PageId' . $i, $paarray, $row->PageId, "tabindex='8' class='a' id='PageId$i' style='width:150px'"); ?>
											</td>

											<td width="52">
												<?php
												for($p=1;$p<=700;$p++)
												{
													$arr[$p]=$p;
												}
												echo form_dropdown('PageNo'.$i, $arr,$row->PageNo ,"tabindex='9'  class='a'  id='PageNo".$i."'")
												?>
											</td>

											<td width="104">
												<input name="PositionName<?php echo  $i ?>" type="text" style="width:100px " value="<?php echo  $row->PositionName ?>" id="PositionName<?php echo  $i ?>" size="8" tabindex="10"/>
											</td>

											<td width="25">
												<?php echo  form_dropdown("Hue$i", $harray, $row->HueId, " id='Hue$i' tabindex='11' class='a' style='width:100px'  "); ?>
											</td>

											<td width="25">
												<?php echo  form_dropdown("ProductId".$i, $pcatarray, $row->ProductId, " id='ProductId1" . "' tabindex='12' class='a' style='width:100px'  "); ?>
											</td>

											<td width="65">
												<input name="Cols<?php echo  $i ?>" id="Cols<?php echo  $i ?>" type="text" value="<?php echo  $row->Cols ?>" tabindex="13" style="width:10px"/>
											</td>

											<td width="41">X</td>

											<td width="67">
												<input name="Inchs<?php echo  $i ?>" id="Inchs<?php echo  $i ?>" type="text" value="<?php echo  $row->Inchs ?>" tabindex="14" style="width:10px"/>
											</td>


											<td width="174">
												<?php echo  form_dropdown('subBrandId'.$i, $carray, $row->subBrandId, '0', "tabindex='15' class='a' id='subBrandId1'"); ?>
											</td>

											<td width="25">
												<?php echo  form_dropdown("Keyword$i", $karray, $row->Keyword, " id='Keyword$i' tabindex='16' class='a' style='width:100px'  "); ?>
											</td>

											<td width="100"><input name="Image<?php echo  $i ?>" id="Image<?php echo  $i ?>"
												type="file" value="" tabindex="17"
												size="5"/>
											</td>
										</tr>
									</tbody>

									<tfoot>
								<?php
										$i++;
									}
								?>
										<tr id="addmore">
											<td colspan="15" align="left">
												<a href="#"  onclick="addrow()">Add More</a>/ <a href="#" onclick="removerow()">Remove</a>
											</td>
											<input type="hidden" id="rowcount" name="rowcount" value="<?php echo $i-1?>" />
										</tr>
											<!-----  end of insert tr here      ------->
										<tr>
											<td  colspan="15" align="center" >
												<p>  								 
													<input type="submit" tabindex="100000000" value="Save" onclick="return validation()" class="btn btn-primary" />
													<input type="reset" value="Reset" tabindex="100000001"    class="btn btn-danger" />
												</p>
											</td>
										</tr>
									</tfoot>
								</table>							
							</form>
					<?php } ?>
					
					<!------  Page  Data Entry  Table end   -------->
				</div>
			</div>
			<!-- /block -->
		<!-- </div> -->
		<!-- /span8 -->
	</div>
	
	<div class="row-fluid">
		<div class="span12">
			<!-- block -->
			<div class="block">
				<div class="navbar navbar-inner block-header">
					<div class="muted pull-left">View</div>
					
					<div class="pull-right">
						<span class="badge badge-info">Total Record: <?php echo  $totalrow ?></span>
					</div>
				</div>
				
				<div class="block-content collapse in">
					<form method="post" action="<?php echo  base_url() ?>index.php/<?php echo  $controller ?>/index/">
						<table class="table table-striped" width="100%">
							<tr>
								<td><input type="text" value="<?php echo  $search == '_' ? '' : $search; ?>" name="search"
									placeholder="Search Text" id="search"/> <input class="btn btn-success"
									type="submit"
									value="Search"
									style="margin-bottom:10px;">
								</td>
							</tr>
						</table>
					</form>
					<!------   View  Table   -------->
					
					<form method="post" action="<?php echo  base_url() ?>index.php/<?php echo  $controller ?>/delete/">
						<table class="table table-striped" border="0px" id="table" width="100%">
							<thead>
								<tr>
									<th>SL</th>
									<th><input type="checkbox" name="chk_all" id="chk_all" value="checkbox"
									onclick="checkall()"></th>
									<th>Batch</th>
									<th>Date</th>
									<th>Media Name</th>
									<th>Caption</th>
									<th >Actions</th>
								</tr>
							</thead>
							
							<tbody>
						<?php
							$i = 1;
							foreach ($result as $row)
							{
						?>
								<tr>
									<td><?php echo  $sl; ?></td>
									<td><input type="checkbox" name="chk_<?php echo  $i ?>" id="chk_<?php echo  $i ?>"
									value="<?php echo  $row->Id; ?>"></td>
									<td><?php echo  $row->BatchId ?> </td>
									<td><?php echo  $row->Date ?> </td>
									<td ><?php echo  $row->MediaName; ?></td>
									<td ><?php echo  $row->Caption; ?></td>
									<td>
										<p>
											<a href="<?php echo  base_url() ?>index.php/<?php echo  $controller ?>/edit/<?php echo  $row->Id ?>"
											class="btn btn-info"> Edit </a>
											<a href="<?php echo  base_url() ?>index.php/<?php echo  $controller ?>/delete/<?php echo  $row->Id ?>"
											class="btn btn-warning" onclick="return confirm('Are you sure want to delete?')">Delete</a>
										</p>
									</td>
								</tr>
						<?php
								$i++;
								$sl++;
							}
						?>
								<tr>
									<!-- <td>&nbsp;</td> -->
									<td colspan="7">
										
										<input type="hidden" value="<?php echo  $i ?>" id="allvalue" name="allvalue"/>
										<input class="btn btn-danger" type="submit" value="Delete" onclick="return deletecheck('Please select at least one checkbox')">
										<div class="pagination pagination-centered">
											<?php echo $this->pagination->create_links(); ?>
										</div>
									</td>									
								</tr>
								<!--                                <tr>-->
								<!--                                    <td>&nbsp;</td>-->
								<!--                                    <td colspan="8">-->
								<!---->
								<!--                                        <input type="hidden" value="-->
								<?php //= $i ?><!--" id="allvalue" name="allvalue"/>-->
								<!--                                        <input class="btn btn-danger" type="submit" value="Delete"-->
								<!--                                               onclick="return deletecheck('Please select at least one checkbox')">-->
								<!--                                        <div class="pagination pagination-centered">-->
								<!--                                            --><?php // echo $this->pagination->create_links(); ?>
								<!--                                        </div>-->
								<!--                                    </td>-->
								<!---->
								<!--                                </tr>-->
							</tbody>
						</table>
					</form>
					<!------   View  Table   -------->
				</div>
			</div>
			<!-- /block -->
		</div>
		<div class="span6">
			<!-- block -->
			<!-- /block -->
		</div>
	</div>
</div>

<?php
	include("include/footer.php");
?>																																																																																						