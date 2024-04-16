<div class="">

<div class="shadow">

  <h3>Add Street</h3>

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
 <p class="reg-left-text">Project ID <font color="#FF0000">*</font></p>
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
  <p class="reg-left-text">Block Name <font color="#FF0000">*</font></p>
  <select name="block" id="block">
  <option value="">Select Block Name</option>

  </select>
  </div>
<div class="float-left" >

 <p class="reg-left-text">Sector <font color="#FF0000">*</font></p>

  <select name="sector_id" id="sector_id">
<option value="">Select Sector</option>
  			

  </select>

  </div>
  <div class="float-left">

  <p class="reg-left-text">Street<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" name="street" id="street" class="reg-login-text-field" />

  </div>

 

 
  
 <?php echo CHtml::ajaxSubmitButton(

                                'Add Street',

    array('streets/create'),

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

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<script>

    $(document).ready(function()
     {  	
       $("#project_id").change(function()
           {
         	select_block($(this).val());
		   });
       $("#block").change(function()
           {
            select_sector($(this).val());
		   });
    
     });
	  function select_block(id)
{
$.ajax({
      type: "POST",
      url:    "ajaxBlock?val1="+id,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var listItems='';
	listItems+= "<option value=''>Select Block</option>";
	$(json).each(function(i,val){
	
	listItems+= "<option value='" + val.id + "'>" + val.block_name + "</option>";
});listItems+="";
$("#block").html(listItems);
          }
    });
}

function select_sector(id)
{
	var pro=$("#project_id").val();
	var blk=$("#block").val();
$.ajax({
      type: "POST",
     /// url:    "ajaxRequest?val1="+id,
	  url:    "ajaxRequest?pro="+pro+"&&blk="+blk,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var listItems='';
	listItems+= "<option value=''>Select Sector</option>";
	$(json).each(function(i,val){
	
	listItems+= "<option value='" + val.id + "'>" + val.sector_name + "</option>";
});listItems+="";
$("#sector_id").html(listItems);
          }
    });
}

function validateForm(){

	

	$("#error-project").hide();

	$("#error-street").hide();

	

	//	var x=document.forms["form"]["firstname"].value;

	var k = $("#project_id").val();

	var x = $("#street").val();

	



var counter=0;



if (k==null || k=="")

  {

  $("#error-project").html("Project Required");

  $("#error-project").show();

  counter =1;

  }

if (x==null || x=="")

  {

  $("#error-street").html("Enter Street #");

  $("#error-street").show();

  counter =1;

  }



  





     

 if(counter==1)

  	return false;

  

}

 <!--VALIDATION END-->

</script>

