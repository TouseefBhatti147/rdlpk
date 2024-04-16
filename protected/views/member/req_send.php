
<div class="shadow">
  
</div>

<hr noshade="noshade" class="hr-5 float-left">
<section class="reg-section margin-top-30">
<?php $form=$this->beginWidget('CActiveForm', array(
 'id'=>'member_register_form',
 'enableAjaxValidation'=>false,
  'enableClientValidation'=>true,
                'method' => 'POST',
                'clientOptions'=>array(
                     'validateOnSubmit'=>true,
                     'validateOnChange'=>true,
                     'validateOnType'=>false,
  ),
)); ?>
  
  
  
  

            
                        
                    <h3>Transfer Has Been Send</h3>    
                       
                         
  
  
  
  <?php echo CHtml::ajaxLink(
                                'Register</a>',
    array('/member/create'),
                                array(  
								 'type' => 'POST',
                                        'complete' => 'function(){ 
                                            /* $("#member_register_form").each(function(){ this.reset();});*/
                                             
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
  
 <!-- <a href="#" class="register-btn margin-left-144"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/register-btn.png" alt="nav" title="Register"></a>-->
 <?php $this->endWidget(); ?>
 </section>