<style>
.black-bg {
	background: #333;
	color: #fff;
	width: 21%;
	float: left;
	padding: 1px 10px;
	margin: 2px 0px;
}
.grey-bg {
	background: #CCC;
	color: #000;
	width: 69%;
	padding: 1px 10px;
	float: left;
	margin: 2px 0px;
	height: 20px;
}
.left-box {
	float: left;
	border: 1px solid #ccc;
	padding: 0 5px;
	margin: 0 5px;
}
.bot-box {
	background: none repeat scroll 0 0 #6699FF;
	border-radius: 10px;
	clear: both;
	color: #FFFFFF;
	height: 265px;
	margin: 30px auto;
	padding: 20px;
	position: relative;
	top: 30px;
	width: 55%;
}
.new-box-01 {
	float: left;
	width: 50%;
	margin-bottom: 40px;
}
</style>

<div class="shadow">
  <h3>Plot Transfer Details</h3>
</div>

<!-- shadow -->


<section class="reg-section margin-top-30" style="font-size=12px;">
  <?php 

//$plotdetails_data = Yii::app()->session['plotdetails_array'];



?>
  <?php	
            $res=array();

//echo 123;exit;
            foreach($plotdetails as $key){

$connection = Yii::app()->db;
$fstatus=$key['fstatus'];
 	$comment=$key['comment'];
$sql_details1  = "SELECT * FROM members where id=".$key['transferfrom_id']."";
$result_details1 = $connection->createCommand($sql_details1)->queryRow();
$imges=Yii::app()->baseUrl.'/upload_pic/'.$result_details1['image'];


            echo '
<div class="span12" style="">

  <h5 style="text-align:left;">Plot Details</h5> 	
  	<div class="black-bg">Project Name:</div><div class="grey-bg">'.$key['project_name'].'</div><br/>

  	<div class="black-bg">Current Membership No.:</div><div class="grey-bg">'.$key['plotno'].'</div><br/>
  
  	<div class="black-bg">File/Plot No.</div><div class="grey-bg">'.$key['plot_detail_address'].'</div><br>

    <input type="hidden" value="" name="plot_id" id="plot_id" class="f-left span4 clearfix" />

  	<div class="black-bg">File/Plot Address:</div><div class="grey-bg">'.$key['street'].','.$key['sector_name'].'</div>

    <br>

  	<div class="black-bg">Plot Size:</div><div class="grey-bg">'.$key['size'].'('.$key['plot_size'].')</div>


    <br>


<div class="span5 left-box">

  <h5 style="text-align:left;">Transfer From (Transferor) </h5>

  
<div><img width="150px" src="'.$imges.'"/></div>

      <input type="hidden" value="" name="transfer_from_memberid" id="member_id" class="reg-login-text-field" />

      <div class="black-bg">First Name :</div><div class="grey-bg">'.$result_details1['name'].'</div><br>

    <div class="black-bg">SODOWO:    </div><div class="grey-bg">'.$result_details1['sodowo'].'</div><br>

    <div class="black-bg">CNIC:   </div><div class="grey-bg"> '.$result_details1['cnic'].'</div><br>

    <div class="black-bg">Address:</div><div class="grey-bg">'.substr($result_details1['address'],0,40).'</div><br>

    <div class="black-bg">Email:</div><div class="grey-bg">'.$result_details1['email'].'</div><br>
     <div class="black-bg">Phone No.:</div><div class="grey-bg">'.$key['m_from_phone'].'</div><br>

    

   

</div>';
$memmm=$key['transferto_id'];
$seller=$key['transferfrom_id'];
$connection = Yii::app()->db; 	
$sql_details  = "SELECT * FROM members where id=".$key['transferto_id']."";
$result_details = $connection->createCommand($sql_details)->queryRow();
$imgesr=Yii::app()->baseUrl.'/upload_pic/'.$result_details['image'];
echo '<div class="span6 left-box">

  <h5 style="text-align:left;">Transfer To (Transferee)</h5>

   	<div><img width="150px" src="'.$imgesr.'"/></div>
		<div class="black-bg">First Name :</div><div class="grey-bg">'.$result_details['name'].'</div><br>

    <div class="black-bg">SODOWO:    </div><div class="grey-bg">'.$result_details['sodowo'].'</div><br>

    <div class="black-bg">CNIC:   </div><div class="grey-bg"> '.$result_details['cnic'].'</div><br>

    <div class="black-bg">Address:</div><div class="grey-bg">'.substr($result_details['address'],0,40).'</div><br>

    <div class="black-bg">Email:</div><div class="grey-bg">'.$result_details['email'].'</div><br>
  <div class="black-bg">New Membership No.:</div><div class="grey-bg">'.$key['tempms'].'</div><br>
   <div class="black-bg">Phone No.:</div><div class="grey-bg">'.$key['m_to_phone'].'</div><br>
    
    
	
	</div>';?>
	
    <?php
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
$sql_details3  = "SELECT * FROM memberplot where plot_id=".$key['plot_id']."";
$result_details3 = $connection->createCommand($sql_details3)->queryRow();
$old_date = $key['create_date'];            
$middle = strtotime($old_date);             
$new_date = date('d-m-y', $middle); 
	?>
   <div class="clearfix"></div>
    <br />
   
<div class="span5">
  <h4>Update Payments (Purchaser)</h4>
  <a class="btn" href="plotinstallt?id=<?php echo $key['plot_id'].'&pid='.$key['project_id'].'&m='.$result_details['id'] ?>">Add Installment </a>
  <a class="btn" href="plotchargest?id=<?php echo $key['plot_id'].'&pid='.$key['project_id'].'&m='.$result_details['id'] ?>">Add Charges </a>
  </div>
	<?php 
	$stat=$result_details['status'];
	$plotid=$_REQUEST['id'];
	if($stat==0){echo '<h4>Transfer to member is not active register member please update<br/><a href="'.$this->CreateAbsoluteUrl("user/update_member?id=".$key['transferto_id']."").'">Update Member</a></h4> ';}
	?>
  <div class="clearfix"></div>
  
  
  <div class="span12">
  <h4>Documentation</h4>
  <a class="btn" href="doc?id=<?php echo $key['tpid'] ?>">Upload Documents</a>
  </div>
  <div class="clearfix"></div><br /><br />
<div class="tabbable">
  <ul class="nav nav-tabs">
    <li class="active">
      <a href="#0" data-toggle="tab">Details</a>
    </li>
    <li>
      <a href="#1" data-toggle="tab">Seller (Payments)</a>
    </li>
    <li>
      <a href="#2" data-toggle="tab">Purchaser (Payments)</a>
    </li>
    
  </ul>
  <div class="tab-content">
    <div class="tab-pane active" id="0">
    <div class="span5 left-box">
    <?php $home=Yii::app()->request->baseUrl.'/index.php' ?>
    <h5 style="text-align:left;">Price/Installments: <a style="float:right;" href="<?php echo $home?>/memberplot/payment_details?id=<?php echo $key['plot_id']; ?>&&pid=">Payment Details List</a><br></h5>
    <div class="black-bg">Cost Of Plot:</div><div class="grey-bg"><?php echo  floatval($result_details2['price']);  ?></div><br>
     <div class="black-bg">Paid:</div><div class="grey-bg"><?php echo number_format($pai);  ?></div><br>
      <div class="black-bg">Balance:</div><div class="grey-bg"><?php echo number_format($rem);?></div><br>
    </div>
	<div class="span5 left-box">
    <h5 style="text-align:left;">Request Details:</h5>
    <div class="black-bg">Request Date:</div><div class="grey-bg"><?php echo $new_date  ?></div><br>
    <div class="black-bg">User Name:</div><div class="grey-bg"><?php echo $key['firstname'] ?></div><br>
    <div class="black-bg">Email.:</div><div class="grey-bg"><?php echo $key['email'] ?></div><br>
    </div>
	<div class="span5 left-box">
    <h5 style="text-align:left;">Admin Status:</h5>
    <div class="black-bg">Comment:</div><div class="grey-bg"><?php echo $key['cmnt']  ?></div><br>
    <div class="black-bg"> Status:</div><div class="grey-bg"><?php echo $key['status']?></div><br>
    </div> 
    </div>
    <div class="tab-pane" id="1">
      <p><h5>Installment Details</h5>
       <?php
		$connection = Yii::app()->db;
		$land  = "SELECT * FROM installpayment where plot_id='".$ppid."' and paidamount!='' and mem_id!='".$memmm."' and fstatus !='Cancelled'";
		$land_cost = $connection->createCommand($land)->queryAll();
		//$sql_payment  = "SELECT * FROM plotpayment where plot_id='".$ppid."' and paidamount!='' and mem_id!='".$memmm."' and fstatus !='Cancelled'";
    $sql_payment = "Select * from plotpayment where plot_id='" . $ppid. "' and (mem_id='" . $seller. "' or pobm ='" . $seller. "' or payment_type NOT IN ('MS Fee','Transfer Fee')) ";
		$result_payments = $connection->createCommand($sql_payment)->queryAll();
echo '<table  class="table table-striped table-new table-bordered">
    <thead style="background:#666; border-color:#ccc; color:#fff; ">
      <tr>
        <th><b>Description </b></th>
       <th><b>Due Date</b></th>
        <th><b>Paid Date</b></th>
	   <th width="10%"><b>Due Amount</b></th>
        <th width="10%"><b>Paid Amount</b></th>
        <th><b>Payment Mode</b></th>
        <th><b>Ref</b></th>
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
		
  echo '<tr>
  <td rowspan="'.$co1.'">'.$pay['lab']. '</td>
     <td rowspan="'.$co1.'">';if(($pay['due_date_temp']==null) || ($pay['due_date_temp']=='0000-00-00') || ($pay['due_date_temp'] == '30-11--0001' )) { echo''; } else{ echo $pay['due_date_temp'];}echo'</td>
     <td>'.$pay['paid_date_temp'].'</td>
     <td rowspan="'.$co1.'" style="text-align:right">'.$pay['dueamount'].'</td>
     <td style="text-align:right">'.$pay['paidamount'].'</td>
     <td>'.$pay['payment_type'].'</td>
     <td>'.$pay['detail'].'</td>
    
     <td>';if($pay['fstatus']=='approved'){ echo'<b style="color:Green;">Verified</b>';} else{ echo '<input type="submit" name="sub" id="'.$pay['id'].'" onclick="myfunction1('.$pay['id'].')" class="btn-info button" value="Verify"></td></tr>';}
	 $id='';
	$id=$pay['id'];
	 }
	 foreach($land_cost as $pay1){
	 if($pay1['ref']==$id){
	echo '<tr>

    <td ">'.$pay['lab']. '</td>
     <td ">';if(($pay1['due_date_temp']==null) || ($pay1['due_date_temp']=='0000-00-00') || ($pay1['due_date_temp'] == '30-11--0001' )) { echo''; } else{ echo $pay1['due_date_temp'];}echo'</td>
     <td>'.$pay['paid_date_temp'].'</td>
     <td rowspan="'.$co1.'" style="text-align:right">'.$pay['dueamount'].'</td>
     <td style="text-align:right">'.$pay['paidamount'].'</td>
     <td>'.$pay['payment_type'].'</td>
     <td>'.$pay['detail'].'</td>
	 
     <td>';if($pay1['fstatus']=='approved'){ echo'<b style="color:Green;">Verified</b>';} else{ echo '<input type="submit" name="sub" id="'.$pay1['id'].'" onclick="myfunction1('.$pay1['id'].')" class="btn-info button" value="Verify"></td>';}
	
	}}
	
	 }
	 echo '</tbody></table>';?>
     <h5>Fees / Charges Details</h5>
     <?php	echo ' <table class="table table-striped table-new table-bordered">

            	<thead style="background:#666; border-color:#ccc; color:#fff; ">

