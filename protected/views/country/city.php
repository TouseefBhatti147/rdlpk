<div class="">

<div class="shadow">

  <h3>Add City</h3>

</div>

<!-- shadow -->

<hr noshade="noshade" class="hr-5 ">

<section class="reg-section margin-top-30">



<form action="addcity" method="post" onsubmit="return validateForm()"  enctype="multipart/form-data">

<div style="height: 60px;

    padding: 0 0 0 32px;

    width: 300px;">

  <span style="color:#FF0000; display:block;" id="error-city"></span>

  <span style="color:#FF0000; display:block;" id="error-zipcode"></span>

 

   </div> 
 

    <div class="float-left">

    <p class="reg-left-text">City Name<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" value="" name="city" id="city" class="form-control" placeholder="Enter City name" />

    </p>

  </div>

 

   

    

    <div class="float-left">

    <p class="reg-left-text">Country</p>

	<p class="reg-right-field-area margin-left-5">

   <select name="country_id" id="country_id">

   <?php

   foreach($country as $key1)

   {

	echo ' 	<option value="'.$key1['id'].'">'.$key1['country'].'</option>';   

   }

   

   ?>



  	</select>

    </p>

    </div>

  

     <div class="float-left">

    <p class="reg-left-text">Zip Code</p>

	<p class="reg-right-field-area margin-left-5">

    <input id="zipcode" type="text" name="zipcode" >

    </p>

    </div>

	

    <button type="submit" class="btn btn-info">Add City</button>

     

  </form>

 </div>

 </section>

<!-- section 3 --> 

  <!--VALIDATION START-->

 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<script>



function validateForm(){

	

	$("#error-city").hide();

	$("#error-zipcode").hide();

	



	var k = $("#city").val();

	var x = $("#zipcode").val();

	



var counter=0;



if (k==null || k=="")

  {

  $("#error-city").html("Enter City Name");

  $("#error-city").show();

  counter =1;

  }

if (x==null || x=="")

  {

  $("#error-zipcode").html("Enter Zipcode");

  $("#error-zipcode").show();

  counter =1;

  }



 if(counter==1)

  	return false;

  

}

</script>

 <!--VALIDATION END-->