<div>

<h3>Download Documents</h3>

<p>Download all required Documents in PDF Format :</p></div>

<?php

	$res=array();

    foreach($member as $member){
$connection = Yii::app()->db;  
$ass  = "SELECT * from associates
LEFT JOIN members on associates.mid=members.id
 where msid=".$member['msid'];
$ass_result = $connection->createCommand($ass)->queryAll();
?>

<!-- <h3 align="center">Please Wait While System is Generating PDF..</h3> -->

<table class="table table-striped table-new table-bordered">

<thead style="background:#666; border-color:#ccc; color:#fff;">

<tr>

  <th>Report Type</th>

  <th>Allotment Certificate</th>

<th>Allotment Letter</th>

<th>No-Demand Certificate</th>

<th>Transfer Slip</th>
<th>Plot Details</th>

</thead>

<tbody>

<tr>

<td>

Print On Card

</td>

<td><form id="form" action="<?php echo Yii::app()->baseUrl; ?>/dompdf/www/pdfgenerator.php" method="post">







<input type="hidden" name="paper" value="a4">

<input type="hidden" name="orientation" value="portrait">

 

</select>

</p>



<textarea name="html1" style="display:none;" cols="60" rows="20">

<!doctype html>

<html>

<head>





<meta charset="utf-8">

<title></title>

<style>

	

	

	@page { margin: 0px; }

	

	body {

		

	

margin: 0px;



background-size: cover;

background-repeat:no-repeat;

	}

</style>

</head>

<body>

<div style="margin:80px 0 0 60px; position:absolute;">File # &nbsp;&nbsp;&nbsp;: <?php if($member['type']=='file'){  echo $member['plot_detail_address']; }else{ echo'';}

?></div>
<div id="email" style="margin:97px 0 0 59px; position:absolute;">CNIC # : <?php echo $member['cnic']; 	 ?></div>

<div id="profile_pic" style="margin:372px 0 0 100px; position:absolute;"><img src="<?php echo Yii::getPathOfAlias('webroot')."/upload_pic/".$member['image'];  ?>" width="100px" height="115px"></div>

<div id="applicant_name" style="margin:515px 0 0 225px; position:absolute; font-weight:bold;"><?php echo $member['plotno']; 	 ?></div>

<div id="applicant_name" style="margin:520px 0 0 645px; position:absolute;"><?php echo date('d-m-Y');  	 ?></div>

<div id="email" style="margin:610px 0 0 160px; position:absolute; font-weight:bold;"><?php echo $member['name']; if(!empty($ass_result)){echo '   *';}	 ?></div>

<div id="plotid" style="margin:610px 0 0 625px; position:absolute;"><?php  if($member['type']=='Plot'){  echo $member['plot_detail_address']; }else{ echo'...';} 	 ?></div>

<div id="email" style="margin:641px 0 0 200px; position:absolute;"><?php echo $member['sodowo']; 	 ?></div>

<div id="email" style="margin:640px 0 0 540px; position:absolute;"><?php echo $member['street']; 	 ?></div>

<div id="email" style="margin:680px 0 0 540px; position:absolute;"><?php echo $member['sector_name']; 	 ?></div>

<div id="email" style="margin:710px 0 0 540px; position:absolute;"><?php echo $member["size"]." (".$member['plot_size'].")"; 	 ?></div>

<div id="email" style="margin:671px 0 0 160px; position:absolute; width:250px; font-size:13px;"><?php echo $member['address']; 	 ?></div>

<div id="email" style="margin:711px 0 0 160px; position:absolute;"><?php echo $member['phone']; 	 ?></div>

<div id="email" style="margin:610px 0 0 525px; position:absolute;"><?php /*echo $member['com_res'];*/ 	 ?></div>

<?php 

$mar=890;
foreach($ass_result as $row1){echo '<div id="email" style="margin:'.$mar.'px 0 0 500px; font-size:12px; position:absolute;">*  '.$row1['name'].' </br>('.$row1['cnic'].')</div>'; $mar=$mar+15; }

?>

</body>

</html>

</textarea>

<div style="text-align: left; margin-top: 1em;">

  <button type="submit">Allotment Certificate</button>

</div>

</form></td>

<td>

  <form id="form1" action="<?php echo Yii::app()->baseUrl; ?>/dompdf/www/pdfgenerator.php" method="post">

    

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



background-size: cover;

background-repeat:no-repeat;





	}





