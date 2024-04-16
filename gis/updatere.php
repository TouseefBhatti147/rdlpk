<?php 
include "../new.php";
$connection = Yii::app()->db;
$error='';
if($_POST['name']==''){$error .=  'Please Enter Name</br>'; }
if($_POST['for']==''){$error .=  'Please Enter Reservation Purpos</br>'; }	
if($_POST['type']==''){$error .= 'Please Select Type</br>';  }	
if($error!==''){
	echo $error;exit;
	}
	//$str = str_replace(' ','',$_POST['code']);
if(isset($_POST['type1'])){
	$sql_insert_member = "Update plot_reserved SET `name`='".$_POST['name']."',`for`='".$_POST['for']."',`comm`='".$_POST['comm']."',`type`='".$_POST['type']."' where plot_id='".$_POST['plot_id']."'";
$command = $connection -> createCommand($sql_insert_member);
$command -> execute();
	}else{
$sql_insert_member = "INSERT into plot_reserved (`plot_id`,`name`,`for`,`comm`,`type`,`create_date`,`uid`) 
	values('".$_POST['plot_id']."','".$_POST['name']."','".$_POST['for']."','".$_POST['comm']."','".$_POST['type']."','','1')";
$command = $connection -> createCommand($sql_insert_member);
$command -> execute();}
 echo 'Updated';
 exit;
?>