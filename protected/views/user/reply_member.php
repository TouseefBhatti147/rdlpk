<div class="">
  <div class="shadow">
    <h3>Reply Message</h3>
  </div>
  
  <!-- shadow -->
  
  <hr noshade="noshade" class="hr-5 ">
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
  <div id="error-div" class="errorMessage" style="display: none;"></div>
  <input  type="hidden" name="qid" id="qid" value="<?php echo $_REQUEST['qid'];?>"  />
  <div class="float-left">
    <p class="reg-left-text">Title<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input  type="text" name="title" id="title"  />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Message<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <textarea name="message"></textarea>
    </p>
  </div>
    <div style="visibility:hidden;" class="float-left" >
    <p class="reg-left-text">Member Name<font color="#FF0000">*</font></p>
    <?php $id=$_GET['id'];?>
    <input  type="text" name="user_id" id="user_id"  value="<?php echo $id;?>" />
  </div>
  <?php echo CHtml::ajaxSubmitButton(

                                'Send Message',

    array('message'),

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
}'), 
										array("id"=>"login","class" => "btn-info pull-right")      
                ); ?>
  <?php $this->endWidget(); ?>
  
</div>
</div>
</div>
</section>

<!-- section 3 --> 

<script>



$(document).ready(function()

{



$("#project_id").change(function()

{

select_street($(this).val());

});





});





function select_street(id)

{

$.ajax({

type: "POST",

url:    "ajaxRequest?val1="+id,

contenetType:"json",

success: function(jsonList){var json = $.parseJSON(jsonList);

var listItems='';

$(json).each(function(i,val){

listItems+= "<option value='" + val.id + "'>" + val.street + "</option>";





// $.each(val,function(k,v){

//     console.log(k+" : "+ v);

//});

});listItems+="";



$("#street_id").html(listItems);

}//,

//error: function(xhr){

//alert("failure"+xhr.readyState+this.url)



//}

});

}

</script> 
