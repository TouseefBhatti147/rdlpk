<script src="//code.jquery.com/jquery-1.10.2.js"></script>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.js"></script>



<script>

$(function() {

$( "#fromdatepicker" ).datepicker({ dateFormat: 'dd-mm-yy' });

});

$(function() {

$( "#todatepicker" ).datepicker({ dateFormat: 'dd-mm-yy' });

});

</script>
<?php $create=0;?>
<div class="shadow">
   <h3>Installment Details</h3>
</div>
<style>input{ width:100px;}</style>
<hr noshade="noshade" class="hr-5">
<span style="float:right;">
	<h4>Member Details</h4>
<?php $res=array();
$mid='';
    foreach($members as $mem){             
	$mid=$mem['member_id'];
	echo   '<b>Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b>' .$mem['name'].'</br>';
    echo   '<b>CNIC #&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b>' .$mem['cnic'].'</br>';
	  echo '<b>Membership #&nbsp;:</b>' .$mem['plotno'].'</br>';
	} ?> 
	</span><?php $numbers=0;?>
<h4>Plot Details</h4>
<?php $res=array();
    foreach($info as $row){
		
$old_date = $row['create_date'];            
$middle = strtotime($old_date);             
$new_date = date('d-m-Y', $middle); 
	echo '<b>Plot No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b>' .$row['plot_detail_address'].'</br>';
    echo '<b>Plot Size&nbsp;&nbsp;:</b>' .$row['size'].' ('.$row['plot_size'].')'.'</br>';
	echo '<b>Address&nbsp;&nbsp;&nbsp;:</b>' .$row['sector_name'].'/'.$row['street'].'</br>';
    echo '<b>Project&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b>' .$row['project_name'].'</br>';
	//echo '<b>Date  :</b>' .$new_date.'</br>';
	$price=$row['price'];
	}  ?>
    
    <?php
foreach($minfo as $row6){
	$numbers=$row6['noi'];
	$create=$row6['create_date'];
	$months=$row6['insplan'];
}
	$perins=0;
	if($numbers==0){$numbers=1;}
   $perins=$price/$numbers;
   
    ?>
<hr noshade="noshade" class="hr-5">
<section class="reg-section margin-top-30" style="font-size:11px;">
  <?php

;

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
        <th><b>S# </b></th>
       <th><b>Due Date</b></th>
        <th><b>Paid Date</b></th>
        <th><b>Due Amount</b></th>
        <th><b>Paid Amount</b></th>
       <th><b>Payment Mode</b></th>
        <th><b>Voucher No</b></th>
        <th><b>Due Surcharge</b></th>
          <th><b>Paid Surcharge</b></th>
        <th><b>Remarks</b></th>
       
      
      </tr>
    </thead>
   <form action="po" method="post" id="1">
    <tbody>
     <?php
	  $i=0;
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
	
  echo '<tr><td><input value="'.$pay['lab']. '" name="lab[]" /></td>
	<input type="hidden" value="'.$pay['id']. '" name="ppid[]" />
	<input type="hidden" value="'.$_REQUEST['id']. '" name="ploid" />
     <td><input value="'.$pay['due_date'].'" name="due_date[]"  id="todatepicker"/></td>
     <td><input value="'.$pay['paid_date'].'" name="paid_date[]"  id="fromdatepicker" /></td>
     <td style="text-align:right"><input value="'.$pay['dueamount'].'" name="dueamount[]" /></td>
     <td style="text-align:right"><input value="'.$pay['paidamount'].'" name="paidamount[]"  /></td>
     <td><input value="'.$pay['payment_type'].'" name="payment_type[]"  /></td>
     <td><input value="'.$pay['detail'].'" name="detail[]"  /></td>
     <td align="right"><input value="'.$pay['surcharge'].'" name="surcharge[]"  /></td>
	 <td align="right"><input value="'.$pay['paidsurcharge'].'" name="paidsurcharge[]"/></td>
     <td><input value="'.$pay['remarks'].'" name="remarks[]"  /></td>
    </tr>
	
	 ';
	}
	if($due==0){$due=1;}
	echo '<tr><td><b>Total:</b></td>
