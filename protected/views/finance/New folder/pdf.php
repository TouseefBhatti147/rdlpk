
<div>
<h3>Download Documents</h3>
<p>Download all required Documents in PDF Format </p>
</div>
<?php
	$res=array();
    foreach($member as $member){
?>
<!-- <h3 align="center">Please Wait While System is Generating PDF..</h3> -->
<table class="table table-striped table-new table-bordered">
<thead style="background:#666; border-color:#ccc; color:#fff;">
<tr>
  <th>Report Type</th>
  <th>Allotment Certificate</th>
<th>Allotment Letter</th>
<th>No-Demand Certificate</th>
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
<div id="profile_pic" style="margin:345px 0 0 100px; position:absolute;"><img src="<?php echo Yii::getPathOfAlias('webroot')."/upload_pic/".$member['image'];  ?>" width="100px" height="115px"></div>
<div id="applicant_name" style="margin:490px 0 0 225px; position:absolute; font-weight:bold;"><?php echo $member['plotno']; 	 ?></div>
<div id="applicant_name" style="margin:490px 0 0 620px; position:absolute;"><?php echo $new_date;  	 ?></div>
<div id="email" style="margin:585px 0 0 160px; position:absolute; font-weight:bold;"><?php echo $member['name']; 	 ?></div>
<div id="plotid" style="margin:585px 0 0 525px; position:absolute;"><?php echo $member['plot_detail_address']; 	 ?></div>
<div id="email" style="margin:615px 0 0 200px; position:absolute;"><?php echo $member['sodowo']; 	 ?></div>
<div id="email" style="margin:615px 0 0 525px; position:absolute;"><?php echo $member['sector'].'/'.$member['street']; 	 ?></div>
<div id="email" style="margin:650px 0 0 525px; position:absolute;"><?php echo $member["size"]." (".$member['plot_size'].")"; 	 ?></div>
<div id="email" style="margin:650px 0 0 160px; position:absolute; width:250px;"><?php echo $member['address']; 	 ?></div>
<div id="email" style="margin:690px 0 0 160px; position:absolute;"><?php echo $member['phone']; 	 ?></div>
<div id="email" style="margin:690px 0 0 525px; position:absolute;"><?php echo $member['com_res']; 	 ?></div>

</body>
</html>
</textarea>
<div style="text-align: left; margin-top: 1em;">
  <button type="submit">Download Allotment Certificate</button>
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
$old_date = $member['create_date'];            
$middle = strtotime($old_date);             
$new_date = date('d-m-Y', $middle); 

 ?>
<div id="applicant_name" style="margin:225px 0 0 370px; position:absolute; font-weight:bold;"><?php echo $member['plotno']; 	 ?></div>
<div id="applicant_name" style="margin:220px 0 0 645px; position:absolute;"><?php echo $new_date; 	 ?></div>
<div id="membership_no" style="margin:260px 0 0 370px; position:absolute; font-weight:bold;"><?php echo $member['name']; 	 ?></div>
<div id="membership_no" style="margin:290px 0 0 370px; position:absolute; width:350px;"><?php echo $member['sodowo']; 	 ?></div>
<div id="membership_no" style="margin:320px 0 0 310px; position:absolute;"><?php echo $member['address']; 	 ?></div>
<div id="profile_pic" style="margin:270px 0 0 75px; position:absolute;"><img src="<?php echo Yii::getPathOfAlias('webroot')."/upload_pic/".$member['image'];  ?>" width="100px" height="115px"></div>
<div id="applicant_name" style="margin:380px 0 0 625px; position:absolute;"><?php echo $member['phone']; 	 ?></div>
<div id="email" style="margin:593px 0 0 200px; position:absolute;"><?php echo $member['com_res']; 	 ?></div>
<div id="email" style="margin:593px 0 0 568px; position:absolute;"><?php echo $member['street']; 	 ?></div>
<div id="email" style="margin:625px 0 0 200px; position:absolute;"><?php echo $member["size"]." (".$member['plot_size'].")"; 	 ?></div>
<div id="email" style="margin:625px 0 0 568px; position:absolute;"><?php echo $member['sector']; 	 ?></div>
<div id="email" style="margin:655px 0 0 568px; position:absolute;"><?php /*echo $member['plot_detail_address'];*/ 	 ?></div>
<div id="email" style="margin:660px 0 0 200px; position:absolute;"><?php echo $member['plot_detail_address']; 	 ?></div>
<div id="email" style="margin:685px 0 0 400px; position:absolute;"></div>
<div id="email" style="margin:685px 0 0 568px; position:absolute;"><?php /*echo $member['plot_detail_address'];*/ 	 ?></div>
</body>
</html>
</textarea>
    <div style="text-align: left; margin-top: 1em;">
      <button type="submit">Download Allotment Letter</button>
      </div>
  </form>
</td>
<td>
  <form id="form" action="<?php echo Yii::app()->baseUrl; ?>/dompdf/www/pdfgenerator.php" method="post">
    
    
    
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
<div id="applicant_name" style="margin:487px 0 0 280px; position:absolute;"><?php echo "Not yet applied"; 	 ?></div>
</body>
</html>
</textarea>
  <div style="text-align: left; margin-top: 1em;">
    <button type="submit">Download Demand Certificate</button>
  </div>
  </form>
</td>
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
<div id="profile_pic" style="margin:345px 0 0 100px; position:absolute;"><img src="<?php echo Yii::getPathOfAlias('webroot')."/upload_pic/".$member['image'];  ?>" width="100px" height="115px"></div>
<div id="applicant_name" style="margin:500px 0 0 225px; position:absolute; font-weight:bold;"><?php echo $member['plotno']; 	 ?></div>
<div id="applicant_name" style="margin:500px 0 0 620px; position:absolute; font-weight:bold;"><?php echo $new_date;  	 ?></div>
<div id="email" style="margin:595px 0 0 160px; position:absolute; font-weight:bold;"><?php echo $member['name']; 	 ?></div>
<div id="plotid" style="margin:595px 0 0 525px; position:absolute;"><?php echo $member['plot_detail_address']; 	 ?></div>
<div id="email" style="margin:625px 0 0 200px; position:absolute;"><?php echo $member['sodowo']; 	 ?></div>
<div id="email" style="margin:625px 0 0 525px; position:absolute;"><?php echo $member['sector'].'/'.$member['street']; 	 ?></div>
<div id="email" style="margin:660px 0 0 525px; position:absolute;"><?php echo $member["size"]." (".$member['plot_size'].")"; 	 ?></div>
<div id="email" style="margin:660px 0 0 160px; position:absolute; width:250px;"><?php echo $member['address']; 	 ?></div>
<div id="email" style="margin:700px 0 0 160px; position:absolute;"><?php echo $member['phone']; 	 ?></div>
<div id="email" style="margin:700px 0 0 525px; position:absolute;"><?php echo $member['com_res']; 	 ?></div>

</body>
</html>
</textarea>
<div style="text-align: left; margin-top: 1em;">
  <button type="submit">Download Allotment Certificate</button>
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
<div id="applicant_name" style="margin:220px 0 0 370px; position:absolute; font-weight:bold;"><?php echo $member['plotno']; 	 ?></div>
<div id="applicant_name" style="margin:220px 0 0 655px; position:absolute;"><?php echo $new_date; 	 ?></div>
<div id="membership_no" style="margin:250px 0 0 300px; position:absolute; font-weight:bold;"><?php echo $member['name']; 	 ?></div>
<div id="membership_no" style="margin:280px 0 0 350px; position:absolute;"><?php echo $member['sodowo']; 	 ?></div>
<div id="membership_no" style="margin:320px 0 0 330px; position:absolute; width:350px;"><?php echo $member['address']; 	 ?></div>
<div id="profile_pic" style="margin:240px 0 0 80px; position:absolute;"><img src="<?php echo Yii::getPathOfAlias('webroot')."/upload_pic/".$member['image'];  ?>" width="100px" height="115px"></div>
<div id="applicant_name" style="margin:380px 0 0 640px; position:absolute;"><?php echo $member['phone']; 	 ?></div>

<div id="email" style="margin:600px 0 0 568px; position:absolute;"><?php echo $member['street']; 	 ?></div>
<div id="email" style="margin:632px 0 0 568px; position:absolute;"><?php echo $member['sector']; 	 ?></div>
<div id="email" style="margin:598px 0 0 200px; position:absolute;"><?php echo $member['com_res']; 	 ?></div>
<div id="email" style="margin:629px 0 0 200px; position:absolute;"><?php echo $member["size"]." (".$member['plot_size'].")"; 	 ?></div>
<div id="email" style="margin:670px 0 0 200px; position:absolute;"><?php echo $member['plot_detail_address']; 	 ?></div>
</body>
</html>
</textarea>
    <div style="text-align: left; margin-top: 1em;">
      <button type="submit">Download Allotment Letter</button>
      </div>
  </form>
</td>
<td>
  <form id="form" action="<?php echo Yii::app()->baseUrl; ?>/dompdf/www/pdfgenerator.php" method="post">
    
    
    
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
background-image: none;
background-size: cover;
background-repeat:no-repeat;
	}
</style>
</head>
<body>
<div id="applicant_name" style="margin:450px 0 0 260px; position:absolute;"><?php echo "Not yet applied"; 	 ?></div>
</body>
</html>
</textarea>
  <div style="text-align: left; margin-top: 1em;">
    <button type="submit">Download Demand Certificate</button>
  </div>
  </form>
</td>
</tr>
<?php } 	?>
</tbody>
</table>