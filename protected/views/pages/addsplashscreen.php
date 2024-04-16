
<div class="shadow">
  <h3>Add Splash Screen</h3>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5 ">
<section class="reg-section margin-top-30">
<?php 
$pages_data = Yii::app()->session['pages_array'];
$result_pages = Yii::app()->session['pages_array'];
?>
<form action="Addnewsplash" method="post" enctype="multipart/form-data">

<div class="float-left">
  <p class="reg-left-text">Heading<font color="#FF0000">*</font></p>
  <p class="reg-right-field-area margin-left-5">
    <input type="text" value="" name="heading" id="heading" class="reg-login-text-field" />
  </p>
</div>
<div class="float-left">
  <p class="reg-left-text">Detail <font color="#FF0000">*</font></p>
  <p class="reg-right-field-area margin-left-5">
        <textarea class="ckeditor1" name="detail" id="detail" /></textarea>
    <script type="text/javascript">
var editor = CKEDITOR.replace( 'detail', {
    filebrowserBrowseUrl : '../../ckfinder/ckfinder.html',

    filebrowserImageBrowseUrl : '../../ckfinder/ckfinder.html?type=Images',
    filebrowserFlashBrowseUrl : '../../ckfinder/ckfinder.html?type=Flash',
    filebrowserUploadUrl : '../../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
    filebrowserImageUploadUrl : '../../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
    filebrowserFlashUploadUrl : '../../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
});
CKFinder.setupCKEditor( editor, '../' );
</script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  </p>
</div>
<div class="float-left">
  <p class="reg-left-text">From (Date)<font color="#FF0000">*</font></p>
  <p class="reg-right-field-area margin-left-5">
     <input type="date" id="from" name="from">
    
  </p>
</div>
<div class="float-left">
  <p class="reg-left-text">To (Date)<font color="#FF0000">*</font></p>
  <p class="reg-right-field-area margin-left-5">
     <input type="date" id="to" name="to">
  </p>
</div>
<div class="float-left">
  <p class="reg-left-text">Status <font color="#FF0000">*</font></p>
  <p class="reg-right-field-area margin-left-5">
   <select name="status" id="status">
   <option value="1">Active</option>
   <option value="0">inActive</option>
   </select>
  </p>
</div>
<div class="float-left">
  <p class="reg-left-text">Image<font color="#FF0000">*</font></p>
  <p class="reg-right-field-area margin-left-5">
    <input type="file" name="image1" id="image1" class="reg-login-text-field" />
    
  </p>
</div>

 
<div class="float-left">
  <p class="reg-left-text"><font color="#FF0000"></font></p>
  <p class="reg-right-field-area margin-left-5">
   <button type="submit" class="btn btn-success">Submit</button>
    
  </p>
</div>






</section>
<!-- section 3 --> 
