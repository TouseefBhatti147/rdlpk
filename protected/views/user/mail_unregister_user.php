<div class="">

<div class="shadow">

<h3>Email To Visitor</h3>

</div>

<!-- shadow -->

<hr noshade="noshade" class="hr-5">

<section class="reg-section margin-top-30">







<form action="<?php echo $this->createAbsoluteUrl('user/Mail');?>" method="post">

<div id="error-div" class="errorMessage" style="display: none;"></div>




<input type="hidden" value="<?php echo $_REQUEST['id'];?>" name="id" id="id" class="reg-login-text-field" />

<div class="float-left" >

<p class="reg-left-text">Member Name<font color="#FF0000">*</font></p>
<?Php 
foreach($mail as $key)
{

echo '<input type="text" name="name"  value="'.$key['name'].'" /> 

</div>



<div class="float-left">

<p class="reg-left-text">Email <font color="#FF0000">*</font></p>

<p class="reg-right-field-area margin-left-5">

<input type="email" value="'.$key['email'].'" name="email" id="subject" class="reg-login-text-field" />

</p>

</div>

<div class="float-left">

<p class="reg-left-text">Message<font color="#FF0000">*</font></p>

<p class="reg-right-field-area margin-left-5">

<textarea name="message"></textarea>

</p>

</div>';
}?>


<input name="submit" value="Send Email" type="submit"  class="btn btn-info"  value="Send Message"/>

</div>





</div>

</section>

<!-- section 3 -->

<script>



$(document).ready(function()

{



$("#project_id").change(function()

{

select_street($(this).val());

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

</script>

