<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<?php 
$mem=0;
$mem=$data['mid'];
?>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.js"></script>

   
	

<div class="span12" style=" display:none;" >
<div class="shadow">
<a href="reciept_lis" class="btn" style="float:right" >Back</a>
<img alt="RDLPK" src="<?php echo Yii::app()->request->baseUrl;?>/barcode/barcode.php?text=RO-<?php $data['rid']?>&print=false"  style=" height:25px;float:right"/>
  <h3>Manage Instrument : Generate Receipts</h3>
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
  <div style="border:2px solid #999; border-radius:10px; min-height:80px; background-color:#FF9; padding:10px;" >
  
<?php 
if($data['fstatus']!=='Verified' && Yii::app()->session['user_array']['per18']==1){
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

));} ?>
<div id="error-div" class="errorMessage" style="display: none; color:#F00; font-weight:bold;"></div>
   <div class="float-left">
    <p class="reg-left-text">CNIC<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="<?php echo $data['cnic']; ?>" name="cnic" id="cnic" class="reg-login-text-field" />
      <input type="hidden" value="<?php echo $data['rid']; ?>" name="rid" id="rid" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text" >Date<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input name="fromdate" placeholder="Enter Date" type="text" style="width:120px" id="fromdatepicker" value="<?php echo $newDate = date("d-m-Y", strtotime($data['date'] )); ?>"> 
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Type<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <select name="type" id="type" name="type" style="width:190px;" >
     <option name="type" value="<?php echo $data['type'] ?>"><?php echo $data['type'] ?></option> 
        <option name="type"  value="Cash">Cash</option>
        <option name="type" value="Cheque">Cheque</option>
        <option name="type" value="Pay Order">Pay Order</option>
        <option value="Online">Online</option>
     </select>
     </p>
  </div>
  <?php 
   $connection = Yii::app()->db; 
  $sql_payment1  = "SELECT * FROM plotpayment where r_id='".$data['rid']."'";
	$result_payments1 = $connection->createCommand($sql_payment1)->queryAll();
			$totalp=0;
			$rem=0;
			$n=0;
		foreach($result_payments1 as $row){$n=$n+1;$totalp=$totalp+$row['paidamount']+$row['paidsurcharge'];}
		$sql_payment2  = "SELECT * FROM installpayment where r_id='".$data['rid']."'";
	$result_payments2 = $connection->createCommand($sql_payment2)->queryAll();
		foreach($result_payments2 as $row2){$n=$n+1;$totalp=$totalp+$row2['paidamount']+$row2['paidsurcharge'];}
   $rem=$data['amount']-$totalp;
   $lock='';
  if($rem<$data['amount']){$lock ='readonly="readonly"';}
  ?>
    
   <div class="float-left">
    <p class="reg-left-text">Ref<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
    
      <input type="text" <?php echo $lock;?> value="<?php echo $data['ref_no'] ?>" name="ref" id="ref" class="reg-login-text-field" />
    </p>
  </div>
 
  
  <div class="float-left">
    <p class="reg-left-text">Amount<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <input type="number"  value="<?php echo $data['amount'] ?>" name="amount" class="reg-login-text-field" />  
     </p>
  </div>
 
  <?php
  $style='';
   if($rem>0){$style='background-color:red;';}else{$style='background-color:green;';}
   echo '<div class="float-left">
     <p class="reg-left-text" >Remaining Amount<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input style=" font-weight:bold; text-align:right;  '.$style.' color:#fff;"  type="text" class="new-input" value="'.$rem.'" readonly="readonly" > 
    </p>
  </div>';?>
   <?php 
  $ch='';
  if($data['typed']==1){$ch='checked';}if($n==0){?>
  <div class="float-left">
     <p class="reg-left-text">
     <input type="checkbox"  class="" id="ifd" name="ifd" value="1" <?php echo $ch;?>>
     Instrument for Dealer
     </p>
  </div>
 <?php } if($data['fstatus']!=='Verified' && Yii::app()->session['user_array']['per18']==1){
   echo CHtml::ajaxSubmitButton(
                                'Update',
    array('/reciept/updatere'),
                                array(  
                'beforeSend' => 'function(){ 
                                             $("#login").attr("disabled",true);
            }',
                                        'complete' => 'function(){ 
                                             $("#user_login_form").each(function(){});
                                             $("#login").attr("disabled",false);
                                        }',
                   'success'=>'function(data){  
                                           //  var obj = jQuery.parseJSON(data); 
                                            // View login errors!
                                             if(data == 1){
												// alert("we are here");
                                         location.href = "http://rdlpk.com/index.php/user/dashboard";
                                      }
          else{
                                                $("#error-div").show();
                                                $("#error-div").html(data);$("#error-div").append("");
												return false;
                                             }
                                        }'
    ),
	
	array("id"=>"login","class" => "btn" , "style"=>"margin-top:30px; margin-left:20px;")      
                ); ?>

