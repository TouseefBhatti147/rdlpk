<div class="">
<div class="shadow">
  <h3>Add Size For Property</h3>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5 ">
<section class="reg-section margin-top-30">

<form action="create1" method="post" onsubmit="return validateForm()"  enctype="multipart/form-data">
    <div class="float-left">
    <p class="reg-left-text">Size:<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" name="size" id="size" class="form-control" placeholder="Enter Size (e.g. 1 Marla)" />
    </p>
  </div>
    <div class="float-left">
    <p class="reg-left-text">Dimension:<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" name="dimension" id="dimension" class="form-control" placeholder="Enter Dimension (e.g. 10x12)" />
    </p>
  </div>
    <div class="float-left">
    <p class="reg-left-text">Code:<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" name="code" id="code" class="form-control" placeholder="Enter Code" />
    </p>
  </div>
    <button type="submit" style="margin:38px;" class="btn btn-info">Add Size</button>
     <div style="height: 600px;
    padding: 0 0 0 32px;
    width: 300px;">
  <span style="color:#FF0000; display:block;" id="error-size"></span>
  <span style="color:#FF0000; display:block;" id="error-code"></span>
  <span style="color:#FF0000; display:block;" id="error-dimension"></span>
 
   </div> 
  </form>
 </div>
 </section>
<!-- section 3 --> 
  <!--VALIDATION START-->
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>

function validateForm(){
	
	$("#error-size").hide();
	$("#error-code").hide();
	$("#error-dimension").hide();
	var k = $("#size").val();
	var code = $("#code").val();
	var dimension = $("#dimension").val();
	
var counter=0;

if (k==null || k=="")
  {
  $("#error-size").html("Enter Size");
  $("#error-size").show();
  counter =1;
  }
  if (code==null || code=="")
  {
  $("#error-code").html("Enter Code");
  $("#error-code").show();
  counter =1;
  }
    if (dimension==null || dimension=="")
  {
  $("#error-dimension").html("Enter Dimension");
  $("#error-dimension").show();
  counter =1;
  }
  
  
 if(counter==1)
  	return false;
  
}
</script>
 <!--VALIDATION END-->