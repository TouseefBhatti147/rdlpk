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
        <option value="cash">Cash</option>
        <option value="checue">Cheque</option>
        <option value="po">Pay Order</option>
      </select>
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Due Amount. <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="<?php  echo $key['dueamount'];?>" name="dueamount" id="dueamount" class="reg-login-text-field" />
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
      <input name="lab"  type="text" value="<?php  echo $key['lab'];?>" class="reg-login-text-field" id="lab">
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
	
	$curdate=date('Y-m-d');
	
	$surchargeratio=$key['dueamount']/100*0.05;

$duedate=$key['due_date'];
$paiddate=date('d-m-Y');
$datetime1 = new DateTime($duedate);
$datetime2 = new DateTime($paiddate);
$interval = $datetime1->diff($datetime2); 
$surchargedur= $interval->format('%R%a ');
if($surchargedur>1){
$totalduesur=$surchargedur*$surchargeratio;}else{$totalduesur=0;}	
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
      <input name="paid_date"  type="text" value="<?php  echo $key['paid_date'];?>" class="reg-login-text-field" id="todatepicker">
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Due Date<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input name="due_date"  type="text" value="<?php echo $key['due_date']; ?>" class="reg-login-text-field" id="due_date">
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

