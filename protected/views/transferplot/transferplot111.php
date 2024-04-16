
<div class="shadow">
  <h1>Plot Transfer Form</h1>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5 float-left">
<section class="reg-section margin-top-30">
<?php /* $form=$this->beginWidget('CActiveForm', array(
 'id'=>'transferplot_register_form',
 'enableAjaxValidation'=>false,
  'enableClientValidation'=>true,
                'method' => 'POST',
                'clientOptions'=>array(
                     'validateOnSubmit'=>true,
                     'validateOnChange'=>true,
                     'validateOnType'=>false,	
					 ),
						)); */
$projects_data = Yii::app()->session['projects_array'];

?>
<form action="create" method="post">
  <h2>Select Plot </h2>
  <div class="float-left">
  <p class="reg-left-text">Plot<font color="#FF0000">*</font></p>
  <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" name="plot_id" id="plot_id" class="reg-login-text-field" />
  </p>
  </div>

  <h2>Transfer From </h2>
  
  <div class="float-left">
      <p class="reg-left-text">Member ID<font color="#FF0000">*</font></p>
      <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" name="member_id" id="member_id" class="reg-login-text-field" />
      </p>
  </div>
  
  <h2>Transfer To</h2>
  
<div class="float-left">
    <p class="reg-left-text">First Name <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" name="firstname" id="first" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Middel Name <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" name="middelname" id="middelname" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Last Name <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" name="lastname" id="lastname" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">S/O-D/O-W/O <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" name="sodowo" id="sodowo" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">CNIC<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" name="cnic" id="cnic" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Address<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" name="address" id="address" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Email Address <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" name="email" id="email" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">City<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" name="city" id="city" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">State<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" name="state" id="state" class="reg-login-text-field" />
    </p>
  </div>

  
  <input name="submit" type="submit" />
  <?php /* echo CHtml::ajaxLink(
                                'Register</a>',
    array('/transferplot/create'),
                                array(  
								 'type' => 'POST',
                                        'complete' => 'function(){ 
                                            
                                             
                                        }',
                   'success'=>'function(data){  
                                             var obj = jQuery.parseJSON(data); 
                                           
        // alert(data);
                                             if(obj.success == 1){
                                         
                                         location.href = "http://localhost/hb/index.php/transferplot/datasource/";
                                      }
          else{
			  									 var obj = jQuery.parseJSON(data);
											
                                                $("#error-div").show();
                                                $("#error-div").html(obj[0]);$("#error-div").append("");
												return false;
                                             }
 
                                        }' 
    ),
                         array("id"=>"login","class" => "register-btn margin-left-144")      
                );*/ ?>
  
 <!-- <a href="#" class="register-btn margin-left-144"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/register-btn.png" alt="nav" title="Register"></a>-->
 <?php // $this->endWidget(); ?>
 
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
      
		
   // $.each(val,function(k,v){
     //     console.log(k+" : "+ v);     
//});
});listItems+="";

$("#plot_id").html(listItems);
          }//,
      //error: function(xhr){
      //alert("failure"+xhr.readyState+this.url)

      //}
    });
}

</script>
 
 </section>
<!-- section 3 --> 