</style>

</head>



<body>

<?php

$old_date = date('d-m-Y');            

$middle = strtotime($old_date);             

$new_date = date('d-m-Y', $middle); 



 ?>

<div id="applicant_name" style="margin:225px 0 0 370px; position:absolute; font-weight:bold;"><?php echo $member['plotno']; 	 ?></div>

<div id="applicant_name" style="margin:220px 0 0 645px; position:absolute;"><?php echo $new_date; 	 ?></div>

<div id="membership_no" style="margin:260px 0 0 370px; position:absolute; font-weight:bold;"><?php echo $member['name'];  if(!empty($ass_result)){echo '   *';}	 ?></div>

<div id="membership_no" style="margin:290px 0 0 370px; position:absolute; width:350px;"><?php echo $member['sodowo']; 	 ?></div>

<div id="membership_no" style="margin:320px 0 0 310px; position:absolute;"><?php echo $member['address']; 	 ?></div>

<div id="profile_pic" style="margin:270px 0 0 75px; position:absolute;"><img src="<?php echo Yii::getPathOfAlias('webroot')."/upload_pic/".$member['image'];  ?>" width="100px" height="115px"></div>

<div id="applicant_name" style="margin:380px 0 0 625px; position:absolute;"><?php echo $member['phone']; 	 ?></div>

<div id="email" style="margin:593px 0 0 200px; position:absolute;"><?php echo $member['com_res']; 	 ?></div>

<div id="email" style="margin:593px 0 0 568px; position:absolute;"><?php echo $member['street']; 	 ?></div>

<div id="email" style="margin:625px 0 0 200px; position:absolute;"><?php echo $member["size"]." (".$member['plot_size'].")"; 	 ?></div>

<div id="email" style="margin:625px 0 0 568px; position:absolute;"><?php echo $member['sector_name']; 	 ?></div>

<div id="email" style="margin:655px 0 0 568px; position:absolute;"><?php /*echo $member['plot_detail_address'];*/ 	 ?></div>

<div id="email" style="margin:660px 0 0 200px; position:absolute;"><?php echo $member['plot_detail_address']; 	 ?></div>

<div id="email" style="margin:685px 0 0 400px; position:absolute;"></div>

<div id="email" style="margin:685px 0 0 568px; position:absolute;"><?php /*echo $member['plot_detail_address'];*/ 	 ?></div>
<?php 

$mar=890;
foreach($ass_result as $row1){echo '<div id="email" style="margin:'.$mar.'px 0 0 500px; font-size:12px; position:absolute;">*  '.$row1['name'].' </br>('.$row1['cnic'].')</div>'; $mar=$mar+15; }

?>

</body>

</html>

</textarea>

    <div style="text-align: left; margin-top: 1em;">

      <button type="submit">Allotment Letter</button>

      </div>

  </form>

</td>

<td>

 

</td>
<td></td>
<td><form id="form" action="<?php echo Yii::app()->baseUrl; ?>/dompdf/www/pdfgenerator.php" method="post">







<input type="hidden" name="paper" value="a4">

<input type="hidden" name="orientation" value="portrait">

 

</select>

</p>



<textarea name="html1" style="display:none;" cols="60" rows="20">

<!doctype html>

<html>

<head>





<meta charset="utf-8">

<title></title>

<style>

	

	

	@page { margin: 0px; }

	

	body {

		

	

margin: 0px;



background-size: cover;

background-repeat:no-repeat;

	}

</style>

</head>

<body>

<div id="applicant_name" style="margin:270px 0 0 200px; position:absolute; font-weight:bold;"><?php echo $member['plotno']; 	 ?></div>

<div id="email" style="margin:225px 0 0 160px; position:absolute; font-weight:bold;"><?php echo $member['name']; 	 ?></div>
<div id="email" style="margin:225px 0 0 360px; position:absolute; font-weight:bold;"><?php echo $member['sodowo']; 	 ?></div>
<div id="email" style="margin:225px 0 0 560px; position:absolute; font-weight:bold;"><?php echo $member['cnic']; 	 ?></div>

