<div class="shadow">
  <h3>Member Registration</h3>
</div>
<script src="//code.jquery.com/jquery-1.10.2.js"></script> 
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.js"></script> 

<!-- shadow -->

<hr noshade="noshade" class="hr-5">
<section class="reg-section margin-top-30">
  <div id="error-div" class="errorMessage" style="display: none; color:#F00;"></div>
  
  <!--  <form action="create" method="post" onsubmit="return validateForm()">-->

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
  <div class="float-left">
    <p class="reg-left-text">Name<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" name="name" id="name" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Date Of Birth<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5"> 
      
      <input type="text" value="" name="dob" id="dob" class="reg-login-text-field" class="new-input"  />
    </p>
  </div>
 <div class="float-left">
    <p class="reg-left-text">Father/Spouse<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
    <select name="title" style="width:60px;">
    <option value="">---</option>
    <option value="s/o">s/o</option>
     <option value="d/o">d/o</option>
      <option value="w/o">w/o</option>
    </select>
      <input type="text" value="" name="sodowo" id="sodowo" class="reg-login-text-field" style="width:238px;" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">CNIC<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" onBlur="testPhone(this)" name="cnic" id="cnic" class="reg-login-text-field" />
    <p id="rsp"></p>
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Address<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" name="address" id="address" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Email<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="email" value="" name="email" id="email" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Country<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <select name="country" id="country">
        <option value="country">Please Select Country </option>
        <?php	



            $res=array();



            foreach($country as $key){



            echo '<option value="'.$key['id'].'">'.$key['country'].'</option>'; 



            }?>
      </select>
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">City<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <select name="city_id" id="city_id">
        <option value="city" >please Select City </option>
     
      </select>
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Mobile<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" name="phone" id="phone" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Nominee Name<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" name="nomineename" id="nomineename" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Nominee CNIC<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" name="nomineecnic" id="nomineecnic" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Relation With Applicant<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" name="rwa" id="rwa" class="reg-login-text-field" />
    </p>
  </div><br>
  <div class="float-left">
   
    <p class="reg-right-field-area margin-left-5">
