
<div class="shadow">

  <h3>Update Building</h3>

</div>

<!-- shadow -->
<span style="float:right"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/property/buildings_list"  class="btn-info button">Back To List</a></span>
<hr noshade="noshade" class="hr-5">


<section class="reg-section margin-top-30">
<form action="update_build" method="post" onsubmit="return validateForm()" enctype="multipart/form-data">
<div style="height: 100px;
    padding: 0 0 0 32px;
    width: 300px;">
  <span style="color:#FF0000; display:block;" id="error-project"></span>
  <span style="color:#FF0000; display:block;" id="error-bname"></span>
  <span style="color:#FF0000;display:block;" id="error-building_image"></span>
</div> 

  <?php	
            $res=array();
            foreach($update_buildings as $key){
     echo ' 
  <div class="float-left">
    <p class="reg-left-text">Project Name<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">   
		<select name="projectname" id="projectname" disabled="disabled">
		<option value="'.$key['project_id'].'">'.$key['project_name'].'</option>';
		echo'</select> 
		<input type="hidden" name="project" id="project" value="'.$key['project_id'].'"
    </p>
  </div> 
  <div class="float-left">
    <p class="reg-left-text">Building Name<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="'.$key['name'].'" name="bname" id="bname" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Project image<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <div style="height:85px; width:150px; border:1px solid;"><img src="'.Yii::app()->request->baseUrl.'/images/buildings/'.$key['building_image'].'"></div>
    <span><input  style="height:25px;" type="file" name="building_image" value="'.$key['building_image'].'"  id="building_image"></span>
	</p>
  </div> 
  <div class="float-right">
    <p class="reg-right-field-area margin-left-5">
    <input type="text" id="id" style="visibility:hidden;" name="id" value="'.$key['id'].'"/>
    </p>
  </div>
';	}?>
<input type="submit" name="update" value="Update" />
 </form>

 

 </section>
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<script>
function validateForm(){
	$("#error-project").hide();

	$("#error-bname").hide();
	$("#error-building_image").hide();
	//	var x=document.forms["form"]["firstname"].value;
	var a = $("#project").val();

	var b = $("#bname").val();
	var c = $("#building_image").val();

var counter=0;
if (a==null || a=="")
  {
  $("#error-project").html("Enter Project Name");
  $("#error-project").show();
  counter =1;
  }
if (b==null || b=="")
  {
  $("#error-bname").html("Enter Building Name");
  $("#error-bname").show();
  counter =1;
  }
  if (c==null || c=="")
  {
  $("#error-building_image").html("Select Image ");
  $("#error-building_image").show();
  counter =1;
  } ///	alert(c);
 if(counter==1)
  	return false;
}
</script>

<!-- section 3 --> 

