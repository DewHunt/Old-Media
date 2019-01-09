<?php include("include/header.php");?>
<?php include("include/topmenu.php");?>
<?php include("include/leftmenu.php"); ?>                
<?php $controller="pagename";?>

<script>
    $().ready(function(){		
		$('#Name').focus();
		$("select").chosen({no_results_text: "No results matched"});		
		$('#MediaId').change(function(){			
			$.post('<?php echo base_url()?>index.php/<?php echo $controller?>/loadpublication/'+$('#MediaId').val(),{},function(data){
				if(data) {
					$("#ajaxpub").html(data);
					$("#PublicationId").chosen({no_results_text: "No results matched"});
				}
			})
		})
	})
	
	function addrow()
	{
		$.post('<?php echo base_url()?>index.php/<?php echo $controller?>/addmorerow/'+$('#rowcount').val(),{},function(data){
			if(data) {
				var i=parseInt($('#rowcount').val());
				var next= i+1;
				$('#rowcount').val(next);
				$('#tr'+i).after(data);
				$('#Name'+next).focus();
				$("select").chosen({no_results_text: "No results matched"});
			}			
		})		
	}
	function removerow()
    {
		var i=parseInt($('#rowcount').val());
		if(i>1) 
		{
			var next= i-1;
			$('#rowcount').val(next);
			$('#tr'+i).remove();
			
		}
		else 
		{
			alert("You Cannot Delete This Row");
		}		
	}	
	function isNumberKey(evt)
	{
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))
		return false;		
		return true;
	}
	function validation()
    {		
		if($('#Name').val()==''){alert('Please enter Name');$('#Name').focus();return false;  }
		if($('#MediaId').val()=='0'){alert('Please select Media ');$('#MediaId').focus();return false;  }
		if($('#SpotId').val()=='0'){alert('Please select spot ');$('#SpotId').focus();return false;  }
		if($('#Price').val()==''){alert('Please enter Price');$('#Price').focus();return false;  }		
	}
	
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
						<a href="<?php echo base_url()?>index.php/<?php echo $controller?>/index/">Add</a><span class="divider">/Page</span>
					</li>					
					<!------  Page Title  end  -------->
				</ul>
			</div>
		</div>
	</div>
	<!------  massage  -------->
