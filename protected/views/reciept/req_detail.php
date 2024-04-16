

<style>
.black-bg {
	background:#333; color:#fff; width:21%; float:left; padding:5px 10px; margin:2px 0px;
	}
.grey-bg {
	background:#CCC; color:#000; width:69%; padding:5px 10px; float:left; margin:2px 0px; height:20px;
	}
.left-box {
	float:left;
	border:1px solid #ccc;
	padding:0 5px;
	margin:0 5px;
	}
.bot-box {
	background: none repeat scroll 0 0 #6699FF;
    border-radius: 10px;
    clear: both;
    color: #FFFFFF;
    height: 164px;
    margin: 30px auto;
    padding: 20px;
    position: relative;
    top: 30px;
    width: 55%;
	}
.new-box-01 {
    float: left;
    width: 50%;
	margin-bottom:40px;
}
</style>
<div class="shadow">
  <h3>Plot Alot Request</h3>
</div>
<!-- shadow -->

<hr noshade="noshade" class="hr-5 ">

<section class="reg-section margin-top-30">

<?php 

$plotdetails_data = Yii::app()->session['plotdetails_array'];



?>



<?php

$connection = Yii::app()->db;
            $res=array();

            foreach($plotdetails as $key){
				 $fstatus=$key['fstatus']; 
				// echo $fstatus;
$imgesr=Yii::app()->baseUrl.'/upload_pic/'.$key['image'];
            echo '

           
 



<div class="span12" style="">
 	<div class="black-bg">Project Name:</div><div class="grey-bg"><input type="text" style="height:16px;" readonly=readonly() name="project_name" id="project_name" value="'.$key['project_name'].'"></div>
<div class="black-bg">Plot category:</div><div class="grey-bg"><input type="text" readonly=readonly() style="height:16px; " name="com_res" id="com_res" value="'.$key['com_res'].'"></div>
<div class="black-bg">Property Type:</div><div class="grey-bg"><input type="text" readonly=readonly() style="height:16px; " name="com_res" id="com_res" value="'.$key['type'].'"></div>

<div class="span6 left-box">
  <h5 style="text-align:left;">Plot Details</h5> 	

  <div class="">

  	

	<div class="black-bg">Plot info:</div><div class="grey-bg"><input type="text" readonly=readonly() style="height:16px;" name="plot_detail_address" id="plot_detail_address" value="'.$key['plot_detail_address'].'"></div><br>

   <input type="hidden" value="'.$key['member_id'].'" name="member_id" id="member_id" class="f-left span4 clearfix" />

  	<div class="black-bg">Street:</div><div class="grey-bg"><input type="text" style="height:16px;" name="street" id="street" readonly=readonly() value="'.$key['street'].'"></div>

    <br>

  	<div class="black-bg">Plot Size:</div><div class="grey-bg"><input type="text" style="height:16px;" name="plot_size" readonly=readonly() id="plot_size" value="'.$key['size'].'"></div>

    <br>



    <br>

	<div class="black-bg">Price:</div><div class="grey-bg"><input type="text" style="height:16px;" name="price" readonly=readonly() id="price" value="'.$key['price'].'"></div>

    <br>

	<div class="black-bg">Allotment Date:</div><div class="grey-bg"><input type="text" style="height:16px;" readonly=readonly() name="create_date" id="create_date" value="'.$key['create_date'].'"></div>

    <br>

	<div class="black-bg">Plot Status:</div><div class="grey-bg"><input type="text" style="height:16px;" readonly=readonly() name="status" id="status" value="'.$key['status'].'"></div>

    <br>

	

    <br>

	<div class="black-bg">Diemension:</div><div class="grey-bg"><input type="text" style="height:16px;" readonly=readonly() name="size2" id="size2" value="'.$key['plot_size'].'"></div>

    <br>

	

	<div class="black-bg">No Of Installment:</div><div class="grey-bg"><input type="text" readonly=readonly() style="height:16px;" name="noi" id="noi" value='.$key['insplan'].'Months'.'></div>
<div class="black-bg">Membership No.</div><div class="grey-bg"><input type="text" readonly=readonly() style="height:16px;" name="noi" id="noi" value='.$key['plotno'].'></div>
    <br> 

	

  </div>
   <br>  	

</div>
<div class="span5 left-box">
<h5 style="text-align:left;">Member Detail</h5> 	
<div class="black-bg">Name:</div><div class="grey-bg">'.$key['name'].'</div>
<div class="black-bg">Id:</div><div class="grey-bg">'.$key['member_id'].'</div>
<div class="black-bg">CNIC:</div><div class="grey-bg">'.$key['cnic'].'</div>
<div><img src="'.$imgesr.'" width="170" height="200"/></div>
</div>';

?>
 <?php 
	$connection = Yii::app()->db; 	
$sql_details2  = "SELECT * FROM plots where id=".$key['id']."";
$result_details2 = $connection->createCommand($sql_details2)->queryRow();
$sql_details3  = "SELECT * FROM memberplot where plot_id=".$key['id']."";
$result_details3 = $connection->createCommand($sql_details3)->queryRow();
$old_date = $key['create_date'];            
$middle = strtotime($old_date);             
$new_date = date('d-m-Y', $middle); 
?>
   <div class="clearfix"></div>
    <br />
    
    
<div class="clearfix"></div>
<div class="tabbable">
  <ul class="nav nav-tabs">
    <li class="active">
      <a href="#1" data-toggle="tab">Booking & Installments</a>
    </li>
    <li>
      <a href="#2" data-toggle="tab">MS & Other Charges</a>
    </li>
    <li>
      <a href="#3" data-toggle="tab">Other Details</a>
    </li>    
  </ul>
  <div class="tab-content">
    <div class="tab-pane active" id="1">
      <p>
       <?php
		$connection = Yii::app()->db;
		$land  = "SELECT * FROM installpayment where plot_id='".$_REQUEST['id']."' and paidamount!='' ";
		$land_cost = $connection->createCommand($land)->queryAll();
		$sql_payment  = "SELECT * FROM plotpayment where plot_id='".$_REQUEST['id']."' and paidamount!='' ";
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
      </p>
    </div>
    <div class="tab-pane" id="2">
      <p>
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
<td>';if($row['fstatus']=='approved'){ echo '<b style="color:Green;">Verified</b>';}else{ echo'<input type="submit" name="sub" id="'.$row['id'].'" onclick="myfunction('.$row['id'].')" class="btn" value="Verify"></td></tr>	';} 
  


//$bsur=$bsur+$bsur;
}
echo '</tbody></table>';?>
      </p>
    </div>
    <div class="tab-pane" id="3">
      <p>
      <div class="span5 left-box">
    <h5 style="text-align:left;">Price/Installments:</h5>
    <div class="black-bg">Cost Of Plot:</div><div class="grey-bg"><?php echo $result_details2['price'];  ?></div><br>
     <div class="black-bg">Discount:</div><div class="grey-bg"><?php //  echo $result_dets1['discount'] ?></div><br>
      <div class="black-bg">Details:</div><div class="grey-bg"><?php // echo $result_dets1['details'] ?></div><br>
    </div>
	<div class="span5 left-box">
    <h5 style="text-align:left;">Request Details:</h5>
    <div class="black-bg">Request Date:</div><div class="grey-bg"><?php  echo $new_date  ?></div><br>
    <div class="black-bg">User Name:</div><div class="grey-bg"><?php echo $key['firstname']  ?></div><br>
    <div class="black-bg"> Email:</div><div class="grey-bg"><?php echo $key['email']?></div><br>
    </div>
    <div class="span5 left-box">
    <h5 style="text-align:left;">Admin Status:</h5>
    <div class="black-bg">Comment:</div><div class="grey-bg"><?php echo $result_details3['comment']  ?></div><br>
    <div class="black-bg"> Status:</div><div class="grey-bg"><?php echo $result_details3['status']?></div><br>
    </div> 
    <div class="span5 left-box">
  <h5 style="text-align:left;">Payment Details Link:</h5>
    <div class="black-bg">Link:</div><div class="grey-bg">
    <a href="payment_details?id=<?php echo $key['plot_id'] ?>&pid=<?php echo $key['project_id'] ?>">Payment Detail Link</a></div><br>
   
    </div> 
      </p>
    </div>
  </div>
