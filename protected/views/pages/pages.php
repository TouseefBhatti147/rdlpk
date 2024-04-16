

<div class="shadow">

  <h1>Create Page</h1>

</div>

<!-- shadow -->

<hr noshade="noshade" >

<section class="reg-section margin-top-30">

<?php



$projects_data = Yii::app()->session['projects_array'];

?>



		
 <div style="height: 100px;

    padding: 0 0 0 32px;

    width: 140px;">

  <span style="color:#FF0000; display:block;" id="error-page_type"></span>

  <span style="color:#FF0000; display:block;" id="error-content_type"></span>

  <span style="color:#FF0000; display:block;" id="error-description"></span>

   </div> 
<form action="create" method="post"  onsubmit="return validateForm()" >

  







  

  <div class="float-left">

    <p class="reg-left-text">Page Type<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" value="" name="page_type" id="page_type" class="reg-login-text-field" />

    </p>

  </div> 

   

  <div class="float-left">

    <p class="reg-left-text">Content Type<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" value="" name="content_type" id="content_type" class="reg-login-text-field" />

    </p>

  </div>

  <div class="float-left">

    <p class="reg-left-text">Description(Area of Content)  <font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" value="" name="description" id="description" class="reg-login-text-field" />

    </p>

  </div>

  <div class="textedit">

    <p class="reg-left-text">Teaser<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <textarea class="ckeditor1" name="teaser" id="teaser"></textarea>

     <script type="text/javascript">

var editor = CKEDITOR.replace( 'teaser', {

    filebrowserBrowseUrl : '../../ckfinder/ckfinder.html',

    filebrowserImageBrowseUrl : '../../ckfinder/ckfinder.html?type=Images',

    filebrowserFlashBrowseUrl : '../../ckfinder/ckfinder.html?type=Flash',

    filebrowserUploadUrl : '../../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',

    filebrowserImageUploadUrl : '../../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',

    filebrowserFlashUploadUrl : '../../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'

});

CKFinder.setupCKEditor( editor, '../' );



 





</script>



    </p>

  </div>

 <div class="textedit">

    <p class="reg-left-text">Detail Content<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <textarea class="ckeditor1" name="detail_content" id="detail_content" /></textarea>

      

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







</script>



    </p>

  </div>

 

  <input name="submit" value="Add Pages" type="submit" class="btn-info pull-right" style="position: fixed; padding:5px; position:static; margin:0 0 30px 0;" />

    

 

   <!--VALIDATION START-->

 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<script>



function validateForm(){

	

	$("#error-page_type").hide();

	$("#error-content_type").hide();

	$("#error-description").hide();

	

	var k = $("#page_type").val();

	var x = $("#content_type").val();

	var y = $("#description").val();



var counter=0;



if (k==null || k=="")

  {

  $("#error-page_type").html("Enter Page Type");

  $("#error-page_type").show();

  counter =1;

  }

if (x==null || x=="")

  {

  $("#error-content_type").html("Enter Content Type");

  $("#error-content_type").show();

  counter =1;

  }

if (y==null || y=="")

  {

  $("#error-description").html("Enter Description");

  $("#error-description").show();

  counter =1;

  }

 

  

 if(counter==1)

  	return false;

  

}

</script>

 <!--VALIDATION END-->

 <script>

 

  $(document).ready(function()

     {  	

		

       $("#project").change(function()

           {

         	select_street($(this).val());

		   });

		   

		   $("#street_id").change(function()

           {

         	select_plot($(this).val());

		   });

     });

 

 

function select_street(id)

{

$.ajax({

      type: "POST",

      url:    "ajaxRequest?val1="+id,

	  contenetType:"json",

      success: function(jsonList){var json = $.parseJSON(jsonList);

var listItems='';

	$(json).each(function(i,val){

	listItems+= "<option value='" + val.id + "'>" + val.street + "</option>";

      

	

});listItems+="";



$("#street_id").html(listItems);

          }

    });

}

 

 

 



	 

function select_plot(id)

{

$.ajax({

      type: "POST",

      url:    "ajaxRequest1?val1="+id,

	  contenetType:"json",

      success: function(jsonList){var json = $.parseJSON(jsonList);

	  

var listItems='';

	$(json).each(function(i,val){

	listItems+= "<option value='" + val.id + "'>" + val.plot_detail_address +" ("+val.plot_size+")</option>";

  

});listItems+="";



$("#plot_id").html(listItems);

          }

    });

}



</script>



 </section>

<!-- section 3 --> 

