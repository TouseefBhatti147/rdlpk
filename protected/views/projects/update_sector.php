

<div class="shadow">
  <h3>Update Project</h3>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5">
<section class="reg-section margin-top-30">

<form action="update_sec" method="post" enctype="multipart/form-data"> 
  <?php	
            $res=array();
            foreach($update_project as $key){
				
     echo ' 
  
     <div class="float-left">
     <p class="reg-left-text">Project Name <font color="#FF0000">*</font></p>
     <p class="reg-right-field-area margin-left-5">
       <input type="text" value="'.$key['project_name'].'" readonly="readonly" name="project_name"  id="first" class="reg-login-text-field" />
       <input type="hidden" value="'.$key['projectid'].'" readonly="readonly" name="projectid"  id="first" class="reg-login-text-field" />
     </p>
   </div>
   <div class="float-left">
   <p class="reg-left-text">Block Name <font color="#FF0000">*</font></p>
   <p class="reg-right-field-area margin-left-5">
     <input type="text" value="'.$key['block_name'].'" name="block_name" readonly="readonly"  id="first" class="reg-login-text-field" />
     <input type="hidden" value="'.$key['blockid'].'" readonly="readonly" name="blockid"  id="first" class="reg-login-text-field" />
   </p>
 </div>
     <div class="float-left">
    <p class="reg-left-text">Sector Name <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="'.$key['sector_name'].'" name="sector_name"   id="first" class="reg-login-text-field" />
    </p>
  </div>


  <div class="float-left">
    <p class="reg-left-text">Details <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <textarea name="details" id="details" class="class="ckeditor1"">'.$key['details'].'</textarea>
     </p>
	 
  </div>
  
 
 
  
  <div class="float-left">
<input type="hidden" id="id"  name="id" value="'.$key['id'].'"/>
</div>
  
 
   	
';

$id=$key['id'];	}?>
<input type="submit" class="btn-info button" name="update" value="Update" />		
 </form>		
	
 </section>
 
 

<hr noshade="noshade" class="hr-5 ">
<script language="javascript">
 $(document).ready(function() { $("#error").hide(); });
</script>

    <span style="color:#FF0000; display:block;" id="error-heading"></span>

  <span style="color:#FF0000; display:block;" id="error-detail"></span>

  <span style="color:#FF0000; display:block;" id="error-icon"></span>



</table>
 
</div>
<script>
function validateForm1(){

	

	$("#error-heading").hide();

	$("#error-detail").hide();

	$("#error-icon").hide();


	var k = $("#heading").val();

	var x = $("#details").val();

	var y = $("#icon").val();

var counter=0;
if (k==null || k=="")
  {
  $("#error-heading").html("Enter heading Name");

  $("#error-heading").show();

  counter =1;

  }

if (x==null || x=="")

  {

  $("#error-detail").html("Enter Detail ");

  $("#error-detail").show();

  counter =1;

  }

if (y==null || y=="")

  {

  $("#error-icon").html("Enter heading icon");

  $("#error-icon").show();

  counter =1;

  }

 if(counter==1)

  	return false;

  

}
</script>
<script type="text/javascript">

var editor = CKEDITOR.replace( 'details', {

    filebrowserBrowseUrl : '../../ckfinder/ckfinder.html',

    filebrowserImageBrowseUrl : '../../ckfinder/ckfinder.html?type=Images',

    filebrowserFlashBrowseUrl : '../../ckfinder/ckfinder.html?type=Flash',

    filebrowserUploadUrl : '../../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',

    filebrowserImageUploadUrl : '../../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',

    filebrowserFlashUploadUrl : '../../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'

});

CKFinder.setupCKEditor( editor, '../' );







</script>



