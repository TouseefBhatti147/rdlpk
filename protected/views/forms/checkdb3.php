  
  <?php 

  $connection = Yii::app()->db;
  $db = include($_SERVER["DOCUMENT_ROOT"] . '/con_db/db.php');
  $conn=mysql_connect($db['host'],$db['username'],$db['password']) or die(mysql_error());

//  $conn = mysql_connect('localhost','rdlpk_admin','creative123admin') or die(mysql_error());
$select_db = mysql_select_db($db['db_name'],$conn) or die(mysql_error());
				$sql = "select * from forms";
				$result = mysql_query($sql) or die(mysql_error());
 //echo 123;exit;
// $co=count($result_form);
 //$i=0; 

echo 'Booking</br>';
while($row = mysql_fetch_array($result)){
$result_form1='';
$form1='';
$co=0;
   $form1= "Select *, installform.id as fid from installform 
  left join forms on (forms.id=installform.form_id)
  where installform.type='booking' and installform.form_id='".$row['id']."'";
 $result_form1 = $connection->createCommand($form1)->queryAll(); 
$co=count($result_form1);
if($co>1){
	foreach($result_form1 as $row3)
	
	echo $row3['fid'].'-'.$row3['form_id'].'--'.$row3['formno'].'--'.$row3['name'].'</br>';
	}
}
?>