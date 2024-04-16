<div class="shadow">
  <h3>Update City</h3>
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
            foreach($pla as $key){	
?>
  <div class="float-left">

    <p class="reg-left-text">Country Name <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">   
  <select name="country_id" id="country_id">
   <option value="<?php echo $key['country_id']; ?>"><?php echo $key['country']; ?></option>
 			 
            <?php $res=array();

            foreach($country as $key1){
				

            echo '
			
			
			<option value="'.$key1['id'].'">'.$key1['country'].'</option>'; 

            }?>

  </select>

    </p>

  </div>
  
 <div class="float-left">
    <p class="reg-left-text">City Name.<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <input type="text" value="<?php echo $key['city'];?>" name="city" id="city" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">

    <p class="reg-left-text">Zip Code. <font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" value="<?php echo $key['zipcode'];?>" name="zipcode" id="zipcode" class="reg-login-text-field" />

    </p>

  </div>

  <div class="float-left">
<input type="hidden" id="ide" name="ide" value="<?php echo $key['id']; ?>"/>
</div>
<?php
	 }?>

  

 

   	

	
 <?php echo CHtml::ajaxSubmitButton(

                                'Update',

    array('country/cityupdate'),

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

