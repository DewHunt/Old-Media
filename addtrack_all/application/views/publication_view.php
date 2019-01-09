<?php include("include/header.php");?>
<?php include("include/topmenu.php");?>
<?php include("include/leftmenu.php"); ?>                
<?php $controller="publication";?>

<script>
    $().ready(function(){
		
		$('#Name').focus();
		$("select").chosen({no_results_text: "No results matched"});
		
	})
	
	function validation()
    {
		
		if($('#Name').val()==''){alert('Please enter Name');$('#Name').focus();return false;  }
		if($('#Owner').val()==''){alert('Please enter Owner');$('#Owner').focus();return false;  }
		
	}
	
</script>

<div class="span9" id="content">
	<div class="row-fluid">
		<div class="navbar">
			<div class="navbar-inner">
				<ul class="breadcrumb">
					<i class="icon-chevron-left hide-sidebar">
						<a href='#' title="Hide Sidebar" rel='tooltip'>&nbsp;</a>
					</i>
					<i class="icon-chevron-right show-sidebar" style="display:none;">
						<a href='#' title="Show Sidebar" rel='tooltip'>&nbsp;</a>
					</i>
					<!------  Page Title  --------> 
					<li>
						<a href="<?php echo base_url()?>/index.php/<?php echo $controller?>/index/">Add</a>
						<span class="divider">/</span>
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
							<form method="post" enctype="multipart/form-data" action="<?php echo base_url()?>index.php/<?php echo $controller?>/add">
								<table class="table table-striped" width="100%">
									<!-----  insert tr here      ------->
									<tr>
										<td>Name</td>
										<td>
											<input type='text' name='Name' value='' maxlength='50' tabindex='1' id='Name' />
										</td>
									</tr>
									
									<tr>
										<td>Media</td>
										<td>
											<?php echo form_dropdown('MediaId', $array,'0' ,"tabindex='2', id='MediaId'");?>
										</td>
									</tr>
									
									<tr>
										<td>Publication Type</td>
										<td>
											<?php echo form_dropdown('PublicationType', $parray,'0' ,"tabindex='3', id='PublicationType'");?>
										</td>
									</tr>
									
									<tr>
										<td>Publication Place</td>
										<td>
											<?php echo form_dropdown('PubPlaceId', $pparray,'0' ,"tabindex='4', id='PubPlaceId'");?>
										</td>
									</tr>
									
									<tr>
										<td>Publication Frequency</td>
										<td>
											<?php echo form_dropdown('PubFreQuencyId', $pfarray,'0' ,"tabindex='5', id='PubFreQuencyId'");?>
										</td>
									</tr>
									
									<tr>
										<td>Publication Language</td>
										<td>
											Bangla &nbsp;
											<input type='radio' name='PublicationLan' checked="checked" value='Bangla' maxlength='50' tabindex='6' id='PublicationLan' />
											&nbsp;English &nbsp;
											<input type='radio' name='PublicationLan' value='English' maxlength='50' tabindex='6' id='PublicationLan' />
										</td>
									</tr>
									
									<tr>
										<td>Description</td>
										<td>
											<textarea type='text' name='Description'   tabindex='7' id='Description'  ></textarea>
										</td>
									</tr>
									
									<tr>
										<td>Logo</td>
										<td>
											<input type='file' name='Logo'   tabindex='8' id='Logo'  />
										</td>
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
							<form method="post" enctype="multipart/form-data" action="<?php echo base_url()?>index.php/<?php echo $controller?>/edit_ac/">
								<table class="table table-striped" width="100%">
									<!-----  insert tr here      ------->
									<tr>
										<td>Name</td>
										<td>
											<input type='text' name='Name' value='<?php echo $Name;?>' maxlength='50' tabindex='1' id='Name' />
										</td>
									</tr>
									
									<tr>
										<td>MediaId</td>
										<td>
											<?php echo form_dropdown('MediaId', $array,$MediaId ,"tabindex='2', id='MediaId'");?>
										</td>
									</tr>
									
									<tr>
										<td>Publication Type</td>
										<td>
											<?php echo form_dropdown('PublicationType', $parray,$PublicationType ,"tabindex='3', id='PublicationType'");?>
										</td> 
									</tr>
									
									<tr>
										<td>Publication Place</td>
										<td>
											<?php echo form_dropdown('PubPlaceId', $pparray,$PubPlaceId ,"tabindex='4', id='PubPlaceId'");?>
										</td>
									</tr>
									
									<tr>
										<td>Publication Frequency</td>
										<td>
											<?php echo form_dropdown('PubFreQuencyId', $pfarray,$PubFreQuencyId ,"tabindex='5', id='PubFreQuencyId'");?>
										</td>
									</tr>
									
									<tr>
										<td>Publication Language</td>
										<td>
											<input type='text' name='PublicationLan' value='<?php echo $PublicationLan;?>' maxlength='50' tabindex='6' id='PublicationLan' />
										</td>
									</tr>
									
									<tr>
										<td>Description</td>
										<td>
											<textarea  name='Description'   tabindex='7' id='Description'  ><?php echo $Description;?></textarea>	
										</td>
									</tr>
									
									<tr>
										<td>Logo</td>
										<td>
											<input type='file' name='Logo'   tabindex='8' id='Logo'  />
											<input type="hidden" value="<?php echo $Logo?>" name="hidlogo"  />
											<img src="<?php echo base_url()?>images/<?php echo $Logo?>" alt="<?php echo $Logo?>"  width="200" />
										</td>
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
									<input class="btn btn-success" type="submit" value="Search"  style="margin-bottom:10px;">
								</td>
							</tr>
						</table>
					</form>
					
					<!------   View  Table   -------->
					<form method="post" action="<?php echo base_url()?>index.php/<?php echo $controller?>/delete/">
						<div style="overflow:scroll;width:100%">
							<table class="table table-striped" id="table" width="100%">
								<thead>
									<tr>
										<th width="2%">SL</th>
										<th width="4%"><input type="checkbox" name="chk_all" id="chk_all" value="checkbox" onclick="checkall()"></th>     
										<th width="16%">Media</th>
										<th width="19%"> Name</th>
										<th width="19%"> Publication Type</th>
										<th width="19%"> Publication Freqyency</th>
										<th width="19%"> Publication Place</th>
										<th width="19%"> Publication Language</th>
										<th width="22%">Description </th>										
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
											<!-- <td><?php echo $row->Id;?></td> -->
											<td><?php echo $sl;?></td>
											<td>
												<input type="checkbox" name="chk_<?php echo $i?>"  id="chk_<?php echo $i?>" value="<?php echo $row->Id;?>">
											</td>
											<td><?php echo $row->mname?> </td>
											<td><?php echo $row->Name?> </td>
											<td><?php echo $row->ptname?> </td>
											<td><?php echo $row->fname?> </td>
											<td><?php echo $row->ppname?> </td>
											<td><?php echo $row->PublicationLan?> </td>
											<td><?php echo $row->Description?></td>
											
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
						</div>
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