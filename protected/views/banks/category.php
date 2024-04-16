<div class="">

<div class="shadow">

  <h3>Add Bank</h3>

</div>

<!-- shadow -->

<hr noshade="noshade" class="hr-5">

<section class="reg-section margin-top-30">



<form action="create" method="post"   enctype="multipart/form-data">

<div class="float-left">

    <p class="reg-left-text">Project name  <font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

     <select  name="project" id="project" style="width:300px;">

<?php 
$connection = Yii::app()->db; 
$sql_bank  = "SELECT * from projects";
$result_bank = $connection->createCommand($sql_bank)->queryAll();
foreach($result_bank as $ch){
	echo '<option value="'.$ch['id'].'">'.$ch['project_name'].'</option>';
	}
?>
</select>

    </p>

  </div>

  <div class="float-left">

    <p class="reg-left-text">Bank name  <font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" value="" name="name" id="category_title"  class="form-control" placeholder="Enter Bank Name" />

    </p>

  </div>

    <div class="float-left">

    <p class="reg-left-text">Details<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" value="" name="details" id="details" class="form-control" placeholder="Enter Details" />

    </p>

  </div>

 

    <div class="float-left">

    <p class="reg-left-text">Code<font color="#FF0000">*</font></p>

	<p class="reg-right-field-area margin-left-5">

    <input id="code" type="text" name="cpode" />

    </p>

    </div>

	

    <button type="submit" class="btn btn-info">Add Bank</button>

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