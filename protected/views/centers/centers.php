<div class="">

<div class="shadow">

  <h3>Add Sales Center</h3>

</div>

<!-- shadow -->

<hr noshade="noshade" class="hr-5">

<section class="reg-section margin-top-30">



<form action="create"  onsubmit="return validateForm()" method="post" enctype="multipart/form-data">
<div style="height: 80px;

    padding: 0 0 0 32px;

    width: 300px;">

  <span style="color:#FF0000; display:block;" id="error-name"></span>

  <span style="color:#FF0000; display:block;" id="error-detail"></span>

  <span style="color:#FF0000; display:block;" id="error-image"></span>

  

   </div> 

  <div class="float-left">

    <p class="reg-left-text">Center Name<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" value="" name="name" id="name"  class="form-control" placeholder="Enter Center Name" />

    </p>

  </div>

   <div class="float-left">

    <p class="reg-left-text">Center Detail<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

     <textarea name="detail" id="detail" class="form-control"></textarea>

     

    </p>

  </div>

    <div class="float-left">

    <p class="reg-left-text">Select Images<font color="#FF0000">*</font>(150x150 only)</p>

	<p class="reg-right-field-area margin-left-5">

    <input id="image" type="file" name="image" accept="image/*">

    </p>

    </div>

   

 

  

	

    <button type="submit" class="btn btn-info">Add Center</button>

    
  </form>

 </div>

 </section>

<!-- section 3 --> 

   <!--VALIDATION START-->

 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<script>



function validateForm(){

	

	$("#error-name").hide();

	$("#error-detail").hide();

	$("#error-image").hide();

	

	//	var x=document.forms["form"]["firstname"].value;

	var k = $("#name").val();

	var x = $("#detail").val();

	var y = $("#image").val();





var counter=0;



if (k==null || k=="")

  {

  $("#error-name").html("Enter Category Name");

  $("#error-name").show();

  counter =1;

  }

if (x==null || x=="")

  {

  $("#error-detail").html("Enter Center Detail");

  $("#error-detail").show();

  counter =1;

  }

if (y==null || y=="")

  {

  $("#error-image").html("Select Image");

  $("#error-image").show();

  counter =1;

  }



 if(counter==1)

  	return false;

  

}

</script>

 <!--VALIDATION END-->