<tr>

        	<th><b>Description </b></th>
       <th><b>Due Date</b></th>
        <th><b>Paid Date</b></th>
	   <th width="10%"><b>Due Amount</b></th>
        <th width="10%"><b>Paid Amount</b></th>
        <th><b>Payment Mode</b></th>
        <th><b>Ref</b></th>
        <th style="width:140px;"><b>Status/Action</b></th>
	</tr>		

        </thead>

		<tbody>';

	$bsurcharge=0;
  $due_date_temp='';
  $paid_date_temp='';
	//$paidsurcharge=0;
	$bsur=0;
	$res=array();
$ndis=0;
    foreach($result_payments as $row)
 
	{	
	
	 $paid_date_temp = strtotime($row['paid_date_temp']); 
	 $paid_date_temp = date('d-m-Y', $paid_date_temp);
	 $due_date_temp = strtotime($row['due_date_temp']); 
	 $due_date_temp = date('d-m-Y', $due_date_temp);
	

		$i++;
		
		
		//if($row['discount']==''){$row['discount']=0;}
		
  echo '</tr><td>'.$row['payment_type'].'</td>
     <td>';if(($due_date_temp==null) || ($due_date_temp=='0000-00-00') || ($due_date_temp == '30-11--0001' )) { echo''; } else{ echo $due_date_temp;}echo'</td>
	 <td>';if(($paid_date_temp==null) || ($paid_date_temp=='0000-00-00') || ($paid_date_temp == '30-11--0001' )) { echo''; } else{ echo $paid_date_temp;}echo'</td>
     <td style="text-align:right">'.$row['amount'].'</td>
     <td>'.$row['paidamount'].'</td>
     <td>'.$row['paidas'].'</td>
     <td align="right">'.$row['detail'].'</td>
<td>';if($row['fstatus']=='approved'){ echo '<b style="color:Green;">Verified</b>';}else{ echo'<input type="submit" name="sub" id="'.$row['id'].'" onclick="myfunction('.$row['id'].')" class="btn" value="Verify"></td></tr>	';} 
  


//$bsur=$bsur+$bsur;
}
echo '</tbody></table>';?>
      </p>
    </div>
    <div class="tab-pane" id="2">
      <p><h5>Installment Details</h5>
        <?php
		$connection = Yii::app()->db;
		$land  = "SELECT * FROM installpayment where plot_id='".$ppid."' and paidamount!='' and mem_id='".$memmm."' ";
		$land_cost = $connection->createCommand($land)->queryAll();
		$sql_payment  = "SELECT * FROM plotpayment where plot_id='".$ppid."' and paidamount!=''  and mem_id='".$memmm."'";
		$result_payments = $connection->createCommand($sql_payment)->queryAll();
