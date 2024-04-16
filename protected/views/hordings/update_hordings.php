
<div class="shadow">
  <h3>Update Slider</h3>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5">
<section class="reg-section margin-top-30">

<div id="error-div" class="errorMessage" style="display: none;"></div>
 
<form action="update_hord" method="post" enctype="multipart/form-data"> 
  <?php	
            $res=array();
            foreach($update_hordings as $key){
				
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
     <textarea id="detail" name="detail">'.$key['detail'].'</textarea>
     </p>
  </div>
<div class="float-left">
    <p class="reg-left-text">Status <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
   <select name="status" id=status>
   <option value="'.$key['status'].'">';if($key['status']=='1'){echo'Active';}else{echo'In-active';}echo'</option>
   <option value="1">Active</option>
   <option value="0">In-active</option></select>
     </p>
  </div>

  <div class="float-left">
    <p class="reg-left-text">Image<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <div style="height:210px;  border:1px solid;"><img style="height:210px;" src="'.Yii::app()->request->baseUrl.'/images/hordings/'.$key['image'].'"></div>
    <span><input  style="height:25px;" type="file" name="image" id="image"></span>
	</p>
  </div> 
 
  
 
   	
';	}?>
<input type="submit" class="btn-info button" name="update" value="Update" />		
 </form>		
				
	
 
 </section>
<!-- section 3 --> 
