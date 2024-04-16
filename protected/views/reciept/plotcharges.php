
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
  <h3>Plot Charges</h3>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5 ">
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

			<div class="float-left">
    <p class="reg-left-text">Payment Type<font color="#FF0000">*</font></p>
   	<p class="reg-right-field-area margin-left-5">
       <select name="charges_id" id="charges_id">
   <?php
   foreach($charges as $key1)
   {
	echo ' 	<option value="'.$key1['id'].'">'.$key1['name'].'</option>';   
   }
   
   ?>

  	</select>
    </p>
  	</div>
    <?php foreach($plots as $key)
   {
	   
	
	   ?>
	
        
	<div class="float-left">
    <p class="reg-left-text">Plot No<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="hidden" readonly="readonly" value="<?php echo $key['id'] ?>" name="plot_id" id="plot_id" class="reg-login-text-field" />
      <input type="text" readonly="readonly" value="<?php echo $key['plot_detail_address'] ?>" name="plot_detail_address" id="plot_detail_address" class="reg-login-text-field" />
      
    </p>
  	</div>
  	
     <div class="float-left">

    <p class="reg-left-text">Date<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

   <input name="duedate"  type="text" placeholder="Enter Due Date" class="new-input" id="todatepicker">

    </p>

  </div>

  	
   
  <div class="float-left">
    <p class="reg-left-text">Comment<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" name="comment" id="comment" class="reg-login-text-field" />
    </p>
  </div>
  <?php }?>
    	
     <input type="hidden" name="pid" value="<?php echo $_REQUEST['pid'];?>" />

  <?php echo CHtml::ajaxSubmitButton(

                                'Add Charges',

    array('charge'),
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
                         array("id"=>"login","class" => "btn-info pull-right")); ?>

  <?php $this->endWidget(); ?>

  
  		
          