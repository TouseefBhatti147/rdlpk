
<div class="shadow">
  <h3>Plot Charges</h3>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5 ">
<section class="reg-section margin-top-30">
<form action="charge" method="post">
			<div class="float-left">
    <p class="reg-left-text">Payment Type<font color="#FF0000">*</font></p>
   	<p class="reg-right-field-area margin-left-5">
    <select name="charges_id" id="charges_id">
   <?php
   foreach($charges as $key1)
   {
	echo ' 	<option value="'.$key1['name'].'">'.$key1['name'].'</option>';   
   }
   
   ?>

  	</select>
    </p>
  	</div>
    
            
	<div class="float-left">
    <p class="reg-left-text">File ID<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" readonly="readonly" value="<?php echo $pages ?>" name="plot_id" id="plot_id" class="reg-login-text-field" />
    </p>
  	</div>
  	
 
   
  <div class="float-left">
    <p class="reg-left-text">Comment<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" name="comment" id="comment" class="reg-login-text-field" />
    </p>
  </div>
  
  <input name="submit" type="submit" class="btn btn-success" />
  </form>
      
  		
          