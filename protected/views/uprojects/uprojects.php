<div class="">
<div class="shadow">
  <h3>Add Upcoming Project</h3>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5 ">
<section class="reg-section margin-top-30">
    <div style="height: 100px;
    padding: 0 0 0 32px;
    width: 300px;">
  <span style="color:#FF0000; display:block;" id="error-project"></span>
  <span style="color:#FF0000; display:block;" id="error-teaser"></span>
  <span style="color:#FF0000; display:block;" id="error-detail"></span>
  <span style="color:#FF0000;display:block;" id="error-image"></span>
 
   </div> 

<form action="create" method="post" onsubmit="return validateForm()" enctype="multipart/form-data">
<div id="error-div" class="errorMessage" style="display: none;"></div>
  <div class="float-left">
    <p class="reg-left-text">Project Name <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" name="project_name" id="project_name"  class="form-control" placeholder="Enter Project Name" />
    </p>
  </div>
    <div class="float-left">
    <p class="reg-left-text">teaser<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <textarea type="text" value="" name="teaser" id="teaser" class="ckeditor1" /></textarea>
     <script type="text/javascript">
var editor = CKEDITOR.replace( 'detail_content', {
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
    <p class="reg-left-text">Project Detail<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <textarea type="text" value="" name="project_details" id="project_details" class="ckeditor1" /></textarea>
     <script type="text/javascript">
var editor = CKEDITOR.replace( 'detail_content', {
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
    <p class="reg-left-text">Select Images<font color="#FF0000">*</font></p>
	<p class="reg-right-field-area margin-left-5">
    <input id="project_image" type="file" name="project_image" accept="image/*">
    </p>
    </div>
  <div class="float-left">
    <p class="reg-left-text">Status<font color="#FF0000">*</font></p>
	<p class="reg-right-field-area margin-left-5">
    <select name="status">
<option value="">Select </option>
<option value="1">Active</option>
<option value="0">inActive</option>
</select>
    </p>
    </div>
	<div class="float-left">
    <button type="submit" class="btn btn-info">Add Project</button></div>
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