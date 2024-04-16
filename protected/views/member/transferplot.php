<div class="container-fluid" style="font-size:12px; background:#FFF;">

<style> .float-left1 {

	 width: 400px;

    float: left;

    margin-left: 20px;

}
input{width: 200px;
padding: 3px;}</style>

<div class="row-fluid">

<div class="shadow">

  <h3>Plot Transfer Form</h3>

</div>

<!-- shadow -->

<hr noshade="noshade" class="hr-5 float-left">

<section class="reg-section margin-top-30">

<?php 

$projects_data = Yii::app()->session['projects_array'];



?>





<form action="RequestTransfer" method="post" onsubmit="return validateForm()"  >



<div class="span12">

  	

  <div class="span6">
<h2 style="text-align:left;">Plot Details</h2> 
  	<b>Plot Address:</b> <?php echo $plotdetails['plot_detail_address']?>

    <input type="hidden" value="<?php echo $plotdetails['plot_id']?> ?>" name="plot_id" id="plot_id" class="f-left span4 clearfix" />

  	<b>Street:</b>

    <?php echo $plotdetails['street']?><br>

  	<b>Plot Size:</b>

    <?php echo $plotdetails['plot_size']?><br>

  	<b>Project Name:</b>

    <?php echo $plotdetails['project_name']?><br>

   

  </div>



<div class="span6" style="font-size:14px;">
<h3 style="text-align:left;">Transfer From </h3>
  

  

  <div class="float-left">

      <input type="hidden" value="<?php echo $plotdetails['member_id']?>" name="transfer_from_memberid" id="member_id" class="reg-login-text-field" />

      <b>Name:</b> <?php echo $plotdetails['name'].' <br><b>S/o D/O W/O:</b> '.$plotdetails['sodowo'];?>

  </div>

</div>



<div class="span6 pull-right">
<hr noshade="noshade" class="hr-5">

  <h4 style="text-align:left;">Transfer To</h4>

  

	<div class="float-left1">

   	<label class="span3 pull-left">Name </label>

    <input type="text" value="" name="name" id="name" class="reg-login-text-field" />

    <span style="background-color:#9FF; width:300px; display: block;" id="error-name"></span>

  </div>

  	

  	<div class="float-left1">

    <label class="span3 pull-left">S/O-D/O-W/O </label>

    <input type="text" value="" name="sodowo" id="sodowo" class="reg-login-text-field" />

    <span style="background-color:#9FF; width:300px; display: block;" id="error-sodowo"></span>

  </div>

  	<div class="float-left1">

    <label class="span3 pull-left">CNIC</label>

    <input type="text" value="" name="cnic" id="cnic" class="text" />

    <span style="background-color:#9FF; width:300px; display: block;" id="error-cnic"></span>

    <span style="background-color:#9FF; width:300px; display: block;" id="error-cnic1"></span>

  </div>

  	<div class="float-left1">

    <label class="span3 pull-left">Address</label>

    <input type="text" value="" name="address" id="address" class="reg-login-text-field" />

    

  </div>

  	<div class="float-left1">

   <label class="span3 pull-left">Email Address </label>

    <input type="text" value="" name="email" id="email" class="text" />

    <span style="background-color:#9FF; width:300px; display: block;" id="error-email"></span>

    <span style="background-color:#9FF; width:300px; display: block;" id="error-email1"></span>

    

  </div>

  

  <div class="float-left1">

    <label class="span3 pull-left">City</label>

    <input type="text" value="" name="city" id="city" class="reg-login-text-field" />

    

  </div>

  <div class="float-left1">

    <label class="span3 pull-left">State</label>

    <input type="text" value="" name="state" id="state" class="reg-login-text-field" />

  </div>

	<div class="float-left1">

  <input name="submit" value="Send Transfer Request" type="submit" class="btn-info pull-right" style="padding:5px 10px; margin-right: 150px;" />

 </div>

</div>



  

 </form>

 

  

 <div class="clearfix"></div>

 

<script>



function validateForm(){

	$("#error-name").hide();

	
	$("#error-sodowo").hide();

	$("#error-cnic").hide();

	$("#error-cnic1").hide();

	$("#error-email").hide();

	$("#error-email1").hide();

	

//	var x=document.forms["form"]["firstname"].value;

var x = $("#name").val();



var z = $("#sodowo").val();

var a = $("#cnic").val();

var b = $("#email").val();



var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

var phoneno = /^\d{13}$/;



var counter=0;



if (x==null || x=="")

  {

  $("#error-name").html("Name must be filled out");

  $("#error-name").show();

  counter =1;

  }



if (z==null || z=="")

  {

  $("#error-sodowo").html("SODOWO must be filled out");

  $("#error-sodowo").show();

  counter =1;

  }

 if (!a.match(phoneno))

  {  

  $("#error-cnic").html("Invalid CNIC");

  $("#error-cnic").show();

  counter =1;

  }

if (a==null || a=="")

  {  

  $("#error-cnic").html("CNIC must be filled out");

  $("#error-cnic").show();

  counter =1;

  }

 if (!filter.test(b))

  {  

  $("#error-email").html("Invalid Email");

  $("#error-email").show();

  counter =1;

  } 

if (b==null || b=="")

  {  

  $("#error-email").html("Email must be filled out");

  $("#error-email").show();

  counter =1;

  }  

  if(counter==1)

  	return false;

  

}

 

</script> 







 </section>



<!-- section 3 --> 

 <div class="clearfix"></div>

 

 

 

 </div> 

 </div>