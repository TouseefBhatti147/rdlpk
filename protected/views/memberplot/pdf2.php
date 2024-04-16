<div>

<h3>Download Documents</h3>

<p>Download all required Documents in PDF Format :</p></div>



<!-- <h3 align="center">Please Wait While System is Generating PDF..</h3> -->
<?php 
	$connection = Yii::app()->db;  
		$sql_member1  = "SELECT * from memberplot
left join member_plot on memberplot.id=member_plot.ms_id
		 where memberplot.id IN(2091,2092,2097,2098,2099,2100,2101,2102,2103,2104,2105,2106,2108,2109,2110,2111,2112,2113,2114,2115,2116,2117,2118,2119,2120,2121,2122,2123,2124,2125,2126,2127,2128,2129,2130,2131,2132,2133,2134,2135,2136,2137,2138,2139,2140,2141,2142,2143,2144,2145)";
		$member_result1 = $connection->createCommand($sql_member1)->queryAll();
$co=0;
$co1=0;
$co2=0;
$co3=0;
$co=count($member_result1)+130;
echo count($member_result1);
	foreach($member_result1 as $ro){

       if($co1==50){ $co1=0;$co2=$co2+1;}$co1++;}	
	$lim=0;
	do {$co2=$co2-1;
	$connection = Yii::app()->db;  
	$sql_member  = "SELECT
    members.id
	,memberplot.plotno
	, members.name
	,members.title
    , members.sodowo
    , members.cnic
    , members.address
    , members.dob
    , members.email
    , members.phone
    , members.image
    , members.nomineename
	,members.city_id
	,plots.street_id
	,plots.type
	,plots.plot_size
	,plots.com_res
	,plots.sector
	,plots.size2
	,size_cat.size
	,plots.plot_detail_address
	,memberplot.create_date
	,streets.street
	,sectors.sector_name
        ,plots.id as plot_id
	FROM
    memberplot
    LEFT JOIN members 
        ON (memberplot.member_id = members.id ) 
		left join plots on memberplot.plot_id=plots.id
		left join sectors on plots.sector=sectors.id
		left join size_cat on plots.size2=size_cat.id
		left join streets on plots.street_id=streets.id
        left join member_plot on memberplot.id=member_plot.ms_id
		 where memberplot.id IN(2091,2092,2097,2098,2099,2100,2101,2102,2103,2104,2105,2106,2108,2109,2110,2111,2112,2113,2114,2115,2116,2117,2118,2119,2120,2121,2122,2123,2124,2125,2126,2127,2128,2129,2130,2131,2132,2133,2134,2135,2136,2137,2138,2139,2140,2141,2142,2143,2144,2145) Limit $lim , 150";
		$member_result = $connection->createCommand($sql_member)->queryAll();

?>

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


	}

</style>

</head>

