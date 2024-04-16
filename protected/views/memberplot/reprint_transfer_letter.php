
<div class="shadow">
  <h3>Reprint Request For Transfer Letter</h3>
</div>
<div style="float:right; height:200px;width:700px;">
<div id="error-div" class="errorMessage" style="display: none; color:#F00;"></div><hr noshade="noshade" class="hr-5 ">
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
<div class="float-left" >
  <p class="reg-left-text">Type<font color="#FF0000">*</font></p>
  <p class="reg-right-field-area margin-left-5">
  <select name="transfer_letter" id="transfer_letter">
    <option value="transfer_letter">Transfer Letter</option>
  </select>
</p>
</div>
<div class="float-left">
  <p class="reg-left-text">Remarks <font color="#FF0000">*</font></p>
  <p class="reg-right-field-area margin-left-5">
    <input type="text" value="" name="remarks" id="remarks" class="reg-login-text-field" />
      <input type="hidden" value="<?php echo $_GET['plot_id'];?>" name="plot_id" id="plot_id" class="reg-login-text-field" />
  </p>
</div>
<div class="float-left">
  <?php echo CHtml::ajaxSubmitButton(                         'Send Request',
    array('reprint_transferletter'),
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

  <?php $this->endWidget(); ?></div>
</section>

</div>
<table class="table table-striped table-new table-bordered" style="width:40%;">
<tbody>
<?php	
$co=1;
$co1=1;
            $res=array();
            foreach($pages as $key){

   ?>

     <?php  echo '
		  <tr><td>Project Name</td><td><strong>'.$key['project_name'].'</strong></td></tr>
		  <tr><td> Plot Membership #:</td><td><strong>'.$key['plotno'].'</strong></td></tr>
		  <tr><td> Plot Size:</td><td><strong>'.$key['size'].'&nbsp;('.$key['plot_size'].')</strong></td></tr>
	
		  <tr><td> Plot No:</td><td><strong>'.$key['plot_detail_address'].'</strong></td></tr><tr><td>Street/Lane:</td><td><strong>'.$key['street'].'</strong></td></tr>
		  <tr><td> Block:</td><td><strong>'.$key['sector_name'].'</strong></td></tr>';
		  if($key['type']=='Plot'){
		  echo'<tr><td> Plot Features:</td><td><strong>';foreach($primeloc as $prime){ 
			  if(empty($prime['title'])){
				   echo'Normal';
				   }else{ echo $prime['title'].',';
			  }} echo'</strong></td></tr>';
		  }		
		?>
<?php }?>
</tbody>
</table>

<!-- section 3 --> 
<!--VALIDATION START-->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
</script>
<!-- VALIDATION END-->