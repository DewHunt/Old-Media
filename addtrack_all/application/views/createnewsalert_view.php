<?php include("include/header.php");?>
<?php include("include/topmenu.php");?>
<?php include("include/leftmenu.php"); ?>
<?php $controller = "createnewsalert"; ?>

<style></style>

<script>
    $().ready(function () {
        $('#BatchId').focus();
        $("#Date").datepicker({dateFormat: 'dd/mm/yy'});
        $("#Date1").datepicker({dateFormat: 'dd/mm/yy'});
		
		$('#BrandName').change(function () {
			$.post("<?php echo base_url()?>index.php/<?php echo $controller?>/GetAllSubBrand/", {'brand': $('#BrandName').val()}, function (data) {
				
				if (data) {
					$('#subtype').html(data);
				}
				
			})
		})

        $('#btndwnload').click(function () {
            $.post("<?php echo base_url()?>index.php/<?php echo $controller?>/download/", {'hidimg': $('#hidimg').val()}, function (data) {
                if (data) {
                    // alert(data);
                    $("#a").show();
				}
			})
		})
	})
    function validation() {
        if ($('#Date').val() == '') {
            alert('Please enter Date To ');
            $('#Date').focus();
            return false;
		}
        if ($('#Date1').val() == '') {
            alert('Please enter Date From ');
            $('#Date1').focus();
            return false;
		}
		
	}
    $(document).ready(function () {
        $("#btnSubmit").click(function () {
            alert("button");
		});
	});
	
    <?php
		if(count($result) > 0)
		{ 
	?>
			$("#a").show();
	<?php
		}
	?>
</script>

