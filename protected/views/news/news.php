<div class="">



<div class="shadow">

  <h3>Add News/Events</h3>

</div>

<!-- shadow -->

<hr noshade="noshade" class="hr-5 ">

<section class="reg-section margin-top-30">





		

<form action="create"  onsubmit="return validateForm()" method="post">

  <div style="height: 80px;

    padding: 0 0 0 32px;

    width: 300px;">

  <span style="color:#FF0000; display:block;" id="error-teaser"></span>

  <span style="color:#FF0000; display:block;" id="error-details"></span>

  <span style="color:#FF0000; display:block;" id="error-status"></span>

 

   </div> 

	

  

   <div class="float-left" >

  <p class="reg-left-text">Teaser<font color="#FF0000">*</font></p>

  

  <textarea name="teaser" id="teaser"></textarea>

  </div>

  <div class="float-left">

  <p class="reg-left-text">Detail<font color="#FF0000">*</font></p>

 <textarea name="details" id="details"></textarea>

  </div>

 

  <div class="float-left" >

  <p class="reg-left-text">Status<font color="#FF0000">*</font></p>

  <select name="status" id="status">
<option value="" >Select Status</option>
 			<option value="active" >Active</option>

            <option value="inactive" >Inactive</option>

  </select>

  </div>

  

    <input name="submit" value="Add" type="submit" class="btn btn-info"  />

   
 </form> 

 

 </div>

 </section>

<!-- section 3 --> 

<!--VALIDATION START-->

 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<script>



function validateForm(){

	

	$("#error-teaser").hide();

	$("#error-details").hide();

	$("#error-status").hide();

	

	//	var x=document.forms["form"]["firstname"].value;

	var k = $("#teaser").val();

	var x = $("#details").val();

	var y = $("#status").val();





var counter=0;



if (k==null || k=="")

  {

  $("#error-teaser").html("Enter News Teaser");

  $("#error-teaser").show();

  counter =1;

  }

if (x==null || x=="")

  {

  $("#error-details").html("Enter News Detail");

  $("#error-details").show();

  counter =1;

  }

if (y==null || y=="")

  {

  $("#error-status").html("Select Status");

  $("#error-status").show();

  counter =1;

  }



 if(counter==1)

  	return false;

  

}

</script>

 <!--VALIDATION END-->



