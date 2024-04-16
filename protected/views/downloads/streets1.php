<div class="">

<div class="shadow">

  <h3>Add Street</h3>

</div>



<!-- shadow -->

<hr noshade="noshade" class="hr-5">

<section class="reg-section margin-top-30">

<form action="create"  onsubmit="return validateForm()" method="post">


   <div class="float-left" >

 <p class="reg-left-text">Project ID <font color="#FF0000">*</font></p>

  <select name="project_id" id="project_id">
<option value="">Select Project</option>
  			<?php	 

            $res=array();

            foreach($projects as $key){

            echo '<option value="'.$key['id'].'">'.$key['project_name'].'</option>'; 

            }?>

  </select>

  </div>

  <div class="float-left">

  <p class="reg-left-text">Street<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" name="street" id="street" class="reg-login-text-field" />

  </div>

 

 
  

    <input name="submit" value="Add" type="submit" class="btn btn-info"  />

     <div style="height: 600px;

    padding: 0 0 0 32px;

    width: 300px;">

  <span style="color:#FF0000; display:block;" id="error-project"></span>

  <span style="color:#FF0000; display:block;" id="error-street"></span>

 
   </div> 

 </form>
 </section>

 </section>

<!-- section 3 --> 

<!-- VALIDATION START--> 

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<script>



function validateForm(){

	

	$("#error-project").hide();

	$("#error-street").hide();

	

	//	var x=document.forms["form"]["firstname"].value;

	var k = $("#project_id").val();

	var x = $("#street").val();

	



var counter=0;



if (k==null || k=="")

  {

  $("#error-project").html("Project Required");

  $("#error-project").show();

  counter =1;

  }

if (x==null || x=="")

  {

  $("#error-street").html("Enter Street #");

  $("#error-street").show();

  counter =1;

  }



  





     

 if(counter==1)

  	return false;

  

}

 <!--VALIDATION END-->

</script>

