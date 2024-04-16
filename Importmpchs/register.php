<?php 
$host = "localhost";
$user  = "rdlpk_admin";
$password =  "creative123admin";
$database1 = "rdlpk_db1";

$db = include($_SERVER["DOCUMENT_ROOT"] . '/con_db/db.php');
$con=mysqli_connect($db['host'],$db['username'],$db['password'],$db['db_name']);
//$con=mysqli_connect("localhost",$user,$password, $database1);
if(isset($_POST['cnic']) && !empty($_POST['cnic']))
{
 if(isset($_POST['fp']) &&  !empty($_POST['fp']))
 {
    $sql = "SELECT * from members where cnic='".$_POST['cnic']."'";
    $result = mysqli_query($con,$sql);
    if(!empty($result))
    {
        while($row = mysqli_fetch_assoc($result)) 
        {
            $sql1 = "UPDATE members SET fp='".$_POST['fp']."' WHERE id='".$row['id']."'";
            
            if (mysqli_query($con, $sql1)) 
            {
                echo "Success";
            } else 
            {
                echo "Error updating record: " . mysqli_error($con);
            }   
        }
    }
 }    
}
else
{
    echo "Enter CNIC";
    
}
?>