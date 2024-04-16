<div class="shadow">

  <h3>Add New User</h3>

</div>

<!-- shadow -->

<hr noshade="noshade" class="hr-5 ">


   

   </div> 
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


<div class="span12">
<div class="span4">

  <div class="float-left">

    <p class="reg-left-text">First Name <font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" value="" name="firstname" id="firstname" class="reg-login-text-field" />

    </p>

  </div>

  <div class="float-left">

    <p class="reg-left-text">Middel Name <font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" value="" name="middelname" id="middelname" class="reg-login-text-field" />

    </p>

  </div>

  <div class="float-left">

    <p class="reg-left-text">Last Name <font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" value="" name="lastname" id="lastname" class="reg-login-text-field" />

    </p>

  </div>

  

  <div class="float-left">

    <p class="reg-left-text">S/O-D/O-W/O <font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" value="" name="sodowo" id="sodowo" class="reg-login-text-field" />

    </p>

  </div>

  <div class="float-left">

    <p class="reg-left-text">CNIC<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" value="" name="cnic" id="cnic" class="reg-login-text-field" />

    </p>

  </div>

  <div class="float-left">

    <p class="reg-left-text">Address<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" value="" name="address" id="address" class="reg-login-text-field" />

    </p>

  </div>

  <div class="float-left">

    <p class="reg-left-text">Email Address <font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="email" value="" name="email" id="email" class="reg-login-text-field" />

    </p>

  </div>
  <div class="float-left">

    <p class="reg-left-text">Mobile #  <font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" value="" name="mobile" id="mobile" class="reg-login-text-field" />

    </p>

  </div>

  </div>

  <div class="span4">

  <div class="float-left">

    <p class="reg-left-text">City<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" value="" name="city" id="city" class="reg-login-text-field" />

    </p>

  </div>

  <div class="float-left">

    <p class="reg-left-text">State<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" value="" name="state" id="state" class="reg-login-text-field" />

    </p>

  </div>

  <div class="float-left">

    <p class="reg-left-text">Zip<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" value="" name="zip" id="zip" class="reg-login-text-field" />

    </p>

  </div>

  <div class="float-left">

    <p class="reg-left-text">Country<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" value="" name="country" id="country" class="reg-login-text-field" />

    </p>

  </div>

  <div class="float-left">

    <p class="reg-left-text">User Login Name <font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" value="" id="username" name="username" class="reg-login-text-field" />

    </p>

  </div>

  <div class="float-left">

    <p class="reg-left-text">Password <font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="password" value="" name="password" id="password" class="reg-login-text-field" />

    </p>

  </div>

  <div class="float-left">

    <p class="reg-left-text">Confirm Password <font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="password" value="" name="confirm_password" id="con_password" class="reg-login-text-field" />

    </p>

  </div>

  <?php $connection = Yii::app()->db;  
		$sql_plot  = "SELECT * from sales_center";
		$result_plots = $connection->createCommand($sql_plot)->queryAll();
		 ?>

  <div class="float-left">

    <p class="reg-left-text">Office Location<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">
<select name="sales" id="sales">
<option value="">Select Office Location</option>
<?php foreach($result_plots as $row12){
echo '<option value="'.$row12['id'].'">'.$row12['name'].'</option>';
}
?>
</select>
   
    </p>

  </div>
  </div>
