<script src="//code.jquery.com/jquery-1.10.2.js"></script>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.js"></script>



<script>

$(function() {

$( "#fromdatepicker" ).datepicker({ dateFormat: 'dd-mm-yy' });

});

$(function() {

$( "#todatepicker" ).datepicker({ dateFormat: 'dd-mm-yy' });

});

</script>

<div class="shadow">
  <h3>Discount</h3>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5 ">
<section class="reg-section margin-top-30">
<div id="error-div" class="errorMessage" style="display: none; color:#F00;"></div>

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

	
    <?php 
	$connection = Yii::app()->db; 
	$sql_member = "SELECT * from discnt where ms_id='".$_REQUEST['id']."'"; 
	$result_members = $connection->createCommand($sql_member)->queryRow();
	if($result_members==''){
	?>
    
   <div class="float-left">
    <p class="reg-left-text">Total Discount<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="number" value="" name="total" id="total" class="reg-login-text-field" />
    </p>
  </div>
<div class="float-left">
    <p class="reg-left-text">Details<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
   <input name="details"  type="text" placeholder="" class="reg-login-text-field" >
    </p>
  </div>

  	<?php }else{ ?>
   
    	  <div class="float-left">
    <p class="reg-left-text">Total Discount<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="number" value="<?php echo $result_members['discount'];?>" name="total" id="total" class="reg-login-text-field" />
    </p>
  </div>
<div class="float-left">
    <p class="reg-left-text">Details<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
   <input name="details" value="<?php echo $result_members['details'];?>"  type="text" placeholder="" class="reg-login-text-field" >
    </p>
  </div>
  <?php }?>
     <input type="hidden" name="pid" value="<?php echo $_REQUEST['id'];?>" />

  <?php echo CHtml::ajaxSubmitButton(

                                'Apply',

    array('discount1'),
                   array(  
                'beforeSend' => 'function(){ 
                                             $("#submit").attr("disabled",true);
            }',
                                        'complete' => 'function(){ 
                                             $("#user_login_form").each(function(){ this.reset();});
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
                         array("id"=>"login","class" => "btn-info pull-right")); ?>

  <?php $this->endWidget(); ?>
  <script>
  $(document).ready(function()
     {  	
       
       $("#charges_id").change(function()
           {
         	select_city($(this).val());
		   });
     });

function select_city(id)
{
$.ajax({
      type: "POST",
      url:    "ajaxRequest31?val1="+id,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var listItems='';
	$(json).each(function(i,val){
	listItems+= "<option value='" + val.id + "'>" + val.total +" </option>";

});listItems+="";
$("#city_id").html(listItems);
          }
});

}
</script>

  
  		
          