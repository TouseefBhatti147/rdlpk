
<div class="shadow">
  <h3>Update Charges</h1>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5 float-left">
<section class="reg-section margin-top-30">

<div id="error-div" class="errorMessage" style="display: none;"></div>
 
<span style="float:right"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/charges/charges_list"  class="btn-info button">Back To List</a></span> 
 </div>
 <form action="Update_charg" method="post" onsubmit="return validateForm()"  enctype="multipart/form-data">
 <div class="float-left">
    <p class="reg-left-text">Project Name <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
  <?php $res=array();
            foreach($update_charges as $key){?> 
  <select name="project_name" class="uniform" >
  
          <option value="<?php echo $key['project_id'];?>"><?php echo $key['project_name']?></option>                          								<?php 
										
										foreach($projects as $key1){
										?>
                                    		<option value="<?php echo $key1['id'];?>"><?php echo $key1['project_name']?></option>
                                        <?php
										}

										?>
                                    </select>
                                      </p>
  </div>
  <?php	
            
				
     echo ' 
 
<input type="hidden" id="id" name="id" value="'.$key['id'].'"/>


 
  <div class="float-left">
    <p class="reg-left-text">Title <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="'.$key['name'].'" name="name" id="name" class="reg-login-text-field" />
    </p>
  </div>
 
  <div class="float-left">
    <p class="reg-left-text">Note <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <input type="text" value="'.$key['note'].'" name="note" id="note" class="reg-login-text-field" />
     </p>
  </div>
 <div class="float-left">
    <p class="reg-left-text">Monthly <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <input type="text" value="'.$key['monthly'].'" name="monthly" id="monthly" class="reg-login-text-field" />
     </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Total(Once Only) <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <input type="text" value="'.$key['total'].'" name="total" id="total" class="reg-login-text-field" />
     </p>
  </div>
  
 ';	

?>

  <?php }?>
       <div class="float-left">
      <p class="reg-right-field-area margin-left-5">
<input type="submit" class="btn-info button" name="update" value="Update" />
</p>
</div>
 <div style="height: 600px;
    padding: 0 0 0 32px;
    width: 300px;">
  <span style="color:#FF0000; display:block;" id="error-name"></span>
  <span style="color:#FF0000; display:block;" id="error-note"></span>
  <span style="color:#FF0000; display:block;" id="error-monthly"></span>
  <span style="color:#FF0000;display:block;" id="error-total"></span>
 
   </div> 		
 </form>		
				
	
 
 </section>
<!-- section 3 --> 
<!--VALIDATION START-->
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>

function validateForm(){
	
	$("#error-name").hide();
	$("#error-note").hide();
	$("#error-monthly").hide();
	$("#error-total").hide();


	var k = $("#name").val();
	var x = $("#note").val();
	var y = $("#monthly").val();
	var z = $("#total").val();


var counter=0;

if (k==null || k=="")
  {
  $("#error-name").html("Enter Charges Name");
  $("#error-name").show();
  counter =1;
  }
if (x==null || x=="")
  {
  $("#error-note").html("Enter Charges Note");
  $("#error-note").show();
  counter =1;
  }
if (y==null || y=="")
  {
  $("#error-monthly").html("Enter Monthly Charges");
  $("#error-monthly").show();
  counter =1;
  }
  if (z==null || z=="")
  {
  $("#error-total").html("Enter Total Charges");
  $("#error-total").show();
  counter =1;
  }
  
 if(counter==1)
  	return false;
  
}
</script>
 <!--VALIDATION END-->