echo '<table  class="table table-striped table-new table-bordered">
    <thead style="background:#666; border-color:#ccc; color:#fff; ">
      <tr>
         	<th><b>Description </b></th>
       <th><b>Due Date</b></th>
        <th><b>Paid Date</b></th>
	   <th width="10%"><b>Due Amount</b></th>
        <th width="10%"><b>Paid Amount</b></th>
        <th><b>Payment Mode</b></th>
        <th><b>Ref</b></th>
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
		
  echo '<tr> <td rowspan="'.$co1.'">'.$pay['lab']. '</td>
     <td rowspan="'.$co1.'">';if(($due_date_temp==null) || ($due_date_temp=='0000-00-00') || ($due_date_temp == '30-11--0001' )) { echo''; } else{ echo $due_date_temp;}echo'</td>
     <td>'.$pay['paid_date_temp'].'</td>
     <td rowspan="'.$co1.'" style="text-align:right">'.$pay['dueamount'].'</td>
     <td style="text-align:right">'.$pay['paidamount'].'</td>
     <td>'.$pay['payment_type'].'</td>
     <td>'.$pay['detail'].'</td>
     <td>';if($pay['fstatus']=='approved'){ echo'<b style="color:Green;">Verified</b>';} else{ echo '<input type="submit" name="sub" id="'.$pay['id'].'" onclick="myfunction1('.$pay['id'].')" class="btn-info button" value="Verify"></td>';}
	 $id='';
	$id=$pay['id'];
	 }
	 foreach($land_cost as $pay1){
	     $paid_date_temp = strtotime($pay1['paid_date_temp']); 
	 $paid_date_temp = date('d-m-Y', $paid_date_temp);
	 $due_date_temp = strtotime($pay1['due_date_temp']); 
	 $due_date_temp = date('d-m-Y', $due_date_temp);
	 if($pay1['ref']==$id){
	echo '<tr>

    
     <td ">'.$pay['lab']. '</td>
     <td ">'; if(($due_date_temp==null) || ($due_date_temp=='0000-00-00') || ($due_date_temp == '30-11--0001' )) { echo''; } else{ echo $due_date_temp;}echo'</td>
     <td>'.$paid_date_temp.'</td>
     <td rowspan="'.$co1.'" style="text-align:right">'.$pay['dueamount'].'</td>
     <td style="text-align:right">'.$pay['paidamount'].'</td>
     <td>'.$pay['payment_type'].'</td>
     <td>'.$pay['detail'].'</td>
     <td>';if($pay1['fstatus']=='approved'){ echo'<b style="color:Green;">Verified</b>';} else{ echo '<input type="submit" name="sub" id="'.$pay1['id'].'" onclick="myfunction1('.$pay1['id'].')" class="btn-info button" value="Verify"></td>';}
	
	}}
	
	 }
	 echo '</tbody></table>';?>
     <h5>Fees / Charges Details</h5>
     <?php	echo ' <table class="table table-striped table-new table-bordered">

            	<thead style="background:#666; border-color:#ccc; color:#fff; ">

