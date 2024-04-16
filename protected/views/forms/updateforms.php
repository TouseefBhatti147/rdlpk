<div class="">

<div class="shadow">

  <h3>Edit Forms</h3>

</div>

<!-- shadow -->

<hr noshade="noshade" class="hr-5 ">

<section class="reg-section margin-top-30">

  <div style="

    padding: 0 0 0 32px;

    width: 300px;">

  <span style="color:#FF0000; display:block;" id="error-project"></span>

  <span style="color:#FF0000; display:block;" id="error-street_id"></span>

  <span style="color:#FF0000; display:block;" id="error-plot_detail_address"></span>

  <span style="color:#FF0000;display:block;" id="error-plot_size"></span>
  

  <span style="color:#FF0000;display:block;" id="error-com_res"></span>   

  <span style="color:#FF0000;display:block;" id="error-sector"></span>   

 <span style="color:#FF0000;display:block;" id="error-price"></span>   
<span style="color:#FF0000;display:block;" id="error-cstatus"></span>   

 

   </div>
<form method="post" action="update11" enctype="multipart/form-data"  >

  <?php $res=array();
            foreach($plots as $plo){
				
     echo '
      <input type="hidden" value="'.$plo['id'].'" name="id" id="id" class="reg-login-text-field" />
   <div class="float-left">
  <p class="reg-left-text">Project<font color="#FF0000">*</font></p>
  <select name="project_id" id="project" readonly>
   <option value="'.$plo['project_id'].'">'.$plo['project_name'].'</option>';
           ?>
  </select>
  </div>
  
   <div class="float-left">
    <p class="reg-left-text">Form No.<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input value="<?php echo $plo['scode'].$plo['formno'].$plo['scode1'].$plo['Gserial'];?>" readonly="readonly" name="name" id="name" type="text" />
</p>
 </div>
 <div class="float-left">
    <p class="reg-left-text">Name<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input value="<?php echo $plo['name'];?>" name="name" id="name" type="text" />
</p>
 </div>
 <div class="float-left">
    <p class="reg-left-text">Father/Spouse Name<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input value="<?php echo $plo['sodowo'];?>" name="sodowo" id="sodowo" type="text" />
</p>
 </div>
 <div class="float-left">
    <p class="reg-left-text">CNIC<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input value="<?php echo $plo['cnic'];?>" name="cnic" id="cnic" type="text" />
</p>
 </div>
 <div class="float-left">
    <p class="reg-left-text">Phone(Office)<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input value="<?php echo $plo['phone'];?>" name="phone" id="phone" type="text" />
</p>
 </div>
 <div class="float-left">
    <p class="reg-left-text">Phone(Residence)<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input value="<?php echo $plo['phoneres'];?>" name="phoneres" id="phoneres" type="text" />
</p>
 </div>
 <div class="float-left">
    <p class="reg-left-text">Mobile<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input value="<?php echo $plo['mobile'];?>" name="mobile" id="mobile" type="text" />
</p>
 </div>
 <div class="float-left">
    <p class="reg-left-text">Email<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input value="<?php echo $plo['email'];?>" name="email" id="email" type="text" />
</p>
 </div>
 <div class="float-left">
    <p class="reg-left-text">Address<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input value="<?php echo $plo['address'];?>" name="address" id="address" type="text" />
</p>
 </div>
 <div class="float-left">
    <p class="reg-left-text">Profession<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
    <select name="profession" id="profession">
   <?php if(!empty($plo['profession'])){ echo'<option value="'.$plo['profession'].'">'.$plo['profession'].'</option>';}?> 
    <option value="IT Engineer">IT Engineer</option>
    <option value="Software Engineer">Software Engineer</option>
    <option value="Electrical Engineer">Electrical Engineer</option>
    <option value="Doctor">Doctor</option>
    <option value="Business Man">Business Man</option>
    <option value="Manager">Manager</option>
      
    </select>
</p>
 </div>

   <?php }?>
    <input name="submit" value="Edit Form" type="submit" class="btn-info pull-right" />
    </form>

 

 </div>

 </section>

<!-- section 3 -->

<!--VALIDATION START-->

 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<script>



 <!--VALIDATION END-->



 

  $(document).ready(function()

     {  	

		

       $("#project").change(function()

           {

         	select_street($(this).val());

		   });

		   

		  
		    $("#plot_detail_address").change(function()

           {

         	select_plotno($(this).val());

		   });

     });

 

 
function select_plotno(id)
{
$.ajax({
      type: "POST",
      url:    "ajaxRequest6?val1="+id,
   contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var listItems='';
 $(json).each(function(i,val){
	listItems+= "<option value='" + val.id + "'>" + val.plotno + "</option>";

});listItems+="";
$("#plotno").html(listItems);
          }

});

}

function select_street(id)

{

$.ajax({

      type: "POST",

      url:    "ajaxRequest?val1="+id,

	  contenetType:"json",

      success: function(jsonList){var json = $.parseJSON(jsonList);

var listItems='';

	$(json).each(function(i,val){

	listItems+= "<option value='" + val.id + "'>" + val.street + "</option>";

      



});listItems+="";



$("#street_id").html(listItems);

          }

    });

}

</script>


<script>



function validateForm(){

	$("#error-project").hide();

	$("#error-street_id").hide();

	
	

	$("#error-plot_detail_address").hide();

	$("#error-com_res").hide();

	$("#error-cstatus").hide();

	$("#error-sector").hide();
    $("#error-price").hide();
	

	//	var x=document.forms["form"]["firstname"].value;

	var a = $("#project").val();

	var b = $("#street_id").val();

	var c = $("#plot_size").val();

	var d = $("#size2").val();

	var e = $("#plot_detail_address").val();

	var f = $("#com_res").val();

	var g = $("#cstatus").val();

	var h = $("#sector").val();

    var i = $("#price").val();
var counter=0;
if (a==null || a=="")
  {
  $("#error-project").html("Enter Project");
  $("#error-project").show();
  counter =1;
  }
if (b==null || b=="")
  {
  $("#error-street_id").html("Enter Street");
  $("#error-street_id").show();
  counter =1;
  }
  if (c==null || c=="")
  {
  $("#error-plot_size").html("Enter Plot Diemension");
  $("#error-plot_size").show();
  counter =1;
  }
  if (d==null || d=="")

  {

  $("#error-size2").html("Enter Plot Size");

  $("#error-size2").show();

  counter =1;

  }

    if (e==null || e=="")
  {
  $("#error-plot_detail_address").html("Enter Plot Number");
  $("#error-plot_detail_address").show();
  counter =1;

  }  

    if (f==null || f=="")

  {

  $("#error-com_res").html("Enter Plot Type");

  $("#error-com_res").show();

  counter =1;

  }     

    if (g==null || g=="")

  {

  $("#error-cstatus").html("Select Plot Status");

  $("#error-cstatus").show();

  counter =1;

  }     

     if (h==null || h=="")

  {

  $("#error-sector").html("Enter Plot Sector");

  $("#error-sector").show();

  counter =1;

  }
     if (i==null || i=="")

  {

  $("#error-price").html("Enter Plot Price");

  $("#error-price").show();

  counter =1;

  }     

 if(counter==1)

  	return false;

  

}

 <!--VALIDATION END-->

 </script>