<td></td>
<td></td>
<td style="text-align:right"><b>'.number_format($due).'</b></td>
<td style="text-align:right"><b>'.number_format($paid).'</b></td>
<td align="right"></td>
<td></td>
<td align="right"><b>'.number_format($duesurcharge).'</b></td>
<td align="right"><b>'.number_format($paidsurcharge).'</b></td>
<td></td>
</tr>
<tr><td><b>Outstanding Installment</b></td><td><b>'.number_format($oins).'</b></td><td><b>'.number_format($oins/$due*100).'%'.'</b></td></tr>

';

	?>
    </tbody>
   
  </table>
   <input type="submit" name="Update plan" value="Update plan" class="btn" />
    </form>
  <a class="btn" href="addins?id=<?php echo $_GET['id']; ?>&&mid=<?php echo $mid; ?>">Add New installment</a>

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


<section class="reg-section " style="font-size:11px;">
 <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
   <td colspan="2" style="border-bottom:thin solid #000"><img  src="<?php echo Yii::getPathOfAlias('webroot')."/images/royal_orchard.jpg";  ?>" height="92px">
   </td>
  </tr>
  <tr>
    <td width="60%"><h4>Plot Details</h4>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
<?php $res=array();
    foreach($info as $row){
$old_date = $row['create_date'];            
$middle = strtotime($old_date);             
$new_date = date('d-m-Y', $middle); 
?>
  <tr>
    <td style="width:85px">Plot No:&nbsp;</td>
    <td>
<?php
	echo $row['plot_detail_address'];
	//echo '<b>Date  :</b>' .$new_date.'</br>';
	?>
    &nbsp;</td>
  </tr>
  <tr>
    <td>Plot Size  :&nbsp;</td>
    <td>
<?php
    echo $row['size'].' ('.$row['plot_size'].')';
	//echo '<b>Date  :</b>' .$new_date.'</br>';
	?>
    &nbsp;</td>
  </tr>
  <tr>
    <td>Address     :&nbsp;</td>
    <td>
<?php
	echo $row['sector_name'].'/'.$row['street'];
	//echo '<b>Date  :</b>' .$new_date.'</br>';
	?>
    &nbsp;</td>
  </tr>
  <tr>
    <td>Project     :&nbsp;</td>
    <td>
<?php
    echo $row['project_name'];
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
        <th><b>Voucher No</b></th>
        <th><b>Due Surcharge</b></th>
          <th><b>Paid Surcharge</b></th>
        <th><b>Remarks</b></th>
        <th><b>Status</b></th>
      </tr>
    </thead>
    <tbody>
     <?php
	  $i=0;
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
  echo '<tr><td>'.$pay['lab']. '</td>

     <td>'.$pay['due_date'].'</td>
     <td>'.$pay['paid_date'].'</td>
     <td align="right">'.$pay['dueamount'].'</td>
     <td align="right">'.$pay['paidamount'].'</td>
     <td>'.$pay['payment_type'].'</td>
     <td>'.$pay['detail'].'</td>
     <td align="right">'.$pay['surcharge'].'</td>
	 <td align="right">'.$pay['paidsurcharge'].'</td>
     <td>'.$pay['remarks'].'</td>
     <td>';if(!empty($pay['fstatus'])){ echo'<b style="color:Green;">Verified</b>';}  echo'</td>';}
	if($due==0){$due=1;}
	echo '<tr><td><b>Total:</b></td>
<td></td>
<td></td>
<td align="right"><b>'.number_format($due).'</b></td>
<td align="right"><b>'.number_format($paid).'</b></td>
<td></td>
<td></td>
<td align="right"><b>'.number_format($duesurcharge).'</b></td>
<td align="right"><b>'.number_format($paidsurcharge).'</b></td>
<td></td>
<td></td>
</tr>
<tr><td colspan="3"><b>Outstanding Installment</b></td><td align="right"><b>'.number_format($oins).'</b></td><td align="right"><b>'.number_format($oins/$due*100).'%'.'</b></td><td colspan="6"></td></tr>

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
