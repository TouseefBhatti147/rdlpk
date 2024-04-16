<?php


require_once("../dompdf_config.inc.php");
// We check wether the user is accessing the demo locally
$local = array("::1", "127.0.0.1");
$is_local = in_array($_SERVER['REMOTE_ADDR'], $local);
$db = include($_SERVER["DOCUMENT_ROOT"] . '/con_db/db.php');
//$db = include($_SERVER["DOCUMENT_ROOT"] . '/rdlpklive/con_db/db.php');
$conn=mysqli_connect($db['host'],$db['username'],$db['password'],$db['db_name']);

	//$conn=mysqli_connect("localhost","rdlpk_admin","creative123admin","rdlpk_db1");
	if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
 $sql1="SELECT * FROM memberplot where plot_id='".$_REQUEST['plot_id']."' ";
$result1 = mysqli_query($conn,$sql1); 	
while($row1 = mysqli_fetch_array($result1))
  {
if(empty($_POST['ms_letter'])){$ms_letter=$row1['ms_letter'];}else{$ms_letter=1;}
if(empty($_POST['allotment_letter'])){$allotment_letter=$row1['allotment_letter'];}else{$allotment_letter=1;}
if(empty($_POST['ndc_letter'])){$ndc_letter=$row1['ndc_letter'];}else{$ndc_letter=1;}
if(empty($_POST['allotment_certificate'])){$allotment_certificate=$row1['allotment_certificate'];}else{$allotment_certificate=1;}
if(empty($_POST['transfer_letter'])){$transfer_letter=$row1['transfer_letter'];}else{$transfer_letter=1;}
if(empty($_POST['balloting_detail'])){$balloting_detail=$row1['balloting_detail'];}else{$balloting_detail=1;}
if(empty($_POST['transfer_slip'])){$transfer_slip=$row1['transfer_slip'];}else{$transfer_slip=1;}
if(empty($_POST['allotment_letter_al'])){$allotment_letter_al=$row1['allotment_letter_al'];}else{$allotment_letter_al=1;}


  $sql="UPDATE memberplot set ms_letter='".$ms_letter."',
transfer_slip='".$transfer_slip."',
allotment_letter='".$allotment_letter."',
ndc_letter='".$ndc_letter."',
allotment_certificate='".$allotment_certificate."',
transfer_letter='".$transfer_letter."',
balloting_detail='".$balloting_detail."',
allotment_letter_al='".$allotment_letter_al."' WHERE plot_id='".$_REQUEST['plot_id']."' ";
  }



if (mysqli_query($conn, $sql)) {
  $is_local = in_array($_SERVER['REMOTE_ADDR'], $local);
if ( isset( $_POST["html1"] )) {
  
       if ( get_magic_quotes_gpc() )
    $_POST["html1"] = stripslashes($_POST["html1"]);
     try{
 $dompdf = new DOMPDF();
 $html=$_POST["html1"];
 $html = preg_replace('/(\>)\s*(\<)/m', '$1$2', $html);

 ///  $dompdf = new Dompdf(array('enable_remote' => true));
  $dompdf->load_html($html);
  $dompdf->set_paper($_POST["paper"], $_POST["orientation"]);
  $dompdf->render();
  $dompdf->stream("PDF File.pdf", array("Attachment" => false));
  exit(0);
     }
     catch(Exception $e)
     {
         echo $e->getMessage();
     }
}

} else {
  echo "Error updating record: " . mysqli_error($conn);
}
if ( isset( $_POST["html"] )) {
   
  if ( get_magic_quotes_gpc() )
    $_POST["html"] = stripslashes($_POST["html"]);
   try{ 
 $html=$_POST["html"];
 $html = preg_replace('/(\>)\s*(\<)/m', '$1$2', $html);



  $dompdf = new Dompdf(array('enable_remote' => true));
   $dompdf->load_html($html);
  
  $dompdf->set_paper($_POST["paper"], $_POST["orientation"]);
  $dompdf->render();
  $dompdf->stream("PDF File.pdf", array("Attachment" => false));
  exit(0);
       
   }
  catch(Exception $e){
      echo $e->getMessage() ;
  }
}

/*$connection = Yii::app()->db;
$sql1="UPDATE plots set ms_letter='2323' WHERE id='".$_REQUEST['plot_id']."' ";
$command = $connection -> createCommand($sql1);
$command -> execute();*/


?>









