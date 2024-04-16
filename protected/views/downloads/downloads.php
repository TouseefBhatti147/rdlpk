<div class="">
<div class="shadow">
  <h3>Add New Downloads</h3>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5 ">
<section class="reg-section margin-top-30">
  <div style="
    padding: 0 0 0 32px;
    width: 300px;">
  <span style="color:#FF0000; display:block;" id="error-project"></span>
  <span style="color:#FF0000; display:block;" id="error-title"></span>
  <span style="color:#FF0000; display:block;" id="error-detail"></span>
  <span style="color:#FF0000;display:block;" id="error-image"></span>
   </div>
<form method="post" action="create" enctype="multipart/form-data" onsubmit="return validateForm()">
<input value="Plot" name="type" id="type" type="hidden" />
  
      <div class="float-left">
  <p class="reg-left-text">Project<font color="#FF0000">*</font></p>
  <select name="project_id" id="project">
  <option value="">Select Project</option>
  <?php
       $res=array();
            foreach($projects as $key){
            echo '
			<option value="'.$key['id'].'">'.$key['project_name'].'</option>'; 
            }?>
  </select>
  </div>
 	<div class="float-left">
    <p class="reg-left-text">Title<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" name="title" id="title" class="reg-login-text-field"  />
    </p>
  </div> 
  <div class="float-left">
    <p class="reg-left-text">Detail<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text"  value="" name="detail" id="detail" class="reg-login-text-field" />
    </p>
     </div> 
       <div class="float-left" >
    <p class="reg-left-text">Image<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
    <input id="image" type="file" name="image" accept="image/*">
  </p>
  </div>
   <input name="submit" value="Add Downloads" type="submit" class="btn-info pull-right" />
    </form>
 </div>
 </section>
<!-- section 3 -->
<!--VALIDATION START-->
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
function validateForm(){

	$("#error-project").hide();

	$("#error-title").hide();

	$("#error-detail").hide();

	$("#error-image").hide();
	//	var x=document.forms["form"]["firstname"].value;

	var a = $("#project").val();

	var b = $("#title").val();

	var c = $("#detail").val();

	var d = $("#image").val();

var counter=0;
if (a==null || a=="")
  {
  $("#error-project").html("Enter Project");
  $("#error-project").show();
  counter =1;
  }
if (b==null || b=="")
  {
  $("#error-title").html("Enter Title");
  $("#error-title").show();
  counter =1;
  }
  if (c==null || c=="")
  {
  $("#error-detail").html("Enter Detail");
  $("#error-detail").show();
  counter =1;
  }
  if (d==null || d=="")

  {

  $("#error-image").html("Select An Image");

  $("#error-image").show();

  counter =1;

  }

 if(counter==1)

  	return false;

  

}

 <!--VALIDATION END-->

 </script>
