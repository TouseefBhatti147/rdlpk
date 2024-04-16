<style>
  h5{
    background-color:lightblue;
  }
</style>
<div class="shadow">
  <h3>Update Member</h3>
</div>
<div class="span12">
    <h5>Personal Info</h5>
    <hr/>
</div>
<!-- shadow -->
<hr noshade="noshade" class="">
<section class="reg-section margin-top-30">
<div style="padding: 0 0 0 32px; width: 300px;">
  <span style="color:#FF0000; display:block;" id="error-name"></span> 
   <span style="color:#FF0000; display:block;" id="error-username"></span> 
  <span style="color:#FF0000;display:block;" id="error-dob"></span> 
  <span style="color:#FF0000;display:block;" id="error-sodowo"></span>
   <span style="color:#FF0000;display:block;" id="error-cnic"></span>
    <span style="color:#FF0000;display:block;" id="error-address"></span>
     <span style="color:#FF0000;display:block;" id="error-email"></span>
      <span style="color:#FF0000;display:block;" id="error-country"></span> 
      <span style="color:#FF0000;display:block;" id="error-city"></span>
       <span style="color:#FF0000;display:block;" id="error-phone"></span>
        <span style="color:#FF0000;display:block;" id="error-nomineename">
        </span> <span style="color:#FF0000;display:block;" id="error-nomineecnic"></span>
         <span style="color:#FF0000;display:block;" id="error-rwa"></span>
           <span style="color:#FF0000;display:block;" id="error-title"></span> 
           <span style="color:#FF0000;display:block;" id="error-btitle"></span> </div>