<?php 
$this->endWidget(); }?>
<div class="clearfix"></div>
<div style=" width:100%;">Member Name: &nbsp;<b><?php echo $data['name']; ?></b></div>

 </div>
 <br>
<div class="clearfix"></div>
<h5>Charges</h5>
<div id="error-div1" style="color:#F00; font-weight:bold;"></div>
<hr noshade="noshade" class="hr-5 ">
<table class="table table-striped table-new table-bordered">
<thead  style="color:#FFF">
<th>MS #/App #</th>
<th>Title</th>
<th>Due Date</th>
<th>Due Amount</th>
<th>Paid Amount</th>
<th>Due Surcharge</th>
<th>Paid Surcharge</th>
<th>Remarks</th>
<th>Action</th>

<th>Receipt no</th>

</thead>
<tbody>
<?php  
$sql_plot1  = "SELECT *,plotpayment.id as cid from plotpayment 
Left join memberplot on (memberplot.plot_id=plotpayment.plot_id)
where plotpayment.r_id='".$_REQUEST['id']."' ";
$result_plots1 = $connection->createCommand($sql_plot1)->queryAll();
foreach($result_plots1 as $ch){
$sql_rpt  = "Select * from rpt_print where rid='".$_REQUEST['id']."' and msid='".$ch['plot_id']."'  ";
$result_rpt = $connection->createCommand($sql_rpt)->queryRow();	
	if($ch['amount']==''){$ch['amount']=0;}
	if($ch['paidamount']==''){$ch['paidamount']=0;}
	if($ch['surcharge']==''){$ch['surcharge']=0;}
	if($ch['paidsurcharge']==''){$ch['paidsurcharge']=0;}
echo '<tr>
<td>'.$ch['plotno'].'/'.$ch['app_no'].'</td>
<td>'.$ch['payment_type'].'</td>
<td>'.$ch['duedate'].'</td>
<td style="text-align:right;">'.number_format($ch['amount']).'</td>
<td style="text-align:right;">'.number_format($ch['paidamount']).'</td>
<td style="text-align:right;">'.number_format($ch['surcharge']).'</td>
<td style="text-align:right;">'.number_format($ch['paidsurcharge']).'</td>
<td>'.$ch['remarks'].'</td>
<td>'; 
if($data['fstatus']!=='Verified' && Yii::app()->session['user_array']['per18']==1){
echo '<a href="deletechar?id='.$ch['cid'].'&&rid='.$_REQUEST['id'].'">Delete</a> ';
}
echo '</td>
<td>'.$result_rpt['r_no'].'</td>
</tr>';}
?>

</tbody>
</table>
<?php 
if($rem>0 && Yii::app()->session['user_array']['per18']==1){
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

)); ?><select style="width: 150px;" name="plots" id="plots">
<?php 
 $sql_plot  = "SELECT *,plots.id as pid from plots
Left join memberplot on (plots.id=memberplot.plot_id)
Left join projects on (projects.id=plots.project_id)
Left join streets on (streets.id=plots.street_id)
Left join sectors on (sectors.id=plots.sector)
 where memberplot.member_id='".$mem."' ";
$result_plots = $connection->createCommand($sql_plot)->queryAll();

 $sql_t  = "SELECT *,plots.id as pid from plots
Left join transferplot on (plots.id=transferplot.plot_id)
Left join memberplot on (plots.id=memberplot.plot_id)
Left join projects on (projects.id=plots.project_id)
Left join streets on (streets.id=plots.street_id)
Left join sectors on (sectors.id=plots.sector)
 where transferplot.transferto_id='".$mem."' ";
$result_t = $connection->createCommand($sql_t)->queryAll();

