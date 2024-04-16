<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.js"></script>
<script>
$(function() {
$( "#fromdatepicker" ).datepicker({ dateFormat: 'dd-mm-yy' });
});
$(function() {
$( "#todatepicker" ).datepicker({ dateFormat: 'dd-mm-yy' });
});
</script>

<div class="">
<div class="shadow">
  <h3>Allot A File</h3>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5">
<section class="reg-section margin-top-30">
  <?php 
$projects_data = Yii::app()->session['projects_array'];
?>
  <div class="float-left">
    <div> </div>
    <div class="alert alert-info" style="float:right;">
      <p class="reg-left-text"><b>Plot Type</b> <font color="#FF0000">*</font></p>
     <label style="float:left; margin-right:10px;"><input type="radio" name="pptype" value="R" class="new1" style="float:left;"  onclick="document.getElementById('project').disabled = false; $('#user_login_form').each(function(){this.reset();});" />Residential  </label>  
     <label style="float:left;"><input type="radio" name="pptype" value="C"  class="new1" style="float:left;" onclick="document.getElementById('project').disabled = false; $('#user_login_form').each(function(){this.reset();});"/>Commercial</label>
    </div>
    <?php $form=$this->beginWidget('CActiveForm', array(
 'id'=>'user_login_form',
 
 'enableAjaxValidation'=>false,
  'enableClientValidation'=>true,
                'method' => 'POST',
                'clientOptions'=>array(
                     'validateOnSubmit'=>true,
                     'validateOnChange'=>true,
                     'validateOnType'=>false,
  ),

)); ?>
    <div id="error-div" class="errorMessage" style="display: none; color:#F00; font-weight:bold;"></div>
    <div class="float-left">
      <p class="reg-left-text"><b>Application No</b> <font color="#FF0000">*</font></p>
