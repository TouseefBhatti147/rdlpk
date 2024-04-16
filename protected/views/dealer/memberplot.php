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

<div class="clearfix"></div>
<div class="">

  <div class="shadow">
    <h3>Reservation Request</h3>


  </div>
  <!-- shadow -->

  <hr noshade="noshade" class="hr-5">

  <section class="reg-section margin-top-30">

  <?php $projects_data = Yii::app()->session['projects_array']; ?>

  <div class="float-left">

   <div>

	

	

		</div>

       

   <?php $form=$this->beginWidget('CActiveForm', array(



 'id'=>'plots1',



 'enableAjaxValidation'=>false,



  'enableClientValidation'=>true,



                'method' => 'POST',

				'clientOptions'=>array(

			    'validateOnSubmit'=>true,

		        'validateOnChange'=>true,

	            'validateOnType'=>false,),

)); ?>



<div id="error-div1" class="errorMessage" style="display: none; color:#F00;"></div>

	
    
    <div class="clearfix"></div>


    <div class="float-left">

    <p class="reg-left-text">Project <font color="#FF0000">*</font></p>

    <select name="project" id="project" >

      <option value="">Please Select Project </option>

      <?php	

            $res=array();

            foreach($projects as $key){

            echo '<option value="'.$key['id'].'">'.$key['project_name'].'</option>'; 

            }?>

    </select>

    </div>
<div class="float-left"> 
    <?php
    	$connection = Yii::app()->db;  
		$sql_plot  = "SELECT * from size_cat";
		$result_plots = $connection->createCommand($sql_plot)->query();
	?>
      <p class="reg-left-text">Plot Size <font color="#FF0000">*</font></p>
      <select name="size_id" id="size_id" >
        <option value="">Plot Size</option>
        <?php 
		foreach($result_plots as $row5){
			echo '<option value="'.$row5['id'].'">'.$row5['size'].'</option>';
			}
		?>
      </select>
    </div>

<div class="float-left" >
  <p class="reg-left-text">Sector # <font color="#FF0000">*</font></p>
  <select name="sector" id="sector" disabled="disabled">
  <option value="">Select Sector</option>

  </select> 
  </div>
    <div class="float-left" >

      <p class="reg-left-text">Street #<font color="#FF0000">*</font></p>

    <select name="street_id" id="street_id" disabled="disabled">

      <option value="">Please Select Street </option>



    </select>

</div>

  <div class="float-left">

    <p class="reg-left-text">Plot No <font color="#FF0000">*</font></p>

    <select name="plot_id" id="plot_id">

      <option value="">Select Plot No</option>

    </select>

  </div>
    <?php echo CHtml::ajaxSubmitButton(



                                'Create Reservation Request',



    array('dealer/alotaplot1'),



                                array(  



                'beforeSend' => 'function(){ 



                                             $("#submit").attr("disabled",true);



            }',



                                        'complete' => 'function(){ 



                                            // $("#plots1").each(function(){ this.reset();});



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



                                                $("#error-div1").show();



                                                $("#error-div1").html(data);$("#error-div1").append("");



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
function clearselect(){
var listItems='Select Plot';
listItems+="<option>Select Plot</option>";
$("#plot_id").html(listItems);
    }
		
$(document).ready(function(){  		 
	 		$("#sector").change(function()
           {
         	select_street($(this).val());
			clearselect();
		   });	
		   $("#street_id").change(function()
           {
         	select_plot($(this).val());
		   });	   
	 	 $("#size_id").change(function()
           {
			document.getElementById('project').disabled = false;
			document.getElementById('sector').disabled = false;
			document.getElementById('street_id').disabled = false;
           select_plan($(this).val());
         	var pro=$("#project").val();
			var street=$("#street_id").val();
			var size=$("#size_id").val();
			var sector=$("#sector").val();
			var pptype=$('.new1:checked').val();
			var pptype1=$('.new:checked').val();	
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
		   });
function select_plot(id)
{
	var pro=$("#project").val();
			var street=$("#street_id").val();
			var size=$("#size_id").val();
			var sector=$("#sector").val();
			var pptype=$('.new1:checked').val();
			var pptype1=$('.new:checked').val();	
$.ajax({
      type: "POST",
      url:    "ajaxRequest1",
	 data:"pro="+pro+"&street="+street+"&size="+size+"&sector="+sector+"&pptype="+pptype+"&pptype1="+pptype1,
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


}	
function select_plan(id)
{
	var pptype=$('.new1:checked').val();
	var pro=$('#project').val();
$.ajax({
      type: "POST",
      url:    "ajaxRequest7?val1="+id+"&pptype="+pptype+"&pro="+pro,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var listItems='';
listItems+= "<option value=''>Select Plan</option>";

	$(json).each(function(i,val){
listItems+= "<option value='" + val.id + "'>" + val.tno +"Months" +"("+val.description+" Installment Plan) </option>";

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
			clearselect();
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
	listItems+= "<option value=''>Select Sector</option>";
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
$(document).ready(function()
{  	
       $("#plot_id").change(function()
           {
         	select_price($(this).val());
		   });
     });
function select_price(id)
{
			var pro=$("#project").val();
			var street=$("#street_id").val();
			var sector=$("#sector").val();
			var pid=$("#plot_id").val();
			var listItems1='';
			total = 0;
			total1 = 0;
			to = 0;
$.ajax({
      type: "POST",
      url:    "plotprice?pro="+pro+"&street="+street+"&sector="+sector+"&pid="+pid,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);

	$(json).each(function(i,plot){
	listItems1+= "<tr><td>Land Charges</td><td>" +plot.price+ "</td></tr>";
	total = plot.price;
});


          }
    });
$.ajax({
      type: "POST",
      url:    "catprice?pro="+pro+"&street="+street+"&sector="+sector+"&pid="+pid,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);

	$(json).each(function(i,val){
	newv = 0;
	newv = total/100*val.total;
	listItems1+= "<tr><td>" +val.name+ "</td><td>" +newv+ "</td></tr>";
	to = total1 + newv;
	total1 = to;
});
to = total + total1;
listItems1+="<tr><td>Total</td><td>" +to+ "</td></tr>";
$("#div1").html(listItems1);$("#div1").append("");

          }
    });	
	}
</script>




  