<div id="plotid" style="margin:313px 0 0 160px; position:absolute;"><?php echo $member['plot_detail_address']; 	 ?></div>

<div id="email" style="margin:313px 0 0 335px; position:absolute;"><?php echo $member['street']; 	 ?></div>

<div id="email" style="margin:313px 0 0 525px; position:absolute;"><?php echo $member['sector_name']; 	 ?></div>


<?php 
$connection = Yii::app()->db;
$sql_payment  = "SELECT * FROM cat_plot
Left join categories on (cat_plot.cat_id=categories.id)
where cat_plot.plot_id='".$_REQUEST['id']."'";
$result_payments = $connection->createCommand($sql_payment)->queryAll();
foreach($result_payments as $row){?>
	<div id="email" style="margin:613px 0 0 525px; position:absolute;">
	<?php echo $row['title'].'----'.$row['echarges'];?></div>
	
<?php 	}?>



</body>

</html>

</textarea>

<div style="text-align: left; margin-top: 1em;">

  <button type="submit">Plot Details</button>

</div>

</form></td>
</tr>

<tr>

<td>

Direct Print<br />

(with background)</td>

<td><form id="form" action="<?php echo Yii::app()->baseUrl; ?>/dompdf/www/pdfgenerator.php" method="post">







<input type="hidden" name="paper" value="a4">

<input type="hidden" name="orientation" value="portrait">

 

</select>

</p>



<textarea name="html1" style="display:none;" cols="60" rows="20">

<!doctype html>

<html>

<head>





<meta charset="utf-8">

<title></title>

<style>

	

	

	@page { margin: 0px; }

	

	body {

		

	

margin: 0px;

background-image: url('<?php echo Yii::app()->baseUrl; ?>/dompdf/allotmentcertificate.jpg');

background-size: cover;

background-repeat:no-repeat;

	}

</style>

</head>

<body>

<div id="profile" style="margin:80px 0 0 60px; position:absolute;">File # &nbsp;&nbsp;&nbsp: <?php if($member['type']=='file') {  echo $member['plot_detail_address']; }else{ echo'';}  ?></div>

<div id="email" style="margin:98px 0 0 59px; position:absolute;"> CNIC # : <?php echo $member['cnic']; 	 ?></div>

<div id="profile_pic" style="margin:345px 0 0 100px; position:absolute;"><img src="<?php echo Yii::getPathOfAlias('webroot')."/upload_pic/".$member['image'];  ?>" width="100px" height="115px"></div>

<div id="applicant_name" style="margin:505px 0 0 200px; position:absolute; font-weight:bold;"><?php echo $member['plotno']; 	 ?></div>

<div id="applicant_name" style="margin:505px 0 0 615px; position:absolute; font-weight:bold;"><?php echo date('d-m-Y');  	 ?></div>

<div id="email" style="margin:595px 0 0 160px; position:absolute; font-weight:bold;"><?php echo $member['name']; if(!empty($ass_result)){echo '   *';} 	 ?></div>

<div id="plotid" style="margin:595px 0 0 590px; position:absolute;"><?php if($member['type']=='Plot'){  echo $member['plot_detail_address']; }else{ echo'...';}  	 ?></div>

<div id="email" style="margin:630px 0 0 200px; position:absolute;"><?php echo $member['sodowo']; 	 ?></div>

<div id="email" style="margin:630px 0 0 525px; position:absolute;"><?php echo $member['street']; 	 ?></div>

<div id="email" style="margin:660px 0 0 530px; position:absolute;"><?php echo $member['sector_name'] 	 ?></div>

<div id="email" style="margin:700px 0 0 525px; position:absolute;"><?php echo $member["size"]." (".$member['plot_size'].")"; 	 ?></div>

<div id="email" style="margin:660px 0 0 160px; position:absolute; width:250px; font-size:13px;"><?php echo $member['address']; 	 ?></div>

<div id="email" style="margin:700px 0 0 160px; position:absolute;"><?php echo $member['phone']; 	 ?></div>

<div id="email" style="margin:700px 0 0 525px; position:absolute;"><?php /*echo $member['com_res'];*/ 	 ?></div>

<?php 


