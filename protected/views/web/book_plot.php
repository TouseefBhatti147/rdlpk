

<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<style>
* {
  box-sizing: border-box;
}

body {
  background-color: #f1f1f1;
}

#regForm {
  background-color: #ffffff;
  margin: 100px auto;
  font-family: Raleway;
  padding: 40px;
  width: 70%;
  min-width: 300px;
}

h1 {
  text-align: center;  
}

input {
  padding: 10px;
  width: 100%;
  font-size: 17px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
}

/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

button {
  background-color: #4CAF50;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
}

button:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #bbbbbb;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;  
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #4CAF50;
}
</style>
<head>
  <title>Book Plot</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Include Bootstrap CSS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
   <style>
  .box
  {
   width:800px;
   margin:0 auto;
  }
  .active_tab1
  {
   background-color:#fff;
   color:#333;
   font-weight: 600;
  }
  .inactive_tab1
  {
   background-color: #f5f5f5;
   color: #333;
   cursor: not-allowed;
  }
  .has-error
  {
   border-color:#cc0000;
   background-color:#ffff99;
  }
  </style>
</head>
<div class="my-content">
<div class="row-fluid my-wrapper">
<div class="span12"> 
<!-- breadcrumbs -->

<div class="shadow">
<h3>Book Plot</h3>
</div>
<hr noshade="noshade" class="hr-5">
<div class="float-left">
<table class="table table-striped table-new table-bordered">
<thead style="background:#666; border-color:#ccc; color:#fff;">
<tr>
<td colspan="3"  align="center"><h4> <strong>Plot Detail</strong></h4></td>
</tr>
</thead>
<tbody>
<?php
foreach($plot as $key)
{
	 if($key['com_res']=='Commercial'){$type='C'; }else{$type='R';}
?>
<tr>
<td>Project Name.</td>
<td><?php echo $key['project_name'];?></td>
</tr>
<tr>
<td>Plot No.</td>
<td><?php echo $key['plot_detail_address'];?></td>
</tr>
<tr>
<td>Size</td>
<td><?php echo $key['size'].'&nbsp;('.$key['plot_size'].')';?></td>
</tr>
<tr>
<td>Street</td>
<td><?php echo $key['street'];?></td>
</tr>
<tr>
<td>Sector</td>
<td><?php echo $key['sector_name'];?></td>
</tr>
<?php }?>
</tbody>
</table>
</div>
<div id="error-div" class="errorMessage" style="display: none; color:#F00;"></div>
<div class="clearfix"></div>
<div class="span12">
  

   
    <?php  /*$form=$this->beginWidget('CActiveForm', array(
 'id'=>'myform',
 
 'enableAjaxValidation'=>true,
'htmlOptions' => array('enctype' => 'multipart/form-data'),
  'enableClientValidation'=>true,
                'method' => 'POST',
				'clientOptions'=>array(
			    'validateOnSubmit'=>true,
		        'validateOnChange'=>true,
				'stateful'=>true, 
	            'validateOnType'=>false,),
)); */
?>
     
    <ul class="nav nav-tabs">
     <li class="nav-item">
      <a class="nav-link active_tab1" style="border:1px solid #ccc" id="list_login_details">Login Details</a>
     </li>
     <li class="nav-item">
      <a class="nav-link inactive_tab1" id="list_personal_details" style="border:1px solid #ccc">Personal Details</a>
     </li>
     <li class="nav-item">
      <a class="nav-link inactive_tab1" id="list_payment_details" style="border:1px solid #ccc">Payment Details</a>
     </li>
       <li class="nav-item">
      <a  style="visibility:hidden;"class="nav-link inactive_tab1" id="list_booking_details" style="border:1px solid #ccc"></a>
     </li>
    </ul>
    <div class="tab-content" style="margin-top:16px;">
    <!---Start:Loogin Detail/CNIC------>
     <div class="tab-pane active" id="login_details">
      <div class="panel panel-default">
       <div class="panel-heading">Enter Your CNIC</div>
       <div class="panel-body">
       
        <div class="form-group">
         <label>Enter CNIC</label>
          <form name="myform" action="book" method="post" enctype="multipart/form-data">

         <input type="text" onBlur="testCNIC(this)" name="cnic" id="cnic" class="form-control" />
          <input type="hidden" value="<?php echo $_GET['id'];?>"  name="plot_id" id="plot_id" class="form-control" />
            
           <p id="rsp1"></p>
         <span id="error_cnic" class="text-danger"></span>
        </div>
        <br />
        <div align="center">
         <button type="button" name="btn_login_details" id="btn_login_details" class="btn-lg">Next</button>
        </div>
        <br />
       </div>
      </div>
     </div>
     <!-----End:Loogin Detail/CNIC------>
       <!---Start:Personal Detail------>
     <div class="tab-pane fade" id="personal_details">
      <div class="panel panel-default">
       <div class="panel-heading">Personal Details</div>
       <div class="panel-body">
       <div id="fields">
        <div class="form-group">
         <label>Enter Name</label>
         <input type="text" name="name" id="name" class="form-control" />
       
         <span id="error_name" class="text-danger"></span>
        </div>
        <div class="form-group">
         <label>Enter Email</label>
         <input type="text" name="email" id="email" class="form-control" />
         <span id="error_email" class="text-danger"></span>
        </div>
        
        <div class="form-group">
         <label>Enter DOB</label>
            <input type="text" name="dob" id="dob" placeholder="DD-MM-YYYY" class="form-control" />
         <span id="error_dob" class="text-danger"></span>
        </div>
        <div class="form-group">
         <label>Father/Spouse</label>
         <select class="form-control" name="title" style="width:160px;">
                        <option value="">---</option>
                        <option value="s/o">s/o</option>
                         <option value="d/o">d/o</option>
                          <option value="w/o">w/o</option>
                        </select>
                         <input class="form-control" type="text" value="" name="sodowo" id="sodowo"/>
         <span id="error_sodowo" class="text-danger"></span>
        </div>
		<div class="form-group">
         <label>Enter Mobile No.</label>
         <input type="number" name="phone" id="phone" class="form-control" />
         <span id="error_phone" class="text-danger"></span>
        </div> 
        <br />
        <div class="form-group">
         <label>Address.</label>
         <input type="text" name="address" id="address" class="form-control" />
         <span id="error_address" class="text-danger"></span>
        </div>
        <div class="form-group">
         <label>Picture</label>
          <input type='file' id='picture' name='picture'><br>
         <span id="error_picture" class="text-danger"></span>
        </div>
        <br />
        
        
        <div class="form-group">
         <label>Country</label>
         <select name="country" id="country" class="form-control">
                        <option value="">Please Select Country </option>
                        <?php	
                            $res=array();
                            foreach($country as $key){
                            echo '<option value="'.$key['id'].'">'.$key['country'].'</option>'; 
                           }?>
                      </select>
         <span id="error_country" class="text-danger"></span>
        </div>
        <br />
        <div class="form-group">
         <label>City</label>
         <select name="city_id" id="city_id" class="form-control">
                    <option value="" >Please Select City </option>
                  </select>
         <span id="error_city_id" class="text-danger"></span>
        </div>
        <div class="form-group">
         <label>Enter Booking Channel (Dealer/Direct)</label>
           <input type="text" name="dealer" id="dealer" class="form-control" />
         <span id="error_dealer" class="text-danger"></span>
        </div>
        <hr />
        <div class="form-group">
         <label>Nominee Name</label>
         <input type="text" name="nomineename" id="nomineename" class="form-control" />
         <span id="error_nomineename" class="text-danger"></span>
        </div> 
        <br />
        <div class="form-group">
         <label>Nominee CNIC</label>
         <input type="text" name="nomineecnic" id="nomineecnic" class="form-control" />
         <span id="error_nomineecnic" class="text-danger"></span>
        </div> 
        <br />
        <div class="form-group">
         <label>Relation With Applicant</label>
         <input type="text" name="rwa" id="rwa" class="form-control" />
         <span id="error_rwa" class="text-danger"></span>
        </div> 
        <br />
       </div>
       <div id="table">
       <table class="table table-striped table-new table-bordered">
