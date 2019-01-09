<?php include("include/header.php");?>
<?php include("include/topmenu.php");?>
<?php include("include/leftmenu.php"); ?>
<?php $controller = "shownewsalert"; ?>

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
					<h3>News Alert System</h3>
				</div>
				<div class="block-content collapse in" align="center"  style="height:100%">
					<form method="post" action="<?php echo  base_url() ?>index.php/search-info-show">
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
				</div>

				<div class="block-content collapse in" align="center"  style="height:100%">
					<form method="post" action="<?php echo  base_url() ?>index.php/search-info">
						<table class="table table-bordered table-striped" width="100%">
							<!-----  insert tr here      ------->
							<caption><h4>News Synopsis For New Alert</h4></caption>
							<thead>
								<tr>
									<!-- <th style="text-align: center;">Company Name</th> -->
									<th style="text-align: center; width: 700px;">Daily Print Media News & Synopsis <mark><?php echo "(".date("F j, Y").")"; ?></mark></th>
									<th style="text-align: center; width: 240px;">Top Headlines</th>
								</tr>
							</thead>
							<tbody>
								<?php
									if (!empty($searchInfo))
									{
										$initialSummaryId = "";
										foreach ($searchInfo as $info)
										{
											if ($initialSummaryId != $info->SummaryId)
											{
												$initialSummaryId = $info->SummaryId;
								?>
												<tr>
													<td>
														<h3 style="text-align: justify;"><?php echo $info->Title; ?></h3>
														<p style="text-align: justify;"><?php echo $info->Summary; ?></p>
														<div style="text-align: right;">
															<?php
																foreach ($searchInfo as $media)
																{
																	if ($initialSummaryId == $media->SummaryId)
																	{
															?>
																		<a href="#">
																			<?php echo $media->MediaId;?>
																		</a>
															<?php
																	}
																}
															?>
														</div>												
													</td>
													<td>
														<a href="#"><?php echo $info->Title; ?></a>
													</td>
												</tr>
								<?php
											}
										}
									}
								?>
							</tbody>
							<tfoot>
								<tr>
									<td colspan="2">
										<input type='email' name='emailAddress' id='emailAddress' placeholder="Email Address" />
										<input type="submit" value="Send E-Mail" name="sendEmail" class="btn btn-primary"/>
									</td>
								</tr>
							</tfoot>
						</table>
					</form>

					<!------  Page  Data Entry  Table   -------->
				</div>
			</div>
		<!-- /block -->
		</div>
	</div>
</div>
<?php include("include/footer.php"); ?>  