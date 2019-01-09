<!DOCTYPE html>
<html>
  <head>
    <title>Admin Login</title>
    <!-- Bootstrap -->
    <link href="<?php echo base_url()?>css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="<?php echo base_url()?>css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="<?php echo base_url()?>css/styles.css" rel="stylesheet" media="screen">
     <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="<?php echo base_url()?>js/modernizr-2.6.2-respond-1.1.0.min.js"></script>
  </head>
  <body id="login">
    <div class="container">



      <form class="form-signin" action="<?php echo base_url()?>index.php/user/checklogin/" method="post">
        
		<h2 class="form-signin-heading">Please sign in</h2>
		  <?php if( $msg==1) { ?>
                  <div class="alert alert-error">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
                            <h4>Login Failed</h4>
                        	Please Enter Valid User Id Or Password</div>
          <?php } ?>
		  
		  
		  
		  
        <input type="text" class="input-block-level" name="userid" id="userid" placeholder="User Id">
        <input type="password" class="input-block-level" name="txtpass" id="txtpass" placeholder="Password">
        
        <input type="submit" class="btn btn-large btn-primary" value="Sign in "  > 
		<input type="reset" class="btn btn-large btn-primary" value="Reset "  >
      </form>

    </div> <!-- /container -->
    <script src="<?php echo base_url()?>js/jquery-1.7.1.js"></script>
    <script src="<?php echo base_url()?>js/bootstrap.js"></script>
  </body>
</html>