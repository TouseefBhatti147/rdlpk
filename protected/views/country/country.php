<div class="">



<div class="shadow">

  <h4>Add Country</h4>

</div>

<!-- shadow -->

<hr noshade="noshade" class="hr-5">

<section class="reg-section margin-top-30">





		

<form action="create" method="post" onsubmit="return validateForm()" enctype="multipart/form-data">
 <div style="height: 50px;

    padding: 0 0 0 32px;

    width: 300px;"></div>

  <span style="color:#FF0000; display:block;" id="error-country"></span>

  

   </div> 
	

  

   <div class="float-left" >

  <p class="reg-left-text">Country<font color="#FF0000">*</font></p>

  <input type="text" name="country" id="country"  />

  </div>

  

  <div class="float-left" >

    <input style="margin-top:10px;" name="submit" value="Add Country" type="submit" class="btn btn-info"  />

    

 </form> 

 

 </div>

 </section>

<!-- section 3 --> 

<!--VALIDATION START-->

 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<script>



function validateForm(){

	

	$("#error-country").hide();

	

	//	var x=document.forms["form"]["firstname"].value;

	var k = $("#country").val();





var counter=0;



if (k==null || k=="")

  {

  $("#error-country").html("Enter Country Name");

  $("#error-country").show();

  counter =1;

  }





 if(counter==1)

  	return false;

  

}

</script>

 <!--VALIDATION END-->

