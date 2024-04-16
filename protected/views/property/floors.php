<div class="">
<div class="shadow">
  <h3>Add Floor</h3>
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
 <p class="reg-left-text">Project Name <font color="#FF0000">*</font></p>
  <select name="project_id" id="project_id">
<option value="">Select Project</option>
  			<?php	 
            $res=array();
            foreach($projects as $key){
            echo '<option value="'.$key['id'].'">'.$key['project_name'].'</option>'; 
            }?>
  </select>
  </div>

<div class="float-left">
  <p class="reg-left-text">Building <font color="#FF0000">*</font></p>
  <select name="building_id" id="building_id">
  <option value="">Select Building</option>
  </select>
  </div>
  <div class="float-left">
  <p class="reg-left-text">Floor Name<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" name="floor_name" id="floor_name" class="reg-login-text-field" />
  </div>
    <div class="float-left">
  <p class="reg-left-text">No Of Shops/Office<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" name="no_of_shops" id="no_of_shops" class="reg-login-text-field" />
  </div>
 <?php echo CHtml::ajaxSubmitButton(
                                'Add Floor',
    array('property/addflor'),
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

<!-- section 3 --> 

<!-- VALIDATION START--> 


<script>
    $(document).ready(function()
     {  	
       $("#project_id").change(function()
           {
         	select_building($(this).val());
		   });
     });
function select_building(id)
{
$.ajax({
      type: "POST",
      url:    "AjaxRequest4?val1="+id,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var listItems='';
	listItems+= "<option value=''>Select Building</option>";
	$(json).each(function(i,val){
	
	listItems+= "<option value='" + val.id + "'>" + val.name + "</option>";
});listItems+="";
$("#building_id").html(listItems);
          }
    });
}
</script>