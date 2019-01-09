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

function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
	   
	  
 function Checkfiles(filename)
    {
       
        var fileName =$('#'+filename).val();
        var ext = fileName.substring(fileName.lastIndexOf('.') + 1);

    if(ext =="GIF" || ext=="gif" || ext=="PNG" || ext=="png" || ext=="jpg" || ext=="JPG" || ext=="JEPG"  || ext=="jepg"  )
			{
				return true;
			}
    else
			{
				 
				return false;
			}
    }