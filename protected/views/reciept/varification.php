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
</style>

<script>

$(function() {

$( "#fromdatepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });

});

$(function() {

$( "#todatepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });

});

</script><div class="">
<div class="shadow">
  <h3>Verification</h3>
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
<div class="span4">
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
  <?php $connection = Yii::app()->db; 
  $sql_payment1  = "SELECT * FROM plotpayment where r_id='".$data['rid']."'";
	$result_payments1 = $connection->createCommand($sql_payment1)->queryAll();
			$totalp=0;
			$rem=0;
		foreach($result_payments1 as $row){$totalp=$totalp+$row['paidamount']+$row['paidsurcharge'];}
		$sql_payment2  = "SELECT * FROM installpayment where r_id='".$data['rid']."'";
	$result_payments2 = $connection->createCommand($sql_payment2)->queryAll();
		foreach($result_payments2 as $row2){$totalp=$totalp+is_numeric($row2['paidamount'])+is_numeric($row2['paidsurcharge']);}
   $rem=$data['amount']-$totalp;
   $style='';
?>
<?php 
$connection = Yii::app()->db; 
$sql_plot12  = "
SELECT bank.name, rpt_print.* from rpt_print 
Left join bank on(bank.id=rpt_print.bank_details)
where rpt_print.rid='".$_REQUEST['id']."'";
$result_plots12 = $connection->createCommand($sql_plot12)->queryAll();
?>
<style> td{ padding:0px;} input{ margin-bottom:0px !important;} select{ margin-bottom:0px;}</style>
<table>
<thead style="color:#FFF;">
<th>Receipt No</th>
<th>Bank</th>
<th>Slip #</th>
<th>Submit Date</th>
<th>Clearance Date</th>
</thead>
<tbody>
<?php 
foreach($result_plots12 as $row){
	?>
    <tr>
<td><input type="hidden" name="reid" id="reid" value="<?php echo $row['id']?>" />
<input readonly="readonly" style="width:50px;" type="text" name="reno" id="reno" value="<?php echo $row['r_no']?>" /></td>	
<td> <select readonly="readonly" style="width:100px;" name="bank<?php echo $row['id']?>" id="bank<?php echo $row['id']?>" style="width:300px;">
<?php if($row['bank_details']!==''){echo '<option value="'.$row['bank_details'].'">'.$row['name'].'</option>';}else{
	echo '<option value=""> Select Bank</option>';
	}?>
<?php 
$sql_bank  = "SELECT * from bank";
$result_bank = $connection->createCommand($sql_bank)->queryAll();
foreach($result_bank as $ch){
	echo '<option value="'.$ch['id'].'">'.$ch['name'].'</option>';
	}
?>
</select></td>
<td><?php echo $row['slipno']?></td>

<td><?php echo $row['submitdate']?></td>
<td><?php echo $row['clrdate']?></td>
    </tr>
    
    
	<?php 
	}
?>
</tbody>
</table>
<h5>Actions</h5>
<?php 
if($data['bank_details']!==''){
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

<div id="error-div1" style="color:#F00; font-weight:bold;"></div>
<input name="rid" id="rid" value=" <?php echo $_REQUEST['id'];?>" type="hidden" />
<select name="status" id="status" style="width:300px;">
<?php if($data['fstatus']!==''){echo '<option value="'.$data['fstatus'].'">'.$data['fstatus'].'</option>';}else{
	echo '<option value=""> Select Status</option>';
	}?>
<option value="Verified">Verified</option>
<option value="Pending">Pending</option>
<option value="Rejected">Rejected</option>
</select>
<textarea name="comm" id="comm" style="width:300px;" placeholder="Comments"> <?php echo $data['comm'];?></textarea>

<?php echo CHtml::ajaxSubmitButton(
                                'Submit',
    array('/reciept/submittofinance'),
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
                </td>

<?php $this->endWidget(); }?>
  </div>
  <div class="span7">
  <iframe src="https://<?php echo $_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl;?>/index.php/reciept/print?id=<?php echo $_REQUEST['id'];?>" style="border:none; width:950px; overflow:scroll; height:900px;"></iframe>

  </div>
  </div>
   <?php 
if($data['typed']==0){?>
<table class="table table-striped table-new table-bordered" style="display:none;">
<thead  style="color:#FFF">
<th>Receipt #</th>
<th>MS #</th>
<th>Title</th>
<th>Due Date</th>
<th>Due Amount</th>
<th>Paid Amount</th>
<th>Due Surcharge</th>
<th>Paid Surcharge</th>
<th>Remarks</th>


</thead>
<tbody>
<?php  
$total=0;
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
$total=$total+$ch['paidamount'];
echo '<tr>
<td>'.$result_rpt['r_no'].'</td>
<td>'.$ch['plotno'].'/'.$ch['app_no'].'</td>
<td>'.$ch['payment_type'].'</td>
<td>'.$ch['duedate'].'</td>
<td style="text-align:right;">'.number_format($ch['amount']).'</td>
<td style="text-align:right;">'.number_format($ch['paidamount']).'</td>
<td style="text-align:right;">'.number_format($ch['surcharge']).'</td>
<td style="text-align:right;">'.number_format($ch['paidsurcharge']).'</td>
<td style="text-align:right;">'.$ch['remarks'].'</td>
</tr>';}
?>


<?php  $connection = Yii::app()->db; 
$sql_plot2  = "SELECT *,installpayment.id as iid from installpayment 
Left join memberplot on (memberplot.plot_id=installpayment.plot_id)
where installpayment.r_id='".$_REQUEST['id']."' ";
$result_plots2 = $connection->createCommand($sql_plot2)->queryAll();
foreach($result_plots2 as $ch){	

	$sql_rpt  = "Select * from rpt_print where rid='".$_REQUEST['id']."' and msid='".$ch['plot_id']."'  ";
$result_rpt = $connection->createCommand($sql_rpt)->queryRow();
if($ch['dueamount']==''){$ch['dueamount']=0;}
if($ch['paidamount']==''){$ch['paidamount']=0;}
if($ch['surcharge']==''){$ch['surcharge']=0;}
if($ch['paidsurcharge']==''){$ch['paidsurcharge']=0;}
$total=$total+$ch['paidamount'];
echo '<tr>
<td>'.$result_rpt['r_no'].'</td>
<td>'.$ch['plotno'].'/'.$ch['app_no'].'</td>
<td>'.$ch['lab'].'</td>
<td>'.$ch['due_date'].'</td>
<td style="text-align:right;">'.number_format($ch['dueamount']).'</td>
<td style="text-align:right;">'.number_format($ch['paidamount']).'</td>
<td style="text-align:right;">'.number_format($ch['surcharge']).'</td>
<td style="text-align:right;">'.number_format($ch['paidsurcharge']).'</td>
<td style="text-align:right;">'.$ch['remarks'].'</td>
</tr>';}

?>
<tr>
<td></td>
<td></td>
<td></td>
<td style="text-align:right;"></td>
<td style="text-align:right;"><b>Total</b></td>
<td style="text-align:right;"><b><?php echo number_format($total) ?></b></td>
<td style="text-align:right;"></td>
<td></td>
<td></td>
</tr></tbody>
</table>
</tbody>
</table>
<?php }?>

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
	listItems+= "<option value='" + val.id + "'>" + val.lab + "(" +val.dueamount +")</option>";
});listItems+="";
$("#install").html(listItems);
          }
    });
}
</script>