<body  style=" margin:80px 40px 0 80px;">
<?php
$i=0;
	$res=array();
	$ifmar=0;
	$c=-1;
    foreach($member_result as $member){
		$c++;
//$mAR='margin:180px';

//if($ifmar>0){$mAR='margin:380px';;}
if($c>0)
{
	?>
    <table width="100%" style="margin-top:<?php echo $maroy+90;?>px;">
    <tr>
    <td width="70%">
Ref: RDBL/<?php echo $member['plotno'].'/'.date('Y'); 	 ?>
    </td>
    <td  align="right">
Dated:<?php  echo date('d M,Y'); 	 ?>
    </td>
    </tr>
    <tr>
    <td colspan="2">
        <div style=" margin:5px 10 0 0px;"><strong><?php echo $member['name'];?> &nbsp; <?php echo $member['title'].'&nbsp;&nbsp;'	.$member['sodowo']; ?></strong></div>	
        <div style=" margin:5px 10 0 0px;  width:60%;"><?php  echo $member['address']; 	 ?></div>      
       <div style=""><?php  echo $member['phone']; 	 ?></div><br />      
    </td>
    </tr>
    <tr>
    <td colspan="2">
        <p  style=" margin:5px 10 0 0px;">Subject:&nbsp; <u><strong>Allotment Of Plot – Royal Orchard Multan</strong><u></p>
    </td>
    </tr>
    
    <tr>
    <td colspan="2">
               <p  style=" margin:10px 10 0 0px;">Balloting of <strong>Royal Orchard Multan</strong> was held on 08th April, 2016.You will be glad to know that all the members, who applied for residential plots in this Housing Scheme have been accommodated and you have been allotted following Plot:-</p>
    </td>
    </tr>
    <tr>
    <td colspan="2">
 	
    </td>
    </tr>
    <tr>
    <td colspan="2">
    <table width="100%">
    <tr>
    <td width="60%" valign="top">
	<table>
  <thead>
    <tr>
      <th></th>
      <th><u>Plot Address</u></th>
    </tr>
  </thead>
 
  <tbody>
    <tr>
      <th scope="row">a.</th>
      <td>Plot Size &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <strong><?php echo $member['size']; 	 ?></strong></td>
      <td></td>
    </tr>
    <tr>
      <th scope="row">b.</th>
      <td>MS No. &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <strong><?php echo $member['plotno']; 	 ?></strong></td>
      
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
    </td>
    <td valign="top">
<table width="100%">
  <thead>
    <tr>
      <th style="text-align:left;"><u>Prime Location Charges</u></th>
    </tr>
  </thead>
 
  <tbody>
   <?php 
$connection = Yii::app()->db;
$sql_payment  = "SELECT *
FROM cat_plot
LEFT JOIN categories ON ( cat_plot.cat_id = categories.id )
WHERE cat_plot.plot_id ='".$member['plot_id']."'";
$result_payments = $connection->createCommand($sql_payment)->queryAll();
foreach($result_payments as $row){?>
   
    <tr><td>
    <?php  echo $row['title'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.'('.$row['charges'].'% extra'.')'; ?></td>
      
     
    </tr><?php }?>
  </tbody>
</table>
    </td>
    </tr>
    </table>
    </td>
    </tr>
    <tr>
    <td colspan="2">

<div style="margin:5px 10 0 0px;" >
In future you will be recognized with the above mentioned Plot address and Membership number. Prime location charges (if any) will be paid along with last installment.<br>
<p>You are requested to note that due to continuous improvement in the town planning, few adjustments in certain cases have been made. Some differences in balloting results published on the web and above mentioned plot address is regretted. Previous allocations, checked/printed through web or any hard copy issued/marked may please be treated as cancelled.</p>
May Allah bless you to make you live comfortably and peacefully in this prestigious Housing Project “Ameen”. <br><br>
Thanking you and assuring you our best services, we remain.<br><br>
With profound regards,<br><br><br><br><br><br>
 <strong>Secretary</strong><br>
 <strong>Royal Orchard</strong>
</div>
    </td>
    </tr>
    </table>
    <?php
}
else
{
	$maroy=15;
	?>
<div style=" margin:<?php echo $maroy+90;?>px 0 0 520px; position:absolute;">Dated:<?php  echo date('d M,Y'); 	 ?></div>
<div style=" margin:<?php echo $maroy+90;?>px 10 0 0px; position:absolute;">Ref: RDBL/<?php echo $member['plotno'].'/'.date('Y'); 	 ?></div>
        <div style=" margin:130px 10 0 0px; position:absolute;"><strong><?php echo $member['name'];?> &nbsp; <?php echo $member['title'].'&nbsp;&nbsp;'	.$member['sodowo']; ?></strong></div>
 
       <div style=" margin:150px 10 0 0px; position:absolute; width:60%;"><?php  echo $member['address']; 	 ?><br /><?php  echo $member['phone']; 	 ?><br /><br />
        Subject:&nbsp; <u><strong>Allotment of Plot – Royal Orchard Multan</strong><u></div><br> 
        
      
               <p  style=" margin:220px 10 0 0px; position:absolute;">Balloting of <strong>Royal Orchard Multan</strong> was held on 08th April, 2016.You will be glad to know that all the members, who applied for residential plots in this Housing Scheme have been accommodated and you have been allotted following Plot :-</p>
 	 
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
      <td>Plot Size&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <strong><?php echo $member['size']; 	 ?></strong></td>
      <td></td>
    </tr>
    <tr>
      <th scope="row">b.</th>
      <td>MS No. &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <strong><?php echo $member['plotno']; 	 ?></strong></td>
      
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
   <?php 
$connection = Yii::app()->db;
$sql_payment  = "SELECT *
FROM cat_plot
LEFT JOIN categories ON ( cat_plot.cat_id = categories.id )
WHERE cat_plot.plot_id ='".$member['plot_id']."'";
$result_payments = $connection->createCommand($sql_payment)->queryAll();
?>
<table style="margin:315px 0 0 300px;" >
  <thead>
    <tr>
     
      <th><u>Prime Location Charges </u></th>
    </tr>
  </thead>
  <tbody>
<?php
foreach($result_payments as $rowpayments){?>
	
	<?php echo '<tr><td>'.$rowpayments['title'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.'('.$rowpayments['charges'].'% extra'.')</tr></td>';?>
	
<?php 	}?>
  </tbody>
</table>
<br/><br/>
<div style="margin:80px 10 0 0px; position:absolute;" >
In future you will be recognized with the above mentioned Plot address and Membership number. Prime location charges (if any) will be paid along with last installment.<br>
<p>You are requested to note that due to continuous improvement in the town planning, few adjustments in certain cases have been made. Some differences in balloting results published on the web and above mentioned plot address is regretted. Previous allocations, checked/printed through web or any hard copy issued/marked may please be treated as cancelled.</p>
May Allah bless you to make you live comfortably and peacefully in this prestigious Housing Project “Ameen”. <br> <br>
Thanking you and assuring you our best services, we remain.<br><br>
With profound regards,<br><br><br><br><br><br>
 <strong>Secretary</strong><br>
 <strong>Royal Orchard</strong>
</div>
    <?php
}

?>
<div style="page-break-before: always;"></div>
<?php } 	?>

</body>

</html>



</textarea>

<div style="text-align: left; margin-top: 1em;">

  <button type="submit">Plot Details (From <?php echo $lim; echo ' To '; echo $lim+50; ?>)</button>

</div>

</form></td>

	
<?php 
$lim=$lim+50;
	}while ($co2 > 2);
	?>
