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

  <span style="color:#FF0000; display:block;" id="error-title"></span>

  <span style="color:#FF0000; display:block;" id="error-amount"></span>

    </div>
<form method="post" action="edit" enctype="multipart/form-data" >

  <?php $res=array();
            foreach($plots as $plo){
				
     echo '
      <input type="hidden" value="'.$plo['id'].'" name="id" id="id" class="reg-login-text-field" />';
   ?>
  

 <div class="float-left">
    <p class="reg-left-text">Title<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input value="<?php echo $plo['title'];?>" name="title" id="title" type="text" />
</p>
 </div>
 <div class="float-left">
    <p class="reg-left-text">Amount<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input value="<?php echo $plo['amount'];?>" name="amount" id="amount" type="text" />
</p>
 </div>
   <?php }?>
    <input name="submit" value="Edit Form Payment" type="submit" class="btn-info pull-right" />
    </form>

 

 </div>

 </section>

<!-- section 3 -->

<!--VALIDATION START-->

 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>


<script>



function validateForm(){

	$("#error-title").hide();

	$("#error-amount").hide();
    var a = $("#title").val();

	var b = $("#amount").val();

var counter=0;
if (a==null || a=="")
  {
  $("#error-title").html("Enter Title");
  $("#error-title").show();
  counter =1;
  }
if (b==null || b=="")
  {
  $("#error-amount").html("Enter Amount");
  $("#error-amount").show();
  counter =1;
  }
 
 
 if(counter==1)

  	return false;

  

}

 <!--VALIDATION END-->

 </script>
