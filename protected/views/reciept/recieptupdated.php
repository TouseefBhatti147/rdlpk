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
  <h3>Update Receipt</h3>
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
    <p class="reg-left-text">Type<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <select name="type" id="type" name="type" style="width:190px;" >
     <option name="type" value="<?php echo $data['type'] ?>"><?php echo $data['type'] ?></option> 
        <option name="type"  value="Cash">Cash</option>
        <option name="type" value="Cheque">Cheque</option>
        <option name="type" value="Pay Order">Pay Order</option>
         <option value="Against Land" name="type"ss>Against Land</option>
     </select>
     </p>
  </div>
  <?php 
   $connection = Yii::app()->db; 
  $sql_payment1  = "SELECT * FROM plotpayment where r_id='".$data['rid']."'";
	$result_payments1 = $connection->createCommand($sql_payment1)->queryAll();
			$totalp=0;
			$rem=0;
		foreach($result_payments1 as $row){$totalp=$totalp+$row['paidamount']+$row['paidsurcharge'];}
		$sql_payment2  = "SELECT * FROM installpayment where r_id='".$data['rid']."'";
	$result_payments2 = $connection->createCommand($sql_payment2)->queryAll();
		foreach($result_payments2 as $row2){$totalp=$totalp+$row2['paidamount']+$row2['paidsurcharge'];}
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
    <p class="reg-left-text" >Date<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input name="fromdate" placeholder="Enter Date" type="text" class="new-input" value="<?php echo $newDate = date("d-m-Y", strtotime($data['date'] )); ?>" id="fromdatepicker"> 
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Amount<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <input type="number"  value="<?php echo $data['amount'] ?>" name="amount" class="reg-login-text-field" />  
     </p>
  </div>
  
  <?php 
  $ch='';
  if($data['typed']==1){$ch='checked';}?>
  <div class="float-left">
     <p class="reg-left-text">
     <input type="checkbox"  class="" id="ifd" name="ifd" value="1" <?php echo $ch;?>>
     Instrument for Dealer
     </p>
  </div>
  <?php
  $style='';
  
 if($data['fstatus']!=='Verified' && Yii::app()->session['user_array']['per18']==1){
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

<?php $this->endWidget(); }?>
Member Name: &nbsp;<b><?php echo $data['name']; ?></b>
 </div>
 <br>
