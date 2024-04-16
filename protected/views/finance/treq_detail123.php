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
	width: 95%;
}
.new-box-01 {
	float: left;
	width: 25%;
	margin-bottom: 40px;
}
.td1{
	color:#004080;
	font-weight:bold;
	}
</style>

<div class="shadow">
  <h3>Plot Transfer Details</h3>
</div>

<!-- shadow -->


<section class="reg-section margin-top-30" style="font-size=12px;">
 <div class="span12 left-box"> 
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
<div class="panel panel-default">
 <div class="panel-body">
    <p>Plot Details</p>
  </div>
  <!-- Table -->
  <table class="table" style="width:50%;">
     <tr><td>MS No.</td><td><?php echo $key['plotno'];?></td></tr>
    <tr><td>File/Plot No.</td><td><?php echo $key['plot_detail_address'];?></td></tr>
     <tr><td>Street/Lane.</td><td><?php echo $key['street'];?></td></tr>
     <tr><td>Block</td><td><?php echo $key['sector_name'];?></td></tr>
      <tr><td>Project Name</td><td><?php echo $key['project_name'];?></td></tr>
      <tr><td>Property Type</td><td><?php echo $key['com_res'];?></td></tr>
      <tr><td>Allotment Type</td><td><?php if($key['atype']=='Against Land'){ echo 'Againt Land';}else{echo'Normal';}?></td></tr>

  </table>

</div>
<hr />
<div class="span11">
<div class="span6" style="float:left">
		<table class="table" style="border:1 px solid;">
        <th bgcolor="#D3D3D3" colspan="3">
  <h5 style="text-align:left;">Transfer From (Transferor) </h5>	</th>
     <tr><td rowspan="6" style="width:100px;" ><?php if(empty($result_details1['image'])){ echo'<img style="border-radius:200px;" width="140px" src="'.Yii::app()->baseUrl.'/upload_pic/profile-icon.png'.'"/>'; }else{ echo '<img style="border-radius:200px;" width="140px" src="'.$imges.'"/>';}?></td></tr>
    
     <tr><td>First Name.</td><td class="td1"><?php echo $result_details1['name'];?></td></tr>
     <tr><td>Father/Spouse</td><td class="td1"><?php echo $result_details1['sodowo'];?></td></tr>
      <tr><td>CNIC</td><td class="td1"><?php echo $result_details1['cnic'];?></td></tr>
      <tr><td>Address</td><td class="td1"><?php echo substr($result_details1['address'],0,40);?></td></tr>
      <tr><td>Email</td><td class="td1"><?php echo $result_details1['email'];?></td></tr>
  </table>		<?php				
      if($result_details1['mtype']=='Dealer'){ echo '<div class="black-bg" style="background-color:red;">Member Type:</div><div class="grey-bg">Dealer</div><br>';}
