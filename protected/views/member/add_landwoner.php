<div class="shadow">
  <h3>Add Land owner</h3>
</div>
<script src="//code.jquery.com/jquery-1.10.2.js"></script> 
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.js"></script> 
<hr noshade="noshade" class="hr-5">
<section class="reg-section margin-top-30">
  <div id="error-div" class="errorMessage" style="display: none; color:#F00;"></div>
<form action="add" enctype="multipart/form-data" method="post" onsubmit="return validateForm()">		
  <div class="float-left">
    <p class="reg-left-text">Name<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" name="name" id="name" class="reg-login-text-field" />
    </p>
  </div>
  
  <div class="float-left">
    <p class="reg-left-text">Title<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value=""  name="title" id="title" class="reg-login-text-field" />
    <p id="rsp"></p>
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Contact #<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" name="phone" id="phone" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Email<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="email" value="" name="email" id="email" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Status<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <select name="status" id="status">
      <option value="1">Active</option>
      <option value="0">In-Active</option>
      </select>
    </p>
  </div>  <div class="float-left">
    <p class="reg-left-text">Remarks<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" name="remarks" id="remarks" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Picture<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
 		<input type="file" name="image" id="image"/></p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Project<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <?php 
	$res=array();
	$i = 1;
	foreach($projects as $project_result)
	{	
	echo'
    &nbsp;<input name="'.$i.'" type="checkbox" value="'.$project_result['id'].'" />
	<label style="margin-left:5px; background-color:pink;" for="checkbox">'.$project_result['project_name'].'</label>';
	$i++;
	}
	?>
    </p>
  </div>
  <br>
  <button class="btn btn-info" type="submit" >Add</button>
    </form>
</section>
  <div style="height: 600px;
    padding: 0 0 0 32px;
    width: 300px;"> 
    <span style="color:#FF0000; display:block;" id="error-name"></span>
    <span style="color:#FF0000;display:block;" id="error-title"></span>
      <span style="color:#FF0000;display:block;" id="error-phone"></span>
      <span style="color:#FF0000;display:block;" id="error-status"></span> 
          </div>
       <script>
function validateForm(){
	$("#error-name").hide();
	$("#error-title").hide();
	$("#error-phone").hide();
	$("#error-status").hide();
	
	var name = $("#name").val();
	var title = $("#title").val();
	var phone = $("#phone").val();
	var status = $("#status").val();
	var counter=0;
if (name==null || name=="")
  {
  $("#error-name").html("Enter Name");
  $("#error-name").show();
  counter =1;
  }
  if (title==null || title=="")
  {
  $("#error-title").html("Enter Title");
  $("#error-title").show();
  counter =1;
  }
 
  if (phone==null || phone=="")
  {
  $("#error-phone").html("Enter Phone ");
  $("#error-phone").show();
  counter =1;
  }  
      
    if (status==null || status=="")
  {
  $("#error-status").html("Enter Status");
  $("#error-status").show();
  counter =1;
  }          
 if(counter==1)
  	return false;
}
 <!--VALIDATION END-->
 </script>
<!-- section 3 -->

