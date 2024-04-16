<div class="shadow">
  <h3>Transfer Request Details</h3>
</div>
<section class="reg-section margin-top-30" style="font-size:12px;">
  <?php	            $res=array();
             $key=$plotdetails;
$connection = Yii::app()->db;
$fstatus=$key['fstatus'];
 	$comment=$key['comment'];
$sql_details1  = "SELECT * FROM members where id=".$key['transferfrom_id']."";
$result_details1 = $connection->createCommand($sql_details1)->queryRow();
$imges=Yii::app()->baseUrl.'/upload_pic/'.$result_details1['image'];?>
<div class="span12" style="">
<div class="span6 left-box">
  <h5 style="text-align:left;">Transfer From (Transferor) </h5>
 <table class="table table-striped table-new table-bordered">
 <tbody>
<tr><td rowspan="7"> <img width="150px" src="<?php echo $imges?>"/></td></tr>
      <input type="hidden" value="" name="transfer_from_memberid" id="member_id" class="reg-login-text-field" />
<tr><td>    MS #:</td><td><?php echo $plotdetails['plotno']?></td></tr>
<tr><td>	Saller Name :</td><td><?php echo $result_details1['name']?></td></tr>
<tr><td>    SODOWO:    </td><td><?php echo $result_details1['sodowo']?></td></tr>
<tr><td>    CNIC:    </td><td><?php echo $result_details1['cnic']?></td></tr>
<tr><td>    Address:</td><td><?php echo substr($result_details1['address'],0,40)?></td></tr>
<tr><td>    Email:</td><td><?php $result_details1['email']?></td></tr>
</tbody></table>
<?php 
$connection = Yii::app()->db; 	
$ass  = "SELECT * FROM associates 
left join members on(associates.mid=members.id)
where associates.msid=".$plotdetails['mssid']."";
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
$sql_details  = "SELECT * FROM members where id=".$key['transferto_id']."";
$result_details = $connection->createCommand($sql_details)->queryRow();
$imgesr=Yii::app()->baseUrl.'/upload_pic/'.$result_details['image'];
?>
<div class="span6 left-box">

  <h5 style="text-align:left;">Transfer To (Transferee)</h5>
<table class="table table-striped table-new table-bordered">
 <tbody>
<tr><td rowspan="7"><img width="150px" src="<?php echo $imgesr?>"/></td></tr>
<tr><td>	MS #:</td><td><?php echo $plotdetails['tempms']?></td></tr>
<tr><td>	Purchaser Name :</td><td><?php echo $result_details['name']?></td></tr>
<tr><td>    SODOWO:    </td><td><?php echo $result_details['sodowo']?></td></tr>
<tr><td>    CNIC:    </td><td><?php echo $result_details['cnic']?></td></tr>
<tr><td>    Address:</td><td><?php echo substr($result_details['address'],0,40)?></td></tr>
<tr><td>    Email:</td><td><?php echo $result_details['email']?></td></tr>
</tbody></table>
	</div>
    
</div>
<div class="span12">
<div class="span6">
  <h5 style="text-align:left;">Plot Details</h5> 
   <table class="table table-striped table-new table-bordered">
 <tbody>	
<tr><td>	File/Plot No.</td><td><?php echo $key['plot_detail_address']?></td></tr>
<input type="hidden" value="" name="plot_id" id="plot_id" class="f-left span4 clearfix" />
<tr><td>  	File/Plot Address:</td><td><?php echo $key['street']?>,<?php echo $key['sector_name']?></td></tr>
<tr><td>  	Plot Size:</td><td><?php echo $key['size']?>(<?php echo $key['plot_size']?>)</td></tr>
<tr><td>  	Project Name:</td><td><?php echo $key['project_name']?></td></tr>
</tbody></table>
    <?php
	$memmm=$key['transferto_id'];
$memmm1=$key['transferfrom_id'];	
	$ppid=	$key['plot_id'];
	$connection = Yii::app()->db; 	
$sql_details2  = "SELECT * FROM plots where id=".$key['plot_id']."";
$result_details2 = $connection->createCommand($sql_details2)->queryRow();

$sql_install  = "SELECT * FROM installpayment where plot_id=".$key['plot_id']."  and fstatus !='Cancelled'";
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
    
    <?php $home=Yii::app()->request->baseUrl.'/index.php'; ?>
    <h5 style="text-align:left;">Price/Installments: <a style="float:right;" href="<?php echo $home?>/memberplot/payment_details?id=<?php echo $key['plot_id']; ?>&&pid=">Payment Details List</a><br></h5>
   <table class="table table-striped table-new table-bordered">
 <tbody>	
<tr><td>    Cost Of Plot:</td><td><?php echo number_format($result_details2['price']);  ?></td></tr>
<tr><td>     Paid:</td><td><?php echo number_format($pai);  ?></td></tr>
<tr><td>      Balance:</td><td><?php echo number_format($rem);?></td></tr>
</tbody></table>

    <h5 style="text-align:left;">Request Details:</h5>
   <table class="table table-striped table-new table-bordered">
 <tbody>	
