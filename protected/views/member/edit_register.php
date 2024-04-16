
<div class="shadow">
  <h1>Registeration Form</h1>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5 float-left">
<section class="reg-section margin-top-30">
<?php $form=$this->beginWidget('CActiveForm', array(
 'id'=>'user_register_form',
 'enableAjaxValidation'=>false,
  'enableClientValidation'=>true,
                'method' => 'POST',
                'clientOptions'=>array(
                     'validateOnSubmit'=>true,
                     'validateOnChange'=>true,
                     'validateOnType'=>false,
  ),
));
$user_data = Yii::app()->session['user_array'];
 ?>
 <?php	
$result = mysql_query("SELECT * FROM my_table");

 ?>
 
<div id="error-div" class="errorMessage" style="display: none;"></div>
  <div class="float-left">
    <p class="reg-left-text">ID <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="<?php echo $user_data['id'];?>" name="id" id="id" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Member Number <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="<?php echo $user_data['membernumber'];?>" name="membernumber" id="membernumber" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">First Name <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="<?php echo $user_data['firstname'];?>" name="firstname" id="first" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Middel Name <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="<?php echo $user_data['middelname'];?>" name="middelname" id="middelname" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Last Name <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="<?php echo $user_data['lastname'];?>" name="lastname" id="lastname" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">S/O-D/O-W/O <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="<?php echo $user_data['sodowo'];?>" name="sodowo" id="sodowo" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">CNIC<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="<?php echo $user_data['cnic'];?>" name="cnic" id="cnic" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Address<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="<?php echo $user_data['address'];?>" name="Address" id="Address" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Email Address <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="<?php echo $user_data['email'];?>" name="email" id="email" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">City<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="<?php echo $user_data['city'];?>" name="city" id="city" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">State<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="<?php echo $user_data['state'];?>" name="state" id="state" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">zip<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="<?php echo $user_data['zip'];?>" name="zip" id="zip" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">country<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" name="country" id="country" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">User Full Name <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" id="user_name" name="name" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Password <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="password" value="" name="password" id="password" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Confirm Password <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="password" value="" name="confirm_password" id="con_password" class="reg-login-text-field" />
    </p>
  </div>
  <div class="checkbox margin-left-144 margin-top-15">
    <input name="agree" type="checkbox" value="1" class="float-left" id="checkbox" />
    <label for="checkbox"></label>
  </div>
  <p class="font-16 float-left margin-top-12 margin-left-5">I agree to the <a href="#" class="link-1 font-16" title="Licence Agreement">Licence Agreement</a></p>
  <?php echo CHtml::ajaxLink(
                                'Register</a>',
    array('/user/create'),
                                array(  
								 'type' => 'POST',
                                        'complete' => 'function(){ 
                                            /* $("#user_register_form").each(function(){ this.reset();});*/
                                             
                                        }',
                   'success'=>'function(data){  
                                             var obj = jQuery.parseJSON(data); 
                                           
        // alert(data);
                                             if(obj.success == 1){
                                         
                                         location.href = "http://localhost/hb/index.php/user/datasource/";
                                      }
          else{
			  									 var obj = jQuery.parseJSON(data);
											
                                                $("#error-div").show();
                                                $("#error-div").html(obj[0]);$("#error-div").append("");
												return false;
                                             }
 
                                        }' 
    ),
                         array("id"=>"login","class" => "register-btn margin-left-144")      
                ); ?>
 <?php $this->endWidget(); ?>
 </section>
<!-- section 3 --> 
