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
<div class="span5 pull-right wc-text"> <span style="float:right"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/reciept/add_target"  class="btn-info button">Add New Target</a></span> </div>
<h3>Target List</h3>
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

<form action="target_list" method="post">

<select name="year" id="year" onchange="Myfunc()">
   <option value="">Select Year</option>
 		<option value="2014">2014</option>
            <option value="2015">2015</option>
            <option value="2016">2016</option>
            <option value="2017">2017</option>
            <option value="2018">2018</option>	
  </select>
   <select name="month" id="month" style="display:none;">
  <option value="">Select Month</option>
	<option value="01">January</option>
            <option value="02">February</option>
            <option value="03">March</option>
            <option value="04">April</option>
            <option value="05">May</option>
            <option value="06">June</option>
            <option value="07">July</option>
            <option value="08">August</option>
            <option value="09">September</option>
            <option value="10">October</option>
            <option value="11">November</option>
            <option value="12">December</option>
  </select>
<!--      <input type="text" value="" name="cnic" id="cnic" class="new-input" placeholder="Enter Project Name" />
-->
<button name="submit" type="submit" class="btn btn-info btn-new">Search</button>
<table class="table-striped table-bordered table span12">
<thead>
</form>
<td style="width:5%;"><b>Id</b></td>
<td style="width:20%;"><b>Year</b></td>
<td style="width:20%;"><b>Month</b></td>
<td style="width:20%;"><b>Target</b></td>

<td style="width:20%;"><b>Action</b></td>
</thead>
<?php
$res=array();
$i=0;
foreach($streets as $key){
	$i++;
echo '<tr><td>'.$i.'</td><td>'.$key['year'].'</td><td>'.$key['month'].'</td><td>'.$key['target'].'</td><td><a href="'.Yii::app()->request->baseUrl.'/index.php/reciept/update_target?id='.$key['id'].'">Edit</a><a href="'.Yii::app()->request->baseUrl.'/index.php/reciept/Delete_target?id='.$key['id'].'">/Delete</a></td></tr>';
}?>
</table>
</p>
<div class="clearfix"></div>
</div>
</div>

	
	<script>
function Myfunc(){
	
	document.getElementById('month').style.display="inline";
	}

</script>

