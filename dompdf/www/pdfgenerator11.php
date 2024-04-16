<?php
//set_time_limit(50);
ini_set('memory_limit', '-1');
ini_set('max_execution_time', 0);
require_once("../dompdf_config.inc.php");
// We check wether the user is accessing the demo locally
$local = array("::1", "127.0.0.1");

$is_local = in_array($_SERVER['REMOTE_ADDR'], $local);
if ( isset( $_POST["html"] )) {
    ini_set('memory_limit', '-1');
ini_set('max_execution_time', 0);
  if ( get_magic_quotes_gpc() )
    $_POST["html"] = stripslashes($_POST["html"]);
   try{ 
 $html=$_POST["html"];
// $html = preg_replace('/(\>)\s*(\<)/m', '$1$2', $html);
 $html = preg_replace('/>\s+</', "><", $html);
 $dompdf = new Dompdf(array('enable_remote' => true));
 $dompdf->load_html($html);
 

  
  $dompdf->set_paper($_POST["paper"], $_POST["orientation"]);
  $dompdf->render();
  $dompdf->stream("dompdf_out.pdf", array("Attachment" => false));
  exit(0);
       
   }
  catch(Exception $e){
      echo $e->getMessage() ;
  }
}
if ( isset( $_POST["html1"] )) {
  ini_set('memory_limit', '-1');
ini_set('max_execution_time', 0);
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
  $dompdf->stream("dompdf_out.pdf", array("Attachment" => false));
  exit(0);
     }
     catch(Exception $e)
     {
         echo $e->getMessage();
     }
}

    
 
?>
