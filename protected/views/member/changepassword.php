<style>
body
		{
			overflow:scroll;
			height:100px;
		}
</style>
<div class="page-content">

	<div class="page-header">
		<h1>Change Password</h1>

	</div><!-- /.page-header -->

	<div class="space-6"></div>
<div class=""> 
<!-- PAGE CONTENT BEGINS HERE -->
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
<div class="control-group">
<label class="control-label" for="form-field-1">Old Password</label>
<div class="controls">
<input type="password" name="oldpassword" id="form-field-1" placeholder="Enter Old Password">
</div>
</div>
<div class="row">
                   <div class="col-md-4 col-xs-12"><div class="alert alert-info ">Only fill new password if you want to change it!</div></div>
             </div>
<div class="control-group">
<label class="control-label" for="form-field-1">New Password</label>
<div class="controls">
<input type="password" id="form-field-1" name="newpassword" placeholder="Enter New Password">
</div>
</div>
<div class="control-group">
<label class="control-label" for="form-field-1">Confirm New Password</label>
<div class="controls">
<input type="password" name="cnewpassword" id="form-field-1" placeholder="Enter Confirm New Password">
</div>
</div>
<div id="error-div" class="errorMessage" style="display: none; color:#F00;"></div>


<div class="form-actions">
<?php echo CHtml::ajaxSubmitButton(
                                'Change Password',
    array('member/Changepasswrd'),
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
                         array("id"=>"login","class" => "btn btn-info")      
                ); ?>

     
<button class="btn" type="reset"><i class="icon-undo"></i> Reset</button>
</div>
<div class="hr"></div>

<?php $this->endWidget(); ?>


<!-- PAGE CONTENT ENDS HERE --> 
</div>
<!--/row--> 
</div>
</div>
<!-- /.main-content-inner -->
</div>
