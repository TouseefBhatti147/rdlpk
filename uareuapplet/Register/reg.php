<?php 
$dbhost = 'localhost';
$dbname = 'rdlpk_db1';
$dbuser = 'rdlpk_admin';
$dbpass = 'creative123admin';
$db = include($_SERVER["DOCUMENT_ROOT"] . '/con_db/db.php');
$conn=mysql_connect($db['host'],$db['username'],$db['password']);

//$conn = mysql_connect($dbhost, $dbuser, $dbpass);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}

$con=mysqli_connect($db['host'],$db['username'],$db['password'],$db['db_name']);

//$con=mysqli_connect("localhost","rdlpk_admin","creative123admin","rdlpk_db1");
 $error ='';
 $base=$_POST['username'];
if(empty($_POST['htbFMD']))
{
 $error.='<b style="color:red;">Please Put Your Thumb On Device</b></br>';
}

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
$result = mysqli_query($con,"SELECT * FROM members WHERE cnic='".$_POST['username']."'");
$result_data = mysqli_fetch_array($result);
if((isset($_POST['username']) && empty($_POST['username']))){
$error.="<b style=color:red;>Please Enter CNIC. <br>";
}
elseif($result_data['status']==''){
$error.='<b style="color:red;">Applicant Containing '.$base.' CNIC is Not Register Member.<br></b>';
}

if(empty($error)){
$sql = "UPDATE members SET `fp`='".$_POST['htbFMD']."' WHERE cnic='".$_POST['username']."'";
mysql_select_db('rdlpk_db1');
$retval = mysql_query( $sql, $conn );}else{ echo $error;exit;}
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}else{
	
echo "Entered data successfully\n";


}



?>