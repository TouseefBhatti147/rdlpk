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
 <a target="_blank" href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/member/register" style="float:right;" class="btn">Add New Member</a>
    <h3>Property Allotment Request</h3>
  </div>
  <hr noshade="noshade" class="hr-5">
  <section class="reg-section margin-top-30">
  <?php $projects_data = Yii::app()->session['projects_array']; ?>
  <div class="float-left">
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

    <div class="clearfix"></div>
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
  <p class="reg-left-text">Floor Name <font color="#FF0000">*</font></p>
  <select name="floor_id" id="floor_id">
  <option value="">Select Floor</option>
  </select>
  </div>
    <div class="float-left">
    <p class="reg-left-text">Plot Size(Unit)<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
		 <select name="size2" id="size2">
      <option value="">Select Size</option>
 			 <?php	
            $res=array();
            foreach($size as $k){
            echo '
			<option value="'.$k['id'].'">'.$k['size'].'(Dimension:'.$k['dimension'].')'.'</option>'; 
            }?>
  </select>
    </p>
  </div>
   <div class="float-left">
  <p class="reg-left-text">Property No. <font color="#FF0000">*</font></p>
  <select name="plot_id" id="plot_id">
  <option value="">Property No.</option>
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
  <div class="float-left">
    <p class="reg-right-field-area margin-left-5">
<lable>Dealer</lable>
      <input type="checkbox" value="Dealer" name="mtype" id="mtype" class="reg-login-text-field" />
    </p>
  </div>    <?php echo CHtml::ajaxSubmitButton(                               'Create Allotment Request',
    array('memberplotsales/allotproperty'),
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
  <!--VALIDATION START-->
<script>
 $(document).ready(function()
     {  	
       $("#project_id").change(function()
           {
         	select_building($(this).val());
		   });
		    $("#building_id").change(function()
           {
         	select_floor($(this).val());
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
function select_floor(id,building_id)
{
		var building_id=$("#building_id").val();
		var pro=$("#project_id").val();
$.ajax({
      type: "POST",
    //  url:    "AjaxRequest9?val1="+id,
	      url:    "AjaxRequest9?val1="+pro+"&&building_id="+building_id,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var listItems='';
var listItems1='';
	listItems+= "<option value=''>Select Floor</option>";
	$(json).each(function(i,val){
	///listItems1+= "<option value='" + val.plot_id + "'>" + val.plot_id + "</option>";
	listItems+= "<option value='" + val.id + "'>" + val.name + "</option>";
//
//	alert(listItems1);
});
$("#plot_id").html(listItems1);	
listItems+="";
$("#floor_id").html(listItems);

          }
    });
}

		
$(document).ready(function(){  		 
	 		
		     
	 	 $("#size2").change(function()
           {
			/*document.getElementById('project').disabled = false;
			document.getElementById('sector').disabled = false;
			document.getElementById('street_id').disabled = false;*/
           select_plan($(this).val());
		    select_plot($(this).val());
         	var pro=$("#project_id").val();
			var street=$("#street_id").val();
			var size=$("#size2").val();
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
	         var pro=$("#project_id").val();
			 var building_id=$("#building_id").val();
			 var size=$("#size2").val();
			 var floor_id=$("#floor_id").val();
			//alert(sizep);
$.ajax({
      type: "POST",
     // url:    "ajaxRequest1",
	  url:    "AjaxRequest1?pro="+pro+"&size="+size+"&floor_id="+floor_id+"&&building_id="+building_id,
	  //data:"pro="+pro+"&size="+size+"&floor_id="+floor_id+"&&building_id="+building_id,
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
	var building_id=$("#building_id").val();
	var pptype=$('.new1:checked').val();
	var pro=$('#project_id').val();
	var sizep=$("#size2").val();
	///alert(sizep);
$.ajax({
      type: "POST",
	    // url:    "AjaxRequest9?val1="+pro+"&&building_id="+building_id,
      url:    "AjaxRequest7?val1="+id+"&sizep="+sizep+"&pro="+pro+"&building_id="+building_id,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var listItems='';
listItems+= "<option value=''>Select Plan</option>";

	$(json).each(function(i,val){
listItems+= "<option value='" + val.id + "'>" + val.tno +"Months" +"("+val.description+" Installment Plan) </option>";
//listItems+= "<option value='" + val.id + "'>" + val.name + "</option>";
///listItems1+= "<option value='" + val.plot_id + "'>" + val.plot_id + "</option>";
});listItems+="";
$("#insplan").html(listItems);
          }
});


}
function select_street(id)
{var pro=$("#project_id").val();
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
       $("#project_id").change(function()
           {
         	select_sector($(this).val());
		//	clearselect();
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
			var pro=$("#project_id").val();
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