<thead style="background:#666; border-color:#ccc; color:#fff;">
<tr>
<td colspan="3"  align="center"><h4> <strong>Member Detail</strong></h4></td>
</tr>
</thead>
<tbody>
<tr>
<td>Name.</td>
<td><input type="text" name="name1" id="name1" readonly="readonly" />
  <input type="hidden" value=""  name="member_id" id="member_id" class="form-control" />
</td>
<td rowspan="2" >
 <div id="image"></div>

</td>
</tr>
<tr>
<td>Father/Spouse.</td>
<td><input type="text" name="sodowo1" id="sodowo1" readonly="readonly" /></td>
</tr>
<tr>
<td>Mobile/Phone</td>
<td><input type="text" name="phone1" id="phone1" readonly="readonly" /></td>
</tr>
<tr>
<td>Email</td>
<td><input type="text" name="email1" id="email1" readonly="readonly" /></td>
</tr>
<tr>
<td>Address</td>
<td><input type="text" name="ad" id="ad" readonly="readonly" /></td>
</tr>
<tr>
<td>Nominee Name</td>
<td><input type="text" name="nomineename1" id="nomineename1" readonly="readonly" /></td>
</tr>
<tr>
<td>Nominee CNIC</td>
<td><input type="text" name="nomineecnic1" id="nomineecnic1" readonly="readonly" /></td>
</tr>
<tr>
<td>Relation With Applicant</td>
<td><input type="text" name="rwa1" id="rwa1" readonly="readonly" /></td>
</tr>
</tbody>
</table>
       </div>
        <div align="center">
         <button type="button" name="previous_btn_personal_details" id="previous_btn_personal_details" class="btn btn-default btn-lg">Previous</button>
         <button type="button" name="btn_personal_details" id="btn_personal_details" class="btn btn-info btn-lg">Next</button>
        </div>
        <br />
       </div>
      </div>
     </div>
       <!---End:Personal Detail------>
          <!---Start:Payment Detail------>
     <div class="tab-pane fade" id="payment_details">
      <div class="panel panel-default">
       <div class="panel-heading">Payment Verification</div>
       <div class="panel-body">
        <br />  
         <div class="form-group">
         <label>Reference No.</label>
         <input type="text" name="reference_no" id="reference_no" class="form-control" />
         <span id="error_reference_no" class="text-danger"></span>
        </div>
        <div class="form-group">
         <label>Transaction Date.</label>
         <input type="text" name="transaction_date" placeholder="DD-MM-YYYY" id="transaction_date" class="form-control" />
         <span id="error_transaction_date" class="text-danger"></span>
        </div>
      <div class="form-group">
         <label>Payment Evidence</label>
          <input type='file' id='receipt' name='receipt'><br>
         <span id="error_receipt" class="text-danger"></span>
        </div>
           </div> 
          <div align="center">
         <button type="button" name="previous_btn_payment_details" id="previous_btn_payment_details" class="btn btn-default btn-lg">Previous</button> 
        <button type="submit" name="btn_payment_details" id="btn_payment_details" class="btn btn-success btn-lg">Book My Plot</button>
        </form>
         <?php /* echo CHtml::ajaxSubmitButton(
                        'Book Plot', array('web/book'),
                                array('beforeSend' => 'function(){ 
                                             $("#submit").attr("disabled",true);}','complete' => 'function(){ 
                                             $("#plots").each(function(){ });
                                             $("#submit").attr("disabled",false);}',
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
									 array("id"=>"login","class" => "btn btn-success btn-lg")      );*/ ?>
  									<?php // $this->endWidget(); ?>
        </div>
        <br />     
       </div>
      </div>
         <!---End:Payment Detail------>
           <!---Start:Final Approval Detail------>
      <div class="tab-pane fade" id="booking_details">
      <div class="panel panel-default">
       <div class="panel-heading">Approval</div>
       <div class="panel-body">
         
        </div> 
        <div align="center">
         <button type="button" name="previous_btn_contact_details" id="previous_btn_contact_details" class="btn btn-default btn-lg">Previous</button> 
        <button type="button" name="btn_contact_details" id="btn_contact_details1" class="btn btn-success btn-lg">Book</button> 
        </div>
        <br />     
       </div>
      </div>        
       <!---End:Final Approval Detail------>
       </div>
    </div>
