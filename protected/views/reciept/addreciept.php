<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<?php 
$mem=0;
$mem=$data['mid'];
?>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.js"></script>

<style>
.reg-login-text-field {
    width: 150px !important;
}

.float-left {
    float: left;
    margin: 0 1px;
}
form {
    margin: 0 0 0px !important;
}
h5{ margin:0px !important;}
hr{ margin:0px !important;} 
</style>

<script>

$(function() {

$( "#fromdatepicker" ).datepicker({ dateFormat: 'dd-mm-yy' });

});

$(function() {

$( "#todatepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });

});

</script><div class="span12" >
<div class="shadow">

<img alt="RDLPK" src="http://localhost/rdlpklive/barcode/barcode.php?text=RO-<?php $_REQUEST['id']?>&print=false"  style=" height:25px;float:right"/>

  <h3>Manage Funds : Generate Transmittal Slips</h3>
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
  <?php 
   $connection = Yii::app()->db; 
   
  $sql_paymentm  = "SELECT * FROM rpt_print where mem_id='".$_REQUEST['mid']."'";
  $result_paymentsm = $connection->createCommand($sql_paymentm)->queryAll();
  $re='';$n=0;$c='';
  foreach($result_paymentsm as $rec){
	  if($n==1){$c=',';}
	  $re .=$c.$rec['id']; $n++;}
	  if($re==''){$re='0.2,0.1';}
  $sql_payment1  = "SELECT * FROM plotpayment where re_id in (".$re.")";
  $result_payments1 = $connection->createCommand($sql_payment1)->queryAll();
			$totalp=0;
			$totalam=0;
			$rem=0;
	foreach($result_payments1 as $row){$totalp=$totalp+$row['paidamount']+$row['paidsurcharge'];}
	$sql_payment2  = "SELECT * FROM installpayment where re_id in (".$re.")";
	$result_payments2 = $connection->createCommand($sql_payment2)->queryAll();
	foreach($result_payments2 as $row2){$totalp=$totalp+$row2['paidamount']+$row2['paidsurcharge'];}
	$sql_rp  = "SELECT * FROM receipt where mem_id='".$_REQUEST['mid']."'";
	$result_rp = $connection->createCommand($sql_rp)->queryAll();
	foreach($result_rp as $row3){$totalam=$totalam+$row3['amount'];}
   $rem=$totalam-$totalp; $lock='';
  if($rem<$data['amount']){$lock ='readonly="readonly"';}
  ?>
  
  <div class="span12">
  <div class="span3">
  <p>Name</br>
  <p>CNIC</br>
  <p>Account #</br>
  
  </div>
  <div class="span2">
  <p><b><?php echo $data['name']?></b></br>
  <p><b><?php echo $data['cnic']?></b></br>
  <p><b><?php echo $data['acc_no'];?></b></br>
</div>
    <div class="span3">
  <p>Total Amount in Account</br>
    <p>Total Paid :</br>
      <p>Total Remaining</p></br>
  </div>
  <div class="span2">
  <p style="text-align:right;"><b><?php echo number_format($totalam)?></b>/-</br>
    <p style="text-align:right;"><b><?php echo number_format($totalp)?></b>/-</br>
      <p style="text-align:right;"><b><?php echo number_format($rem)?></b>/-</p></br>
  </div>
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


</thead>
<tbody>
<?php  
$sql_rpt  = "Select * from rpt_print where id='".$_REQUEST['id']."'";
$result_rpt = $connection->createCommand($sql_rpt)->queryRow();	
$sql_plot1  = "SELECT *,plotpayment.id as cid from plotpayment 
Left join memberplot on (memberplot.plot_id=plotpayment.plot_id)
where plotpayment.re_id='".$_REQUEST['id']."' ";
$result_plots1 = $connection->createCommand($sql_plot1)->queryAll();
foreach($result_plots1 as $ch){

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
echo '<a href="deletechard?id='.$ch['cid'].'&&rid='.$_REQUEST['id'].'&&mid='.$data['mid'].'">Delete</a> ';
}
echo '</td>
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
 where plots.id='".$result_rpt['msid']."' ";
$result_plots = $connection->createCommand($sql_plot)->queryAll();

 $sql_t  = "SELECT *,plots.id as pid from plots
Left join transferplot on (plots.id=transferplot.plot_id)
Left join memberplot on (plots.id=memberplot.plot_id)
Left join projects on (projects.id=plots.project_id)
Left join streets on (streets.id=plots.street_id)
Left join sectors on (sectors.id=plots.sector)
 where transferplot.plot_id='".$result_rpt['msid']."' ";
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
<input type="text" readonly="readonly" placeholder="Due Amount" style="text-align:right;width: 130px;" name="due"  id="duech" />
<input type="text" placeholder="Paid Amount" style="width: 130px;text-align:right;" name="paid" id="paidch" />
<input type="text" readonly="readonly" placeholder="Surcharge" style="width: 140px;text-align:right;" name="surchargech" id="surchargech"  />
<input type="text" placeholder="Paid Surcharge" style="width: 140px;text-align:right;" name="paidsurchargech" id="paidsurchargech"  />
<input type="text" style="width: 120px;" placeholder="Remarks" name="remarks"  />
<input type="hidden" name="type" value="<?php echo $data['type'] ?>"  />
<input type="hidden" name="ref" value="<?php echo $data['ref_no'] ?>"  />
<input type="hidden" name="refid" value="<?php echo $_REQUEST['id'] ?>"  />
<input type="hidden" name="mem_id" value="<?php echo $_REQUEST['mid'] ?>"  />
<input type="hidden" name="date" value="<?php echo $data['date'] ?>"  />

</td>

<td> <?php echo CHtml::ajaxSubmitButton(
                                'Save',
    array('/reciept/updatereqd'),
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
</thead>
<tbody>
<?php  $connection = Yii::app()->db; 
 $sql_plot2  = "SELECT *,installpayment.id as iid from installpayment 
Left join memberplot on (memberplot.plot_id=installpayment.plot_id)
where installpayment.re_id='".$_REQUEST['id']."' ";
$result_plots2 = $connection->createCommand($sql_plot2)->queryAll();
foreach($result_plots2 as $ch){
$sql_rpt  = "Select * from rpt_print where rid='".$_REQUEST['id']."' and msid='".$ch['plot_id']."'  ";
$result_rpt = $connection->createCommand($sql_rpt)->queryRow();	
if($ch['dueamount']==''){$ch['dueamount']=0;}
	if($ch['paidamount']==''){$ch['paidamount']=0;}
	if($ch['surcharge']==''){$ch['surcharge']=0;}
	if($ch['paidsurcharge']==''){$ch['paidsurcharge']=0;}
if($ch['ref'] > 0){
$sql_ref  = "Select * from installpayment where id='".$ch['ref']."'";
$result_ref = $connection->createCommand($sql_ref)->queryRow();	
	$ch['lab']=$result_ref['lab'];
	}
echo '<tr>
<td>'.$ch['plotno'].'/'.$ch['app_no'].'</td>
<td>'.$ch['lab'].'</td>
<td>'.$ch['due_date'].'</td>
<td style="text-align:right;">'.number_format($ch['dueamount']).'</td>
<td style="text-align:right;">'.number_format($ch['paidamount']).'</td>
<td style="text-align:right;">'.number_format($ch['surcharge']).'</td>
<td style="text-align:right;">'.number_format($ch['paidsurcharge']).'</td>
<td>'.$ch['remarks'].'</td>
<td>';
if($data['fstatus']!=='Verified' && Yii::app()->session['user_array']['per18']==1){
echo '<a href="deleteinsd?id='.$ch['iid'].'&&rid='.$_REQUEST['id'].'&&mid='.$data['mid'].'">Delete</a>';
}
echo '</td>
</tr>';}
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
 where plots.id='".$result_rpt['msid']."' ";
 $sql_t  = "SELECT *,plots.id as pid from plots
Left join transferplot on (plots.id=transferplot.plot_id)
Left join memberplot on (plots.id=memberplot.plot_id)
Left join projects on (projects.id=plots.project_id)
Left join streets on (streets.id=plots.street_id)
Left join sectors on (sectors.id=plots.sector)
 where transferplot.plot_id='".$result_rpt['msid']."' ";
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
<input type="text" readonly="readonly" placeholder="Due Amount" style="width: 130px;text-align:right;" name="due" id="duein"  />
<input type="text" placeholder="Paid Amount" style="width: 130px;text-align:right;" name="paid"  id="paidin"  />
<input type="text" readonly="readonly" placeholder="Surcharge" style="width: 140px;text-align:right;" name="surchargein" id="surchargein"  />
<input type="text" placeholder="Paid Surcharge" style="width: 140px;text-align:right;" name="paidsurchargein"  id="paidsurchargein"  />
<input type="text" style="width: 120px;" placeholder="Remarks" name="remarks"  />
<input type="hidden" name="mem_id" value="<?php echo $data['mid'] ?>"  />
<input type="hidden" name="refid" value="<?php echo $_REQUEST['id'] ?>"  />
<input type="hidden" name="type" value="<?php echo $data['type'] ?>"  />
<input type="hidden" name="ref_no" value="<?php echo $data['ref_no'] ?>"  />
<input type="hidden" name="date" value="<?php echo $data['date'] ?>"  />

<td><?php echo CHtml::ajaxSubmitButton(
                                'Save',
    array('/reciept/updatereqind'),
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
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
 $(document).ready(function()
     {  	
       $("#charge").change(function()
           {
         	select_amounts($(this).val());
		   });
     });
function select_amounts(id)
{
$.ajax({
      type: "POST",
      url:    "chargesam?val1="+id,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var newv='';
	$(json).each(function(i,val){
	var pre='';
	
	newv= val.amount - val.paidamount;
});

var elem = document.getElementById("duech");
elem.value = newv;
var elem1 = document.getElementById("paidch");
elem1.value = newv;
//$("#plotno").value(newv);
          }
    });
	$.ajax({
      type: "POST",
      url:    "surcharge?val1="+id,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var newv='';
	$(json).each(function(i,val){
	var pre='';
	
	newv= val
});

var elem = document.getElementById("surchargech");
elem.value = newv;

//$("#plotno").value(newv);
          }
    });
		  
}
$(document).ready(function()
     {  	
       $("#install").change(function()
           {
         	select_installa($(this).val());
		   });
     });
function select_installa(id)
{
$.ajax({
      type: "POST",
      url:    "installam?val1="+id,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var newv='';
	$(json).each(function(i,val){
	var pre='';
	
	newv= val.dueamount - val.paidamount;
});

var elem = document.getElementById("duein");
elem.value = newv;
var elem1 = document.getElementById("paidin");
elem1.value = newv;
//$("#plotno").value(newv);
          }
    });
	$.ajax({
      type: "POST",
      url:    "surinstall?val1="+id,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var newv='';
	$(json).each(function(i,val){
	var pre='';
	
	newv= val
});

var elem = document.getElementById("surchargein");
elem.value = newv;

//$("#plotno").value(newv);
          }
    });
		  
}
 $(document).ready(function()
     {  	
       $("#plots").change(function()
           {
         	select_chrges($(this).val());
		   });
     });