if($result_details3['mmtype']=='Dealer'){
echo '<div class="black-bg" style="background-color:red;">Purchased for:</div><div class="grey-bg">Plot Purchased for Resale</div><br>
';}

echo '</div>';
$memmm=$key['transferto_id'];
$connection = Yii::app()->db; 	
$sql_details  = "SELECT * FROM members where id=".$key['transferto_id']."";
$result_details = $connection->createCommand($sql_details)->queryRow();
$imgesr=Yii::app()->baseUrl.'/upload_pic/'.$result_details['image'];
?>
<div class="span6">
  		
		<table class="table">
            <th bgcolor="#D3D3D3" colspan="3">
  <h5 style="text-align:left;">Transfer To (Transferee)</h5>	</th>
      <tr><td rowspan="6" style="width:100px;" ><?php if(empty($result_details['image'])){ echo'<img style="border-radius:200px;" width="140px" src="'.Yii::app()->baseUrl.'/upload_pic/profile-icon.png'.'"/>'; }else{ echo '<img style="border-radius:200px;" width="140px" src="'.$imgesr.'"/>';}?></td></tr>
   
     <tr><td>First Name.</td><td class="td1"><?php echo $result_details['name'];?></td></tr>
     <tr><td>Father/Spouse</td><td class="td1"><?php echo $result_details['sodowo'];?></td></tr>
      <tr><td>CNIC</td><td class="td1"><?php echo $result_details['cnic'];?></td></tr>
      <tr><td>Address</td><td class="td1"><?php echo substr($result_details['address'],0,40);?></td></tr>
      <tr><td>Email</td><td class="td1"><?php echo $result_details['email'];?></td></tr>
    
  </table>	
</div><?php 
$connection = Yii::app()->db; 	
$ass  = "SELECT * FROM associates 
left join members on(associates.mid=members.id)
where associates.msid=".$key['mssid']."";
$result_res = $connection->createCommand($ass)->queryAll();
?>
<h5 style="text-align:left;">Associates Members</h5>
 <table style="float:left;" class="table table-striped table-new table-bordered">
 <tbody>
 <?php foreach($result_res as $result_ass){
	 
$imgesAss=Yii::app()->baseUrl.'/upload_pic/'.$result_ass['image'];
	 ?>
<tr><td rowspan="3"> <img width="50px" src="<?php echo $imgesAss?>"/></td></tr>
<tr><td>	Member Name :</td><td><?php echo $result_ass['name']?></td></tr>
<tr><td>    CNIC:    </td><td><?php echo $result_ass['cnic']?></td></tr>
<?php }?>
</tbody></table>
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
    <li class="active">
      <a href="#0" data-toggle="tab">Details</a>
    </li>
    <li>
      <a href="#1" data-toggle="tab">Transferer</a>
    </li>
    <li>
      <a href="#2" data-toggle="tab">Transferee</a>
    </li>
    
  </ul>
  <div class="tab-content">
    <div class="tab-pane active" id="0">
    <div class="span5">
    <table class="table"> <?php $home=Yii::app()->request->baseUrl.'/index.php' ?>
    <tr><td> <h5 style="text-align:left;"> Plot Pricing</h5></td><td><a style="float:right;" href="<?php echo $home?>/memberplot/payment_details?id=<?php echo $key['plot_id']; ?>&&pid=">Payment Details List</a></td></tr>
     <tr><td>Cost Of Plot.</td><td><?php echo number_format($result_details2['price']);  ?></td></tr>
     <tr><td>Paid</td><td><?php echo number_format($pai);?></td></tr>
      <tr><td>Balance</td><td><?php echo number_format($rem);?></td></tr>
  </table>	
    </div>
	<div class="span5">
    
     <table class="table"> <?php $home=Yii::app()->request->baseUrl.'/index.php' ?>
    <tr><td colspan="2"><h5 style="text-align:left;">Request Details:</h5></td></tr>
    <tr><td>Request Date:</td><td><?php echo $new_date  ?></td></tr>
     <tr><td>User Name:</td><td><?php echo $key['firstname'];  ?></td></tr>
     <tr><td>Email.:</td><td><?php echo $key['email'] ;?></td></tr> 
  </table>	

    </div>
      <div>
    <table class="table"> <?php $home=Yii::app()->request->baseUrl.'/index.php' ?>
    <tr><td colspan="2"><h5 style="text-align:left;">Admin Status:</h5></td></tr>
     <tr><td style="width:10%;">Comment:</td><td><?php echo $key['cmnt'];  ?></td></tr>
     <tr><td>Status:</td><td><?php  echo $key['status'];?></td></tr>
     
  </table>	
    </div>
	 
    </div>
    <div class="tab-pane" id="1">
      <p>
      <h5>Installment Details</h5>
       <?php
		$connection = Yii::app()->db;
		$land  = "SELECT * FROM installpayment where plot_id='".$ppid."' and paidamount!='' and mem_id!='".$memmm."' ";
		$land_cost = $connection->createCommand($land)->queryAll();
		$sql_payment  = "SELECT * FROM plotpayment where plot_id='".$ppid."' and paidamount!='' and mem_id!='".$memmm."' ";
		$result_payments = $connection->createCommand($sql_payment)->queryAll();
echo '<table  class="table table-striped table-new table-bordered">
    <thead style="background:#666; border-color:#ccc; color:#fff; ">
      <tr>
        <th><b>Description</b></th>
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
     <td rowspan="'.$co1.'">'.$pay['due_date'].'</td>
     <td>'.$pay['paid_date'].'</td>
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

   <td>'.$pay1['paid_date'].'</td>
     <td style="text-align:right">'.$pay1['paidamount'].'</td>
     <td>'.$pay1['payment_type'].'</td>
     <td>'.$pay1['detail'].'</td>
		 	 
     <td>';if($pay1['fstatus']=='approved'){ echo'<b style="color:Green;">Verified</b>';} else{ echo '<input type="submit" name="sub" id="'.$pay1['id'].'" onclick="myfunction1('.$pay1['id'].')" class="btn-info button" value="Verify"></td>';}
	
	}}
	
	 }
	 echo '</tbody></table>';?>
     <h5>Fees / Charges Details</h5>
     <?php	echo ' <table class="table table-striped table-new table-bordered">

            	<thead style="background:#666; border-color:#ccc; color:#fff; ">