</div>
<script >
$(document).ready(function()
     {  	   
	
       $("#subbtn").hide();
       $("#country").change(function()
           {
         	select_city($(this).val());
		   });
     });
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
}
);
listItems+= "<option value='' data-toggle=modal data-target=.bs-example-modal-sm  >Other</option>";
$("#city_id").html(listItems);

}
}
);
}
($('#payment_mode').val()=='online')
{
	$('#image').show();
}
$("#cnic").change(function()
           {
         	select_cnic($(this).val());
		   });
function select_cnic(id)
{
	
$.ajax({
      type: "POST",
      url:    "ajaxRequest5?val1="+id,
   contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var member_id='';
var name1='';
var ad='';
var sodowo1='';
var dob='';
var email1='';
var phone1='';
var image='';
var nomineename1='';
var nomineecnic1='';
var rwa1='';
 $(json).each(function(i,val){
$('#table').show();
 $('#fields').hide();
 member_id+= "" + val.id + "";
 name1+= "" + val.name + "";
 ad+= "" + val.address + "";
 sodowo1+= "" + val.sodowo + "";
 dob+= "" + val.dob + "";
 email1+= "" + val.email + "";
 phone1+= "" + val.phone + "";
 image+= '<img style="height:150px" src="/upload_pic/' + val.image +'"/>';
 nomineename1+= "" + val.nomineename + "";
 nomineecnic1+= "" + val.nomineecnic + "";
 rwa1+= "" + val.rwa + "";


});
		
if(city_id==''){ 
select_city($(this).val());
}
name1+="";
$("#member_id").val(member_id);
$("#image").html(image);
$("#ad").val(ad);
$("#name1").val(name1);
$("#sodowo1").val(sodowo1);
$("#dob").val(dob);
$("#email1").val(email1);
$("#phone1").val(phone1);
$("#nomineename1").val(nomineename1);
$("#nomineecnic1").val(nomineecnic1);
$("#rwa1").val(rwa1);



var error_name='';
}
	
});
 $('#table').hide();
	    $('#fields').show();
}

