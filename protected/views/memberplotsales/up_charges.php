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

  <h3>Update Charges</h3>

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

            foreach($payments as $pay){
				
				
				?>
  <div class="float-left">
  <p class="reg-left-text">Payment Type<font color="#FF0000">*</font></p>
  <p class="reg-right-field-area margin-left-5">
	    <input name="payment_type" readonly="readonly"  type="text" value="<?php echo $pay['payment_type'];?>" class="reg-login-text-field" id="payment_type">
      </select>
  </p>
</div>
  <div class="float-left">
    <p class="reg-left-text">Due Amount. <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="<?php echo $pay['amount'];?>" name="amount" id="amount" class="reg-login-text-field" />
    </p>
  </div>
  
  
  <div class="float-left">

    <p class="reg-left-text">Remarks<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      
     <input name="remarks"  type="text" value="<?php echo $pay['remarks'];?>" class="reg-login-text-field" id="remarks">
    </p>

  </div>
  
  
<div class="float-left">

    <p class="reg-left-text">Due Date<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      
    <input name="duedate"  type="text" value="<?php echo $pay['duedate'];?>" class="reg-login-text-field" id="todatepicker">
    </p>
  </div>
 <?php }?>
  <div class="float-left">

<input type="hidden" id="id" name="id" value="<?php  echo $_GET['id']; ?>"/>
<input type="hidden" id="mem_id" name="mem_id" value="<?php  echo $_GET['mem_id']; ?>"/>

</div>

  

 

   	

	

 <?php echo CHtml::ajaxSubmitButton(

                                'Update',

    array('chargup'),

                                array(  

                'beforeSend' => 'function(){ 

                                             $("#submit").attr("disabled",true);

            }',

                                        'complete' => 'function(){ 

                                             $("#user_login_form").each(function(){});

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

