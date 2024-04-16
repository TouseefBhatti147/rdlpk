
<div class="shadow">
  <h1>Update Splash</h1>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5 ">
<section class="reg-section margin-top-30">
<?php 
$pages_data = Yii::app()->session['pages_array'];
$result_pages = Yii::app()->session['pages_array'];
?>
<form action="updatesplash" method="post" enctype="multipart/form-data">

 
<input type="hidden" value="<?php echo ($_REQUEST['id']);?>" name="id" id="id" class="reg-login-text-field" />
<div class="float-left">
  <p class="reg-left-text">Heading<font color="#FF0000">*</font></p>
  <p class="reg-right-field-area margin-left-5">
    <input type="text" value="<?php echo $splash['heading'];?>" name="heading" id="heading" class="reg-login-text-field" />
  </p>
</div>
<div class="float-left">
  <p class="reg-left-text">Detail <font color="#FF0000">*</font></p>
  <p class="reg-right-field-area margin-left-5">
    <input type="text" value="<?php echo $splash['details'];?>" name="detail" id="detail" class="ckeditor" />
  </p>
</div>

<div class="float-left">
  <p class="reg-left-text">From Date <font color="#FF0000">*</font></p>
  <p class="reg-right-field-area margin-left-5">
      <input value='<?php echo $splash['from'];?>' type='date' name="from" id="from">

  </p>
</div>
<div class="float-left">
  <p class="reg-left-text">To Date <font color="#FF0000">*</font></p>
  <p class="reg-right-field-area margin-left-5">
    <input type="date" value="<?php echo $splash['to'];?>" name="to" id="to"  />
  </p>
</div>
<div class="float-left">
  <p class="reg-left-text">Status <font color="#FF0000">*</font></p>
  <p class="reg-right-field-area margin-left-5">
   <select name="status" id="status">
   <option value="<?php echo $splash['status'];?>" ><?php if($splash['status']==1){echo 'Active';}else{ echo'In Active';}?></option>
   <option value="1">Active</option>
   <option value="0">inActive</option>
   </select>
  </p>
</div>
<div class="float-left">
  <p class="reg-left-text">Image<font color="#FF0000">*</font></p>
  <p class="reg-right-field-area margin-left-5">
  <img src="<?php echo Yii::app()->baseUrl.'/images/splash/'.$splash['images'];?>"  width="200px"/>
    <input type="file" name="image1" id="image1" class="reg-login-text-field" />
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
