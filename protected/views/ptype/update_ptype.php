

<div class="shadow">
  <h3>Update Project</h3>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5">
<section class="reg-section margin-top-30">

<form action="update_proj" method="post" enctype="multipart/form-data"> 
  <?php	
            $res=array();
            foreach($update_project as $key){
				
     echo ' 
  
  <div class="float-left">
    <p class="reg-left-text">Project Name <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="'.$key['project_name'].'" name="project_name"  id="first" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">

    <p class="reg-left-text">Project Code <font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" value="'.$key['code'].'" name="project_code" id="project_code"  class="form-control" placeholder="Enter Project Code" />

    </p>

  </div>
  <div class="float-left">
    <p class="reg-left-text">Teaser <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="'.$key['teaser'].'" name="teaser" id="teaser" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Details <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <textarea name="details" id="details" class="class="ckeditor1"">'.$key['details'].'</textarea>
     </p>
	 
  </div>
  
  <div class="float-left">
    <p class="reg-left-text">Project image<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <div style="height:85px; width:150px; border:1px solid;"><img src="'.Yii::app()->request->baseUrl.'/images/upload/ptype/'.$key['project_image'].'"></div>
    <span><input  style="height:25px;" type="file" name="project_image" value='.$key['project_image'].'  id="project_image"></span>
	</p>
  </div> 
  <div class="float-left">
    <p class="reg-left-text">Project Icon<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <div style="height:85px; width:150px; border:1px solid;"><img src="'.Yii::app()->request->baseUrl.'/images/upload/ptype/'.$key['icon'].'"></div>
    <span><input  style="height:25px;" type="file" name="project_icon" value='.$key['icon'].'  id="project_icon"></span>
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
 
  <div class="span12">
<div class="shadow">

  <h3>Content for project Detail</h3>

</div>

<hr noshade="noshade" class="hr-5 ">
<script language="javascript">
 $(document).ready(function() { $("#error").hide(); });
</script>

    <span style="color:#FF0000; display:block;" id="error-heading"></span>

  <span style="color:#FF0000; display:block;" id="error-detail"></span>

  <span style="color:#FF0000; display:block;" id="error-icon"></span>


<tbody><table id="tablea" class="table table-striped table-new table-bordered" >
<thead style="background:#666; border-color:#ccc; color:#fff;">
<tr>
<th width="3%">S No</th>
<th width="10%">Heading</th>
<th width="12%">Details</th>
<th width="9%">Image</th>
<th width="9%">icon</th>
<th width="10%">Action</th></tr>
</thead>

<?php
$count=0;
$count1=0;
foreach($project_detail as $row1){
$count++;
$count1++;
echo '<tr>
<td>'.$count.'</td>
<td>'.$row1['heading'].'</td>
<td>'.$row1['details'].'</td>
<td><img src="'.Yii::app()->baseUrl.'/images/upload/prodetail/'.$row1['icon'].'" width=40px/></td>
<td><img src="'.Yii::app()->baseUrl.'/images/upload/prodetail/'.$row1['images'].'" width=40px/></td>
<td><a href="#modal'.$count.'" role="button" class="btn" data-toggle="modal">Edit</a>
<a href="deletedetail?id='.$row1['id'].'&&pid='.$_REQUEST['id'].'" class="btn" >Delete</a>   </td>
</tr>';
echo '<div id="modal'.$count.'" class="modal hide fade">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h2>Edit</h2>
	</div>	
	<div class="modal-body">
<form action="update_detail" method="post" onsubmit="return validateForm1()" enctype="multipart/form-data">
		<label>Heading</label>
		<input name="heading" value="'.$row1['heading'].'" id="heading" type="text" name="heading" style="width:200px;" /></br>
		<label>Details</label>
		<textarea id="details" name="details" style="width:250px;">'.$row1['details'].'</textarea></br>
		<label>Update icon</label>
		<img src="'.Yii::app()->baseUrl.'/images/upload/prodetail/'.$row1['icon'].'" width=100px/>
		<input type="file" id="icon" name="icon" accept="image/*"></br>
		<label>Update images</label>
		<img src="'.Yii::app()->baseUrl.'/images/upload/prodetail/'.$row1['images'].'" width=100px/>
		<input type="file" name="images" id="images" accept="image/*" >
		<input type="submit" name="content"/></td></tr>
</form>
     </div>
</div>';

}?>
<form action="project_content" method="post" onsubmit="return validateForm1()" enctype="multipart/form-data">
<tr><td></td><td><input name="heading" id="heading" type="text" name="heading" style="width:200px;" /></td><td><textarea id="details" name="details" style="width:250px;"></textarea></td><td><input type="file" id="icon" name="icon" accept="image/*"></td><td><input type="file" name="images" id="images" accept="image/*" ></td><td><input type="submit" name="content"/></td></tr>
</tr><form> 
<input name="proid" type="hidden" value="<?php echo $id;?>" />
</tbody>
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



