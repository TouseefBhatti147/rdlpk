<div class="">

<div class="shadow">

  <h3>Merge Plots</h3>

</div>

<!-- shadow -->

<hr noshade="noshade" class="hr-5 ">

<section class="reg-section margin-top-30">

<h4>File Information</h4>
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
<input value="Plot" name="type" id="type" type="hidden" />
  <div class="float-left">
  <p class="reg-left-text">Project  <font color="#FF0000">*</font></p>

  <?php $res=array();
            foreach($plots as $plo){	
     echo '
   <input type="hidden" value="'.$plo['id'].'" name="id" id="id" class="reg-login-text-field" />';?>
  <input type="text" name="" value="<?php echo $plo['project_name']?>" readonly="" />
<input type="hidden" name="project_id" value="<?php echo $plo['project_id']?>" readonly="project_id" />
  </div>

  <div class="float-left">
  <p class="reg-left-text">Street # <font color="#FF0000">*</font></p>
   <input type="hidden" name="street_id" value="<?php echo $plo['street_id']?>" readonly="street_id" />
<input type="text" name="" value="<?php echo $plo['street']?>" readonly="" />
 
  </div>

	<div class="float-left">
    <p class="reg-left-text">Plot No <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="<?php echo $plo['plot_detail_address'];?>" name="" id="" class="reg-login-text-field" readonly />
    </p>
  </div> 
  <div class="float-left">
    <p class="reg-left-text">Plot Diemension<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" readonly="readonly" value="<?php echo $plo['plot_size'];?>" name="plot_size" id="plot_size" class="reg-login-text-field" />
    </p>
  </div>
   <div class="float-left">
    <p class="reg-left-text">Plot Size(Unit)<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5"> 
        
        <input type="hidden" name="size2" value="<?php echo $plo['size2']?>"  />
		 <input type="text" name="size" value="<?php echo $plo['size']?>" readonly="" />

        
    </p>
</div>
   <div class="float-left" >
  <p class="reg-left-text">Type<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
  
  <input type="text" name="com_res" value="<?php echo $plo['com_res']?>" readonly="readonly" />
  
  
</p>
  </div> 
  <div class="float-left" >
  <p class="reg-left-text">Sector<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
   <input type="text" value="<?php echo $plo['sector']?>" readonly="readonly" name="sector" id="sector" class="reg-login-text-field" />
</p>
  </div>
   <div class="float-left" >
  <p class="reg-left-text">Price<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
   <input readonly="readonly" type="text" value="<?php echo $plo['price']?>" name="price" id="price" class="reg-login-text-field" />
</p>  
  </div>
<div class="float-left" >
  <p class="reg-left-text">Develop/Undevelop<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
    <input type="text" name="cstatus" value="<?php echo $plo['cstatus']?>" readonly="readonly" />
  
  
</p> 
  </div>
<div class="float-left" >
  <p class="reg-left-text"><h4>Plot Information</h4></p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Entre Plot No <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" name="plot_detail_address" id="plot_detail_address" class="reg-login-text-field"  />
    </p>
  </div>
  <?php } ?>
  <?php echo CHtml::ajaxSubmitButton(
                         'Merge Plot',
    array('files/merge'),
                                array(  
                'beforeSend' => 'function(){ 
                                             $("#submit").attr("disabled",true);
            }',                                        'complete' => 'function(){ 
                                             $("#plots").each(function(){ });
                                             $("#submit").attr("disabled",false);
                                        }',
                   'success'=>'function(data){  
                                           //  var obj = jQuery.parseJSON(data); 
                                            // View login errors!
                                             if(data == 1){
												// alert("we are here");
                                         location.href = "http://rdlpk.com/index.php/user/";
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

 