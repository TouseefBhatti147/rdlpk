
<div class="shadow">
  <h1>Create Page</h1>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5 float-left">
<section class="reg-section margin-top-30">
<?php

$pages_data = Yii::app()->session['pages_array'];
$result_pages = Yii::app()->session['pages_array'];
?>

		
<form action="update1" method="post">
  



 <input type="text" value="" name="page_type" id="page_type" class="reg-login-text-field" />

  <div class="float-left">
    <p class="reg-left-text">Detail Content<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <textarea  class="ckeditor" name="detail_content" id="detail_content" /></textarea>
    </p>
  </div>
  <div class="checkbox margin-left-144 margin-top-15">
    <input name="agree" type="checkbox" value="1" class="float-left" id="checkbox" />
    <label for="checkbox"></label>
  </div>
  <p class="font-16 float-left margin-top-12 margin-left-5">I agree to the <a href="#" class="link-1 font-16" title="Licence Agreement">Licence Agreement</a></p>
  <input name="submit" type="submit" />
 
 
 <script>
 
  $(document).ready(function()
     {  	
		
       $("#project").change(function()
           {
         	select_street($(this).val());
		   });
		   
		   $("#street_id").change(function()
           {
         	select_plot($(this).val());
		   });
     });
 
 
function select_street(id)
{
$.ajax({
      type: "POST",
      url:    "ajaxRequest?val1="+id,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var listItems='';
	$(json).each(function(i,val){
	listItems+= "<option value='" + val.id + "'>" + val.street + "</option>";
  
});listItems+="";

$("#street_id").html(listItems);
          }
    });
}
 
 
 

	 
function select_plot(id)
{
$.ajax({
      type: "POST",
      url:    "ajaxRequest1?val1="+id,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
	  
var listItems='';
	$(json).each(function(i,val){
	listItems+= "<option value='" + val.id + "'>" + val.plot_detail_address +" ("+val.plot_size+")</option>";
   
});listItems+="";

$("#plot_id").html(listItems);
          }
    });
}

</script>
 
 </section>
<!-- section 3 --> 
