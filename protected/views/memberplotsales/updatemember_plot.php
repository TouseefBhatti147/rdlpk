

<div class="">

  <div class="shadow">

    <h3>Update Membership No.</h3>

  </div>

  <!-- shadow -->

  <hr noshade="noshade" class="hr-5">

  <section class="reg-section margin-top-30">

 

  <div class="float-left">

   <div>

	

	

		</div>
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




<div id="error-div" class="errorMessage" style="display: none; color:#F00;"></div>



 <?php 

    

	foreach($plot as $key){

	

 ?>  

  <input type="hidden" name="plot_id" id="plot_id" value="<?php echo $key['id']?>" />

     

     <div class="float-left">

    <p class="reg-left-text">Project <font color="#FF0000">*</font></p>

 <input type="text" name="project" readonly="readonly" id="project" value="<?php echo $key['project_name']?>" />

 

    </div>

    <div class="float-left">

      <p class="reg-left-text">Street #<font color="#FF0000">*</font></p>

   <input type="text" name="street_id" id="street_id" readonly="readonly" value="<?php echo $key['street']?>" />



</div>

  <div class="float-left">

    <p class="reg-left-text">Plot No <font color="#FF0000">*</font></p>

   

       <input type="text" readonly="readonly" name="plot_detail_address" id="plot_detail_address" value="<?php echo $key['plot_detail_address'];?>" />



  </div>

  <div class="float-left">

    <p class="reg-left-text">Plot Membership No<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" value="<?php echo $key['plotno']?>" name="plotno" id="plotno" class="reg-login-text-field" />

      
    </p>

  </div>

 

  <div class="float-left">

    <p class="reg-left-text">CNIC<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" readonly="readonly" value="<?php echo $key['cnic']?>" name="cnic" id="cnic" class="reg-login-text-field" />

    </p>

  </div>

 <div class="">

    <img name="image" id="image"/>

      

  </div>

   <div class="float-left">

    <p class="reg-left-text">Installment(After Months)<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" value="<?php echo $key['noi']?>" readonly="readonly" name="noi" id="noi" class="reg-login-text-field" />

    </p>

  </div>

   <div class="float-left">

    <p class="reg-left-text">Installment Plan<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">
   <input name="insplan" value="<?php echo $key['insplan'];?>"  type="text"  readonly="readonly" id="insplan">

    </p>

  </div>
<?php }?>

   
  <?php echo CHtml::ajaxSubmitButton(
                                'Update',
    array('updatemem_plot'),
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
                         array("id"=>"submit","class" => "btn-info pull-right")      
                ); ?>
  <?php $this->endWidget(); ?>

   </div>

   
 

  

  <!--VALIDATION START-->

 






  

  

   

</div>

</section>

<!-- section 3 --> 

