
<div class="shadow">
  <h1>Update News</h1>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5 ">
<section class="reg-section margin-top-30">


 
<form action="update_new" method="post" enctype="multipart/form-data"> 
  <?php	
            $res=array();
            foreach($update_news as $key){
				
     echo ' 
 
  
  <div class="float-left">
    <p class="reg-left-text">Teaser <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
    <textarea name="teaser" id="teaser">'.$key['teaser'].'</textarea>
     </p>
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Details <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <textarea name="details">'.$key['details'].'</textarea>
     </p>
  </div>
   
 
  <div class="float-left" ">
    <p class="reg-left-text">Date<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value=" '.$key['create_date'].'" name="create_date" id="cncreate_dateic" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Status <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
    <select name="status">
    <option value="Active">Active</option>
    <option value="Inactive">Inactive</option>
    </select>
     </p>
  </div>
 <div class="float-left">
<input type="hidden" id="id" name="id" value="'.$key['id'].'"/>
  </div>
 
   	
';	}?>
 
<input type="submit" class="btn-info button" name="update" value="Update" />		
 </form>		
				
		
  
 </section>
<!-- section 3 --> 
