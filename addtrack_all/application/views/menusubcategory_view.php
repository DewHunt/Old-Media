<?php include("include/header.php");?>
<?php include("include/topmenu.php");?>
<?php include("include/leftmenu.php"); ?>                
<?php $controller="menusubcategory";?>

<script>
    $().ready(function(){
		$('#SysUserCatId').focus();
	})
	
	function validation()
    {
		if($('#SysUserCatId').val()=='0'){alert('Please select Sys User Category Id');$('#SysUserCatId').focus();return false;  }
		if($('#OperationId').val()==''){alert('Please enter OperationId');$('#OperationId').focus();return false;  }
		if($('#Name').val()==''){alert('Please enter Name');$('#Name').focus();return false;  }
		if($('#Url').val()==''){alert('Please enter Url');$('#Url').focus();return false;  }
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
						<a href="#"><?php echo $title;?></a><span class="divider">/</span>
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
									<tr>  
										<td width="32%">Sys User Category Id</td> 
										<td width="68%"><?php echo form_dropdown('SysUserCatId',$subcat,'0',' id="SysUserCatId" tabindex="1"');?> </td>
									</tr>
									<tr>
										<td>OperationId</td> 
										<td> 
											<?php echo form_dropdown('OperationId',$oparray,'0'," id='OperationId' tabindex='2'");?>
										</td>
									</tr>
									<tr>
										<td>Name</td>
										<td><input type='text' name='Name' value='' maxlength='200' tabindex='3' id='Name' /></td>
									</tr>
									<tr>
										<td>Url</td>
										<td><input type='text' name='Url' value='' maxlength='200' tabindex='4' id='Url' /></td>
									</tr>
									<tr>
										<td>Title</td>
										<td><input type='text' name='Title' value='' maxlength='200' tabindex='5' id='Title' /></td>
									</tr>
									<!-----  end of insert tr here      ------->
									<tr>
										<td  colspan="2" align="center" >
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
										<td width="32%">Sys User Category Id</td> 
										<td width="68%"><?php echo form_dropdown('SysUserCatId',$subcat,$SysUserCatId,' id="SysUserCatId"');?> </td>
									</tr>
									<tr>
										<td>OperationId</td> 
										<td> 
											<?php echo form_dropdown('OperationId',$oparray,$OperationId," id='OperationId' tabindex='2'");?>
										</td>
									</tr>
									<tr>
										<td>Name</td>
										<td><input type='text' name='Name' value='<?php echo $Name?>' maxlength='200' tabindex='3' id='Name' /></td>
									</tr>
									<tr>
										<td>Url</td>
										<td><input type='text' name='Url' value='<?php echo $Url?>' maxlength='200' tabindex='4' id='Url' /></td>
									</tr>
									<tr>
										<td>Title</td>
										<td><input type='text' name='Title' value='<?php echo $Title?>' maxlength='200' tabindex='5' id='Title' /></td> 
									</tr>
									<!-----  end of insert tr here      ------->
									<tr>
										<td  colspan="2" align="center" >
											<p>
												<input type="hidden" id="eid" name="eid" value="<?php echo $Eid?>"  />							 
												<input type="submit" value="Save" tabindex="4" onclick="return validation()" class="btn btn-primary" />
												<input type="reset" value="Reset" class="btn btn-danger" />
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
									<input class="btn btn-success" type="submit" value="Search"  style="margin-bottom:10px;"  >
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
									<th width="16%"> Menu category</th>
									<th width="19%"> Sub Category Name</th>
									<th width="22%">URL </th>
									<th width="13%">Operation </th>
									<th width="10%">Order </th>
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
											<td>
												<input type="checkbox" name="chk_<?php echo $i?>"  id="chk_<?php echo $i?>" value="<?php echo $row->Id;?>">
											</td>
											<td><?php echo $row->catname?> </td>
											<td><?php echo $row->Name?> </td>
											<td><?php echo $row->Url?></td>
											<td><?php echo $row->OperationId?></td>
											<td><?php echo $row->Order?></td>
											<td> 
												<p>
													<a  href="<?php echo base_url()?>index.php/<?php echo $controller?>/edit/<?php echo $row->Id?>"  class="btn btn-info"  > Edit </a>
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
									<td colspan="7">
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