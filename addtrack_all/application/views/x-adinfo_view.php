 <?php include("include/header.php");?>
 <?php include("include/topmenu.php");?>
 <?php include("include/leftmenu.php"); ?>                
   <? $controller="adinfo";?>
  
  <script>
    $().ready(function(){
	
	$('#Name').focus();
	 
	
	
	 $('#CompanyId').change(function(){
	   
	   
	   $.post('<?=base_url()?>index.php/<?=$controller?>/ajaxbrand/'+ $('#CompanyId').val(),{},function(data){
	                        
							if(data)
							  {
							    $('#ajaxbrand').html(data);
							 getbrand()
							  }
							 
	   
	                   })
	   
	    })
	
	 
	
	
	
	})
  
  function getbrand()
   {
   
      $.post('<?=base_url()?>index.php/<?=$controller?>/ajaxsubbrand/'+ $('#CompanyId').val()+'/'+$("#BrandId").val(),{},      
	                 function(data){
	                      
										if(data)
										  {
											
											$('#ajaxsubbrand').html(data);
										  
										  }							 
	   
	                                })
   
   }
  
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
	                                    <i class="icon-chevron-left hide-sidebar"><a href='#' title="Hide Sidebar" rel='tooltip'>&nbsp;</a></i>
	                                    <i class="icon-chevron-right show-sidebar" style="display:none;"><a href='#' title="Show Sidebar" rel='tooltip'>&nbsp;</a></i>
	                                       
										  <!------  Page Title  --------> 
										    <li><a href="<?=base_url()?>index.php/<?=$controller?>/index/">Add</a><span class="divider">/Ad-info</span>
											</li>
											
											<!------  Page Title  end  -------->		
											
                                    </ul>
                            	</div>
                        	</div>
               	  </div>
				  	<!------  massage  -------->
						<? if($msg==1){?>
					    	<div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
                            <h4>Success</h4>
                        	The operation completed successfully</div>
						<? }
						else if($msg==2)
						    {  ?>
							
							<div class="alert alert-error">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
                            <h4>Error</h4>
                        	 Operation was not successful</div>
							
						<?	}
						 
						 
						
						?>	
							<!------  massage end  -------->	
				  
				  
				  
				  
                    <div class="row-fluid" >
					<div class="span8" style="width:100%"><div class="block">
					<div class="navbar navbar-inner block-header"></div>
                      <div class="block-content collapse in" >
                        <!------  Page  Data Entry  Table   --------> 
					
					 <? if($operation=='add'){?>
					<form method="post" action="<?=base_url()?>index.php/<?=$controller?>/add" enctype="multipart/form-data">
					      <table class="table table-striped" width="100%">
                              
                              
                                  
								  
								  <!-----  insert tr here      ------->
							  
							 <tr> 
							    <td>AD ID</td> <td><input type='text' name='AD_ID' value='' maxlength='50' tabindex='1' id='AD_ID' /></td> </tr>
								<tr> <td>Title</td> <td><input type='text' name='Title' value='' maxlength='250' tabindex='2' id='Title' /></td> </tr>
								<tr> <td>Company</td> <td ><?=form_dropdown('CompanyId', $carray,'0' ,"tabindex='5'  id='CompanyId'");?></td> </tr>
								<tr> <td>Brand</td> <td id="ajaxbrand"><?=form_dropdown('BrandId', $array,'0' ,"tabindex='3'  id='BrandId'");?></td> </tr>
								<tr> <td>Sub-Brand</td> <td id="ajaxsubbrand"><?=form_dropdown('SubBrandId', $array,'0' ,"tabindex='4'  id='SubBrandId'");?></td> </tr>
								
								
								
								
								<tr> <td>Notes</td> <td><textarea name='Notes' tabindex='6' id='Notes' ></textarea></td> </tr><tr> <td>Image</td> <td><input type='file' name='Image' value='' tabindex='7' id='Image' /></td> </tr>
								<tr> <td>Product</td> <td><?=form_dropdown('ProductId', $parray,'0' ,"tabindex='8'  id='ProductId'");?></td> </tr>
								<tr> <td>Ad Type</td> <td> 
								<?=form_dropdown('AtypeId', $aarray,'0' ,"tabindex='8'  id='AtypeId'");?>
								</td> </tr>
								<tr> <td>Ad Theme</td> <td><textarea name='AdTheme' tabindex='10' id='AdTheme' ></textarea></td> </tr>  
							  
							  
								  <!-----  end of insert tr here      ------->
								  
								  
								  
								  
                                  <tr>
                                   
                                    
                                    <td  colspan="2" align="center" ><p>  								 
									<input type="submit" tabindex="6" value="Save" onclick="return validation()" class="btn btn-primary" />
									<input type="reset" value="Reset" tabindex="7"  class="btn btn-danger" />
									
									
									 </p></td>
                                     
                                  </tr>
                              
                          </table>
                    </form>
					 <? } ?>
					 <? if($operation=='edit'){?>
					<form method="post" action="<?=base_url()?>index.php/<?=$controller?>/edit_ac/" enctype="multipart/form-data">
					      <table class="table table-striped" width="100%">
                              
                              
                                  
								  
								  <!-----  insert tr here      ------->
								 
							 
						 <tr> <td>AD ID</td> <td><input type='text' name='AD_ID' value='<?=$AD_ID;?>' maxlength='50' tabindex='1' id='AD_ID' /></td> </tr><tr> <td>Title</td> <td><input type='text' name='Title' value='<?=$Title;?>' maxlength='250' tabindex='2' id='Title' /></td> </tr>
						<tr> <td>Company </td> <td><?=form_dropdown('CompanyId', $carray,$CompanyId ,"tabindex='5'  id='CompanyId'");?></td> </tr><tr> 
						 <tr> <td>Brand </td> <td id="ajaxbrand"><?=form_dropdown('BrandId', $barray,$BrandId ,"tabindex='3'  id='BrandId'");?></td> </tr><tr> <td>Sub-Brand </td> <td id="ajaxsubbrand"><?=form_dropdown('SubBrandId', $sbarray,$SubBrandId ,"tabindex='4'   id='SubBrandId'");?></td> </tr> <td>Notes</td> <td><textarea name='Notes' tabindex='6' id='Notes' ><?=$Notes;?></textarea></td> </tr><tr> <td>Image</td> <td><input type='file' name='Image' value='<?=$Image;?>' tabindex='7' id='Image' />  <input type="hidden" name='hidImage' value="<?php echo $Image; ?>" tabindex='6' id='Image' />  
						<img src="<?=base_url()?>images/<?=$Image?> "  alt="<?=$Image?>"  width="200"/></td> </tr><tr> <td>Product</td> <td><?=form_dropdown('ProductId', $parray,$ProductId ,"tabindex='8', id='ProductId'");?></td> </tr><tr> <td>Ad type  </td> <td>  
							<?=form_dropdown('AtypeId', $aarray,$AtypeId ,"tabindex='8'  id='AtypeId'");?>
						
						</td> </tr><tr> <td>Ad Theme</td> <td><textarea name='AdTheme' tabindex='10' id='AdTheme' ><?=$AdTheme;?></textarea></td> </tr> 
								  
								  <!-----  end of insert tr here      ------->
								  
								  
								  
								  
                                  <tr>
                                   
                                    
                                    <td  colspan="2" align="center" ><p>  	
									<input type="hidden" id="eid" name="eid" value="<?=$Eid?>"  />							 
										<input type="submit" value="Save" tabindex="4" onclick="return validation()" class="btn btn-primary" />
									<input type="reset" value="Reset" class="btn btn-danger" />
								
									
									 </p></td>
                                     
                                  </tr>
                              
                          </table>
                    </form>
					 <? } ?>
					
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
									
                                    <div class="pull-right"><span class="badge badge-info">Total Record:  <?=$totalrow?></span>

                                    </div>
                                </div>
                                <div class="block-content collapse in">
                                    <form method="post" action="<?=base_url()?>index.php/<?=$controller?>/index/" enctype="multipart/form-data">
									 
									  <table class="table table-striped"   width="100%">
									  <tr>
									    <td> <input type="text" value="<?=$search=='_'?'':$search;?>"  name="search" placeholder="Search Text" id="search" /> <input class="btn btn-success" type="submit" value="Search"  style="margin-bottom:10px;"  ></td>
									 
									  </tr>
									  </table>
									  </form>
								   <!------   View  Table   --------> 
								  
									
									<form method="post" action="<?=base_url()?>index.php/<?=$controller?>/delete/">
								        <table class="table table-striped" id="table" width="100%">
                                        <thead>
                                            <tr>
                                                <th width="2%">SL</th>
                                                <th width="4%"><input type="checkbox" name="chk_all" id="chk_all" value="checkbox" onclick="checkall()"></th>      
                                                <th width="19%"> ADID</th>
                                                <th width="22%">Title </th>
												<th width="13%">Brand Name </th>
												 
													<th width="10%">Notes </th>
                                                <th width="14%">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <? 
										   $i=1; 
										   foreach($result as $row) {?>
										    <tr>
                                                <td><?=$sl;?></td>
                                                <td> <input type="checkbox" name="chk_<?=$i?>"  id="chk_<?=$i?>" value="<?=$row->Id;?>"></td>                                  
												  
													<td><?=$row->AD_ID?> </td>
													<td><?=$row->Title?></td>
													<td><?=$row->bname?></td>												 
													<td><?=$row->Notes?></td>
                                                <td> 
										<p>															
											 
							 <a  href="<?=base_url()?>index.php/<?=$controller?>/edit/<?=$row->Id?>"  class="btn btn-info"  > Edit </a>
								  <a href="<?=base_url()?>index.php/<?=$controller?>/delete/<?=$row->Id?>"  class="btn btn-warning" onclick="return confirm('Are you sure want to delete?')">Delete</a> 
											 
											
											
										</p>										</td>
                                            </tr>
                                           <?  $i++;$sl++;}?> 
                                            <tr>
                                              <td>&nbsp;</td>
                                              <td colspan="8">
											  
											  <input type="hidden" value="<?=$i?>" id="allvalue" name="allvalue"  />
											  <input class="btn btn-danger" type="submit" value="Delete" onclick="return deletecheck('Please select at least one checkbox')"> 
											   <div class="pagination pagination-centered">
											 <?  echo $this->pagination->create_links();?>
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