echo '<option value="">Select Plot</option>';
foreach($result_plots as $po){
	echo '<option value="'.$po['pid'].'">'.$po['plotno'].'/'.$po['app_no'].'</option>';
	}
	foreach($result_t as $t){
echo '<option value="'.$t['pid'].'">'.$t['plotno'].'/'.$t['app_no'].'(Transfer Request)</option>';	}
?>
</select></td>
<td>
<select style="width: 150px;" id="charge" placeholder="charge" name="charge">

</select></td>
<input type="text" style="text-align:right;width: 130px;" readonly placeholder="Due Amount"  name="due"  id="duech" />
<input type="text" style="text-align:right;width: 130px;" placeholder="Paid Amount"  name="paid" id="paidch" />
<input type="text" style="text-align:right;width: 140px;" readonly placeholder="Surcharge"  name="surchargech" id="surchargech"  />
<input type="text" style="text-align:right;width: 140px;" placeholder="Paid Surcharge"  name="paidsurchargech" id="paidsurchargech"  />
<input type="text" style="width: 120px;" placeholder="Remarks" name="remarks"  />
<input type="hidden" name="type" value="<?php echo $data['type'] ?>"  />
<input type="hidden" name="ref" value="<?php echo $data['ref_no'] ?>"  />
<input type="hidden" name="refid" value="<?php echo $data['rid'] ?>"  />
<input type="hidden" name="mem_id" value="<?php echo $data['mem_id'] ?>"  />
<input type="hidden" name="date" value="<?php echo $data['date'] ?>"  />

</td>

<td> <?php echo CHtml::ajaxSubmitButton(
                                'Save',
    array('/reciept/updatereq'),
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
                ); ?></td>

<?php $this->endWidget(); }?>

<h5>Installment </h5>
<hr noshade="noshade" class="hr-5 ">
<div id="error-div2" style="color:#F00; font-weight:bold;"></div>

<table class="table table-striped table-new table-bordered">
<thead  style="color:#FFF">
<th>MS #/App #</th>
<th>Title</th>
<th>Due Date</th>
<th>Due Amount</th>
<th>Paid Amount</th>
<th>Due Surcharge</th>
<th>Paid Surcharge</th>
<th>Remarks</th>
<th>Action</th>
<th>Receipt no</th>

</thead>
<tbody>
<?php  $connection = Yii::app()->db; 
$sql_plot2  = "SELECT *,installpayment.id as iid from installpayment 
Left join memberplot on (memberplot.plot_id=installpayment.plot_id)
where installpayment.r_id='".$_REQUEST['id']."' ";
$result_plots2 = $connection->createCommand($sql_plot2)->queryAll();

?>
<tr>

</tr>
</tbody>
</table>
<?php if($rem>0 && Yii::app()->session['user_array']['per18']==1){
 $form=$this->beginWidget('CActiveForm', array(
 'id'=>'user_login_form2',
 'enableAjaxValidation'=>false,
  'enableClientValidation'=>true,
                'method' => 'POST',
                'clientOptions'=>array(
                     'validateOnSubmit'=>true,
                     'validateOnChange'=>true,
                     'validateOnType'=>false,

  ),
)); 

$result_plots = $connection->createCommand($sql_plot)->queryAll();

?><select style="width: 150px;" name="plots1" id="plots1">
<?php 
$connection = Yii::app()->db; 
$sql_plot  = "SELECT *,plots.id as pid from plots
Left join memberplot on (plots.id=memberplot.plot_id)
Left join projects on (projects.id=plots.project_id)
Left join streets on (streets.id=plots.street_id)
Left join sectors on (sectors.id=plots.sector)
 where memberplot.member_id='".$mem."' ";
 $sql_t  = "SELECT *,plots.id as pid from plots
Left join transferplot on (plots.id=transferplot.plot_id)
Left join memberplot on (plots.id=memberplot.plot_id)
Left join projects on (projects.id=plots.project_id)
Left join streets on (streets.id=plots.street_id)
Left join sectors on (sectors.id=plots.sector)
 where transferplot.transferto_id='".$mem."' ";
$result_t = $connection->createCommand($sql_t)->queryAll();

echo '<option value="">Select Plot</option>';
foreach($result_plots as $po){
	echo '<option value="'.$po['pid'].'">'.$po['plotno'].'/'.$po['app_no'].'</option>';
}
	foreach($result_t as $t){
echo '<option value="'.$t['pid'].'">'.$t['plotno'].'/'.$t['app_no'].'(Transfer Request)</option>';	}
?>	}
?>
</select></td>
<td><select style="width: 150px;" id="install" name="install">
</select></td>
<input type="text" style="text-align:right;width: 130px;" readonly placeholder="Due Amount"  name="due" id="duein"  />
<input type="text" style="text-align:right;width: 130px;" placeholder="Paid Amount"  name="paid"  id="paidin"  />
<input type="text" style="text-align:right;width: 140px;" readonly placeholder="Surcharge"  name="surchargein" id="surchargein"  />
<input type="text" style="text-align:right;width: 140px;" placeholder="Paid Surcharge"  name="paidsurchargein"  id="paidsurchargein"  />
<input type="text" style="width: 120px;" placeholder="Remarks" name="remarks"  />
<input type="hidden" name="refid" value="<?php echo $data['id'] ?>"  />
<input type="hidden" name="mem_id" value="<?php echo $data['mem_id'] ?>"  />
<input type="hidden" name="refid" value="<?php echo $data['rid'] ?>"  />
<input type="hidden" name="type" value="<?php echo $data['type'] ?>"  />
<input type="hidden" name="ref_no" value="<?php echo $data['ref_no'] ?>"  />
<input type="hidden" name="date" value="<?php echo $data['date'] ?>"  />

