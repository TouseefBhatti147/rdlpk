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
<div class="clearfix"></div>
<div class="">
  <div class="shadow">
 <a target="_blank" href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/member/register" style="float:right;" class="btn">Add New Member</a>
    <h3>Allotment Request</h3>
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
<div class="float-left" >
      <p class="reg-left-text"><b>Application No</b> <font color="#FF0000">*</font></p>
<input type="number" value="" name="appnoo" id="appnoo" class="reg-login-text-field" style=" font-weight:bold; font-size:15;width:150px; height:25px; background-color:#0CF;" />
</div>
	<div class="float-left">
      <p class="reg-left-text"><b>Property Type</b> <font color="#FF0000">*</font></p>
     <label style="float:left;">
     <input type="radio" name="pptype1" value="file" class="new" style="float:left;"  onclick="clearselect();" />Files  </label>  
     <label style="float:left;">
     <input type="radio" name="pptype1" value="Plot"  class="new" style="float:left;" onclick="clearselect();" />Plot</label>
       <input type="radio" name="pptype1" value="Villa"  class="new" style="float:left;" onclick="clearselect();" />Villa</label>
    </div>
    <div class="float-left">
      <p class="reg-left-text"><b>Plot Type</b> <font color="#FF0000">*</font></p>
     <label style="float:left;"><input type="radio" name="pptype" value="R" class="new1" onclick="clearselect();" style="float:left;"/>Residential  </label>  
     <label style="float:left;"><input type="radio" name="pptype" value="C"  class="new1" onclick="clearselect();" style="float:left;" />Commercial</label>
    </div>
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
  
  <div class="float-left" style="display:none;">

    <p class="reg-left-text">Discount %<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="number" value="00" name="disc" id="disc" class="reg-login-text-field" />

    </p>

  </div>
<div class="float-left">

    <p class="reg-left-text">Plan Start Date<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

    <input name="date"  type="text" placeholder="Enter Date" class="new-input" id="todatepicker">


    </p>

  </div>
<div class="float-left">

    <p class="reg-left-text">Installment Plan<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

     <select name="insplan" id="insplan">
     <option value="">Select Installment Plan</option>
     
          
     </select>

    </p>

  </div>
   <div class="float-left">
      <p class="reg-left-text">Allotment Type<font color="#FF0000">*</font></p>
      <p class="reg-right-field-area margin-left-5">
        <select id="atype" name="atype">
          <option value="">Select Type</option>
		 <option value="Against Land">Against Land</option>          
		<option value="On Payment">On Payment </option>
         
        </select>
      </p>
    </div>
        <div class="float-left" id="landowner1" >
<p class="reg-left-text">Land Owner<font color="#FF0000">*</font></p>
<p class="reg-rightfield-area margin-left-5">
<select  name="landowner" id="landowner">
<option value="">Select Owner</option>
</select>
</p>
</div>
  <div class="float-left">
    <p class="reg-right-field-area margin-left-5">
      <lable>Dealer</lable>
      <input type="checkbox" value="Dealer" name="mtype" id="mtype" class="reg-login-text-field" />
    </p>
  </div>
  
    <?php echo CHtml::ajaxSubmitButton(
                                'Create Allotment Request',
    array('memberplotsales/alotaplot1'),
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
  
  $(".answer").hide();
$(".coupon_question").click(function() {
    if($(this).is(":checked")) {
        $(".answer").show();
    } else {
        $(".answer").hide();
    }
});
             $("#atype").change(function()
					{
						if($(this).val() == "Against Land")
					{
					  $("#landowner1").show();
					}
					else
					{
						 $("#landowner1").hide();
					}
            });
          $("#landowner1").hide();		 

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
		   
		    $(".new1").click(function()
           {
//			   alert(this.value);
			   
         		select_size(this.value);
		   });
		   
		   });	var sid=$("#pptype").val();
			function select_size(id)
{
			$.ajax({
      type: "POST",
      url:    "ajaxRequest123?val1="+id,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
		var listItems='';
		listItems+= "<option value=''>Select Size</option>";
	$(json).each(function(i,val){
	listItems+= "<option value='" + val.id + "'>" + val.size +" </option>";
    });listItems+="";
	$("#size_id").html(listItems);
          }
});}
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
			select_owner($(this).val());
		   });
     });
     function select_owner(id)
    {
      $.ajax({
      type: "POST",
      url:    "ajaxRequestlo?val1="+id,
	    contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
      var listItems='';
      listItems+= "<option value=''>Select Land Owner</option>";
      $(json).each(function(i,val){
      listItems+= "<option value='" + val.lid + "'>" + val.name + "</option>";
      });listItems+="";
      $("#landowner").html(listItems);
          }
    });
}

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




  