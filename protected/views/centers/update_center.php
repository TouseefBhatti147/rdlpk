

<div class="shadow">

  <h3>Update Center</h3>

</div>

<!-- shadow -->

<hr noshade="noshade" class="hr-5 float-left">

<section class="reg-section margin-top-30">


<div style="

    padding: 0 0 0 32px;

    width: 300px;">

  <span style="color:#FF0000; display:block;" id="error-name"></span>

  <span style="color:#FF0000; display:block;" id="error-detail"></span>

 

   </div> 

 

<form action="update_cen" method="post" enctype="multipart/form-data"  onsubmit="return validateForm()"> 

  <?php	

            $res=array();

            foreach($update_centers as $key){

				

     echo ' 

 

<input style="visibility:hidden;" type="text" id="id" name="id" value="'.$key['id'].'"/>



 

  <div class="float-left">

    <p class="reg-left-text">Name <font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" value="'.$key['name'].'" name="name" id="name" class="reg-login-text-field" />

    </p>

  </div>

  <div class="float-left">

    <p class="reg-left-text">Detail <font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

     <input type="text" value="'.$key['detail'].'" name="detail" id="detail" class="reg-login-text-field" />

     </p>

  </div>

  <div class="float-left">

    <p class="reg-left-text">Image<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

     <div style="height:205px; width:200px; border:1px solid;"><img style="height:200px; width:200px;" src="'.Yii::app()->request->baseUrl.'/images/centers/'.$key['image'].'"></div>

    <span><input  style="height:25px;" type="file" name="image" id="image"></span>

	</p>

  </div> 

 

  

 

   	

';	}?>

<input type="submit" class="btn-info button" name="update" value="Update" />		

 </form>		

				

	<script>



function validateForm(){

	

	$("#error-name").hide();

	$("#error-detail").hide();


	//	var x=document.forms["form"]["firstname"].value;

	var k = $("#name").val();

	var x = $("#detail").val();

	


var counter=0;



if (k==null || k=="")

  {

  $("#error-name").html("Enter Category Name");

  $("#error-name").show();

  counter =1;

  }

if (x==null || x=="")

  {

  $("#error-detail").html("Enter Center Detail");

  $("#error-detail").show();

  counter =1;

  }





 if(counter==1)

  	return false;

  

}

</script>


 

 </section>

<!-- section 3 --> 