function select_chrges(id)
{
$.ajax({
      type: "POST",
      url:    "ajaxRequest?val1="+id,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var listItems='';
listItems+= "<option value=''>Select</option>";
	$(json).each(function(i,val){
		if(val.amount > val.paidamount)
	listItems+= "<option value='" + val.id + "'>" + val.payment_type + "(" +val.amount +")</option>";
});listItems+="";
$("#charge").html(listItems);
          }
    });
}

 $(document).ready(function()
     {  	
       $("#plots1").change(function()
           {
         	select_install($(this).val());
		   });
     });


function select_install(id)
{
$.ajax({
      type: "POST",
      url:    "ajaxRequest1?val1="+id,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
	var listItems='';
	listItems+= "<option value=''>Select </option>";
	$(json).each(function(i,val){
		if(val.dueamount > val.paidamount)
	listItems+= "<option value='" + val.id + "'>" + val.lab + "(" +val.dueamount +")</option>";
});listItems+="";
$("#install").html(listItems);
          }
    });
}
</script>



<form id="form" action="<?php echo Yii::app()->baseUrl; ?>/dompdf/www/pdfgenerator.php" method="post">
<input type="hidden" name="paper" value="legal">
<input type="hidden" name="orientation" value="portrait">
</select>
</p>
<textarea name="html1" style="display:none;" cols="60" rows="50">
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>
<style>
	@page { margin: 0px; }
