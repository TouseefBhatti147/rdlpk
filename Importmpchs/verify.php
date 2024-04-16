<?php 
$host = "localhost";
$user  = "rdlpk_admin";
$password =  "creative123admin";

$database1 = "rdlpk_db1";
$db = include($_SERVER["DOCUMENT_ROOT"] . '/con_db/db.php');
$con=mysqli_connect($db['host'],$db['username'],$db['password'],$db['db_name']);

//$con=mysqli_connect("localhost",$user,$password, $database1);
if(isset($_REQUEST['cnic']) && !empty($_REQUEST['cnic']))
{
    $sql = "SELECT * from members where cnic='".$_REQUEST['cnic']."'";
    $result = mysqli_query($con,$sql);
    while($row = mysqli_fetch_assoc($result)) 
    {
        echo $row['fp'];
        //$row1[] = array('name'=>$row['fp']);
        //echo json_encode(array('row1' => $row['fp']));
    }
}
?>