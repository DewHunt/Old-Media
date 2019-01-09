<!DOCTYPE html>
<html class="no-js">
    
    <head>
        <meta charset="UTF-8">
		
        <title>
			<?php
				if (!empty($title))
				{ 
					echo $title; 
				}
				else
				{ 
					echo 'Default Title'; 
				}
			?> 
		</title>
        
        <link href="<?=base_url()?>css/bootstrap.css" rel="stylesheet" media="screen">
        <link href="<?=base_url()?>css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="<?=base_url()?>css/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen">
        <link href="<?=base_url()?>css/styles.css" rel="stylesheet" media="screen">
		<link href="<?=base_url()?>js/style.css" rel="stylesheet" media="screen">
		<link href="<?=base_url()?>js/jquery.ui.datepicker.css" rel="stylesheet"  >
		<link href="<?=base_url()?>js/jquery-ui-1.10.3.custom.css" rel="stylesheet"  >		
		<link href="<?=base_url()?>css/chosen.min.css" rel="stylesheet" media="screen">		
		
		
        <script src="<?=base_url()?>js/modernizr-2.6.2-respond-1.1.0.min.js"></script>
		<script src="<?=base_url()?>js/jquery-1.7.1.js"></script>
        <script src="<?=base_url()?>js/bootstrap.js"></script>
        <script src="<?=base_url()?>js/vendors/easypiechart/jquery.easy-pie-chart.js"></script>
        <script src="<?=base_url()?>js/scripts.js"></script>
		<script src="<?=base_url()?>js/chosen.jquery.js"></script>
		<script src="<?=base_url()?>js/jquery.chosen.min.js"></script>
		<script src="<?=base_url()?>js/jquery.ui.datepicker.js"></script>
		<script src="<?=base_url()?>js/jquery-ui.min.js" language="javascript"></script>		
		<script src="<?=base_url()?>js/chosen.jquery.min.js" language="javascript"></script>

		<!-- Dropdown List Multiple Select -->
		<script src="<?php echo base_url()?>js/bootstrap-multiselect.js"></script>
		<link href="<?php echo base_url()?>css/bootstrap-multiselect.css">
		
	</head>
    
<body>