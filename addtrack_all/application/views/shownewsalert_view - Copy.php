<?php include("include/header.php");?>
<?php include("include/topmenu.php");?>
<?php include("include/leftmenu.php"); ?>
<?php $controller = "shownewsalert"; ?>

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
							/ News Alert / Show New Alert</a>
						</span>
					</li>
					<!------  Page Title  end  -------->
				</ul>
			</div>
		</div>
	</div>

	<div class="row-fluid" >
		<div class="span8" style="width:100%">
			<div class="block">
				<div class="navbar navbar-inner block-header">
					<h3>Show News Alert</h3>
				</div>
				<div class="block-content collapse in" align="center"  style="height:100%">
					<!------  Page  Data Entry  Table   -------->   
			        <?php
			          $text01 = "<img src='../../images/NT_PN_Back Before _PNO_16_POS_5-5_SZ_9_DT_07-08-2018_1533630248.jpg'>";
			          $text02 = "<img src='../../images/_logo_2972016-11-08_1478586735.png'>";
			        ?>
			        <table class="table table-bordered table-striped table-hover">
			          <thead>
			            <tr>
			              <th>Title</th>
			              <th>View</th>
			            </tr>
			          </thead>
			          <tbody>
			            <tr>
			              <td>
			                News Paper Logo
			                <p id="show01" style="text-align: right;"><b>Kaler Kantho</b></p>
			                <p id="show02" style="text-align: right;"><b>Prothom Alo</b></p>
			              </td>
			              <td rowspan="15">
			                <div id="div-content01">This is VIEW CELL</div>
			                <div id="div-content02"></div>
			              </td>
			            </tr>
			            <tr>
			              <td>Row 02 Cell 03</td>
			            </tr>
			            <tr>
			              <td>Row 03 Cell 05</td>
			            </tr>
			            <tr>
			              <td>Row 04 Cell 07</td>
			            </tr>
			            <tr>
			              <td>Row 05 Cell 09</td>
			            </tr>
			            <tr>
			              <td>Row 06 Cell 11</td>
			            </tr>
			            <tr>
			              <td>Row 07 Cell 13</td>
			            </tr>
			            <tr>
			              <td>Row 08 Cell 15</td>
			            </tr>
			            <tr>
			              <td>Row 09 Cell 17</td>
			            </tr>
			            <tr>
			              <td>Row 10 Cell 19</td>
			            </tr>
			            <tr>
			              <td>Row 11 Cell 21</td>
			            </tr>
			            <tr>
			              <td>Row 12 Cell 23</td>
			            </tr>
			            <tr>
			              <td>Row 13 Cell 25</td>
			            </tr>
			            <tr>
			              <td>Row 14 Cell 27</td>
			            </tr>
			            <tr>
			              <td>Row 15 Cell 29</td>
			            </tr>
			          </tbody>
			        </table>

			        <script>
			          $(document).ready(function(){
			            $("#div-content02").hide();

			            $("#show01").click(function(){
			              var textMsg = "<?php echo $text01; ?>";
			              document.getElementById("div-content02").innerHTML = textMsg;

			              $("#div-content02").show();
			              $("#div-content01").hide();
			            });

			            $("#show02").click(function(){
			              var textMsg = "<?php echo $text02; ?>";
			              document.getElementById("div-content02").innerHTML = textMsg;

			              $("#div-content02").show();
			              $("#div-content01").hide();
			            });
			          });
			        </script>
					<!------  Page  Data Entry  Table end   --------> 
				</div>
			</div>
		<!-- /block -->
		</div>
	</div>
</div>
<?php include("include/footer.php"); ?>    