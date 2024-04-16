
<div class="shadow">
  <h3>Plot Transfer Form</h3>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5 float-left">
<section class="reg-section margin-top-30">
<?php
$projects_data = Yii::app()->session['projects_array'];

?>
<form action="create" method="post">
<div class="span12">
  <h5 style="text-align:left;">Plot Details</h5> 	
  <div class="float-left">
  	<label class="span2 pull-left">Plot Details</label><br />
    <input type="text" value="" name="plot_id" id="plot_id" class="f-left span4 clearfix" />
  </div>
</div>
<div class="span6">
  <h5 style="text-align:left;">Transfer From </h5>
  
  <div class="float-left">
      <label class="span2 pull-left">Member ID</label>
      <input type="text" value="" name="member_id" id="member_id" class="reg-login-text-field" />
  </div>
</div>

<div class="span6">
  <h5 style="text-align:left;">Transfer To</h5>
  
	<div class="float-left">
   	<label class="span2 pull-left"> Name </label>
    <input type="text" value="" name="name" id="name" class="reg-login-text-field" />
    
  </div>

  	<div class="float-left">
    <label class="span2 pull-left">S/O-D/O-W/O </label>
    <input type="text" value="" name="sodowo" id="sodowo" class="reg-login-text-field" />
    
  </div>
  	<div class="float-left">
    <label class="span2 pull-left">CNIC</label>
    <input type="text" value="" name="cnic" id="cnic" class="reg-login-text-field" />
    
  </div>
  	<div class="float-left">
    <label class="span2 pull-left">Address</label>
    <input type="text" value="" name="address" id="address" class="reg-login-text-field" />
    
  </div>
  	<div class="float-left">
   <label class="span2 pull-left">Email Address </label>
    <input type="text" value="" name="email" id="email" class="reg-login-text-field" />
    
  </div>
  <div class="float-left">
    <label class="span2 pull-left">City</label>
    <input type="text" value="" name="city" id="city" class="reg-login-text-field" />
    
  </div>
  <div class="float-left">
    <label class="span2 pull-left">State</label>
    <input type="text" value="" name="state" id="state" class="reg-login-text-field" />
  </div>
</div>

 
  <input name="submit" type="submit" class="btn-info pull-right" style="padding:5px 10px; margin-right: 150px;" />
  </form> 

 <div class="clearfix"></div>
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