<lable>Dealer</lable>
      <input type="checkbox" value="Dealer" name="mtype" id="mtype" class="reg-login-text-field" />
    </p>
  </div>
  <?php echo CHtml::ajaxSubmitButton(
                                'Add Member',
    array('member/create'),
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
  
  <div class="float-left">
   
    <p class="reg-right-field-area margin-left-5">

     <span style="float:left; color:red;">Note: If City not found in city list click "Other" for add new City </span>
    </p>
  </div>

  <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
    <form action="addcity" method="post"   enctype="multipart/form-data">

    <div class="float-left">

    <p class="reg-left-text">City Name<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" value="" name="city" id="city" class="form-control" placeholder="Enter City name" />

    </p>

  </div>
        <div class="float-left">

    <p class="reg-left-text">Country</p>

	<p class="reg-right-field-area margin-left-5">

   <select name="country_id" id="country_id">

   <?php

   foreach($country as $key1)

   {

	echo ' 	<option value="'.$key1['id'].'">'.$key1['country'].'</option>';   

   }

   

   ?>



  	</select>

    </p>

    </div>

  

     <div class="float-left">

    <p class="reg-left-text">Zip Code</p>

	<p class="reg-right-field-area margin-left-5">

    <input id="zipcode" type="text" name="zipcode" >

    </p>

    </div>
    
     <div class="float-left">

	<p class="reg-right-field-area margin-left-5">

   <button type="submit" class="btn btn-info">Add City</button>

    </p>

    </div>
</form>
	

   

	  
	  
	  
    </div>
  </div>
</div>
  <!--VALIDATION START--> 
  
  <script>

function myfunc(){
	
	alert('asass');
	}





function validateForm(){



	



	$("#error-name").hide();



	$("#error-dob").hide();



	$("#error-sodowo").hide();



	$("#error-cnic").hide();



	$("#error-address").hide();



	$("#error-email").hide();



	$("#error-country").hide();



	$("#error-city").hide();



	$("#error-phone").hide();



	$("#error-nomineename").hide();



	$("#error-nomineecnic").hide();



	$("#error-rwa").hide();



	//	var x=document.forms["form"]["firstname"].value;



	var k = $("#name").val();





	var y = $("#username").val();



	var z = $("#password").val();



	var a = $("#dob").val();



	var b = $("#sodowo").val();



	var c = $("#cnic").val();



	var d = $("#address").val();



	var e = $("#email").val();



	var f = $("#country").val();



	var g = $("#city_id").val();



	var h = $("#phone").val();



	var i = $("#nomineename").val();



	var p = $("#nomineecnic").val();



	var q = $("#rwa").val();







var counter=0;







if (k==null || k=="")



  {



  $("#error-name").html("Enter Name");



  $("#error-name").show();



  counter =1;



  }









  if (a==null || a=="")



  {



  $("#error-dob").html("Enter D.O.B");



  $("#error-dob").show();



  counter =1;



  }



  if (b==null || b=="")



  {



  $("#error-sodowo").html("Enter Son of/Daughter Of/Wife Of");



  $("#error-sodowo").show();



  counter =1;



  }



  if (c==null || c=="")



  {



  $("#error-cnic").html("Enter CNIC");



  $("#error-cnic").show();



  counter =1;



  }



  if (d==null || d=="")



  {



  $("#error-address").html("Enter Address");



  $("#error-address").show();



  counter =1;



  }



  if (e==null || e=="")



  {



  $("#error-email").html("Enter Email");



  $("#error-email").show();



  counter =1;



  }



  if (f==null || f=="")



  {



  $("#error-country").html("Enter Country");



  $("#error-country").show();



  counter =1;



  }  



   if (g==null || g=="")



  {



  $("#error-city").html("Enter City");



  $("#error-city").show();



  counter =1;



  }  



   if (h==null || h=="")



  {



  $("#error-phone").html("Enter Mobile #");



  $("#error-phone").show();



  counter =1;



  }      



    if (i==null || i=="")



  {



  $("#error-nomineename").html("Enter Nominee Name");



  $("#error-nomineename").show();



  counter =1;



  }      



    if (p==null || p=="")



  {



  $("#error-nomineecnic").html("Enter Nominee CNIC");



  $("#error-nomineecnic").show();



  counter =1;



  }      



    if (q==null || q=="")



  {



  $("#error-rwa").html("Enter relation with applicant");



  $("#error-rwa").show();



  counter =1;



  }      



 if(counter==1)



  	return false;



  



}



 <!--VALIDATION END-->



 </script> 
  <script>



 



  $(document).ready(function()



     {  	



		



       $("#project").change(function()



           {



         	select_street($(this).val());



		   });



		   



		   $("#street_id").change(function()



           {



         	select_plot($(this).val());



		   });



       $("#country").change(function()



           {



         	select_city($(this).val());



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



function select_plot(id)



{



$.ajax({



      type: "POST",



      url:    "ajaxRequest1?val1="+id,



	  contenetType:"json",



      success: function(jsonList){var json = $.parseJSON(jsonList);



	  



var listItems='';



	$(json).each(function(i,val){



	listItems+= "<option value='" + val.id + "'>" + val.plot_detail_address +" ("+val.plot_size+")</option>";



      



});listItems+="";







$("#plot_id").html(listItems);



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
    



      



}

);


listItems+= "<option value='' data-toggle=modal data-target=.bs-example-modal-sm  >Other</option>";





$("#city_id").html(listItems);



          }



});







}



</script> 
  <script type="text/javascript">



function testPhone(objNpt){



 var n=objNpt.value.replace(/[^\d]+/g,'');// replace all non digits



 if (n.length!=13) {



  document.getElementById('rsp').innerHTML="Please Enter 13 Digit CNIC Number without spaces/Slashes !";



  return;}



  document.getElementById('rsp').innerHTML=""; 



 objNpt.value=n.replace(/(\d\d\d\d\d)(\d\d\d\d\d\d\d)(\d)/,'$1$2$3');// format the number



}



</script> 
</section>

<!-- section 3 -->

