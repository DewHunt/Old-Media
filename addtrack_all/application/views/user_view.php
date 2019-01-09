 <?php include("include/header.php");?>
 <?php include("include/topmenu.php");?>
 <?php include("include/leftmenu.php"); ?>                
                 <div class="span9" id="content">
                    <div class="row-fluid">
                        
					
							
							
                        	<div class="navbar">
                            	<div class="navbar-inner">
	                                <ul class="breadcrumb">
	                                    <i class="icon-chevron-left hide-sidebar"><a href='#' title="Hide Sidebar" rel='tooltip'>&nbsp;</a></i>
	                                    <i class="icon-chevron-right show-sidebar" style="display:none;"><a href='#' title="Show Sidebar" rel='tooltip'>&nbsp;</a></i>
	                                       
										  <!------  Page Title  --------> 
										    <li>
	                                        <a href="#">Pages Entry </a> <span class="divider">/</span>
											</li>
											
											<!------  Page Title  end  -------->		
											
                                    </ul>
                            	</div>
                        	</div>
               	  </div>
				  	<!------  massage  -------->
						<? if(0){?>
					    	<div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
                            <h4>Success</h4>
                        	The operation completed successfully</div>
						<? }?>	
							<!------  massage end  -------->	
				  
				  
				  
				  
                    <div class="row-fluid" >
					<div class="span8" style="width:100%"><div class="block">
					<div class="navbar navbar-inner block-header"></div>
                      <div class="block-content collapse in" >
                        <!------  Page  Data Entry  Table   --------> 
					
					      <table class="table table-striped">
                              <thead>
                                  <tr>
                                      <th colspan="2">Pages Setup </th>
                                      <th width="49%">&nbsp;</th>
                                      <th width="13%">&nbsp;</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <tr>
                                      <td width="4%">&nbsp;</td>
                                      <td width="34%">Page Title </td>
                                    <td><input type="text" name="textfield"></td>
                                      <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                      <td>&nbsp;</td>
                                      <td>Page No </td>
                                      <td><input name="textfield2" type="text" size="4" maxlength="4"></td>
                                      <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td>Select Media Name </td>
                                    <td><select name="select2">
                                      <option value="Protham Alo">Protham Alo</option>
                                      <option value="Ittafaq">Ittafaq</option>
                                    </select></td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td>Select Publications </td>
                                    <td><select name="select">
                                      <option value="Chutir Dina">Chutir Dina</option>
                                      <option value="Adhuna">Adhuna</option>
                                    </select></td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td>Notes</td>
                                    <td><textarea name="textarea"></textarea></td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td><p>
											
											<button class="btn btn-danger">Reset</button>
											<button class="btn btn-primary">Save</button>
											
											
											
											
										</p></td>
                                    <td>&nbsp;</td>
                                  </tr>
                              </tbody>
                          </table>
                    
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
                                    <div class="muted pull-left">View</div>
                                    <div class="pull-right"><span class="badge badge-info">17</span>

                                    </div>
                                </div>
                                <div class="block-content collapse in">
                                  
								   <!------   View  Table   --------> 
								  
								        <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th width="5%">#</th>
                                                <th width="12%"><input type="checkbox" name="checkbox2" value="checkbox"></th>
                                                <th width="12%">Sub Brand Name</th>
                                                <th width="55%">Brand Name </th>
                                                <th width="16%">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td> <input type="checkbox" name="checkbox" value="checkbox"></td>
                                                <td>Protham Alo </td>
                                                <td>nahid@fddsa.com</td>
                                                <td> 
										<p>															
											<button class="btn btn-success btn-mini">Active</button>
											<button class="btn btn-warning btn-mini">Edit</button>
											<button class="btn btn-danger btn-mini">Delete</button>
										</p>										</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td><input type="checkbox" name="checkbox3" value="checkbox"></td>
                                                <td>Ittafaq</td>
                                                <td>nahid@fddsa.com</td>
                                                <td>	<p>															
											<button class="btn btn-success btn-mini">Active</button>
											<button class="btn btn-warning btn-mini">Edit</button>
											<button class="btn btn-danger btn-mini">Delete</button>
										</p>										</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td><input type="checkbox" name="checkbox4" value="checkbox"></td>
                                                <td>The Daily Star </td>
                                                <td>nahid@fddsa.com</td>
                                                <td>	<p>															
											<button class="btn btn-success btn-mini">Active</button>
											<button class="btn btn-warning btn-mini">Edit</button>
											<button class="btn btn-danger btn-mini">Delete</button>
										</p>										</td>
                                            </tr>
                                            <tr>
                                              <td>&nbsp;</td>
                                              <td colspan="2"><button class="btn btn-danger">Reset</button></td>
                                              <td>&nbsp;</td>
                                              <td>&nbsp;</td>
                                            </tr>
                                        </tbody>
                                    </table>
									
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