<tr>

        	<th><b>Description</b></th>
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
    foreach($result_payments as $row)
 
	{	
	
	
	

		$i++;
		
		
		//if($row['discount']==''){$row['discount']=0;}
		
  echo '</tr><td>'.$row['payment_type'].'</td>
     <td>'.$row['duedate'].'</td>
	 <td>'.$row['date'].'</td>
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
         	<th><b>Description</b></th>
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
     <td rowspan="'.$co1.'">'.$pay['due_date'].'</td>
     <td>'.$pay['paid_date'].'</td>
     <td rowspan="'.$co1.'" style="text-align:right">'.$pay['dueamount'].'</td>
     <td style="text-align:right">'.$pay['paidamount'].'</td>
     <td>'.$pay['payment_type'].'</td>
     <td>'.$pay['detail'].'</td>
     <td>';if($pay['fstatus']=='approved'){ echo'<b style="color:Green;">Verified</b>';} else{ echo '<input type="submit" name="sub" id="'.$pay['id'].'" onclick="myfunction1('.$pay['id'].')" class="btn-info button" value="Verify"></td>';}
	 $id='';
	$id=$pay['id'];
	 }
	 foreach($land_cost as $pay1){
	 if($pay1['ref']==$id){
	echo '<tr>

    
     <td ">'.$pay['lab']. '</td>
     <td ">'.$pay['due_date'].'</td>
     <td>'.$pay['paid_date'].'</td>
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

          	<th><b>Description</b></th>
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
	
	
	

		$i++;
		
		
		//if($row['discount']==''){$row['discount']=0;}
   echo '<tr><td>'.$pay1['payment_type'].'</td>
     <td>'.$pay1['duedate'].'</td>
	 <td>'.$pay1['date'].'</td>
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
<a href="docs?id=<?php echo $_REQUEST['id'] ?>" >Documents</a>
	<?php 
	$stat=$result_details['status'];
	$plotid=$_REQUEST['id'];
	if($stat==0){echo '<h4>Transfer to member is not active register member please update<br/><a href="'.$this->CreateAbsoluteUrl("user/update_member?id=".$key['transferto_id']."").'">Update Member</a></h4> ';}
	?>
 


  <?php 

if($stat==1){
	if($key['status']!='Approved'){echo' <div class="bot-box">
  <form action="tsubmitstatus" onsubmit="return validateForm()" enctype="multipart/form-data" method="post"  >
  <input type="hidden" value="'.$plotid.'" name="plot_id" id="plot_id" class="f-left span4 clearfix" /> 
    <div class="new-box-01">
      <label>
      <h5>Action</h5>
      </label>
      <select name="status" id="status" style="width:250px;">
        <option value="">Select Status</option>
        <option value="Approved">Approved</option>
        <option value="Rejected">Rejected</option>
      </select>
    </div>
    <div class="new-box-01">
      <label>
      <h5>Membership No:</h5>
      </label>
      <input type="text" name="plotno" value="'.$result_details3['tempms'].'" id="plotno" style="width:250px;">
	    <input type="hidden" name="pplotno" value="'.$result_details3['plotno'].'" id="pplotno" style="width:250px;">
        <input type="text" name="transferdate" value="'.$result_details3['create_date'].'" id="transferdate" style="width:250px;">
    
	</div>
    <div class="new-box-01">
      <div class="new-box-01">
      <label>
      <h5>Image:</h5>

      </label>';
       
	  
	   $timge=Yii::app()->baseUrl.'/images/imagetransfer/'.$key['image'];
	  if(!empty($key['image'])){
	  
	  echo'<a href="'.$timge.'"><img src="'.$timge.'" style="height:100px"></a>';}
	  else{
		  echo 'No Image Found';
		  }
		  
		
	  ?>
   
    <div class="new-box-01" style="float:right;">
      <label>
      <h5>Comment By Administrator</h5>
      </label>
      <textarea  class="cmnt" name="cmnt" id="cmnt" style=" float:left;" ></textarea>
      <input name="submit" value="Update Action" type="submit" class="btn-info pull-right" style="padding:5px 10px; float:left; clear:both; border:1px solid #fff;" /> </form>
    </div><?php   }}?>
  
    <div style="height:600px;

    padding: 0 0 0 32px;

    width:300px;"> <span style="color:#FF0000; display:block;" id="error-pending"></span>
     <span style="color:#FF0000;display:block;" id="error-cmnt"></span>
      <span style="color:#FF0000; display:block;" id="memerror"></span>
       <span style="color:#FF0000; display:block;" id="error-plotno"></span> 
       
  
  </div>
  <div class="clearfix"></div>
</section>
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
	listItems+= "<option value='" + val.id + "'>Membership number already exists </option>";
      
});listItems+="";

