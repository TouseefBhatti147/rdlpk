<style>



.table th, .table td { text-align:center;}



</style>

<div class="">


<section class="reg-section margin-top-30" style="font-size=16px;">
 <div> 
  <?php	
//echo 123;exit;
            $res=array();

            foreach($plotdetails as $key){

$connection = Yii::app()->db;

$sql_details3  = "SELECT * FROM memberplot where plot_id=".$key['plot_id']."";
$result_details3 = $connection->createCommand($sql_details3)->queryRow();
$fstatus=$key['fstatus'];
//	$comment=$key['comment'];
$sql_details1  = "SELECT * FROM members where id=".$key['transferfrom_id']."";
$result_details1 = $connection->createCommand($sql_details1)->queryRow();
$imges=Yii::app()->baseUrl.'/upload_pic/'.$result_details1['image'];?>

<hr />
<div>
<div class="span8" style="float:left">
		<table class="table" style="border:1 px solid; font-size:12px;">
        <th bgcolor="#D3D3D3" colspan="3">
  <h5 style="text-align:left;">Transfer From (Transferor) </h5>	</th>
          <tr><td  rowspan="6"><?php if(empty($result_details1['image'])){ echo'<img style="border-radius:200px;" width="140px" src="'.Yii::app()->baseUrl.'/upload_pic/profile-icon.png'.'"/>'; }else{ echo '<img style="border-radius:200px;" width="140px" src="'.$imges.'"/>';}?></td></tr>
    
     <tr><td>First Name.</td><td class="td1"><b><?php echo $result_details1['name'];?></b></td></tr>
     <tr><td>Father/Spouse</td><td class="td1"><b><?php echo $result_details1['sodowo'];?></b></td></tr>
      <tr><td>CNIC</td><td class="td1"><b><?php echo $result_details1['cnic'];?></b></td></tr>
      <tr><td>Address</td><td class="td1"><b><?php echo substr($result_details1['address'],0,40);?></b></td></tr>
      <tr><td>Email</td><td class="td1"><b><?php echo $result_details1['email'];?></b></td></tr>
  </table>	</div>	<?php				
    /*  if($result_details1['mtype']=='Dealer'){ echo '<div class="black-bg" style="background-color:red;">Member Type:</div><div class="grey-bg">Dealer</div><br>';}
if($result_details3['mmtype']=='Dealer'){
echo '<div class="black-bg" style="background-color:red;">Purchased for:</div><div class="grey-bg">Plot Purchased for Resale</div><br>
';}*/

echo '</div>';
$memmm=$key['transferto_id'];
$connection = Yii::app()->db; 	
$sql_details  = "SELECT * FROM members where id=".$key['transferto_id']."";
$result_details = $connection->createCommand($sql_details)->queryRow();
$imgesr=Yii::app()->baseUrl.'/upload_pic/'.$result_details['image'];
?>
<div class="span8">
  		
		<table class="table" style=" border:1 px solid; font-size:12px;">
            <th bgcolor="#D3D3D3" colspan="3">
  <h5 style="text-align:left;">Transfer To (Transferee)</h5>	</th>
      <tr><td rowspan="6"><?php if(empty($result_details['image'])){ echo'<img style="border-radius:200px;" width="140px" src="'.Yii::app()->baseUrl.'/upload_pic/profile-icon.png'.'"/>'; }else{ echo '<img style="border-radius:200px;" width="140px" src="'.$imgesr.'"/>';}?></td></tr>
   
     <tr><td>First Name.</td><td class="td1"><b><?php echo $result_details['name'];?></b></td></tr>
     <tr><td>Father/Spouse</td><td class="td1"><b><?php echo $result_details['sodowo'];?></b></td></tr>
      <tr><td>CNIC</td><td class="td1"><b><?php echo $result_details['cnic'];?></b></td></tr>
      <tr><td>Address</td><td class="td1"><b><?php echo substr($result_details['address'],0,40);?></b></td></tr>
      <tr><td>Email</td><td class="td1"><b><?php echo $result_details['email'];?></b></td></tr>
    
  </table>	
</div><?php 
$connection = Yii::app()->db; 	
$ass  = "SELECT * FROM associates 
left join members on(associates.mid=members.id)
where associates.msid=".$key['mssid']."";
$result_res = $connection->createCommand($ass)->queryAll();
?>

  </div> </div>
	 </div>
    <?php }
$ppid=	$key['plot_id'];
	$connection = Yii::app()->db; 	
$sql_details2  = "SELECT * FROM plots where id=".$key['plot_id']."";
$result_details2 = $connection->createCommand($sql_details2)->queryRow();

$sql_install  = "SELECT * FROM installpayment where plot_id=".$key['plot_id']."";
$result_install= $connection->createCommand($sql_install)->queryAll();
$pai=0;
$rem=0;
foreach($result_install as $row5){if(empty($row5['paidamount'])){$rem=$rem+$row5['dueamount'];}
if(!empty($row5['paidamount'])){$pai=$pai+$row5['paidamount'];}
}
$old_date = $key['create_date'];            
$middle = strtotime($old_date);             
$new_date = date('d-m-y', $middle); 
	?>
   <div class="clearfix"></div>
    <br />
    
    <div class="clearfix"></div><br /><br />