<td><?php echo CHtml::ajaxSubmitButton(
                                'Save',
    array('/reciept/updatereqin'),
                                array(  
                'beforeSend' => 'function(){ 
                                             $("#login2").attr("disabled",true);
            }',
                                        'complete' => 'function(){ 
                                             $("#user_login_form2").each(function(){});
                                             $("#login2").attr("disabled",false);
                                        }',
                   'success'=>'function(data){  
                                           //  var obj = jQuery.parseJSON(data); 
                                            // View login errors!
                                             if(data == 1){
												// alert("we are here");
                                         location.href = "http://rdlpk.com/index.php/user/dashboard";
                                      }
          else{
                                                $("#error-div2").show();
                                                $("#error-div2").html(data);$("#error-div2").append("");
												return false;
                                             }
                                        }'
    ),
	
	array("id"=>"login2","class" => "btn")      
                ); ?></td>

<?php $this->endWidget(); }?>


 </div>
 </section>

<!-- section 3 -->
<!--VALIDATION START-->

<div class="clearfix"></div>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>
<style>
	@page { margin: 0px; }
td{border:none !important;
padding:0px !important;}

	.divhead{
		border:3px inset #000;
		margin:20px 0px 30px 0px;
		z-index: -1;
		min-height:380px;
	    background-image: url('<?php echo Yii::app()->baseUrl; ?>/dompdf/recbg.jpg') ;
		background-repeat:no-repeat;
		width:700px;
	}
		
	
	
	body {
		
		font-size:10;
margin: 0px;
background-size: cover;
background-repeat:no-repeat;
	}
</style>

