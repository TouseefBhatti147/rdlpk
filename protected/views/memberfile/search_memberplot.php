
<div class="shadow">
  <h1>Registeration Form</h1>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5 float-left">
<section class="reg-section margin-top-30">
<?php $form=$this->beginWidget('CActiveForm', array(
 'id'=>'memberplot_register_form',
 'enableAjaxValidation'=>false,
  'enableClientValidation'=>true,
                'method' => 'POST',
                'clientOptions'=>array(
                     'validateOnSubmit'=>true,
                     'validateOnChange'=>true,
                     'validateOnType'=>false,
  ),
)); 
$projects_data = Yii::app()->session['projects_array'];
?>

		

  



  <div class="float-left">
  <p class="reg-left-text">Project ID <font color="#FF0000">*</font></p>
  <select id="project">
			<option value="plot">please Select Project </option>
			<?php	
            $res=array();
            foreach($projects as $key){
            echo '<option value="'.$key['id'].'">'.$key['project_name'].'</option>'; 
            }?>
	</select>
  </div>
  <div class="float-left">
  <p class="reg-left-text">Street ID <font color="#FF0000">*</font></p>
  <select id="street_id">
  
 	<option value="plot">please Select Street </option>
 
 
  </select>
  </div>
  <div class="float-left">
  <p class="reg-left-text">Plot ID <font color="#FF0000">*</font></p>
  <table>
  <tr><td>Plot ID</td><td>Plot Address</td><td>Plot Size</td><td>Create Date</td><td>Member ID</td><td>Project</td></tr>
  </table>
  <div name="plot_id" id="plot_id">
  
  </div>
  </div>
  
  <div class="float-left">
    <p class="reg-left-text">Name<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" name="username" id="username" class="reg-login-text-field" />
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
    <p class="reg-left-text">Membership Code<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" name="mem_code" id="mem_code" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Mobile<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" name="mobile" id="mobile" class="reg-login-text-field" />
    </p>
  </div>
  
  
  <div class="checkbox margin-left-144 margin-top-15">
    <input name="agree" type="checkbox" value="1" class="float-left" id="checkbox" />
    <label for="checkbox"></label>
  </div>
  <p class="font-16 float-left margin-top-12 margin-left-5">I agree to the <a href="#" class="link-1 font-16" title="Licence Agreement">Licence Agreement</a></p>
  <?php echo CHtml::ajaxLink(
                                'Register</a>',
    array('/memberplot/create'),
                                array(  
								 'type' => 'POST',
                                        'complete' => 'function(){ 
                                            /* $("#memberplot_register_form").each(function(){ this.reset();});*/
                                             
                                        }',
                   'success'=>'function(data){  
                                             var obj = jQuery.parseJSON(data); 
                                           
        // alert(data);
                                             if(obj.success == 1){
                                         
                                         location.href = "http://localhost/hb/index.php/memberplot/datasource/";
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
                ); ?>
  
 <!-- <a href="#" class="register-btn margin-left-144"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/register-btn.png" alt="nav" title="Register"></a>-->
 <?php $this->endWidget(); ?>
 
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
	
	listItems+= "<table><tr><td>" + val.id +"</td>";
	listItems+= "<td>" + val.plot_detail_address +"</td>";
	listItems+= "<td>" + val.plot_size +"</td>";
	listItems+= "<td>" + val.create_date +"</td></tr></table>";
			
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
