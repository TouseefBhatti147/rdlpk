<div class="">

<div class="shadow">

  <h3>Add Property Type </h3>

</div>

<!-- shadow -->

<hr noshade="noshade" class="hr-5 ">

<section class="reg-section margin-top-30">



<form action="create" method="post" onsubmit="return validateForm()" enctype="multipart/form-data">
<div>

  <span style="color:#FF0000; display:block;" id="error-project"></span>

  <span style="color:#FF0000; display:block;" id="error-teaser"></span>

  <span style="color:#FF0000; display:block;" id="error-detail"></span>

  <span style="color:#FF0000;display:block;" id="error-image"></span>

 

</div> 

  <div class="float-left">

    <p class="reg-left-text">Property Name <font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" value="" name="project_name" id="project_name"  class="form-control" placeholder="Enter Property Name" />

    </p>

  </div>
  <div class="float-left">

    <p class="reg-left-text">Property Code <font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" value="" name="project_code" id="project_code"  class="form-control" placeholder="Enter Property Code" />

    </p>

  </div>
  
  <div class="float-left">

    <p class="reg-left-text">Discription<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

     <textarea type="text" value="" name="teaser" id="teaser" /></textarea>

     </p>

   

  </div>
  
    <div class="clearfix"></div>
  <div class="float-left">

    <p class="reg-left-text">Introduction<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <textarea type="text" name="project_details" id="project_details" class="ckeditor1"/></textarea>

     <script type="text/javascript">

var editor = CKEDITOR.replace( 'project_details', {

    filebrowserBrowseUrl : '../../ckfinder/ckfinder.html',

    filebrowserImageBrowseUrl : '../../ckfinder/ckfinder.html?type=Images',

    filebrowserFlashBrowseUrl : '../../ckfinder/ckfinder.html?type=Flash',

    filebrowserUploadUrl : '../../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',

    filebrowserImageUploadUrl : '../../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',

    filebrowserFlashUploadUrl : '../../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'

});

CKFinder.setupCKEditor( editor, '../' );







</script></p>

 

  </div>
  <div class="float-left">

    <p class="reg-left-text">Property icone<font color="#FF0000">*</font></p>

	<p class="reg-right-field-area margin-left-5">

    <input id="project_icon" type="file" name="project_icon" accept="image/*">

    </p>

    </div>
  <div class="float-left">

    <p class="reg-left-text">Property Images<font color="#FF0000">*</font></p>

	<p class="reg-right-field-area margin-left-5">

    <input id="project_image" type="file" name="project_image" accept="image/*">

    </p>

    </div>
  
  <div class="float-left">

    <button type="submit" class="btn btn-info">Add Type</button></div>
</form>
 </div>

 </section>



<!-- section 3 --> 

 <script>

// When the server is ready...

$(function () {

'use strict';



// Define the url to send the image data to

var url = 'files.php';



// Call the fileupload widget and set some parameters

$('#fileupload').fileupload({

url: url,

dataType: 'json',

done: function (e, data) {

// Add each uploaded file name to the #files list

$.each(data.result.files, function (index, file) {

$('<li/>').text(file.name).appendTo('#files');

});

},

progressall: function (e, data) {

// Update the progress bar while files are being uploaded

var progress = parseInt(data.loaded / data.total * 100, 10);

$('#progress .bar').css(

'width',

progress + '%'

);

}

});

});



</script>

<!--VALIDATION START-->

 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<script>



function validateForm(){

	

	$("#error-project").hide();

	$("#error-teaser").hide();

	$("#error-detail").hide();

	$("#error-image").hide();



	//	var x=document.forms["form"]["firstname"].value;

	var k = $("#project_name").val();

	var x = $("#teaser").val();

	var y = $("#project_details").val();

	var z = $("#project_image").val();





var counter=0;



if (k==null || k=="")

  {

  $("#error-project").html("Enter Project Name");

  $("#error-project").show();

  counter =1;

  }

if (x==null || x=="")

  {

  $("#error-teaser").html("Enter Project Taser");

  $("#error-teaser").show();

  counter =1;

  }

if (y==null || y=="")

  {

  $("#error-detail").html("Enter Project Detail");

  $("#error-detail").show();

  counter =1;

  }

  if (z==null || z=="")

  {

  $("#error-image").html("Select Project Image ");

  $("#error-image").show();

  counter =1;

  }

  

 if(counter==1)

  	return false;

  

}

</script>

 <!--VALIDATION END-->