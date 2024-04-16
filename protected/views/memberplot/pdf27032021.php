  <meta charset="UTF-8">
<div>
<h3>Download Documents</h3>
<p>Download all required Documents in PDF Format :</p></div>
<?php
$hasassociate='';
$ms_letter='';
$allotment_letter='';
$transfer_letter='';
$ndc_letter='';
$transfer_slip='';
$ndc_letter='';
$balloting_detail='';
 $res=array();
 foreach($member as $member){
?>
<!-- <h3 align="center">Please Wait While System is Generating PDF..</h3> -->
<table class="table table-striped table-new table-bordered">
<thead style="background:#666; border-color:#ccc; color:#fff;">
 <th>Report Title</th>
  <th>Print On Card</th>
  <th>Drafts</th>
</thead>
<tbody>
 <tr>
<td>Membership Letter</td>
<td>
<?php if($member['ms_letter']==0){?>
<form id="form" action="<?php echo Yii::app()->baseUrl; ?>/dompdf/www/pdfgenerator.php" method="post">
<input type="hidden" name="paper" value="a4">
<input type="hidden" name="orientation" value="portrait">
</p>
<textarea name="html1" style="display:none;" cols="60" rows="20">

<title></title>
<style>
	@page { margin: 0px; }
	body {
margin: 0px;
background-size: cover;
background-repeat:no-repeat;
	}
</style>
<div style="margin:60px 50 0 80px; position:absolute; font-family: Arial Narrow,Arial,sans-serif; font-size:13px;">
<div style="margin:135px 0 0 510px; position:absolute;">
<strong><?php echo  date('M d,Y'); ?>
</strong></div>     
       	<div style=" margin:135px 0px 0 0px; position:absolute;"><strong>Ref: RDBL/<?php echo $member['plotno'].'/'.date('Y'); 	 ?></strong></div><br/>
        <div style=" margin:150px 10 0 0px; position:absolute;"><strong><?php echo $member['name'];?> &nbsp; <?php echo $member['title'].'&nbsp;&nbsp;'	.$member['sodowo']; ?></strong></div>
       <div style=" margin:170px 10 0 0px; position:absolute; width:60%;"><?php  echo $member['address']; 	 ?><br/><?php  echo $member['phone']; 	 ?></div><br/><br/>
	<br/><div style=" margin:170px 10 0 0px; position:absolute;"> <strong>Subject:&nbsp; <u>Membership – <?php echo $member['project_name'];?></strong><u>
     </div> 
     <div style=" margin:200px 10 0px 0px; position:absolute;">Registraion/ Transfer form no <?php echo $member['app_no'];?> refers
     </div> 
        <p  style=" margin:235px 10 0px 0px; position:absolute;">The Management of <strong>Royal Orchard Multan</strong> is pleased to welcome you, on becoming the member of this prestiogious Project. We are determined to provide Residential plot within the stipulated time frame.</p>
        
	<p  style=" margin:280px 10px 0 0px; position:absolute;">You have been allotted Membership no <strong><?php echo $member['plotno'];?></strong>, towards provisional allotment of <strong><?php echo $member['com_res'];?></strong> file of <strong><?php echo $member['plot_size'];?></strong> in <strong><?php echo $member['project_name'];?></strong></</strong>. In future this Membership no will be used as a reference.</p>
 <p  style=" margin:330px 10 0 0px; position:absolute;">Payment Schedule for the payment of further installments is attached. To avaoid any surcharge at later stage, you are required to pay installmenrs within the prescribed date of payment, through <strong>PO/Bank</strong> draft in favour of "<strong>Royal Developers and Builders (Pvt) Ltd</strong>".</p>
   
   <p  style=" margin:410px 10 0 0px; position:absolute;">Thanking you and assuring you our best services, at all times.</p>
    <br /><p  style=" margin:425px 10 0 0px; position:absolute;">With profound regards, <br /> <br /><br /> <br /><br /> <br /><strong>Secretary <br />Royal Orchard</strong></p>
    
    <br /><p  style="margin:230px; opx; 0px; 0px; position:absolute;"></p>
    
    </div>
</textarea>
<div style="text-align: left; margin-top: 1em;">
  <button type="submit">Membership Letter</button>
</div>
</form>
<?php }elseif($member['ms_letter']==2){
	 echo'Aleady Rquested';}else{ echo'<a href="reprint_ms_letter?plot_id='.$member['plot_id'].'">Request For Re-Print</a>';}?>
</td>
<td>
<form id="form" action="<?php echo Yii::app()->baseUrl; ?>/dompdf/www/pdfgenerator.php" method="post">
<input type="hidden" name="paper" value="a4">
<input type="hidden" name="orientation" value="portrait">
</p>
<textarea name="html1" style="display:none;" cols="60" rows="20">
<meta charset="UTF-8">

<title></title>
<style>
	@page { margin: 0px; }
	body {
margin: 0px;
background-size: cover;
background-repeat:no-repeat;
	}

.centered {
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
</style>

<div style="margin:60px 50 0 80px; position:absolute; font-family: Arial Narrow,Arial,sans-serif; font-size:13px;">
<div style="margin:135px 0 0 510px; position:absolute;">
<strong><?php echo  date('M d,Y'); ?>
</strong></div> 
<div style="margin:110px 0 0 10px; position:absolute;">
   <img src="<?php echo Yii::getPathOfAlias('webroot')."/images/draft.png";  ?>"  width="500px"> </div>
       	<div style=" margin:135px 0px 0 0px; position:absolute;"><strong>Ref: RDBL/<?php echo $member['plotno'].'/'.date('Y'); 	 ?></strong></div><br/>
        <div style=" margin:150px 10 0 0px; position:absolute;"><strong><?php echo $member['name'];?> &nbsp; <?php echo $member['title'].'&nbsp;&nbsp;'	.$member['sodowo']; ?></strong></div>
       <div style=" margin:170px 10 0 0px; position:absolute; width:60%;"><?php  echo $member['address']; 	 ?><br/><?php  echo $member['phone']; 	 ?></div><br/><br/>
	<br/><div style=" margin:170px 10 0 0px; position:absolute;"> <strong>Subject:&nbsp; <u>Membership – <?php echo $member['project_name'];?></strong><u>
     </div> 
     <div style=" margin:200px 10 0px 0px; position:absolute;">Registraion/ Transfer form no <?php echo $member['app_no'];?> refers
     </div> 
        <p  style=" margin:235px 10 0px 0px; position:absolute;">The Management of <strong>Royal Orchard Multan</strong> is pleased to welcome you, on becoming the member of this prestiogious Project. We are determined to provide Residential plot within the stipulated time frame.</p>
        
	<p  style=" margin:280px 10px 0 0px; position:absolute;">You have been allotted Membership no <strong><?php echo $member['plotno'];?></strong>, towards provisional allotment of <strong><?php echo $member['com_res'];?></strong> file of <strong><?php echo $member['plot_size'];?></strong> in <strong><?php echo $member['project_name'];?></strong></</strong>. In future this Membership no will be used as a reference.</p>
 <p  style=" margin:330px 10 0 0px; position:absolute;">Payment Schedule for the payment of further installments is attached. To avaoid any surcharge at later stage, you are required to pay installmenrs within the prescribed date of payment, through <strong>PO/Bank</strong> draft in favour of "<strong>Royal Developers and Builders (Pvt) Ltd</strong>".</p>
   
   <p  style=" margin:410px 10 0 0px; position:absolute;">Thanking you and assuring you our best services, at all times.</p>
    <br /><p  style=" margin:425px 10 0 0px; position:absolute;">With profound regards, <br /></p>
    
    <br /><p  style="margin:230px; opx; 0px; 0px; position:absolute;"></p>
    
    </div>
</textarea>
<div style="text-align: left; margin-top: 1em;">
  <button type="submit">Membership Letter Draft</button>
</div>
</form>
</td>
</tr>
    <tr>
<td>Allotment Certificate</td>
<td>
<?php if($member['allotment_certificate']==0){?>
<form id="form" action="<?php echo Yii::app()->baseUrl; ?>/dompdf/www/pdfgenerator.php" method="post">
<input type="hidden" name="paper" value="legal">
<input type="hidden" name="orientation" value="portrait">
</select>
</p>
<textarea name="html1" style="display:none;" cols="60" rows="20">
<!doctype html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

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
<div id="email" style="margin:80px 0 0 80px; position:absolute;">CNIC # : <?php echo $member['cnic']; 	 ?></div>
<div id="applicant_name" style="margin:375px 0 0 110px; position:absolute; font-size:14px;"> <?php if (empty( $member['image']))
          							  {
										 echo'<div style="height:100px;"></div>'; } else{    
										  echo'<img style="height:100px;"  src="'.Yii::getPathOfAlias('webroot').'/upload_pic/'.$member['image'].'"/>';
										 }
										  ?></div>
 <div id="applicant_name" style="margin:500px 0 0 225px; position:absolute; font-size:14px;"><?php echo $member['plotno']; 	 ?></div>
<div id="applicant_name" style="margin:500px 0 0 640px; position:absolute;"><?php echo date('d-m-Y');  
            // echo '05-08-2017';
?></div>
<div id="email" style="margin:595px 0 0 160px; position:absolute; font-size:14px;"><?php echo $member['name']; 	 ?></div>

<div id="plotid" style="margin:595px 0 0 600px; position:absolute; font-size:14px;"><?php if($member['type']=='Plot'){  echo $member['plot_detail_address']; }else{ echo'...';} 	 ?>
</div>
<?php
$connection = Yii::app()->db;
$sql_primeloc  = "SELECT *
FROM cat_plot
LEFT JOIN categories ON ( cat_plot.cat_id = categories.id )
WHERE cat_plot.plot_id ='".$member['plot_id']."'" ;
$result_primeloc = $connection->createCommand($sql_primeloc)->queryAll();
if(count($result_primeloc) >0)
{?>
	<div id="plotid" style="margin:580px 0 0 618px; position:absolute; font-size:12px;">
<?php foreach($result_primeloc as $row){
 echo $row['title'].'<br />'; }?>
</div>

<?php }?>

<div id="email" style="margin:625px 0 0 200px; position:absolute; font-size:14px;"><?php echo $member['sodowo']; 	 ?></div>
<div id="email" style="margin:625px 0 0 540px; position:absolute; font-size:14px;"><?php echo $member['street']; 	 ?></div>
<div id="email" style="margin:650px 0 0 170px; position:absolute; width:250px; font-size:12px;"><?php echo $member['address']; 	 ?></div>
<div id="email" style="margin:660px 0 0 540px; position:absolute; font-size:14px;"><?php echo $member['sector_name']; 	 ?></div>
<div id="email" style="margin:690px 0 0 160px; position:absolute; font-size:14px;"><?php echo $member['phone']; 	 ?></div>
<div id="email" style="margin:690px 0 0 540px; position:absolute; font-size:14px;"><?php echo $member['plot_size']; 	 ?></div>
 <?php $connection = Yii::app()->db;
$sql_assoc  = "SELECT *
FROM members
LEFT JOIN associates ON ( associates.mid = members.id )
LEFT JOIN memberplot ON ( memberplot.id = associates.msid )
WHERE associates.msid ='".$member['mpid']."'" ;
$result_assoc = $connection->createCommand($sql_assoc)->queryAll();
if(count($result_assoc) >0)
{
	$hasassociate=0;
	foreach($result_assoc as $as){
		if($as["msid"]!= "") $hasassociate=1;
	}
	if($hasassociate==1)
	{
	?>
	
<?php
	}
	
	foreach($result_assoc as $as){
?>         <div id="email" style="margin:910px 0 0 525px; position:absolute; font-size:12px"> <?php echo '* &nbsp;'. $as['name'];?> &nbsp; <?php echo '(' .$as['cnic'].')'; ?></div><br/><?php }}
	
?>

</body>
</html>
</textarea>
<div style="text-align: left; margin-top: 1em;">
  <button type="submit">Allotment Certificate</button>
</div>
</body>
</html>
</textarea>
</form>
<?php }elseif($member['allotment_certificate']==2){
	 echo'Aleady Rquested';}else{ echo'<a href="reprint_allotment_certificate?plot_id='.$member['plot_id'].'">Request For Re-Print</a>';}?>
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

<div id="email" style="margin:595px 0 0 160px; position:absolute; font-weight:bold;"><?php echo $member['name']; 	 ?></div>

<div id="plotid" style="margin:595px 0 0 590px; position:absolute;"><?php if($member['type']=='Plot'){  echo $member['plot_detail_address']; }else{ echo'...';}  	 ?></div>

<div id="email" style="margin:630px 0 0 200px; position:absolute;"><?php echo $member['sodowo']; 	 ?></div>

<div id="email" style="margin:630px 0 0 525px; position:absolute;"><?php echo $member['street']; 	 ?></div>

<div id="email" style="margin:660px 0 0 530px; position:absolute;"><?php echo $member['sector_name'] 	 ?></div>

<div id="email" style="margin:700px 0 0 525px; position:absolute;"><?php echo $member["size"]." (".$member['plot_size'].")"; 	 ?></div>

<div id="email" style="margin:660px 0 0 160px; position:absolute; width:250px; font-size:13px;"><?php echo $member['address']; 	 ?></div>

<div id="email" style="margin:700px 0 0 160px; position:absolute;"><?php echo $member['phone']; 	 ?></div>

<div id="email" style="margin:700px 0 0 525px; position:absolute;"><?php /*echo $member['com_res'];*/ 	 ?></div>



</body>

</html>

</textarea>

<div style="text-align: left; margin-top: 1em;">

  <button type="submit">Allotment Certificate Draft</button>

</div>

</form>
</td>
</tr>
<tr>
<td>
Allotmernt Letter</td>
<td>
<?php if($member['allotment_letter']==0){?>
  <form id="form1" action="<?php echo Yii::app()->baseUrl; ?>/dompdf/www/pdfgenerator.php" method="post">

    

    <input type="hidden" name="paper" value="a4">

    <input type="hidden" name="orientation" value="portrait">

    </select>

    </p>

    <textarea name="html" style="display:none;" cols="60" rows="20">

<!doctype html>

<html>

<head>
<meta charset="UTF-8">







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

<div id="applicant_name" style="margin:235px 0 0 370px; position:absolute; font-weight:bold;"><?php echo $member['plotno']; 	 ?></div>

<div id="applicant_name" style="margin:240px 0 0 665px; position:absolute;"><?php echo $new_date; 	 ?></div>

<div id="membership_no" style="margin:260px 0 0 350px; position:absolute; font-weight:bold;"><?php echo $member['name']; 	 ?></div>

<div id="membership_no" style="margin:300px 0 0 380px; position:absolute; width:350px;"><?php echo $member['sodowo']; 	 ?></div>

<div id="membership_no" style="margin:335px 0 0 310px; position:absolute;"><?php echo $member['address']; 	 ?></div>

<div id="profile_pic" style="margin:270px 0 0 75px; position:absolute;"><img src="<?php echo Yii::getPathOfAlias('webroot')."/upload_pic/".$member['image'];  ?>" width="100px" height="115px"></div>
<div id="applicant_name" style="margin:400px 0 0 75px; position:absolute;"><?php echo $member['cnic']; 	 ?></div>
<div id="applicant_name" style="margin:395px 0 0 635px; position:absolute;"><?php echo $member['phone']; 	 ?></div>

<div id="email" style="margin:610px 0 0 280px; position:absolute;"><?php echo $member['plot_detail_address']; 	 ?></div>

<div id="email" style="margin:615px 0 0 560px; position:absolute;"><?php echo $member['plot_size']; 	 ?></div>
<div id="email" style="margin:640px 0 0 560px; position:absolute;"><?php echo $member["com_res"]; 	 ?></div>
<div id="email" style="margin:640px 0 0 225px; position:absolute;"><?php echo $member['street']; 	 ?></div>
<div id="email" style="margin:670px 0 0 215px; position:absolute;"><?php echo $member['sector_name']; 	 ?></div>
<div id="email" style="margin:685px 0 0 400px; position:absolute;"></div>

<div id="email" style="margin:685px 0 0 568px; position:absolute;"><?php /*echo $member['plot_detail_address'];*/ 	 ?></div>
<?php $connection = Yii::app()->db;
$sql_assoc  = "SELECT *
FROM members
LEFT JOIN associates ON ( associates.mid = members.id )
LEFT JOIN memberplot ON ( memberplot.id = associates.msid )
WHERE associates.msid ='".$member['mpid']."'" ;
$result_assoc = $connection->createCommand($sql_assoc)->queryAll();
if(count($result_assoc) >0){
	$hasassociate=0;
	foreach($result_assoc as $as){
		if($as["msid"]!= "") $hasassociate=1;
	}	
	if($hasassociate==1)
	{
	?>
		 <div style="margin:890px 10 0 510px; position:absolute;">
       <span style="font-size:12px"><u><strong>Joint Members</strong>:<br /></u></span>   
<?php
	}	
	foreach($result_assoc as $as){
?>       
       <span style="font-size:12px"> &nbsp; <?php echo '* &nbsp;'. $as['name'];?> &nbsp; <?php echo '(' .$as['cnic'].')'; ?></span><br /><?php }}		
	if($hasassociate==1)
	{
		echo "</div>";
	}

?>
<div id="email" style="margin:1090px 0 0 40px; font-size:13px; position:absolute;">RDBL-<?php echo $member['id'];?></div>
</body>

</html>

</textarea>

    <div style="text-align: left; margin-top: 1em;">

      <button type="submit">Allotment Letter</button>

      </div>

  </form>
<?php }elseif($member['allotment_letter']==2){
	 echo'Aleady Rquested';}else{ echo'<a href="reprint_allotment_letter?plot_id='.$member['plot_id'].'">Request For Re-Print</a>';}?>
</td>
<td>
  <form id="form1" action="<?php echo Yii::app()->baseUrl; ?>/dompdf/www/pdfgenerator.php" method="post">
    <input type="hidden" name="paper" value="a4">
    <input type="hidden" name="orientation" value="portrait">
    </select>
    <textarea name="html" style="display:none;" cols="60" rows="20">
<!doctype html>
<html>
<head>
<title></title>

</head>
<body>
<?php
$old_date = $member['create_date'];            
$middle = strtotime($old_date);             
$new_date = date('d-m-Y', $middle); 
 ?>
<div id="applicant_name" style="margin:220px 0 0 350px; position:absolute; font-weight:bold;"><?php echo $member['plotno']; 	 ?></div>
<div id="applicant_name" style="margin:220px 0 0 665px; position:absolute;"><?php echo date('d-m-Y'); 	 ?></div>
<div style="margin:110px 0 0 10px; position:absolute;">
<img src="<?php echo Yii::getPathOfAlias('webroot')."/images/draft.png";  ?>"  width="500px"> </div>
<div id="membership_no" style="margin:250px 0 0 350px; position:absolute; font-weight:bold;"><?php echo $member['name']; 	 ?></div>
<div id="membership_no" style="margin:285px 0 0 350px; position:absolute;"><?php echo $member['sodowo']; 	 ?></div>
<div id="membership_no" style="margin:320px 0 0 300px; position:absolute; width:350px;"><?php echo $member['address']; 	 ?></div>
<div id="profile_pic" style="margin:220px 0 0 80px; position:absolute;"><img src="<?php echo Yii::getPathOfAlias('webroot')."/upload_pic/".$member['image'];  ?>" width="100px" height="115px"></div>
<div id="applicant_name" style="margin:340px 0 0 80px; position:absolute;"><?php echo $member['cnic']; 	 ?></div>
<div id="applicant_name" style="margin:380px 0 0 640px; position:absolute;"><?php echo $member['phone']; 	 ?></div>
<div id="email" style="margin:605px 0 0 265px; position:absolute;"><?php echo  $member['plot_detail_address']; 	 ?></div>
<div id="email" style="margin:640px 0 0 205px; position:absolute;"><?php echo $member['street']; 	 ?></div>
<div id="email" style="margin:670px 0 0 205px; position:absolute;"><?php echo $member['sector_name']; 	 ?></div>
<div id="email" style="margin:605px 0 0 480px; position:absolute;"><?php echo $member["size"]." (".$member['plot_size'].")";	?></div>
<div id="email" style="margin:640px 0 0 480px; position:absolute;"><?php echo $member['com_res']; 	 ?></div>
<?php $connection = Yii::app()->db;
$sql_assoc  = "SELECT *
FROM members
LEFT JOIN associates ON ( associates.mid = members.id )
LEFT JOIN memberplot ON ( memberplot.id = associates.msid )
WHERE associates.msid ='".$member['mpid']."'" ;
$result_assoc = $connection->createCommand($sql_assoc)->queryAll();
if(count($result_assoc) >0){
	$hasassociate=0;
	foreach($result_assoc as $as){
		if($as["msid"]!= "") $hasassociate=1;
	}	
	if($hasassociate==1)
	{
	?>
		 <div style="margin:960px 10 0 550px; position:absolute;">
<?php
	}	
	foreach($result_assoc as $as){?>       
       <span style="font-size:12px"> &nbsp; <?php echo '* &nbsp;'. $as['name'];?> &nbsp; <?php echo '(' .$as['cnic'].')'; ?></span><br /></div><?php }}		

?>
</body>
</html>
</textarea>
    <div style="text-align: left; margin-top: 1em;">
      <button type="submit">Allotment Letter Draft</button>
      </div>
  </form>

</td>
</tr>
<tr>
<td>
Transfer Letter</td>
<td>
<?php $connection = Yii::app()->db; if($member['transfer_letter']==0){?>
  <form id="form" action="<?php echo Yii::app()->baseUrl; ?>/dompdf/www/pdfgenerator.php" method="post">
<input type="hidden" name="paper" value="a4">
<input type="hidden" name="orientation" value="portrait">
</p>
<textarea name="html1" style="display:none;" cols="60" rows="20">
 
<title></title>

<style>
	@page { margin: 0px; }
	body {
margin: 0px;
background-size: cover;
background-repeat:no-repeat;
font-family: Arial Narrow;
	}
</style>
<?php $sql="Select 
				   m_from.name from_name,
				   m_from.sodowo from_sodowo,
				    m_from.title from_title,
				   m_to.sodowo to_sodowo,
				   m_to.title to_title,
				   m_to.name to_name,
				   m_to.address to_address,
				   m_to.phone to_phone,
				   transferplot.app_no
					   from transferplot
			Left JOIN members m_from ON m_from.id=transferplot.transferfrom_id
			Left JOIN members m_to ON m_to.id=transferplot.transferto_id where plot_id='".$member['plot_id']."' and (transferplot.status='Sales' or transferplot.status='New Request')";
			$result_details = $connection->createCommand($sql)->query();
			?>
            <?php foreach($result_details as $mdetail){?>
<div style="margin:60px 50 0 80px; position:absolute; font-family: Arial Narrow,Arial,sans-serif; font-size:14px;">
<div style="margin:135px 0 0 510px; position:absolute;">
<strong><?php echo  date('M d,Y'); ?>
</strong></div>     
       	<div style=" margin:135px 0px 0 0px; position:absolute;"><strong>Ref: RDBL/<?php echo $member['plotno'].'/'.date('Y'); 	 ?></strong></div><br/>
        <div style=" margin:150px 10 0 0px; position:absolute;"><strong><?php echo $mdetail['to_name'];?> &nbsp; <?php echo $mdetail['to_title'].'&nbsp;&nbsp;'	.$mdetail['to_sodowo']; ?></strong></div>
       <div style=" margin:170px 10 0 0px; position:absolute; width:70%;"><strong><?php  echo $mdetail['to_address']; 	 ?><br/><?php  echo $mdetail['to_phone']; 	 ?></strong></div><br/><br/><br/>
	<br/><div style=" margin:170px 10 0 0px; position:absolute;"> <strong>Subject:&nbsp; <u>Membership – &nbsp;(Transfer Case)&nbsp;<?php echo $member['project_name'];?>&nbsp;</strong><u>
     </div> 
     <div style=" margin:200px 10 0px 0px; position:absolute;">Registraion/ Transfer form no <?php echo $member['app_no'];?> refers
     </div> 
        <p  style=" margin:235px 10 0px 0px; position:absolute;">Transfer of under mentioned <strong><?php echo $mdetail['plot_size'];?></strong> plot from <strong>
		<?php echo $mdetail['from_name'].'&nbsp;'.$mdetail['from_title'].'&nbsp;'.$mdetail['from_sodowo'];?></strong> to your name has been accepted and approved:-<br /><br />
             &nbsp;&nbsp;&nbsp;&nbsp;   a. Plot No &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;           -  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $member['plot_detail_address'];?><br />
             &nbsp;&nbsp;&nbsp;&nbsp;   b. Street/Lane No &nbsp;&nbsp;&nbsp;     -  &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; <?php echo $member['street'];?><br />
             &nbsp;&nbsp;&nbsp;&nbsp;   c. Block No &nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;         -   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $member['sector_name'];?><br />
        </p><br /><br />
       <p  style=" margin:330px 10 0px 0px; position:absolute;">The Management of <strong><?php echo $member['project_name'];?></strong> is pleased to welcome you, on becoming the member of this prestigious Project. We are determined to provide Residential plot within the stipulated time frame.</p><br/>  
	<p  style=" margin:380px 10px 0 0px; position:absolute;">You have been allotted Membership no <strong><?php echo $member['plotno'];?></strong>, towards provisional allotment of <strong><?php echo $member['com_res'];?></strong> file of <strong><?php echo $member['plot_size']; if($member['atype']=='Against Land'){ echo'&nbsp;(Against Land)';}?> </strong>in <strong><?php echo $member['project_name'];?></strong></</strong>. In future this Membership no will be used as a reference.</p><br/><br/><br/>
    <?php $sqldue="Select dueamount,paidamount from installpayment where plot_id='".$member['plot_id']."'";
			$result_due = $connection->createCommand($sqldue)->query();
            $dueam=0;
            $paidam=0;
			foreach($result_due as $amount)
			{
				$dueam=$amount['dueamount']+$dueam;
				$paidam=$amount['paidamount']+$paidam;
			}
		
				
			?>
            <?php if($dueam!=$paidam){ 
         
            ?>
            
         
 <p  style="margin:390px 10 0 0px; position:absolute;">Payment Schedule for the payment of further installments is attached. To avaoid any surcharge at later stage, you are required to pay installmenrs within the prescribed date of payment, through <strong>PO/Bank</strong> draft in favour of "<strong>Royal Developers and Builders (Pvt) Ltd</strong>".</p>
  
  <p  style="margin:470px 10 0 0px; position:absolute;">Thanking you and assuring you our best services, at all times.</p>
    <br /><p  style=" margin:480px 10 0 0px; position:absolute;">With profound regards,<br /><br /> <br /><strong>Secretary <br />Royal Orchard</strong></p>
  
  <?php }else{

 
?> 
   <p  style="margin:390px 10 0 0px; position:absolute;">Thanking you and assuring you our best services, at all times.</p>
    <br /><p  style=" margin:410px 10 0 0px; position:absolute;">With profound regards,  <br /><br /> <br /><strong>Secretary <br />Royal Orchard</strong></p>
    
    <br /><p  style="margin:230px; opx; 0px; 0px; position:absolute;"></p>
    
    </div><?php }}?>
</textarea>
<div style="text-align: left; margin-top: 1em;">
  <button type="submit">Transfer Letter</button>
</div>
</form>
<?php }elseif($member['transfer_letter']==2){
	 echo'Aleady Rquested';}else{ echo'<a href="reprint_transfer_letter?plot_id='.$member['plot_id'].'">Request For Re-Print</a>';}?></td>
<td></td></tr>

<tr><td>No Demand Certificate</td><td>
<?php if($member['ndc_letter']==0){?>
  <form id="form1" action="<?php echo Yii::app()->baseUrl; ?>/dompdf/www/pdfgenerator.php" method="post">
    <input type="hidden" name="paper" value="a4">
    <input type="hidden" name="orientation" value="portrait">
    </select>
    </p>
    <textarea name="html" style="display:none;" cols="60" rows="20">
<!doctype html>
<html>
<head>
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
<?php }elseif($member['ndc_letter']==2){
	 echo'Aleady Rquested';}else{ echo'<a href="reprint_ndc_letter?plot_id='.$member['plot_id'].'">Request For Re-Print</a>';}?>
</td>
<td></td>
</tr>
<tr>
<td>Transfer Slip</td>
<td>
<?php if($member['transfer_slip']==0){?>
<form id="form" action="<?php echo Yii::app()->baseUrl; ?>/dompdf/www/pdfgenerator.php" method="post">
<input type="hidden" name="paper" value="a4">
<input type="hidden" name="orientation" value="portrait">
</select>
</p>
<textarea name="html1" style="display:none;" cols="60" rows="20">
<!doctype html>
<html>
<head>
<title></title>
<style>
	@page { margin: 0px; }
	body {
margin: 0px;
background-image: url('<?php echo Yii::app()->baseUrl; ?>/dompdf/transferslip.jpg');
background-size: cover;
background-repeat:no-repeat;
	}
</style>
</head>
<body>
<div id="applicant_name" style="margin:270px 0 0 200px; position:absolute; font-weight:bold;"><?php echo $member['plotno']; 	 ?></div>
<div id="email" style="margin:225px 0 0 160px; position:absolute; font-weight:bold;"><?php echo $member['name']; 	 ?></div>
<div id="plotid" style="margin:313px 0 0 160px; position:absolute;"><?php echo $member['plot_detail_address']; 	 ?></div>
<div id="email" style="margin:313px 0 0 335px; position:absolute;"><?php echo $member['street']; 	 ?></div>
<div id="email" style="margin:313px 0 0 525px; position:absolute;"><?php echo $member['sector_name']; 	 ?></div>
</body>
</html>
</textarea>
<div style="text-align: left; margin-top: 1em;">
  <button type="submit">Transfer Slip</button></div>
</form>
<?php }elseif($member['transfer_slip']==2){
	 echo'Aleady Rquested';}else{ echo'<a href="reprint_transfer_slip?plot_id='.$member['plot_id'].'">Request For Re-Print</a>';}?></td>
<td></td>
</tr>
<tr>
<td>Balloting Results</td>
<td>
<?php if($member['balloting_detail']==0){?>
<form id="form" action="<?php echo Yii::app()->baseUrl; ?>/dompdf/www/pdfgenerator.php" method="post">
<input type="hidden" name="paper" value="a4">
<input type="hidden" name="orientation" value="portrait">
</select>
</p>
<textarea name="html1" style="display:none;" cols="60" rows="20">
<!doctype html>
<html>
<head>
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
<? $maroy=15;?>
<body style=" margin:80px 40px 0 80px;">
<div style=" margin:<?php  echo 115;?>px 0 0 510px; position:absolute;">Dated:<?php echo  date('d M,Y'); 	 ?></div>
       	<div style=" margin:<?php echo 115;?>px 10 0 0px; position:absolute;">Ref: RDBL/<?php echo $member['plotno'].'/'.date('Y'); 	 ?></div><br/>
        <div style=" margin:<?php echo 140;?>px 10 0 0px; position:absolute;"><strong><?php echo $member['name'];?> &nbsp; <?php echo $member['title'].'&nbsp;&nbsp;'	.$member['sodowo']; ?></strong></div>
<?php 
$connection = Yii::app()->db;
$sql_assoc  = "SELECT *
FROM members
LEFT JOIN associates ON ( associates.mid = members.id )
LEFT JOIN memberplot ON ( memberplot.id = associates.msid )
WHERE associates.msid ='".$member['mpid']."'" ;

$result_assoc = $connection->createCommand($sql_assoc)->queryAll();
//print_r($result_assoc);
if(count($result_assoc) >0)
{
	$hasassociate=0;
	foreach($result_assoc as $as){
		if($as["msid"]!= "") $hasassociate=1;
	}
	
	if($hasassociate==1)
	{
	?>
		 <div style="margin:150px 10 0 398px; position:absolute;"><u style="font-size:12px">Joint Ownership</u><br />
<?php
	}
	
	foreach($result_assoc as $as){
?>       
        <span style="font-size:12px"> &nbsp; <?php echo '* &nbsp;'. $as['name'];?> &nbsp; <?php echo $as['title'].'&nbsp;&nbsp;'	.$as['sodowo']; ?></span><br /><?php }}
		
	if($hasassociate==1)
	{
		echo "</div>";
	}
		?>		
        
       <div style=" margin:<?php echo 160;?>px 10 0 0px; position:absolute; width:60%;"><?php  echo $member['address']; 	 ?><br/>
	<?php  echo $member['phone']; 	 ?>
	<br/><br/>  Subject:&nbsp; <u><strong>Allotment of Plot – Royal Orchard Multan</strong><u>
     

</div>
        
       
       <p  style=" margin:<?php echo 265;?>px 10 0 0px; position:absolute;">Balloting of <strong>Royal Orchard Multan</strong> was held on 08th April, 2016.You will be glad to know that all the members, who applied for residential plots in this Housing Scheme have been accommodated and you have been allotted following Plot:-</p>
	<table  style="margin:<?php echo 325;?>px 10 0 20px; position:absolute;">
  <thead>
    <tr>
      <th></th>
      <th><u>Plot Address</u></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">b.</th>
      <td>Plot Size&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <strong><?php echo $member["size"].'&nbsp;&nbsp;('. $member['plot_size'].')'; 	 ?></strong></td>
       
    </tr>
    <tr>
      <th scope="row">a.</th>
      <td>MS No. &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <strong><?php echo $member['plotno']; 	 ?></strong></td>
     
      <td></td>
    </tr>
    <tr>
      <th scope="row">c.</th>
      <td>Plot No. &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp <strong><?php echo $member['plot_detail_address']; 	 ?></strong></td> 
      
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
	<table style="margin:<?php echo 325;?>px 10 0 280px;" >
  
   <?php 
$connection = Yii::app()->db;
$sql_payment  = "SELECT *
FROM cat_plot
LEFT JOIN categories ON ( cat_plot.cat_id = categories.id )
WHERE cat_plot.plot_id ='".$member['plot_id']."'" ;
$result_payments = $connection->createCommand($sql_payment)->queryAll();
if(count($result_payments) >0)
{
?>
<thead>
    <tr>
     
      <th><u>Prime Location Charges</u></th>
    </tr>
  </thead>
<?php
}
?>
  <tbody>
<?php
foreach($result_payments as $row){?>
	
	
<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['title']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php if($row["charges"]!= '') echo '('.$row['charges'].'% extra)';  ?></tr></td>
	
<?php 	}?>
  </tbody>
</table><br/><br/>
<div style="margin:100px 10 0 0px; position:absolute;" >
In future you will be recognized with the above mentioned Plot address and Membership number. Prime location charges (if any) will be paid along with last installment.<br>
<p>You are requested to note that due to continuous improvement in the town planning, few adjustments in certain cases have been made. Some differences in balloting results published on the web and above mentioned plot address is regretted. Previous allocations, checked/printed through web or any hard copy issued/marked may please be treated as cancelled.</p>
May Allah bless you to make you live comfortably and peacefully in this prestigious Housing Project “Ameen”. <br><br>Thanking you and assuring you our best services, we remain.<br><br>
With profound regards,<br><br><br><br><br><br>
 <strong>Secretary</strong><br>
 <strong>Royal Orchard</strong>
</div>

</body>

</html>

</textarea>

<div style="text-align: left; margin-top: 1em;">

  <button type="submit">Balloting Detail</button>

</div>

</form>
<?php }elseif($member['balloting_detail']==2){
	 echo'Aleady Rquested';}else{ echo'<a href="reprint_balloting_detail?plot_id='.$member['plot_id'].'">Request For Re-Print</a>';}?>
</td>
<td></td>
</tr><tr>
<td>Allotment Letter(Against Land)</td>
<td>
<?php if($member['allotment_letter_al']==0){?>
<form id="form" action="<?php echo Yii::app()->baseUrl; ?>/dompdf/www/pdfgenerator.php" method="post">
<input type="hidden" name="paper" value="a4">
<input type="hidden" name="orientation" value="portrait">
</select>
</p>
<textarea name="html1" style="display:none;" cols="60" rows="20">
<!doctype html>
<html>
<head>
<meta charset="UTF-8">

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
<?php $maroy=15;?>
<body style=" margin:80px 40px 0 80px;">
<div style=" margin:<?php echo $maroy+100;?>px 0 0 510px; position:absolute;">Dated:<?php echo  date('d M,Y'); 	 ?></div>
     
       	<div style=" margin:<?php echo $maroy+100;?>px 10 0 0px; position:absolute;">Ref: RDBL/<?php echo $member['plotno'].'/'.date('Y'); 	 ?></div>
        <div style=" margin:<?php echo $maroy+130;?>px 10 0 0px; position:absolute;"><strong><?php echo $member['name'];?> &nbsp; <?php echo $member['title'].'&nbsp;&nbsp;'	.$member['sodowo']; ?></strong></div>
        
           <?php 
$connection = Yii::app()->db;
$sql_assoc  = "SELECT *
FROM members
LEFT JOIN associates ON ( associates.mid = members.id )
LEFT JOIN memberplot ON ( memberplot.id = associates.msid )
WHERE associates.msid ='".$member['mpid']."'" ;

$result_assoc = $connection->createCommand($sql_assoc)->queryAll();
//print_r($result_assoc);
if(count($result_assoc) >0)
{
	$hasassociate=0;
	foreach($result_assoc as $as){
		if($as["msid"]!= "") $hasassociate=1;
	}
	
	if($hasassociate==1)
	{
	?>
		 <div style="margin:150px 10 0 398px; position:absolute;"><u style="font-size:12px">Joint Ownership</u><br />
<?php
	}
	
	foreach($result_assoc as $as){
?>       
        <span style="font-size:12px"> &nbsp; <?php echo '* &nbsp;'. $as['name'];?> &nbsp; <?php echo $as['title'].'&nbsp;&nbsp;'	.$as['sodowo']; ?></span><br /><?php }}
		
	if($hasassociate==1)
	{
		echo "</div>";
	}
		?>		
        
       <div style=" margin:<?php echo $maroy+150;?>px 10 0 0px; position:absolute; width:60%;"><?php  echo $member['address']; 	 ?></div>
        
       <div style=" margin:<?php echo $maroy+185;?>px 10 0 0px; position:absolute;"><?php  echo $member['phone']; 	 ?></div><br>      
        <p  style=" margin:<?php echo $maroy+195;?>px 10 0 0px; position:absolute;">Subject:&nbsp; <u><strong>Allocation of Plot – <?php echo $member['project_name'];?></strong><u></p>
     
       <p  style=" margin:<?php echo $maroy+230;?>px 10 0 0px; position:absolute;">Further to our membership letter on the subject refers.<br />
       <br />You have been allocated following plot (against land) in <?php echo $member['project_name'];?>.</p>
	<table  style="margin:<?php echo $maroy+300;?>px 10 0 20px; position:absolute;">
  <thead>
    <tr>
      <th></th>
      <th><u>Plot Address</u></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">a.</th>
      <td>Plot Size&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <strong><?php  echo $member['plot_size']; 	 ?></strong></td>
       
    </tr>
    <tr>
      <th scope="row">b.</th>
      <td>MS No. &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <strong><?php echo $member['plotno']; 	 ?></strong></td>
     
      <td></td>
    </tr>
    <tr>
      <th scope="row">c.</th>
      <td>Plot No. &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp <strong><?php echo $member['plot_detail_address']; 	 ?></strong></td> 
      
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
	<table style="margin:<?php echo $maroy+300;?>px 10 0 280px;" >
  
   <?php 
$connection = Yii::app()->db;
$sql_payment  = "SELECT *
FROM cat_plot
LEFT JOIN categories ON ( cat_plot.cat_id = categories.id )
WHERE cat_plot.plot_id ='".$member['plot_id']."'" ;
$result_payments = $connection->createCommand($sql_payment)->queryAll();
if(count($result_payments) >0)
{
?>
<thead>
    <tr>
     
      <th><u>Prime Location</u></th>
    </tr>
  </thead>
<?php
}
?>
  <tbody>
<?php
foreach($result_payments as $row){?>
	
	
<tr><td><?php echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'. $row['title']; ?></tr></td>
	
<?php 	}?>
  </tbody>
</table><br/><br/><br/>
<div style="margin:90px 10 0 0px; position:absolute;" >
In future you will be recognized with the above mentioned Plot address and Membership number.<br>
May Allah bless you to make you live comfortably and peacefully in this prestigious Housing Project “Ameen”. <br><br>Thanking you and assuring you our best services, we remain.<br><br>
With profound regards,<br><br><br><br><br><br>
 <strong>Secretary</strong><br>
 <strong>Royal Orchard</strong>
</div>

</body>

</html>

</textarea>
<div style="text-align: left; margin-top: 1em;">
  <button type="submit">Allotment Letter(A/L)</button>
</div>
</form>
<?php }elseif($member['allotment_letter_al']==2){
	 echo'Aleady Rquested';}else{ echo'<a href="reprint_allotment_letter_al?plot_id='.$member['plot_id'].'">Request For Re-Print</a>';}?>
</td>
<td></td>
</tr>

</tbody>

</table><?php } 	?>