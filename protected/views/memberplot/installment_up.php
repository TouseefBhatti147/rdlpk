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
    <p class="reg-left-text">Label<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input name="lab" readonly="readonly"  type="text" value="<?php  echo $key['lab'];?>" class="reg-login-text-field" id="lab">
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Due Date<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input name="due_date" readonly="readonly"  type="text" value="<?php echo $key['due_date']; ?>" class="reg-login-text-field" id="todatepicker">
    </p>
  </div>
    <div class="float-left">
    <p class="reg-left-text">Due Amount. <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
    <?php if(!empty($key['ref'])){?>
    	<input readonly="readonly"  type="text" value="<?php echo $key['dueamount']; ?>" name="dueamount" id="dueamount" class="reg-login-text-field" />
	<?php }
      else{?> 
 <input  type="text" value="<?php echo $key['dueamount']; ?>" name="dueamount" id="dueamount" class="reg-login-text-field" /> <?php }?>
    </p>
  </div>
  
  
  
  
  
  
  <div class="float-left">
    <p class="reg-left-text">Remarks<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input name="remarks"  type="text" value="<?php  echo $key['remarks'];?>" class="reg-login-text-field" id="remarks">
    </p>
  </div>
 
  
  <div class="float-left">
    <input type="hidden" id="id" name="id" value="<?php  echo $_GET['id']; ?>"/>
  </div>
  <?php }?>
  <?php echo CHtml::ajaxSubmitButton(

                                'Update',

    array('installmentup'),

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

