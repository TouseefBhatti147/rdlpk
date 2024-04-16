
<div class="shadow">
  <h3>Update Size Category</h1>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5 float-left">
<section class="reg-section margin-top-30">

<div id="error-div" class="errorMessage" style="display: none;"></div>
 

 <form action="Update_siz_prop" method="post" onsubmit="return validateForm()"  enctype="multipart/form-data">
  <?php	
            $res=array();
            foreach($update_size as $key){
				
     echo ' 
 
<input style="visibility:hidden;" type="text" id="id" name="id" value="'.$key['id'].'"/>


 
  <div class="float-left">
    <p class="reg-left-text">Title <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="'.$key['size'].'" name="size" id="size" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Dimension <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="'.$key['dimension'].'" name="dimension" id="dimension" class="reg-login-text-field" />
    </p>
  </div>
 
 
  <div class="float-left">
    <p class="reg-left-text"> Size Code <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="'.$key['code'].'" name="code" id="code" class="reg-login-text-field" />
    </p>
  </div>
  
 ';	
			}
?>
                                    
<input type="submit" class="btn-info button" name="update" value="Update" />
  		
 </form>		
				
	
 
 </section>
<!-- section 3 --> 
<!--VALIDATION START-->

 <!--VALIDATION END-->