$mar=890;
foreach($ass_result as $row1){echo '<div id="email" style="margin:'.$mar.'px 0 0 500px; font-size:12px; position:absolute;">*  '.$row1['name'].' </br>('.$row1['cnic'].')</div>'; $mar=$mar+15; }

?>

</body>

</html>

</textarea>

<div style="text-align: left; margin-top: 1em;">

  <button type="submit">Allotment Certificate</button>

</div>

</form></td>

<td>

  <form id="form1" action="<?php echo Yii::app()->baseUrl; ?>/dompdf/www/pdfgenerator.php" method="post">

    

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

background-image: url('<?php echo Yii::app()->baseUrl; ?>/dompdf/allotmentletter.jpg');

background-size: cover;

background-repeat:no-repeat;





	}





</style>

</head>



<body>

<?php

$old_date = $member['create_date'];            

$middle = strtotime($old_date);             

$new_date = date('d-m-Y', $middle); 



 ?>

<div id="applicant_name" style="margin:220px 0 0 350px; position:absolute; font-weight:bold;"><?php echo $member['plotno']; 	 ?></div>
<div id="applicant_name" style="margin:220px 0 0 665px; position:absolute;"><?php echo date('d-m-Y'); 	 ?></div>
<div id="membership_no" style="margin:250px 0 0 350px; position:absolute; font-weight:bold;"><?php echo $member['name']; 	 if(!empty($ass_result)){echo '   *';} ?></div>
<div id="membership_no" style="margin:285px 0 0 350px; position:absolute;"><?php echo $member['sodowo']; 	 ?></div>
<div id="membership_no" style="margin:320px 0 0 300px; position:absolute; width:350px;"><?php echo $member['address']; 	 ?></div>

<div id="profile_pic" style="margin:220px 0 0 80px; position:absolute;"><img src="<?php echo Yii::getPathOfAlias('webroot')."/upload_pic/".$member['image'];  ?>" width="100px" height="115px"></div>

<div id="applicant_name" style="margin:380px 0 0 640px; position:absolute;"><?php echo $member['phone']; 	 ?></div>

<div id="email" style="margin:605px 0 0 265px; position:absolute;"><?php echo  $member['plot_detail_address']; 	 ?></div>
<div id="email" style="margin:640px 0 0 205px; position:absolute;"><?php echo $member['street']; 	 ?></div>
<div id="email" style="margin:670px 0 0 205px; position:absolute;"><?php echo $member['sector_name']; 	 ?></div>

<div id="email" style="margin:605px 0 0 480px; position:absolute;"><?php echo $member["size"]." (".$member['plot_size'].")";	?></div>
<div id="email" style="margin:640px 0 0 480px; position:absolute;"><?php echo $member['com_res']; 	 ?></div>

<?php 

$mar=890;
foreach($ass_result as $row1){echo '<div id="email" style="margin:'.$mar.'px 0 0 500px; font-size:12px; position:absolute;">*  '.$row1['name'].' </br>('.$row1['cnic'].')</div>'; $mar=$mar+15; }

?>

</body>

</html>

</textarea>

    <div style="text-align: left; margin-top: 1em;">

      <button type="submit">Allotment Letter</button>

      </div>

  </form>

</td>

<td>

  <form id="form1" action="<?php echo Yii::app()->baseUrl; ?>/dompdf/www/pdfgenerator.php" method="post">

    

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

background-image: url('<?php echo Yii::app()->baseUrl; ?>/dompdf/nod.jpg');

background-size: cover;

background-repeat:no-repeat;





	}





</style>

</head>



<body>

<?php

$old_date = $member['create_date'];            

$middle = strtotime($old_date);             

$new_date = date('d-m-Y', $middle); 



 ?>

<div id="applicant_name" style="margin:470px 0 0 130px; position:absolute; font-weight:bold;"><?php echo $member['plotno']; 	 ?></div>



<div id="membership_no" style="margin:320px 0 0 200px; position:absolute; font-weight:bold;"><?php echo $member['name']; 	 ?></div>



<div id="email" style="margin:465px 0 0 300px; position:absolute;"><?php echo $member['street']; 	 ?></div>

<div id="email" style="margin:462px 0 0 450px; position:absolute;"><?php echo $member['sector_name']; 	 ?></div>

</body>

</html>

