
<div class="shadow">
  <h3>Update Category</h3>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5 float-left">
<section class="reg-section margin-top-30">

<div id="error-div" class="errorMessage" style="display: none;"></div>
 
<form action="update_cat" method="post" enctype="multipart/form-data"> 
  <?php	
            $res=array();
            foreach($update_category as $key){
				
     echo ' 
 
<input style="visibility:hidden;" type="text" id="id" name="id" value="'.$key['id'].'"/>

 
  <div class="float-left">
    <p class="reg-left-text">Name <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="'.$key['name'].'" name="name" id="name" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Details <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <input type="text" value="'.$key['disc'].'" name="details" id="details class="reg-login-text-field" />
     </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Code <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <input type="text" value="'.$key['code'].'" name="code" id="code" class="reg-login-text-field" />
     </p>
  </div>
  
 
  
 
   	
';	}?>
<input type="submit" class="btn-info button" name="update" value="Update" />		
 </form>		
				
	
 
 </section>
<!-- section 3 --> 
