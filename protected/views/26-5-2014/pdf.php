
<div><h3>Download Documents</h3>
<p>Download all Required Documents in PDF Format For Plot Trandfer </p>
</div> 



<!-- <h3 align="center">Please Wait While System is Generating PDF..</h3> -->
<form id="form1" action="<?php echo Yii::app()->baseUrl; ?>/dompdf/www/demo.php" method="post">

<?php
	$res=array();
    foreach($member as $member){
	
	
?>

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
<div id="applicant_name" style="margin:155px 0 0 185px; position:absolute"><?php //echo $member['name']; 	 ?></div>
<div id="membership_no" style="margin:153px 0 0 510px; position:absolute;"><?php  	 ?></div>

<div id="profile_pic" style="margin:125px 0 0 623px; position:absolute"><img src="<?php echo Yii::getPathOfAlias('webroot')."/member_profile_images/".$member['image'];  ?>" width="100px" height="115px"></div>

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

<div id="applicant_name" style="margin:368px 0 0 202px; position:absolute"><?php echo $member['name']; 	 ?></div>
<div id="so_wo_do" style="margin:368px 0 0 495px; position:absolute"><?php echo $member['sodowo']; 	 ?></div>

<div id="date_of_birth" style="margin:440px 0 0 214px; position:absolute"><?php echo $member['dob']; 	 ?></div>
<div id="domicile" style="margin:440px 0 0 555px; position:absolute"><?php echo $member['city']; 	 ?></div>

<div id="occupation" style="margin:460px 0 0 175px; position:absolute"></div>
<div id="husband_occupation" style="margin:478px 0 0 315px; position:absolute"></div>
<div id="Mailing_Adress" style="margin:497px 0 0 235px; position:absolute"><?php echo $member['address']; 	 ?></div>
<div id="Mailing_Adress_permanent" style="margin:534px 0 0 242px; position:absolute"></div>
<div id="Tel_num_res" style="margin:573px 0 0 175px; position:absolute"></div>
<div id="office" style="margin:573px 0 0 303px; position:absolute"></div>
<div id="mobile" style="margin:573px 0 0 447px; position:absolute"><?php echo $member['phone']; 	 ?></div>
<div id="email" style="margin:573px 0 0 588px; position:absolute"><?php echo $member['email']; 	 ?></div>
<div id="Membership_of_clubs" style="margin:592px 0 0 212px; position:absolute"></div>

<div id="Nominee_name" style="margin:658px 0 0 187px; position:absolute"><?php echo $member['nomineename']; 	 ?></div>
<div id="Nominee_so-wo-do" style="margin:661px 0 0 459px; position:absolute"></div>
<div id="Relationship_with_applicant" style="margin:715px 0 0 243px; position:absolute"></div>

<div id="payorder-bank-order" style="margin:776px 0 0 234px; position:absolute"></div>
<div id="date" style="margin:776px 0 0 410px; position:absolute"></div>
<div id="bank" style="margin:797px 0 0 139px; position:absolute"></div>
<div id="total_amount_deposited" style="margin:797px 0 0 503px; position:absolute"></div>



<div id="cnic" style="margin:400px 0 0 137px; letter-spacing:6.5px; position:absolute;"><?php echo $member['cnic']; 	 ?></div>
<div id="passport" style="margin:399px 0 0 480px; letter-spacing:7.5px; position:absolute;"></div>

<div id="nominee_cnic" style="margin:682.5px 0 0 185px; letter-spacing:5.5px; position:absolute;"></div>
<div id="nominee_passport" style="margin:682.5px 0 0 487px; letter-spacing:6.5px; position:absolute;"></div>
</body>
</html>

</textarea>





	<?php } 

	?>
    <div style="text-align: center; margin-top: 1em;">
  <button type="submit">Download Transfer Form</button>
</div>
</form>

<!--
<script type="text/javascript">
   document.getElementById('form1').submit(); // SUBMIT FORM
</script> -->