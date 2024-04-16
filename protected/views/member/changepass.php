

<style>



.wc-text .btn-info {

	padding:10px 15px;

	border-radius:5px;

	color:#fff;

	text-decoration:none;

	}

	

.wc-text .btn-info:hover {

	background:#09F;

	}



</style>





<div class="my-content" style="font-size:14px;">

    	

        <div class="row-fluid my-wrapper">

<div class="shadow">

 <div class="span5 pull-right wc-text">





</div>

  <h3>Change Password</h3>

</div>

<!-- shadow -->

<hr noshade="noshade" class="hr-5 float-left">

<?php 

$user_data = Yii::app()->session['user_array'];

 ?>

<div class="float-left">

    <p class="reg-right-field-area margin-left-5">
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

     <table class="table-striped table-bordered table span6"><tr>
	<tr><td style="width:5%;"><b>Enter New Password</b></td><td style="width:5%;"><input type="password" name="newpassword" value=""></td></tr>

	<tr><td style="width:5%;"><b>Confirm New Password</b></td><td style="width:5%;"><input type="password" name="newpassword1" value=""></td></tr>


	<tr><td style="width:5%;"><!--<input type="submit" class="btn btn-primary" name="change" value="Change Password"><-->
     <?php echo CHtml::ajaxSubmitButton(

                                'Change Password',

    array('member/Changepassword'),

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

 
    
    
    
    </td>

	</tr>

</table> 			

  	

    </p>

    <div class="clearfix"></div>

  </div>

  

 </div>



  