<tr><td>    Request Date:</td><td><?php echo $new_date  ?></td></tr>
<tr><td>    User Name:</td><td><?php echo $key['firstname']?> <?php $key['middelname']?> <?php $key['lastname'] ?></td></tr>
<tr><td>    Sales Center:</td><td><?php echo $key['ssname'] ?></td></tr>
</tbody></table>
    <h5 style="text-align:left;">Admin Status:</h5>
   <table class="table table-striped table-new table-bordered">
 <tbody>	
<tr><td>    Comment:</td><td><?php echo $key['cmnt']  ?></td></tr>
<tr><td>     Status:</td><td><?php echo $key['status']?></td></tr>
</tbody></table>
    </div>
    <div class="span6 left-box">

  <h5 style="text-align:left;">Action History</h5>
<table class="table table-striped table-new table-bordered">
 <tbody><?php $old = $plotdetails['create_date'];            
$mid = strtotime($old);             
$new = date('d-m-y', $mid); ?>

<tr><td>	Transfer Request Date</td><td><strong><?php echo $new; ?></strong></</td></tr>
<tr><td>	 Status :</td><td><strong><?php echo $plotdetails['sc_status']?></strong></td></tr>
<tr><td>    Sales Center Comments:    </td><td><?php echo $plotdetails['sc_comment']?></td></tr>
<tr><td>    Sales Center User:    </td><td><strong><?php echo $plotdetails['firstname']?></strong></td></tr>
</tbody></table>
	</div>
	<div class="span6 left-box" style="
    background-color: #4cd6d4;
    padding: 20px;
    border: 1px solid #000;
    border-radius: 25px;
">
  
    
    <h4>Update Payments (Purchaser)</h4>
  <a class="btn" href="plotchargest?id=<?php echo $key['plot_id']?>&pid=<?php $key['project_id']?>&m=<?php echo $result_details['id'] ?>">Add Charges </a>
	
<?php	if(Yii::app()->session['user_array']['per2']=='1')
			{ 
  ?>
  <span style="float:right"> <a class="btn"  onclick="return confirm('Are you sure you want to delete this ?');" href="canceltransfer?plot_id=<?php echo $key['plot_id']?>&mem_transto=<?php echo $result_details['id'];?>&mem_transfrom=<?php echo $result_details1['id'];?> ">Cancel Request </a></span>
  <?php }?>
	<?php 
	$stat=$result_details['status'];
	$plotid=$_REQUEST['id'];
	if($stat==0){echo '<h4>Transfer to member is not active register member please update<br/><a href="'.$this->CreateAbsoluteUrl("user/update_member?id=".$key['transferto_id']."").'">Update Member</a></h4> ';}
	?>
  <h4>Documentation</h4>
  <a class="btn" href="doc?id=<?php echo $key['tpid'] ?>">Upload Documents</a>

<?php
 if($plotdetails['com_res']=='Commercial'){$type='C'; }else{$type='R';}
  $path="/images/imagetransfer/";
 
$address= 'http://'.$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl;;
?>
  <h4>Upload Transfer Photo </h4>

<form action="timage"  enctype="multipart/form-data" method="post"  >
										<input type="hidden" name="plot_id" value="<?php echo $key['plot_id']?>" />
                                        <input type="hidden" value="<?php echo $_REQUEST['id'] ?>" name="reqid" id="reqid"/>
										<input type="file" name="image" class="btn">
										<input type="submit" name="upload" value="Upload" class="btn">
										</form>
                                        <a href="<?php echo $address.$path.$key['image']?>"><img src="<?php echo $address.$path.$key['image']?>" height="100px" width="100" /></a> 
	

    <?php 
	if(Yii::app()->session['user_array']['per20']==1 && $plotdetails['tpsts']=='Sales'){
	$form=$this->beginWidget('CActiveForm', array(
 'id'=>'user_login_form',
 'enableAjaxValidation'=>false,
  'enableClientValidation'=>true,
                'method' => 'POST',
                'clientOptions'=>array(
                     'validateOnSubmit'=>true,
                     'validateOnChange'=>true,
                     'validateOnType'=>false,
  ),
)); ?>
<div id="error-div" class="errorMessage" style="display: none; color:#F00; font-weight:bold;"></div>

     <input type="hidden" value="<?php echo $plotdetails['achid'] ?>" name="achid" id="achid"/>
    <input type="hidden" name="ploid"  value="<?php echo $key['plot_id'];?>" />
	
    <input type="hidden" name="pid"  value="<?php echo $_REQUEST['id'];?>" />
    <label>MS #</label>
    <input type="hidden" value="<?php echo $plotdetails['code'] ?>" name="procode" id="procode" class="reg-login-text-field" style="width:60px;"  readonly/>
	<input type="text" value="<?php echo $plotdetails['plotno'];?>" name="tempms" id="tempms" class="reg-login-text-field" style="width:140px;" />
  <input type="hidden" value="<?php echo $plotdetails['app_no'];?>" name="app_no" id="tempms" class="reg-login-text-field" style="width:140px;" />
    <input type="hidden" value="<?php echo $type.$plotdetails['scode']; ?>" name="sizecode" id="sizecode" class="reg-login-text-field" style="width:60px;" readonly/>
        <input type="text" style="width:250px;" name="admin_comment" id="admin_comment	" placeholder="Enter Comments" />

     <?php echo CHtml::ajaxSubmitButton('Submit For Approvel',array('Submitt'), array( 'beforeSend' => 'function(){ 
                                             $("#login").attr("disabled",true);
       										     }',
                                        'complete' => 'function(){ 
                                             $("#user_login_form").each(function(){});
                                             $("#login").attr("disabled",false);
                                        }',
					                   'success'=>'function(data){  
                                             if(data == 1){
                                         location.href = "http://rdlpk.com/index.php/user/dashboard";
                                      }
          									else{
                                                $("#error-div").show();
                                                $("#error-div").html(data);$("#error-div").append("");
												return false;
                                             }}'     ),
                         array("id"=>"login","class" => "btn")      
                ); ?>
