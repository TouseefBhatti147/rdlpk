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

$( "#fromdatepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });

});

$(function() {

$( "#todatepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });

});

</script><div class="span12" >
<div class="shadow">
  <h3>Manage Funds Transmittal Slips</h3>
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
   $rem=$totalam-$totalp;
   $lock='';
  if($rem<$data['amount']){$lock ='readonly="readonly"';}
  ?>
  
  <div class="span12">
  <div class="span2">
  <p>Name</br>
  <p>CNIC</br>
  <p>Account #</br>
  
  </div>
  <div class="span3">
  <p><b><?php echo $data['name']?></b></br>
  <p><b><?php echo $data['cnic']?></b></br>
  <p><b><?php echo $data['acc_no'];?></b></br>
  </div>
    <div class="span2">
  <p>Total Amount in Account</br>
    <p>Total Transmitted Amount:</br>
      <p>Total Remaining Amount</p></br>
  </div>
  <div class="span3">
  <p style="text-align:right;"><b><?php echo number_format($totalam);?></b></br>
    <p style="text-align:right;"><b><?php echo number_format($totalp);?></b></br>
      <p style="text-align:right;"><b><?php echo number_format($rem);?></b></p></br>
  </div>
  </div>
 
 <br>
<div class="clearfix"></div>
<h5>Transmittal Slips</h5>
<div id="error-div1" style="color:#F00; font-weight:bold;"></div>
<hr noshade="noshade" class="hr-5 ">
<table class="table table-striped table-new table-bordered">
<thead  style="color:#FFF">
<th>ID</th>
<th>JV No.</th>
<th>MS #</th>
<th>Date</th>
<th>Action</th>

</thead>
<tbody>
<?php  
$sql_plot1  = "SELECT *,rpt_print.id as rpid from rpt_print 
Left Join memberplot on (rpt_print.msid=memberplot.plot_id)
where mem_id='".$_REQUEST['mid']."'";
$result_plots1 = $connection->createCommand($sql_plot1)->queryAll();
foreach($result_plots1 as $ch){
echo '<tr>
<td>'.$ch['rpid'].'</td>
<td>JV-'.$ch['jvno'].'</td>
<td>'.$ch['plotno'].'/'.$ch['app_no'].'</td>
<td>'.$ch['create_date'].'</td>
<td><a href="addreciept?id='.$ch['rpid'].'&&mid='.$_REQUEST['mid'].'">Manage Trasmittals</a></td>';}
?>

</tbody>
</table>

<?php 
$r2  = "SELECT max(r_no) FROM rpt_print";
$result_r2 = $connection->createCommand($r2)->queryRow();
$auto=$result_r2['max(r_no)'];
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

)); ?>
<input type="text" placeholder="JV No" style="width: 130px;" name="rno"   />
<select style="width: 150px;" name="plots1" id="plots1">
<?php 
$connection = Yii::app()->db; 
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
</select>
<input type="hidden" name="mem_id" value="<?php echo $_REQUEST['mid'] ?>"  />
</td>

<td> <?php echo CHtml::ajaxSubmitButton(
                                'Save',
    array('/reciept/gensub1'),
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
                                          
                                                $("#error-div1").show();
                                                $("#error-div1").html(data);$("#error-div1").append("");
												return false;
                                          }'
    ),
	
	array("id"=>"login1","class" => "btn")      
                ); ?></td>

<?php $this->endWidget(); }?>
