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
<section class="reg-section margin-top-30" style="font-size=12px;">
  
  <?php	
            $res=array();
            foreach($plotdetails as $key){

$connection = Yii::app()->db;
$fstatus=$key['fstatus'];
 	$comment=$key['comment'];
$sql_details1  = "SELECT * FROM members where id=".$key['transferfrom_id']."";
$result_details1 = $connection->createCommand($sql_details1)->queryRow();
$imges=Yii::app()->baseUrl.'/upload_pic/'.$result_details1['image'];
$sql_details3  = "SELECT * FROM memberplot where plot_id=".$key['plot_id']."";
$result_details3 = $connection->createCommand($sql_details3)->queryRow();
            echo '
<div class="span12" style="">

  <h5 style="text-align:left;">Plot Details</h5> 	

  <div class="black-bg">Membership No.</div><div class="grey-bg">'.$result_details3['plotno'].'</div><br>
  	<div class="black-bg">File/Plot No.</div><div class="grey-bg">'.$key['plot_detail_address'].'</div><br>

    <input type="hidden" value="" name="plot_id" id="plot_id" class="f-left span4 clearfix" />

  	<div class="black-bg">File/Plot Address:</div><div class="grey-bg">'.$key['street'].','.$key['sector_name'].'</div>

    <br>

  	<div class="black-bg">Plot Size:</div><div class="grey-bg">'.$key['size'].'('.$key['plot_size'].')</div>

    <br>

  	<div class="black-bg">Project Name:</div><div class="grey-bg">'.$key['project_name'].'</div>

    <br>


<div class="span5 left-box">

  <h5 style="text-align:left;">Transfer From (Transferor) </h5>

  
<div><img width="150px" src="'.$imges.'"/></div>

      <input type="hidden" value="" name="transfer_from_memberid" id="member_id" class="reg-login-text-field" />

      <div class="black-bg">First Name :</div><div class="grey-bg">'.$result_details1['name'].'</div><br>

    <div class="black-bg">SODOWO:    </div><div class="grey-bg">'.$result_details1['sodowo'].'</div><br>

    <div class="black-bg">CNIC:   </div><div class="grey-bg"> '.$result_details1['cnic'].'</div><br>

    <div class="black-bg">Address:</div><div class="grey-bg">'.substr($result_details1['address'],0,40).'</div><br>

    <div class="black-bg">Email:</div><div class="grey-bg">'.$result_details1['email'].'</div><br>';
if($result_details1['mtype']=='Dealer'){ echo '<div class="black-bg" style="background-color:red;">Member Type:</div><div class="grey-bg">Dealer</div><br>';}
if($result_details3['mmtype']=='Dealer'){
echo '<div class="black-bg" style="background-color:red;">Purchased for:</div><div class="grey-bg">Plot Purchased for Resale</div><br>
';}
$connection = Yii::app()->db;
$ass  = "SELECT * FROM associates 
left join members on(associates.mid=members.id)
where associates.msid=".$key['mssid']."";
$result_res = $connection->createCommand($ass)->queryAll();
?>
<h5 style="text-align:left;">Associates Members</h5>
 <table class="table table-striped table-new table-bordered">
 <tbody>
 <?php foreach($result_res as $result_ass){
	 
$imgesAss=Yii::app()->baseUrl.'/upload_pic/'.$result_ass['image'];
	 ?>
<tr><td rowspan="3"> <img width="50px" src="<?php echo $imgesAss?>"/></td></tr>
<tr><td>	Member Name :</td><td><?php echo $result_ass['name']?></td></tr>
<tr><td>    CNIC:    </td><td><?php echo $result_ass['cnic']?></td></tr>
<?php }?>
</tbody></table>

</div>	

<?php 
$memmm=$key['transferto_id']; 	
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

$old_date = $key['create_date'];            
$middle = strtotime($old_date);             
$new_date = date('d-m-y', $middle); 
	?>
   <div class="clearfix"></div>
    <br />
    <div class="span5 left-box">
    <?php $home=Yii::app()->request->baseUrl.'/index.php' ?>
    <h5 style="text-align:left;">Price/Installments: <a style="float:right;" href="<?php echo $home?>/memberplot/payment_details?id=<?php echo $key['plot_id']; ?>&&pid=">Payment Details List</a><br></h5>
    <div class="black-bg">Cost Of Plot:</div><div class="grey-bg"><?php echo number_format($result_details2['price']);  ?></div><br>
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
    <div class="clearfix"></div><br /><br />
<div class="tabbable">
  <ul class="nav nav-tabs">
    <li class="active">
      <a href="#0" data-toggle="tab"></a>
    </li>
    <li>
      <a href="#1" data-toggle="tab">Transferer</a>
    </li>
    <li>
      <a href="#2" data-toggle="tab">Transfree</a>
    </li>
    
  </ul>
  <div class="tab-content">
    <div class="tab-pane active" id="0">
    
    </div>
     <div class="tab-pane" id="1">
      <p>
       <?php
		$connection = Yii::app()->db;
		$land  = "SELECT * FROM installpayment where plot_id='".$ppid."' and paidamount!='' ";
		$land_cost = $connection->createCommand($land)->queryAll();
		$sql_payment  = "SELECT * FROM plotpayment where plot_id='".$ppid."' and paidamount!='' ";
		$result_payments = $connection->createCommand($sql_payment)->queryAll();
echo '<table  class="table table-striped table-new table-bordered">
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
     <td>';if($pay['fstatus']=='approved'){ echo'<b style="color:Green;">Verified</b>';} else{ echo '<input type="submit" name="sub" id="'.$pay['id'].'" onclick="myfunction1('.$pay['id'].')" class="btn-info button" value="Verify"></td>';}
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
     <td>';if($pay1['fstatus']=='approved'){ echo'<b style="color:Green;">Verified</b>';} else{ echo '<input type="submit" name="sub" id="'.$pay1['id'].'" onclick="myfunction1('.$pay1['id'].')" class="btn-info button" value="Verify"></td>';}
	
	}}
	
	 }
	 echo '</tbody></table>';?>
     <?php	echo ' <table class="table table-striped table-new table-bordered">

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
<td>';if($row['fstatus']=='approved'){ echo '<b style="color:Green;">Verified</b>';}
  


