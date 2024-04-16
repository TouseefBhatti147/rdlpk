<style>
body
		{
			overflow:scroll;
			height:100px;
		}
</style>
<div id="page-content" class="clearfix">
<div class="page-header position-relative">
<h1>Message<small><i class="icon-double-angle-right"></i> Send Message to Admin</small></h1>
</div>
<!--/page-header-->

<div class="row-fluid"> 
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



<div class="control-group">
<label class="control-label" for="form-field-1">Your Subject</label>
<div class="controls">
<input type="subject" id="form-field-1" class="span6" name="subject" placeholder="Enter your subject">
</div>
</div>
<div class="control-group">
<label class="control-label" for="form-field-1">Your Message</label>
<div class="controls">
<textarea id="message" name="message" class="autosize-transition span6" style="overflow: hidden; overflow-wrap: break-word; resize: horizontal; height: 58px;"></textarea>

</div>
</div>
<div id="error-div" class="errorMessage" style="display: none; color:#F00;"></div>


<div class="form-actions">
<?php echo CHtml::ajaxSubmitButton(
                                'Send Message',
    array('member/query'),
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
