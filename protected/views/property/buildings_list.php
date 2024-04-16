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
<div class="span5 pull-right wc-text"> <span style="float:right"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/property/buildings"  class="btn-info button">Add New Building</a></span> </div>
<h3>Buildings List</h3>
</div>
<form action="buildings_list" method="post">
<div class="clear-fix"></div>
<select name="project_id" id="project_id" style="width:170px;">
  
 			 <?php	
            $res=array();
            foreach($projects as $key){
            echo '
			<option value="'.$key['id'].'">'.$key['project_name'].'</option>'; 
            }?>
  </select>
       <input style="width:180px;" type="text" value="" name="bname" id="bname" class="new-input" placeholder="Enter Building Name" />
       <select name="status" id="status" style="width:170px;">
       <option value="">Select Status</option>
       <option value="0">Not Alloted</option>
       <option value="1">Alloted</option>
       <option value="2">Requested</option>
       </select>
<button  name="submit" type="submit" class="btn btn-info btn-new">Search</button>
</form>

<!-- shadow -->


<?php
$user_data = Yii::app()->session['user_array'];

?>
<div class="">
<p class="reg-right-field-area margin-left-5">
<table class="table-striped table-bordered table span12">
<td style="width:5%;"><b>Id</b></td>
<td style="width:20%;"><b>Building Name</b></td>
<!--<td style="width:20%;"><b>Building Type</b></td>-->
<td style="width:20%;"><b>Project Name</b></td>
<td style="width:20%;"><b>Building Status</b></td>
<td style="width:20%;"><b>Action</b></td>
</thead>
<?php
$res=array();
$i=0;
foreach($buildings as $key){
$i++;
echo '<tr><td>'.$i.'</td><td>'.$key['name'].'</td><td>'.$key['project_name'].'</td><td>';
if($key['status']==0){echo' <span style="color:green">Not Alloted</span>';}
if($key['status']==1){echo'Alloted';}
if($key['status']==2){echo'Requested';}

echo'</td><td>';if(empty($key['status'])){ echo'<a href="'.Yii::app()->request->baseUrl.'/index.php/property/update_buildings?id='.$key['id'].'">Edit</a><a href="'.Yii::app()->request->baseUrl.'/index.php/property/Delete_buildings?id='.$key['id'].'">/Delete</a>';}if($key['status']!='0'){echo '<a style="font-size:16;color:green;"  href="building_detail?id='.$key['id'].' && plot_id='.$key['plot_id'].'"><b>View Detail</b></a>';}echo'</td></tr>';
}?>
</table>
</p>
<div class="clearfix"></div>
</div>
</div>
