
<div class="shadow">
  <h3>Add New User</h3>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5 float-left">
<section class="reg-section margin-top-30">

<div id="error-div" class="errorMessage" style="display: none;"></div>
 
  <form id="register" action="register" method="post">
 <div class="span4">
  <div class="float-left">
    <p class="reg-left-text">First Name <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" name="firstname" id="first" class="reg-login-text-field" />
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
      <input type="text" value="" name="email" id="email" class="reg-login-text-field" />
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
    <p class="reg-left-text">zip<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" name="zip" id="zip" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">country<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" name="country" id="country" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">User Full Name <font color="#FF0000">*</font></p>
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
  </div>
 
 
<div class="checkbox margin-left-144 margin-top-15">
   <h3>User Permission</h3>
   
    <input name="per1" type="checkbox" value="1" class="float-left" id="per1" />
    <label for="checkbox"></label>
  	<p class="">Add/Remove User </p>
    
    <input name="per2" type="checkbox" value="1" class="float-left" id="per2" />
    <label for="checkbox"></label>
  	<p class="">Alot Plot/File to any Member</p>
    
    <input name="per3" type="checkbox" value="1" class="float-left" id="per3" />
    <label for="checkbox"></label>
  	<p class="">Add New Scheme(Plot/File/Street/Project)</p>
    
    <input name="per4" type="checkbox" value="1" class="float-left" id="per4" />
    <label for="checkbox"></label>
  	<p class="">Add Pages/Menu</p>
    
    <input name="per5" type="checkbox" value="1" class="float-left" id="per5" />
    <label for="checkbox"></label>
  	<p class="">Add Media/Image Gallery/News/Virtual Tour</p>
    
    <input name="per6" type="checkbox" value="1" class="float-left" id="per6" />
    <label for="checkbox"></label>
    <p class="">Transfer Plot Requests (View/Update)</p>
    
    <input name="per7" type="checkbox" value="1" class="float-left" id="per7" />
    <label for="checkbox"></label>
    <p class="">Membership Requests (View/Update)</p>
    
    <input name="per8" type="checkbox" value="1" class="float-left" id="per8" />
    <label for="checkbox"></label>
    <p class="">Queries From Registered/Un-Registered Users</p>
    
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
 <input type="submit"  id="submit" name="submit" value="Register" class="btn btn-success" /> 
      </div>
  
  
  
 

  

    
  
  </form>
  

 </section>
<!-- section 3 --> 
