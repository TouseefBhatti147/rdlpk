

<style>



.wc-text .btn-info {

	padding:10px 15px;

	border-radius:5px;

	color:#fff;

	text-decoration:none;

	}

	

.wc-text .btn-info:hover {

	background:#09F;

	}



</style>





<div class="my-content" style="font-size:14px;">

    	

        <div class="row-fluid my-wrapper">

<div class="shadow">

 <div class="span5 pull-right wc-text">





</div>

  <h3>Update Contact Info :</h3>
</div>
<hr noshade="noshade" class="hr-5 float-left">

<?php 

$user_data = Yii::app()->session['user_array'];

 ?>

<div class="float-left">

    <p class="reg-right-field-area margin-left-5">
<?php $form=$this->beginWidget('CActiveForm', array(

 'id'=>'plots',

 'enableAjaxValidation'=>false,

  'enableClientValidation'=>true,

                'method' => 'POST',
				'clientOptions'=>array(
			    'validateOnSubmit'=>true,
		        'validateOnChange'=>true,
	            'validateOnType'=>false,),
)); ?>
<div id="error-div" class="errorMessage" style="display: none; color:#F00;"></div>
<?php foreach($update_member as $key){
	
	?>
     <table class="table-striped table-bordered table span6"><tr>
	<tr><td style="width:50%;"><b>Address</b></td><td style="width:5%;"><textarea name="address" class="reg-login-text-field" id="address" style="width:350px;"><?php echo $key['address'];?></textarea></td></tr>

	<tr><td style="width:5%;"><b>Contact #</b></td><td style="width:5%;"><input type="text" value="<?php echo $key['phone'];?>" name="phone" id="phone" style="width:350px;" class="reg-login-text-field" /></td></tr>
<tr><td style="width:5%;"><b>Country</b></td><td style="width:5%;"><select name="country" id="country">
     <option value="<?php echo $key['country_id'];?>"><?php echo $key['country'];?> </option>
      <?php	
            $res=array();
            foreach($country as $key1){
            echo '<option value="'.$key1['id'].'">'.$key1['country'].'</option>'; 
            }?>
    </select></td></tr>
<tr>
  <td style="width:5%;"><b>City</b></td><td style="width:5%;"> <select name="city" id="city_id">
<option value="<?php echo $key['city_id'];?>"><?php echo $key['city'];?> </option>
    </select></td></tr>


	<tr><td style="width:5%;"><!--<input type="submit" class="btn btn-primary" name="change" value="Change Password"><-->
     <?php } echo CHtml::ajaxSubmitButton(

                                'Update',

    array('member/Updateinfo'),

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

 

                                        }' 

    ),

                         array("id"=>"login","class" => "btn-info pull-right")      

                ); ?>

  <?php $this->endWidget(); ?>

 
    
    
    
    </td>

	</tr>

</table> 			

  	

    </p>

    <div class="clearfix"></div>

  </div>

  

 </div>
 <script>
  $(document).ready(function()

     {  	
       $("#country").change(function()
           {
         	select_city($(this).val());
		   });
     });
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

</script> 



  

