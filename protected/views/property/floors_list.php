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
<?php

if (isset($_GET['error']) and $_GET['error']==1)
{
echo "<script>window.alert('You Cannot Delete this Street');</script>";
}
?>
<div class="my-content">
<div class="row-fluid my-wrapper">
<div class="shadow">
<div class="span5 pull-right wc-text"> <span style="float:right"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/property/floors"  class="btn-info button">Add New Floor</a></span> 
</div>
<h3>Floors List</h3>
</div>
<?php /*
if($_REQUEST['note']!=''){echo '<div><p style="color: white;

background: rgb(94, 94, 255);
padding: 13px;
border-radius: 10px;
width: 387px;
opacity: 0.7;
font-weight: bold;">New Record Inserted Successfully</p></div>';}

*/
?>

<!-- shadow -->

<hr noshade="noshade" class="hr-5 ">
<?php
$user_data = Yii::app()->session['user_array'];

?>
<div class="">
<p class="reg-right-field-area margin-left-5">
<form action="floors_list" method="post">
<div class="clear-fix"></div>
<select name="project_id" id="project_id">
   <option value="">Select Project</option>
 			 <?php	
            $res=array();
            foreach($projects as $key){
            echo '
			<option value="'.$key['id'].'">'.$key['project_name'].'</option>'; 
            }?>
  </select>
   <select name="building_id" id="building_id">
 

  </select>
<!--      <input type="text" value="" name="cnic" id="cnic" class="new-input" placeholder="Enter Project Name" />
-->
<button name="submit" type="submit" class="btn btn-info btn-new">Search</button>
<table class="table-striped table-bordered table span12">
<thead>
</form>
<td style="width:5%;"><b>Id</b></td>
<td style="width:20%;"><b>Project Name</b></td>
<td style="width:20%;"><b>Building Name</b></td>
<td style="width:20%;"><b>Floor Name</b></td>
<td style="width:20%;"><b>No Of Shops/Office</b></td>

<td style="width:20%;"><b>Action</b></td>
</thead>
<?php
$res=array();

foreach($floors as $key){
echo '<tr><td>'.$key['id'].'</td><td>'.$key['project_name'].'</td><td>'.$key['buildname'].'</td><td>'.$key['name'].'</td><td>'.$key['no_of_shops'].'</td><td>
<a href="'.Yii::app()->request->baseUrl.'/index.php/property/update_floors?id='.$key['id'].'">Edit</a><a href="'.Yii::app()->request->baseUrl.'/index.php/property/delete_floors?id='.$key['id'].'">/Delete</a></td></tr>';
}?>
</table>
</p>
<div class="clearfix"></div>
</div>
</div>
<script>



 



    $(document).ready(function()
     {  	
       $("#project_id").change(function()
           {
         	select_building($(this).val());
		   });
     });


function select_building(id)
{
$.ajax({
      type: "POST",
      url:    "AjaxRequest4?val1="+id,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var listItems='';

	$(json).each(function(i,val){
	
	listItems+= "<option value='" + val.id + "'>" + val.name + "</option>";
});listItems+="";
$("#building_id").html(listItems);
          }
    });
}

 



</script>