function testCNIC(objNpt){
 var n=objNpt.value.replace(/[^\d]+/g,'');// replace all non digits
 if (n.length!=13) {
  document.getElementById('rsp1').innerHTML="Please Enter 13 Digit CNIC Number without spaces/Slashes !";
  return;}
  document.getElementById('rsp1').innerHTML=""; 
 objNpt.value=n.replace(/(\d\d\d\d\d)(\d\d\d\d\d\d\d)(\d)/,'$1$2$3');// format the number
}
$(document).ready(function(){
 
 $('#btn_login_details').click(function(){
  
  var error_cnic = '';
  var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  
  
  if($.trim($('#cnic').val()).length == 0)
  {
   error_cnic = 'CNIC is required';
   $('#error_cnic').text(error_cnic);
   $('#cnic').addClass('has-error');
  }
  else
  {
   error_cnic = '';
   $('#error_cnic').text(error_cnic);
   $('#cnic').removeClass('has-error');
  }

  if(error_cnic != '')
  {
   return false;
  }
  else
  {
   $('#list_login_details').removeClass('active active_tab1');
   $('#list_login_details').removeAttr('href data-toggle');
   $('#login_details').removeClass('active');
   $('#list_login_details').addClass('inactive_tab1');
   $('#list_personal_details').removeClass('inactive_tab1');
   $('#list_personal_details').addClass('active_tab1 active');
   $('#list_personal_details').attr('href', '#personal_details');
   $('#list_personal_details').attr('data-toggle', 'tab');
   $('#personal_details').addClass('active in');
  }
 });
 
 $('#previous_btn_personal_details').click(function(){
  $('#list_personal_details').removeClass('active active_tab1');
  $('#list_personal_details').removeAttr('href data-toggle');
  $('#personal_details').removeClass('active in');
  $('#list_personal_details').addClass('inactive_tab1');
  $('#list_login_details').removeClass('inactive_tab1');
  $('#list_login_details').addClass('active_tab1 active');
  $('#list_login_details').attr('href', '#login_details');
  $('#list_login_details').attr('data-toggle', 'tab');
  $('#login_details').addClass('active in');
 });
 
 $('#btn_personal_details').click(function(){
  var error_name = '';
  var error_email = '';
   var error_dob = '';
  var error_sodowo='';
  var error_phone='';
  var error_country='';
  var error_city_id='';
  var error_address='';
  var error_picture = '';
  var error_nomineename = '';
  var error_nomineecnic = '';
  var error_rwa = '';
  if($.trim($('#name').val()).length == 0)
  {
   error_name = 'Name is required';
   $('#error_name').text(error_name);
   $('#name').addClass('has-error');
  }
  else
  {
   error_name = '';
   $('#error_name').text(error_name);
   $('#name').removeClass('has-error');
  }
  
  if($.trim($('#email').val()).length == 0)
  {
   error_email = 'Email Address is required';
   $('#error_email').text(error_email);
   $('#email').addClass('has-error');
  }
  else
  {
   error_email = '';
   $('#error_email').text(error_email);
   $('#email').removeClass('has-error');
  }
	////////DOB//////////
	if($.trim($('#dob').val()).length == 0)
  {
   error_dob = 'Date of birth is required';
   $('#error_dob').text(error_dob);
   $('#dob').addClass('has-error');
  }
  else
  {
   error_dob = '';
   $('#error_dob').text(error_dob);
   $('#dob').removeClass('has-error');
  }
	/////////////////////
	////////Father/Spouse//////////
	if($.trim($('#sodowo').val()).length == 0)
  {
   error_sodowo = 'Father/Spouse is required';
   $('#error_sodowo').text(error_sodowo);
   $('#sodowo').addClass('has-error');
  }
  else
  {
   error_sodowo = '';
   $('#error_sodowo').text(error_sodowo);
   $('#sodowo').removeClass('has-error');
  }
	/////////////////////
	////////picture//////////
	if($.trim($('#picture').val()).length == 0)
  {
   error_picture = 'Your picture is required';
   $('#error_picture').text(error_picture);
   $('#picture').addClass('has-error');
  }
  else
  {
   error_picture = '';
   $('#error_picture').text(error_picture);
   $('#picture').removeClass('has-error');
  }
	/////////////////////
	////////Phone/Mobile//////////
	if($.trim($('#phone').val()).length == 0)
  {
   error_phone = 'Phone # is required';
   $('#error_phone').text(error_phone);
   $('#phone').addClass('has-error');
  }
  else
  {
   error_phone = '';
   $('#error_phone').text(error_phone);
   $('#phone').removeClass('has-error');
  }
	/////////////////////
	////////Address//////////
	if($.trim($('#address').val()).length == 0)
  {
   error_address = 'Address is required';
   $('#error_address').text(error_address);
   $('#address').addClass('has-error');
  }
  else
  {
   error_address = '';
   $('#error_address').text(error_address);
   $('#address').removeClass('has-error');
  }
	/////////////////////
	////////Country//////////
	if($.trim($('#country').val()).length == '')
 	 {
	   error_country = 'Country  is required';
	   $('#error_country').text(error_country);
	   $('#country').addClass('has-error');
	  }
  else
	  {
	   error_country = '';
	   $('#error_country').text(error_country);
	   $('#country').removeClass('has-error');
	  }
    /////////////////////

	////////City //////////
	if($.trim($('#city_id').val()).length == '')
 	 {
	   error_city_id = 'City  is required';
	   $('#error_city_id').text(error_city_id);
	   $('#error_city_id').addClass('has-error');
	  }
  else
	  {
	   error_city_id = '';
	   $('#error_city_id').text(error_city_id);
	   $('#city_id').removeClass('has-error');
	  }
    /////////////////////
	
	////////Nominee Name //////////
	if($.trim($('#nomineename').val()).length == 0)
  {
   error_nomineename = 'Nominee Name is required';
   $('#error_nomineename').text(error_nomineename);
   $('#nomineename').addClass('has-error');
  }
  else
  {
   error_nomineename = '';
   $('#error_nomineename').text(error_nomineename);
   $('#nomineename').removeClass('has-error');
  }
    /////////////////////
	////////Nominee CNIC //////////
	if($.trim($('#nomineecnic').val()).length == 0)
  {
   error_nomineecnic = 'Nominee CNIC is required';
   $('#error_nomineecnic').text(error_nomineecnic);
   $('#nomineecnic').addClass('has-error');
  }
  else
  {
   error_nomineecnic = '';
   $('#error_nomineecnic').text(error_nomineecnic);
   $('#nomineecnic').removeClass('has-error');
  }
    /////////////////////
	////////RWA //////////
	if($.trim($('#rwa').val()).length == 0)
  {
   error_rwa = 'Relation With Applicant is required';
   $('#error_rwa').text(error_rwa);
   $('#rwa').addClass('has-error');
  }
  else
  {
   error_rwa = '';
   $('#error_rwa').text(error_rwa);
   $('#rwa').removeClass('has-error');
  }
    /////////////////////
	
	////////Dealer///////////
	if($.trim($('#dealer').val()).length == '')
 	 {
	   error_dealer = 'Booking Channel  is required';
	   $('#error_dealer').text(error_dealer);
	   $('#error_dealer').addClass('has-error');
	  }
  else
	  {
	   error_dealer = '';
	   $('#error_dealer').text(error_dealer);
	   $('#dealer').removeClass('has-error');
	  }
	////////////////////////
	if($.trim($('#name1').val()).length == '')
  	{
		

  if(error_name != '' || error_email != '' || error_sodowo !=''|| error_phone !=''|| error_address !='' )
  { 
   return false;
  }
  else
  {
   $('#list_personal_details').removeClass('active active_tab1');
   $('#list_personal_details').removeAttr('href data-toggle');
   $('#personal_details').removeClass('active');
   $('#list_personal_details').addClass('inactive_tab1');
   $('#list_payment_details').removeClass('inactive_tab1');
   $('#list_payment_details').addClass('active_tab1 active');
   $('#list_payment_details').attr('href', '#payment_details');
   $('#list_payment_details').attr('data-toggle', 'tab');
   $('#payment_details').addClass('active in');
  }
  }else{
	 $('#list_personal_details').removeClass('active active_tab1');
   $('#list_personal_details').removeAttr('href data-toggle');
   $('#personal_details').removeClass('active');
   $('#list_personal_details').addClass('inactive_tab1');
   $('#list_payment_details').removeClass('inactive_tab1');
   $('#list_payment_details').addClass('active_tab1 active');
   $('#list_payment_details').attr('href', '#payment_details');
   $('#list_payment_details').attr('data-toggle', 'tab');
   $('#payment_details').addClass('active in');
	  }
 });
 
 $('#previous_btn_payment_details').click(function(){
  $('#list_payment_details').removeClass('active active_tab1');
  $('#list_payment_details').removeAttr('href data-toggle');
  $('#payment_details').removeClass('active in');
  $('#list_payment_details').addClass('inactive_tab1');
  $('#list_personal_details').removeClass('inactive_tab1');
  $('#list_personal_details').addClass('active_tab1 active');
  $('#list_personal_details').attr('href', '#personal_details');
  $('#list_personal_details').attr('data-toggle', 'tab');
  $('#personal_details').addClass('active in');
 });
 
 $('#btn_payment_details').click(function(){
  
  var error_transaction_date = '';
  var error_reference_no = '';
  var error_receipt = '';
  
   if($.trim($('#reference_no').val()).length == 0)
  {
   error_reference_no = 'Reference No is required';
   $('#error_reference_no').text(error_reference_no);
   $('#reference_no').addClass('has-error');
  }
  else
  {
   error_reference_no = '';
   $('#error_reference_no').text(error_reference_no);
   $('#reference_no').removeClass('has-error');
  }
  if($.trim($('#transaction_date').val()).length == 0)
  {
   error_transaction_date = 'Transaction Date is required';
   $('#error_transaction_date').text(error_transaction_date);
   $('#transaction_date').addClass('has-error');
  }
  else
  {
   error_transaction_date = '';
   $('#error_transaction_date').text(error_transaction_date);
   $('#transaction_date').removeClass('has-error');
  }
  if($.trim($('#receipt').val()).length == 0)
  {
   error_receipt = 'Payment Evidence is required';
   $('#error_receipt').text(error_receipt);
   $('#receipt').addClass('has-error');
  }
  else
  {
   error_receipt = '';
   $('#error_receipt').text(error_receipt);
   $('#receipt').removeClass('has-error');
  }

  if(error_reference_no != ''|| error_transaction_date!=''|| error_receipt!='')
  {
   return false;
  }
  else
  {
   $('#list_payment_details').removeClass('active active_tab1');
   $('#list_payment_details').removeAttr('href data-toggle');
   $('#payment_details').removeClass('active');
   $('#list_payment_details').addClass('inactive_tab1');
   $('#list_booking_details').removeClass('inactive_tab1');
   $('#list_booking_details').addClass('active_tab1 active');
   $('#list_booking_details').attr('href', '#booking_details');
   $('#list_booking_details').attr('data-toggle', 'tab');
   $('#booking_details').addClass('active in');
  }
 });
 
});
</script> 
 

<!-- section 3 --> 
</div>
</div>
</div>