<div class="span4">
<div class="checkbox margin-left-144 margin-top-15">

   <h3>User Permission</h3>

   <div>

    <input name="per1" type="checkbox" value="1" id="per1" />

    <label for="checkbox"></label>

  	<p class="">Add/Remove User/Setting (PER1)</p>

    </div>

    <input name="per2" type="checkbox" value="1" class="float-left2" id="per2" />

    <label for="checkbox"></label>

  	<p class="">Allot Plot/File to any Member/Memberplot/File Search/Add Remove New Member(PER2)</p>

    

    <input name="per3" type="checkbox" value="1" class="float-left2" id="per3" />

    <label for="checkbox"></label>

  	<p class="">Add New Scheme(Plot/File/Street/Category,Charges,Property),Installment Plan(PER3)</p>

    

    <input name="per4" type="checkbox" value="1" class="float-left2" id="per4" />

    <label for="checkbox"></label>

  	<p class="">Add Pages/Menu/Downloads(PER4)</p>

    

    <input name="per5" type="checkbox" value="1" class="float-left2" id="per5" />

    <label for="checkbox"></label>

  	<p class="">Add Media/Image Gallery/News/Virtual Tour,News,File Manager,Slider,Center,country,City(PER5)</p>

    

    <input name="per6" type="checkbox" value="1" class="float-left2" id="per6" />
 
    <label for="checkbox"></label>

    <p class="">Transfer Plot Requests (View/Update)/Allotment Requests(PER6)</p>

    

    <input name="per7" type="checkbox" value="1" class="float-left2" id="per7" />

    <label for="checkbox"></label>

    <p class="">Balloting/Balloting Draw/Manage Projects(PER7)</p> 

    

    <input name="per8" type="checkbox" value="1" class="float-left2" id="per8" />

    <label for="checkbox"></label>

    <p class="">Message From Registered/Un-Registered Users/Email(PER8)</p>

    
    <input name="per9" type="checkbox" value="1" class="float-left2" id="per9" />

    <label for="checkbox"></label>

    <p class="">Finance System(PER9)</p>
 
    <input name="per10" type="checkbox" value="1" class="float-left2" id="per10" />

    <label for="checkbox"></label>

    <p class="">Finger Print Registeration/Verification(PER10)</p>
     <input name="per11" type="checkbox" value="1" class="float-left2" id="per11" />
     <label for="checkbox"></label>

    
    <p class="">Reporting(PER11)</p>

     <input name="per12" type="checkbox" value="1" class="float-left2" id="per12" />

    <label for="checkbox"></label>
    <p class="">Sales Centers(PER12)</p>
     
 <input name="per13" type="checkbox" value="1" class="float-left2" id="per13" />
    <label for="checkbox"></label>
    <p class="">Form Management(PER13)</p>
    
 <input name="per14" type="checkbox" value="1" class="float-left2" id="per14" />
    <label for="checkbox"></label>
    <p class="">Form Reporting(PER14)</p>
    
 <input name="per15" type="checkbox" value="1" class="float-left2" id="per15" />
    <label for="checkbox"></label>
    <p class="">Form Finance(PER15)</p>
    

<input name="per16" type="checkbox" value="1" class="float-left2" id="per16" />
    <label for="checkbox"></label>
	<p class="">Form User(PER16)</p>
<input name="per17" type="checkbox" value="1" class="float-left2" id="per17" />
    <label for="checkbox"></label>
    <p class="">Form Editor(PER17)</p>
    <input name="per18" type="checkbox" value="1" class="float-left2" id="per18" />
    <label for="checkbox"></label>
    <p class="">Receipt(PER18)</p>
<input name="per19" type="checkbox" value="1" class="float-left2" id="per19" />
    <label for="checkbox"></label>
    <p class="">Sales Administrator (Receipt)(PER19)</p>
<input name="per20" type="checkbox" value="1" class="float-left2" id="per20" />
    <label for="checkbox"></label>
    <p class="">Sales Administrator (Transfer/Allotment)(PER20)</p>        
    <input name="per21" type="checkbox" value="1" class="float-left2" id="per21" />
    <label for="checkbox"></label>
    <p class="">Receipt Administrator(PER21)</p>        
  <input name="per31" type="checkbox" value="1" class="float-left2" id="per31" />
    <label for="checkbox"></label>
    <p class="">Recovery System(PER31)</p>        
 <input name="per32" type="checkbox" value="1" class="float-left2" id="per32" />
    <label for="checkbox"></label>
    <p class="">Plot Status User(PER32)</p>
 <input name="per33" type="checkbox" value="1" class="float-left2" id="per33" />
    <label for="checkbox"></label>
    <p class="">Cancellation (PER33)</p> 
     <input name="per34" type="checkbox" value="1" class="float-left2" id="per34" />
    <label for="checkbox"></label>
    <p class="">Audit (PER34)</p> 
      <input name="per35" type="checkbox" value="1" class="float-left2" id="per35" />
    <label for="checkbox"></label>
    <p class="">Manage Surcharges (PER35)</p> 
        <input name="per_bcd_mgm" type="checkbox" value="1" class="float-left2" id="per_bcd_mgm" />
        <label for="checkbox"></label>
        <p class="">BCD Management</p>
        <input name="per_bcd_rpt" type="checkbox" value="1" class="float-left2" id="per_bcd_rpt" />
        <label for="checkbox"></label>
        <p class="">BCD Reporting</p>
