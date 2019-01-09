<script language="javascript">
	$().ready(function(){
	})
	
	$(function() {
	    var menu_ul = $('.nav > li > ul'),
		menu_a  = $('.nav > li > a');
	    menu_ul.hide();
	    menu_a.click(function(e) {
			e.preventDefault();
	        if(!$(this).hasClass('active')) {
	            menu_a.removeClass('active');
	            menu_ul.filter(':visible').slideUp('normal');
	            $(this).addClass('active').next().stop(true,true).slideDown('normal');
				} else {
	            $(this).removeClass('active');
	            $(this).next().stop(true,true).slideUp('normal');
			}
		});
		
		
		$('#menu ul li a').hover(function(){
			$(this).css('color','#00ccff');
		}
		,
		function(){
			$(this).css('color','#ffffff');
		}
		)
	});
	
</script>
<style>
	.nav ul li
	{
		list-style:none;
	}
</style>

<div class="span3" id="sidebar"  >
	<ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
		<li class="active">
			<a href="#"><i class="icon-chevron-right"></i>Menu</a>
		</li>
		
		<?php
			$menu=$this->common_model->get_menu_name();
			foreach($menu as  $mn)
			{
		?>
				<li>
					<a href="<?=base_url()?>index.php/<?=$mn->Url?>">
						<i class="icon-chevron-right"></i>
						<?=$mn->Name?>
					</a>
					
					<?php
						$smenu=$this->common_model->get_sub_menu_name($mn->Id);
						if(count($smenu)>0)
						{
					?>
							<ul>
								<?php
									foreach($smenu as $sm)
									{
									?>
									<li>
										<a href="<?=base_url()?>index.php/<?=$sm->Url?>">
											<i class="icon-share-alt"></i><?=$sm->Name?>
										</a>
									</li>
									<?php
									}
								?>
							</ul>
					<?php
						}
					?>
				</li>
		<?php
			}
		?>	 
	</ul>
</div>