<input type="number" style=" font-weight:bold; font-size:15;width:150px; height:25px; background-color:#0CF;" class="reg-login-text-field" id="appnoo" name="appnoo" value="">
</div>
    <div class="clearfix"></div>
    <div class="float-left">
      <p class="reg-left-text">Project <font color="#FF0000">*</font></p>
      <select id="project" name="project" disabled="disabled">
        <option value="file">Please Select Project </option>
        <?php	
            $res=array();
            foreach($projects as $key){
            echo '<option value="'.$key['id'].'">'.$key['project_name'].'</option>'; 
            }?>
      </select>
    </div>
    <div class="float-left">
  <p class="reg-left-text">Sector # <font color="#FF0000">*</font></p>
  <select name="sector" id="sector">
  <option value="">Select Sector</option>

  </select> 
  </div>
    <div class="float-left">
      <p class="reg-left-text">Street # <font color="#FF0000">*</font></p>
      <select id="street_id" name="street_id">
        <option value="">Please Select Street </option>
      </select>
    </div>
    <div class="float-left"> 
    <?php
    	$connection = Yii::app()->db;  
		$sql_plot  = "SELECT * from size_cat";
		$result_plots = $connection->createCommand($sql_plot)->query();
	?>
      <p class="reg-left-text">File Size <font color="#FF0000">*</font></p>
      <select name="size_id" id="size_id" >
        <option value="">File Size</option>
        <?php 
		foreach($result_plots as $row5){
			echo '<option value="'.$row5['id'].'">'.$row5['size'].'</option>';
			}
		?>
      </select>
    </div>
    <div class="float-left">
      <p class="reg-left-text">File No <font color="#FF0000">*</font></p>
      <select name="file_id" id="file_id">
        <option value="">Select File No</option>
      </select>
    </div>
    <div class="float-left">
      <p class="reg-left-text">CNIC<font color="#FF0000">*</font></p>
      <p class="reg-right-field-area margin-left-5">
        <input type="text" value="" name="cnic" id="cnic" class="reg-login-text-field" />
      </p>
    </div>
    <div class=""> <img name="image" id="image"/> </div>
    <div class="float-left">
      <p class="reg-left-text">File Membership No<font color="#FF0000">*</font></p>
      <p class="reg-right-field-area margin-left-5">
         <input type="text" value="" name="procode" id="procode" class="reg-login-text-field" style="width:60px;"  readonly/>

      <input type="text" value="" name="plotno" id="plotno" class="reg-login-text-field" style="width:140px;" />
	
      <input type="text" value="" name="sizecode" id="sizecode" class="reg-login-text-field" style="width:60px;" readonly/>
        
        <!-- <span style="color:#FF0000; display:block;" id="memerror"></span>--> 
        
      </p>
    </div>
    <div class="float-left">
      <p class="reg-left-text">Installment(After Months)<font color="#FF0000">*</font></p>
      <p class="reg-right-field-area margin-left-5">
        <input type="number" value="" name="noi" id="noi" class="reg-login-text-field" />
      </p>
    </div>
    <div class="float-left">
      <p class="reg-left-text">Discount <font color="#FF0000">*</font></p>
      <p class="reg-right-field-area margin-left-5">
        <input type="number" value="" name="disc" id="disc" class="reg-login-text-field" />
      </p>
    </div>
    <div class="float-left">
      <p class="reg-left-text">Discount Details <font color="#FF0000">*</font></p>
      <p class="reg-right-field-area margin-left-5">
        <input type="text" value="" name="discd" id="discd" class="reg-login-text-field" />
      </p>
    </div>
    <div class="float-left">
      <p class="reg-left-text">Plan Start Date<font color="#FF0000">*</font></p>
      <p class="reg-right-field-area margin-left-5">
        <input name="date"  type="text" placeholder="Enter Date" class="new-input" id="todatepicker">
      </p>
    </div>
    
 
    <div class="float-left">
      <p class="reg-left-text">Installment Plan<font color="#FF0000">*</font></p>
      <p class="reg-right-field-area margin-left-5">
        <select name="insplan" id="insplan">
          <option value="">Select Installment Plan</option>
        
        </select>
      </p>
    </div>
   
    <div class="float-left">
      <p class="reg-left-text">Allotment Type<font color="#FF0000">*</font></p>
      <p class="reg-right-field-area margin-left-5">
        <select name="atype" id="atype">
          <option value="">Select Type</option>
 <option value="Against Land">Against Land</option>          
<option value="On Payment">On Payment </option>
         
        </select>
      </p>
    </div>
   <div class="float-left" id="landowner1" >
<p class="reg-left-text">Land Owner<font color="#FF0000">*</font></p>
<p class="reg-rightfield-area margin-left-5">
<select  name="landowner" id="landowner">
<option value="">Select Owner</option>
</select>
</p>
</div>
    
    <!--  <input name="submit" type="submit" value="Alot File" class="btn-info pull-right" style="position: fixed; padding:5px;" />



--> 
    
    <?php echo CHtml::ajaxSubmitButton(



                                'Alot File',
 


    array('memberfile/alotafile'),



                                array(  



                'beforeSend' => 'function(){ 



                                             $("#login").attr("disabled",true);



            }',



                                        'complete' => 'function(){ 



                                             $("#user_login_form").each(function(){this.reset();});



                                             $("#login").attr("disabled",false);



                                        }',



                   'success'=>'function(data){  



                                           //  var obj = jQuery.parseJSON(data); 



                                            // View login errors!



        



                                             if(data == 1){



												// alert("we are here");



                                         location.href = "http://rdlpk.com/index.php/user/dashboard";



                                      }



          else{



                                                $("#error-div").show();



                                                $("#error-div").html(data);$("#error-div").append("");



												return false;



                                             }



 



                                        }' 



    ),



                         array("id"=>"login","class" => "btn-info pull-right")      



                ); ?> 
    
    <!--  </form>-->
    
    <?php $this->endWidget(); ?>
    <div style="height: 600px;



    padding: 0 0 0 32px;



    width: 300px;"> <span style="color:#FF0000; display:block;" id="error-project"></span> <span style="color:#FF0000; display:block;" id="error-street_id"></span> <span style="color:#FF0000; display:block;" id="error-file_id"></span> <span style="color:#FF0000;display:block;" id="error-cnic"></span> <span style="color:#FF0000;display:block;" id="error-downpayment"></span> <span style="color:#FF0000;display:block;" id="error-discount"></span> <span style="color:#FF0000;display:block;" id="error-noi"></span> <span style="color:#FF0000;display:block;" id="error-payment_type"></span> </div>
    
    <!--VALIDATION START--> 
    
