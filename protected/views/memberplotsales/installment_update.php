<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.js"></script>
<script>

$(function() {

$( "#fromdatepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });

});

$(function() {

$( "#todatepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });

});

</script>

<div class="shadow">
  <h3>Update Installment</h3>
</div>

<!-- shadow -->

<hr noshade="noshade" class="hr-5">
<section class="reg-section margin-top-30">
  <div id="error-div" class="errorMessage" style="display: none; color:#F00;"></div>
  <?php $form=$this->beginWidget('CActiveForm', array(

 'id'=>'user_login_form',

 'enableAjaxValidation'=>false,

  'enableClientValidation'=>true,

                'method' => 'POST',
				'clientOptions'=>array(
			    'validateOnSubmit'=>true,
		        'validateOnChange'=>true,
	            'validateOnType'=>false,),
)); ?>
  <?php	

            $res=array();

          foreach($payments as $key){
				
?>
 <div class="float-left">
    <p class="reg-left-text">Payment Mode<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <select name="payment_type" id="payment_type" >
        <?php  echo'<option value="'.$key['payment_type'].'">'.$key['payment_type'].'</option>';?>
        <option value="">Select Payment Type</option>
        <option value="Cash">Cash</option>
        <option value="Cheque">Cheque</option>
        <option value="PO">Pay Order</option>
        <option value="Against Land">Against Land</option>
        <option value="Other">Other</option>
      </select>
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Due Amount. <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
    <?php if(!empty($key['ref'])){?>
    	<input readonly="readonly"  type="text" value="00" name="dueamount" id="dueamount" class="reg-login-text-field" />
	<?php }
      else{?> 
 <input readonly="readonly" type="text" value="<?php echo $key['dueamount']; ?>" name="dueamount" id="dueamount" class="reg-login-text-field" /> <?php }?>
    </p>
  </div>
 
  <div class="float-left">
    <p class="reg-left-text">Paid Amount<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input name="paidamount"  type="text" value="<?php  echo $key['paidamount'];?>" class="reg-login-text-field" id="paidamount">
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Label<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input readonly="readonly" name="lab"  type="text" value="<?php  echo $key['lab'];?>" class="reg-login-text-field" id="lab">
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Voucher No.<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input name="detail"  type="text" value="<?php  echo $key['detail'];?>" class="reg-login-text-field" id="detail">
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Surcharge<font color="#FF0000">*</font>
    <?php
	
	$curdate=date('d-m-Y');
	
	$surchargeratio=($key['dueamount']/100*0.05);
	
//$timestamp = strtotime($key['due_date_temp']); 
$duedate = $key['due_date_temp'];


$paiddate=date('Y-m-d');;


$date1=date_create($duedate);
$date2=date_create($paiddate);
$diff=date_diff($date1,$date2);

// %R outputs + beacause $date2 is after $date1 (a positive interval)
 $surchargedur=$diff->format("%R%a.");

 $totalduesur=$surchargedur*$surchargeratio;

if($surchargedur>1){
$totalduesur=$surchargedur*$surchargeratio;
}else{$totalduesur=0;}	
echo '<b style="color:red;">'.number_format($totalduesur).'</b>';
	
	
	
	?>
    </p>
    <p class="reg-right-field-area margin-left-5">
      <input name="surcharge"  type="text"  value="<?php  echo $key['surcharge'];?>" class="reg-login-text-field" id="surcharge">
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Paid Surcharge<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input name="paidsurcharge"  type="text" value="<?php  echo $key['paidsurcharge'];?>" class="reg-login-text-field" id="paidsurcharge">
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Remarks<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input name="remarks"  type="text" value="<?php  echo $key['remarks'];?>" class="reg-login-text-field" id="remarks">
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Paid Date<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input name="paid_date_temp"  type="text" value="" class="reg-login-text-field" id="todatepicker">
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Due Date<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input name="due_date_temp" readonly="readonly"  type="text" value="<?php $timestamp = strtotime($key['due_date_temp']); 
$new_date = date('Y-m-d', $timestamp); echo $new_date; ?>" class="reg-login-text-field" id="due_date_temp">
    </p>
  </div>
  <div class="float-left">
    <input type="hidden" id="id" name="id" value="<?php  echo $_GET['id']; ?>"/>
  </div>
  <?php }?>
  <?php echo CHtml::ajaxSubmitButton(

                                'Update',

    array('paymentupdate'),

                                array(  

                'beforeSend' => 'function(){ 

                                             $("#submit").attr("disabled",true);

            }',

                                        'complete' => 'function(){ 

                                             $("#user_login_form").each(function(){ });

                                             $("#submit").attr("disabled",false);

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

                         array("id"=>"login","class" => "btn-info pull-right")      

                ); ?>
  <?php $this->endWidget(); ?>
</section>

<!-- section 3 --> 