<tr>

          	<th><b>Description </b></th>
       <th><b>Due Date</b></th>
        <th><b>Paid Date</b></th>
	   <th width="10%"><b>Due Amount</b></th>
        <th width="10%"><b>Paid Amount</b></th>
        <th><b>Payment Mode</b></th>
        <th><b>Ref</b></th>
        <th style="width:140px;"><b>Status/Action</b></th>

	</tr>		

        </thead>

		<tbody>';

	$bsurcharge=0;
    	
	//$paidsurcharge=0;
	$bsur=0;
	$res=array();
$ndis=0;
    foreach($result_payments as $pay1)
 
	{	
     $paid_date_temp = strtotime($pay1['paid_date_temp']); 
	 $paid_date_temp = date('d-m-Y', $paid_date_temp);
	 $due_date_temp = strtotime($pay1['due_date_temp']); 
	 $due_date_temp = date('d-m-Y', $due_date_temp);
	

		$i++;
		
		
		//if($row['discount']==''){$row['discount']=0;}
   echo '<tr><td>'.$pay1['payment_type'].'</td>
     <td>';if(($due_date_temp==null) || ($due_date_temp=='0000-00-00') || ($due_date_temp == '30-11--0001' )) { echo''; } else{ echo $due_date_temp;}echo'</td>
	 <td>'.$pay1['paid_date_temp'].'</td>
     <td style="text-align:right">'.$pay1['amount'].'</td>
     <td>'.$pay1['paidamount'].'</td>
     <td>'.$pay1['paidas'].'</td>
     <td align="right">'.$pay1['detail'].'</td>
<td>';if($pay1['fstatus']=='approved'){ echo '<b style="color:Green;">Verified</b>';}else{ echo'<input type="submit" name="sub" id="'.$pay1['id'].'" onclick="myfunction('.$pay1['id'].')" class="btn" value="Verify"></td></tr>	';} 
  


//$bsur=$bsur+$bsur;
}
echo '</tbody></table>';?>
      </p>
    </div>
  
  </div>
