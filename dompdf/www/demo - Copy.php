
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
<!doctype html>
<html>
<head>


<meta charset="utf-8">
<title></title>
<style>
	
	
	@page { margin: 0px; }
	
	body {
		
	
margin: 0px;
background-image: url('http://localhost/dompdf/form2.jpg');
background-size: cover;
background-repeat:no-repeat;


	}


</style>
</head>

<body>
<div id="applicant_name" style="margin:155px 0 0 185px; position:absolute">667788</div>
<div id="membership_no" style="margin:153px 0 0 510px; position:absolute;">234874</div>

<div id="profile_pic" style="margin:125px 0 0 623px; position:absolute"><img src="http://localhost/dompdf/pro.jpg" width="100px" height="115px"></div>

<div id="project_check" style="margin:195px 0 0 185px; position:absolute"><img src="http://localhost/dompdf/check.png" width="20px" height="20px"></div>
<div id="other_check" style="margin:195px 0 0 435px; position:absolute"><img src="http://localhost/dompdf/check.png" width="20px" height="20px"></div>

<div id="125_square_yards_check" style="margin:258px 0 0 105px; position:absolute"><img src="http://localhost/dompdf/check.png" width="15px" height="15px"></div>
<div id="250_square_yards_check" style="margin:258px 0 0 269px; position:absolute"><img src="http://localhost/dompdf/check.png" width="15px" height="15px"></div>
<div id="500_square_yards_check" style="margin:258px 0 0 439px; position:absolute"><img src="http://localhost/dompdf/check.png" width="15px" height="15px"></div>
<div id="1000_square_yards_check" style="margin:258px 0 0 608px; position:absolute"><img src="http://localhost/dompdf/check.png" width="15px" height="15px"></div>

<div id="10_extra_check" style="margin:277px 0 0 105px; position:absolute"><img src="http://localhost/dompdf/check.png" width="15px" height="15px"></div>
<div id="facing_park_check" style="margin:275px 0 0 269px; position:absolute"><img src="http://localhost/dompdf/check.png" width="15px" height="15px"></div>
<div id="10_extra_west_opening_check" style="margin:275px 0 0 439px; position:absolute"><img src="http://localhost/dompdf/check.png" width="15px" height="15px"></div>
<div id="10_extra_corner_check" style="margin:275px 0 0 608px; position:absolute"><img src="http://localhost/dompdf/check.png" width="15px" height="15px"></div>

<div id="applicant_name" style="margin:368px 0 0 202px; position:absolute">Name Here</div>
<div id="so_wo_do" style="margin:368px 0 0 495px; position:absolute">Father Here</div>

<div id="date_of_birth" style="margin:440px 0 0 214px; position:absolute">01/01/2001</div>
<div id="domicile" style="margin:440px 0 0 555px; position:absolute">Islamabad</div>

<div id="occupation" style="margin:460px 0 0 175px; position:absolute">Land Lord</div>
<div id="husband_occupation" style="margin:478px 0 0 315px; position:absolute">Husband Occupation</div>
<div id="Mailing_Adress" style="margin:497px 0 0 235px; position:absolute">Mailing Adress</div>
<div id="Mailing_Adress_permanent" style="margin:534px 0 0 242px; position:absolute">Permanent Mailing Adress</div>
<div id="Tel_num_res" style="margin:573px 0 0 175px; position:absolute">6677882</div>
<div id="office" style="margin:573px 0 0 303px; position:absolute">9977882</div>
<div id="mobile" style="margin:573px 0 0 447px; position:absolute">0345-1122345</div>
<div id="email" style="margin:573px 0 0 588px; position:absolute">asdf@hotmail.com</div>
<div id="Membership_of_clubs" style="margin:592px 0 0 212px; position:absolute">Golf Club</div>

<div id="Nominee_name" style="margin:658px 0 0 187px; position:absolute">Nominee Name Goes Here</div>
<div id="Nominee_so-wo-do" style="margin:661px 0 0 459px; position:absolute">Nominee Name Goes Here</div>
<div id="Relationship_with_applicant" style="margin:715px 0 0 243px; position:absolute">Uncle</div>

<div id="payorder-bank-order" style="margin:776px 0 0 234px; position:absolute">23423423423423</div>
<div id="date" style="margin:776px 0 0 410px; position:absolute">10/10/2014</div>
<div id="bank" style="margin:797px 0 0 139px; position:absolute">Standard Charter</div>
<div id="total_amount_deposited" style="margin:797px 0 0 503px; position:absolute">40,00000/-</div>



<div id="cnic" style="margin:400px 0 0 137px; letter-spacing:6.5px; position:absolute;">234874878747563</div>
<div id="passport" style="margin:399px 0 0 480px; letter-spacing:7.5px; position:absolute;">87487874</div>

<div id="nominee_cnic" style="margin:682.5px 0 0 185px; letter-spacing:5.5px; position:absolute;">234874878747563</div>
<div id="nominee_passport" style="margin:682.5px 0 0 487px; letter-spacing:6.5px; position:absolute;">87487874</div>
</body>
</html>

</textarea>

<div style="text-align: center; margin-top: 1em;">
  <button type="submit" style="display:none;">Download</button>
</div>

</form>

<script type="text/javascript">
    document.getElementById('form1').submit(); // SUBMIT FORM
</script>
<?php } else { ?>

  <p style="color: red;">
    User input has been disabled for remote connections.
  </p>
  
<?php } ?>

<?php // include("foot.inc"); ?>