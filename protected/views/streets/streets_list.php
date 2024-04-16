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
<div class="span5 pull-right wc-text"> <span style="float:right"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/streets/streets"  class="btn-info button">Add New Street</a></span> </div>
<h3>Streets List</h3>
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
<form action="streets_list" method="post">
<div class="clear-fix"></div>
<select name="project_id" id="project">
   <option value="">Select Project</option>
 			 <?php	
            $res=array();
            foreach($projects as $key){
            echo '
			<option value="'.$key['id'].'">'.$key['project_name'].'</option>'; 
            }?>
  </select>
   <select name="blocks" id="blocks">
  <option value="">Select Blocks</option>

  </select>
   <select name="sector" id="sector">
  <option value="">Select Sector</option>

  </select>
<!--      <input type="text" value="" name="cnic" id="cnic" class="new-input" placeholder="Enter Project Name" />
-->
<button name="submit" type="submit" class="btn btn-info btn-new">Search</button>
<table class="table-striped table-bordered table span12">
<thead>
</form>
<td style="width:5%;"><b>Id</b></td>
<td style="width:20%;"><b>Project Name</b></td>
<td style="width:20%;"><b>Block Name</b></td>
<td style="width:20%;"><b>Sector Name</b></td>
<td style="width:20%;"><b>Street Name</b></td>
<td style="width:20%;"><b>Create Date</b></td>
<td style="width:20%;"><b>Action</b></td>
</thead>
<?php
$res=array();

foreach($streets as $key){
echo '<tr><td>'.$key['id'].'</td><td>'.$key['project_name'].'</td><td>'.$key['block_name'].'</td><td>'.$key['sector_name'].'</td><td>'.$key['street'].'</td><td>'.$key['create_date'].'</td><td><a href="'.Yii::app()->request->baseUrl.'/index.php/streets/update_streets?id='.$key['id'].'">Edit</a><a href="'.Yii::app()->request->baseUrl.'/index.php/streets/Delete_streets?id='.$key['id'].'">/Delete</a></td></tr>';
}?>
</table>
</p>
<div class="clearfix"></div>
</div>
</div>
<script>
 $(document).ready(function()
     {  	
       $("#project").change(function()
           {
         	select_block($(this).val());
		   });
		   $("#blocks").change(function()
           {
         	select_sector($(this).val());
		   });
     });

 function select_block(id)
{
$.ajax({
      type: "POST",
      url:    "ajaxBlock?val1="+id,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var listItems='';
	listItems+= "<option value=''>Select Block</option>";
	$(json).each(function(i,val){
	
	listItems+= "<option value='" + val.id + "'>" + val.block_name + "</option>";
});listItems+="";
$("#blocks").html(listItems);
          }
    });
}
function select_sector(id)
{
	
	var pro=$("#project").val();
	var blk=$("#blocks").val();
	
$.ajax({
      type: "POST",
     /// url:    "ajaxRequest?val1="+id,
	  url:    "ajaxRequest?pro="+pro+"&&blk="+blk,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var listItems='';
	listItems+= "<option value=''>Select Sector</option>";
	$(json).each(function(i,val){
	listItems+= "<option value='" + val.id + "'>" + val.sector_name + "</option>";
});listItems+="";
$("#sector").html(listItems);
          }
    });
}

</script>