<script>







    function validateForm() {



        $("#error-project").hide();



        $("#error-street_id").hide();



        $("#error-file_id").hide();



        $("#error-cnic").hide();



        $("#error-downpayment").hide();



        $("#error-discount").hide();



        $("#error-noi").hide();



        $("#error-payment_type").hide();



        //	var x=document.forms["form"]["firstname"].value;



        var w = $("#project").val();



        var x = $("#street_id").val();



        var y = $("#file_id").val();



        var c = $("#cnic").val();



        var i = $("#downpayment").val();



        var j = $("#discount").val();



        var k = $("#noi").val();



        var l = $("#payment_type").val();







        var counter = 0;



        if (w == null || w == "")



        {



            $("#error-project").html("Enter Project");



            $("#error-project").show();



            counter = 1;



        }



        if (x == null || x == "")



        {



            $("#error-street_id").html("Enter Street");



            $("#error-street_id").show();



            counter = 1;



        }



        if (y == null || y == "")



        {



            $("#error-file_id").html("Enter File Id");



            $("#error-file_id").show();



            counter = 1;



        }







        if (c == null || c == "")



        {



            $("#error-cnic").html("Enter CNIC");



            $("#error-cnic").show();



            counter = 1;



        }



        if (i == null || i == "")



        {



            $("#error-downpayment").html("Enter Down Payment");



            $("#error-downpayment").show();



            counter = 1;



        }



        if (j == null || j == "")



        {



            $("#error-discount").html("Enter Discount");



            $("#error-discount").show();



            counter = 1;



        }



        if (k == null || k == "")



        {



            $("#error-noi").html("Enter No. Of Installment");



            $("#error-noi").show();



            counter = 1;



        }



        if (l == null || l == "")



        {



            $("#error-payment_type").html("Enter No. Of Installment");



            $("#error-payment_type").show();



            counter = 1;



        }



        if (counter == 1)
            return false;







    }



<!--VALIDATION END-->



</script> 
<script>

$(document).ready(function()

     {  	
    $("#atype").change(function()
		{
						if($(this).val() == "Against Land")
					{
					  $("#landowner1").show();
					}
					else
					{
						 $("#landowner1").hide();
					}
            });
          $("#landowner1").hide();
	 $("#sector").change(function()

           {
        
			select_file($(this).val());
         	select_street($(this).val());

		   });

	 	 
	 	 $("#size_id").change(function()

           {
select_plan($(this).val());

         	var pro=$("#project").val();

			var street=$("#street_id").val();
			var sec=$("#sector").val();
			
			var size=$("#size_id").val();
			var pptype=$('.new1:checked').val();
$.ajax({
      type: "POST",
      url:    "sizecode?size="+size,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var newv='';
	$(json).each(function(i,val){
	newv= val.code;
});

var elem = document.getElementById("sizecode");
elem.value = pptype+newv;
//$("#plotno").value(newv);
          }
    });
			$.ajax({

      type: "POST",

      url:    "ajaxRequest1",

	   data:"pro="+pro+"&street="+street+"&size="+size+"&pptype="+pptype+"&sector="+sec,


	  contenetType:"json",

      success: function(jsonList){var json = $.parseJSON(jsonList);

	

		var listItems='';

	 listItems+= "<option value=''>Select File</option>";

	$(json).each(function(i,val){

	

	listItems+= "<option value='" + val.id + "'>" + val.plot_detail_address +" ("+val.plot_size+")</option>";



});listItems+="";



$("#file_id").html(listItems);



 }



});

		   });

	 

	 

       

		  

		   $("#country").change(function()

           {

         	select_city($(this).val());

		   });

           $("#cnic").change(function()

           {

         	select_cnic($(this).val());

		   });

	 $(".new1").click(function()
           {
//			   alert(this.value);
			   
         		select_size(this.value);
		   });

		    });

	var sid=$("#pptype").val();
			function select_size(id)
{
			$.ajax({
      type: "POST",
      url:    "ajaxRequest123?val1="+id,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
		var listItems='';
listItems+= "<option value=''>Select size</option>";
	$(json).each(function(i,val){
	listItems+= "<option value='" + val.id + "'>" + val.size +" </option>";
    });listItems+="";
	$("#size_id").html(listItems);
          }
});}
	function select_plan(id)
{
			var pro=$("#project").val();
			var size=$("#size_id").val();
$.ajax({
      type: "POST",
      url:    "ajaxRequest7?pro="+pro+"&&size="+size,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var listItems='';
	$(json).each(function(i,val){
	listItems+= "<option value='" + val.id + "'>" + val.tno +"&nbsp; Months &nbsp" +"("+val.description+" Installment Plan) </option>";
});listItems+="";
$("#insplan").html(listItems);
          }
});



}
function select_street(id)



