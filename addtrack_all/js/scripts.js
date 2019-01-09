$(function() {
    // Side Bar Toggle
    $('.hide-sidebar').click(function() {
	  $('#sidebar').hide('fast', function() {
	  	$('#content').removeClass('span9');
	  	$('#content').addClass('span12');
	  	$('.hide-sidebar').hide();
	  	$('.show-sidebar').show();
	  });
	});

	$('.show-sidebar').click(function() {
		$('#content').removeClass('span12');
	   	$('#content').addClass('span9');
	   	$('.show-sidebar').hide();
	   	$('.hide-sidebar').show();
	  	$('#sidebar').show('fast');
	});
});



function deletecheck(mss)
 {  var k=0;
   for(i=0;i<$('#allvalue').val();i++)
     {
	   if($('#chk_'+i).is(':checked')){k++;}
	  
	  }
	if(k==0){alert(mss);return false}  
 
 }
function checkall()
 {
  if($('#chk_all').is(':checked')){ $('#table :checkbox').attr('checked',true)}
  else{ $('#table :checkbox').attr('checked',false)}
 }
