<div class="">
<div class="shadow">
  <h3>Add Seller</h3>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5 ">
<section class="reg-section margin-top-30">
<div style="
    padding: 0 0 0 32px;
    width: 300px;">
  <span style="color:#FF0000; display:block;" id="error-name"></span>
  <span style="color:#FF0000; display:block;" id="error-logo"></span>
  <span style="color:#FF0000; display:block;" id="error-remarks"></span>
  <span style="color:#FF0000;display:block;" id="error-abbreviation"></span>
  <span style="color:#FF0000;display:block;" id="error-proprietor"></span>   
  </div>
<form action="create" method="post" enctype="multipart/form-data" onsubmit="return validateForm()"> 

  
  
   <div class="float-left">
    <p class="reg-left-text">Name<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" name="name" id="name" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Abbreviation<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" name="abbreviation" id="abbreviation" class="reg-login-text-field" />

     </p>
  </div>
    <div class="float-left">
    <p class="reg-left-text">Proprietor<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <input type="text" value="" name="proprietor" id="proprietor" class="reg-login-text-field" />  
     </p>
  </div>
   <div class="float-left">
    <p class="reg-left-text">Remarks<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" name="remarks" id="remarks" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Logo<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="file" value="" name="logo" id="logo" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text" style="visibility:hidden;">Logo<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="submit" name="addseller" value="Add Seller" class="btn-info pull-right" />
    </p>
  </div>
  </form>
 </div>
 </section>
<!-- section 3 -->
<!--VALIDATION START-->
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
function validateForm(){
	$("#error-name").hide();
	$("#error-logo").hide();
	$("#error-remarks").hide();
	$("#error-abbreviation").hide();
	$("#error-proprietor").hide();
	var a = $("#name").val();
	var b = $("#logo").val();
	var c = $("#remarks").val();
	var d = $("#abbreviation").val();
	var e = $("#proprietor").val();
     var counter=0;
  if (a==null || a=="")
  {
  $("#error-name").html("Enter Seller Name");
  $("#error-name").show();
  counter =1;
  }
  if (b==null || b=="")
  {
  $("#error-logo").html("Please Select A Logo");
  $("#error-logo").show();
  counter =1;
  }
  if (c==null || c=="")
  {
  $("#error-remarks").html("Enter Remarks");
  $("#error-remarks").show();
  counter =1;
  }
  if (d==null || d=="")
  {
  $("#error-abbreviation").html("Enter Seller Abbreviation");
  $("#error-abbreviation").show();
  counter =1;
  }
   if (e==null || e=="")
  {
  $("#error-proprietor").html("Enter Seller Proprietor");
  $("#error-proprietor").show();
  counter =1;
  }
 if(counter==1)
  	return false;

}

 <!--VALIDATION END-->
  $(document).ready(function()
     {  	
       $("#project").change(function()
           {
         	select_street($(this).val());
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



</script>



