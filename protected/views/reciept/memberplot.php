
<script src="//code.jquery.com/jquery-1.10.2.js"></script>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.js"></script>



<script>

$(function() {

$( "#fromdatepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });

});

$(function() {

$( "#todatepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });

});

</script>
<div class="">

  <div class="shadow">

    <h3>Allot A Plot</h3>

  </div>

  <!-- shadow -->

  <hr noshade="noshade" class="hr-5">

  <section class="reg-section margin-top-30">

  <?php $projects_data = Yii::app()->session['projects_array']; ?>

  <div class="float-left">

   <div>

	

	

		</div>

       

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



	

    <div class="float-left">

    <p class="reg-left-text">Project <font color="#FF0000">*</font></p>

    <select name="project" id="project">

      <option value="">Please Select Project </option>

      <?php	

            $res=array();

            foreach($projects as $key){

            echo '<option value="'.$key['id'].'">'.$key['project_name'].'</option>'; 

            }?>

    </select>

    </div>

    <div class="float-left">

      <p class="reg-left-text">Street #<font color="#FF0000">*</font></p>

    <select name="street_id" id="street_id">

      <option value="">Please Select Street </option>



    </select>

</div>

  <div class="float-left">

    <p class="reg-left-text">Plot No <font color="#FF0000">*</font></p>

    <select name="plot_id" id="plot_id">

      <option value="">Select Plot No</option>

    </select>

  </div>

  <div class="float-left">

    <p class="reg-left-text">Plot Membership No<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" value="" name="plotno" id="plotno" class="reg-login-text-field" />

    

    </p>

  </div>

 

  <div class="float-left">

    <p class="reg-left-text">CNIC<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" value="" name="cnic" id="cnic" class="reg-login-text-field" />

    </p>

  </div>

  <div class="">

    <img name="image" id="image"/>

      

  </div>

    

  

   

   <div class="float-left">

    <p class="reg-left-text">Installment(After Months)<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="number" value="" name="noi" id="noi" class="reg-login-text-field" />

    </p>

  </div>
<div class="float-left">

    <p class="reg-left-text">Date<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

   <input name="date"  type="text" placeholder="Enter To Date" class="new-input" id="todatepicker">

    </p>

  </div>
<div class="float-left">

    <p class="reg-left-text">Installment Plan<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

     <select name="insplan" id="insplan">
     <option value="">Select Installment Plan</option>
     <?php
     foreach($plan as $p)
	 {
	echo'<option value="'.$p['tno'].'">'.$p['tno'].' Months - ('.$key['project_name'].')</option>
';	 
		 
	 }
	 
	 ?>
          
     </select>

    </p>

  </div>
   <div class="float-left">

    <p class="reg-left-text">Payment Type<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

    <select name="payment_type" id="payment_type" >

    <option value="">Select Payment Type</option>

    <option value="cash">Cash</option>

    <option value="checue">Cheque</option>

    <option value="po">Pay Order</option>

    

    </select>

    </p>

  </div>

 <!-- <input name="submit" value="Alot Plot" type="submit" class="btn-info pull-right" style="position: fixed; padding:5px;" />

 -->  

    <?php echo CHtml::ajaxSubmitButton(



                                'Alot Plot',



    array('memberplot/alotaplot'),



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

 

   

    <div style="height: 600px;

    padding: 0 0 0 32px;

    width: 300px;">

  

  <span style="color:#FF0000; display:block;" id="error-project"></span>

  <span style="color:#FF0000; display:block;" id="error-street_id"></span>

  <span style="color:#FF0000; display:block;" id="error-plot_id"></span>

 <span style="color:#FF0000;display:block;" id="error-cnic"></span>

  <span style="color:#FF0000;display:block;" id="error-downpayment"></span>   

  <span style="color:#FF0000;display:block;" id="error-discount"></span>   

  <span style="color:#FF0000;display:block;" id="error-noi"></span>   

 <span style="color:#FF0000;display:block;" id="error-payment_type"></span>   

 <span style="color:#FF0000;display:block;" id="error-plotno"></span>   

 

   </div>

    

  </form>

  

  <!--VALIDATION START-->


<script>
$(document).ready(function()
     {  	
	 $("#project").change(function()
           {
         	select_street($(this).val());
		   });
	 	 $("#street_id").change(function()
           {
         	var pro=$("#project").val();
			var street=$("#street_id").val();
			$.ajax({
      type: "POST",
      url:    "ajaxRequest1",
	  data:"pro="+pro+"&street="+street,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
		var listItems='';
		listItems+= "<option value=''>Select Plot</option>";
	$(json).each(function(i,val){
	 
	listItems+= "<option value='" + val.id + "'>" + val.plot_detail_address +" ("+val.plot_size+")</option>";

});listItems+="";

$("#plot_id").html(listItems);

 }

});
		   });
	 
	 
       
		  
		   $("#country").change(function()
           {
         	select_city($(this).val());
		   });
           $("#cnic").change(function()
           {
         	select_cnic($(this).val());
		   });
		  /*  $("#plotno").change(function()
           {
         	select_mem($(this).val());
		   });*/
		    });
			function select_street(id)

{
$.ajax({
      type: "POST",
      url:    "ajaxRequest?val1="+id,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var listItems='';
listItems+= "<option value=''>Select Street</option>";

	$(json).each(function(i,val){

	listItems+= "<option value='" + val.id + "'>" + val.street + "</option>";
});listItems+="";
$("#street_id").html(listItems);
          }

    });}
function select_file(id)
{
$.ajax({
      type: "POST",
      url:    "ajaxRequest1?val1="+id,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);	  
		var listItems='';
	$(json).each(function(i,val){
	 listItems+= "<option value=''>Select Plot</option>";
	listItems+= "<option value='" + val.id + "'>" + val.plot_detail_address +" ("+val.plot_size+")</option>";

});listItems+="";

$("#file_id").html(listItems);

 }

});

}

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

function select_cnic(id)

{

$.ajax({

      type: "POST",

      url:    "ajaxRequest5?val1="+id,

   contenetType:"json",

      success: function(jsonList){var json = $.parseJSON(jsonList);

   

var listItems='';

 $(json).each(function(i,val){

 listItems+= '<img src="/hb/upload_pic/' + val.image +'"/>';

      

});listItems+="";



$("#image").html(listItems);

          }

});

}
</script>



  