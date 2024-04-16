
<div class="">

<div class="shadow">

  <h3>Booking Forms</h3>

</div>

<!-- shadow -->

<hr noshade="noshade" class="hr-5 ">

<section class="reg-section margin-top-30">

  <div style="

    padding: 0 0 0 32px;

    width: 300px;">

   <span style="color:#FF0000; display:block;" id="error-paidamount"></span>

  <span style="color:#FF0000; display:block;" id="error-dueamount"></span>
  <span style="color:#FF0000;display:block;" id="error-discount"></span>   

  <span style="color:#FF0000;display:block;" id="error-paidas"></span>   

 <span style="color:#FF0000;display:block;" id="error-remarks"></span>   
<span style="color:#FF0000;display:block;" id="error-detail"></span>   

 
 

   </div>
<form method="post" action="addbooking" enctype="multipart/form-data" onsubmit="return validateForm()">

  <?php $res=array();
            foreach($plots as $plo){
				
     echo '
      <input type="hidden" value="'.$plo['id'].'" name="form_id" id="form_id" class="reg-login-text-field" />
   <div class="float-left">
  <p class="reg-left-text">Project<font color="#FF0000">*</font></p>
  <select name="project_id" disabled="disabled" id="project" >
   <option value="'.$plo['project_id'].'">'.$plo['project_name'].'</option>';
            $res=array();
            foreach($projects as $key){
            echo '
			<option value="'.$key['id'].'">'.$key['project_name'].'</option>'; 
            }?>
  </select>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Plot Size(Unit)<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
         <select name="size" disabled="disabled" id="size">
          <option value="<?php echo $plo['size'];?>"><?php echo $plo['size'];?></option>
        	 <?php	
			$res=array();
            foreach($size as $k){
            echo '
			<option value="'.$k['id'].'">'.$k['size'].'</option>'; 
            }?>
  </select>
    </p>
 </div>
   <div class="float-left">
    <p class="reg-left-text">Form No.<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input value="<?php echo $plo['scode'].'-'.$plo['formno'];?>" readonly="readonly" name="name" id="name" type="text" />
</p>
 </div>
   <div class="float-left">
    <p class="reg-left-text">Paid Aount<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input value="" name="paidamount" id="paidamount" type="text" />
</p>
 </div>
 <div class="float-left">
    <p class="reg-left-text">Due Amount<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input value="" name="dueamount" id="dueamount" type="text" />
</p>
 </div>
 <div class="float-left">
    <p class="reg-left-text">Discount<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input value="" name="discount" id="discount" type="text" />
</p>
 </div>
 <div class="float-left">
    <p class="reg-left-text">Paid As<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input value="" name="paidas" id="paidas" type="text" />
</p>
 </div>
 <div class="float-left">

    <p class="reg-left-text">Detail<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

   <input name="detail"  type="text" placeholder="Enter detail" class="new-input" id="detail">

    </p>

  </div>
 <div class="float-left">
    <p class="reg-left-text">Remarks<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input value="" name="remarks" id="remarks" type="text" />
</p>
 </div>
   <?php }?>
    <input name="submit" value="Add Booking" type="submit" class="btn-info pull-right" />
    </form>

 

 </div>

 </section>

<!-- section 3 -->

<!--VALIDATION START-->

 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>


<script>

function validateForm(){
	$("#error-paidamount").hide();
	$("#error-dueamount").hide();
	$("#error-discount").hide();
	$("#error-paidas").hide();
	$("#error-detail").hide();
	$("#error-remarks").hide();
	var a = $("#paidamount").val();
	var b = $("#dueamount").val();
	var c = $("#discount").val();
	var d = $("#paidas").val();
	var e = $("#detail").val();
	var f = $("#remarks").val();
var counter=0;
if (a==null || a=="")
  {
  $("#error-paidamount").html("Enter Paid Amount");
  $("#error-paidamount").show();
  counter =1;
  }
if (b==null || b=="")
  {
  $("#error-dueamount").html("Enter Due Amount");
  $("#error-dueamount").show();
  counter =1;
  }
  if (c==null || c=="")
  {
  $("#error-discount").html("Enter Discount");
  $("#error-discount").show();
  counter =1;
  }
  if (d==null || d=="")

  {

  $("#error-paidas").html("Enter Paid As");

  $("#error-paidas").show();

  counter =1;

  }

    if (e==null || e=="")
  {
  $("#error-detail").html("Enter Detail");
  $("#error-detail").show();
  counter =1;

  }  

    if (f==null || f=="")

  {

  $("#error-remarks").html("Enter Remarks");

  $("#error-remarks").show();

  counter =1;

  }     

    
   
 if(counter==1)

  	return false;

  

}

 <!--VALIDATION END-->

 </script>
