<div class="">
<div class="shadow">
  <h3>Add Visitors</h3>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5 ">
<section class="reg-section margin-top-30">

<div style="
    padding: 0 0 0 32px;
    width: 300px;">
  <span style="color:#FF0000; display:block;" id="error-name"></span>
  <span style="color:#FF0000; display:block;" id="error-profession"></span>
  <span style="color:#FF0000; display:block;" id="error-email"></span>
  <span style="color:#FF0000;display:block;" id="error-contactno"></span>
  <span style="color:#FF0000;display:block;" id="error-city"></span>   
  <span style="color:#FF0000;display:block;" id="error-refered_by"></span>   
  <span style="color:#FF0000;display:block;" id="error-reference"></span>   
  <span style="color:#FF0000;display:block;" id="error-center"></span>   
 

   </div>
   <form method="post" action="visitdetail" onsubmit="return validateForm()">
   
  <div class="float-left">
    <p class="reg-left-text">Visitor Name <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" name="name" id="name" class="reg-login-text-field" />
    </p>
  </div> 
 <div class="float-left">
  <p class="reg-left-text">Profession<font color="#FF0000">*</font></p>
  <select name="profession" id="profession">
   <option value="">Select Profession</option>
 			 <?php	
            $res=array();
            foreach($profession as $prof){
            echo '
			<option value="'.$prof['id'].'">'.$prof['profession'].'</option>'; 
            }?>
  </select>
  </div>
  
   <div class="float-left">
    <p class="reg-left-text">Email<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" name="email" id="email" class="reg-login-text-field" />
    </p>
  </div>
  
   <div class="float-left">
    <p class="reg-left-text">Contact No.<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" name="contactno" id="contactno" class="reg-login-text-field" />
    </p>
  </div>
    
  

   <div class="float-left" >
  <p class="reg-left-text">City<font color="#FF0000">*</font></p>
  <p class="reg-right-field-area margin-left-5">
   <input type="text" value="" name="city" id="city" class="reg-login-text-field" /> </p>
  </div>
    <div class="float-left" >
  <p class="reg-left-text">Reffred By<font color="#FF0000">*</font></p>
  <p class="reg-right-field-area margin-left-5">
   <input type="text" value="" name="refered_by" id="refered_by" class="reg-login-text-field" /> </p>
  </div>
 
 
   <div class="float-left" >
  <p class="reg-left-text">Reference<font color="#FF0000">*</font></p>
  <p class="reg-right-field-area margin-left-5">
   <input type="text" value="" name="reference" id="reference" class="reg-login-text-field" /> </p>
  </div>
  <div class="float-left">
  <p class="reg-left-text">Sale Center<font color="#FF0000">*</font></p>
  <select name="center" id="center">
  
 			 <?php	
            $res=array();
            foreach($center as $center){
            echo '
			<option value="'.$center['id'].'">'.$center['name'].'</option>'; 
            }?>
  </select>
  </div>
  <input type="submit" name="add" value="Add Visitor" class="btn-info pull-right">
 </form>

  
  
 </div>
 </section>
<!-- section 3 -->
<!--VALIDATION START-->
 
<script>



function validateForm(){

	$("#error-name").hide();

	$("#error-profession").hide();

	$("#error-email").hide();

	$("#error-city").hide();

	$("#error-contactno").hide();

	$("#error-refered_by").hide();

	$("#error-reference").hide();
	$("#error-center").hide();

	
	var na = $("#name").val();

	var prof= $("#profession").val();

	var em = $("#email").val();

	var ci= $("#city").val();

	var cont = $("#contactno").val();

	var refered = $("#refered_by").val();

	var ref = $("#reference").val();
	var center = $("#center").val();
var counter=0;
if (na==null || na=="")
  {
  $("#error-name").html("Enter Name");
  $("#error-name").show();
  counter =1;
  }
if (prof==null ||prof=="")
  {
  $("#error-profession").html("Enter Profession");
  $("#error-profession").show();
  counter =1;
  }
  if (em==null || em=="")
  {
  $("#error-email").html("Enter Email");
  $("#error-email").show();
  counter =1;
  }
  if (ci==null || ci=="")

  {

  $("#error-city").html("Enter City");

  $("#error-city").show();

  counter =1;

  }

    if (cont==null || cont=="")
  {
  $("#error-contactno").html("Enter Contact Number");
  $("#error-contactno").show();
  counter =1;

  }  

    if (refered==null || refered=="")

  {

  $("#error-refered_by").html("Enter Refered By");

  $("#error-refered_by").show();

  counter =1;

  }     

    if (ref==null || ref=="")

  {

  $("#error-refrence").html("Enter Refrence");

  $("#error-refrence").show();

  counter =1;

  }   
    if (center==null || center=="")
  {
  $("#error-center").html("Select Sales Center");
  $("#error-center").show();
  counter =1;
  }     

    
 if(counter==1)

  	return false;

  

}

 <!--VALIDATION END-->

 </script>