<div class="tabbable">
  <ul class="nav nav-tabs">
  <!--  <li class="active">
      <a href="#0" data-toggle="tab"></a>
    </li>-->
  
   <!-- <li>
      <a href="#2" data-toggle="tab">Transfree</a>
    </li>
    -->
  </ul>
  <div class="tab-content">
   <!-- <div class="tab-pane active" id="0">
    
    </div>-->
     
    <div>
      <p>
        <?php
	$sql_payment='';
	$result_payments='';	
		$connection = Yii::app()->db;
		$land  = "SELECT * FROM installpayment where plot_id='".$ppid."' and paidamount!='' and mem_id='".$memmm."' ";
		$land_cost = $connection->createCommand($land)->queryAll();
		 $inst =count($land_cost);
	$sql_payments  = "SELECT * FROM plotpayment where plot_id='".$ppid."' and paidamount!=''  and mem_id='".$memmm."'";
		$result_payments = $connection->createCommand($sql_payments)->queryAll();
echo '
 <h5><strong>Fees/Charges Detail</strong></h5>
    <table class="table table-striped table-new table-bordered" style="font-size:13px;" >
          	<thead style="background:#666; border-color:#ccc; color:#fff; ">

<tr>

        	<th><b>Sr.# </b></th>

			<th><b>Account Head </b></th>

            <th><b>Due Amount</b></th>
			 <th><b>Paid Amount</b></th>
<th><b>Discount</b></th>
              <th><b>Balance Amount</b></th>
			<th><b>Due Date</b></th>
              <th><b>Paid Date</b></th>
			
			<th><b>Due Surcharge</b></th>
			<th><b>Paid Surcharge</b></th>

            <th><b>DD/PO/CH No.</b></th>


            <th><b>Action</b></th>

	</tr>		

        </thead>

		<tbody>';

	$bsurcharge=0;
    	
	//$paidsurcharge=0;
	$bsur=0;
	$res=array();
$ndis=0;
$i=0;
    foreach($result_payments as $row)
 
	{	
	
	
	

		$i++;
		
		
		if($row['discount']==''){$row['discount']=0;}
  echo '<tr><td>' . $i . '</td>

 <td>' .$row['payment_type']. '</td>

 <td style="text-align:right;">' .$row['amount']. '</td>
 <td style="text-align:right;">' .$row['paidamount']. '</td>
 
  <td style="text-align:right;">'.number_format($row['discount']).' </td>
 <td style="text-align:right;">'.number_format($bsur-$row['discount']).'</td>
  <td>' . $row['duedate']. '</td>
  <td>' . $row['date'] . '</td>
  <td style="text-align:right;">' . $row['surcharge'] . '</td>
    <td style="text-align:right;">' . $row['paidsurcharge'] . '</td>
   <td>' . $row['detail'] . '</td>
<td>';if($row['fstatus']=='approved'){ echo '<b style="color:Green;">Verified</b></td></tr>';}
  


//$bsur=$bsur+$bsur;
}
echo '</tbody></table>';
if(empty($inst)){echo'';}else{

echo'<h5><strong>Installment Detail</strong></h5><table  class="table table-striped table-new table-bordered" style="font-size:13px;">
    <thead style="background:#666; border-color:#ccc; color:#fff; ">
      <tr>
        <th><b>Sr.# </b></th>
       <th style="width:65px;"><b>Due Date</b></th>
        <th style="width:65px;"><b>Paid Date</b></th>
        <th><b>Due Amount</b></th>
        <th><b>Paid Amount</b></th>
       <th><b>Payment Mode</b></th>
        <th><b>DD/PO/CH No.</b></th>
        <th><b>Due Surcharge</b></th>
          <th><b>Paid Surcharge</b></th>
        <th style="width:120px;"><b>Remarks</b></th>
        <th style="width:140px;"><b>Status/Action</b></th>
      </tr>
    </thead>
    <tbody>';
     
	  $i=1;
	 $ins='';
	$res=array();
	foreach($land_cost as $pay)
	{	
$i++;
  
	
 	$co1=1;
	 foreach($land_cost as $pay2){if($pay2['ref']==$pay['id']){$co1++;}}
	if($pay['ref']==0){

		
  echo '<tr><td rowspan="'.$co1.'">'.$pay['lab']. '</td>

     <td rowspan="'.$co1.'">'.$pay['due_date'].'</td>
     <td>'.$pay['paid_date'].'</td>
     <td rowspan="'.$co1.'" style="text-align:right">'.$pay['dueamount'].'</td>
     <td style="text-align:right">'.$pay['paidamount'].'</td>
     <td>'.$pay['payment_type'].'</td>
     <td>'.$pay['detail'].'</td>
     <td align="right">'.$pay['surcharge'].'</td>
	 <td align="right">'.$pay['paidsurcharge'].'</td>
     <td>'.$pay['remarks'].'</td>
     <td>';if($pay['fstatus']=='approved'){ echo'<b style="color:Green;">Verified</b></td></tr>';}
	 $id='';
	$id=$pay['id'];
	 }
	 foreach($land_cost as $pay1){
	 if($pay1['ref']==$id){
	echo '<tr>

    
     <td>'.$pay1['paid_date'].'</td>
     <td style="text-align:right">'.$pay1['paidamount'].'</td>
     <td>'.$pay1['payment_type'].'</td>
     <td>'.$pay1['detail'].'</td>
     <td align="right">'.$pay1['surcharge'].'</td>
	 <td align="right">'.$pay1['paidsurcharge'].'</td>
     <td>'.$pay1['remarks'].'</td>
     <td>';if($pay1['fstatus']=='approved'){ echo'<b style="color:Green;">Verified</b>';} 
	
	}}
	
	 }
	 echo '</td></tr></tbody></table>'; }?>
  
      </p>
    </div>
  
  </div>
</div>




</section>
</div>