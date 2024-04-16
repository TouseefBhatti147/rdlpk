<div class="shadow">
  <h3>Payment History<div style="float:right;"><a href="installment_details?id=<?php echo $_REQUEST['id']?>"><h5>Installment Details</h5> </a></div>
</h3>
</div>

<hr noshade="noshade" class="hr-5">
<h3>Plot Details</h3>
<?php $res=array();
    foreach($info as $row){
	echo '<b>File Deatil Address:</b>' .$row['file_detail_address'].'</br>';
	echo '<b>Sector     :</b>' .$row['sector'].'</br>';
	echo '<b>File Size  :</b>' .$row['file_size'].'</br>';
	echo '<b>Land Cast  :</b>' .$row['create_date'].'</br>';
	
	}?>
    <hr noshade="noshade" class="hr-5">
<section class="reg-section margin-top-30" style="font-size:11px;">
<?php
;
// Check connection

$reciveable=0;
$paid=0;

?><h3>Payment Details</h3> <table class="table table-striped table-new table-bordered">
            	<thead style="background:#666; border-color:#ccc; color:#fff; ">
<tr>
        	<th><b>S# </b></th>
			<th><b>Account Head </b></th>
            <th><b>Received Amount</b></th>
			<th><b>Total Amount</b></th>
			<th><b>Received Date</b></th>
			<th><b>Payment Mode</b></th>
			<th><b>Document Voucher No</b></th>
			<th><b>Surcharge</b></th>
			<th><b>Others</b></th>
			<th><b>Remarks</b></th>
	</tr>		
        </thead>
		<tbody>
		<?php
		$i=0;
	$res=array();
    foreach($payments as $row)
	{	
		$i++;
		$paid=$paid+$row['amount'];
  echo '<tr><td>' . $i . '</td>
 <td>' . $row['payment_type'] . '</td>
  <td>' . $row['create_date'] . '</td>
  <td>' . $row['amount'] . '</td>
  <td>' . $row['create_date'] . '</td>
  <td>' . $row['paidas'] . '</td>
  <td>' . $row['detail'] . '</td>
  <td>' . $row['surcharge'] . '</td>
  <td>' . $row['others'] . '</td>
  <td>' . $row['remarks'] . '</td>';
  
  }
?></tbody></table></section>
  <h3>Summary</h3>
  <div class="span12">
  <div class="span4">
  
  <h5>Receivable</h5>
  	
	<?php 

	$res=array();
    foreach($receivable as $row){
	echo $row['name'].':'.$row['total'].'</br>';
	
	$reciveable=$reciveable+$row['total'];
	
	
	//$reciveable=$reciveable+$row['price'];
	}
	
	$res=array();
    foreach($info as $row){
	echo 'Land Cast:' .$row['price'].'</br>';
	
	$reciveable=$reciveable+$row['price'];
	}
	$res=array();
    
	
	 
echo 'Total:'.$reciveable.'</table>'; 

$remaining=$reciveable-$paid;?></div>
<div class="span4">
<h5>Paid</h5>
Total:<?php echo $paid;?>
</div>
<div class="span4"><h5>Rmaining</h5>
Total:<?php echo $remaining;?></div>


</div>
<hr noshade="noshade" class="hr-5"><hr noshade="noshade" class="hr-5">
<hr noshade="noshade" class="hr-5"><hr noshade="noshade" class="hr-5">
<hr noshade="noshade" class="hr-5"><hr noshade="noshade" class="hr-5">
<hr noshade="noshade" class="hr-5"><hr noshade="noshade" class="hr-5">
<hr noshade="noshade" class="hr-5"><hr noshade="noshade" class="hr-5">