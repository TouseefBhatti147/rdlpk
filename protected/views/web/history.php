<div class="form-signin mg-btm">
<div class="shadow">
  <h3>ADD plots</h3>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5 float-left">
<section class="reg-section margin-top-30">
<?php $form=$this->beginWidget('CActiveForm', array(
 'id'=>'plot_register_form',
 'enableAjaxValidation'=>false,
  'enableClientValidation'=>true,
                'method' => 'POST',
                'clientOptions'=>array(
                     'validateOnSubmit'=>true,
                     'validateOnChange'=>true,
                     'validateOnType'=>false,
  ),
)); ?>
<div id="error-div" class="errorMessage" style="display: none;"></div>
	
  <div class="float-left">
    <p class="reg-left-text">Plot ID <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" name="id" id="id" class="reg-login-text-field" />
    </p>
  </div>
   <div class="float-left">
  <p class="reg-left-text">Project ID <font color="#FF0000">*</font></p>
  <select name="project_id" id="project">
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
    <p class="reg-left-text">Plot Detail Address <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" name="plot_detail_address" id="plot_detail_address" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Plot Size<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" name="plot_size" id="plot_size" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Password <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="password" value="" name="password" id="password" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Confirm Password <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="password" value="" name="confirm_password" id="con_password" class="reg-login-text-field" />
    </p>
  </div>
  <div class="checkbox margin-left-144 margin-top-15">
        <label>
          <input type="checkbox"  name="agree" value="1" class="float-left" id="checkbox">I agree to the <a href="#" class="link-1 font-16" title="Licence Agreement">Licence Agreement</a>
        </label>
	</div>
  <?php echo CHtml::ajaxLink(
                                '<button type="submit" class="btn btn-success">Submit</button>',
    array('/plots/create'),
                                array(  
								 'type' => 'POST',
                                        'complete' => 'function(){ 
                                            /* $("#plots_register_form").each(function(){ this.reset();});*/
                                             
                                        }',
                   'success'=>'function(data){  
                                             var obj = jQuery.parseJSON(data); 
                                           
                                             if(obj.success == 1){
                                         alert(obj);
        
        //                                 location.href = "http://localhost/hb/index.php/plots/datasource/";
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
 </div>
 </section>
<!-- section 3 --> 
<script>
 
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