<div class="span9" id="content">
	<div class="row-fluid">
		<div class="navbar">
			<div class="navbar-inner">
				<ul class="breadcrumb">
					<i class="icon-chevron-left hide-sidebar"><a href='#' title="Hide Sidebar" rel='tooltip'>&nbsp;</a></i>
					<i class="icon-chevron-right show-sidebar" style="display:none;"><a href='#' title="Show Sidebar" rel='tooltip'>&nbsp;</a></i>
					<!------  Page Title  -------->
					<li>
						<a href="<?php echo  base_url() ?>index.php/welcome/index">Home</a>
						<span class="divider">
							/ News Alert / Create News Alert</a>
						</span>
					</li>
					<!------  Page Title  end  -------->
				</ul>
			</div>
		</div>
	</div>

	<!------  massage  -------->
	<?php
		if($msg == 1)
		{
	?>
			<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<h4>Success</h4>
				The operation completed successfully
			</div>
	<?php
		}
		else if($msg == 2)
		{
	?>
			<div class="alert alert-error">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<h4>Error</h4>
				Operation was not successful</div>
	<?php
		}
	?>	
	<!------  massage end  -------->

	<div class="row-fluid" >
		<div class="span8" style="width:100%">
			<div class="block">
				<div class="navbar navbar-inner block-header">
					<h3>Create News Alert</h3>
				</div>
				<div class="block-content collapse in" align="center"  style="height:100%">
					<form method="post" action="<?php echo  base_url() ?>index.php/search-info">
						<table class="table table-bordered table-striped" width="100%">
							<!-----  insert tr here      ------->
							<thead>
								<tr>
									<th><h4>Serach News For News Alert</h4></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Date</td>
									<td>
										<input type='text' name='Date' value='<?php echo  $this->common_model->dateformat($Date); ?>' maxlength='50' tabindex='1' id='Date'/>
										To
										<input type='text' name='Date1' value='<?php echo  $this->common_model->dateformat($Date1); ?>' maxlength='50' tabindex='2' id='Date1'/>
									</td>
								</tr>
								<tr>
									<td>Media</td>
									<td>
										<?php
											echo form_dropdown('MediaId', $array, $MediaId, " tabindex='3', id='MediaId', class='datain_1', style='width: 300px;'");
										?>
									</td>
								</tr>
								<tr>
									<td>Brand</td>
									<td>
										<?php
											echo form_dropdown('BrandName', $carray, $BrandName, "tabindex='4', class='a', id='BrandName', class='datain_1' style='width: 300px;'");
										?>
									</td>
								</tr>
								<tr>
									<td>Sub Brand</td>
									<td id="subtype">
										<?php
											echo form_dropdown('SubBrandId', $subarray, "tabindex='4', id='SubBrandId', style='width: 300px;'");
										?>
									</td>
								</tr>
								<tr>
									<td>Keyword</td>
									<td>
										<?php
											echo form_dropdown('Keyword', $karray, "tabindex='14' class='a', id='Keyword', style='width: 300px;'");
										?>
									</td>
								</tr>
								<tr>
									<td>Product</td>
									<td>
										<?php
											echo form_dropdown('ProductId', $poarray, "tabindex='14' class='a', id='ProductId', style='width: 300px;'");
										?>
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<input type="submit" tabindex="100000000" value="Search" name="Search" onclick="return validation()" class="btn btn-primary"/>
									</td>
								</tr>
							</tbody>
						</table>
					</form>

					<!------  Page  Data Entry  Table   -------->        
			        <?php
			        	$Counter = 0;
			        	$text = array();
			        	if(!empty($searchInfo))
			        	{
				        	foreach ($searchInfo as $row)
				        	{
				        		$Counter++;
				        		$text[$Counter] = "<img src='".base_url()."images/$row->Image' align='left' alt='".$row->Image."' width='200px' height='200px'/>";
				        		$valueText[$Counter] = "<img src='".base_url()."images/$row->Image' align='left' alt='".$row->Image."'/>";
				        	}
			        	}

				    	$Id = "";
				    	$SummaryId = "";
				    	$Title = "";
				    	$Summary = "";
				    	$Button = 0;

				    	if (isset($allInfoById->Id))
				    	{
				    		$Id = $allInfoById->Id;
				    		$Button = 1;
				    	}

				    	if (isset($allInfoById->SummaryId))
				    	{
				    		$SummaryId = $allInfoById->SummaryId;
				    		$Button = 1;
				    	}

				    	if (isset($allInfoById->Title))
				    	{
				    		$Title = $allInfoById->Title;
				    		$Button = 1;
				    	}

				    	if (isset($allInfoById->Summary))
				    	{
				    		$Summary = $allInfoById->Summary;
				    		$Button = 1;
				    	}

				    	if ($Button == 1)
				    	{
				    		$ButtonValue = "Update Synopsis";
				    		$url = "update-info";
				    	}
				    	else
				    	{
				    		$ButtonValue = "Save Synopsis";
				    		$url = "save-info";
				    	}
				    ?>
			        <table class="table table-bordered table-hover" width="100%">
			          <thead>
			            <tr>
			              <th><h4>Title</h4></th>
			              <th><h4>View</h4></th>
			            </tr>
			          </thead>
			          <tbody>
			            <tr>
			            	<td>
				              	<form method="post" action="<?php echo base_url() ?>index.php/<?php echo $url;?>">
					              	<?php
					              		$IdCounter = 1;
					              		$info = array();
					              		if (!empty($searchInfo))
					              		{
						              		foreach ($searchInfo as $row)
						              		{
						              			echo "<input type='checkbox' name='chk[]' id='chk_".$IdCounter."' value='".$row->Id."'>";
						              			echo " <b>".$row->Caption."</b>";
						              			echo "<p>".$row->Date."</p>";
						              			echo "<p id='show".$IdCounter."' style='text-align: right;'>".$row->MediaId."</p>";
						              			$IdCounter++;
						              			echo "<hr>";
						              		}
					              		}
					              	?>
				            </td>
				            <td>
				                <div id="div-content01">This Is VIEW CELL</div>
				                <div id="div-content02">
									<!-- Trigger the modal with a button -->
									<button type='button' class='btn btn-default btn-lg' data-toggle='modal' data-target='#myModal' id="button-value" value="" onclick="myFunction()"></button>

									<!-- Modal -->
									<div class='modal fade' id='myModal' role='dialog'>
										<div class='modal-dialog modal-lg'>										
											<!-- Modal content-->
											<div class='modal-content'>
												<div class='modal-header'>
													<button type='button' class='close' data-dismiss='modal'>&times;</button>
													<h4 class="modal-title">Image</h4>
												</div>
												<div class='modal-body' id="modal-body">
													<script>
														function myFunction() {
															var x = document.getElementById("button-value").value;
															document.getElementById("modal-body").innerHTML = x;
														}
													</script>
												</div>
												<div class='modal-footer'>
													<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
												</div>
											</div>			
										</div>
									</div>
								</div>
			              </td>
			            </tr>
			        </tbody>
			    </table>

			    <table class="table table-bordered table-hover" width="100%">
			    	<thead>
			    		<tr>
			    			<th><h4>Write Synopsis</h4></th>
			    		</tr>
			    	</thead>
			    	<tbody>
			    		<tr>
			    			<td>
			    					<input type="hidden" value="<?php echo $Id?>" id="id" name="id"/>
			    					<input type="hidden" value="<?php echo $SummaryId?>" id="summary_id" name="summary_id"/>
			    					<input type='text' class="form-control" name='title' style="min-width: 900px;" id='title' placeholder="Write Synopsis Title Here" value='<?php echo $Title?>'>
			    			</td>
			    		</tr>
			            <tr>
			            	<td>
									<textarea name="synopsis" class="form-control" style="min-width: 900px; min-height: 250px;" placeholder="Start Write Synopsis Here"><?php echo $Summary?></textarea>
									<input type="submit" class="btn btn-info" name="save" value="<?php echo $ButtonValue;?>">
								</form>		            		
			            	</td>
			            </tr>
			          </tbody>
			        </table>
			        <?php
			        	echo '
					        <script>
					          $(document).ready(function(){
					            $("#div-content02").hide();
			        	';

			        	for ($i=1; $i <= $Counter; $i++)
			        	{
			        		echo '
					            $("#show'.$i.'").click(function(){
					            	var textMsg00 = "'.$text[$i].'";
					            	var textMsg01 = "'.$valueText[$i].'";
					            	document.getElementById("button-value").innerHTML = textMsg00;
					            	document.getElementById("button-value").value = textMsg01;

					            	$("#div-content02").show();
					            	$("#div-content01").hide();
					            });
			        		';			        		
			        	}

			        	echo '
					          });
					        </script>
			        	';
			        ?>
				</div>
			</div>
		<!-- /block -->
		</div>
	</div>
	
	<div class="row-fluid">
		<div class="span12">
			<!-- block -->
			<div class="block">
				<div class="navbar navbar-inner block-header">
					<div class="muted pull-left"><h3>All Synopsis</h3></div> 
					
					<div class="pull-right">
						<span class="badge badge-info"><h4>Total Record: <?php if(isset($totalrow)){ echo $totalrow;}?></h4></span>
					</div>
				</div>
				
				<div class="block-content collapse in">
					<form method="post" action="<?php echo base_url()?>index.php/<?php echo $controller?>/index/" enctype="multipart/form-data">
						<table class="table table-striped table-bordered">
							<tr>
								<td>
									<input type="text" value="<?php if(isset($search)){ echo $search=='_'?'':$search;}?>" name="search" placeholder="Search Text" id="search" />
									<input class="btn btn-success" type="submit" value="Search"  style="margin-bottom:10px;"  >
								</td>								
							</tr>
						</table>
					</form>
					<!------   View  Table   -------->
					
					<form method="post" action="<?php echo base_url()?>index.php/<?php echo $controller?>/delete/">
						<table class="table table-striped" id="table">
							<thead>
								<tr>
									<th width="10px">SL</th>
									<th width="5px">
										<input type="checkbox" name="chk_all" id="chk_all" value="checkbox" onclick="checkall()">
									</th>
									<th width="80px">Date</th>
									<th width="100px">Media Name</th>
									<th width="150px">Caption</th>
									<th width="150px">Title</th>
									<th width="295px">Summary</th>
									<th width="150px">Actions</th>
								</tr>
							</thead>
							
							<tbody>
								<?php 
									$i = 1; 
									foreach($allInfo as $row)
									{
								?>
									<tr>
										<td><?php echo $sl;?></td>
										<td>
											<input type="checkbox" name="chk_<?php echo $i?>"  id="chk_<?php echo $i?>" value="<?php echo $row->Id;?>">
										</td>
										<td><?php echo $row->Date;?></td>
										<td><?php echo $row->MediaId;?></td>
										<td><?php echo $row->Caption;?></td>
										<td style="text-align: justify;"><?php echo $row->Title;?></td>
										<td style="text-align: justify;"><?php echo $row->Summary;?></td>
										<td> 
											<p>
												<a href="<?php echo base_url()?>index.php/<?php echo $controller?>/edit/<?php echo $row->SummaryId?>/<?php echo $row->Id?>"  class="btn btn-info">Edit</a>
												<a href="<?php echo base_url()?>index.php/<?php echo $controller?>/delete/<?php echo $row->Id?>"  class="btn btn-warning" onclick="return confirm('Are you sure want to delete?')">Delete</a>
											</p>
										</td>
									</tr>
								<?php
										$i++;
										$sl++;
									}
								?> 
								<tr>
									<td>&nbsp;</td>
									<td colspan="8">										
										<input type="hidden" value="<?php echo $i?>" id="allvalue" name="allvalue"/>
										<input class="btn btn-danger" type="submit" value="Delete" onclick="return deletecheck('Please select at least one checkbox')"> 
										<div class="pagination pagination-centered">
											<?php  echo $this->pagination->create_links();?>
										</div>
									</td>									
								</tr>
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
<?php include("include/footer.php"); ?>    