//$bsur=$bsur+$bsur;
}
echo '</tbody></table>';?>
      </p>
    </div>
    <div class="tab-pane" id="2">
      <p>
        <?php
	$sql_payment='';
	$result_payments='';	
		$connection = Yii::app()->db;
		$land  = "SELECT * FROM installpayment where plot_id='".$ppid."' and paidamount!='' and mem_id='".$memmm."' ";
		$land_cost = $connection->createCommand($land)->queryAll();
	$sql_payments  = "SELECT * FROM plotpayment where plot_id='".$ppid."' and paidamount!=''  and mem_id='".$memmm."'";
		$result_payments = $connection->createCommand($sql_payments)->queryAll();
echo '<table  class="table table-striped table-new table-bordered">
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
     <td>';if($pay['fstatus']=='approved'){ echo'<b style="color:Green;">Verified</b>';}
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
	 echo '</tbody></table>';?>
     <?php	echo ' <table class="table table-striped table-new table-bordered">

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
<td>';if($row['fstatus']=='approved'){ echo '<b style="color:Green;">Verified</b>';}
  


//$bsur=$bsur+$bsur;
}
echo '</tbody></table>';?>
      </p>
    </div>
  
  </div>
</div>
<hr />
<a href="docs?id=<?php echo $_REQUEST['id'] ?>" >Documents</a>
	<?php 
	$stat=$result_details['status'];
	$plotid=$_REQUEST['id'];
	if($stat==0){echo '<h4>Transfer to member is not active register member please update<br/><a href="'.$this->CreateAbsoluteUrl("user/update_member?id=".$key['transferto_id']."").'">Update Member</a></h4> ';}if($key['status']!='Approved'){
if($stat==1){?>
  <div class="bot-box">

<div class="float-left" >
  
    <p class="reg-right-field-area margin-left-5">
    <?php echo' <a href="'.Yii::app()->request->baseUrl.'/images/imagetransfer/'.$key['image'].'" target="_blank"><img style="height:130px;" src="'.Yii::app()->request->baseUrl.'/images/imagetransfer/'.$key['image'].'"></a>';?>
  
  </p>
  </div>
  <form action="tsubmitstatus" enctype="multipart/form-data" method="post" onsubmit="return validateForm()" >
    <input type="hidden" value="<?php echo $plotid;  ?>" name="plot_id" id="plot_id" class="f-left span4 clearfix" />
    <div class="new-box-01">
      <label>
      <h5>Action</h5>
      </label>
      <select name="status" id="status" style="width:250px;">
      <option value="">Select Status</option>
        <option value="pending">Pending</option>
        <option value="Approved">Approved</option>
       
      </select>
    </div>
    <div class="new-box-01">
      <label>
      <h5>Comment By Administrator</h5>
      </label>
      <textarea  class="cmnt" name="cmnt" id="cmnt" style=" float:left;"  ></textarea>
      <input name="submit" type="submit" value="Send Transfer Request" class="btn-info pull-right" style="padding:5px 10px; float:left; clear:both; border:1px solid #fff;" />
    </div>
    </div>
    <div style="height: 600px;

    padding: 0 0 0 32px;

    width: 300px;"> <span style="color:#FF0000; display:block;" id="error-pending"></span> <span style="color:#FF0000;display:block;" id="error-cmnt"></span> <span style="color:#FF0000; display:block;" id="memerror"></span> <span style="color:#FF0000; display:block;" id="plotno"></span> <span style="color:#FF0000; display:block;" id="image"></span> </div>
  </form>
  <?php } }}?>
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
 <script>
var id =document.getElementById(id);
function myfunction(id)
{
$.ajax({
     type: "POST",
      url:    "ajaxRequest3?val1="+id,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var listItems="";
	listItems+="<option value=>Select Street</option>";
	$(json).each(function(i,val){
document.getElementById(id).style.visibility = "hidden"; 
	listItems+= " ";
});listItems+="";
$("#street_id").html(listItems);
          }
    });
}



</script>