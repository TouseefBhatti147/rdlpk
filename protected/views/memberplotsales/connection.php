<?php

$host="localhost";

$user="rdlpk_admin";

$password="creative123admin";

$databasename="rdlpk_db1";


$db = include($_SERVER["DOCUMENT_ROOT"] . '/con_db/db.php');
$con=mysqli_connect($db['host'],$db['username'],$db['password'],$db['db_name']);

//$con=  mysqli_connect($host,$user,$password,$databasename);



?>