</div>
<hr />
  <div class="bot-box">


 
    <div class="new-box-01">
      <label>
      <h5>Upload Image</h5>
      </label>
      <form action="timage"  enctype="multipart/form-data" method="post"  >
<input type="hidden" name="plot_id" value="<?php echo $key['plot_id']?>" />
<div class="float-left" >
  
    <p class="reg-right-field-area margin-left-5">
    <?php echo' <a href="'.Yii::app()->request->baseUrl.'/images/imagetransfer/'.$key['image'].'" target="_blank"><img style="height:130px;" src="'.Yii::app()->request->baseUrl.'/images/imagetransfer/'.$key['image'].'"></a>';?>
  
  </p>
  </div>
        <input id="image1" type="file" name="image1" accept="image/*">
        <input type="submit" name="upload" class="btn" value="Upload">
        </form>
    </div> 
    <div class="new-box-01">
      
    <form action="Crequest11" enctype="multipart/form-data" method="post"  >
<input type="hidden" name="pid"  value="<?php echo $key['plot_id'];?>" />
      <input name="submit" type="submit" value="Cancel Request" class="btn-info pull-right" style="padding:5px 10px; float:left; clear:both; border:1px solid #fff;" />
    </form>
    </div>
    </div><?php }?>
    <div style="height: 600px;

    padding: 0 0 0 32px;

    width: 300px;"> <span style="color:#FF0000; display:block;" id="error-pending"></span> <span style="color:#FF0000;display:block;" id="error-cmnt"></span> <span style="color:#FF0000; display:block;" id="memerror"></span> <span style="color:#FF0000; display:block;" id="plotno"></span> <span style="color:#FF0000; display:block;" id="image"></span> </div>
 
 
  </div>
  <div class="clearfix"></div>
</section>

<!-- section 3 -->

<div class="clearfix"></div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> 
<script>

  $(document).ready(function()
     {   $("#plotno").change(function()
           {
         	select_mem($(this).val());
		   });
		    });


function select_mem(id)
{
$.ajax({
      type: "POST",
      url:    "ajaxRequest6?val1="+id,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
	  
var listItems='';
	$(json).each(function(i,val){
	listItems+= "<option value='" + val.id + "'>Membership number Already in DB</option>";
      
});listItems+="";

$("#memerror").html(listItems);
          }
});
}
function validateForm(){
	$("#error-pending").hide();
	$("#error-cmnt").hide();
	$("#error-image").hide();
	//	var x=document.forms["form"]["firstname"].value;
	var a = $("#status").val();
	var d = $("#cmnt").val();
	
	var counter=0;



if (a==null || a=="" )

  {

  $("#error-pending").html("Select Status");

  $("#error-pending").show();

  counter =1;

  }


  if (d==null || d=="")

  {

  $("#error-cmnt").html("Please Give Some Comments");

  $("#error-cmnt").show();

  counter =1;

  }
 
 

  if(counter==1)

  	return false;

  

}

 <!--VALIDATION END-->
 

 </script> 