<p>
    <h3>Projects Permission</h3>
<p>

    

    <?php 

	

	$res=array();

	$i = 1;

	foreach($project_result as $project_result)

	{

		

	echo'

    <input name="'.$i.'" type="checkbox" value="'.$project_result['id'].'" />

	<label for="checkbox">'.$project_result['project_name'].'</label>

	';

	$i++;

	}

	?>

    </p>

    

    

    <br><br>

    
</div></div>
  <?php echo CHtml::ajaxSubmitButton(

                                'Add User',

    array('Add_usr'),

                                array(  

                'beforeSend' => 'function(){ 

                                             $("#submit").attr("disabled",true);

            }',

                                        'complete' => 'function(){ 

                                             $("#user_login_form").each(function(){ });

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


      </div>

    

 



 </section>

<!-- section 3 --> 

<!--VALIDATION START-->

 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<script>



function validateForm(){

	

	$("#error-firstname").hide();

	
	$("#error-sodowo").hide();

	$("#error-cnic").hide();

	$("#error-address").hide();

	$("#error-email").hide();

	$("#error-country").hide();

	$("#error-city").hide();

	$("#error-state").hide();

	$("#error-zip").hide();

	$("#error-username").hide();

	$("#error-password").hide();

	$("#error-con_password").hide();



	//	var x=document.forms["form"]["firstname"].value;

	var a = $("#firstname").val();

	
	var d = $("#sodowo").val();

	var e = $("#cnic").val();

	var f = $("#address").val();

	var g = $("#email").val();

	

	var h = $("#state").val();

	var i = $("#zip").val();

	var j = $("#country").val();

	var k = $("#city").val();

	var l = $("#username").val();

	var m = $("#password").val();

	var n = $("#con_password").val();



var counter=0;



if (a==null || a=="")

  {

  $("#error-firstname").html("Enter First Name");

  $("#error-firstname").show();

  counter =1;

  }


  if (d==null || d=="")

  {

  $("#error-sodowo").html("Enter Son of/Daughter Of/Wife Of");

  $("#error-sodowo").show();

  counter =1;

  }

  if (e==null || e=="")

  {

  $("#error-cnic").html("Enter CNIC");

  $("#error-cnic").show();

  counter =1;

  }

  if (f==null || f=="")

  {

  $("#error-address").html("Enter Address");

  $("#error-address").show();

  counter =1;

  }

  if (g==null || g=="")

  {

  $("#error-email").html("Enter Email");

  $("#error-email").show();

  counter =1;

  }

  if (j==null || j=="")

  {

  $("#error-country").html("Enter Country");

  $("#error-country").show();

  counter =1;

  }  

   if (k==null || k=="")

  {

  $("#error-city").html("Enter City");

  $("#error-city").show();

  counter =1;

  }  

   if (h==null || h=="")

  {

  $("#error-state").html("Enter State");

  $("#error-state").show();

  counter =1;

  }      

    if (i==null || i=="")

  {

  $("#error-zip").html("Enter Zip Code");

  $("#error-zip").show();

  counter =1;

  }      

    if (l==null || l=="")

  {

  $("#error-username").html("Enter Username");

  $("#error-username").show();

  counter =1;

  }      

    if (m==null || m=="")

  {

  $("#error-password").html("Enter Password");

  $("#error-password").show();

  counter =1;

  } 

      if (n==null || n=="")

  {

  $("#error-con_password").html("Enter Confirm Password");

  $("#error-con_password").show();

  counter =1;

  }      

  
 if(counter==1)

  	return false;

  

}

 <!--VALIDATION END-->

 </script>