</textarea>

    <div style="text-align: left; margin-top: 1em;">

      <button type="submit">No Demand Certificate</button>

      </div>

  </form>

</td>

<td><form id="form" action="<?php echo Yii::app()->baseUrl; ?>/dompdf/www/pdfgenerator.php" method="post">







<input type="hidden" name="paper" value="a4">

<input type="hidden" name="orientation" value="portrait">

 

</select>

</p>



<textarea name="html1" style="display:none;" cols="60" rows="20">

<!doctype html>

<html>

<head>





<meta charset="utf-8">

<title></title>

<style>

	

	

	@page { margin: 0px; }

	

	body {

		

	

margin: 0px;



background-size: cover;

background-repeat:no-repeat;

	}

</style>

</head>

<body>

    <div  style=" margin:80px 0 0 80px;">
       
       	<span>Ref: RDBL/<?php echo $member['plotno'].'/'.date('Y'); 	 ?></span>
        <h4><?php echo $member['name']; 	 ?></h4>	
        <span><?php echo $member['address']; 	 ?></span><br>
        
		<h5><?php echo date('M-d-Y'); 	 ?></h5>
        <p>Subject:<strong>ALLOTMENT OF PLOT – ROYAL ORCHARD MULTAN</strong></p>
        <span>Dear Memebers,</span>
        <p>Balloting of <strong>Royal Orchard Multan</strong> was held on 09th April, 2016.You will be glad to know that all the members who applied for residential plots in this Housing Scheme have been accommodated.</p>
       <h5>According to the balloting result you have been allotted following Plot :</h5>
       <table >
  <thead>
    <tr>
      <th></th>
      <th>Plot Address</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">a</th>
      <td>Plot Size&nbsp &nbsp <strong><?php echo $member['size']; 	 ?></strong></td>
      <td></td>
    </tr>
    <tr>
      <th scope="row">b</th>
      <td>MS No. &nbsp &nbsp<strong><?php echo $member['plotno']; 	 ?></strong></td>
      
    </tr>
    <tr>
      <th scope="row">c</th>
      <td>Plot No.&nbsp &nbsp<strong><?php echo $member['plot_detail_address']; 	 ?></strong></td> 
      
    </tr>
    <tr>
      <th scope="row">d</th>
      <td>Street/Lane&nbsp &nbsp<strong><?php echo $member['street']; 	 ?></strong>	</td>
      
    
    </tr><tr>
      <th scope="row">e</th>
      <td>Block/Sector&nbsp &nbsp<strong><?php echo $member['sector_name']; 	 ?></strong></td>
      
     
    </tr>
  </tbody>
</table>
<table style="margin:-100px 0 0 300px;" >
  <thead>
    <tr>
     
      <th>Prime Location</th>
    </tr>
  </thead>
  <tbody>
   <?php 
$connection = Yii::app()->db;
$sql_payment  = "SELECT * FROM cat_plot
Left join categories on (cat_plot.cat_id=categories.id)
where cat_plot.plot_id='".$_REQUEST['id']."'";
$result_payments = $connection->createCommand($sql_payment)->queryAll();
foreach($result_payments as $row){?>
	
	<?php echo '<tr><td>'.$row['title'].'----'.$row['echarges'].'</tr></td>';?>
	
<?php 	}?>
  </tbody>
</table>
<p>The above plot address may vary balloted results due change in Town Planning by adding some new land and features.
In future you will be recognized with the above mentioned Plot address and membership Number. Prime location charges (if any) will be paid along with last installment.
May Allah bless you to make you live comfortably and peacefully in this prestigious Housing Project “Ameen”. 
Thanking you and assuring you our best services, we remain.
With profound Regards</p>
 <h4>Secretary</h4>
 <h4>Royal Orchard Multan</h4>
      
       
    </div>
  




</body>

</html>

</textarea>

<div style="text-align: left; margin-top: 1em;">

  <button type="submit">Transfer Slip</button>

</div>

</form></td>
<td><form id="form" action="<?php echo Yii::app()->baseUrl; ?>/dompdf/www/pdfgenerator.php" method="post">
<input type="hidden" name="paper" value="a4">
<input type="hidden" name="orientation" value="portrait">
</select>
</p>
<textarea name="html1" style="display:none;" cols="60" rows="20">
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>
<style>
	@page { margin: 0px; }
	body {
margin: 0px;
background-size: cover;
background-repeat:no-repeat;
	}