$("#memerror").html(listItems);
          }
});
}
function validateForm(){
	$("#error-pending").hide();
	$("#error-cmnt").hide();
	
	$("#error-plotno").hide();
	//	var x=document.forms["form"]["firstname"].value;
	var a = $("#status").val();
	var d = $("#cmnt").val();
	var e = $("#plotno").val();

	var counter=0;



if (a==null || a=="" )

  {

  $("#error-pending").html("Please Select Status");

  $("#error-pending").show();

  counter =1;

  }


  if (d==null || d=="")

  {

  $("#error-cmnt").html("Please Give Some Comments");

  $("#error-cmnt").show();

  counter =1;

  }
 if (e==null || e=="")

  {

  $("#error-plotno").html("Please Enter Membership No");

  $("#error-plotno").show();

  counter =1;

  }

 

  if(counter==1)

  	return false;

  

}

 <!--VALIDATION END-->
 

 </script>
<!-- Generate PDF start -->
<form id="form1" action="<?php echo Yii::app()->baseUrl; ?>/dompdf/www/pdfgenerator.php" target="_blank" method="post">

 <input type="hidden" name="paper" value="a4">
  <input type="hidden" name="orientation" value="portrait">
<textarea style="visibility:hidden;" name="html" id="html">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PDF Report</title>
<style>
	
	@page { margin: 0px; }
	
	body {
		
	
margin: 0px;
background-image: url('<?php echo Yii::app()->baseUrl; ?>/dompdf/specimen.jpg');
background-size: cover;
background-repeat:no-repeat;
height:1234px;
	}


</style>
</head>

<body>

<section class="reg-section margin-top-30">
  <?php 

$plotdetails_data = Yii::app()->session['plotdetails_array'];





            $res=array();

            foreach($plotdetails as $key){

$connection = Yii::app()->db; 	
$sql_details1  = "
SELECT m.*,c.city FROM members m
			Left JOIN tbl_city c ON c.id=m.city_id where m.id=".$key['transferfrom_id']."";
$result_details1 = $connection->createCommand($sql_details1)->queryRow();

?>
              <br>

<?php
$connection = Yii::app()->db; 	
$sql_details  = "SELECT m.*,c.city FROM members m
			Left JOIN tbl_city c ON c.id=m.city_id

 where m.id=".$key['transferto_id']."";
$result_details = $connection->createCommand($sql_details)->queryRow();
?>
<img  style="margin:220px 0 0 70px; position:absolute;"  src="<?php echo Yii::getPathOfAlias('webroot')."/upload_pic/".$result_details1['image'];  ?>" width="238px" height="217px">
<img  style="margin:220px 0 0 390px; position:absolute;"  src="<?php echo Yii::getPathOfAlias('webroot')."/upload_pic/".$result_details['image'];  ?>" width="238px" height="217px">
     <div style="margin:555px 0px 0px 140px; position:absolute; font-weight:bold;" ><?php echo $key['project_name'];?></div>
     <div style="margin:585px 0px 0px 445px; position:absolute; font-weight:bold;" ><?php echo $key['street'];?></div>
 	   <div style="margin:585px 0px 0px 140px; position:absolute; font-weight:bold;" class="grey-bg"><?php echo $key['com_res'];?></div>
     <div style="margin:615px 0px 0px 140px; position:absolute; font-weight:bold;" class="grey-bg"><?php echo $key['plot_detail_address'];?></div>
  	 <div style="margin:640px 0px 0px 140px; position:absolute; font-weight:bold;" ><?php echo $key['size'].'('.$key['plot_size'].')';?></div>
       <div style="margin:615px 0px 0px 445px; position:absolute; font-weight:bold;" class="grey-bg"><?php echo $key['sector_name'];?></div>
     <div style="margin:740px 0px 0px 140px; position:absolute; font-weight:bold;" ><?php echo $result_details1['name'];?></div>
     <div style="margin:775px 0px 0px 140px; position:absolute; font-weight:bold;"  > <?php echo $result_details1['cnic'];?></div>
     <div style="margin:740px 0px 0px 440px; position:absolute; font-weight:bold;" ><?php echo $result_details['name'];?></div>
     <div style="margin:775px 0px 0px 440px; position:absolute; font-weight:bold;" ><?php echo $result_details['cnic'];?></div>
  <?php }?>
    </section>
    </body>
</html>
</textarea>
<input style="float:left;" type="submit" name="submit" value="Generate PDF" /></form>