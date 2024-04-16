
<div class="shadow">
  <h3>Update Setting</h1>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5">
<section class="reg-section margin-top-30">

<div id="error-div" class="errorMessage" style="display: none;"></div>
 
<form action="Update_set" method="post" enctype="multipart/form-data"> 
  <?php	
            $res=array();
            foreach($update_setting as $key){
				
     echo ' 
 
<input type="hidden" id="id" name="id" value="'.$key['id'].'"/>


 
  <div class="float-left">
    <p class="reg-left-text">Owner Name <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="'.$key['ownername'].'" name="ownername" id="ownername" class="reg-login-text-field" />
    </p>
  </div>
 
  <div class="float-left">
    <p class="reg-left-text">Mobile <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <input type="text" value="'.$key['mobile'].'" name="mobile" id="mobile" class="reg-login-text-field" />
     </p>
  </div>
 <div class="float-left">
    <p class="reg-left-text">Phone(Office) <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <input type="text" value="'.$key['phone'].'" name="phone" id="phone" class="reg-login-text-field" />
     </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Email <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <input type="text" value="'.$key['email'].'" name="email" id="email" class="reg-login-text-field" />
     </p>
  </div>
   
   <div class="float-left">
    <p class="reg-left-text">Address <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <input type="text" value="'.$key['address'].'" name="address" id="address" class="reg-login-text-field" />
     </p>
  </div>
   <div class="float-left">
    <p class="reg-left-text">Facebook <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <input type="text" value="'.$key['facebook'].'" name="facebook" id="facebook" class="reg-login-text-field" />
     </p>
  </div>
   <div class="float-left">
    <p class="reg-left-text">Twitter <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <input type="text" value="'.$key['twitter'].'" name="twitter" id="twitter" class="reg-login-text-field" />
     </p>
  </div>
   <div class="float-left">
    <p class="reg-left-text">Google Plus<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <input type="text" value="'.$key['flicker'].'" name="flicker" id="flicker" class="reg-login-text-field" />
     </p>
  </div>
   <div class="float-left">
    <p class="reg-left-text">Total(Once Only) <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <input type="text" value="'.$key['googleplus'].'" name="googleplus" id="googleplus" class="reg-login-text-field" />
     </p>
  </div>
 <div class="float-left">
    <p class="reg-left-text">Message <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
	<textarea name="message" id="message">'.$key['message'].'</textarea>
    
     </p>
  </div>
     <div class="float-left">
    <p class="reg-left-text">Subcription Text <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
	<textarea name="subcriptiontext" id="subcriptiontext">'.$key['subcriptiontext'].'</textarea>
    
     </p>
  </div>
   	
';	}?>
<input type="submit" class="btn-info button" name="update" value="Update" />		
 </form>		
				
	
 
 </section>
<!-- section 3 --> 
