
<div class="shadow">
  <h3>Payment</h3>
</div>

<!-- shadow -->

<hr noshade="noshade" class="hr-5">
<section class="reg-section margin-top-30">


<script src="//code.jquery.com/jquery-1.10.2.js"></script>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.js"></script>



<script>

$(function() {

$( "#date" ).datepicker({ dateFormat: 'yy-mm-dd' });

});


</script>



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
<div id="error-div" class="errorMessage" style="display: none; color:#F00;"></div>

<input type="hidden" name="pid" value="<?php echo $_REQUEST['pid'];?>" />
<div class="float-left">
  <p class="reg-left-text">Payment Type<font color="#FF0000">*</font></p>
  <p class="reg-right-field-area margin-left-5">
  
    <select name="payment_type" id="payment_type-type">
    
      <?php

   foreach($charges as $key1)

   {

	echo ' 	<option value="'.$key1['name'].'">'.$key1['name'].'</option>';  

   }
  ?>
    </select>
  </p>
</div>
<?php	
            $res=array();
            foreach($pages as $key){
            echo '<div class="float-left">

    <p class="reg-left-text">Plot No<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">
<input type="hidden"  value="'.$key['plot_id'].'" name="plot_id" id="plot_id" class="reg-login-text-field" />
      <input type="text" readonly="readonly" value="'.$key['plot_detail_address'].'" name="plot_detail_address" id="plot_detail_address" class="reg-login-text-field" />

    </p>

  	</div>

  	<div class="float-left">

    <p class="reg-left-text">Member Name<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">
	 <input type="hidden"   name="member_id" value="'.$key['member_id'].'" id="member_id" class="reg-login-text-field" />

      <input type="text"  readonly="readonly" value="'.$key['name'].'" name="name" id="name" class="reg-login-text-field" />

    </p>

  </div>

  <div class="float-left">

    <p class="reg-left-text">Amount<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" value="" name="amount" id="amount" class="reg-login-text-field" />

    </p>

  </div>

   <div class="float-left">

    <p class="reg-left-text">Discount<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" value="" name="discount" id="discount" class="reg-login-text-field" />

    </p>

  </div>

  

<div class="float-left">

    <p class="reg-left-text">Payment Mode<font color="#FF0000">*</font></p>

   	<p class="reg-right-field-area margin-left-5">

    <select name="paid-as" id="paid-as">

  	<option value="payment_type">Select Payment Mode</option>

   	<option value="cash">Cash</option>

    <option value="cheque">Cheque</option>

    <option value="Po">Pay Order</option>

	

  	</select>

    </p>

  	</div>

  <div class="float-left">

    <p class="reg-left-text">Detail<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" value="" name="detail" id="detail" class="reg-login-text-field" />

    </p>

  </div>

  <div class="float-left">
    <p class="reg-left-text">Surcharge<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" name="surcharge" id="surcharge" class="reg-login-text-field" />
    </p>
  </div> ';
}?>
  <div class="float-left">

    <p class="reg-left-text">Date<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">
  <input name="date" placeholder="Enter From Date" type="text" class="new-input" id="date">
 </p></div>
 
  <?php echo CHtml::ajaxSubmitButton(

                                'Add Payment',

    array('instalment'),
                   array(  
                'beforeSend' => 'function(){ 
                                             $("#submit").attr("disabled",true);
            }',
                                        'complete' => 'function(){ 
                                             $("#user_login_form").each(function(){this.reset();});
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
                         array("id"=>"login","class" => "btn-info pull-right")); ?>

  <?php $this->endWidget(); ?>

