
<div class="shadow">

  <h3>Update Target</h3>

</div>

<!-- shadow -->

<hr noshade="noshade" class="hr-5">

<section class="reg-section margin-top-30">
<span style="float:right"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/reciept/target_list"  class="btn-info button">Back To List</a></span>

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

            foreach($update_target as $key){

				

     echo ' 

  


  <div class="float-left">

    <p class="reg-left-text">Year<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">
<input type="hidden"  value="'.$key['year'].'" name="year" id="year" class="reg-login-text-field" />
      <input type="text" readonly="readonly" value="'.$key['year'].'" class="reg-login-text-field" />

    </p>

  </div>

  <div class="float-left">

    <p class="reg-left-text">Month<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" readonly="readonly" value="'.$key['month'].'" name="month" id="month" class="reg-login-text-field" />

    </p>

  </div>

  <div class="float-left">

    <p class="reg-left-text">Target Amount<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      
     <input name="target"  type="text" value="'.$key['target'].'" class="new-input" id="target">
    </p>

  </div>

  <div class="float-left">

<input type="text" id="id" style="visibility:hidden;" name="id" value="'.$key['id'].'"/>

</div>

  

 

   	

';	}?>

 <?php echo CHtml::ajaxSubmitButton(

                                'Update Target',

    array('reciept/update_targ'),

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

