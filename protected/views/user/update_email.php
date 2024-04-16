<section class="reg-section margin-top-30">	
 
	
  <div class="float-left"> <hr noshade="noshade" class="">
  <div id="error-div" class="errorMessage" style="display: none; color:#F00;"></div>
  <h4>Update Username/Email Password</h4>
<?php $form=$this->beginWidget('CActiveForm', array(

 'id'=>'plots',

 'enableAjaxValidation'=>false,

  'enableClientValidation'=>true,

                'method' => 'POST',
				'clientOptions'=>array(
			    'validateOnSubmit'=>true,
		        'validateOnChange'=>true,
	            'validateOnType'=>false,),
)); ?>
 
   <div class="float-left">
   	<?php	
            $res=array();
            foreach($update_member as $key){?>
    <p class="reg-left-text">Username<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
   <input type="text"   value="<?php echo $key['username']; ?>" name="username" id="username" class="reg-login-text-field" /></p>
</div>
   <div class="float-left">
    <p class="reg-left-text">Password<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
   <input type="text" value="<?php echo $key['password']; ?> "    name="password" id="password" class="reg-login-text-field" />
    <input type="hidden" value="<?php echo $key['id']; ?> "    name="id" id="id" class="reg-login-text-field" />
</p>

  <?php echo CHtml::ajaxSubmitButton(

                                'Update',

    array('Updatemail'),

                                array(  

                'beforeSend' => 'function(){ 

                                             $("#submit").attr("disabled",true);

            }',

                                        'complete' => 'function(){ 

                                             $("#plots").each(function(){ });

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
  <?php }?>
 </section>