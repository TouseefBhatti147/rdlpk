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

<h3>Building Detail</h3>
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
<table class="table table-striped table-new table-bordered" width="100%" style="font-size:16px;">
 <tbody>
 <?php
$res=array();
$building_id=$_GET['id'];
foreach($buildings as $key){
	 $bstatus=$key['status'];
	?>
<tr><td colspan="3" style="text-align:center"><b> Building Detail</b>:</td></tr>
 <tr><td rowspan="3"><?php
  if(!empty($key['building_image'])){ echo'<img style="height:80px;" src="'.Yii::app()->request->baseUrl.'/images/buildings/'.$key['building_image'].'">'; }
  else { echo'<a href="update_buildings?id='.$building_id.'"> Update Image</a>';}
  ?>
  </td></tr>
 <tr><td>
    Project Name:</td><td>
    <?php echo $key['project_name'];?></td></tr>
 <tr><td>    Building Name</td><td>
    <?php echo $key['buildname'];?></td></tr><?php }?>
    <tr><td colspan="3" style="text-align:center"><b> Floor Detail</b>:</td></tr>
     <tr><td>Floor Name</td><td  colspan="2">
     <?php foreach($floors as $flor){
	 echo $flor['name'].',';
	 
	  }?>
     </td>
    </tr>
   
     </tbody></table>

      				<table class="table table-striped table-new table-bordered" width="100%" style="font-size:16px;">
 						<tbody>
                         <tr><td colspan="6" style="text-align:center"><b> Plot Detail</b>:</td></tr>			
 						<tr>
                        <td width="5%">Plot No</td>
                        <td width="5%">Plot Size</td>
                        <td width="5%">Dimension</td>
                        <td width="5%">Type</td>
                        <td width="5%">Street</td>
                        <td width="5%">Sector</td>
                        </tr>
                        <?php foreach($plots as $plots){?>
                        <tr>
                        <td width="5%"><?php echo $plots['plot_detail_address'];?></td>
                        <td width="5%"><?php echo $plots['size'];?></td>
                        <td width="5%"><?php echo $plots['plot_size'];?></td>
                        <td width="5%"><?php echo $plots['com_res'];?></td>
                        <td width="5%"><?php echo $plots['street'];?></td>
                        <td width="5%"><?php echo $plots['sector_name'];?></td>
                        </tr>
                        <?php }?>
 </tbody></table>
<?php 
//echo $bstatus;

if($bstatus==2){?>
<div style="background-color:#0CF; width:1000px;height:200px;">
<br/>
<form name="frmassign" id="frmassign" method="post" action="assignbuilding">

<select name="status" id="status">
<option value="1">Approve</option>
<option value="0">Cancel</option>
</select>
<input type="hidden" name="building_id" id="building_id" value="<?php echo $building_id;?>" />
<input type="submit"  name="approved" value="approve" />

</form>
</div>
<?php }?>
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