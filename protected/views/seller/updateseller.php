<div class="">

<div class="shadow">

  <h3>Edit Seller</h3>

</div>

<!-- shadow -->

<hr noshade="noshade" class="hr-5 ">

<section class="reg-section margin-top-30">

  <div style="

    padding: 0 0 0 32px;

    width: 300px;">

  <span style="color:#FF0000; display:block;" id="error-name"></span>
  <span style="color:#FF0000; display:block;" id="error-remarks"></span>
  <span style="color:#FF0000;display:block;" id="error-abbreviation"></span>
  <span style="color:#FF0000;display:block;" id="error-proprietor"></span>   

 

   </div>
<form method="post" action="update" enctype="multipart/form-data" onsubmit="return validateForm()" >

  <?php $res=array();
            foreach($seller as $sel){
				
     echo '
      <input type="hidden" value="'.$sel['id'].'" name="id" id="id" class="reg-login-text-field" />';?>
	   
   <div class="float-left">
    <p class="reg-left-text">Seller Name <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input value="<?php echo $sel['name'];?>" name="name" id="name" type="text" />
</p>
 </div>
   
 <div class="float-left">
    <p class="reg-left-text">Abbreviation<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input value="<?php echo $sel['abbreviation'];?>" name="abbreviation" id="abbreviation" type="text" />
</p>
 </div>
 <div class="float-left">
    <p class="reg-left-text">Proprietor<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input value="<?php echo $sel['proprietor'];?>" name="proprietor" id="proprietor" type="text" />
</p>
 </div>
 <div class="float-left">
    <p class="reg-left-text">Issued<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input value="<?php echo $sel['issued'];?>" name="issued" id="issued" type="text" />
</p>
 </div>
 <div class="float-left">
    <p class="reg-left-text">Price<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input value="<?php echo $sel['price'];?>" name="price" id="price" type="text" />
</p>
 </div>
 <div class="float-left">
    <p class="reg-left-text">Remarks<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input value="<?php echo $sel['remarks'];?>" name="remarks" id="remarks" type="text" />
</p>
 </div>
 <div class="float-left" >
    <p class="reg-left-text">Logo <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
    <?php echo' <img style="height:150px;" src="'.Yii::app()->request->baseUrl.'/images/seller/'.$sel['logo'].'">';?>
    <input id="logo" type="file" name="logo" accept="image/*">
  </p>
  </div>
   <?php }?>
    <input name="submit" value="Update Seller" type="submit" class="btn-info pull-right" />
    </form>

 

 </div>

 </section>

<!-- section 3 -->

<!--VALIDATION START-->

 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>




<script>
function validateForm(){
	$("#error-name").hide();
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




</script>
