<div class="">
<div class="shadow">
<h4 style="float:right;"><a href="buildings_list">Building List</a></h4>
  <h3>Add Building</h3>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5">
<div id="error-div" class="errorMessage" style="display: none; color:#F00;"></div>
<section class="reg-section margin-top-30">
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
    <p class="reg-left-text">Project Name <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <select name="project" id="project">
      <option value="">Select Project </option>
      <?php	
            $res=array();
            foreach($projects as $key){
            echo '<option value="'.$key['id'].'">'.$key['project_name'].'</option>'; 
            }?>
    </select>
    </p>
  </div>
   <!-- <div class="float-left">
    <p class="reg-left-text">Property Type <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <select name="ptype" id="ptype">
      <option value="">Select Property Type</option>
      <?php/*	
            $res=array();
            foreach($ptype as $ptype){
            echo '<option value="'.$ptype['id'].'">'.$ptype['project_name'].'</option>'; 
            }*/?>
    </select>
    </p>
  </div>-->
<div class="float-left">
  <p class="reg-left-text">Building Name<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" name="name" id="name" class="reg-login-text-field" />
  </div>
 
 <?php echo CHtml::ajaxSubmitButton(
                                'Add Building',
    array('property/addbuilding'),
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
 
 <div class="clearfix"></div>
   <span style="color:#FF0000; display:block;" id="error-div"></span>
  
 </section>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>



