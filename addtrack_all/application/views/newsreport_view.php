<?php include("include/header.php"); ?>
<?php include("include/topmenu.php"); ?>
<?php //include("include/leftmenu.php"); ?>
<?php $controller = "newsreport"; ?>

<style></style>

<script>
    $().ready(function () {
        $('#BatchId').focus();
        $("#Date").datepicker({dateFormat: 'dd/mm/yy'});
        $("#Date1").datepicker({dateFormat: 'dd/mm/yy'});
        $('#MediaId').change(function () {
            $.post("<?php echo base_url()?>index.php/<?php echo $controller?>/getallpublication/", {'media': $('#MediaId').val()}, function (data) {
                if (data) {
                    $('#ptype').html(data);
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
                    <i class="icon-chevron-right show-sidebar" style="display:none;"><a href='#' title="Show Sidebar"
					rel='tooltip'>&nbsp;</a></i>
                    <!------  Page Title  -------->
                    <li>
						<a href="<?php echo  base_url() ?>index.php/welcome/index">Home</a><span class="divider">/</span>
					</li>
                    <!------  Page Title  end  -------->
				</ul>
			</div>
		</div>
	</div>
    <!------  massage  -------->
    <?php
		if ($msg == 1)
		{
	?>
			<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<h4>Success</h4> The operation completed successfully
			</div>
	<?php
		}
		else if ($msg == 2)
		{
	?>
			<div class="alert alert-error">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<h4>Error</h4> Operation was not successful
			</div>
	<?php
		}
	?>
    <!------  massage end  -------->
	
	
    <div class="row-fluid">
        <div class="span8" style="width:100%">
            <div class="block">
                <div class="navbar navbar-inner block-header"></div>
                <div class="block-content collapse in">
                    <!------  Page  Data Entry  Table   -------->
                    <?php
						if ($operation == 'add')
						{
					?>
							<form method="post" action="<?php echo  base_url() ?>index.php/<?php echo  $controller ?>/index/<?php echo  $Date ?>/<?php echo  $Date1 ?>/<?php echo  $MediaId ?>/<?php echo  $PublicationId ?>/" enctype="multipart/form-data">
								<table class="table table-striped" width="100%">
									<!-----  insert tr here      ------->
									<tr>
										<td>Date</td>
										<td colspan="2">
											<input type='text' name='Date' value='<?php echo  $this->common_model->dateformat($Date); ?>' maxlength='50' tabindex='1' id='Date'/>
											To
											<input type='text' name='Date1' value='<?php echo  $this->common_model->dateformat($Date1); ?>' maxlength='50' tabindex='2' id='Date1'/>
										</td>
									</tr>
									<tr>
										<td>Media</td>
										<td colspan="2"><?php echo  form_dropdown('MediaId', $array, $MediaId, " tabindex='3', id='MediaId' class='datain_1' "); ?></td>
									</tr>
									<tr>
										<td>Publication</td>
										<td id="ptype" colspan="2"><?php echo  form_dropdown('PublicationId', $pbarray, $PublicationId, " tabindex='4', id='PublicationId'"); ?></td>
									</tr>
									<tr>
										<td>Brand</td>
										<td colspan="2"><?php echo  form_dropdown('BrandName', $carray, "tabindex='14' class='a' id='BrandName'"); ?></td>
									</tr>
									<tr>
										<td>Keyword</td>
										<td colspan="2"><?php echo  form_dropdown('Keyword', $karray, "tabindex='14' class='a' id='Keyword'"); ?></td>
									</tr>
									<tr>
										<td>Product</td>
										<td colspan="2"><?php echo  form_dropdown('ProductId', $poarray, "tabindex='14' class='a' id='ProductId'"); ?></td>
									</tr>
									<tr>
										<td>
											<input type="submit" tabindex="100000000" value="Search" name="Search" onclick="return validation()" class="btn btn-primary"/>
										</td>
							</form>
										<td>
											<form method="post" action="<?php echo  base_url() ?>index.php/<?php echo  $controller ?>/generatexl/<?php echo  $Date ?>/<?php echo  $Date1 ?>/<?php echo  $MediaId ?>/<?php echo  $PublicationId ?>/<?php echo  $BrandName ?>/<?php echo  $ProductId ?>/<?php echo  $Keyword ?>/" enctype="multipart/form-data">
												<input type="submit" tabindex="100000000" value="Download xls" name="Search" onclick="return validation()" class="btn btn-primary"/>
											</form>
										</td>
										
										<td>	
											<form method="post" action="<?php echo  base_url() ?>index.php/<?php echo  $controller ?>/download2/<?php echo  $Date ?>/<?php echo  $Date1 ?>/<?php echo  $MediaId ?>/<?php echo  $PublicationId ?>/<?php echo  $BrandName ?>/<?php echo  $ProductId ?>/<?php echo  $Keyword ?>/" enctype="multipart/form-data">
												<input type="submit" tabindex="100000000" value="Download_image" name="Search" onclick="return validation()" class="btn btn-primary"/>
											</form>
										</td>
									</tr>
								</table>
								
								<h3>Data Entry View</h3>
								<table id='tab' width="50%" border="0">
									<tr>
										<td width="100">Sl</td>
										<td width="100"> Date</td>
										<td width="100"> Media</td>
										<td width="100"> Publication</td>
										<td width="100"> Pub-Type</td>
										<td width="100">Pub-Place</td>
										<td width="100"> Pub-Language</td>
										<td width="100"> Pub-Frequency</td>
										<td width="100"> Brand</td>
										<td width="100"> Sub-Brand</td>
										<td width="100"> Company</td>
										<td width="100"> Caption</td>
										<td width="100"> News Type</td>
										<td width="100"> News Category</td>
										<td width="100"> Product Catagory </td>
										<td width="100"> Product </td>
										<td width="100"> Page</td>
										<td width="100">PageNo</td>
										<td width="100"> Position</td>
										<td width="100"> Hue</td>
										<td width="100"> Cols</td>
										<td width="100"> Inchs</td>
										<td width="100"> Cols*Inchs</td>
										<td width="100"> Cost(BDT)</td>
										<td width="100"> PR Values (BDT)</td>
										<td width="100"> Keyword</td>
										<!--                                    <td width="100"> Product</td>-->
									</tr>
									<?php
										$i = 1;
										$vimage = "";
										foreach ($result as $row)
										{
									?>
											<tr id="tr1">
												<td width="42"><?php echo  $i; ?></td>
												<td width="100"> <?php echo  $row->Date; ?></td>
												<td width="100"><?php echo  $row->MediaId; ?></td>
												<td width="100"><?php echo  $row->PublicationName; ?></td>
												<td width="100"><?php echo  $row->PublicationType; ?></td>
												<td width="100"><?php echo  $row->PublicationPlace; ?></td>
												<td width="100"><?php echo  $row->PublicationLan; ?></td>
												<td width="100"><?php echo  $row->PublicationFreq; ?></td>
												<td width="100"><?php echo  $row->BrandName; ?></td>
												<td width="100"><?php echo  $row->subBrand; ?></td>
												<td width="100"><?php echo  $row->Company; ?></td>
												<td width="100"><?php echo  $row->Caption; ?></td>
												<td width="100"><?php echo  $row->NewstypeName; ?></td>
												<td width="100"><?php echo  $row->outlook; ?></td>
												<td width="100"><?php echo  $row->ProductName; ?></td>
												<td width="100"><?php echo  $row->ProductCatName; ?></td>
												<td width="100"><?php echo  $row->PageId; ?></td>
												<td width="100"><?php echo  $row->PageNo; ?></td>
												<td width="10"><?php echo  $row->PositionName; ?></td>
												<td width="100"><?php echo  $row->HueName; ?></td>
												<td width="100"><?php echo  $row->Cols; ?></td>
												<td width="100"><?php echo  $row->Inchs; ?></td>
												<td width="100">
													<?php
														$r = $row->Inchs;
														$c = $row->Cols;
														echo $c * $r;
													?>
												</td>
												<td width="100">
													<?php
														$p = $row->Price;
														echo $p * $c * $r;
													?>
												</td>
												<td width="100">
													<?php
														$tp = $row->Price;
														echo $tp * $c * $r *3;
													?>
												</td>
												<td width="100">
													<?php
														echo  $row->Keyword; ?>
												</td>
											</tr>
									<?php
											$row++;
											$i++;
										}
									?>
									<!-----  end of insert tr here      ------->
									<tr>
										<td colspan="16" align="center">
											<p>
												<div><a id="a" style="display:none" href="#">Download XL</a></div>
											</p>
										</td>
									</tr>
								</table>
					<?php
						}
					?>
					<!------  Page  Data Entry  Table end   -------->
				</div>
			</div>
			<!-- /block -->
		</div>
	</div>
</div>
<?php include("include/footer.php"); ?>