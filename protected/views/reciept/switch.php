<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.js"></script>
<script>
$(function() {

$( "#fromdatepicker" ).datepicker({ dateFormat: 'dd-mm-yy' });

});

$(function() {

$( "#todatepicker" ).datepicker({ dateFormat: 'dd-mm-yy' });

});
</script>   
<?php 
$mem=0;
$mem=$data['mid'];
?>

<style>
.reg-login-text-field {
    width: 150px !important;
}

.float-left {
    float: left;
    margin: 0 1px;
}
</style>


<div class="shadow">
  <h3>Switch User to Represent bounced instruments</h3>
  <span><a style="float:right;" href="bouncerec_list" class="btn">Back to list</a></span>
<?php 
if($data['typed']==1){echo '<div  style="float:right;color:red;">Dealer Instrument</div>';}
?>

</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5 ">
<section class="reg-section margin-top-30">
<div style="
    padding: 0 0 0 32px;
    width: 300px;">
  <span style="color:#FF0000; display:block;" id="error-name"></span>
  <span style="color:#FF0000; display:block;" id="error-logo"></span>
  <span style="color:#FF0000; display:block;" id="error-remarks"></span>
  <span style="color:#FF0000;display:block;" id="error-abbreviation"></span>
  <span style="color:#FF0000;display:block;" id="error-proprietor"></span>   
  </div>
<style>.float-left {float: none !important;}.reg-left-text {float: left;font-weight: 800;width: 104px;}</style>
<div class="span12">
<div class="span5">
 <div class="float-left">
    <p class="reg-left-text"> Name:</p><p><?php echo $data['mname'] ?></p>
    </div>
 
 <div class="float-left">
    <p class="reg-left-text"> CNIC:</p><p><?php echo $data['cnic'] ?></p>
    </div>
  <div class="float-left">
    <p class="reg-left-text">Type:</p><p><?php echo $data['type'] ?></p>
  </div>
    <div class="float-left">
    <p class="reg-left-text">Amount:</p><p><?php echo number_format($data['amount']) ?></p>
  </div>
   <div class="float-left">
    <p class="reg-left-text">Ref:</p><p><?php echo $data['ref_no'] ?></p>
  </div>
  <div class="float-left">
    <p class="reg-left-text" >Date:</p><p><?php echo $newDate = date("d-m-Y", strtotime($data['date'] )); ?></p>
  </div>
  <div class="float-left">
    <p class="reg-left-text" >Status:</p><p style="color:red"><strong><?php echo $data['receipt_status']; ?></strong></p>
  </div>
   <div class="float-left">
    <p class="reg-left-text" >Comments:</p><p style="color:red"><strong><?php echo $data['comm']; ?></strong></p>
  </div>
  
  <?php $connection = Yii::app()->db; 
  $sql_payment1  = "SELECT * FROM plotpayment where r_id='".$data['rid']."'";
	$result_payments1 = $connection->createCommand($sql_payment1)->queryAll();
			$totalp=0;
			$rem=0;
			
		foreach($result_payments1 as $row){
			
			$totalp=$totalp+$row['paidamount']+$row['paidsurcharge'];}
		$sql_payment2  = "SELECT * FROM installpayment where r_id='".$data['rid']."'";
	$result_payments2 = $connection->createCommand($sql_payment2)->queryAll();
		foreach($result_payments2 as $row2){$totalp=$totalp+$row2['paidamount']+$row2['paidsurcharge'];}
   $rem=$data['amount']-$totalp;
   $style='';
    ?>
