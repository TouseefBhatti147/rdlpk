<div class="">

<div class="shadow">

  <h3>Add Category</h3>

</div>

<!-- shadow -->

<hr noshade="noshade" class="hr-5">

<section class="reg-section margin-top-30">



<form action="create" method="post"  onsubmit="return validateForm()" enctype="multipart/form-data">


     <div style="height: 80px;

    padding: 0 0 0 32px;

    width: 300px;">

  <span style="color:#FF0000; display:block;" id="error-category_title"></span>

  <span style="color:#FF0000; display:block;" id="error-category_name"></span>

  <span style="color:#FF0000; display:block;" id="error-category_sign"></span>

 

   </div> 

  <div class="float-left">

    <p class="reg-left-text">Category Title <font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" value="" name="category_title" id="category_title"  class="form-control" placeholder="Enter category title" />

    </p>

  </div>

    <div class="float-left">

    <p class="reg-left-text">Category Name<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" value="" name="category_name" id="category_name" class="form-control" placeholder="Enter Category name" />

    </p>

  </div>

 

    <div class="float-left">

    <p class="reg-left-text">Select Sign<font color="#FF0000">*</font>(50x50 only)</p>

	<p class="reg-right-field-area margin-left-5">

    <input id="category_sign" type="file" name="category_sign" accept="image/*">

    </p>

    </div>

	

    <button type="submit" class="btn btn-info">Add Category</button>

  </form>

 </div>

 </section>

<!-- section 3 --> 

  <!--VALIDATION START-->

 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<script>



function validateForm(){

	

	$("#error-category_title").hide();

	$("#error-category_name").hide();

	$("#error-category_sign").hide();

	

	//	var x=document.forms["form"]["firstname"].value;

	var k = $("#category_title").val();

	var x = $("#category_name").val();

	var y = $("#category_sign").val();





var counter=0;



if (k==null || k=="")

  {

  $("#error-category_title").html("Enter Category Title");

  $("#error-category_title").show();

  counter =1;

  }

if (x==null || x=="")

  {

  $("#error-category_name").html("Enter Category Name");

  $("#error-category_name").show();

  counter =1;

  }

if (y==null || y=="")

  {

  $("#error-category_sign").html("Enter Cateogry Sign");

  $("#error-category_sign").show();

  counter =1;

  }



 if(counter==1)

  	return false;

  

}

</script>

 <!--VALIDATION END-->