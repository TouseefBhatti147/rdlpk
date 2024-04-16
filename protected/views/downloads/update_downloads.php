
<div class="shadow">

  <h3>Update Downloads</h3>

</div>

<!-- shadow -->
<span style="float:right"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/streets/streets_list"  class="btn-info button">Back To List</a></span>

<hr noshade="noshade" class="hr-5">

<section class="reg-section margin-top-30">

<div id="error-div" class="errorMessage" style="display: none; color:#F00;"></div>


<form method="post" action="update" enctype="multipart/form-data" onsubmit="return validateForm()">


  <?php	

            $res=array();

            foreach($update_streets as $key){

				

     echo ' 

  

  <div class="float-left">

    <p class="reg-left-text">Project Name <font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">
<input type="hidden"  value="'.$key['project_id'].'" name="project_id" id="project_id" class="reg-login-text-field" />
      <input type="text" readonly="readonly" value="'.$key['project_name'].'" class="reg-login-text-field" />

    </p>

  </div>

  <div class="float-left">

    <p class="reg-left-text">Title<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" value="'.$key['title'].'" name="title" id="title" class="reg-login-text-field" />

    </p>

  </div>

  <div class="float-left">
    <p class="reg-left-text">Detail<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <input name="detail"  type="text" value="'.$key['detail'].'"  id="detail">
    </p>
  </div>
<div class="float-left">
    <p class="reg-left-text">Image<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
   <img  style="height:100px;width:100px;"src="'.Yii::app()->request->baseUrl.'/images/downloads/'.$key['image'].'">
    </p>
  </div>
<div class="float-left">
    <p class="reg-left-text"><font color="#FF0000"></font></p>
    <p class="reg-right-field-area margin-left-5">
     <input name="image"  type="file"   id="file">
    </p>
  </div>
  <div class="float-left">

<input type="hidden" id="id" name="id" value="'.$key['id'].'"/>

</div>
<div class="float-left">
    <p class="reg-left-text"><font color="#FF0000"></font></p>
    <p class="reg-right-field-area margin-left-5">
<input type="submit" name="update" value="Update" class="btn-info button">
    </p>
  </div>
  

 

   	

';	}?>

 
	

 

 </section>

<!-- section 3 --> 

