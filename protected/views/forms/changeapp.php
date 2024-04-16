</div><section class="reg-section margin-top-30">

   <div id="error-div" class="errorMessage" style="display: none; color:#F00;"></div>
<?php $form=$this->beginWidget('CActiveForm', array(
 'id'=>'plots1',
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
  <h3>New Applicant Information </h3>
  <?php $res=array();
            foreach($plots as $plo){
				
     echo ' <input type="hidden" value="'.$plo['id'].'" name="id" id="id" class="reg-login-text-field" />';?>
     <input type="hidden" value="<?php echo $plo['project_id'];?>" name="project_id" />
  
   <input type="hidden" value="<?php echo $plo['scode'].'-'.$plo['formno'].'-'.$plo['scode1'];?>" readonly="readonly" name="name" id="name"  />
 <div class="float-left">
    <p class="reg-left-text">Name<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input value="" name="name" id="name" type="text" />
</p>
 </div>
 <div class="float-left">
    <p class="reg-left-text">Father/Spouse Name<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input value="" name="sodowo" id="sodowo" type="text" />
</p>
 </div>
<script type="text/javascript">



function testPhone(objNpt){



 var n=objNpt.value.replace(/[^\d]+/g,'');// replace all non digits



 if (n.length!=13) {



  document.getElementById('rsp').innerHTML="Please Enter 13 Digit CNIC Number without spaces/Slashes !";



  return;}



  document.getElementById('rsp').innerHTML=""; 



 objNpt.value=n.replace(/(\d\d\d\d\d)(\d\d\d\d\d\d\d)(\d)/,'$1$2$3');// format the number



}



</script> 
 <div class="float-left">
    <p class="reg-left-text">CNIC<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input onBlur="testPhone(this)" value="" name="cnic" id="cnic" type="text" />
</p> <p id="rsp" style="color:#F00;"></p>
 </div>
 <div class="float-left">
    <p class="reg-left-text">Phone(Office)<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input value="" name="phone" id="phone" type="text" />
</p>
 </div>
 <div class="float-left">
    <p class="reg-left-text">Phone(Residence)<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input value="" name="phoneres" id="phoneres" type="text" />
</p>
 </div>
 <div class="float-left">
    <p class="reg-left-text">Mobile<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input value="" name="mobile" id="mobile" type="text" />
</p>
 </div>
 <div class="float-left">
    <p class="reg-left-text">Email<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input value="" name="email" id="email" type="text" />
</p>
 </div>
 <div class="float-left">
    <p class="reg-left-text">Country<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <select name="country" id="country">
        <option value="">Select Country </option>
        <?php	



            $res=array();



            foreach($country as $key){



            echo '<option value="'.$key['id'].'">'.$key['country'].'</option>'; 



            }?>
      </select>
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">City<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <select name="city_id" id="city_id">
        <option value="city">Select City </option>
      </select>
    </p>
  </div>
 <div class="float-left">
    <p class="reg-left-text">Address<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input value="" name="address" id="address" type="text" />
</p>
 </div>
 <div class="float-left">
    <p class="reg-left-text">Profession<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
    <select name="profession" id="profession">
  
    <option>---N/A---</option>
<option>Businessman</option>
<option>Army Servant</option>
<option>Govt. Employee</option>
<option>Private Employee </option>
<option>Engineer </option>
<option>Doctor</option>
<option>Teacher /  Professor</option> 
<option>Lawyer /  Advocate     </option>
<option>Journalist</option>
<option>Politician </option>
<option>Artist</option>
<option>Farmer / Landlord</option>
<option>Others</option> 

      
    </select>
</p>
 </div>
 
   <?php }?>
   <?php echo CHtml::ajaxSubmitButton(
                         'Update',
    array('forms/Updatebook'),
	                        array(  
                'beforeSend' => 'function(){ 
                                             $("#submit").attr("disabled",true);
            }',

                                        'complete' => 'function(){ 
                                             $("#plots1").each(function(){ });
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
									 array("id"=>"login1","class" => "btn-info pull-right")      ); ?>
  <?php $this->endWidget(); ?>
<script>
 $("#country").change(function()
 		{
         	select_city($(this).val());
		   });
function select_city(id)
{
$.ajax({
      type: "POST",
      url:    "ajaxRequest3?val1="+id,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var listItems='';
	$(json).each(function(i,val){
	listItems+= "<option value='" + val.id + "'>" + val.city +" </option>";
});listItems+="";
$("#city_id").html(listItems);
          }
});
}
</script>
 </div>
 </section>