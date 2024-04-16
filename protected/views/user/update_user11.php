

<div class="shadow">

  <h1>Update User</h1>

</div>

<!-- shadow -->

<hr noshade="noshade" class="hr-5 ">

<section class="reg-section margin-top-30">



<div id="error-div" class="errorMessage" style="display: none;"></div>

 

  <form action="Update" method="post" enctype="multipart/form-data"> 

  <?php	

  		

  

            $res=array();

            foreach($update_user as $key){

			

			if ($key['per1']==1){

			$checked1 = "checked";

			}

			else

			{

				$checked1 = "";	

			}

			

			if ($key['per2']==1){

			$checked2 = "checked";

			}

			else

			{

				$checked2 = "";	

			}

			

			if ($key['per3']==1){

			$checked3 = "checked";

			}

			else

			{

				$checked3 = "";	

			}

			

			if ($key['per4']==1){

			$checked4 = "checked";

			}

			else

			{

				$checked4 = "";	

			}

			

			if ($key['per5']==1){

			$checked5 = "checked";

			}

			else

			{

				$checked5 = "";	

			}

			

			if ($key['per6']==1){

			$checked6 = "checked";

			}

			else

			{

				$checked6 = "";	

			}

			

			if ($key['per7']==1){

			$checked7 = "checked";

			}

			else

			{

				$checked7 = "";	

			}

			

			if ($key['per8']==1){

			$checked8 = "checked";

			}

			else

			{

				$checked8 = "";	

			}

     echo '



 

  <div class="float-left">

  <input type="hidden" readonly="readonly" id="id" name="id" value="'.$key['id'].'"/>

    <p class="reg-left-text">First Name <font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" value="'.$key['firstname'].'" name="firstname" id="first" class="reg-login-text-field" />

    </p>

  </div>

  <div class="float-left">

    <p class="reg-left-text">Middel Name <font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" value="'.$key['middelname'].'" name="middelname" id="middelname" class="reg-login-text-field" />

    </p>

  </div>

  <div class="float-left">

    <p class="reg-left-text">Last Name <font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" value="'.$key['lastname'].'"  name="lastname" id="lastname" class="reg-login-text-field" />

    </p>

  </div>

  <div class="float-left">

    <p class="reg-left-text">S/O-D/O-W/O <font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" value="'.$key['sodowo'].'" name="sodowo" id="sodowo" class="reg-login-text-field" />

    </p>

  </div>

  <div class="float-left">

    <p class="reg-left-text">CNIC<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text"value="'.$key['cnic'].'" name="cnic" id="cnic" class="reg-login-text-field" />

    </p>

  </div>

  <div class="float-left">

    <p class="reg-left-text">Address<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" value="'.$key['address'].'" name="address" id="address" class="reg-login-text-field" />

    </p>

  </div>

  <div class="float-left">

    <p class="reg-left-text">Email Address <font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text"value="'.$key['email'].'" name="email" id="email" class="reg-login-text-field" />

    </p>

  </div>

  <div class="float-left">

    <p class="reg-left-text">City<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text"value="'.$key['city'].'" name="city" id="city" class="reg-login-text-field" />

    </p>

  </div>

  <div class="float-left">

    <p class="reg-left-text">State<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" value="'.$key['state'].'" name="state" id="state" class="reg-login-text-field" />

    </p>

  </div>

  <div class="float-left">

    <p class="reg-left-text">zip<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" value="'.$key['zip'].'" name="zip" id="zip" class="reg-login-text-field" />

    </p>

  </div>

  <div class="float-left">

    <p class="reg-left-text">country<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" value="'.$key['country'].'" name="country" id="country" class="reg-login-text-field" />

    </p>

  </div>

  <div class="float-left">

    <p class="reg-left-text">User Full Name <font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" value="'.$key['username'].'" id="username" name="username" class="reg-login-text-field" />

    </p>

  </div>

  <div class="float-left">

    <p class="reg-left-text">Password <font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" value="" name="password" id="password" class="reg-login-text-field" />

	        <input type="hidden" value="'.$key['password'].'" name="password_not_changed" id="password_not_changed" class="reg-login-text-field" />

    </p>

  </div>

 

  <div class="checkbox span12">

   <input name="per1" type="checkbox" value="1" class="float-left2" id="per1" '.$checked1.' />

    <label for="checkbox"></label>

  	<p class="">Add/Remove User </p>

    

    <input name="per2" type="checkbox" value="1" class="float-left2" id="per2" '.$checked2.' />

    <label for="checkbox"></label>

  	<p class="">Alot Plot/File to any Member</p>

    

    <input name="per3" type="checkbox" value="1" class="float-left2" id="per3" '.$checked3.' />

    <label for="checkbox"></label>

  	<p class="">Add New Scheme(Plot/File/Street/Project)</p>

    

    <input name="per4" type="checkbox" value="1" class="float-left2" id="per4" '.$checked4.' />

    <label for="checkbox"></label>

  	<p class="">Add Pages/Menu</p>

    

    <input name="per5" type="checkbox" value="1" class="float-left2" id="per5" '.$checked5.' />

    <label for="checkbox"></label>

  	<p class="">Add Media/Image Gallery/News/Virtual Tour</p>

    

    <input name="per6" type="checkbox" value="1" class="float-left2" id="per6" '.$checked6.' />

    <label for="checkbox"></label>

    <p class="">Transfer Plot Requests (View/Update)</p>

    

    <input name="per7" type="checkbox" value="1" class="float-left2" id="per7" '.$checked7.' />

    <label for="checkbox"></label>

    <p class="">Membership Requests (View/Update)</p>

    

    <input name="per8" type="checkbox" value="1" class="float-left2" id="per8" '.$checked8.' />

    <label for="checkbox"></label>

    <p class="">Queries From Registered/Un-Registered Users</p>

  </div>';  }?>

  <input type="submit" class="btn-info button" name="update" value="Update" />		

 </form>		



 </section>

<!-- section 3 --> 

