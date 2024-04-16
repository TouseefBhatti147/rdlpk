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
<style>
p{ margin:0px !important;}
input{margin:0px !important;}
</style>
<div class="">
<div class="shadow">
  <h3>Add Instrument</h3>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5 ">
<section class="reg-section margin-top-30">
<div style="
    padding: 0 0 0 32px;
    width: 300px;">
  <span style="color:#FF0000; display:block;" id="error-name"></span>
  <span style="color:#FF0000; display:block;" id="error-logo"></span>
  <span style="color:#FF0000; display:block;" id="error-remarks"></span>
  <span style="color:#FF0000;display:block;" id="error-abbreviation"></span>
  <span style="color:#FF0000;display:block;" id="error-proprietor"></span>   
  </div>
<?php $form=$this->beginWidget('CActiveForm', array(
 'id'=>'user_login_form',
 'enableAjaxValidation'=>false,
  'enableClientValidation'=>true,
                'method' => 'POST',
                'clientOptions'=>array(
                     'validateOnSubmit'=>true,
                     'validateOnChange'=>true,
                     'validateOnType'=>false,

  ),

)); ?>
<div id="error-div" class="errorMessage" style="display: none; color:#F00; font-weight:bold;"></div>
   <div class="span12">
   <div class="span5">
   <div class="float-left">
    <p class="reg-left-text">CNIC<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" placeholder="CNIC" name="cnic" id="cnic" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Type<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <select name="type">
     <option>Select</option>
     <option>Cash</option>
     <option>Cheque</option>
     <option>Pay Order</option>
     <option>Online</option>
     </select>
     </p>
  </div>
    <div class="float-left">
    <p class="reg-left-text">Amount<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <input type="number" placeholder="Amount" name="amount" class="reg-login-text-field" />  
     </p>
  </div> <div class="float-left">
    <p class="reg-left-text">Date<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
    <input type="text" value="" name="fromdate" id="fromdatepicker" class="input"  placeholder="Instrument Date " />
    </p>
  </div>
  
   <div class="float-left">
    <p class="reg-left-text">Ref<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" placeholder="Ref-No" name="ref" id="ref" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
     <p class="reg-left-text">
     <input type="checkbox" value="1"  name="ifd" id="ifd" class="reg-login-text-field" />
     Instrument for Dealer
     </p>
    
     
     </div>

        <input type="hidden" value="<?php echo $data['rid'] ?>" name="rid" id="rid" class="reg-login-text-field" />
</div>
<div class="span3">
 

 <br />
    <div name="image" id="image"  > </div>
  <?php echo CHtml::ajaxSubmitButton(

                                'Save Instrument',

    array('/reciept/createre'),

                                array(  

                'beforeSend' => 'function(){ 

                                             $("#login").attr("disabled",true);

            }',

                                        'complete' => 'function(){ 

                                             $("#user_login_form").each(function(){});

                                             $("#login").attr("disabled",false);

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

                         array("id"=>"login","class" => "btn","style"=>"    margin-top: 20px !important;")      

                ); ?>

  



<!--  </form>-->

<?php $this->endWidget(); ?>
 </div>
 <div class="span3" style="background-color:#FF9; min-height:350px; padding:10px; border:1px solid #999 ">
 <h4>Info</h4>
 
 <hr />
 
 <ul style="font:10px;">
 <li> Enter CNIC first to confirm the Registered Member.</li><li>
 All fields are mandatory to fill properly.</li><li>
 Mark Check-box for Dealers in case of Junk Payment from Investors.</li><li>
 All contents are editable on next screen until verified by the Finance Section.</li>
 </li>
 </ul>
 </div>
 </div>
 <?php 
 $address= $_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl;
 ?>
 </section>
<!-- section 3 -->
<!--VALIDATION START-->
<script>
 $("#cnic").change(function()

           {

         	select_cnic($(this).val());

		   });
		   function select_cnic(id)

{

$.ajax({

      type: "POST",

      url:    "http://<?php echo $address;?>/index.php/memberplot/ajaxRequest5?val1="+id,
   contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var listItems='';
 $(json).each(function(i,val){
 listItems+= '<img src="/upload_pic/' + val.image +'"/><p>' + val.name +'</p>';
});listItems+="";
$("#image").html(listItems);
          }
});

}

function validateForm(){
	$("#error-name").hide();
	$("#error-logo").hide();
	$("#error-remarks").hide();
	$("#error-abbreviation").hide();
	$("#error-proprietor").hide();
	var a = $("#name").val();
	
	var c = $("#remarks").val();
	var d = $("#abbreviation").val();
	var e = $("#proprietor").val();
     var counter=0;
  if (a==null || a=="")
  {
  $("#error-name").html("Enter Seller Name");
  $("#error-name").show();
  counter =1;
  }
  if (b==null || b=="")
  {
  $("#error-logo").html("Please Select A Logo");
  $("#error-logo").show();
  counter =1;
  }
  if (c==null || c=="")
  {
  $("#error-remarks").html("Enter Remarks");
  $("#error-remarks").show();
  counter =1;
  }
  if (d==null || d=="")
  {
  $("#error-abbreviation").html("Enter Seller Abbreviation");
  $("#error-abbreviation").show();
  counter =1;
  }
   if (e==null || e=="")
  {
  $("#error-proprietor").html("Enter Seller Proprietor");
  $("#error-proprietor").show();
  counter =1;
  }
 if(counter==1)
  	return false;

}

 <!--VALIDATION END-->
  $(document).ready(function()
     {  	
       $("#project").change(function()
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
});listItems+="";
$("#street_id").html(listItems);
          }
    });
}



</script>



