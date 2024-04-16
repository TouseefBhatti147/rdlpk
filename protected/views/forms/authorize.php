<div class="">
<div class="shadow">
  <h3>Authorize Forms</h3>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5 ">
<section class="reg-section margin-top-30">
<?php $form=$this->beginWidget('CActiveForm', array(
 'id'=>'plots',
 'enableAjaxValidation'=>false,
'htmlOptions' => array('enctype' => 'multipart/form-data'),
  'enableClientValidation'=>true,
                'method' => 'POST',
				'clientOptions'=>array(
			    'validateOnSubmit'=>true,
		        'validateOnChange'=>true,
				'stateful'=>true, 
	            'validateOnType'=>false,),
)); ?>
<div id="error-div" class="errorMessage" style="display: none; color:#F00;"></div>
  
  <div class="float-left">
    <p class="reg-left-text">Projects<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <select name="project_id" id="project_id"><?php	
	
            $res=array();
			foreach($projects as $key){
            echo '<option value="'.$key['id'].'">'.$key['project_name'].'</option>'; 
            }?></select>
     </p>
  </div>
   <div class="float-left">
    <p class="reg-left-text">First Code.<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text"  value="<?php echo $last_id['scode']; ?>" name="scode" id="scode" style="width:50px;" />
    </p>
  </div>
   <div class="float-left">
    <p class="reg-left-text">From Form No.<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" name="from" id="from" style="width:100px;" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">To Form No<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" name="to" id="to" style="width:100px;"/>
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Second Code.<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text"  value="<?php echo $last_id['scode1']; ?>" name="scode1" id="scode1" style="width:50px;" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">User<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <select name="user_id" id="user_id"><?php	
	
            $res=array();
			foreach($user as $key){
              echo '<option value="'.$key['id'].'">'.$key['firstname'].'&nbsp;'.$key['middelname'].'&nbsp;'.$key['lastname'].'</option>'; 
            }?></select>
     </p>
  </div>
    
   
  <?php echo CHtml::ajaxSubmitButton(
                         'Authorize Forms',
    array('forms/authorizeforms'),
                                array(  
                'beforeSend' => 'function(){ 
                                             $("#submit").attr("disabled",true);
            }',

                                        'complete' => 'function(){ 
                                             $("#plots").each(function(){ });
                                             $("#submit").attr("disabled",false);
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
                                        }' ),
									 array("id"=>"login","class" => "btn-info pull-right")      ); ?>
  <?php $this->endWidget(); ?>
 </div>
 </section>
<!-- section 3 -->
<!--VALIDATION START-->
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
function validateForm(){
	$("#error-project").hide();
	$("#error-street").hide();
	$("#error-plot_size").hide();





	$("#error-address").hide();



	$("#error-dim").hide();



	$("#error-size2").hide();



	$("#error-sector").hide();



	$("#error-price").hide();



	$("#error-cat").hide();



	$("#error-type").hide();



	$("#error-cstatus").hide();

	$("#error-image").hide();



	//	var x=document.forms["form"]["firstname"].value;



	var k = $("#project").val();



	var x = $("#street_id").val();



	var y = $("#plot_detail_address").val();



	var z = $("#plot_size").val();



	var a = $("#size2").val();



	var b = $("#sector").val();



	var c = $("#price").val();



	var d = $("#cat").val();



	var e = $("#com_res").val();



	var f = $("#cstatus").val();





var counter=0;







if (k==null || k=="")



  {



  $("#error-project").html("Project Required");



  $("#error-project").show();



  counter =1;



  }



if (x==null || x=="")



  {



  $("#error-street").html("Enter Street #");



  $("#error-street").show();



  counter =1;



  }



if (y==null || y=="")



  {



  $("#error-address").html("Enter Plot No");



  $("#error-address").show();



  counter =1;



  }



  if (z==null || z=="")



  {



  $("#error-plot_size").html("Enter Plot Diemension");



  $("#error-plot_size").show();



  counter =1;



  }



  if (a==null || a=="")



  {



  $("#error-size2").html("Enter Plot Size Required");



  $("#error-size2").show();



  counter =1;



  }



  if (b==null || b=="")



  {



  $("#error-sector").html("Enter Plot Sector");



  $("#error-sector").show();



  counter =1;



  }



  if (c==null || c=="")



  {



  $("#error-price").html("Enter Plot Price");



  $("#error-price").show();



  counter =1;



  }



  if (d==null || d=="")



  {



  $("#error-cat").html("Enter Plot Category");



  $("#error-cat").show();



  counter =1;



  }



  if (e==null || e=="")



  {



  $("#error-type").html("Enter Plot Type");



  $("#error-type").show();



  counter =1;



  }



  if (f==null || f=="")



  {



  $("#error-status").html("Enter Plot Status");



  $("#error-status").show();



  counter =1;



  }  

      



 if(counter==1)



  	return false;



  



}



 <!--VALIDATION END-->







 



  $(document).ready(function()
     {  	
       $("#project").change(function()
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



