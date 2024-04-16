<div class="">



<div class="shadow">



  <h3>Edit File</h3>



</div>



<!-- shadow -->



<hr noshade="noshade" class="hr-5 ">



<section class="reg-section margin-top-30">

<?php $form=$this->beginWidget('CActiveForm', array(
 'id'=>'user_login_form',
 'enableAjaxValidation'=>false,
  'enableClientValidation'=>true,
                'method' => 'POST',

				'clientOptions'=>array(

			    'validateOnSubmit'=>true,

		        'validateOnChange'=>true,

	            'validateOnType'=>false,),

)); ?>
<input value="file" name="type" id="type"  type="hidden" />

  <?php $res=array();

            foreach($files as $plo){

				

     echo '

<div id="error-div" class="errorMessage" style="color:#F00"; style="display: none; "></div>

  <div style="display:none;" class="float-left">

    <p class="reg-left-text">Plot ID <font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" value="'.$plo['id'].'" name="id" id="id" class="reg-login-text-field" />

    </p>

  </div>
   <div class="float-left">
  <p class="reg-left-text">Project<font color="#FF0000">*</font></p>
  <select name="project_id" id="project">
   <option value="'.$plo['project_id'].'">'.$plo['project_name'].'</option>';
            $res=array();

            foreach($projects as $key){

            echo '<option value="'.$key['id'].'">'.$key['project_name'].'</option>'; 
            }?>
  </select>
  </div>
  <div class="float-left">
  <p class="reg-left-text">Sector # <font color="#FF0000">*</font></p>
  <select name="sector" id="sector">
  <option value="<?php echo $plo['sector']?>"><?php echo $plo['sector_name']?></option>

  </select>
  </div>
  <div class="float-left">
  <p class="reg-left-text">Street # <font color="#FF0000">*</font></p>
  <select name="street_id" id="street_id">
<option value="<?php echo $plo['street_id'];?>"><?php echo $plo['street'];?></option>
  <option value="">street</option>
  </select>
  </div>
  <div class="float-left">
    <p class="reg-left-text">File No <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" readonly="readonly"  value="<?php echo $plo['plot_detail_address'];?>" name="plot_detail_address" id="plot_detail_address" class="reg-login-text-field" />
    </p>
  </div> 
  <div class="float-left">
    <p class="reg-left-text">File Diemension<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="<?php echo $plo['plot_size'];?>" name="plot_size" id="plot_size" class="reg-login-text-field" />
    </p>
  </div>
   <div class="float-left">
    <p class="reg-left-text">File Size(Unit)<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
         <select name="size2" id="size2">
        <option value="<?php echo $plo['size2'];?>"><?php echo $plo['size'];?></option>

 			 <?php	

            $res=array();
            foreach($size as $k){
            echo '
			<option value="'.$k['id'].'">'.$k['size'].'</option>'; 

            }?>
  </select>
    </p>
  </div>
   <div class="float-left" >
  <p class="reg-left-text">Type<font color="#FF0000">*</font></p>

  <select name="com_res" id="com_res">
 			<option value="<?php echo $plo['com_res']?>"><?php echo $plo['com_res']?></option>

 			<option value="Commercial">Commercial</option>
            <option value="Residential">Residential</option>
  </select>
 </p>
  </div> 

   <div class="float-left" >
  <p class="reg-left-text">Price<font color="#FF0000">*</font></p>
   <input type="text" value="<?php echo $plo['price']?>" name="price" id="price" class="reg-login-text-field" />
  </div>
<div class="float-left" >
  <p class="reg-left-text">Develop/Undevelop<font color="#FF0000">*</font></p>
  <select name="cstatus" id="cstatus">
				<option value="<?php echo $plo['cstatus']?>"><?php echo $plo['cstatus']?></option>

 			<option value="Developed">Developed</option>
            <option value="Undeveloped">Undeveloped</option>
  </select>

  </div>

   <div class="float-left" >

 <?php }
 ?>  
  
 <?php echo CHtml::ajaxSubmitButton(
					  'Edit File',
					 array('files/update'),
					    array(  
					'beforeSend' => 'function(){ 
			       $("#submit").attr("disabled",true);

            }',
                                        'complete' => 'function(){ 
                                             $("#user_login_form").each(function(){ });

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
						}}' ),
                         array("id"=>"login","class" => "btn-info pull-right")      
                ); ?>
  <?php $this->endWidget(); ?>


 </div>
 </section>
<!--VALIDATION START-->
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
 $(document).ready(function()
     {  	
       $("#project").change(function()
           {
         	select_sector($(this).val());
		   });
     });


function select_sector(id)
{
$.ajax({
      type: "POST",
      url:    "ajaxRequest?val1="+id,
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
}

$(document).ready(function()
     {  	
       $("#sector").change(function()
           {
         	select_street($(this).val());
		   });
     });


function select_street(id)
{
	var pro=$("#project").val();
	var sec=$("#sector").val();
$.ajax({
      type: "POST",
      url:    "ajaxRequest2?pro="+pro+"&&sec="+sec,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var listItems='<option value="">Select Street</option>';
	$(json).each(function(i,val){
	listItems+= "<option value='" + val.id + "'>" + val.street + "</option>";
});listItems+="";
$("#street_id").html(listItems);
          }
    });
}




</script>



