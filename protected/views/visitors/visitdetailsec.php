<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.js"></script>
<script>

$(function() {
$( "#todatepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
});$(function() {
$( "#booking_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
});

</script>

<style>
.reg-login-text-field{
	
	width:180px;}
	select{
		
		width:180px;}
		.reg-login-text-field11{
			width:50px;}
</style>
 
<div class="">
<div class="shadow">
  <h3> Add Visit Detail</h3>
</div>
<!-- shadow --> <div class="clearfix"></div>
   <b>Visitor Detail</b>
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

<div id="error-div" class="errorMessage" style="display: none; color:#F00;"></div>
  <?php foreach($visitors as $vis){
	  
	  
	  ?>
     <input type="hidden" value="<?php echo $vis['vid'];?>" name="id" id="id" class="reg-login-text-field" />
   
  <div class="float-left">
    <p class="reg-left-text">Visitor Name <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input readonly="readonly" type="text" value="<?php echo $vis['vname'];?>" name="name" id="name" class="reg-login-text-field" />
    </p>
  </div> 
 <div class="float-left">
  <p class="reg-left-text">Profession<font color="#FF0000">*</font></p>
  <select name="profession" id="profession" disabled="disabled">
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
      <input readonly="readonly" type="text" value="<?php echo $vis['email'];?>" name="email" id="email" class="reg-login-text-field" />
    </p>
  </div>
   <div class="float-left">
    <p class="reg-left-text">Contact No.<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" readonly="readonly" value="<?php echo $vis['contactno'];?>" name="contactno" id="contactno" class="reg-login-text-field" />
    </p>
  </div>
    <div class="float-left" >
  <p class="reg-left-text">City<font color="#FF0000">*</font></p>
  <p class="reg-right-field-area margin-left-5">
   <input type="text" disabled="disabled" value="<?php echo $vis['city'];?>" name="city" id="city" class="reg-login-text-field" /> </p>
  </div>
    <div class="float-left" >
  <p class="reg-left-text">Reffred By<font color="#FF0000">*</font></p>
  <p class="reg-right-field-area margin-left-5">
   <input readonly="readonly" type="text" value="<?php echo $vis['refered_by'];?>" name="refered_by" id="refered_by" class="reg-login-text-field" /> </p>
  </div>
   <div class="float-left" >
  <p class="reg-left-text">Reference<font color="#FF0000">*</font></p>
  <p class="reg-right-field-area margin-left-5">
   <input readonly="readonly" type="text" value="<?php echo $vis['reference'];?>" name="reference" id="reference" class="reg-login-text-field" /> </p>
  </div>
  <!--Visitors Detail End-->
 
  <div class="clearfix"></div>
   <b>Interest & Booking</b>
<hr noshade="noshade" class="hr-5">
   
   <div class="float-left" >
  <p class="reg-left-text">Property Type<font color="#FF0000">*</font></p>
 <p class="reg-right-field-area margin-left-5">
  <select name="com_res" id="com_res">
 			<option value="">Select Type </option>
            <option value="Commercial">Commercial</option>
            <option value="Residential">Residential</option>
  </select> </p>
  </div>

 

   <div class="float-left" >
  <p class="reg-left-text">Booking Date.<font color="#FF0000">*</font></p>
  <p class="reg-right-field-area margin-left-5">
   <input type="text" value="" name="booking_date" id="booking_date" class="reg-login-text-field" /> </p>
  </div>
   
  <div class="float-left" >
  <p class="reg-left-text">Type<font color="#FF0000">*</font></p>
 <p class="reg-right-field-area margin-left-5">
  <select name="type" id="type">
 			<option value="">Select Interest/Booking</option>
            <option value="Interest">Interest</option>
            <option value="Booking">Booking</option>
  </select> </p>
  </div>
  <div class="float-left" >
  <p class="reg-left-text">Size & No. Of Plots<font color="#FF0000">*</font></p>
<table class="table-responsive">
<tr > <?php 
	$res=array();
	$i = 1;
	foreach($size as $key1)
	{
	?><td style="width:145px;">
		
    <input id="cat_<?php echo $key1['id'];?>" name="cat_<?php echo $key1['id'];?>" type="checkbox" value="<?php echo $key1['id'];?>" />  &nbsp;<?php echo $key1['size'];?>
	<input type="text" value="" name="no_of_plots_<?php echo $key1['id'];?>" id="no_of_plots_<?php echo $key1['id'];?>" class="reg-login-text-field11" />
	</div></td>
	<?php $i++;
	}
	?></table>
 
  <div class="clearfix"></div>
   <b>Visit Detail</b>
<hr noshade="noshade" class="hr-5">
   
   <div class="float-left" >
  <p class="reg-left-text">Next Visit<font color="#FF0000">*</font></p>
  <p class="reg-right-field-area margin-left-5">
   <input name="next_visit"  type="text" placeholder="Enter Next Visit Date" class="new-input" id="todatepicker">
  </div>
  
  <div class="float-left" >
  <p class="reg-left-text">Remarks<font color="#FF0000">*</font></p>
  <p class="reg-right-field-area margin-left-5">
   <input type="text" value="" name="remarks" id="remarks" class="reg-login-text-field" /> </p>
  </div>
  <div class="float-left" >
  <p class="reg-left-text">Visit Type<font color="#FF0000">*</font></p>
 <p class="reg-right-field-area margin-left-5">
  <select name="vtype" id="vtype">
           <option value="">Select Visit Type</option>
            <option value="direct">Direct</option>
           <option value="visitor">Visitor</option>
            <option value="caller">Caller</option>
  </select> </p>
  </div>
  
   <?php }?>
  
  <?php echo CHtml::ajaxSubmitButton(
                         'Add Visitor Detail',
    array('visitors/add_visit_detail'),
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
 