<div class="">

<div class="shadow">

  <h3>Add Target</h3>

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

   <div class="float-left" >

 <p class="reg-left-text">Year <font color="#FF0000">*</font></p>

  <select name="year" id="year">
<option value="">Select Year</option>
  			<option value="2014">2014</option>
            <option value="2015">2015</option>
            <option value="2016">2016</option>
            <option value="2017">2017</option>
            <option value="2018">2018</option>

  </select></div>

   <div class="float-left" >

 <p class="reg-left-text">Month<font color="#FF0000">*</font></p>

 <select name="month" id="month">
<option value="">Select Month</option>
  			<option value="01">January</option>
            <option value="02">February</option>
            <option value="03">March</option>
            <option value="04">April</option>
            <option value="05">May</option>
            <option value="06">June</option>
            <option value="07">July</option>
            <option value="08">August</option>
            <option value="09">September</option>
            <option value="10">October</option>
            <option value="11">November</option>
            <option value="12">December</option>
            

  </select>
  </div>
 

   <div class="float-left" >

 <p class="reg-left-text">Target<font color="#FF0000">*</font></p>

<input type="text" name="target" value="" />  </div>
 
  
 <?php echo CHtml::ajaxSubmitButton(

                                'Add Target',

    array('/reciept/Add_targ'),

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

 </section>

<!-- section 3 --> 

<!-- VALIDATION START--> 


