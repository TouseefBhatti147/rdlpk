
<div class="shadow">
  <h3>Add Slider</h3>
</div>

<!-- shadow -->

<hr noshade="noshade" class="hr-5">
<section class="reg-section margin-top-30">
  <form action="create" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
    <div style="height: 80px;

    padding: 0 0 0 32px;

    width: 300px;"> <span style="color:#FF0000; display:block;" id="error-title"></span> <span style="color:#FF0000; display:block;" id="error-detail"></span> <span style="color:#FF0000; display:block;" id="error-image"></span> </div>
    <div class="float-left">
      <p class="reg-left-text">Title <font color="#FF0000">*</font></p>
      <p class="reg-right-field-area margin-left-5">
        <input type="text" value="" name="title" id="title"  class="form-control" placeholder="Enter title" />
      </p>
    </div>
    <div class="float-left">
      <p class="reg-left-text">Detail<font color="#FF0000">*</font></p>
      <p class="reg-right-field-area margin-left-5">
        <textarea name="detail" id="detail"></textarea>
      </p>
    </div>
    <div class="float-left">
      <p class="reg-left-text">Link (Website)<font color="#FF0000">*</font></p>
      <p class="reg-right-field-area margin-left-5">
       <input type="text" name="link" id="link" />
      </p>
    </div>
    <div class="float-left">
      <p class="reg-left-text">Select Image</p>
      <p class="reg-right-field-area margin-left-5">
        <input id="image" type="file" name="image" accept="image/*">
      </p>
    </div>
    <button type="submit" class="btn btn-info">Submit</button>
  </form>
</section>

<!-- section 3 --> 

<!--VALIDATION START--> 

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> 
<script>



function validateForm(){

	

	$("#error-title").hide();

	$("#error-detail").hide();

	$("#error-image").hide();

	

	//	var x=document.forms["form"]["firstname"].value;

	var k = $("#title").val();

	var x = $("#detail").val();

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

  $("#error-detail").html("Enter Slider Detail");

  $("#error-detail").show();

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