table{
		background-repeat:no-repeat;
	width:750px;
	padding-top:100px;
}
td{ border:none !important;
padding:0px !important;}

	.divhead{
		border:3px inset #000;
		margin:20px 0px 30px 60px;
		height:280px;
		z-index: -1;
	    background-image: url('<?php echo Yii::app()->baseUrl; ?>/dompdf/recbg3.jpg') ;
	}
		.divhead1{
		border:3px inset #000;
		margin:20px 0px 30px 60px;
		height:280px;
		z-index: -1;
	    background-image: url('<?php echo Yii::app()->baseUrl; ?>/dompdf/recbg4.jpg') ;
	}
		.divhead2{
		border:3px inset #000;
		margin:20px 0px 30px 60px;
		height:280px;
		z-index: -1;
	    background-image: url('<?php echo Yii::app()->baseUrl; ?>/dompdf/recbg5.jpg') ;
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
SELECT plot_id FROM installpayment where re_id='".$_REQUEST['id']."'
UNION DISTINCT 
SELECT plot_id FROM plotpayment where re_id='".$_REQUEST['id']."'";
$result_plots12 = $connection->createCommand($sql_plot12)->queryAll();
$page=0;
$pa=0;
$rno=0;
foreach($result_plots12 as $new){
$rno=$rno+1;
	if($page>0){
		echo '<div style="page-break-before: always;"></div>';
		}
	$sql_rpt  = "Select * from rpt_print where id='".$_REQUEST['id']."'  ";
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
$total=$total+$ch1['paidamount'];
if($ch1['plot_id']==$new['plot_id']){}}
//1st copy
echo '<table class="divhead" style="   page-break-inside: avoid;"><tbody>';
echo '<div class="">';
//echo '<div style="margin: 54px 0 0px 510px; position: absolute;"><img alt="RDLPK" src="http://'.$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl.'/barcode/barcode.php?text=RO-'.$data['rid'].$result_rpt['id'].'&print=false"  /></div>';
echo '<div style="margin: 75px 0 0px 535px;position: absolute;">'.$data['rid'].'-'.$result_rpt['id'].'</div>';
echo '<div style="margin: 90px 0 0px 40px;position: absolute;">'.date("d-m-Y", strtotime($data['create_date'] )).'</div>';
echo '<div style="margin: 88px 0 0px 535px;position: absolute; font-size:20px;"><b>'.$result_rpt['jvno'].'</b></div>';
echo '<div style="margin: 115px 0 0px 15px;position: absolute;">Funds transmitted from </div>';
echo '<div style="margin: 115px 0 0px 170px;position: absolute; font-family:segoepr;">'.$result_member['name'].'/'.$result_member['sodowo'].'</div>';
echo '<div style="margin: 140px 0 0px 15px;position: absolute;">Account #</div>';
echo '<div style="margin: 140px 0 0px 80px;position: absolute; font-family:segoepr;">'.$data['acc_no'].'</div>';
echo '<div style="margin: 140px 0 0px 200px;position: absolute;">Amounting to Rs.</div>';
echo '<div style="margin: 140px 0 0px 310px;position: absolute;font-family:segoepr;">'.number_format($data['amount']).'/-</div>';
echo '<div style="margin: 140px 0 0px 415px;position: absolute;">Dated</div>';
echo '<div style="margin: 140px 0 0px 460px;position: absolute; font-family:segoepr;">'.date("d-m-Y", strtotime($data['date'] )).'</div>';
if($result_membership['plotno']==''){
	echo '<div style="margin: 162px 0 0px 15px;position: absolute;">Form #</div>';
	echo '<div style="margin: 162px 0 0px 100px;position: absolute; font-family:segoepr;">'.$result_membership['app_no'].' &nbsp;&nbsp;('.$result_membership['size'].')</div>';
	}else{
	echo '<div style="margin: 162px 0 0px 15px;position: absolute;">Membership #</div>';	
	echo '<div style="margin: 162px 0 0px 100px;position: absolute; font-family:segoepr;">'.$result_membership['plotno'].'</div>';
	}

echo '<div style="margin: 162px 0 0px 400px;position: absolute; ">Paid Amount</div>';
echo '<div style="margin: 162px 0 0px 520px;position: absolute; color:#fff; font-size:18px;"><b>Rs:'.number_format($total).'/-</b></div>';
echo '<table style=" width:665px;page-break-inside: avoid;  margin: 115px 0 0px -15px;position: absolute; font-size:12px;"><tbody>';
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
echo '<div style="margin: 350px 0 0px -22px;position: absolute; width:686px; border-top:1px solid #000;">  The Sum of Rupees:</div>';
echo '<div style="margin: 350px 0 0px 110px;position: absolute; text-transform: capitalize; font-family:segoepr;">'.$totalw.'</div>';
echo '<div style="margin: 350px 0 0px 586px;position: absolute; float:right;"><b>Rs.</b>'.number_format($total).'</div>';
echo '<div style="margin: 390px 0 0px 100px;position: absolute; font-size:10px;"><b>User:</b>'.$result_us['salesname'].'&nbsp;|&nbsp;'.Yii::app()->session['user_array']['firstname'].'&nbsp;'.Yii::app()->session['user_array']['middelname'].'&nbsp;'.Yii::app()->session['user_array']['lastname'].'&nbsp;|&nbsp;'.date('d-M-Y h:m:s').'
</div>';
echo '<div style="margin: 380px 0 0px 500px;position: absolute;border-top:1px solid #000; font-size:10px;"><b>Signature</b></div>';
echo '<div style="margin: 390px 0 0px -17px;position: absolute; font-size:10px;"><b>[Receipt '.$rno.' of '.count($result_plots12).']</b></div>';
echo '</div>';

echo '</tbody></table>';
//2st copy
echo '<hr style="border-top: dotted 2px;"/>';
echo '<table class="divhead1" style="   page-break-inside: avoid;"><tbody>';
echo '<div class="">';
//echo '<div style="margin: 54px 0 0px 510px; position: absolute;"><img alt="RDLPK" src="http://'.$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl.'/barcode/barcode.php?text=RO-'.$data['rid'].$result_rpt['id'].'&print=false"  /></div>';
echo '<div style="margin: 75px 0 0px 535px;position: absolute;">'.$data['rid'].'-'.$result_rpt['id'].'</div>';
echo '<div style="margin: 90px 0 0px 40px;position: absolute;">'.date("d-m-Y", strtotime($data['create_date'] )).'</div>';
echo '<div style="margin: 88px 0 0px 535px;position: absolute; font-size:20px;"><b>'.$result_rpt['jvno'].'</b></div>';
echo '<div style="margin: 115px 0 0px 15px;position: absolute;">Funds transmitted from </div>';
echo '<div style="margin: 115px 0 0px 170px;position: absolute; font-family:segoepr;">'.$result_member['name'].'/'.$result_member['sodowo'].'</div>';
echo '<div style="margin: 140px 0 0px 15px;position: absolute;">Account #</div>';
echo '<div style="margin: 140px 0 0px 80px;position: absolute; font-family:segoepr;">'.$data['acc_no'].'</div>';
echo '<div style="margin: 140px 0 0px 200px;position: absolute;">Amounting to Rs.</div>';
echo '<div style="margin: 140px 0 0px 310px;position: absolute;font-family:segoepr;">'.number_format($data['amount']).'/-</div>';
echo '<div style="margin: 140px 0 0px 415px;position: absolute;">Dated</div>';
echo '<div style="margin: 140px 0 0px 460px;position: absolute; font-family:segoepr;">'.date("d-m-Y", strtotime($data['date'] )).'</div>';
if($result_membership['plotno']==''){
	echo '<div style="margin: 162px 0 0px 15px;position: absolute;">Form #</div>';
	echo '<div style="margin: 162px 0 0px 100px;position: absolute; font-family:segoepr;">'.$result_membership['app_no'].' &nbsp;&nbsp;('.$result_membership['size'].')</div>';
	}else{
	echo '<div style="margin: 162px 0 0px 15px;position: absolute;">Membership #</div>';	
	echo '<div style="margin: 162px 0 0px 100px;position: absolute; font-family:segoepr;">'.$result_membership['plotno'].'</div>';
	}

echo '<div style="margin: 162px 0 0px 400px;position: absolute; ">Paid Amount</div>';
echo '<div style="margin: 162px 0 0px 520px;position: absolute; color:#fff; font-size:18px;"><b>Rs:'.number_format($total).'/-</b></div>';
echo '<table style=" width:665px;page-break-inside: avoid;  margin: 115px 0 0px -15px;position: absolute; font-size:12px;"><tbody>';
$no=0;


foreach($result_plots1 as $ch1){	
if($ch1['plot_id']==$new['plot_id']){
if($ch1['paidamount']==''){$ch1['paidamount']=0;}
$no=$no+1;
echo '<tr><td style=width:20px !important;">'.$no.'</td>
<td style="width:210px !important;">'.$ch1['payment_type'].'</td>
<td style="width:210px !important;"> '.$ch1['remarks'].'</td>
<td style="width:95px !important; text-align:right;">'.number_format($ch1['amount']).'</td>
<td style="width:95px !important; text-align:right;">'.number_format($ch1['paidamount']).'</td></tr>';}
}
foreach($result_plots2 as $ch1){	
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
echo '<div style="margin: 350px 0 0px -22px;position: absolute; width:686px; border-top:1px solid #000;">  The Sum of Rupees:</div>';
echo '<div style="margin: 350px 0 0px 110px;position: absolute;text-transform: capitalize; font-family:segoepr;">'.$totalw.'</div>';
echo '<div style="margin: 350px 0 0px 586px;position: absolute; float:right;"><b>Rs.</b>'.number_format($total).'</div>';
echo '<div style="margin: 390px 0 0px 100px;position: absolute; font-size:10px;"><b>User:</b>'.$result_us['salesname'].'&nbsp;|&nbsp;'.Yii::app()->session['user_array']['firstname'].'&nbsp;'.Yii::app()->session['user_array']['middelname'].'&nbsp;'.Yii::app()->session['user_array']['lastname'].'&nbsp;|&nbsp;'.date('d-M-Y h:m:s').'
</div>';
echo '<div style="margin: 380px 0 0px 500px;position: absolute;border-top:1px solid #000; font-size:10px;"><b>Signature</b></div>';
echo '<div style="margin: 390px 0 0px -17px;position: absolute; font-size:10px;"><b>[Receipt '.$rno.' of '.count($result_plots12).']</b></div>';
echo '</div>';

echo '</tbody></table>';
//3rd copy
echo '<hr style="border-top: dotted 2px;"/>';
echo '<table class="divhead2" style="   page-break-inside: avoid;"><tbody>';
echo '<div class="">';
//echo '<div style="margin: 54px 0 0px 510px; position: absolute;"><img alt="RDLPK" src="http://'.$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl.'/barcode/barcode.php?text=RO-'.$data['rid'].$result_rpt['id'].'&print=false"  /></div>';
echo '<div style="margin: 75px 0 0px 535px;position: absolute;">'.$data['rid'].'-'.$result_rpt['id'].'</div>';
echo '<div style="margin: 90px 0 0px 40px;position: absolute;">'.date("d-m-Y", strtotime($data['create_date'] )).'</div>';
echo '<div style="margin: 88px 0 0px 535px;position: absolute; font-size:20px;"><b>'.$result_rpt['jvno'].'</b></div>';
echo '<div style="margin: 115px 0 0px 15px;position: absolute;">Funds transmitted from </div>';
echo '<div style="margin: 115px 0 0px 170px;position: absolute; font-family:segoepr;">'.$result_member['name'].'/'.$result_member['sodowo'].'</div>';
echo '<div style="margin: 140px 0 0px 15px;position: absolute;">Account #</div>';
echo '<div style="margin: 140px 0 0px 80px;position: absolute; font-family:segoepr;">'.$data['acc_no'].'</div>';
echo '<div style="margin: 140px 0 0px 200px;position: absolute;">Amounting to Rs.</div>';
echo '<div style="margin: 140px 0 0px 310px;position: absolute;font-family:segoepr;">'.number_format($data['amount']).'/-</div>';
echo '<div style="margin: 140px 0 0px 415px;position: absolute;">Dated</div>';
echo '<div style="margin: 140px 0 0px 460px;position: absolute; text-transform: capitalize;font-family:segoepr;">'.date("d-m-Y", strtotime($data['date'] )).'</div>';
if($result_membership['plotno']==''){
	echo '<div style="margin: 162px 0 0px 15px;position: absolute;">Form #</div>';
	echo '<div style="margin: 162px 0 0px 100px;position: absolute; font-family:segoepr;">'.$result_membership['app_no'].' &nbsp;&nbsp;('.$result_membership['size'].')</div>';
	}else{
	echo '<div style="margin: 162px 0 0px 15px;position: absolute;">Membership #</div>';	
	echo '<div style="margin: 162px 0 0px 100px;position: absolute; font-family:segoepr;">'.$result_membership['plotno'].'</div>';
	}

echo '<div style="margin: 162px 0 0px 400px;position: absolute; ">Paid Amount</div>';
echo '<div style="margin: 162px 0 0px 520px;position: absolute; color:#fff; font-size:18px;"><b>Rs:'.number_format($total).'/-</b></div>';
echo '<table style=" width:665px;page-break-inside: avoid;  margin: 115px 0 0px -15px;position: absolute; font-size:12px;"><tbody>';
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
echo '<div style="margin: 350px 0 0px -22px;position: absolute; width:686px; border-top:1px solid #000;">  The Sum of Rupees:</div>';
echo '<div style="margin: 350px 0 0px 110px;position: absolute;text-transform: capitalize; font-family:segoepr;">'.$totalw.'</div>';
echo '<div style="margin: 350px 0 0px 586px;position: absolute; float:right;"><b>Rs.</b>'.number_format($total).'</div>';
echo '<div style="margin: 390px 0 0px 100px;position: absolute; font-size:10px;"><b>User:</b>'.$result_us['salesname'].'&nbsp;|&nbsp;'.Yii::app()->session['user_array']['firstname'].'&nbsp;'.Yii::app()->session['user_array']['middelname'].'&nbsp;'.Yii::app()->session['user_array']['lastname'].'&nbsp;|&nbsp;'.date('d-M-Y h:m:s').'
</div>';
echo '<div style="margin: 380px 0 0px 500px;position: absolute;border-top:1px solid #000; font-size:10px;"><b>Signature</b></div>';
echo '<div style="margin: 390px 0 0px -17px;position: absolute; font-size:10px;"><b>[Receipt '.$rno.' of '.count($result_plots12).']</b></div>';
echo '</div>';

echo '</tbody></table>';

$page=1;
}

?>



</html>

</textarea>

<div style="text-align: left; margin-top: 1em;">
<?php if($data['fstatus']!=='Verified'){?>
  <button type="submit" style="margin-bottom:100px;" class="btn">Print Transmittal Slip</button>
<?php }?>
</div>

</form>

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
       
        
       
        return $words.' Only';
    }
    else if( ! ( ( int ) $num ) )
    {
        return 'Zero';
    }
    return '';}

?>