{
			var pro=$("#project").val();
			var sec=$("#sector").val();
$.ajax({

      type: "POST",

      url:    "ajaxRequest?sec="+sec+"&&pro="+pro,

	  contenetType:"json",

      success: function(jsonList){var json = $.parseJSON(jsonList);

var listItems='';

listItems+= "<option value=''>Select Street</option>";



	$(json).each(function(i,val){



	listItems+= "<option value='" + val.id + "'>" + val.street + "</option>";

});listItems+="";

$("#street_id").html(listItems);

          }



    });}

function select_file(id)

{

$.ajax({

      type: "POST",

      url:    "ajaxRequest1?val1="+id,

	  contenetType:"json",

      success: function(jsonList){var json = $.parseJSON(jsonList);	  

		var listItems='';

	listItems+= "<option value=''>Select File</option>";

	$(json).each(function(i,val){

	 

	listItems+= "<option value='" + val.id + "'>" + val.plot_detail_address +" ("+val.plot_size+")</option>";



});listItems+="";



$("#file_id").html(listItems);



 }




});



}



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



function select_cnic(id)



{



$.ajax({



      type: "POST",



      url:    "ajaxRequest5?val1="+id,



   contenetType:"json",



      success: function(jsonList){var json = $.parseJSON(jsonList);



   



var listItems='';



 $(json).each(function(i,val){



 listItems+= '<img src="/upload_pic/' + val.image +'"/>';



      



});listItems+="";







$("#image").html(listItems);



          }



});



}



$(document).ready(function()
     {  	
       $("#project").change(function()
           {
            select_owner($(this).val());   
         	select_sector($(this).val());
		   });
     });
 function select_owner(id)
{
$.ajax({
      type: "POST",
      url:    "ajaxRequestlo?val1="+id,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var listItems='';
listItems+= "<option value=''>Select Land Owner</option>";
	$(json).each(function(i,val){
	listItems+= "<option value='" + val.lid + "'>" + val.name + "</option>";
});listItems+="";
$("#landowner").html(listItems);
          }
    });

}    
function select_sector(id)
{
$.ajax({
      type: "POST",
      url:    "ajaxRequest12?val1="+id,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var listItems='';
listItems+= "<option value=''>Select Sector</option>";
	$(json).each(function(i,val){
	listItems+= "<option value='" + val.id + "'>" + val.sector_name + "</option>";
});listItems+="";
$("#sector").html(listItems);
          }
    });
$.ajax({
      type: "POST",
      url:    "projectcode?val1="+id,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var newv='';
	$(json).each(function(i,val){
	
	newv= val.code;
});
var elem = document.getElementById("procode");
elem.value = newv;
//$("#plotno").value(newv);
          }
    });
}



</script> 
  </div>
</section>

<!-- section 3 --> 