</div>
<div class="span5">
<div  style="background-color:#CCC; padding:5px; border:1px solid #666; border-radius:5px;">
 
 <h5>Instrument Info</h5>
  <?php 
  $rpt  = "Select receipt.*,cu.firstname as cuf,cu.middelname as cum,cu.lastname as cul,fu.firstname as fuf,fu.middelname as fum,fu.lastname as ful,au.firstname as auf,au.middelname as aum,au.lastname as aul from receipt
  Left join user cu on(receipt.user=cu.id)
  Left join user fu on(receipt.f_uid=fu.id)
  Left join user au on(receipt.app_by=au.id)
  where receipt.id='".$_REQUEST['rid']."'";
	$rpts = $connection->createCommand($rpt)->queryRow();	
  ?>
  Created By: <?php echo $rpts['cuf'].' '.$rpts['cum'].' '.$rpts['cul']?><br />
  Create Date:<?php echo $rpts['create_date'];?><br />
  Type:		  <?php ?><br />
  Submited By:<?php echo $rpts['fuf'].' '.$rpts['fum'].' '.$rpts['ful']?><br />
  Submit Date:<?php echo $rpts['sub_date']?><br />
  Approved By:<?php echo $rpts['auf'].' '.$rpts['aum'].' '.$rpts['aul']?><br />
  Approve Date:<?php echo $rpts['app_date']?><br />
  Remarkes:<?php echo $rpts['comm']?>

  </div>
</div>
</div>
<br/>
<div class="clearfix"></div>
<div class="span5">
<?php 
if($rem==0 && $data['fstatus']!=='Verified'){
$form=$this->beginWidget('CActiveForm', array(
 'id'=>'user_login_form1',
 'enableAjaxValidation'=>false,
  'enableClientValidation'=>true,
                'method' => 'POST',
                'clientOptions'=>array(
                     'validateOnSubmit'=>true,
                     'validateOnChange'=>true,
                     'validateOnType'=>false,

  ),

)); }?>

<div id="error-div1" style="color:#F00; font-weight:bold;"></div>
<input name="rid" id="rid" value=" <?php echo $_REQUEST['rid'];?>" type="hidden" />
<?php 
$connection = Yii::app()->db; 
$sql_plot12  = "
SELECT bank.name, rpt_print.* from rpt_print 
Left join bank on(bank.id=rpt_print.bank_details)
where rpt_print.rid='".$_REQUEST['rid']."'";
$result_plots12 = $connection->createCommand($sql_plot12)->queryAll();
?>
<style> td{ padding:0px;} input{ margin-bottom:0px !important;} select{ margin-bottom:0px;}</style>
<table>
<thead style="color:#FFF;">
<th>Receipt No</th>
<th>User Name</th>

</thead>
<tbody>
<?php
$temp_projects_array = Yii::app()->session['projects_array'];
$pro='';
foreach($temp_projects_array as $ro){
$pro='0,';
$pro=$ro['project_id'];
}

foreach($result_plots12 as $row){
	?>
    <tr>
<td><input type="text"  value="<?php echo $row['r_no']?>" />

	<?php }?>
<td> <select  name="userid" id="userid" style="width:300px;">
<option value="">Select User</option>
<?php 
//print_r(Yii::app()->session['user_array']);

  $sql = "SELECT * FROM user where per18 ='1'  AND status=1 and sc_id='".Yii::app()->session['user_array']['sc_id']."'";
			$result_data = $connection->createCommand($sql)->queryAll();

foreach($result_data as $user){
    
	echo '<option value="'.$user['id'].'">'.$user['firstname'].'&nbsp'.$user['middelname'].'&nbsp'.$user['lastname'].'</option>';

}
?>
</select></td> </tr>  
    
	
</tbody>
</table><br />

<span style="float:right;">
<?php echo CHtml::ajaxSubmitButton(
                                'Switch User',
    array('/reciept/switchuser'),
                                array(  
                'beforeSend' => 'function(){ 
                                             $("#login1").attr("disabled",true);
            }',
                                        'complete' => 'function(){ 
                                             $("#user_login_form1").each(function(){});
                                             $("#login1").attr("disabled",false);
                                        }',
                   'success'=>'function(data){  
                                           //  var obj = jQuery.parseJSON(data); 
                                            // View login errors!
                                             if(data == 1){
												// alert("we are here");
                                         location.href = "http://rdlpk.com/index.php/user/dashboard";
                                      }
          else{
                                                $("#error-div1").show();
                                                $("#error-div1").html(data);$("#error-div1").append("");
												return false;
                                             }
                                        }'
    ),
	
	array("id"=>"login1","class" => "btn")      
                ); ?>

<?php $this->endWidget();?>
</span>

  </div>
  
  
 
 </div>
 </section>
<!-- section 3 -->
<!--VALIDATION START-->