</div>
<div class="clearfix"></div>

<?php if($result_details3['status']!='Approved'){?>
  <form action="Submitstatus" method="post" enctype="multipart/form-data" onsubmit="return validateForm()" >

    <input type="hidden" value=<?php echo $key['id']?> name="plot_id" id="plot_id" class="f-left span4 clearfix" />
<div style="width:660px;" margin-top:52px; class="span6">  
<div class="bot-box" style="width:600px;">
    <div class="new-box-01">
	<label><h5>Action</h5></label>
   <select name="statusapp" id="statusapp" style="width:250px;">
   <?php if($fstatus==""){ echo '<option value="">New Request</option>';}
		else{ echo'<option value='.$fstatus.'>'.$fstatus.'</option>';}
		?>
        <option value="approved">Approved</option>
         <option value="Rejected">Rejected</option>
          <option value="Pending">Pending</option>
 </select>
  	</div>
    <div class="new-box-01">
    <label><h5>Comment By Administrator</h5></label>
  	<textarea  class="cmnt" name="cmnt" id="cmnt" style="float: left; width: 238px; height: 86px;"><?php echo $key['fcomment']?></textarea>
  	<input name="submit" type="submit" value="Send Allotment Request " class="btn-info pull-right" style="padding:5px 10px; float:left; clear:both; border:1px solid #fff;" />
    </div>
    <div style="height: 600px;
    padding: 0 0 0 32px;
    width: 300px;">
  <span style="color:#FF0000; display:block;" id="error-statusapp"></span>
  <span style="color:#FF0000;display:block;" id="error-cmnt"></span>
</div>

 </form><?php }} ?>



 </div>
 <div class="clearfix"></div>






 

 </section>

<!-- section 3 --> 

 <div class="clearfix"></div>
 <script>
 var id =document.getElementById(id);
function myfunction1(id)
{
$.ajax({
     type: "POST",
      url:    "ajaxRequest4?val1="+id,
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



 function validateForm(){
	$("#error-statusapp").hide();
	$("#error-cmnt").hide();
	
	//	var x=document.forms["form"]["firstname"].value;
	var a = $("#statusapp").val();
	var d = $("#cmnt").val();
	
	var counter=0;




  if (d==null || d=="")

  {

  $("#error-cmnt").html("Please Give Some Comments");

  $("#error-cmnt").show();

  counter =1;

  }
  if (a==null || a=="")

  {

  $("#error-statusapp").html("Select Approved Or Rejected");

  $("#error-statusapp").show();

  counter =1;

  }
 

  if(counter==1)

  	return false;

  

}

 
 </script>