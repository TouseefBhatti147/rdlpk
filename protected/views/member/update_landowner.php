<div class="shadow">
  <h3>Update Member</h3>
</div>

<!-- shadow -->
<hr noshade="noshade" class="">



<section class="reg-section margin-top-30">
<div style="padding: 0 0 0 32px; width: 300px;">
  <span style="color:#FF0000; display:block;" id="error-name"></span>
    <span style="color:#FF0000;display:block;" id="error-title"></span>
      <span style="color:#FF0000;display:block;" id="error-phone"></span>
            <span style="color:#FF0000;display:block;" id="error-status"></span> 
    
   </div>
  
<form action="landownerupdate" method="post" onsubmit="return validateForm()" enctype="multipart/form-data"> 
 	<?php	
            $res=array();
            foreach($update_member as $key){

     echo ' 

<input  type="hidden" id="memreq_id" name="memreq_id" value="'.$key['id'].'"/>
  <div class="float-left">
    <p class="reg-left-text">Name <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="'.$key['name'].'" name="name" id="name" class="reg-login-text-field" />

    </p>
  </div>

  <div class="float-left">
    <p class="reg-left-text">Title <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <input type="text"  value="'.$key['title'].'" name="title" id="title" class="reg-login-text-field" />
     </p>
  </div>
 
  <div class="float-left">
    <p class="reg-left-text">Mobile # <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <input type="text" value="'.$key['phone'].'" name="phone" id="phone" class="reg-login-text-field" />
     </p>
  </div>
  
 <div class="float-left">
    <p class="reg-left-text">Email <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <input type="text"  value="'.$key['email'].'" name="email" id="email" class="reg-login-text-field" />
     </p>
  </div>

	  <div class="float-left">
   <p class="reg-left-text">Remarks <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">

     <input type="text" value="'.$key['remarks'].'" name="remarks" id="remarks" class="reg-login-text-field" /></p></div>
	 ';?>


  <div class="float-left">
  <p class="reg-left-text">Status <font color="#FF0000">*</font></p>
 <p class="reg-right-field-area margin-left-5">
 <select id="status" name="status">
<?php 
if($key['status']=='0')
{
 echo '<option value="0">In-Active</option>';  
}
if($key['status']=='1')
{
 echo '<option value="1">Active</option>';  
}?>
<option value="1">Active</option>
<option value="0">In-Active</option>

</select></p></div>

 </div>
 <div class="float-left">
    <p class="reg-left-text">Image<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
   <?php echo'<img style="height:150px ;" src="'.Yii::app()->request->baseUrl.'/images/landowner/'.$key['image'].'">';?>
    <input id="image" type="file" name="image" accept="image/*">
     <input type="hidden" value="<?php echo $key['id']; ?> "    name="id" id="id" class="reg-login-text-field" />
</p>
</div> <div class="float-left">
   <h3>Projects Permission</h3>
    <p>
      <?php 
	$res=array();
	$i = 1;
$arry='';
foreach($projectper as $per)
{
		$check="checked";
	$arry=$per['project_id'];
	echo'	
    <input name="'.$i.'" type="checkbox" value="'.$per['project_id'].'"'.$check.' />
	<label for="checkbox">'.$per['project_name'].'</label>';
$i++;	
///echo '</br>';
}
	foreach($projects as $per1)
	{
		$check="";
		echo'
    <input name="'.$i.'" type="checkbox" value="'.$per1['id'].'"'.$check.' />
	<label style="margin-left:5px; background-color:pink;" for="checkbox">'.$per1['project_name'].'</label>';
$i++;
   }
	?>
    </p>
    </div>
    <div class="float-left">
    <p class="reg-left-text"></p>
    <p class="reg-right-field-area margin-left-5"> <input type="submit" class="btn-info button" name="update" value="Update" />
    </p></div>
 </form> 
 </section>
<?php }?>


        <script>
function validateForm(){
	$("#error-name").hide();
	$("#error-title").hide();
	$("#error-status").hide();

	var name = $("#name").val();
	var title = $("#title").val();
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

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>



 