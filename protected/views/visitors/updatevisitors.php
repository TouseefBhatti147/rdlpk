<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.js"></script>
<script>

$(function() {
$( "#todatepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
});$(function() {
$( "#reg_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
});

</script>

<div class="">
<div class="shadow">
  <h3>Edit Visitors</h3>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5 ">
<section class="reg-section margin-top-30">
<?php $form=$this->beginWidget('CActiveForm', array(
 'id'=>'plots',
 'enableAjaxValidation'=>false,
'htmlOptions' => array('enctype' => 'multipart/form-data'),
  'enableClientValidation'=>true,
                'method' => 'POST',
				'clientOptions'=>array(
			    'validateOnSubmit'=>true,
		        'validateOnChange'=>true,
				'stateful'=>true, 
	            'validateOnType'=>false,),
)); ?>
<?php 
if(isset($_REQUEST['id']) && $_REQUEST['id']!==''){
	echo '<input name="corg" id="corg" type="hidden" value="'.$_REQUEST['id'].'" />';
	}
?>
<input value="Plot" name="type" id="type" type="hidden" />
<div id="error-div" class="errorMessage" style="display: none; color:#F00;"></div>
  <?php foreach($visitors as $vis){
	  
	  
	  ?>
     <input type="hidden" value="<?php echo $vis['vid'];?>" name="id" id="id" class="reg-login-text-field" />
   
  <div class="float-left">
    <p class="reg-left-text">Visitor Name <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="<?php echo $vis['vname'];?>" name="name" id="name" class="reg-login-text-field" />
    </p>
  </div> 
 <div class="float-left">
  <p class="reg-left-text">Profession<font color="#FF0000">*</font></p>
  <select name="profession" id="profession">
   <option value="<?php echo $vis['pid'];?>"><?php echo $vis['profession'];?></option>
 			 <?php	
            $res=array();
            foreach($profession as $prof){
            echo '
			<option value="'.$prof['id'].'">'.$prof['profession'].'</option>'; 
            }?>
  </select>
  </div>
   <div class="float-left">
    <p class="reg-left-text">Email<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="<?php echo $vis['email'];?>" name="email" id="email" class="reg-login-text-field" />
    </p>
  </div>
   <div class="float-left">
    <p class="reg-left-text">Contact No.<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="<?php echo $vis['contactno'];?>" name="contactno" id="contactno" class="reg-login-text-field" />
    </p>
  </div>
  

   <div class="float-left" >
  <p class="reg-left-text">City<font color="#FF0000">*</font></p>
  <p class="reg-right-field-area margin-left-5">
   <input type="text" value="<?php echo $vis['city'];?>" name="city" id="city" class="reg-login-text-field" /> </p>
  </div>
    <div class="float-left" >
  <p class="reg-left-text">Reffred By<font color="#FF0000">*</font></p>
  <p class="reg-right-field-area margin-left-5">
   <input type="text" value="<?php echo $vis['refered_by'];?>" name="refered_by" id="refered_by" class="reg-login-text-field" /> </p>
  </div>
  
   <div class="float-left" >
  <p class="reg-left-text">Reference<font color="#FF0000">*</font></p>
  <p class="reg-right-field-area margin-left-5">
   <input type="text" value="<?php echo $vis['reference'];?>" name="reference" id="reference" class="reg-login-text-field" /> </p>
  </div>
  
   <div class="float-left" >
  <p class="reg-left-text">Date<font color="#FF0000">*</font></p>
  <p class="reg-right-field-area margin-left-5">
   <input type="text" value="<?php echo $vis['reg_date'];?>" name="reg_date" id="reg_date" class="reg-login-text-field" /> </p>
  </div>
   <?php }?>
  
  <?php echo CHtml::ajaxSubmitButton(
                         'Edit Visitors',
    array('visitors/update'),
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
                                        }' ),
									 array("id"=>"login","class" => "btn-info pull-right")      ); ?>
  <?php $this->endWidget(); ?>
 </div>
 </section>
<!-- section 3 -->
<!--VALIDATION START-->
 

