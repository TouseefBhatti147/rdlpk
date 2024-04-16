
<div class="shadow">



  <h1>Update User</h1>



</div>



<!-- shadow -->



<hr noshade="noshade" class="hr-5 ">



<section class="reg-section margin-top-30">





<section class="reg-section margin-top-30">



  <div style="



    padding: 0 0 0 32px;



    width: 300px;">



  <span style="color:#FF0000; display:block;" id="error-status"></span>

<span style="color:#FF0000; display:block;" id="error-firstname"></span>

<span style="color:#FF0000; display:block;" id="error-middelname"></span>

<span style="color:#FF0000; display:block;" id="error-lastname"></span>

<span style="color:#FF0000; display:block;" id="error-address"></span>

<span style="color:#FF0000; display:block;" id="error-cnic"></span>

<span style="color:#FF0000; display:block;" id="error-email"></span>

<span style="color:#FF0000; display:block;" id="error-city"></span>

<span style="color:#FF0000; display:block;" id="error-state"></span>

<span style="color:#FF0000; display:block;" id="error-country"></span>

<span style="color:#FF0000; display:block;" id="error-sodowo"></span>

<span style="color:#FF0000; display:block;" id="error-username"></span>

<span style="color:#FF0000; display:block;" id="error-sodowo"></span>



 



   </div>
  <form action="Update" method="post" enctype="multipart/form-data" onsubmit="return validateForm() "> 
  <?php	
            $res=array();
            foreach($update_user as $key){
			if ($key['per1']==1){

			$checked1 = "checked";
			}

			else

			{
				$checked1 = "";	



			}



			



			if ($key['per2']==1){



			$checked2 = "checked";



			}



			else



			{



				$checked2 = "";	



			}



			



			if ($key['per3']==1){



			$checked3 = "checked";



			}



			else



			{



				$checked3 = "";	



			}



			



			if ($key['per4']==1){



			$checked4 = "checked";



			}



			else



			{



				$checked4 = "";	



			}



			



			if ($key['per5']==1){



			$checked5 = "checked";



			}



			else



			{



				$checked5 = "";	



			}



			



			if ($key['per6']==1){



			$checked6 = "checked";



			}



			else



			{



				$checked6 = "";	



			}



			



			if ($key['per7']==1){



			$checked7 = "checked";



			}



			else



			{



				$checked7 = "";	



			}



			



			if ($key['per8']==1){

			$checked8 = "checked";

			}

			else

			{

				$checked8 = "";	

			}

			if ($key['per9']==1){

			$checked9 = "checked";

			}

			else

			{

				$checked9 = "";	

			}

			if ($key['per10']==1){

			$checked10 = "checked";

			}

			else

			{

				$checked10 = "";	

			}

			if ($key['per11']==1){

			$checked11 = "checked";

			}

			else

			{

				$checked11 = "";	

			}

			if ($key['per12']==1){

			$checked12 = "checked";

			}

			else

			{

				$checked12 = "";	

			}

			if ($key['per13']==1){

			$checked13 = "checked";

			}

			else

			{

				$checked13 = "";	

			}

			if ($key['per14']==1){

			$checked14 = "checked";

			}

			else

			{

				$checked14 = "";	

			}

			if ($key['per15']==1){

			$checked15 = "checked";

			}

			else

			{

				$checked15 = "";	

			}

			if ($key['per16']==1){

			$checked16 = "checked";

			}

			else

			{

				$checked16 = "";	

			}

				if ($key['per17']==1){

			$checked17 = "checked";

			}

			else

			{

				$checked17 = "";	

			}

			if ($key['per18']==1){

			$checked18 = "checked";

			}

			else

			{

				$checked18 = "";	

			}

			if ($key['per19']==1){

			$checked19 = "checked";

			}

			else

			{

				$checked19 = "";	

			}

			if ($key['per20']==1){

			$checked20 = "checked";

			}

			else

			{

				$checked20 = "";	

			}

			if ($key['per21']==1){

			$checked21 = "checked";

			}

			else

			{

				$checked21 = "";	

			}

			if ($key['per31']==1){

			$checked31 = "checked";

			}

			else

			{

				$checked31 = "";	

			}

            if ($key['per32']==1){
			$checked32 = "checked";
			}
			else
			{
				$checked32 = "";	
			}
			if ($key['per33']==1){
			$checked33 = "checked";
			}
			else
			{
				$checked33 = "";	
			}
			if ($key['per34']==1){
			$checked34 = "checked";
			}
			else
			{
				$checked34 = "";	
			}
			if ($key['per35']==1){
			$checked35 = "checked";
			}
			else
			{
				$checked35 = "";	
			}
			if($key['per_bcd_mgm']==1){
			$per_bcd_mgm = "checked";
			}
			else
			{
				$per_bcd_mgm = "";	
			}
			 if($key['per_bcd_rpt']==1){
			$per_bcd_rpt = "checked";
			}
			else
			{
				$per_bcd_rpt = "";	
			}
     echo '







 



  <div class="float-left">



  <input type="hidden" readonly="readonly" id="id" name="id" value="'.$key['id'].'"/>



    <p class="reg-left-text">First Name <font color="#FF0000">*</font></p>



    <p class="reg-right-field-area margin-left-5">



      <input type="text" value="'.$key['firstname'].'" name="firstname" id="firstname" class="reg-login-text-field" />



    </p>



  </div>



  <div class="float-left">



    <p class="reg-left-text">Middel Name <font color="#FF0000">*</font></p>



    <p class="reg-right-field-area margin-left-5">



      <input type="text" value="'.$key['middelname'].'" name="middelname" id="middelname" class="reg-login-text-field" />



    </p>



  </div>



  <div class="float-left">



    <p class="reg-left-text">Last Name <font color="#FF0000">*</font></p>



    <p class="reg-right-field-area margin-left-5">



      <input type="text" value="'.$key['lastname'].'"  name="lastname" id="lastname" class="reg-login-text-field" />



    </p>



  </div>



  <div class="float-left">



    <p class="reg-left-text">S/O-D/O-W/O <font color="#FF0000">*</font></p>



    <p class="reg-right-field-area margin-left-5">



      <input type="text" value="'.$key['sodowo'].'" name="sodowo" id="sodowo" class="reg-login-text-field" />



    </p>



  </div>



  <div class="float-left">



    <p class="reg-left-text">CNIC<font color="#FF0000">*</font></p>



    <p class="reg-right-field-area margin-left-5">



      <input type="text"value="'.$key['cnic'].'" name="cnic" id="cnic" class="reg-login-text-field" />



    </p>



  </div>



  <div class="float-left">



    <p class="reg-left-text">Address<font color="#FF0000">*</font></p>



    <p class="reg-right-field-area margin-left-5">



      <input type="text" value="'.$key['address'].'" name="address" id="address" class="reg-login-text-field" />



    </p>



  </div>



  <div class="float-left">



    <p class="reg-left-text">Email Address <font color="#FF0000">*</font></p>



    <p class="reg-right-field-area margin-left-5">



      <input type="text"value="'.$key['email'].'" name="email" id="email" class="reg-login-text-field" />



    </p>



  </div>



  <div class="float-left">



    <p class="reg-left-text">City<font color="#FF0000">*</font></p>



    <p class="reg-right-field-area margin-left-5">



      <input type="text"value="'.$key['city'].'" name="city" id="city" class="reg-login-text-field" />



    </p>



  </div>



  <div class="float-left">



    <p class="reg-left-text">State<font color="#FF0000">*</font></p>



    <p class="reg-right-field-area margin-left-5">



      <input type="text" value="'.$key['state'].'" name="state" id="state" class="reg-login-text-field" />



    </p>



  </div>



  <div class="float-left">



    <p class="reg-left-text">zip<font color="#FF0000">*</font></p>



    <p class="reg-right-field-area margin-left-5">



      <input type="text" value="'.$key['zip'].'" name="zip" id="zip" class="reg-login-text-field" />



    </p>



  </div>



  <div class="float-left">



    <p class="reg-left-text">country<font color="#FF0000">*</font></p>



    <p class="reg-right-field-area margin-left-5">



      <input type="text" value="'.$key['country'].'" name="country" id="country" class="reg-login-text-field" />



    </p>



  </div>



  <div class="float-left">



    <p class="reg-left-text">User Login Name <font color="#FF0000">*</font></p>



    <p class="reg-right-field-area margin-left-5">



      <input type="text" value="'.$key['username'].'" id="username" name="username" class="reg-login-text-field" />

	   <span style="color:#FF0000; display:block;" id="memerror"></span>





    </p>



  </div>



  <div class="float-left">



    <p class="reg-left-text">Password <font color="#FF0000">*</font></p>



    <p class="reg-right-field-area margin-left-5">



      <input type="text" value="" name="password" id="password" class="reg-login-text-field" />



	        <input type="hidden" value="'.$key['password1'].'" name="password_not_changed" id="password_not_changed" class="reg-login-text-field" />
	          <input type="hidden" value="'.$key['skey'].'" name="prev_skey" id="prev_skey" class="reg-login-text-field" />



    </p>



  </div>



<div class="float-left">



    <p class="reg-left-text">Status<font color="#FF0000">*</font></p>



    <p class="reg-right-field-area margin-left-5">



      <Select name="status" id="status">

	  

      <option value="'.$key['status'].'">';

	  if($key['status']=='1'){

		  

		  echo 'Active';

		  }

		  else{

			  echo 'In active';

			  }

	  

	  

	  echo '</option>

      <option value="1">Active</option>

      <option value="0">In active</option>

      

      </Select>



    </p>



  </div>';



		$connection = Yii::app()->db;  

		$sql_plot  = "SELECT * from sales_center";

		$result_plots = $connection->createCommand($sql_plot)->queryAll();
$sql_plot11  = "SELECT * from sales_center where id='".$key['sc_id']."'";

		$result_plots11 = $connection->createCommand($sql_plot11)->queryRow();





echo  '<div class="float-left">



    <p class="reg-left-text">Office Location<font color="#FF0000">*</font></p>



    <p class="reg-right-field-area margin-left-5">

<select name="sales" id="sales">

<option value="'.$key['sc_id'].'">'.$result_plots11['name'].'</option>';

foreach($result_plots as $row12){

echo '<option value="'.$row12['id'].'">'.$row12['name'].'</option>';

}

?>

</select>

   

    </p>



  </div>

  </div>



<?php echo '<div class="checkbox span12">



   <input name="per1" type="checkbox" value="1" class="float-left2" id="per1" '.$checked1.' />



    <label for="checkbox"></label>



  	<p class="">Add/Remove User/Setting (PER1)</p>



    



    <input name="per2" type="checkbox" value="1" class="float-left2" id="per2" '.$checked2.' />



    <label for="checkbox"></label>



  

	<p class="">Allot Plot/File to any Member/Memberplot/File Search/Add Remove New Member(PER2)</p>

    



    <input name="per3" type="checkbox" value="1" class="float-left2" id="per3" '.$checked3.' />



    <label for="checkbox"></label>



  

      	<p class="">Add New Scheme(Plot/File/Street/Category,Charges,Property),Installment Plan(PER3)</p>



    <input name="per4" type="checkbox" value="1" class="float-left2" id="per4" '.$checked4.' />



    <label for="checkbox"></label>



  <p class="">Add Pages/Menu/Downloads(PER4)</p>

    



    <input name="per5" type="checkbox" value="1" class="float-left2" id="per5" '.$checked5.' />



    <label for="checkbox"></label>



  	<p class="">Add Media/Image Gallery/News/Virtual Tour,News,File Manager,Slider,Center,country,City(PER5)</p>



    



    <input name="per6" type="checkbox" value="1" class="float-left2" id="per6" '.$checked6.' />



    <label for="checkbox"></label>



   <p class="">Transfer Plot Requests (View/Update)/Allotment Requests(PER6)</p>

    



    <input name="per7" type="checkbox" value="1" class="float-left2" id="per7" '.$checked7.' />



    <label for="checkbox"></label>



    <p class="">Balloting Draw/Manage Projects(PER7)</p>    



    <input name="per8" type="checkbox" value="1" class="float-left2" id="per8" '.$checked8.' />

    <label for="checkbox"></label>

   <p class="">Message From Registered/Un-Registered Users/Email(PER8)</p>

	

	<input name="per9" type="checkbox" value="1" class="float-left2" id="per9" '.$checked9.' />

    <label for="checkbox"></label>

   <p class="">Finance System(PER9)</p>

   

   <input name="per10" type="checkbox" value="1" class="float-left2" id="per10" '.$checked10.' />

    <label for="checkbox"></label>

   <p class="">Fingerprint Registration/Verification(PER10)</p>

   

   <input name="per11" type="checkbox" value="1" class="float-left2" id="per11" '.$checked11.' />

    <label for="checkbox"></label>

   <p class="">Reporting(PER11)</p>

   

   <input name="per12" type="checkbox" value="1" class="float-left2" id="per12" '.$checked12.' />

    <label for="checkbox"></label>

   <p class="">Sales Centers(PER12)</p>

<input name="per13" type="checkbox" value="1" class="float-left2" id="per13" '.$checked13.' />

    <label for="checkbox"></label>

   <p class="">Form Management(PER13)</p>

   

   <input name="per14" type="checkbox" value="1" class="float-left2" id="per14" '.$checked14.' />

    <label for="checkbox"></label>

   <p class="">Form Reporting(PER14)</p>

   

   <input name="per15" type="checkbox" value="1" class="float-left2" id="per15" '.$checked15.' />

    <label for="checkbox"></label>

   <p class="">Form Finance(PER15)</p>

   

   <input name="per16" type="checkbox" value="1" class="float-left2" id="per16" '.$checked16.' />

    <label for="checkbox"></label>

   <p class="">Form User(PER16)</p>

   

    <input name="per17" type="checkbox" value="1" class="float-left2" id="per17" '.$checked17.' />

    <label for="checkbox"></label>

   <p class="">Form Editor(PER17)</p>

   <input name="per18" type="checkbox" value="1" class="float-left2" id="per18" '.$checked18.' />

    <label for="checkbox"></label>

   <p class="">Receipt(PER18)</p>

   <input name="per19" type="checkbox" value="1" class="float-left2" id="per19" '.$checked19.' />

    <label for="checkbox"></label>

   <p class="">Sales Administrator(Receipt)(PER19)</p>

   <input name="per20" type="checkbox" value="1" class="float-left2" id="per20" '.$checked20.' />

    <label for="checkbox"></label>

   <p class="">Sales Administrator (Transfer/Allotment)(PER20)</p>

   <input name="per21" type="checkbox" value="1" class="float-left2" id="per21" '.$checked21.' />

    <label for="checkbox"></label>

   <p class="">Receipt Administrator(PER21)</p>

   <input name="per31" type="checkbox" value="1" class="float-left2" id="per231" '.$checked31.' />

    <label for="checkbox"></label>

   <p class="">Recovery System(PER31)</p>
 <input name="per32" type="checkbox" value="1" class="float-left2" id="per32" '.$checked32.' />

    <label for="checkbox"></label>

   <p class="">Plot Status User(PER32)</p>

   <input name="per33" type="checkbox" value="1" class="float-left2" id="per33" '.$checked33.' />
    <label for="checkbox"></label>
   <p class="">Cancellation (PER33)</p>
   
   <input name="per34" type="checkbox" value="1" class="float-left2" id="per34" '.$checked34.' />
    <label for="checkbox"></label>
   <p class="">Audit (PER34)</p>
   
   <input name="per35" type="checkbox" value="1" class="float-left2" id="per35" '.$checked35.' />
    <label for="checkbox"></label>
   <p class="">Manage Surcharges (PER35)</p>
      <input name="per_bcd_mgm" type="checkbox" value="1" class="float-left2" id="per_bcd_mgm" '.$per_bcd_mgm.' />
    <label for="checkbox"></label>
   <p class="">BCD Management (Per_bcd_mgm)</p>
   <input name="per_bcd_rpt" type="checkbox" value="1" class="float-left2" id="per_bcd_rpt" '.$per_bcd_rpt.' />
    <label for="checkbox"></label>
   <p class="">BCD Reporting (Per_bcd_rpt)</p>
   

'; 

   }?>

    <h3>Projects Permission</h3>



   



    <p>



    



    <?php 



	



	$res=array();



	$i = 1;

