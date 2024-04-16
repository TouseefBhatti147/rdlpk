<?php
//$db = include($_SERVER["DOCUMENT_ROOT"] . '/con_db/db.php');
$db = include('db1.php');
$con=mysqli_connect($db['host'],$db['username'],$db['password'],$db['db_name']);

//$con = mysqli_connect('localhost', 'rdlpk_admin', 'creative123admin', 'rdlpk_db1');


?>