<div class="">

<div class="shadow">

  <h3>ADD Multiple Files</h3>

</div>

<!-- shadow -->

<hr noshade="noshade" class="hr-5">

<section class="reg-section margin-top-30">



		

<form action="createmultifile" method="post">

<input type="hidden" name="type" value="File" />

<div id="error-div" class="errorMessage" style="display: none;"></div>

	

  <div class="float-left" style="display:none;">

    <p class="reg-left-text">File ID <font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" value="" name="id" id="id" class="reg-login-text-field" />

    </p>

  </div>

    <div class="float-left" >

  <p class="reg-left-text">Project ID <font color="#FF0000">*</font></p>

  <select name="project_id" id="project_id">
   <option>....Select....</option>
 			 <?php	

            $res=array();

            foreach($projects as $key){

            echo '<option value="'.$key['id'].'">'.$key['project_name'].'</option>'; 

            }?>

  </select>

  </div>

  <div class="float-left">

  <p class="reg-left-text">Street ID <font color="#FF0000">*</font></p>

  <select name="street_id" id="street_id">

  

  <option value="street">street</option>

  

  </select>

  </div>

  <div class="float-left">

    <p class="reg-left-text">File Number <font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" value="" name="file_detail_address" id="file_detail_address" class="reg-login-text-field" />

    </p>

  </div>

  <div class="float-left">

    <p class="reg-left-text">File Size<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" value="" name="file_size" id="file_size" class="reg-login-text-field" />

    </p>

  </div>

  <div class="float-left" >

  <p class="reg-left-text">Type<font color="#FF0000">*</font></p>

  <select name="com_res" id="com_res">

 			<option value="Commercial">Commercial</option>

            <option value="Residential">Residential</option>

  </select>

  </div>

   <div class="float-left">

    <p class="reg-left-text">Price <font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" value="" name="price" id="price" class="reg-login-text-field" />

    </p>

  </div>

   <div class="float-left">

    <p class="reg-left-text">No Of Installment <font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" value="" name="noi" id="noi" class="reg-login-text-field" />

    </p>

  </div>

 <div class="float-left">

    <p class="reg-left-text">No Of File/es <font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="number" value="" name="nof" id="nof" class="reg-login-text-field" />

    </p>

  </div>

 

    <input name="submit" type="submit" class="btn-info pull-right" style="position: fixed; padding:5px;" />

    

</form>

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

      

		

   // $.each(val,function(k,v){

     //     console.log(k+" : "+ v);     

//});

});listItems+="";



$("#street_id").html(listItems);

          }//,

      //error: function(xhr){

      //alert("failure"+xhr.readyState+this.url)



      //}

    });

}

</script>

