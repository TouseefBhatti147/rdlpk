

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

//$con=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

 if (mysqli_connect_errno())

  {

  echo "Failed to connect to MySQL: " . mysqli_connect_error();

  }



 $error ='';



$base=$_POST['username'];

if(empty($_POST['htbFMD']))

{



 $error.='<b style="color:red;">Please Put Your Thumb On Device</b></br>';

}





$result1 = mysqli_query($con,"SELECT * FROM members WHERE cnic='".$_POST['username']."'");
$result_data = mysqli_fetch_array($result1);
//echo $result_data['cnic'];exit;
if((isset($_POST['username']) && empty($_POST['username']))){
$error.="<b style=color:red;>Please Enter CNIC. <br>";
}
elseif($result_data['status']==''){
$error.='<b style="color:red;">Applicant Containing '.$base.' CNIC is Not Register Member.<br></b>';
}
if(!empty($error)){ echo $error;}else{
$result = mysqli_query($con,"SELECT * FROM members WHERE cnic='".$_POST['username']."'");
$row = mysqli_fetch_array($result);
require_once('phasher.class.php');		
$I = PHasher::Instance();
error_reporting(0);

$res1=$row['fp'];
$res2=$_POST['htbFMD'];


$comp = $I->CompareStrings($res1, $res2);
$comp=$comp*4;
// print_r($comp, true);
echo $comp;
if($comp>160){echo '<div style="width: 93px;

height: 22px;

padding: 45px;

color: white;

background-color: #0F0;

border-radius: 33px;

font-size: 18px;

font-weight: bold;">Verifyed</div>';}



if($comp<160){echo '<div style="width: 93px;

height: 22px;

padding: 45px;

color: white;

background-color: red;

border-radius: 33px;

font-size: 18px;

font-weight: bold;">Not Recognised</div>';}

exit;


}





?>

<style>#sohaib{ color:#CF0}</style>