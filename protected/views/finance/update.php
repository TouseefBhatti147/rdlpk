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

//            $res=array();

  //          foreach($pla as $key){
				
?>

  
  
   

  <div class="float-left">

    <p class="reg-left-text">Due Amount. <font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" value="<?php  echo $_GET['dueamount'];?>" name="dueamount" id="dueamount" class="reg-login-text-field" />

    </p>

  </div>

  <div class="float-left">

    <p class="reg-left-text">Paid Amount<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      
     <input name="paidamount"  type="text" value="" class="new-input" id="paidamount">
    </p>

  </div>
  
  
  
  <div class="float-left">

    <p class="reg-left-text">Payment Mode<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">
  <select name="payment_type" id="payment_type" >

    <option value="">Select Payment Type</option>

    <option value="cash">Cash</option>

    <option value="checue">Cheque</option>

    <option value="po">Pay Order</option>

    

    </select>

    </p>

  </div><div class="float-left">

    <p class="reg-left-text">Voucher No.<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      
     <input name="detail"  type="text" value="" class="new-input" id="detail">
    </p>

  </div>
  <div class="float-left">

    <p class="reg-left-text">Surcharge<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      
     <input name="surcharge"  type="text" value="" class="new-input" id="surcharge">
    </p>

  </div><div class="float-left">

    <p class="reg-left-text">Remarks<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      
     <input name="remarks"  type="text" value="" class="new-input" id="remarks">
    </p>

  </div>
  <div class="float-left">

    <p class="reg-left-text">Paid Date<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      
    <input name="paid_date"  type="text" placeholder="Enter To Date" class="new-input" id="todatepicker">
    </p>

  </div>
  
<div class="float-left">

    <p class="reg-left-text">Due Date<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      
    <input name="due_date"  type="text" value="<?php echo $_GET['due_date']; ?>" class="new-input" id="due_date">
    </p>

  </div>

  <div class="float-left">

<input type="hidden" id="id" name="id" value="<?php  echo $_GET['id']; ?>"/>

</div>

  

 

   	

	<?php //}?>

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

