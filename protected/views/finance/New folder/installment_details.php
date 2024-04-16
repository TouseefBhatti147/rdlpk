<?php $create=0;?>
<div class="shadow">
   <h3>Installment Details</h3>
</div>
<?php $numbers=0;?>
<hr noshade="noshade" class="hr-5">
<h4>Plot Details</h4>
<?php $res=array();

    foreach($info as $row){
$old_date = $row['create_date'];            
$middle = strtotime($old_date);             
$new_date = date('d-m-Y', $middle); 
	echo '<b>Plot Deatil Address:</b>' .$row['plot_detail_address'].'</br>';

	echo '<b>Sector     :</b>' .$row['sector'].'</br>';

	echo '<b>Plot Size  :</b>' .$row['plot_size'].$row['size2'].'</br>';

	echo '<b>Date  :</b>' .$new_date.'</br>';
	$price=$row['price'];
	
	}
foreach($minfo as $row6){
	$numbers=$row6['noi'];
	$create=$row6['create_date'];
	$months=$row6['insplan'];
}
	$perins=0;
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
        <th><b>Surcharge</b></th>
        <th><b>Remarks</b></th>
        <th><b>Status</b></th>
      </tr>
    </thead>
    <tbody>
     <?php $i=0;
	$res=array();
	foreach($payments as $pay)
	{	
$i++;
  $due=$due+$pay['dueamount'];
  $paid=$paid+$pay['paidamount'];
  echo '<tr><td>' . $i . '</td>

     <td>'.$pay['due_date'].'</td>
     <td>'.$pay['paid_date'].'</td>
     <td>'.$pay['dueamount'].'</td>
     <td>'.$pay['paidamount'].'</td>
     <td>'.$pay['payment_type'].'</td>
     <td>'.$pay['detail'].'</td>
     <td>'.$pay['surcharge'].'</td>
     <td>'.$pay['remarks'].'</td>
     <td><a href="update?due_date='.$pay['due_date'].' && dueamount='.$pay['dueamount'].' && plot_id='.$row['id'].'&& id='.$pay['id'].'">Edit</a>
	 /<a href="delete_ins?id='.$_GET['id'].'&&pid='.$_GET['pid'].'&&did='.$pay['id'].'">Delete</a></td>
    ';
	}
	echo '<tr><td><b>Total:</b></td>
<td></td>
<td></td>
<td><b>'.$due.'</b></td>
<td><b>'.$paid.'</b></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>';
	
	?>
    </tbody>
  </table>
</section>
</div>
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
