<?php $create=0;?>
<div class="shadow">
   <h3>Property Installment Details</h3>
</div>
<style>td{border:1px solid #ddd !important;}</style>
<hr noshade="noshade" class="hr-5">
<div class="span12">
<div class="span3" style="float:left; padding-right:50px;">
<h4>Property Details</h4>
<?php $res=array();
    foreach($info as $row){
		$old_date = $row['create_date'];            
		$middle = strtotime($old_date);             
		$new_date = date('d-m-Y', $middle); 
	 echo '<b>Project     :</b>&nbsp;&nbsp;&nbsp;' .$row['project_name'].'</br>';
	 echo '<b>Property Size:</b>';
     echo '&nbsp;&nbsp;' .$row['size'].'&nbsp;('.$row['plot_size'].')'.'</br>';
     echo '<b>Building Name: &nbsp;&nbsp;&nbsp;&nbsp;</b>';
	 echo $row['buildname'].'</br>';
	 echo '<b>Floor: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>';
	 echo $row['fname'].'</br>';
	 echo '<b>Property No: &nbsp;&nbsp;&nbsp;&nbsp;</b>';			
	 echo $row['plot_detail_address'].'</br>';		
	 echo '<b>Property Type: &nbsp;&nbsp;&nbsp;&nbsp;</b>';
	echo $row['prop_type'].'</br>';		
	//echo '<b>Date  :</b>' .$new_date.'</br>';
	$price=$row['price'];} 
?>
</div>

<div class="span5">
<?php 
$connection = Yii::app()->db;
$msid=0;	
 foreach($members as $mem){             
  $msid=$mem['id'];	
}		
$discount  = "SELECT * FROM discnt where ms_id='".$msid."' ";
$discountr = $connection->createCommand($discount)->queryRow(); 
if($discountr['discount']==''){$discountr['discount']=0;}
?> 
 <table class="table" style="font-size:12px;">
 <th style="border-right:none;" width="35%"> Property Pricing</th>
 <th style="border-right:none;border-left:none;" width="15%"> </th>
 <th style="border-right:none;border-left:none;" width="50%"> </th>
 
 <tbody>
	 
<tr><td>Basic Property Value</td><td style="text-align:right" ><?php  echo floatval($price);?> </td><td rowspan="2"><?php echo $row['remarks'];?></td></tr>
<tr><td>Prime Location Charges</td><td style="text-align:right"><?php // echo number_format($row['PLcharges']);?></td> </tr>
<tr><td>Less Discount</td><td style="text-align:right"><?php echo number_format($discountr['discount']);?></td><td ><?php if(empty($discountr['details'])){echo '';}else {echo $discountr['details'];}?></td></tr>
<tr><td style=" font-weight:bold;">Net Receiveable</td><td style="text-align:right; font-weight:bold;"><?php // echo number_format(($price+$row['PLcharges'])-$discountr['discount'])?></td><td > </td></tr>

</tbody></table>
</div>
<div class="span3" style="float:right;">
	<h4>Member Details</h4>
<?php

 $res=array();

    foreach($members as $mem){             
	echo   '<b>Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b>' .$mem['name'].'</br>';
    echo   '<b>CNIC #&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b>' .$mem['cnic'].'</br>';
	  echo '<b>Membership #&nbsp;:</b>' .$mem['plotno'].'</br>';
	
	}
		?> 
	</div>
	<?php $numbers=0;
foreach($minfo as $row6){
	$numbers=$row6['noi'];
	$create=$row6['create_date'];
	$months=$row6['insplan'];
}
	$perins=0;
	if($numbers==0){$numbers=1;}
   $perins=$price/$numbers;
    ?>
<section class="reg-section margin-top-30" style="font-size:11px;">
  <?php

;

$reciveable=0;
$paid=0;
$due=0;
$duesurcharge=0;
$paidsurcharge=0;
?>
</div>
<?php 
$sql_memberas= "SELECT * FROM memberplot mp
	    where plot_id='".$_REQUEST['id']."'";
		$result_membersas = $connection->createCommand($sql_memberas)->queryRow();
if($result_membersas['status']=='Sales' ){?>
<a href="http://rdlpk.com/index.php/memberplot/installment_edit?id=<?php echo $_REQUEST['id']; ?>">Edit Installment Plan</a>

<?php }?>
 <div class="clearfix"></div>
  <table  class="table table-striped table-new table-bordered" style="font-size:11px;">
    <thead style="background:#666; border-color:#ccc; color:#fff; ">
      <tr>
        <th><b>Sr.# </b></th>
       <th style="width:65px;"><b>Due Date</b></th>
        <th style="width:65px;"><b>Paid Date</b></th>
        <th><b>Due Amount</b></th>
        <th><b>Paid Amount</b></th>
       <th><b>Payment Mode</b></th>
        <th><b>Ref No.</b></th>
        
        <th><b>Due Surcharge</b></th>
          <th><b>Paid Surcharge</b></th>
        <th style="width:120px;"><b>Remarks</b></th>
        <th style="width:140px;"><b>Status/Action</b></th>
      </tr>
    </thead>
    <tbody>
     <?php
	  $i=1;
	 $ins='';
	$res=array();
$gtotalsur=0;
	foreach($payments as $pay)
	{	
$i++;
  $due=$due+$pay['dueamount'];
  $paid=$paid+$pay['paidamount'];
   $duesurcharge=$duesurcharge+$pay['surcharge'];
    $paidsurcharge=$paidsurcharge+$pay['paidsurcharge'];
	$oins=$due-$paid;
 	$co1=1;
$totalduesur='';
	 foreach($payments as $pay2){if($pay2['ref']==$pay['id']){$co1++;}}
	 $lastdue=0;
	 $lastpaid=0;
	 $lastdued=0;
	if($pay['ref']==0){
		if($pay['paidamount']==''){$pay['paidamount']=0;}

if($pay['dueamount']==''){$pay['dueamount']=0;}
  echo '<tr>
  <td rowspan="'.$co1.'">'.$pay['lab']. '</td>
     <td rowspan="'.$co1.'">'.$pay['due_date'].'</td>
     <td>'.$pay['paid_date'].'</td>
     <td rowspan="'.$co1.'" style="text-align:right">'.number_format($pay['dueamount']).'</td>
     <td style="text-align:right">'.number_format($pay['paidamount']).'</td>
     <td>'.$pay['payment_type'].'</td>
     <td>';
	  if($pay['r_id']>0){
	  	$re1 = "SELECT * FROM rpt_print where rid='".$pay['r_id']."' and msid='".$pay['plot_id']."'";
		$rec1=$connection->createCommand($re1)->queryRow();	
		echo $rec1['slipno'].'/<b style="color:blue;">'.$rec1['r_no'];
		if($rec1['jvno'] > 0){echo 'JV-'.$rec1['jvno'];}
		echo '</b>';
		}elseif($pay['re_id'] > 0){ 
  		$re = "SELECT * FROM rpt_print where id='".$pay['re_id']."'";
		$rec=$connection->createCommand($re)->queryRow();
		echo $rec['slipno'].'/<b style="color:blue;">'.$rec['r_no'];
		if($rec['jvno'] > 1){echo 'JV-'.$rec['jvno'];}
		echo '</b>';
		}else{echo $pay['detail'];}
	echo ' </td>
	 <td align="right">'.$pay['surcharge'];?>
     <?php 
	 if($pay['dueamount'] > 1 and $pay['surcharge_re']==0){
	  if($pay['paid_date']!==''){$curdate=$pay['paid_date'];}else{$curdate=date('d-m-Y');} 
	// $curdate=date('Y-m-d');
     $surchargeratio=$pay['dueamount']/100*0.05;
	 $duedate=$pay['due_date'];
	 if($pay['paid_date']!==''){$paiddate=$pay['paid_date'];}else{$paiddate=date('d-m-Y');} 
	 $datetime1 = new DateTime($duedate);
	 $datetime2 = new DateTime($paiddate);
	 $interval = $datetime1->diff($datetime2); 
	 $surchargedur= $interval->format('%R%a ');
	 if($surchargedur>1){
	 $totalduesur=$surchargedur*$surchargeratio;}else{$totalduesur=0;}	
	echo '<b style="color:red;">'.number_format($totalduesur).'</b>';
	 }
$gtotalsur=$gtotalsur+$totalduesur;
	 echo '</td>
	 <td align="right">'.$pay['paidsurcharge'].'</td>
     <td>'.$pay['remarks'].'</td>
     <td>';if(!empty($pay['fstatus'])){if($pay['fstatus']=='approved'){ echo '<b style="color:Green;">Verified</b>';}else{ echo '<b style="color:red;">'.$pay['fstatus'].'</b>';}} else{}
if($result_membersas['status']=='Sales' ){echo '<a href="deleteins?did='.$pay['id'].'&id='.$pay['plot_id'].'">Delete</a>';}
	 $id='';
	$id=$pay['id'];
	$lastdue=$pay['dueamount'];
	$lastpaid=$pay['paidamount'];
	$lastdued=$pay['due_date'];
	 }?>
	<script>
    function deletethis(id,idd){
		var x = confirm("Are you sure you want to delete?");
 
if(x == true){
window.location="delete_ins?id=" + id + "&&did=" + idd + "";
}
if(x == false){return false;}
}
    
    </script>
	
	<?php
foreach($payments as $pay1){
	 if($pay1['ref']==$id){
	echo '<tr>';
if($pay1['paidamount']==''){$pay1['paidamount']=0;}     
echo '<td>'.$pay1['paid_date'].'</td>
     <td style="text-align:right">'.number_format($pay1['paidamount']).'</td>
     <td>'.$pay1['payment_type'].'</td>
     <td>';
	  if($pay1['r_id']>0){
	  	$re1 = "SELECT * FROM rpt_print where rid='".$pay1['r_id']."' and msid='".$pay1['plot_id']."'";
		$rec1=$connection->createCommand($re1)->queryRow();	
		echo $rec1['slipno'].'/<b style="color:blue;">'.$rec1['r_no'];
		if($rec1['jvno'] > 1 ){echo 'JV-'.$rec1['jvno'];}
		echo '</b>';
		}elseif($pay1['re_id'] > 0){ 
  		$re = "SELECT * FROM rpt_print where id='".$pay1['re_id']."'";
		$rec=$connection->createCommand($re)->queryRow();
		echo $rec['slipno'].'/<b style="color:blue;">'.$rec['r_no'];
		if($rec['jvno'] > 1){echo 'JV-'.$rec['jvno'];}
		echo '</b>';
		}else{echo $pay1['detail'];}
	 echo '</td>';
	 echo '<td align="right">'.$pay1['surcharge'];
	  
	  if(($lastdue-$lastpaid) > 1 and $pay1['surcharge_re']==0){
	  if($pay1['paid_date']!==''){$curdate=$pay1['paid_date'];}else{$curdate=date('d-m-Y');} 
	// $curdate=date('Y-m-d');
     
	 $surchargeratio=($lastdue-$lastpaid)/100*0.05;
	 $duedate=$lastdued;
	 if($pay1['paid_date']!==''){$paiddate=$pay1['paid_date'];}else{$paiddate=date('d-m-Y');} 
	 $datetime1 = new DateTime($duedate);
	 $datetime2 = new DateTime($paiddate);
	 $interval = $datetime1->diff($datetime2); 
	 $surchargedur= $interval->format('%R%a ');
	 if($surchargedur>1){
	 $totalduesur=$surchargedur*$surchargeratio;}else{$totalduesur=0;}	
	echo '<b style="color:red;">'.number_format($totalduesur).'</b>';
	 $lastpaid=$lastpaid+$pay1['paidamount'];
	 }
$gtotalsur=$gtotalsur+$totalduesur;
	 echo '</td>
     <td align="right">'.$pay1['paidsurcharge'].'</td>
     <td>'.$pay1['remarks'].'</td>
     <td>';if(!empty($pay1['fstatus'])){if($pay1['fstatus']=='approved'){ echo '<b style="color:Green;">Verified</b>';}else{ echo '<b style="color:red;">'.$pay1['fstatus'].'</b>';}} else{}	}}
 $id=''; }

 echo '<tr><td><b>Total:</b></td>
<td></td>
<td></td>
<td style="text-align:right"><b>'.number_format($due).'</b></td>
<td style="text-align:right"><b>'.number_format($paid).'</b></td>
<td align="right"></td>
<td></td>
<td align="right"><b>'.number_format($duesurcharge).' (<b style="color:red;">'.number_format($gtotalsur,'0').'</b>)</b></td>
<td align="right"><b>'.number_format($paidsurcharge).'</b></td>
<td></td>
<td></td>
</tr>';
/*echo '<tr><td><b>Discount:</b></td>
<td></td>
<td></td>
<td align="right"></td><td style="text-align:right"><b>'.$discountr['discount'].'</b></td>
<td></td>
<td align="right"></td>
<td></td><td align="right"></td><td style="text-align:right"><b>'.$discountr['details'].'</b></td>
<td></td><td></td>
</tr>


';*/
if($due==0){$due=1;}
echo '<tr><td><b>Outstanding Installment</b></td><td></td><td></td><td style="text-align:right;"><b>'.number_format($oins).'</b></td><td style="text-align:right;"><b>'.number_format(($oins)/$due*100).'%'.'</b></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>

';

	?>
    </tbody>
  </table>
</section>
</div>
<form id="form1" action="<?php echo Yii::app()->baseUrl; ?>/dompdf/www/pdfgenerator.php" target="_blank" method="post">

 <input type="hidden" name="paper" value="a4">
  <input type="hidden" name="orientation" value="portrait">
<textarea style="visibility:hidden;" name="html" id="html">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PDF Report</title>
<style>
td{ padding:0px;  border-top:1px solid #000; border-left:1px solid #000;}
.table-bordered{ border-right:1px solid #000; border-bottom:1px solid #000;}


</style>
</head>

<body>


<?php 
$connection = Yii::app()->db;
$msid=0;	
 foreach($members as $mem){             
  $msid=$mem['id'];	
}		
$discount  = "SELECT * FROM discnt where ms_id='".$msid."' ";
$discountr = $connection->createCommand($discount)->queryRow(); 
if($discountr['discount']==''){$discountr['discount']=0;}
?> 
 

<section class="reg-section " style="font-size:11px;">
 
 <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
   <td style="border-bottom:thin solid #000"><img src="<?php echo Yii::getPathOfAlias('webroot')."/images/royal_orchard.jpg";  ?>"  width="270px">
   </td>
   <td>
   <table class="table-bordered" style="font-size:10px; ">
 <tbody>
<tr><td>Basic Property Value</td>
<td style=" text-align:right" ><?php echo floatval($price);?> </td><td rowspan="2"><?php echo $row['remarks'];?></td></tr>
<tr>
<td>Prime Location Charges</td>
<td style=" text-align:right"><?php // echo number_format($row['PLcharges']);?></td> 
</tr><tr>
<td>Less Discount</td>
<td style="text-align:right"><?php echo number_format($discountr['discount']);?></td>
<td ><?php if(empty($discountr['details'])){echo '';}else {echo $discountr['details'];}?></td>
</tr><tr>
<td style="font-weight:bold;">Net Receiveable</td>
<td style="text-align:right; font-weight:bold;"><?php // echo number_format(($price+$row['PLcharges'])-$discountr['discount'])?></td><td > </td>
</tr>

</tbody></table>
   </td>
  </tr>
  <tr>
  
    <td width="60%"><h4>Property Details</h4>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
<?php $res=array();
    foreach($info as $row){
$old_date = $row['create_date'];            
$middle = strtotime($old_date);             
$new_date = date('d-m-Y', $middle); 
?>
 <tr>
    <td>Project     :&nbsp;</td>
    <td>
<?php
    echo $row['project_name'];
	//echo '<b>Date  :</b>' .$new_date.'</br>';
	?>
    &nbsp;</td>
  </tr>
<tr>
    <td><?php 
			echo 'Property Size:&nbsp;';?></td>
    <td>
<?php
    echo $row['size'].' ('.$row['plot_size'].')';
	//echo '<b>Date  :</b>' .$new_date.'</br>';
	?>
    &nbsp;</td>
  </tr>
  <tr><td><?php  echo '<b>Building Name:</b>';
	 
	?></td><td><?php echo $row['buildname'];?></td></tr>
     <tr><td><?php  echo '<b>Floor:</b>';
	 
	?></td><td><?php echo $row['fname'];?></td></tr>
  <tr>
    <td style="width:85px"><?php 
			echo 'Property No:&nbsp;';?></td>
    <td>
<?php
	echo $row['plot_detail_address'];
	//echo '<b>Date  :</b>' .$new_date.'</br>';
	?>
    &nbsp;</td>
  </tr>
   <tr>
    <td style="width:85px"><?php 
			echo 'Property Type:&nbsp;';?></td>
    <td>
<?php
	echo $row['prop_type'];
	//echo '<b>Date  :</b>' .$new_date.'</br>';
	?>
    &nbsp;</td>
  </tr>
 
  
  <?php
	 
	$price=$row['price'];
	}  ?><?php $numbers=0;?>
</table>
	</td>
    <td><h4>Member Details</h4>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
	<?php $res=array();
    foreach($members as $mem){             
?>  <tr>
    <td style="width:90px">Name:&nbsp;</td>
    <td>
<?php
	echo $mem['name'];
	//echo '<b>Date  :</b>' .$new_date.'</br>';
	?>
    &nbsp;</td>
  </tr>
  <tr>
    <td>CNIC # :&nbsp;</td>
    <td>
<?php
    echo $mem['cnic'];
	//echo '<b>Date  :</b>' .$new_date.'</br>';
	?>
    &nbsp;</td>
  </tr>
  <tr>
    <td>Membership # :&nbsp;</td>
    <td>
<?php
	echo $mem['plotno'];
	//echo '<b>Date  :</b>' .$new_date.'</br>';
	?>
    &nbsp;</td>
  </tr>
  <?php
	}  ?>
</table>
    </td>
  </tr>
</table>

 <span style="float:right;">
	

	</span>
    
  <?php



// Check connection



$reciveable=0;

$paid=0;
$due=0;
$duesurcharge=0;
$paidsurcharge=0;



?>

  <table class="table table-striped table-new table-bordered">
    <thead style="background:#666; border-color:#ccc; color:#fff; ">
      <tr>
        <th style="width:125px"><b>Installment </b></th>
       <th style="width:65px"><b>Due Date</b></th>
        <th style="width:65px"><b>Paid Date</b></th>
        <th><b>Due Amount</b></th>
        <th><b>Paid Amount</b></th>
       <th><b>Payment Mode</b></th>
        <th><b>Ref No.</b></th>
                 <th><b>Paid Surcharge</b></th>
        <th><b>Remarks</b></th>
        <th><b>Status</b></th>
      </tr>
    </thead>
    <tbody>
     <?php
	    $i=1;
	 $ins='';
	$res=array();
	foreach($payments as $pay)
	{	
$i++;
  $due=$due+$pay['dueamount'];
  $paid=$paid+$pay['paidamount'];
   $duesurcharge=$duesurcharge+$pay['surcharge'];
    $paidsurcharge=$paidsurcharge+$pay['paidsurcharge'];
	$oins=$due-$paid;
 	$co1=1;
	 foreach($payments as $pay2){if($pay2['ref']==$pay['id']){$co1++;}}
	if($pay['ref']==0){

		if($pay['paidamount']==''){$pay['paidamount']=0;}
if($pay['dueamount']==''){$pay['dueamount']=0;}
  echo '<tr><td rowspan="'.$co1.'">'.$pay['lab']. '</td>

     <td rowspan="'.$co1.'">'.$pay['due_date'].'</td>
     <td>'.$pay['paid_date'].'</td>
     <td rowspan="'.$co1.'" style="text-align:right">'.number_format($pay['dueamount']).'</td>
     <td style="text-align:right">'.number_format($pay['paidamount']).'</td>
     <td>'.$pay['payment_type'].'</td>
     <td>';
	  if($pay['r_id']>0){
	  	$re1 = "SELECT * FROM rpt_print where rid='".$pay['r_id']."' and msid='".$pay['plot_id']."'";
		$rec1=$connection->createCommand($re1)->queryRow();	
		echo $rec1['slipno'].'/<b style="color:blue;">'.$rec1['r_no'].'</b>';
		}elseif($pay['re_id'] > 0){ 
  		$re = "SELECT * FROM rpt_print where id='".$pay['re_id']."'";
		$rec=$connection->createCommand($re)->queryRow();
		echo $rec['slipno'].'/<b style="color:blue;">'.$rec['r_no'].'</b>';
		}else{echo $pay['detail'];}
	echo ' </td>
	 <td align="right">'.$pay['paidsurcharge'].'</td>
     <td>'.$pay['remarks'].'</td>
     <td>';if(!empty($pay['fstatus'])){if($pay['fstatus']=='approved'){ echo '<b style="color:Green;">Verified</b>';}else{echo '<b style="color:red;">'.$pay['fstatus'].'</b>';} }
	 $id='';
	$id=$pay['id'];
	 }
	 foreach($payments as $pay1){
	 if($pay1['ref']==$id){
	echo '<tr>

    
     <td>'.$pay1['paid_date'].'</td>
     <td style="text-align:right">'.$pay1['paidamount'].'</td>
     <td>'.$pay1['payment_type'].'</td>
     <td>';
	  if($pay1['r_id']>0){
	  	$re1 = "SELECT * FROM rpt_print where rid='".$pay1['r_id']."' and msid='".$pay['plot_id']."'";
		$rec1=$connection->createCommand($re1)->queryRow();	
		echo $rec1['slipno'].'/<b style="color:blue;">'.$rec1['r_no'].'</b>';
		}elseif($pay1['re_id'] > 0){ 
  		$re = "SELECT * FROM rpt_print where id='".$pay1['re_id']."'";
		$rec=$connection->createCommand($re)->queryRow();
		echo $rec['slipno'].'/<b style="color:blue;">'.$rec['r_no'].'</b>';
		}else{echo $pay1['detail'];}
	echo ' </td>
	 <td align="right">'.$pay1['paidsurcharge'].'</td>
     <td>'.$pay1['remarks'].'</td>
     <td>';if(!empty($pay1['fstatus'])){if($pay1['fstatus']=='approved'){ echo '<b style="color:Green;">Verified</b>';}else{echo '<b style="color:red;">'.$pay1['fstatus'].'</b>';} }
	
	}
	
	 }$id='';
 
}	
	echo '<tr><td><b>Total:</b></td>
<td></td>
<td></td>
<td align="right"><b>'.number_format($due).'</b></td>
<td align="right"><b>'.number_format($paid).'</b></td>
<td></td>
<td></td>
<td align="right"><b></b></td>
<td align="right"><b>'.number_format($paidsurcharge).'</b></td>
<td></td>
</tr>';
/*echo '</tr>
<tr><td><b>Discount:</b></td>
<td></td>
<td></td>
<td align="right"></td><td style="text-align:right"><b>'.$discountr['discount'].'</b></td>
<td></td>
<td align="right"></td>
<td></td><td align="right"></td><td style="text-align:right"><b>'.$discountr['details'].'</b></td>
<td></td>
</tr>';
*/
if($due==0){$due=1;}
echo '<tr><td><b>Outstanding Installment</b></td><td></td><td></td><td style="text-align:right"><b>'.number_format($oins).'</b></td><td><b>'.number_format(($oins)/$due*100).'%'.'</b></td>
<td></td><td></td><td></td><td></td><td></td>
</tr>

';

	?>
    </tbody>
  </table>
</section>
             
</body>
</html>
</textarea>
<input style="float:left;" type="submit" name="submit" value="Print Report" /></form>
<hr noshade="noshade" class="hr-5">
<hr noshade="noshade" class="hr-5">
<hr noshade="noshade" class="hr-5">
<hr noshade="noshade" class="hr-5">
<hr noshade="noshade" class="hr-5">
<hr noshade="noshade" class="hr-5">
<hr noshade="noshade" class="hr-5">
<hr noshade="noshade" class="hr-5">
<hr noshade="noshade" class="hr-5">
<hr noshade="noshade" class="hr-5">