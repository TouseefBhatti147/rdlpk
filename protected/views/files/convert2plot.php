

<div class="shadow">

  <h3>Convert To Plot</h3>

</div>

<!-- shadow -->

<hr noshade="noshade" class="">

<section class="reg-section margin-top-30">



<div id="error-div" class="errorMessage" style="display: none;"></div>

 

<form action="c2p" method="post" enctype="multipart/form-data" onsubmit="return validateForm()"> 

 	<?php	

			

		 

		  

            $res=array();

            foreach($convert2plot as $key){

     echo ' 

 

<input type="hidden" id="memreq_id" name="memreq_id" value="'.$key['id'].'"/>



<input type="hidden" id="pid" name="pid" value="'.$_GET['id'].'"/>







 

  <div class="float-left">

    <p class="reg-left-text">Street Address <font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" readonly="readonly" value="'.$key['street'].'" name="" id="" class="reg-login-text-field" />
 <input type="hidden" readonly="readonly" value="'.$key['street_id'].'" name="street_id" id="street_id" class="reg-login-text-field" />
    </p>

  </div>

 

  <div class="float-left">

    <p class="reg-left-text">Plot Detail Address <font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

     <input type="text" readonly="readonly" value="'.$key['plot_detail_address'].'" name="plot_detail_address" id="plot_detail_address" class="reg-login-text-field" />

     </p>

  </div>

 <div class="float-left">

    <p class="reg-left-text">Project <font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

     <input type="text" value="'.$key['project_name'].'" readonly="readonly" name="project_id" id="project_id" class="reg-login-text-field" />

     </p>

  </div>

   <div class="float-left">

    <p class="reg-left-text">Size <font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

     <input type="text" value="'.$key['plot_size'].'" readonly="readonly" name="plot_size" id="plot_size" class="reg-login-text-field" />

     </p>

  </div>
<div class="float-left">

    <p class="reg-left-text">Sector <font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

     <input type="text" value="'.$key['sector'].'" readonly="readonly"  name="sector" id="sector" class="reg-login-text-field" />

     </p>

  </div>

     <div class="float-left">

    <p class="reg-left-text">Price <font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

     <input type="text" value="'.$key['price'].'"  name="price" id="price" class="reg-login-text-field" />

     </p>

  </div>

 <div class="float-left">

    <p class="reg-left-text">Type <font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

     <input type="text" value="'.$key['com_res'].'" readonly="readonly" name="com_res" id="com_res" class="reg-login-text-field" />

     </p>

  </div>



 

   

  <div class="float-left">

    <p class="reg-left-text">File Create Date <font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

     <input type="text" value="'.$key['create_date'].'" readonly="readonly" name="create_date" id="create_date" class="reg-login-text-field" />

     </p>

  </div>

  ';	}?>

  

  <div class="float-left">

  <div class="black-bg">File/Plot:</div><div class="grey-bg"><select name="type"><option value="Plot">Plot</option></select></div>

 </div>

   	



<?php $co=0;

 foreach($result as $inst){

echo $inst['amount'];

$co++;	

	}?>

    <input type="hidden" id="pnoi" value="<?php echo $co; ?>">

<span style="color:#FF0000; display:block;" id="error-installment"></span>
 <div class="float-left" >

  

   

  <p class="reg-left-text">Category<font color="#FF0000">*</font></p>
<?php 

	

	$res=array();

	$i = 1;

	foreach($categories as $key1)

	{

	

	echo'<div class="cat">

    <input id="cat" name="'.$i.'" type="checkbox" value="'.$key1['id'].'" />

	<label for="checkbox">'.$key1['name'].'</label>

	<label><img src="'.Yii::app()->request->baseUrl.'/images/category/'.$key1['sign'].'"></label>
	</div>';
	
	$i++;

	}

	?>

  </div>

<input type="submit" class="btn-info button" name="update" value="Update" />		

 </form>		

	



 	

 

 </section>

<!-- section 3 --> 

<script>



function validateForm(){

	$("#error-installment").hide();



   var i = $("#installment").val();

  var j = $("#pnoi").val();

	

	 var counter=0;

if (j>i)

  {

  $("#error-installment").html("Error");

  $("#error-installment").show();

  counter =1;

  }

	 if(counter==1)

  	return false;

}

</script>