</style>
</head>
<body style=" margin:80px 40px 0 80px;">
<div style=" margin:80px 0 0 520px; position:absolute;">Dated:<?php echo date('d,M,Y'); 	 ?></div>
     
       	<div style=" margin:80px 10 0 0px; position:absolute;">Ref: RDBL/<?php echo $member['plotno'].'/'.date('Y'); 	 ?></div>
        <div style=" margin:120px 10 0 0px; position:absolute;"><strong><?php echo $member['name'];?> &nbsp; <?php echo $member['title'].'&nbsp;&nbsp;'	.$member['sodowo']; ?></strong></div>	
       <div style=" margin:140px 10 0 0px; position:absolute;"><?php  echo $member['address']; 	 ?></div><br>      
        <p  style=" margin:180px 10 0 0px; position:absolute;">Subject:&nbsp; <u><strong>Allotment of Plot – Royal Orchard Multan</strong><u></p>
     
       <p  style=" margin:225px 10 0 0px; position:absolute;">Balloting of <strong>Royal Orchard Multan</strong> was held on 08th April, 2016.You will be glad to know that all the members, who applied for residential plots in this Housing Scheme have been accommodated and you have been allotted following Plot:-</p>
	<table  style="margin:315px 10 0 0px; position:absolute;">
  <thead>
    <tr>
      <th></th>
      <th><u>Plot Address</u></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">a.</th>
      <td>MS No. &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <strong><?php echo $member['plotno']; 	 ?></strong></td>
     
      <td></td>
    </tr>
    <tr>
      <th scope="row">b.</th>
      <td>Plot Size&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <strong><?php echo $member['size']; 	 ?></strong></td>
       
    </tr>
    <tr>
      <th scope="row">c.</th>
      <td>Plot No.&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <strong><?php echo $member['plot_detail_address']; 	 ?></strong></td> 
      
    </tr>
    <tr>
      <th scope="row">d.</th>
      <td>Street/Lane&nbsp &nbsp &nbsp &nbsp &nbsp <strong><?php echo $member['street']; 	 ?></strong>	</td>
      
    
    </tr><tr>
      <th scope="row">e.</th>
      <td>Block/Sector&nbsp &nbsp &nbsp &nbsp <strong><?php echo $member['sector_name']; 	 ?></strong></td>
      
     
    </tr>
  </tbody>
</table>
	<table style="margin:315px 0 0 300px;" >
  <thead>
    <tr>
     
      <th><u>Prime Location Charges</u></th>
    </tr>
  </thead>
  <tbody>
   <?php 
$connection = Yii::app()->db;
$sql_payment  = "SELECT * FROM cat_plot
Left join categories on (cat_plot.cat_id=categories.id)
where cat_plot.plot_id='".$_REQUEST['id']."'";
$result_payments = $connection->createCommand($sql_payment)->queryAll();
foreach($result_payments as $row){?>
	
	<?php echo '<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row['title'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.'('.$row['charges'].'% extra'.')</tr></td>';?>
	
<?php 	}?>
  </tbody>
</table><br/><br/>
<div style="margin:100px 10 0 0px; position:absolute;" >
In future you will be recognized with the above mentioned Plot address and Membership number. Prime location charges (if any) will be paid along with last installment.<br>
<p>You are requested to note that due to continuous improvement in the town planning, few adjustments in certain cases have been made. Some diffrences in balloting results published on the web and above mentioned plot no is regretted. Previous allocations, weather checked/printed through web or any hard copy issued/marked may please be treated as cancelled.</p>
May Allah bless you to make you live comfortably and peacefully in this prestigious Housing Project “Ameen”. <br>Thanking you and assuring you our best services, we remain.<br><br>
With profound Regards<br><br><br><br><br><br>
 <strong>Secretary</strong><br>
 <strong>Royal Orchard Multan</strong>
</div>

</body>

</html>

</textarea>

<div style="text-align: left; margin-top: 1em;">

  <button type="submit">Plot Details</button>

</div>

</form></td>


</tr>

<?php } 	?>

</tbody>

</table>