<div class="">
<div class="shadow">
  <h3>Add Property (Shops/Office)</h3>
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
<?php 
if(isset($_REQUEST['id']) && $_REQUEST['id']!==''){
	echo '<input name="corg" id="corg" type="hidden" value="'.$_REQUEST['id'].'" />';
	}
?>
<input value="Plot" name="type" id="type" type="hidden" />
<div id="error-div" class="errorMessage" style="display: none; color:#F00;"></div>
  <div style="display:none;" class="float-left">
    <p class="reg-left-text">Plot ID <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" name="id" id="id" class="reg-login-text-field" />
    </p>
  </div>
     <div class="float-left" >
 <p class="reg-left-text">Project Name <font color="#FF0000">*</font></p>
  <select name="project_id" id="project_id">
<option value="">Select Project</option>
  			<?php	 
            $res=array();
            foreach($projects as $key){
            echo '<option value="'.$key['id'].'">'.$key['project_name'].'</option>'; 
            }?>
  </select>
  </div>
  <div class="float-left">
  <p class="reg-left-text">Building <font color="#FF0000">*</font></p>
  <select name="building_id" id="building_id">
  <option value="">Select Building</option>
  </select>
  </div>
  <div class="float-left">
  <p class="reg-left-text">Floor Name <font color="#FF0000">*</font></p>
  <select name="floor_id" id="floor_id">
  <option value="">Select Floor</option>
  </select>
  </div>
    <div class="float-left">
    <p class="reg-left-text">Plot Size(Unit)<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
		 <select name="size2" id="size2">
      <option value="">Select Size</option>
 			 <?php	
            $res=array();
            foreach($size as $k){
            echo '
			<option value="'.$k['id'].'">'.$k['size'].'</option>'; 
            }?>
  </select>
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Property No <font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" name="plot_detail_address" id="plot_detail_address" class="reg-login-text-field" />
    </p>
  </div> 
  <div class="float-left">
    <p class="reg-left-text">Plot Diemension<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" name="plot_size" id="plot_size" class="reg-login-text-field" />
      <select style="display:none;" name="plot_id" id="plot_id"></select>
    </p>
  </div>
  

   <div class="float-left" >
  <p class="reg-left-text">Type<font color="#FF0000">*</font></p>
 <p class="reg-right-field-area margin-left-5">
  <select name="type" id="type">
       <option value="">Select Type</option>
 			<option value="Shop">Shop</option>
            <option value="Office">Office</option>
            <option value="Apartment">Apartment</option>
  </select> </p>
  </div>

   <div class="float-left" >
  <p class="reg-left-text">Price<font color="#FF0000">*</font></p>
  <p class="reg-right-field-area margin-left-5">
   <input type="text" value="" name="price" id="price" class="reg-login-text-field" /> </p>
  </div>
 <div class="float-left" >
  <p class="reg-left-text">Category<font color="#FF0000">*</font></p>
<?php /* $res=0;  
 foreach($categories as $key1) {  ?>
<input type="checkbox" name="category<?php echo $res; ?>" value="<?php echo $key1['name']; ?>" />
<label><?php echo $key1['name']; ?></label>
<label><?php echo '<img src="'.Yii::app()->request->baseUrl.'/images/category/'.$key1['sign'].'"> ';?></label>
 <?php $res++;} */?>
 <?php 
	$res=array();
	$i = 1;
	foreach($categories as $key1)
	{
		echo'<div class="cat">
    <input id="cat" name="'.$i.'" type="checkbox" value="'.$key1['id'].'" />
	<label for="checkbox">'.$key1['name'].'</label>
	<label><img src="'.Yii::app()->request->baseUrl.'/images/category/'.$key1['sign'].'"></label>
	</div>';
	$i++;
	}
	?>
  </div>
   
  
  <?php echo CHtml::ajaxSubmitButton(
                         'Add Property',
    array('property/create'),
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



 



    $(document).ready(function()
     {  	
       $("#project_id").change(function()
           {
         	select_building($(this).val());
		   });
		    $("#building_id").change(function()
           {
         	select_floor($(this).val());
		   });
		  
     });

function select_floor(id,building_id)
{
		var building_id=$("#building_id").val();
		var pro=$("#project_id").val();
$.ajax({
      type: "POST",
    //  url:    "AjaxRequest9?val1="+id,
	      url:    "AjaxRequest9?val1="+pro+"&&building_id="+building_id,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var listItems='';
var listItems1='';
	listItems+= "<option value=''>Select Floor</option>";
	$(json).each(function(i,val){
	
	listItems+= "<option value='" + val.id + "'>" + val.name + "</option>";
listItems1+= "<option value='" + val.plot_id + "'>" + val.plot_id + "</option>";
//	alert(listItems1);
});
$("#plot_id").html(listItems1);	
listItems+="";
$("#floor_id").html(listItems);

          }
    });
}
function select_building(id,building_id)
{

$.ajax({
      type: "POST",
	
      url:    "AjaxRequest8?val1="+id,
	  // url:    "ajaxRequest?pro="+pro+"&&sec="+sec,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var listItems='';
var listItems1='';
	listItems+= "<option value=''>Select Building</option>";
	$(json).each(function(i,val){
	
	listItems+= "<option value='" + val.id + "'>" + val.name + "</option>";
///	listItems1+= "<option value='" + val.plot_id + "'>" + val.plot_id + "</option>";
});listItems+="";
$("#building_id").html(listItems);
//$("#plot_id").html(listItems1);

          }
    });
}

 



</script>