$arry='';

		

foreach($projectper as $per)



	{

	$check="checked";

	$arry[]=$per['project_id'];

	echo'	

    <input name="'.$i.'" type="checkbox" value="'.$per['project_id'].'"'.$check.' />

	<label for="checkbox">'.$per['project_name'].'</label>';

$i++;	

echo '</br>';

		}

		echo '</br>';

	foreach($project as $per1)

	{

		if(!in_array($per1['id'],$arry))

		{

		$check="";

		echo'

    <input name="'.$i.'" type="checkbox" value="'.$per1['id'].'"'.$check.' />

	<label for="checkbox">'.$per1['project_name'].'</label>'

;

$i++;

echo '</br>';	}

		}











	?>



    </p>



  </div>

   <input type="file" name="pic"> 

   

  <input type="submit" class="btn-info button" name="update" value="Update" />		

<input type="hidden" name="uid" value="<?php echo $_GET['id'];?>" />

 </form>		







 </section>



<!-- section 3 --> 



<script>





var counter=0;

function validateForm(){







    



 

  







 <!--VALIDATION END-->



 

		$("#error-status").hide();



	



	$("#error-firstname").hide();



$("#error-middelname").hide();

	

	

   $("#error-lastname").hide();



	$("#error-cnic").hide();



	$("#error-address").hide();



	$("#error-email").hide();

	$("#error-sodowo").hide();





	$("#error-country").hide();



	$("#error-city").hide();



	$("#error-state").hide();



	



	$("#error-username").hide();



	





	//	var x=document.forms["form"]["firstname"].value;



	var mn = $("#middelname").val();

	var ln = $("#lastname").val();

	var fn = $("#firstname").val();

	var a = $("#status").val();

	

	var d = $("#sodowo").val();



	var e = $("#cnic").val();



	var f = $("#address").val();



	var g = $("#email").val();



	



	var h = $("#state").val();



	var i = $("#zip").val();



	var j = $("#country").val();



	var k = $("#city").val();



	var l = $("#username").val();



	









if (a==null || a=="")

  {

  $("#error-status").html("Select Status");

  $("#error-status").show();

  counter =1;

  }





if (fn==null || fn=="")



  {



  $("#error-firstname").html("Enter First Name");



  $("#error-firstname").show();



  counter =1;



  }



if (mn==null || mn=="")



  {



  $("#error-middelname").html("Enter Middle Name");



  $("#error-middelname").show();



  counter =1;



  }

  if (ln==null || ln=="")



  {



  $("#error-lastname").html("Enter Last Name");



  $("#error-lastname").show();



  counter =1;



  }

  





  if (d==null || d=="")



  {



  $("#error-sodowo").html("Enter Son of/Daughter Of/Wife Of");



  $("#error-sodowo").show();



  counter =1;



  }



  if (e==null || e=="")



  {



  $("#error-cnic").html("Enter CNIC");



  $("#error-cnic").show();



  counter =1;



  }



  if (f==null || f=="")



  {



  $("#error-address").html("Enter Address");



  $("#error-address").show();



  counter =1;



  }



  if (g==null || g=="")



  {



  $("#error-email").html("Enter Email Address");



  $("#error-email").show();



  counter =1;



  }



  if (j==null || j=="")



  {



  $("#error-country").html("Enter Country");



  $("#error-country").show();



  counter =1;



  }  



   if (k==null || k=="")



  {



  $("#error-city").html("Enter City");



  $("#error-city").show();



  counter =1;



  }  



   if (h==null || h=="")



  {



  $("#error-state").html("Enter State");



  $("#error-state").show();



  counter =1;



  }      



   

    if (l==null || l=="")



  {



  $("#error-username").html("Enter User Login Name ");



  $("#error-username").show();



  counter =1;



  }      



  



  

 if(counter==1)

{

  	return false;

}

}

 $(document).ready(function()



     {  	

         $("#username").change(function()

           {

         	select_mem($(this).val());

		   });

		    });



function select_mem(id)



{



$.ajax({



      type: "POST",



      url:    "ajaxRequest7?val1="+id,



	  contenetType:"json",



      success: function(jsonList){var json = $.parseJSON(jsonList);



	  



var listItems='';



	$(json).each(function(i,val){



	listItems+= "<option value='" + val.id + "'>Username Already Exists</option>";



      



});listItems+="";

if(listItems!=0){counter=1;}





$("#memerror").html(listItems);



          }



});



}

</script>

