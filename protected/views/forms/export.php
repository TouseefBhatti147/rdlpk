<div class="shadow">

  <h3>Export Data </h3>

</div>

<!-- shadow -->

<hr noshade="noshade" class="hr-5">

<section class="login-section margin-top-30">


<h5>Export Forms Data</h5>
<form action="csvexport" method="post">







<div id="" class="errorMessage" style="display: none; color:#F00; font-weight:bold;"></div>

   

    	<select name="project_id" id="project" style="width:180px;"><?php	
	
            $res=array();
			foreach($projects as $key){
            echo '<option value="'.$key['id'].'">'.$key['project_name'].'</option>'; 
            }?></select> 



  <button class="btn" type="submit">Export</button>
</form>

<h5>Export Forms(Payment) data</h5>
<hr noshade="noshade" class="hr-5">
<form action="csvexport1" method="post">







<div id="" class="errorMessage" style="display: none; color:#F00; font-weight:bold;"></div>

   
<div class="float-left">
<label>Projects:</label>

    	<select name="project_id" id="project" style="width:180px;"><?php	
	
            $res=array();
			foreach($projects as $key){
            echo '<option value="'.$key['id'].'">'.$key['project_name'].'</option>'; 
            }?></select> 
</div>

   <div class="float-left">
<label>Status:</label>
<select name="status" style="width:180px;">
<option value="0">New</option>
<option value="1">Approved</option>
<option value="2">On Hold</option>
<option value="3">Rejected</option>
<option value="4">Select All</option>
</select></div>
    <div class="float-left">
    <label>Type:</label>

<select name="type" id="type">
    <option value="membership">Membership</option>
    <option value="certificate">Certificate</option>
    <option value="Booking">Booking</option>
</select>
</div> 
 
<div class="float-left">
<label>Area:</label>
<?php 
 $connection = Yii::app()->db; 
$sql_seller  = "SELECT * from tbl_city";
$sellers = $connection->createCommand($sql_seller)->query();	
?>
<select name="city" style="width:180px;">
<option value="">Select Area</option>
<?php 
foreach($sellers as $row1){
	echo '<option value="'.$row1['city'].'">'.$row1['city'].'</option>';
	}
?>
</select></div>

  <button class="btn" type="submit">Export </button>
</form>