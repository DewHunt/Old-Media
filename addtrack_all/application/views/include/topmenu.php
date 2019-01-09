<div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="#">Admin Panel</a>
                    <div class="nav-collapse collapse">
                        <ul class="nav pull-right">
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i>Welcome <?=$this->session->userdata('userId');?> <i class="caret"></i>

                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a tabindex="-1" href="#">Profile</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a  href="<?=base_url()?>index.php/user/logout/">Logout</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav">
                        <li >    <!-- class='active '--> 
                                <a href="#">Dashboard</a>
                            </li>
                            <li class="dropdown">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle">Settings <b class="caret"></b>

                                </a>
                                <ul class="dropdown-menu" id="menu1">
                                    <li>
                                        <a href="<?=base_url()?>index.php/menucategory/index">Menu Category <i class="icon-arrow-right"></i></a> 
                                    </li>
                                    <li>
                                        <a href="<?=base_url()?>index.php/menusubcategory/index">Menu Sub-Category</a>
                                    </li>
                                    
                                </ul>
                            </li>
                             
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Users <i class="caret"></i>

                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a tabindex="-1" href="#">Manage User</a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="#">Change Password</a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="#">Permissions</a>
                                    </li>
                                </ul>
                            </li>
							
							
                        </ul>
						 
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </div>
        </div>
		
		<div class="container-fluid">
            <div class="row-fluid">