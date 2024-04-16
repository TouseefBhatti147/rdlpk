<style>



.wc-text .btn-info {

	padding:10px 15px;

	border-radius:5px;

	color:#fff;

	text-decoration:none;

	}

	

.wc-text .btn-info:hover {

	background:#09F;

	}



</style>





<div class="my-content" style="font-size:14px;">

    	

        <div class="row-fluid my-wrapper">

<div class="shadow">

 <div class="span5 pull-right wc-text">





</div>

  <h3>Upload Plot Image</h3>

</div>

<!-- shadow -->

<hr noshade="noshade" class="hr-5 float-left">

<?php 

$user_data = Yii::app()->session['user_array'];

 ?>

<div class="float-left">

    <p class="reg-right-field-area margin-left-5">

<form method="post" action="plotimage" enctype="multipart/form-data">
<table align="center" border="1" bgcolor="#FFDFAA">
<tr><td>Image Name</td><td><input type="file" name="image" /></td></tr>
<input type="hidden" name="id" value="<?php echo $_GET['id'];?>" />

<tr><td><input type="submit" class="btn-info" value="Add Image" name="sub" ></tr>

</table>
</form>
  	

    </p>

    <div class="clearfix"></div>

  </div>

  

 </div>



  