<form action="Memberupdate" method="post" onsubmit="return validateForm()" enctype="multipart/form-data"> 
 	<?php	
            $res=array();
            foreach($update_member as $key){?>

     <input  type="hidden" id="memreq_id" name="memreq_id" value="<?php echo $key['id']; ?>"/>
  <div class="float-left">
    <p class="reg-left-text">Name <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="<?php echo $key['name'];?>" name="name" id="name" class="reg-login-text-field" />
    </p>
  </div>

  <div class="float-left">
    <p class="reg-left-text">Username <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <input type="text"  value="<?php echo $key['username']; ?>" name="username" id="username" class="reg-login-text-field" />
     </p>
  </div>
 <div class="float-left">
    <p class="reg-left-text">Date Of Birth <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <input type="text" value="<?php echo $key['dob']; ?>" name="dob" id="dob" class="reg-login-text-field" />
     </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Mobile # <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <input type="text" value="<?php echo $key['phone']; ?>" name="phone" id="phone" class="reg-login-text-field" />
     </p>
  </div>
  
 <div class="float-left">
    <p class="reg-left-text">CNIC <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <input type="text"  value="<?php echo $key['cnic']; ?>" name="cnic" id="cnic" class="reg-login-text-field" />
     </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Father/Spouse <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
	<select name="title" id="title" style="width:60px;">
	<option value="<?php echo $key['title']; ?>"><?php echo $key['title'];?> </option>
    <option value="">---</option>
    <option value="s/o">s/o</option>
     <option value="d/o">d/o</option>
      <option value="w/o">w/o</option>
    </select>
     <input type="text"  value="<?php echo $key['sodowo'];?>" name="sodowo" id="sodowo" class="reg-login-text-field" style="width:238px;" />
     </p>
  </div>
   <div class="float-left">
    <p class="reg-left-text">Email <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <input type="text" value="<?php echo $key['email']; ?>"  name="email" id="email" class="reg-login-text-field" />
     </p>
  </div>
   <div class="float-left">
    <p class="reg-left-text">Address <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <input type="text" value="<?php echo $key['address']; ?>"  name="address" id="address" class="reg-login-text-field" /></p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Country<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <select name="country" id="country">
     <option value="<?php echo $key['country_id'];?>"><?php echo $key['country'];?> </option>
      <?php	
            $res=array();
            foreach($country as $key1){
            echo '<option value="'.$key1['id'].'">'.$key1['country'].'</option>'; 
            }?>
    </select>
    </p>
  </div>
   <div class="float-left">
    <p class="reg-left-text">City<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
    <select name="city" id="city_id">
<option value="<?php echo $key['city_id'];?>"><?php echo $key['city'];?> </option>
    </select>
    </p>
  </div>
  <div class="float-left">
  <p class="reg-left-text">Status <font color="#FF0000">*</font></p>
 <p class="reg-right-field-area margin-left-5">
 <select id="status" name="status">
<?php 
if($key['status']=='0')
{
 echo '<option value="0">In-Active</option>';  
}
if($key['status']=='1')
{
 echo '<option value="1">Active</option>';  
}
?>
<option value="1">Active</option>
<option value="0">In-Active</option>
<option value="2">Delete</option>
</select></p></div>

  <div class="span12">
    <h5>Nominee Info</h5>
 <hr/>
  </div>	  
 <div class="float-left">
   <p class="reg-left-text">Nominee Name <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <input type="text" value="<?php echo $key['nomineename']; ?>" name="nomineename" id="nomineename" class="reg-login-text-field" /></p>
     </div>
	 
	  <div class="float-left">
   <p class="reg-left-text">Nominee CNIC <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <input type="text" value="<?php echo $key['nomineecnic']; ?>"  name="nomineecnic" id="nomineecnic" class="reg-login-text-field" /></p>
     </div>
	  <div class="float-left">
   <p class="reg-left-text">Relation With Applicant <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <input type="text" value="<?php echo $key['rwa']; ?>"  name="rwa" id="rwa" class="reg-login-text-field" /></p>
     </div>
     <div class="span5">
    <h5>Dealer Info</h5>
 <hr/>

<?php $dealer='';
if($key['mtype']=='Dealer'){
$dealer='checked';
}?>
<div class="float-left">
   <p class="reg-left-text">Business Title <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
    <input type="text" value="<?php echo $key['business_title']; ?>" name="business_title" id="business_title" class="reg-login-text-field" /></p>
     </div> 
<div class="float-left">
 <p class="reg-right-field-area margin-left-5">
<lable>Dealer</lable>
      <input type="checkbox" value="<?php echo $dealer;?>" name="mtype" id="mtype" class="reg-login-text-field" <?php echo $dealer?>/>
    </p>
  </div>

  <div class="float-left">
    <p class="reg-right-field-area margin-left-5"> 
<input type="submit" class="btn-info button" name="update" value="Update Member" />		
   </p>
  </div>
</div>
 </form> 



<div class="span6" style="border: 1px solid;">
    <h5>Update Member Image</h5>
 <hr/>
  <div class="float-left"> 
  <h4>Update Image</h4>
  <form action="<?php echo $this->createAbsoluteUrl('member/updateimg');?>" enctype="multipart/form-data" method="post" >
   <div class="float-left">
    <p class="reg-left-text">Image<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
   <?php echo' <img style="height:150px ;" src="'.Yii::app()->request->baseUrl.'/upload_pic/'.$key['image'].'">';?>
    <input id="image" type="file" name="image" accept="image/*">
     <input type="hidden" value="<?php echo $key['id']; ?> "    name="id" id="id" class="reg-login-text-field" />
     <input type="submit" class="btn-info button" name="update" value="Update Image" />
</p>
</div>   
</div>
</div>


<?php }?>

</section>
<!-- section 3 --> 

 <script>
  $(document).ready(function()

     {  	
       $("#country").change(function()
           {
         	select_city($(this).val());
		   });
     });
function select_city(id)
{
$.ajax({
      type: "POST",
      url:    "ajaxRequest3?val1="+id,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var listItems='';
	$(json).each(function(i,val){
	listItems+= "<option value='" + val.id + "'>" + val.city +" </option>";
});listItems+="";
$("#city_id").html(listItems);
          }
});
}

