<?php session_start(); ?>
<div class="form-signin mg-btm">
  <div class="shadow">
    <h3>ALot A Plot</h3>
  </div>
  <!-- shadow -->
  <hr noshade="noshade" class="hr-5 float-left">
  <section class="reg-section margin-top-30">

    <form action="create_member" method="post">
    <p class="reg-left-text">Project <font color="#FF0000">*</font></p>
    <select id="project">
      <option value="plot">please Select Project </option>
      <?php	
            $res=array();
            foreach($projects as $key){
            echo '<option value="'.$key['id'].'">'.$key['project_name'].'</option>'; 
            }?>
    </select>
    <div class="float-left">
      <p class="reg-left-text">Street #<font color="#FF0000">*</font></p>
    <select id="street_id">
      <option value="plot">please Select Street </option>
    </select>
</div>
  <div class="float-left">
    <p class="reg-left-text">Plot ID <font color="#FF0000">*</font></p>
    <select name="plot_id" id="plot_id">
      <option value="plot">plot</option>
    </select>
  </div>
 
  <div class="float-left">
    <p class="reg-left-text">Name<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" name="name" id="name" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Member Id<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" name="mem_id" id="mem_id" class="reg-login-text-field" />
    </p>
  </div>
    <div class="float-left">
    <p class="reg-left-text">Date Of Birth<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" name="dob" id="dob" class="reg-login-text-field" />
    </p>
  </div>
  
  <div class="float-left">
    <p class="reg-left-text">S/O-D/O-W/O<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" name="sodowo" id="sodowo" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">NIC<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" name="cnic" id="cnic" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Address<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" name="address" id="adress" class="reg-login-text-field" />
    </p>
  </div>
   <div class="float-left">
    <p class="reg-left-text">Email<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" name="email" id="email" class="reg-login-text-field" />
    </p>
  </div>
 
   <div class="float-left">
    <p class="reg-left-text">Country<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <select name="country" id="country">
     <option value="pakistan">Pakistan</option>
     <option value="uk">UK</option>
     <option value="usa">USA</option>
     <option value="india">INDIA</option>
     <option value="China">China</option>
     <option value="spain">Spain</option>
     <option value="canada">Canada</option>
     <option value="australia">Australia</option>
            
     </select>
    </p>
  </div>
   <div class="float-left">
    <p class="reg-left-text">City<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <select name="city" id="city">
     <option value="islamabad">Islamabad</option>
     <option value="rawalpindi">Rawalpindi</option>
     <option value="quetta">Quetta</option>
     <option value="karachi">Karachi</option>
     <option value="peshawer">Peshawer</option>
     <option value="multan">Multan</option>
     <option value="jehlum">Jehlum</option>
     <option value="gujjarkhan">Gujjar Khan</option>
     <option value="london">London</option>
     <option value="washington">Washington</option>
     <option value="beijing">Beijing</option>
     <option value="barcelona">Barcelona</option>
     <option value="sydney">Sydney</option>
            
     </select>
    </p>
  </div>
  
  <div class="float-left">
    <p class="reg-left-text">Mobile<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" name="phone" id="phone" class="reg-login-text-field" />
    </p>
  </div>
  <button type="submit" >Submit</button>
  </form>
  <script>
 
  $(document).ready(function()
     {  	
		
       $("#project").change(function()
           {
         	select_street($(this).val());
		   });
		   
		   $("#street_id").change(function()
           {
         	select_plot($(this).val());
		   });
     });
 
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
function select_plot(id)
{
$.ajax({
      type: "POST",
      url:    "ajaxRequest1?val1="+id,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
	  
var listItems='';
	$(json).each(function(i,val){
	listItems+= "<option value='" + val.id + "'>" + val.plot_detail_address +" ("+val.plot_size+")</option>";
      
});listItems+="";

$("#plot_id").html(listItems);
          }
});
}

</script> 
</div>
</section>
<!-- section 3 --> 
