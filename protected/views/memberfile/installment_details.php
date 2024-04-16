<div class="shadow">
  <h3>Installment History</h3>
</div>
<?php $numbers=0;?>
<hr noshade="noshade" class="hr-5">
<h3>Plot Details</h3>
<?php $res=array();
    foreach($info as $row){
	echo '<b>Plot Deatil Address:</b>' .$row['file_detail_address'].'</br>';
	echo '<b>Sector     :</b>' .$row['sector'].$row['size2'].'</br>';
	echo '<b>Plot Size  :</b>' .$row['file_size'].'</br>';
	echo '<b>Land Cast  :</b>' .$row['create_date'].'</br>';
	$numbers=$row['noi'];
	}?>
    <hr noshade="noshade" class="hr-5">
<section class="reg-section margin-top-30" style="font-size:11px;">
<?php
;
// Check connection

$reciveable=0;
$paid=0;

?><h3>Installment Details</h3> <table class="table table-striped table-new table-bordered">
            	<thead style="background:#666; border-color:#ccc; color:#fff; ">
<tr>
        	<th><b>S# </b></th>
			<th><b>Account Head </b></th>
            
            <th><b>Received Amount</b></th>
			
			<th><b>Received Date</b></th>
			<th><b>Payment Mode</b></th>
			<th><b>Voucher No</b></th>
			<th><b>Surcharge</b></th>
			
			<th><b>Remarks</b></th>
            <th><b>Status</b></th>
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
  <td>' .  $row['amount'] . '</td>
 
  <td>' . $row['create_date'] . '</td>
  <td>' . $row['paidas'] . '</td>
  <td>' . $row['detail'] . '</td>
  <td>' . $row['surcharge'] . '</td>
  
  <td>' . $row['remarks'] . '</td>
  <td>Paid</td>';
  
  }
  $row_diff=$numbers-$i;
	do{
		echo '<tr><td></td>
 <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td height="10px;"><a href="payment?id='.$_REQUEST['id'].'" class="btn btn-success">Pay Now</a></td>';
  $row_diff--;
		}while($row_diff>0);
  
?></tbody></table></section>



</div>
<hr noshade="noshade" class="hr-5"><hr noshade="noshade" class="hr-5">
<hr noshade="noshade" class="hr-5"><hr noshade="noshade" class="hr-5">
<hr noshade="noshade" class="hr-5"><hr noshade="noshade" class="hr-5">
<hr noshade="noshade" class="hr-5"><hr noshade="noshade" class="hr-5">
<hr noshade="noshade" class="hr-5"><hr noshade="noshade" class="hr-5">