<?php 
include "../../new.php";
$connection = Yii::app()->db;
if(isset($_POST['code'])){
if($_POST['code']==''){echo  'Area Not Selected'; exit; }
if($_POST['plotno']==''){echo  'Please Select Plot'; exit; }	
	$str = str_replace(' ','',$_POST['code']);
$sql_insert_member = "insert into dmap (project_id,map,plot_id) values('".$_REQUEST['id']."','".$str."','".$_REQUEST['plotno']."')";
$command = $connection -> createCommand($sql_insert_member);
$command -> execute();}
 $sql_payment  = "SELECT * FROM projects where id='".$_REQUEST['id']."'";
			$result_payments = $connection->createCommand($sql_payment)->queryRow();
			echo 'Shap Inserted';exit;
?>