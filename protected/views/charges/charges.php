<div class="">
<div class="shadow">
  <h3>Add Charges</h3>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5 ">
<section class="reg-section margin-top-30">

<form action="create" method="post" onsubmit="return validateForm()"  enctype="multipart/form-data">
   <div style="height: 100px;
    padding: 0 0 0 32px;
    width: 300px;">
  <span style="color:#FF0000; display:block;" id="error-name"></span>
  <span style="color:#FF0000; display:block;" id="error-note"></span>
  <span style="color:#FF0000; display:block;" id="error-monthly"></span>
  <span style="color:#FF0000;display:block;" id="error-total"></span>
 <span style="color:#FF0000; display:block;" id="error-project_id"></span>
   </div> 
   <div class="float-left">
  <p class="reg-left-text">Project<font color="#FF0000">*</font></p>
  <select name="project_id" id="project_id">
 			<option value="">Select Project</option>
             <?php	
			
            $res=array();
            foreach($projects as $key){
            echo '<option value="'.$key['id'].'">'.$key['project_name'].'</option>'; 
            }?>
  </select>
 
  </div>
       <div class="float-left">
    <p class="reg-left-text">Charges Name<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" name="name" id="name" class="form-control" placeholder="Enter Charges name" />
    </p>
  </div>
 
   
    
    <div class="float-left">
    <p class="reg-left-text">Charges Detail</p>
	<p class="reg-right-field-area margin-left-5">
    <input id="note" type="text" name="note" >
    </p>
    </div>
     <div class="float-left">
    <p class="reg-left-text">Monthly Charges</p>
	<p class="reg-right-field-area margin-left-5">
    <input id="monthly" type="text" name="monthly" >
    </p>
    </div>
     <div class="float-left">
    <p class="reg-left-text">Total(One time)</p>
	<p class="reg-right-field-area margin-left-5">
    <input id="total" type="text" name="total" >
    </p>
    </div>
	
    <button type="submit" style="margin:38px;" class="btn btn-info">Add Charges</button>
  
  </form>
 </div>
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
	$("#error-project_id").hide();


	var k = $("#name").val();
	var x = $("#note").val();
	var y = $("#monthly").val();
	var z = $("#total").val();
	var a = $("#project_id").val();


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
  if (a==null || a=="")
  {
  $("#error-project_id").html("Select Project");
  $("#error-project_id").show();
  counter =1;
  }
  
 if(counter==1)
  	return false;
  
}
</script>
 <!--VALIDATION END-->