
<style>



.black-bg {

	background:#333; color:#fff; width:20%; float:left; padding:5px 10px; margin:2px 0px;

	}



.grey-bg {

	background:#CCC; color:#000; width:71%; height:20px; padding:5px 10px; float:left; margin:2px 0px;

	}

	

.left-box {

	float:left;

	border:1px solid #ccc;

	padding:0 5px;

	margin:0 5px;

	}

	

.bot-box {

	background: none repeat scroll 0 0 #6699FF;

    border-radius: 10px;

    clear: both;

    color: #FFFFFF;

    height: 164px;

    margin: 30px auto;

    padding: 20px;

    position: relative;

    top: 30px;

    width: 55%;

	}

	

	

.new-box-01 {

    float: left;

    width: 50%;

	margin-bottom:40px;

}



</style>







<div class="shadow">

  <h3>User Detail</h3>

</div>

<!-- shadow -->

<hr noshade="noshade" class="hr-5">

<section class="reg-section margin-top-30">



<div style="

    padding: 0 0 0 32px;

    width: 300px;">

  <span style="color:#FF0000; display:block;" id="error-password"></span>
 <span style="color:#FF0000; display:block;" id="error-mobile"></span>
 <span style="color:#FF0000; display:block;" id="error-address"></span>
 <span style="color:#FF0000; display:block;" id="error-city"></span>
 <span style="color:#FF0000; display:block;" id="error-country"></span>

  <span style="color:#FF0000; display:block;" id="error-pic"></span>
 

   </div>



 

<?php	
            $res=array();

            foreach($user_detail as $key){?>


           





<div class="" style="">

 

  <div class="span6">

 	

  	<div class="black-bg">User ID:</div><div class="grey-bg"><?php echo $key['id'];?></div><br>

   <div class="black-bg">Name:</div><div class="grey-bg"><?php echo $key['firstname'].$key['middelname'].'&nbsp;'.$key['lastname'];?></div>
 <br>
 <div class="black-bg">Login Name:</div><div class="grey-bg"><?php echo $key['username'];?></div>
 <br>
  	<div class="black-bg">My Password:</div><div class="grey-bg"><?php echo $key['password'];?></div>

   
    <br>
  	<div class="black-bg">SO,DO,WO:</div><div class="grey-bg"><?php echo $key['sodowo'];?></div>

    <br>
<div class="black-bg">Email:</div><div class="grey-bg"><?php echo $key['email'];?></div>

    <br>
  	<div class="black-bg">CNIC:</div><div class="grey-bg"><?php echo $key['cnic'];?></div>

    <br>
	<form action="change_password" onsubmit="return validateForm()" method="post">
     <div class="black-bg">Change Address:</div><input  style="height:23px;"  type="text" name="address" value="<?php echo $key['address'];?>" id="address" /></br>
  <div class="black-bg">Change City:</div><input  style="height:23px;"  type="text" name="city" id="city" value="<?php echo $key['city'];?>" /></br>
  <div class="black-bg">Change Country:</div><input  style="height:23px;"  type="text" value="<?php echo $key['country'];?>" name="country" id="country" /></br>
  <div class="black-bg">Change Mobile#</div><input  style="height:23px;"  type="text" value="<?php echo $key['mobile'];?>" name="mobile" id="mobile" /></br>
  <div class="black-bg">Change Password:</div><input  style="height:23px;" value="<?php echo $key['password'];?>"  type="text" name="password" id="password" />
    
    <input type="submit" name="change" value="Update" />
	<input   type="hidden" name="id" value=<?php echo $key['id'];?> />
    </form>
</div>
<div class="span6">
  	

  	<div class="black-bg">City:</div><div class="grey-bg"><?php echo $key['city'];?></div>

    <br>

  	<div class="black-bg">Address:</div><div class="grey-bg"><?php echo $key['address'];?></div>

     <br>
	<div class="black-bg">Mobile #:</div><div class="grey-bg"><?php echo $key['mobile'];?></div>

     <br>
  	<div class="black-bg">Country Name:</div><div class="grey-bg"><?php echo $key['country'];?></div>

    <br>
 

  	<div class="span6">
	<img style="width:200px; height:200px;"  src="<?php echo Yii::app()->request->baseUrl.'/images/user/'.$key['pic'];?>"></div>
	 <br><div class="span">
  	<div class="black-bg">Change Image:</div><form method="post" action="change_picture" onsubmit="return validateForm1()" enctype="multipart/form-data">
    <input type="hidden" style="height:33px;" name="id" value="<?php echo $key['id'];?>" />
    <input type="hidden" style="height:33px;" name="ppic" value="<?php echo $key['pic'];?>" />
    
    <input type="file" style="height:33px;" name="pic" id="pic" /> <br>
 
    <input  type="submit" name="change" value="Change Picture" />
    </form>
</div>
	 <?php } ?>

     <br>

  

    
    

 </div>

</div>
<div class="span12">
<h3>Rights On Projects</h3>
<div class="black-bg">#</div><div class="grey-bg">Project Name</div>
<?php 
foreach($project as $proj)
{
echo '<div class="black-bg">'.$proj['id'].'</div><div class="grey-bg">'.$proj['project_name'].'</div>
 <br>';
}
?>

</div>


 

 <div class="clearfix"></div>



 

 </section>

<!-- section 3 --> 

 <div class="clearfix"></div>
 <script>



function validateForm(){

	$("#error-address").hide();

	$("#error-city").hide();

$("#error-country").hide();
$("#error-mobile").hide();
$("#error-password").hide();

	

	//	var x=document.forms["form"]["firstname"].value;

	var a = $("#password").val();
	var address = $("#address").val();
	var mobile = $("#mobile").val();
	var city = $("#city").val();
	var country = $("#country").val();

	
	
var counter=0;
if (a==null || a=="")
  {
  $("#error-password").html("Enter Password");
  $("#error-password").show();
  counter =1;
  }
  if (mobile==null || mobile=="")
  {
  $("#error-mobile").html("Enter Mobile No");
  $("#error-mobile").show();
  counter =1;
  }if (address==null || address=="")
  {
  $("#error-address").html("Enter Address");
  $("#error-address").show();
  counter =1;
  }if (city==null || city=="")
  {
  $("#error-city").html("Enter City");
  $("#error-city").show();
  counter =1;
  }if (country==null || country=="")
  {
  $("#error-country").html("Enter Country");
  $("#error-country").show();
  counter =1;
  }


 if(counter==1)

  	return false;

  

}
function validateForm1(){

	$("#error-pic").hide();
	//	var x=document.forms["form"]["firstname"].value;

	var b = $("#pic").val();

	
var counter=0;
if (b==null || b=="")
  {
  $("#error-pic").html("Choose A Picture");
  $("#error-pic").show();
  counter =1;
  }
      

 if(counter==1)

  	return false;

  

}

 <!--VALIDATION END-->

 </script>