</script> 

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<script>
function validateForm(){
   $("#error-title").hide();
	$("#error-name").hide();
	$("#error-username").hide();
	$("#error-dob").hide();
	$("#error-sodowo").hide();
	$("#error-cnic").hide();
	$("#error-address").hide();
	$("#error-email").hide();
	$("#error-country").hide();
	$("#error-city").hide();
	$("#error-phone").hide();
	$("#error-nomineename").hide();
	$("#error-nomineecnic").hide();
	$("#error-rwa").hide();
  $("#error-btitle").hide();

	//	var x=document.forms["form"]["firstname"].value;
        var title = $("#title").val();
	var n = $("#name").val();
	var un = $("#username").val();
	var y = $("#username").val();
	var z = $("#password").val();
	var a = $("#dob").val();
	var b = $("#sodowo").val();
	var c = $("#cnic").val();
	var d = $("#address").val();
	var e = $("#email").val();
	var f = $("#country").val();
	var g = $("#city_id").val();
	var h = $("#phone").val();
	var i = $("#nomineename").val();
	var p = $("#nomineecnic").val();
	var q = $("#rwa").val();
  var btitle = $("#business_title").val();
  var mtype=$("#mtype").val();
  ///alert(mtype);exit;
var counter=0;
if (title==null || title=="")
  {
  $("#error-title").html("Select Title S/O,D/o,W/o");
  $("#error-title").show();
  counter =1;
  }
if (un==null || un=="")
  {
  $("#error-username").html("Enter Username");
  $("#error-username").show();
  counter =1;
  }

if (n==null || n=="")
  {
  $("#error-name").html("Enter Name");
  $("#error-name").show();
  counter =1;
  }
  if (a==null || a=="")
  {
  $("#error-dob").html("Enter D.O.B");
  $("#error-dob").show();
  counter =1;
  }
  if (b==null || b=="")
  {
  $("#error-sodowo").html("Enter Son of/Daughter Of/Wife Of");
  $("#error-sodowo").show();
  counter =1;
  }
  if (c==null || c=="")
  {
  $("#error-cnic").html("Enter CNIC");
  $("#error-cnic").show();
  counter =1;
  }
  if (d==null || d=="")
  {
  $("#error-address").html("Enter Address");
  $("#error-address").show();
  counter =1;
  }
  if (e==null || e=="")
  {
  $("#error-email").html("Enter Email");
  $("#error-email").show();
  counter =1;
  }
  if (f==null || f=="")
  {
  $("#error-country").html("Enter Country");
  $("#error-country").show();
  counter =1;
  }  
   if (g==null || g=="")
  {
  $("#error-city").html("Enter City");
  $("#error-city").show();
  counter =1;
  }  
   if (h==null || h=="")
  {
  $("#error-phone").html("Enter Mobile #");
  $("#error-phone").show();
  counter =1;
  }      
    if (i==null || i=="")
  {
  $("#error-nomineename").html("Enter Nominee Name");
  $("#error-nomineename").show();
  counter =1;
  }      
    if (p==null || p=="")
  {
  $("#error-nomineecnic").html("Enter Nominee CNIC");
  $("#error-nomineecnic").show();
  counter =1;
  }      
    if (q==null || q=="")
  {
  $("#error-rwa").html("Enter relation with applicant");
  $("#error-rwa").show();
  counter =1;
  }      
 if(counter==1)
  	return false;
	$("#error-status").hide();
	var k = $("#status").val();
  var counter=0;
 if (k==null || k=="")
  {
  $("#error-name").html("Select Status");
  $("#error-status").show();
  counter =1;
  }
  if ((btitle==null || btitle=="") && (mtype=="checked"))
  {
  $("#error-btitle").html("Enter Business Title");
  $("#error-btitle").show();
  counter =1;
  }elseif { ((btitle==null || btitle=="") && (mtype=="")) counter =0;}

 if(counter==1)
  	return false;

}


</script>

 