<?php $this->endWidget(); }
?>
   
  
    </div>
    </div>
    <?php if($key['status']!=='Approved'){?>
    <a href="#" class="btn" style="float:right;" >Cancel(Remove) Request</a><?php //}?>
    <?php }?>
    <div style="height: 600px;

    padding: 0 0 0 32px;

    width: 300px;"> <span style="color:#FF0000; display:block;" id="error-pending"></span> <span style="color:#FF0000;display:block;" id="error-cmnt"></span> <span style="color:#FF0000; display:block;" id="memerror"></span> <span style="color:#FF0000; display:block;" id="plotno"></span> <span style="color:#FF0000; display:block;" id="image"></span> </div>
 
 
  </div>
  <div class="clearfix"></div>
</section>
<div class="tabbable">
  <ul class="nav nav-tabs">
    
    <li>
      <a href="#1" data-toggle="tab">Seller (Payments)</a>
    </li>
    <li>
      <a href="#2" data-toggle="tab">Purchaser (Payments)</a>
    </li>
    
  </ul>
  <div class="tab-content">
    
    <div class="tab-pane" id="1">
      <p>
      <h5>Installment Details</h5>
       <?php
		$connection = Yii::app()->db;
		$land  = "SELECT * FROM installpayment where plot_id='".$ppid."' and paidamount!='' and mem_id!='".$memmm."' and fstatus !='Cancelled' ";
		$land_cost = $connection->createCommand($land)->queryAll();
	//	$sql_payment  = "SELECT * FROM plotpayment where plot_id='".$ppid."' and paidamount!='' and mem_id='".$memmm1."' or pobm>0 or payment_type NOT IN ('MS Fee','Transfer Fee'))";
		$sql_payment="Select * from plotpayment where plot_id='".$ppid."' and (mem_id='".$memmm1."' or pobm>0 or payment_type NOT IN ('MS Fee','Transfer Fee'))  and fstatus !='Cancelled'";
		
		
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
    
     <td>';if($pay['fstatus']=='approved'){ echo'<b style="color:Green;">Verified</b>';} else{ echo '</td></tr>';}
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
		 	 
     <td>';if($pay1['fstatus']=='approved'){ echo'<b style="color:Green;">Verified</b>';} else{ echo '</td></tr>';}
	
	}}
	//echo 123;exit;
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
<td>';if($row['fstatus']=='approved'){ echo '<b style="color:Green;">Verified</b>';}else{ echo'</td></tr>	';} 
  


//$bsur=$bsur+$bsur;
}
echo '</tbody></table>';?>
      </p>
    </div>
    <div class="tab-pane" id="2">
      <p><h5>Installment Details</h5>
        <?php
		$connection = Yii::app()->db;
		$land  = "SELECT * FROM installpayment where plot_id='".$ppid."'  and mem_id='".$memmm."' ";
		$land_cost = $connection->createCommand($land)->queryAll();
		$sql_charges  = "SELECT * FROM plotpayment where plot_id='".$ppid."'   and mem_id='".$memmm."'";
		$result_charges = $connection->createCommand($sql_charges)->queryAll();
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
     <td>';if($pay['fstatus']=='approved'){ echo'<b style="color:Green;">Verified</b>';} else{ echo '</td>';}
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
     <td>';if($pay1['fstatus']=='approved'){ echo'<b style="color:Green;">Verified</b>';} else{ echo '</td>';}
	
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
    foreach($result_charges as $pay2)
 
	{	
	
	
	

		$i++;
		
		
		//if($row['discount']==''){$row['discount']=0;}
   echo '<tr><td>'.$pay2['payment_type'].'</td>
     <td>'.$pay2['due_date_temp'].'</td>
	 <td>'.$pay2['paid_date_temp'].'</td>
     <td style="text-align:right">'.$pay2['amount'].'</td>
     <td>'.$pay2['paidamount'].'</td>
     <td>'.$pay2['paidas'].'</td>
     <td align="right">'.$pay2['detail'].'</td>
<td>';if($pay2['fstatus']=='approved'){ echo '<b style="color:Green;">Verified</b>';}else{ echo '</td></tr>	';} 
  


//$bsur=$bsur+$bsur;
}
echo '</tbody></table>';?>
      </p>
    </div>
  
  </div>
</div>
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