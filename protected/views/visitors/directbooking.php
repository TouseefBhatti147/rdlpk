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
  <h3> Add Direct Booking</h3>
</div>
<!-- shadow --> <div class="clearfix"></div>
   <b>Refrence Detail</b>
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
  
  <div class="float-left">
    <p class="reg-left-text">Name <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input  type="text" value="" name="name1" id="name1" class="reg-login-text-field" />
    </p>
  </div> <div class="float-left">
  <p class="reg-left-text">Sale Center<font color="#FF0000">*</font></p>
  <select name="center" id="center">
  
 			 <?php	
            $res=array();
            foreach($center as $center){
            echo '
			<option value="'.$center['id'].'">'.$center['name'].'</option>'; 
            }?>
  </select>
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
  
<hr noshade="noshade" class="hr-5">
   
   
  
  <?php echo CHtml::ajaxSubmitButton(
                         'Add Direct Booking',
    array('visitors/add_direct_booking'),
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
 