<div class="">



<div class="shadow">

  <h4>Add Image Gallery</h4>

</div>

<!-- shadow -->

<hr noshade="noshade" class="hr-5">

<section class="reg-section margin-top-30">





		

<form action="Doc_Upload_Form" method="post" onsubmit="return validateForm()" enctype="multipart/form-data">

  <div style="height: 80px;

    padding: 0 0 0 32px;

    width: 300px;">

  <span style="color:#FF0000; display:block;" id="error-title"></span>

  <span style="color:#FF0000; display:block;" id="error-description"></span>

  <span style="color:#FF0000; display:block;" id="error-image"></span>

 

   </div> 

   <div class="float-left" >

  <p class="reg-left-text">Title<font color="#FF0000">*</font></p>

  <input type="text" name="title" id="title"  />

  </div>

   <div class="float-left" >

  <p class="reg-left-text">Description<font color="#FF0000">*</font></p>

  <input type="text" name="description" id="description"  />

  </div>

  <div class="float-left">

  <p class="reg-left-text">Images<font color="#FF0000">*</font></p>

  <input style="height:30px;" id="image" type="file" name="file[]" size="50" multiple />

  </div>

 

  

    <input style="margin-top:10px;" name="submit" value="Add Gallery" type="submit" class="btn btn-info"  />

   

 </form> 

 

 </div>

 </section>

<!-- section 3 --> 

<!--VALIDATION START-->

 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<script>



function validateForm(){

	

	$("#error-title").hide();

	$("#error-description").hide();

	$("#error-image").hide();

	

	//	var x=document.forms["form"]["firstname"].value;

	var k = $("#title").val();

	var x = $("#description").val();

	var y = $("#image").val();





var counter=0;



if (k==null || k=="")

  {

  $("#error-title").html("Enter Slider Title");

  $("#error-title").show();

  counter =1;

  }

if (x==null || x=="")

  {

  $("#error-description").html("Enter Slider Description");

  $("#error-description").show();

  counter =1;

  }

if (y==null || y=="")

  {

  $("#error-image").html("Enter Slider Image");

  $("#error-image").show();

  counter =1;

  }



 if(counter==1)

  	return false;

  

}

</script>

 <!--VALIDATION END-->

