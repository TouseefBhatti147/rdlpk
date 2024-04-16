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
<div class="">

  <div class="shadow">

    <h3>Add New Villa/Appartment/Shop </h3>

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
  <p class="reg-left-text">Sector # <font color="#FF0000">*</font></p>
  <select name="sector" id="sector">
  <option value="">Select Sector</option>

  </select> 
  </div>
    <div class="float-left">

      <p class="reg-left-text">Street #<font color="#FF0000">*</font></p>

    <select name="street_id" id="street_id">

      <option value="">Please Select Street </option>



    </select>

</div>
<div class="float-left"> 
    <?php
    	$connection = Yii::app()->db;  
		$sql_plot  = "SELECT * from size_cat where type ='Com'";
		$result_plots = $connection->createCommand($sql_plot)->query();
	?>
      <p class="reg-left-text">Property Size <font color="#FF0000">*</font></p>
      <select name="size_id" id="size_id">
        <option value="">Select Property Size</option>
        <?php 
		foreach($result_plots as $row5){
			echo '<option value="'.$row5['id'].'">'.$row5['size'].'</option>';
			}
		?>
      </select>
    </div>
  <div class="float-left">

    <p class="reg-left-text">Plot No<font color="#FF0000">*</font></p>

    <select name="plot_id" id="plot_id">

      <option value="">Select Plot No</option>

    </select>

  </div>

<div class="float-left">

    <p class="reg-left-text">Type<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <select name="p_type" id="p_type" class="reg-login-text-field" >
     <?php
	 foreach($ptype as $row5){
	  ?>
      <option value="<?php echo $row5['id']?>"><?php echo $row5['project_name'] ?></option>
      <?php }?>
      </select>

    </p>

  </div>
  
  <div class="float-left">

    <p class="reg-left-text">Villa/Shop/Appartment Unique No.<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" value="" name="number" id="number" class="reg-login-text-field" />

    </p>

  </div>
  <div class="float-left">

    <p class="reg-left-text">Details(Total No of Rooms/Shops)<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="number" value="" name="details" id="details" class="reg-login-text-field" />

    </p>

  </div>


   <div class="float-left">

    <p class="reg-left-text">Floor<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="number" value="" name="floor" id="floor" class="reg-login-text-field" />

    </p>

  </div>
<div class="float-left">

    <p class="reg-left-text">Covered Area<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

   <input name="cov_a"  type="text" placeholder="Area" class="new-input" id="cov_a">

    </p>

  </div>


   <div class="float-left">

    <p class="reg-left-text">Status<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <select name="status" id="status" class="reg-login-text-field" >
      <option>Compelete</option>
      </select>

    </p>

  </div>

 <!-- <input name="submit" value="Alot Plot" type="submit" class="btn-info pull-right" style="position: fixed; padding:5px;" />

 -->  

    <?php echo CHtml::ajaxSubmitButton(



                                'Add',



    array('property/addnewproperty'),



                                array(  



                'beforeSend' => 'function(){ 



                                             $("#submit").attr("disabled",true);



            }',



                                        'complete' => 'function(){ 



                                             $("#plots").each(function(){});



                                             $("#submit").attr("disabled",false);



                                        }',



                   'success'=>'function(data){  


 
                                           //  var obj = jQuery.parseJSON(data); 



                                            // View login errors!



        



                                             if(data == 1){



												// alert("we are here");



                                         location.href = "http://rdlpk.com/index.php/user/dashboard";
$("#plots").each(function(){ this.reset();});


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
	 $("#sector").change(function()
           {
         	select_street($(this).val());
		   });
	 	 $("#size_id").change(function()

           {
           select_plan($(this).val());

         	var pro=$("#project").val();
			var street=$("#street_id").val();
			var size=$("#size_id").val();

			$.ajax({
      type: "POST",
      url:    "selectplot",
	 data:"pro="+pro+"&street="+street+"&size="+size,
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
$.ajax({
      type: "POST",
      url:    "sizecode?size="+size,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var newv='';
	$(json).each(function(i,val){
	newv= val.code;
});
var elem = document.getElementById("sizecode");
elem.value = newv;
//$("#plotno").value(newv);
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
			function select_plan(id)
{
	var pro=$("#project").val();
$.ajax({
      type: "POST",
      url:    "ajaxRequest7?val1="+id+"&&pro="+pro,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var listItems='';
	$(json).each(function(i,val){
listItems+= "<option value='" + val.tno + "'>" + val.tno +"Months" +"("+val.description+" Installment Plan) </option>";

});listItems+="";
$("#insplan").html(listItems);
          }
});



}
			function select_street(id)

{var pro=$("#project").val();
	var sec=$("#sector").val();
$.ajax({
      type: "POST",
      url:    "ajaxRequest?pro="+pro+"&&sec="+sec,
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

 listItems+= '<img src="/upload_pic/' + val.image +'"/>';

      

});listItems+="";



$("#image").html(listItems);

          }

});

}
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
      url:    "ajaxRequest12?val1="+id,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var listItems='';

listItems='<option value="">Select Sector</option>';
	$(json).each(function(i,val){
	listItems+= "<option value='" + val.id + "'>" + val.sector_name + "</option>";
});listItems+="";
$("#sector").html(listItems);
          }
    });
$.ajax({
      type: "POST",
      url:    "projectcode?val1="+id,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var newv='';
	$(json).each(function(i,val){
	newv= val.code;
});
var elem = document.getElementById("procode");
elem.value = newv;
//$("#plotno").value(newv);
          }
    });
}

</script>



  