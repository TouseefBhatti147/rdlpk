<script
  src="https://code.jquery.com/jquery-3.5.1.js"
  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
  crossorigin="anonymous"></script>
  
<script>
$(function() {
$( "#fromdatepicker" ).datepicker({ dateFormat: 'dd-mm-yy' });
});
$(function() {
$( "#todatepicker" ).datepicker({ dateFormat: 'dd-mm-yy' });
});
</script>

<div class="">
<div class="shadow">
  <h3>Create Posession Request</h3>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5">
<section class="reg-section margin-top-30">
<?php $projects_data = Yii::app()->session['projects_array']; ?>
<div class="float-left">
<div> </div>
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

<div id="error-div" class="errorMessage" style="display: none; color:#F00; font-weight:bold;"></div>

<div class="clearfix"></div>
<?php foreach($plots as $plots){ ?>
<div class="float-left">
  <p class="reg-left-text">Plot Membership No<font color="#FF0000">*</font></p>
  <p class="reg-right-field-area margin-left-5">
    <input type="text" readonly="readonly"  value="<?php echo $plots['plotno']; ?>" name="plotno" id="plotno" class="reg-login-text-field"  />
      <input type="hidden"  value="<?php echo $plots['plot_id']; ?>" name="plot_id" id="plot_id" class="reg-login-text-field"  />
  </p>
</div>
<div class="float-left">
  <p class="reg-left-text">Owner Name<font color="#FF0000">*</font></p>
  <p class="reg-right-field-area margin-left-5">
    <input type="text" value="<?php echo $plots['name']; ?>" readonly="readonly" name="name" id="name" class="reg-login-text-field" />
  </p>
</div>
<div class="float-left">
  <p class="reg-left-text">CNIC<font color="#FF0000">*</font></p>
  <p class="reg-right-field-area margin-left-5">
    <input type="text" value="<?php echo $plots['cnic']; ?>" readonly="readonly" name="cnic" id="cnic" class="reg-login-text-field" />
  </p>
</div>
<div class="float-left">
  <p class="reg-left-text">Address<font color="#FF0000">*</font></p>
  <p class="reg-right-field-area margin-left-5">
    <input type="text" value="<?php echo $plots['address']; ?>" readonly="readonly" name="address" id="address" class="reg-login-text-field" />
  </p>
</div>
<div class="float-left">
  <p class="reg-left-text">Project Name<font color="#FF0000">*</font></p>
  <p class="reg-right-field-area margin-left-5">
    <input type="text" value="<?php echo $plots['project_name']; ?>" readonly="readonly" name="project" id="project" class="reg-login-text-field" />
  </p>
</div>
<div class="float-left">
  <p class="reg-left-text">Street<font color="#FF0000">*</font></p>
  <p class="reg-right-field-area margin-left-5">
    <input type="text" value="<?php echo $plots['street']; ?>" readonly="readonly" name="street" id="street" class="reg-login-text-field" />
  </p>
</div>
<div class="float-left">
  <p class="reg-left-text">Sector<font color="#FF0000">*</font></p>
  <p class="reg-right-field-area margin-left-5">
    <input type="text" value="<?php echo $plots['sector_name']; ?>" readonly="readonly" name="street" id="street" class="reg-login-text-field" />
  </p>
</div>
<div class="float-left">
  <p class="reg-left-text">Type<font color="#FF0000">*</font></p>
  <p class="reg-right-field-area margin-left-5">
    <input type="text" value="<?php echo $plots['com_res']; ?>" readonly="readonly" name="com_res" id="com_res" class="reg-login-text-field" />
  </p>
</div>
<div class="float-left">
  <p class="reg-left-text">Plot No<font color="#FF0000">*</font></p>
  <p class="reg-right-field-area margin-left-5">
    <input type="text" value="<?php echo $plots['plotno']; ?>" readonly="readonly" name="plot_detail_address" id="plot_detail_address" class="reg-login-text-field" />
  </p>
</div>
<div class="float-left">
  <p class="reg-left-text">Size<font color="#FF0000">*</font></p>
  <p class="reg-right-field-area margin-left-5">
    <input type="text" value="<?php echo $plots['size']; ?>" readonly="readonly" name="size" id="size" class="reg-login-text-field" />
  </p>
</div>
<div class="float-left">
  <p class="reg-left-text"><font color="#FF0000"></font></p>
  <p class="reg-right-field-area margin-left-5">
   <div name="image" id="image" style="width:100px"> 
   <img src="upload_pic/<?php echo $plots['image']; ?>" />
    </div>
  </p>
</div>
<div class="float-left">
  <p class="reg-left-text"><font color="#FF0000"></font></p>
  <p class="reg-right-field-area margin-left-5">
<h5 style="color:#F00;"></h5>
  </p>
</div>


</br>

<div class="float-left" id="building_type1">
  <p class="reg-left-text">Building Type<font color="#FF0000">*</font></p>
  <p class="reg-right-field-area margin-left-5">
    <select name="building_type" id="building_type">
    <option value="">Select Type</option>
    <option value="Member">Member</option>
    <option value="HRL-Reserved">HRL Reserved</option>
    <option value="Nova-Home">Nova Home</option>
    <option value="Others">Others</option>
    </select>
  </p>
</div>

<div class="float-left" id="remarks1">
  <p class="reg-left-text">Remarks<font color="#FF0000">*</font></p>
  <p class="reg-right-field-area margin-left-5">
 <textarea name="remarks" id="remarks"></textarea>
  </p>
  
</div>
<?php }?>
<div class="float-left">

<div id="requested" style="color:#090; visibility:hidden;"><h3>Possession Granted Already</h3></div>
</div>
<div id="button">
<?php echo CHtml::ajaxSubmitButton(
                                'Add Member',
    array('bcd/create'),
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