<?php
	if($msg==1)
	{
?>
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<h4>Success</h4> The operation completed successfully
		</div>
<?php
	}
	else if($msg==2)
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
	<div class="row-fluid" >
		<div class="span8" style="width:100%">
			<div class="block">
				<div class="navbar navbar-inner block-header"></div>
				<div class="block-content collapse in" >
					<!------  Page  Data Entry  Table   -------->				
			<?php
				if($operation=='add')
				{
			?>
					<form method="post" action="<?php echo base_url()?>index.php/<?php echo $controller?>/add">
						<table class="table table-striped" width="100%">
							<!-----  insert tr here      ------->
							<?php 
								$array[0]="Select";
							?>
							<tr>
								<td>Name</td>
								<td><input type='text' name='Name' value='' maxlength='50' tabindex='1' id='Name' /></td>
							</tr>
							
							<tr>
								<td>Media </td>
								<td><?php echo form_dropdown('MediaId', $marray,'0' ,"tabindex='2', id='MediaId'");?></td>
							</tr>
							
							<tr>
								<td>Publication </td>
								<td id="ajaxpub"><?php echo form_dropdown('PublicationId',$array ,'0' ,"tabindex='3', id='PublicationId'");?></td>
							</tr>
							
							<tr>
								<td>Day</td>
								<td><?php echo form_dropdown('Day', $dayarray,'0' ,"tabindex='4', id='Day'");?></td>
							</tr>
							
							<tr>
								<td colspan="4">
									Price Details
									<table  width="100%" border="0">
										<tr>
											<td bgcolor="#666666"><strong>SL</strong> </td>
											<td bgcolor="#666666"><strong>Price Title</strong> </td>
											<td bgcolor="#666666"><strong>Select Pages</strong></td>
											<td bgcolor="#666666"><strong>Hue</strong></td>
											<td bgcolor="#666666" colspan="3"><strong>Colum X Inch</strong></td>
											<td bgcolor="#666666"><strong>Price</strong></td>
											<td bgcolor="#666666"><strong>Remark</strong></td>
											<td bgcolor="#666666"></td>
										</tr>
										
										<tr id="tr1">
											<td width="11%">1</td>
											<td width="12%"><input name="Name1" id="Name1" type="text" value="" size="40" /></td>
											<td width="11%"> <?php echo form_dropdown("PageNoId1",$ppage,0," id='PageNoId1' ");?>	</td>
											<td width="10%"><?php echo form_dropdown("Hue1",$harray,0," id='Hue1'  style='width:100px' ");?></td>
											<td width="8%"><input name="Col1" id="Col1" type="text"  style="width:20px" value="1" size="5" /></td>
											<td width="9%">X</td>
											<td width="18%"><input name="Inch1"  id="Inch1" type="text" value="1" style="width:20px" size="5" /></td>
											<td width="35%"><input name="Price1" id="Price1" type="text" value="" size="10"  style="width:80px" /></td>
											<td width="17%"><input name="Description1" id="Description1" type="text" value="" size="25" /></td>
											<td width="18%"></td>
										</tr>
										
										<tr>
											<td colspan="6" align="left"><a href="#"  onclick="addrow()">Add More</a>/ <a href="#" onclick="removerow()">Remove</a></td>
											<td colspan="5" style="text-align:right" ><a href="#" onclick="addrow()" >Add More / <a href="#" onclick="removerow()">Remove</a></td>
										</tr>
									</table>
										<input type="hidden" id="rowcount" name="rowcount" value="1" />			
								</td>
							</tr>
							<!-----  end of insert tr here      ------->
							<tr>
								<td colspan="2" align="center" >
									<p>
										<input type="submit" tabindex="6" value="Save" onclick="return validation()" class="btn btn-primary" />
										<input type="reset" value="Reset" tabindex="7"  class="btn btn-danger" />
									</p>
								</td>
							</tr>
						</table>
					</form>
				<?php
					}
				?>
				
				<?php
					if($operation=='edit')
					{
				?>
						<form method="post" action="<?php echo base_url()?>index.php/<?php echo $controller?>/edit_ac/">
							<table class="table table-striped" width="100%">
								<!-----  insert tr here      ------->
								<tr>
									<td>Name</td>
									<td><input type='text' name='Name' value='<?php echo $Name;?>' maxlength='50' tabindex='1' id='Name' /></td>
								</tr>
								<tr>
									<td>Media </td>
									<td><?php echo form_dropdown('MediaId', $marray,$MediaId ,"tabindex='2', id='MediaId'");?></td>
								</tr>
								<tr>
									<td>Publication </td>
									<td id="ajaxpub"><?php echo form_dropdown('PublicationId', $parray,$PublicationId ,"tabindex='3', id='PublicationId'");?></td>
								</tr>
								<tr>
									<td>Day</td>
									<td><?php echo form_dropdown('Day', $dayarray,$Day ,"tabindex='4', id='Day'");?></td>
								</tr>
								<!-----  end of insert tr here      ------->
								<tr>
									<td colspan="2">
										Price Details
										<table  width="100%" border="0">
											<tr>
												<td bgcolor="#666666"><strong>SL</strong> </td>
												<td bgcolor="#666666"><strong>Price Title</strong> </td>											
												<td bgcolor="#666666"><strong>Select Pages</strong></td>
												<td bgcolor="#666666"><strong>Hue</strong></td>
												<td bgcolor="#666666" colspan="3"><strong>Colum X Inch</strong></td>
												<td bgcolor="#666666"><strong>Price</strong></td>											
												<td bgcolor="#666666"><strong>Remark</strong></td>
												<td bgcolor="#666666"> </td>
											</tr>
											
											<?php
												$resp=$this->pagename_model->getallparicedetails($Eid);
												$i=1;
												foreach($resp as $row)
												{
											?>
													<tr id="tr<?php echo $i?>">
														<td width="11%"><?php echo $i?></td>
														<td width="12%">
															<input name="Name<?php echo $i?>" id="Name<?php echo $i?>" type="text" value="<?php echo $row->Name?>" size="40" />
														</td>
														<td width="11%">
															<?php echo form_dropdown("PageNoId".$i,$ppage,$row->PageNoId," id='PageNoId$i' ");?>
														</td>
														<td width="10%">
															<?php echo form_dropdown("Hue".$i,$harray,$row->Hue," id='Hue$i'  style='width:100px' ");?>
														</td>
														<td width="8%">
															<input name="Col<?php echo $i?>" id="Col<?php echo $i?>" type="text"  style="width:20px" value="<?php echo $row->Col?>" size="5" />
														</td>
														<td width="9%">X</td>
														<td width="18%">
															<input name="Inch<?php echo $i?>"  id="Inch<?php echo $i?>" type="text" value="<?php echo $row->Inch?>" style="width:20px" size="5" />
														</td>													
														<td width="35%">
															<input name="Price<?php echo $i?>" id="Price<?php echo $i?>" type="text" value="<?php echo $row->Price?>" size="10"  style="width:80px" />
														</td>
														<td width="17%">
															<input name="Description<?php echo $i?>" id="Description<?php echo $i?>" type="text" value="<?php echo $row->Description?>" size="25" />
														</td>
														<td width="18%"></td>
													</tr>
											<?php
												$i++;
												}
											?>
											
											<tr>
												<td colspan="6" align="left"><a href="#"  onclick="addrow()">Add More</a>/ <a href="#" onclick="removerow()">Remove</a></td>
												<td colspan="5" style="text-align:right" >
													<a href="#" onclick="addrow()" >Add More / <a href="#" onclick="removerow()">Remove</a>
												</td>
											</tr>
										</table>
										
										<input type="hidden" id="rowcount" name="rowcount" value="<?php echo $i-1?>" />
									</td>
								</tr> 
								
								<tr>
									<td  colspan="2" align="center" >
										<p>  	
											<input type="hidden" id="eid" name="eid" value="<?php echo $Eid?>" />							 
											<input type="submit" value="Save" tabindex="4" onclick="return validation()" class="btn btn-primary"/>
											<input type="reset" value="Reset" class="btn btn-danger"/>
										</p>
									</td>
								</tr>
										
							</table>
						</form>
				<?php
					}
				?>
				<!------  Page  Data Entry  Table end   --------> 
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
					<div class="muted pull-left">View </div>
					<div class="pull-right">
						<span class="badge badge-info">Total Record:  <?php echo $totalrow?></span>
					</div>
				</div>
				<div class="block-content collapse in">
					<form method="post" action="<?php echo base_url()?>index.php/<?php echo $controller?>/index/">
						<table class="table table-striped"   width="100%">
							<tr>
								<td>
									<input type="text" value="<?php echo $search=='_'?'':$search;?>"  name="search" placeholder="Search Text" id="search" />
									<input class="btn btn-success" type="submit" value="Search"  style="margin-bottom:10px;">
								</td>
							</tr>
						</table>
					</form>
					<!------   View  Table   -------->
					<form method="post" action="<?php echo base_url()?>index.php/<?php echo $controller?>/delete/">
						<table class="table table-striped" id="table" width="100%">
							<thead>
								<tr>
									<th width="2%">SL</th>
									<th width="4%"><input type="checkbox" name="chk_all" id="chk_all" value="checkbox" onclick="checkall()"></th>      
									<th width="16%">Media</th>
									<th width="16%">Publication</th>									 
									<th width="19%"> Name</th>
									<th width="14%">Actions</th>
								</tr>
							</thead>
							<tbody>
						<?php 
							$i=1; 
							foreach($result as $row)
							{
						?>
								<tr>
									<td><?php echo $sl;?></td>
									<td> <input type="checkbox" name="chk_<?php echo $i?>"  id="chk_<?php echo $i?>" value="<?php echo $row->Id;?>"></td>
									<td><?php echo $row->mname?></td>
									<td><?php echo $row->pname?></td>
									<td><?php echo $row->Name?></td>
									<td> 
										<p>
											<a  href="<?php echo base_url()?>index.php/<?php echo $controller?>/edit/<?php echo $row->Id?>" class="btn btn-info"> Edit</a>
											<a href="<?php echo base_url()?>index.php/<?php echo $controller?>/delete/<?php echo $row->Id?>" class="btn btn-warning" onclick="return confirm('Are you sure want to delete?')">Delete</a>
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
									<td colspan="12">
										<input type="hidden" value="<?php echo $i?>" id="allvalue" name="allvalue"  />
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