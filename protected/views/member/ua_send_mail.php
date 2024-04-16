<div class="">

<div class="shadow">

<h3>Email To Member</h3>

</div>

<!-- shadow -->

<hr noshade="noshade" class="hr-5">

<section class="reg-section margin-top-30">





<form action="<?php echo $this->createAbsoluteUrl('member/Mail');?>" method="post" onsubmit="return validateForm()"  >

<div id="error-div" class="errorMessage" style="display: none;"></div>

<h5>Current Member Detail</h5>
<?php  foreach($mail as $key)
{?>
<ul>
<li>Name:&nbsp;<span style="color:#FF0000;"><?php echo $key['name'];?></li>
<li>Username:&nbsp;<span style="color:#FF0000;"><?php echo $key['musername'];?></li>
<li>Email:&nbsp;<span style="color:#FF0000;"><?php echo $key['memail'];?></li>
<li>Password:&nbsp;<span style="color:#FF0000;"><?php echo $key['mpassword'];?></li>
<li>CNIC:&nbsp;<span style="color:#FF0000;"><?php echo $key['mcnic'];?></li>

</ul>

<hr noshade="noshade" class="hr-5">
<h5>User Request Detail</h5>
  <div style="

    padding: 0 0 0 32px;

    width: 300px;">

  <span style="color:#FF0000; display:block;" id="error-cnic"></span>

  <span style="color:#FF0000; display:block;" id="error-email"></span>

  <!---<span style="color:#FF0000; display:block;" id="error-message"></span>---->

 

   </div>
<input type="hidden" value="<?php echo $_REQUEST['id'];?>" name="id" id="id" class="reg-login-text-field" />
<input type="hidden" value="<?php echo $_REQUEST['mid'];?>" name="mid" id="mid" class="reg-login-text-field" />
<?php
if(empty($key['mcnic'])&& empty ($key['mpassword']))

{
	echo'<h3 style="color:red">This is not registered member.</h3>';
	}	
	else{
	?>
<div class="float-left" >

<p class="reg-left-text">Member CNIC<font color="#FF0000">*</font></p>
<?Php 


echo '<input type="text" readonly="readonly" name="cnic" id="cnic"  value="'.$key['cnic'].'" /> 

</div>



<div class="float-left">

<p class="reg-left-text">Username <font color="#FF0000">*</font></p>

<p class="reg-right-field-area margin-left-5">

<input type="text" value="'.$key['username'].'" name="username" id="username" class="reg-login-text-field" />

</p>

</div>
<div class="float-left">

<p class="reg-left-text">Email <font color="#FF0000">*</font></p>

<p class="reg-right-field-area margin-left-5">

<input readonly="readonly" type="text" value="'.$key['email'].'" name="email" id="email" class="reg-login-text-field" />
<input readonly="readonly" type="hidden" value="'.$key['name'].'" name="name" id="name" class="reg-login-text-field" />
</p>

</div>

<div class="float-left">

<p class="reg-left-text">Password <font color="#FF0000">*</font></p>

<p class="reg-right-field-area margin-left-5">

<input type="text" value="'.$key['password'].'" name="password" id="password" class="reg-login-text-field" />

</p>

</div>
';

?>

<table class="table" >   
      <tr>
        <td>Respected Member,<strong> <?php echo $key['name'];?>,</strong> AoA!</td>
      </tr>
      	 <tr>
        	<td>Please find below your credentials for online web portal access to view your updated payment status to avoid further delay resulting any surcharges etc</td>
         </tr>
    	 <tr>
        <td>Web portal online URL : http://www.rdlpk.com/index.php/member</td>
        </tr>
         <tr>
        <td>Login ID: <?php echo $key['username'];?> </td>
        </tr>
        <tr>
        <td>Password: <?php echo $key['password'];?> </td>
        </tr>
         <tr>
        <td>Thanks with profound regards, </td>
        </tr>
        
        <tr>
        <td></td>
        </tr>
         <tr>
        <td> <strong>IT Support Wing </strong>| Royal Developers & Builders (Pvt) Limited<br>
            Silver Square Plaza, Plot # 15, Street # 73, Mehr Ali Road,
            </td>
        </tr>
          <tr>
        <td> F-11 Markaz, Islamabad. </br>
              Toll Free : 0800-ROYAL (76925) </br>
              UAN : +92 51 111 444 475 </br>
              Tel : +92 51 2224301 - 04 </br>
              Email: sales@royalorchard.pk</br>

            </td>
        </tr>
        
  </table>

<input name="submit" value="Update & Send Email" type="submit"  class="btn btn-info"  value="Send Message"/>

</div>
<?php } }?>




</div>

</section>

<!-- section 3 -->

<script>

function validateForm(){

	$("#error-cninc").hide();

	$("#error-email").hide();

//	$("#error-message").hide();



	var a = $("#cnic").val();

	var b = $("#email").val();

//	var c = $("#message").val();


var counter=0;
if (a==null || a=="")
  {
  $("#error-cnic").html("Enter CNIC");
  $("#error-cnic").show();
  counter =1;
  }
if (b==null || b=="")
  {
  $("#error-email").html("Enter Usename/Email");
  $("#error-email").show();
  counter =1;
  }
 /* if (c==null || c=="")
  {
  $("#error-message").html("Enter Message");
  $("#error-message").show();
  counter =1;
  }*/

 if(counter==1)

  	return false;

  

}

</script>

