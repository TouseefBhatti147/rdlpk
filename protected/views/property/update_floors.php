
<div class="shadow">

  <h3>Update Floors</h3>

</div>

<!-- shadow -->
<span style="float:right"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/property/floors_list"  class="btn-info button">Back To List</a></span>
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

            foreach($update_floors as $key){

				

     echo ' 

  
 <div class="float-left">

    <p class="reg-left-text">Project Name <font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">
<input type="hidden"  value="'.$key['project_id'].'" name="project_id" id="project_id" class="reg-login-text-field" />
      <input type="text" readonly="readonly" value="'.$key['project_name'].'" class="reg-login-text-field" />

    </p>

  </div>
 <div class="float-left">

    <p class="reg-left-text">Building Name <font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">
<input type="hidden"  value="'.$key['bname'].'" name="bname" id="bname" class="reg-login-text-field" />
      <input type="text" readonly="readonly" value="'.$key['bname'].'" class="reg-login-text-field" />
<input type="hidden"  value="'.$_GET['id'].'" name="fid" id="fid" class="reg-login-text-field" />
<input type="hidden"  value="'.$key['building_id'].'" name="building_id" id="building_id" class="reg-login-text-field" />
    </p>

  </div>
  <div class="float-left">

    <p class="reg-left-text">Floor Name<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" value="'.$key['name'].'" name="name" id="name" class="reg-login-text-field" />

    </p>

  </div>
    <div class="float-left">
    <p class="reg-left-text">Floor Name<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="'.$key['no_of_shops'].'" name="no_of_shops" id="no_of_shops" class="reg-login-text-field" />
    </p>
  </div>
  ';	}?>

 <?php echo CHtml::ajaxSubmitButton(

                                'Update Floors',

    array('property/update_flor'),

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

