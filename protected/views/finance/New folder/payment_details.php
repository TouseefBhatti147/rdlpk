<div class="shadow">

  <h3>Payment Details<div style="float:right;"><a href="Installment_lis"><h5>Installment Details</h5> </a></div>

</h3>

</div>



<hr noshade="noshade" class="hr-5">




<section class="reg-section margin-top-30" style="font-size:11px;">

<?php

;

// Check connection



$reciveable=0;

$paid=0;
$due=0;



?> <table class="table table-striped table-new table-bordered">

            	<thead style="background:#666; border-color:#ccc; color:#fff; ">

<tr>

        	<th><b>S# </b></th>

			<th><b>Account Head </b></th>

            <th><b>Due Amount</b></th>
			 <th><b>Paid Amount</b></th>
			<th><b>Due Date</b></th>

			<th><b>Payment Mode</b></th>

			<th><b>Document Voucher No</b></th>

			<th><b>Surcharge</b></th>

			<th><b>Others</b></th>

			<th><b>Remarks</b></th>
            <th><b>Paid Date</b></th>
            <th><b>Action</b></th>

	</tr>		

        </thead>

		<tbody>
 <?php $res=array();

    foreach($members as $mem){

	
	

	

	}?>
		<?php
        $i=0;
		$tlcost=0;
		$tpcost=0;
		$tsur=0;


		

	$res=array();

    foreach($payments as $row)
 
	{	

$old_date = $row['create_date'];            
$middle = strtotime($old_date);             
$new_date = date('d-m-Y', $middle);
		$i++;

		$due=$due+$row['amount'];
		$paid=$paid+$row['paidamount'];
  echo '<tr><td>' . $i . '</td>

 <td>' . $row['payment_type'] . '</td>

 <td>' . $row['amount'] . '</td>
 <td>' . $row['paidamount'] . '</td>

  <td>' . $row['duedate']. '</td>

  <td>' . $row['paidas'] . '</td>

  <td>' . $row['detail'] . '</td>

  <td>' . $row['surcharge'] . '</td>

  <td>' . $row['others'] . '</td>

  <td>' . $row['remarks'] . '</td>
   <td>' . $row['date'] . '</td>
 
  <td><a href="update_charges?duedate='.$row['duedate'].' && amount='.$row['amount'].'&& pid='.$_REQUEST['pid'].'&& id='.$row['id'].'&&mem_id='.$mem['member_id'].'">Edit</a></td>
  
</tr>  ';

  

  }
  $due=$due+$tlcost;
  $paid=$paid+$tpcost;
echo '<tr><td><b>Total:</b></td>
<td></td>
<td><b>'.$due.'</b></td>
<td><b>'.$paid.'</b></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td></tr>';
?></tbody></table></section>

 
  

<hr noshade="noshade" class="hr-5"><hr noshade="noshade" class="hr-5">

<hr noshade="noshade" class="hr-5"><hr noshade="noshade" class="hr-5">

<hr noshade="noshade" class="hr-5"><hr noshade="noshade" class="hr-5">

<hr noshade="noshade" class="hr-5"><hr noshade="noshade" class="hr-5">

<hr noshade="noshade" class="hr-5"><hr noshade="noshade" class="hr-5">