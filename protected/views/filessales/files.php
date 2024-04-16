<div class="">






<div class="shadow">



  <h3>Add File</h3>



</div>



<div id="error-div" class="errorMessage" style="display: none; color:#F00;"></div>

<!-- shadow -->



<hr noshade="noshade" class="hr-5 ">



<section class="reg-section margin-top-30">



<?php $form=$this->beginWidget('CActiveForm', array(



 'id'=>'plots',

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



<input value="file" name="type" id="type" type="hidden" />

 

<div id="error-div" class="errorMessage" style="display: none; color:#F00;"></div>



<div class="float-left" style="display:none;">



  <p class="reg-left-text">File ID <font color="#FF0000">*</font></p>



  <p class="reg-right-field-area margin-left-5">



    <input type="text" value="" name="id" id="id" class="reg-login-text-field" />



  </p>



</div>



 <div class="float-left">



  <p class="reg-left-text">Project<font color="#FF0000">*</font></p>



  <select name="project_id" id="project">

 <option value="">Select Project</option>

 			 <?php	



			



            $res=array();



            foreach($projects as $key){



            echo '<option value="'.$key['id'].'">'.$key['project_name'].'</option>'; 



            }?>



  </select>



  </div>


<div class="float-left">
  <p class="reg-left-text">Sector # <font color="#FF0000">*</font></p>
  <select name="sector" id="sector">
  <option value="">Select Sector</option>

  </select>
  </div>
<div class="float-left">



  <p class="reg-left-text">Street # <font color="#FF0000">*</font></p>



  <select name="street_id" id="street_id">

    <option value="">Select Street</option>

    <option value="street">street</option>



  </select>



</div>



<div class="float-left">



  <p class="reg-left-text">File Number<font color="#FF0000">*</font></p>



  <p class="reg-right-field-area margin-left-5">



    <input type="text" value="" name="file_detail_address" id="file_detail_address" class="reg-login-text-field" />



  </p>



</div>



<div class="float-left">



  <p class="reg-left-text">File Size(Diemension)<font color="#FF0000">*</font></p>



  <p class="reg-right-field-area margin-left-5">



    <input type="text" value="" name="file_size" id="file_size" class="reg-login-text-field" />



  </p>



</div>



   <div class="float-left">



    <p class="reg-left-text">File Size(Unit)<font color="#FF0000">*</font></p>



    <p class="reg-right-field-area margin-left-5">



  

		 <select name="size2" id="size2">

       <option value="">Select Size</option>

 			 <?php	



			



            $res=array();



            foreach($size as $k){

				



            echo '

			

			

			<option value="'.$k['id'].'">'.$k['size'].'</option>'; 



            }?>



  </select>

    </p>



    







  </div>



<div class="float-left" >



  <p class="reg-left-text">Type<font color="#FF0000">*</font></p>

  <p class="reg-right-field-area margin-left-5">



  <select name="com_res" id="type">

  <option value="">Select Type</option>

    <option value="Commercial">Commercial</option>



    <option value="Residential">Residential</option>



  </select>

</p>

</div>



<div class="float-left">



  <p class="reg-left-text">Price <font color="#FF0000">*</font></p>



  <p class="reg-right-field-area margin-left-5">



    <input type="text" value="" name="price" id="price" class="reg-login-text-field" />



  </p>



</div>















<!--<input name="submit" id="submit" value="Add File" type="submit" class="btn-info pull-right" style="position: fixed; padding:5px;" />-->


  <?php echo CHtml::ajaxSubmitButton(
                         'Add File',
    array('create'),
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
                                        }' ),
									 array("id"=>"login","class" => "btn-info pull-right")      ); ?>



  <?php $this->endWidget(); ?>




</section>



<!-- section 3 --> 



<!--VALIDATION START-->







<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">



</script>















<!-- VALIDATION END-->



<script>



 



    $(document).ready(function()
     {  	
       $("#project").change(function()
           {
         	select_sector($(this).val());
		   });
     });


function select_sector(id)
{
$.ajax({
      type: "POST",
      url:    "ajaxRequest?val1="+id,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var listItems='';
	listItems+= "<option value=''>Select Sector</option>";
	$(json).each(function(i,val){
	
	listItems+= "<option value='" + val.id + "'>" + val.sector_name + "</option>";
});listItems+="";
$("#sector").html(listItems);
          }
    });
}

 $(document).ready(function()
     {  	
       $("#sector").change(function()
           {
         	select_street($(this).val());
		   });
     });


function select_street(id)
{
	var pro=$("#project").val();
	var sec=$("#sector").val();
$.ajax({
      type: "POST",
      url:    "ajaxRequest2?pro="+pro+"&&sec="+sec,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var listItems='<option value="">Select Street</option>';
	$(json).each(function(i,val){
	listItems+= "<option value='" + val.id + "'>" + val.street + "</option>";
});listItems+="";
$("#street_id").html(listItems);
          }
    });
}



</script> 

