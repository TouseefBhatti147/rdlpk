<div class="">
<div class="shadow">
  <h3>Select Project</h3>
</div>
<!-- shadow -->

<form action="forms" method="post">
  <div class="float-left">
    <p class="reg-left-text">Projects<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <select name="project_id" id="project"><?php	
	
            $res=array();
			foreach($projects as $key){
            echo '<option value="'.$key['id'].'">'.$key['project_name'].'</option>'; 
            }?></select>
     </p>
  </div>
    <button type="submit" class="btn" >Select</button>
   </form>
