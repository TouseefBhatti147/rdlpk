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
<div class="my-content">
<div class="row-fluid my-wrapper">
<div class="shadow">
<div class="span5 pull-right wc-text">
<span style="float:right"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/property/installmentplan"  class="btn-info button">Add New Plan</a></span>
</div>
<h3>Installment Plan Property List</h3>
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
<form action="Insplanlist" method="post"> 
  <div class="clear-fix"></div>
 	<select name="project_id" id="project_id" style="width:250px;"><option value="">Select Project </option> 
	<?php	
            $res=array();
            foreach($projects as $key1){
            echo '<option value="'.$key1['id'].'">'.$key1['project_name'].'</option>'; 
            }?></select> 
  <!--      <input type="text" value="" name="cnic" id="cnic" class="new-input" placeholder="Enter Project Name" />
    -->
   <button name="submit" type="submit" class="btn btn-info btn-new">Search</button>
<table class="table-striped table-bordered table span12"><thead>
</form>
<td style="width:5%;"><b>Id</b></td>
<td style="width:15%;"><b>Project Name</b></td>
<td style="width:15%;"><b>Size</b></td>
<td style="width:15%;"><b>Plan Description</b></td>
<td style="width:15%;"><b>Total No.</b></td>
<td style="width:15%;"><b>Total Amount</b></td>
<td style="width:15%;"><b>Action</b></td>
</thead>
<?php
$res=array();
foreach($streets as $key){
echo '<tr><td>'.$key['id'].'</td><td>'.$key['project_name'].'</td><td>'.$key['size'].'('.$key['dimension'].')'.'</td><td>'.$key['description'].'</td><td>'.$key['tno'].'</td><td style="text-align:right;">'.$key['tamount'].'</td><td><a target="_blank" href="'.Yii::app()->request->baseUrl.'/index.php/property/updateinstall?id='.$key['id'].'">Edit</a><a  href="'.Yii::app()->request->baseUrl.'/index.php/property/Delete?id='.$key['id'].'">/Delete</a></td></tr>';
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
