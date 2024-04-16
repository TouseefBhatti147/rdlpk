
<?php


require_once("../dompdf_config.inc.php");


// We check wether the user is accessing the demo locally
$local = array("::1", "127.0.0.1");
$is_local = in_array($_SERVER['REMOTE_ADDR'], $local);

if ( isset( $_POST["html"] ) && $is_local ) {

  if ( get_magic_quotes_gpc() )
    $_POST["html"] = stripslashes($_POST["html"]);
  
  $dompdf = new DOMPDF();
  $dompdf->load_html($_POST["html"]);
  $dompdf->set_paper($_POST["paper"], $_POST["orientation"]);
  $dompdf->render();

  $dompdf->stream("dompdf_out.pdf", array("Attachment" => false));

  exit(0);
}

?>
<?php //include("head.inc"); ?>




<?php if ($is_local) { ?>



<form id="form1" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">

<!--
<select name="paper">
<?php /*
foreach ( array_keys(CPDF_Adapter::$PAPER_SIZES) as $size )
  echo "<option ". ($size == "letter" ? "selected " : "" ) . "value=\"$size\">$size</option>\n"; */
?>
</select> -->

<input type="hidden" name="paper" value="a4">
<input type="hidden" name="orientation" value="portrait">
 
</select>
</p>

<textarea name="html" style="display:none;" cols="60" rows="20">
<?php

	echo $_POST["html"];

?>

</textarea>

<div style="text-align: center; margin-top: 1em;">
  <button type="submit" style="display:none;">Download</button>
</div>

<script type="text/javascript">
    document.getElementById('form1').submit(); // SUBMIT FORM
</script>
</form>


<?php } else { ?>

  <p style="color: red;">
    User input has been disabled for remote connections.
  </p>
  
<?php } ?>

<?php // include("foot.inc"); ?>