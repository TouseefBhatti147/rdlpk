<script src="//code.jquery.com/jquery-1.10.2.js"></script>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.js"></script>



<script>

$(function() {

$( "#cut_date" ).datepicker({ dateFormat: 'yy-mm-dd' });

});

$(function() {

$( "#todatepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });

});

</script>
<div class="shadow">
  <h3>Update Cut Date</h3>
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
    <p class="reg-left-text">Project Name<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" readonly="readonly" value=" '.$key['project_name'].'" name="project_name" id="project_name" class="reg-login-text-field" />
    </p>
  </div>
  
   <div class="float-left">
    <p class="reg-left-text">Cut Date<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value=" '.$key['cut_date'].'" name="cut_date" id="cut_date" class="reg-login-text-field" />
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
