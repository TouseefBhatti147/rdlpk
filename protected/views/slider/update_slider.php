
<div class="shadow">
  <h3>Update Slider</h3>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5">
<section class="reg-section margin-top-30">

<div id="error-div" class="errorMessage" style="display: none;"></div>
 
<form action="update_slid" method="post" enctype="multipart/form-data"> 
  <?php	
            $res=array();
            foreach($update_slider as $key){
				
     echo ' 
 
<input style="visibility:hidden;" type="text" id="id" name="id" value="'.$key['id'].'"/>

 
  <div class="float-left">
    <p class="reg-left-text">Title <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="'.$key['title'].'" name="title" id="title" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Detail <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <textarea name="detail" id="detail">'.$key['detail'].'</textarea>
     </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Link <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="'.$key['link'].'" name="link" id="link" class="reg-login-text-field" />
     </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Image<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <div style="height:210px; width:330px; border:1px solid;"><img style="height:200px;" src="'.Yii::app()->request->baseUrl.'/images/slider/'.$key['image'].'"></div>
    <span><input  style="height:25px;" type="file" name="image" id="image"></span>
	</p>
  </div> 
 
  
 
   	
';	}?>
<input type="submit" class="btn-info button" name="update" value="Update" />		
 </form>		
				
	
 
 </section>
<!-- section 3 --> 
