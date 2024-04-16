 <script src="//code.jquery.com/jquery-1.10.2.js"></script>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.js"></script>

<style>
/* Center the loader */
#loader {
  position: absolute;
  left: 50%;
  top: 50%;
  z-index: 1;
  width: 150px;
  height: 150px;
  margin: -75px 0 0 -75px;
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

/* Add animation to "page content" */
.animate-bottom {
  position: relative;
  -webkit-animation-name: animatebottom;
  -webkit-animation-duration: 1s;
  animation-name: animatebottom;
  animation-duration: 2s
}

@-webkit-keyframes animatebottom {
  from { bottom:-100px; opacity:0 } 
  to { bottom:0px; opacity:1 }
}

@keyframes animatebottom { 
  from{ bottom:-100px; opacity:0 } 
  to{ bottom:0; opacity:1 }
}

#myDiv {
  display: none;
  text-align: center;
}
</style>

<script>

$(function() {

$( "#cdate" ).datepicker({ dateFormat: 'dd-mm-yy' });

});

$(function() {

$( "#todatepicker" ).datepicker({ dateFormat: 'dd-mm-yy' });

});
function calsur(){
	document.getElementById("loader").style.display = "block";
	var myVar;
	   myVar = setTimeout(showPage, 1000);
		function showPage() {
		  
		 document.getElementById("city_id").style.display = "block";
		}
       var elem=document.getElementById("cdate").value;
	   $.ajax({
	     url:"calsur?datee=" + elem + "&id=<?php echo $_REQUEST['id']?>",
                  type:"POST",
                  data:123,
				cache: false,
        success: function(response){
		  var elem1='';
		  var elem1= document.getElementById("city_id");
		  document.getElementById("loader").style.display = "none";
		  elem1.value=response;
		}
	   });
	return false;
	}
</script>

<div class="shadow">
  <h3>Surcharges</h3>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5 ">
<section class="reg-section margin-top-30">
<div id="error-div" class="errorMessage" style="display: none; color:#F00;"></div>

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
<p>Cutoff Date</p><div class="float-left">
<input type="text" value="<?php echo date('d-m-Y')?>" placeholder="dd-mm-yyyy" name="cdate" id="cdate"  />
<input type="button" name="calculate" value="Calculate" id="calc" onclick="calsur()">
<div id="loader" style="display:none;"></div>
</div><div class="clearfix"></div>

	<div class="float-left">
    <p class="reg-left-text">Payment Type<font color="#FF0000">*</font></p>
   	<p class="reg-right-field-area margin-left-5">
       <select name="charges_id" id="charges_id">
		   <?php
           foreach($charges as $key1)
           {
            echo ' 	<option value="'.$key1['id'].'">'.$key1['name'].'</option>';   
           }
           ?>
  	</select>
    </p>
  	</div>
    
    <div class="float-left">
    <p class="reg-left-text">Default Charges<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <!--<input type="text" value="" readonly="readonly" name="city_id" id="city_id" class="reg-login-text-field" />-->
        <input name="city_id" id="city_id" value="" type="text"/>
    </p>
  </div>
    
   <div class="float-left">
    <p class="reg-left-text">Applied Charges<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="number" value="" name="total" id="total" class="reg-login-text-field" />
    </p>
  </div>

	<?php foreach($plots as $key){ ?>
	
        
	<div class="float-left">
    <p class="reg-left-text">Plot No<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="hidden" readonly="readonly" value="<?php echo $key['id'] ?>" name="plot_id" id="plot_id" class="reg-login-text-field" />
      <input type="text" readonly="readonly" value="<?php echo $key['plot_detail_address'] ?>" name="plot_detail_address" id="plot_detail_address" class="reg-login-text-field" />   
    </p>
  	</div>
  	
     <div class="float-left">

    <p class="reg-left-text">Date<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

   <input name="duedate"  type="text" placeholder="Enter Due Date" class="new-input" id="todatepicker">

    </p>

  </div>

  	
   
  <div class="float-left">
    <p class="reg-left-text">Comment<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" name="comment" id="comment" class="reg-login-text-field" />
    </p>
  </div>
      <?php }?>
    	
     <input type="hidden" name="pid" value="<?php echo $_REQUEST['pid'];?>" />

  <?php echo CHtml::ajaxSubmitButton(

                                'Add Charges',

    array('surchargedef'),
                   array(  
                'beforeSend' => 'function(){ 
                                             $("#submit").attr("disabled",true);
            }',
                                        'complete' => 'function(){ 
                                             $("#user_login_form").each(function(){ this.reset();});
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
                         array("id"=>"login","class" => "btn-info pull-right")); ?>

  <?php $this->endWidget(); ?>
  <script>
  $(document).ready(function()
     {  	
       
       $("#charges_id").change(function()
           {
         	select_city($(this).val());
		   });
     });

function select_city(id)
{
$.ajax({
      type: "POST",
      url:    "ajaxRequest31?val1="+id,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var listItems='';
	$(json).each(function(i,val){
	listItems+= "<option value='" + val.id + "'>" + val.total +" </option>";

});listItems+="";
$("#city_id").html(listItems);
          }
});

}
</script>

  
  		
          