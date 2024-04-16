<div class="form-signin mg-btn">
<div class="shadow">
  <h3>Login Here</h3>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5">
<section class="login-section margin-top-30">

<!--<form name="login-form" method="post" action="">-->
<?php $form=$this->beginWidget('CActiveForm', array(
 'id'=>'user_login_form',
 'enableAjaxValidation'=>false,
  'enableClientValidation'=>true,
                'method' => 'POST',
                'clientOptions'=>array(
                     'validateOnSubmit'=>true,
                     'validateOnChange'=>true,
                     'validateOnType'=>false,
  ),
)); ?>




<div id="error-div" class="errorMessage" style="display: none; color:#F00; font-weight:bold;"></div>
  <div class="">
   
    <p class="left-text">User Name:</p>
    <p class="right-field-area margin-left-5">
      <input type="text" value="" name="username" id="email" class="login-text-field" />
    </p>
  </div>
  <div class="">
    <p class="left-text">Password:</p>
    <p class="right-field-area margin-left-5">
      <input type="password" value="" name="password" id="password" class="login-text-field" />
    </p>
  </div>
 <!-- <button type="submit" class="btn btn-success" id="login">Submit</button>-->
 <?php echo CHtml::ajaxSubmitButton(
                                'Login',
    array('/dealer/getLogin'),
                                array(  
                'beforeSend' => 'function(){ 
                                             $("#login").attr("disabled",true);
            }',
                                        'complete' => 'function(){ 
                                             $("#user_login_form").each(function(){ this.reset();});
                                             $("#login").attr("disabled",false);
                                        }',
                   'success'=>'function(data){  
                                           //  var obj = jQuery.parseJSON(data); 
                                            // View login errors!
        
                                             if(data == 1){
												// alert("we are here");
                                         location.href = "dashboard";
                                      }
          else{
                                                $("#error-div").show();
                                                $("#error-div").html(data);$("#error-div").append("");
												return false;
                                             }
 
                                        }' 
    ),
                         array("id"=>"login","class" => "btn btn-success")      
                ); ?>
  

<!--  </form>-->
<?php $this->endWidget(); ?>

</section>
</div>
<!-- section 3 --> 
