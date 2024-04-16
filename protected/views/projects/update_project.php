<div class="shadow">
  <h3>Update Project</h3>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5">
<section class="reg-section margin-top-30">

<form action="update_proj" method="post" enctype="multipart/form-data"> 
  <?php	
            $res=array();
            foreach($update_project as $key){
				
     echo ' 
  
  <div class="float-left">
    <p class="reg-left-text">Project Name <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="'.$key['project_name'].'" name="project_name"  id="first" class="reg-login-text-field" />
    </p>
  </div>
<div class="float-left">
    <p class="reg-left-text">URL <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="'.$key['url'].'" name="url"  id="first" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Teaser <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="'.$key['teaser'].'" name="teaser" id="teaser" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Details <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <textarea name="details">'.$key['details'].'</textarea>
     </p>
  </div>
 <div class="float-left">

    <p class="reg-left-text">Status<font color="#FF0000">*</font></p>

	<p class="reg-right-field-area margin-left-5">

    <select name="status">
<option value="'.$key['status'].'">'.$key['status'].'</option>
<option value="1">Active</option>
<option value="0">inActive</option>

</select>

    </p>

    </div>
  <div class="float-left">
    <p class="reg-left-text">Date<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value=" '.$key['create_date'].'" name="create_date" id="cncreate_dateic" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Project image<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <div style="height:85px; width:150px; border:1px solid;"><img src="'.Yii::app()->request->baseUrl.'/images/upload/'.$key['project_image'].'"></div>
    <span><input  style="height:25px;" type="file" name="project_image" value='.$key['project_image'].'  id="project_image"></span>
	</p>
  </div> 
 
  <div class="float-left">
<input type="hidden" id="id"  name="id" value="'.$key['id'].'"/>
</div>
  
 
   	
';	}?>
<input type="submit" class="btn-info button" name="update" value="Update" />		
 </form>		
	
 
 </section>
<!-- section 3 --> 
