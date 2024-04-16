<?php 
include "../new.php";
$connection = Yii::app()->db;
$sqldel="Delete from  dmap where id='".$_REQUEST['id']."'";
$command = $connection -> createCommand($sqldel);
$command -> execute(); 
header("Location: developer.php?id=1");
?>