</head>
<?php 
$connection = Yii::app()->db; 
$sql_us  = "Select *,sales_center.name as salesname from user 
left join sales_center on(user.sc_id=sales_center.id)
where user.id ='".Yii::app()->session['user_array']['id']."'";
$result_us = $connection->createCommand($sql_us)->queryRow();
$sql_plot12  = "
SELECT plot_id FROM installpayment where r_id='".$_REQUEST['id']."'
UNION DISTINCT 
SELECT plot_id FROM plotpayment where r_id='".$_REQUEST['id']."'";
$result_plots12 = $connection->createCommand($sql_plot12)->queryAll();
$page=0;
$pa=0;
$rno=0;
foreach($result_plots12 as $new){
$rno=$rno+1;
	if($page>0){
		echo '<div style="page-break-before: always;"></div>';
		}
$sql_rpt  = "Select * from rpt_print where rid='".$_REQUEST['id']."' and msid='".$new['plot_id']."'  ";
$result_rpt = $connection->createCommand($sql_rpt)->queryRow();	
$sql_member  = "Select * from members where cnic='".$data['cnic']."'";
$result_member = $connection->createCommand($sql_member)->queryRow();	
$sql_membership  = "Select * from plots
Left Join memberplot on (memberplot.plot_id=plots.id)
Left Join size_cat on (plots.size2=size_cat.id)
 where plots.id='".$result_rpt['msid']."'";
$result_membership = $connection->createCommand($sql_membership)->queryRow();	
$total=0;
$totalw='';
foreach($result_plots2 as $ch1){	

if($ch1['plot_id']==$new['plot_id']){
$total=$total+$ch1['paidamount'];}}
foreach($result_plots1 as $ch1){	
if($ch1['plot_id']==$new['plot_id']){
$total=$total+$ch1['paidamount'];
}
if($ch1['plot_id']==$new['plot_id']){}}
$othemember  = "Select * from memberplot
left join members on(memberplot.member_id=members.id)
 where memberplot.plot_id='".$new['plot_id']."'";
$othermember1 = $connection->createCommand($othemember)->queryRow();	

echo '<div class="divhead">';
echo '<div style="margin: 32px 0 0px 532px; position: absolute;"><img alt="RDLPK" src="http://'.$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl.'/barcode/barcode.php?text=RO-'.$data['rid'].$result_rpt['id'].'&print=false"  /></div>';
echo '<div style="margin: 48px 0 0px 557px;position: absolute; font-size:8px; ">'.$data['rid'].'-'.$result_rpt['id'].'</div>';
echo '<div style="margin: 68px 0 0px 62px;position: absolute;">'.date("d-m-Y", strtotime($data['rcd'] )).'</div>';
echo '<div style="margin: 66px 0 0px 557px;position: absolute; font-size:20px;"><b>'.$result_rpt['r_no'].'</b></div>';
echo '<div style="margin: 93px 0 0px 37px;position: absolute;">Received with thanks from </div>';
echo '<div style="margin: 93px 0 0px 224px;position: absolute; font-family:segoepr;">'.$result_member['name'].' '.$result_member['title'].' '.$result_member['sodowo'];
if($result_member['name']!==$othermember1['name']){echo ' on behalf of '.$othermember1['name'];}
echo '</div>';
echo '<div style="margin: 118px 0 0px 37px;position: absolute;">'.$data['type'].'</div>';
echo '<div style="margin: 118px 0 0px 132px;position: absolute; font-family:segoepr;">'.$data['ref_no'].'</div>';
echo '<div style="margin: 118px 0 0px 222px;position: absolute;">Amounting to Rs.</div>';
echo '<div style="margin: 118px 0 0px 332px;position: absolute;font-family:segoepr;">'.number_format($data['amount']).'/-</div>';
echo '<div style="margin: 118px 0 0px 437px;position: absolute;">Dated</div>';
echo '<div style="margin: 118px 0 0px 482px;position: absolute; font-family:segoepr;">'.date("d-m-Y", strtotime($data['date'] )).'</div>';
if($result_membership['plotno']==''){
	echo '<div style="margin: 140px 0 0px 37px;position: absolute;">Form #</div>';
	echo '<div style="margin: 140px 0 0px 140px;position: absolute; font-family:segoepr;">'.$result_membership['app_no'].' &nbsp;&nbsp;('.$result_membership['size'].')</div>';
	}else{
	echo '<div style="margin: 140px 0 0px 37px;position: absolute;">Membership #</div>';	
	echo '<div style="margin: 140px 0 0px 140px;position: absolute; font-family:segoepr;">'.$result_membership['plotno'].'</div>';
	}

echo '<div style="margin: 140px 0 0px 410px;position: absolute; ">Paid Amount</div>';
echo '<div style="margin: 140px 0 0px 520px;position: absolute; color:#fff; font-size:18px;"><b>Rs:'.number_format($total).'/-</b></div>';
echo '<table style=" width:665px;page-break-inside: avoid;  margin: 195px 0 0px 12px;position: absolute; font-size:12px;"><tbody>';
$no=0;

foreach($result_plots1 as $ch1){	
if($ch1['plot_id']==$new['plot_id']){
if($ch1['paidamount']==''){$ch1['paidamount']=0;}
$no=$no+1;
echo '<tr><td style=width:20px !important;">'.$no.'</td>
<td style="width:210px !important;">'.$ch1['payment_type'].'</td>
<td style="width:210px !important;"> '.$ch1['remarks'].'</td>
<td style="width:95px !important; text-align:right;">'.number_format($ch1['amount']).'</td>
<td style="width:95px !important;text-align:right;">'.number_format($ch1['paidamount']).'</td></tr>';}
}
foreach($result_plots2 as $ch1){	
if($ch1['ref'] > 0){

$sql_ref  = "Select * from installpayment where id='".$ch1['ref']."'";

$result_ref = $connection->createCommand($sql_ref)->queryRow();	

	$ch1['lab']=$result_ref['lab'];
	$ch1['due_date']=$result_ref['due_date'];
	}
if($ch1['plot_id']==$new['plot_id']){
if($ch1['paidamount']==''){$ch1['paidamount']=0;}
$no=$no+1;
echo '<tr><td style=width:20px !important;">'.$no.'</td>
<td style="width:210px !important;">'.$ch1['lab'].'</td>
<td style="width:210px !important;"> '.$ch1['remarks'].'</td>
<td style="width:95px !important; text-align:right;">'.number_format($ch1['dueamount']).'</td>
<td style="width:95px !important; text-align:right;">'.number_format($ch1['paidamount']).'</td></tr>';}
}

echo '</tbody></table>';

$totalw=word($total);
date_default_timezone_set("Asia/Karachi");
echo '<div style="margin: 320px 0 0px 1px;position: absolute; width:698px; border-top:1px solid #000;">  The Sum of Rupees:</div>';
echo '<div style="margin: 321px 0 0px 153px;position: absolute; font-family:segoepr;">'.$totalw.'</div>';
echo '<div style="margin: 322px 0 0px 625px;position: absolute; float:right;"><b>Rs.</b>'.number_format($total).'</div>';

echo '<div style="margin: 347px 0 0px 500px;position: absolute;border-top:1px solid #000; font-size:10px;"><b>Signature</b></div>';
echo '<div style="margin:362px 0 0px 10px;position: absolute; font-size:10px;"><b>[Receipt '.$rno.' of '.count($result_plots12).']</b></div>';

echo '</div>';




$page=1;
}

?>



</html>


<?php 
function word( $num = '' )
{
    $num    = ( string ) ( ( int ) $num );
   
    if( ( int ) ( $num ) && ctype_digit( $num ) )
    {
        $words  = array( );
       
        $num    = str_replace( array( ',' , ' ' ) , '' , trim( $num ) );
       
        $list1  = array('','one','two','three','four','five','six','seven',
            'eight','nine','ten','eleven','twelve','thirteen','fourteen',
            'fifteen','sixteen','seventeen','eighteen','nineteen');
       
        $list2  = array('','ten','twenty','thirty','forty','fifty','sixty',
            'seventy','eighty','ninety','hundred');
       
        $list3  = array('','thousand','million','billion','trillion',
            'quadrillion','quintillion','sextillion','septillion',
            'octillion','nonillion','decillion','undecillion',
            'duodecillion','tredecillion','quattuordecillion',
            'quindecillion','sexdecillion','septendecillion',
            'octodecillion','novemdecillion','vigintillion');
       
        $num_length = strlen( $num );
        $levels = ( int ) ( ( $num_length + 2 ) / 3 );
        $max_length = $levels * 3;
        $num    = substr( '00'.$num , -$max_length );
        $num_levels = str_split( $num , 3 );
       
        foreach( $num_levels as $num_part )
        {
            $levels--;
            $hundreds   = ( int ) ( $num_part / 100 );
            $hundreds   = ( $hundreds ? ' ' . $list1[$hundreds] . ' Hundred' . ( $hundreds == 1 ? '' : 's' ) . ' ' : '' );
            $tens       = ( int ) ( $num_part % 100 );
            $singles    = '';
           
            if( $tens < 20 )
            {
                $tens   = ( $tens ? ' ' . $list1[$tens] . ' ' : '' );
            }
            else
            {
                $tens   = ( int ) ( $tens / 10 );
                $tens   = ' ' . $list2[$tens] . ' ';
                $singles    = ( int ) ( $num_part % 10 );
                $singles    = ' ' . $list1[$singles] . ' ';
            }
            $words[]    = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_part ) ) ? ' ' . $list3[$levels] . ' ' : '' );
        }
       
        $commas = count( $words );
       
        if( $commas > 1 )
        {
            $commas = $commas - 1;
        }
       
        $words  = implode( ' ' , $words );
       
        
       
        return $words;
    }
    else if( ! ( ( int ) $num ) )
    {
        return 'Zero';
    }
    return '';}

?>
