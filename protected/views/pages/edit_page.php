
<div class="shadow">
  <h1>Create Page</h1>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5 ">
<section class="reg-section margin-top-30">
<?php 
$pages_data = Yii::app()->session['pages_array'];
$result_pages = Yii::app()->session['pages_array'];
?>
<form action="update1" method="post">
<div class="float-left">
 <p class="reg-left-text">Page ID<font color="#FF0000">*</font></p>
<input type="text" readonly="readonly" value="<?php echo ($_REQUEST['id']);?>" name="id" id="id" class="reg-login-text-field" /></div>
<div class="float-left">
  <p class="reg-left-text">Page Type<font color="#FF0000">*</font></p>
  <p class="reg-right-field-area margin-left-5">
    <input type="text" value="<?php echo $pages['page_type'];?>" name="page_type" id="page_type" class="reg-login-text-field" />
  </p>
</div>
<div class="float-left">
  <p class="reg-left-text">Content Type<font color="#FF0000">*</font></p>
  <p class="reg-right-field-area margin-left-5">
    <input type="text" value="<?php echo $pages['content_type'];?>" name="content_type" id="content_type" class="reg-login-text-field" />
  </p>
</div>
<div class="">
  <p class="reg-left-text">Description(Area of Content) <font color="#FF0000">*</font></p>
  <p class="reg-right-field-area margin-left-5">
    <input type="text" value="<?php echo $pages['description'];?>" name="description" id="description" class="reg-login-text-field" />
  </p>
</div>
<div class="">
  <p class="reg-left-text">Teaser<font color="#FF0000">*</font></p>
  <p class="reg-right-field-area margin-left-5">
    <textarea class="ckeditor"  name="teaser" id="teaser"><?php echo $pages['teaser'];?></textarea>
  </p>
</div>
<div class="">
  <p class="reg-left-text">Detail Content<font color="#FF0000">*</font></p>
  <p class="reg-right-field-area margin-left-5">
    <textarea  class="ckeditor" name="detail_content" id="detail_content" />
    <?php echo $pages['detail_content'];?>
    </textarea>
  </p>
</div>

<button type="submit" class="btn btn-success">Submit</button>


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
