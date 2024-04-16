<style>
#plots1{ display:none;}
<style>
input{ margin-bottom:3px !important}
p{ margin:0px !important}
.head{    float: left;
    width: 177px;}
</style>
</style>
<div class="">

<div class="shadow">

  <h3>Open Certificate </h3>

</div>

<!-- shadow -->

<hr noshade="noshade" class="hr-5 ">
<h4> Applicant information</h4>
<?php

 foreach($plots as $plo){
?>
<div class="span7">
 <div class="clearfix"></div>
<div class="head">Applicant Name:</div><b><?php echo $plo['name'].'<br>';?></b>
<div class="head">Father/Spouse Name:</div><b><?php echo $plo['sodowo'].'<br>';?></b>
<div class="head">CNIC:</div><b><?php echo $plo['cnic'].'<br>';?></b>
<div class="head">Phone:</div><b><?php echo $plo['phone'].'<br>';?></b>
</div>
<div class="span4">
 <div style=" float:right; background-color:#000; color:#FFF; font-weight:bold; padding:5px; border:1px solid #000; "> <?php echo $plo['scode'].$plo['formno'].$plo['scode1'].$plo['Gserial'].'<br>';?></div><div style="float:right; background:#FFF; border:1px solid #000; color:#000; padding:5px;">Form No.:</div></div>
 <div class="clearfix"></div>
<?php	 
 }
 ?>
 <hr noshade="noshade" class="hr-5 ">
<section class="reg-section margin-top-30">

  <div id="error-div" class="errorMessage" style="display: none; color:#F00;"></div>
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
  <?php $res=array();
            foreach($plots as $plo){
			$connection = Yii::app()->db;
   
	$cond='';
	//if($plo['seller_id']!==''){$cond="where mdealer='".$plo['seller_id']."'";}
    $sql_member1= "SELECT * FROM sdealer ";
		$result_members1 = $connection->createCommand($sql_member1)->query();
	
     echo '
      <input type="hidden" value="'.$plo['id'].'" name="form_id" id="form_id" class="reg-login-text-field" />
   <div class="float-left">
  <p class="reg-left-text">Project<font color="#FF0000">*</font></p>
  <select name="project_id" disabled="disabled" id="project" >
   <option value="'.$plo['project_id'].'">'.$plo['project_name'].'</option>';
            $res=array();
            foreach($projects as $key){
            echo '
			<option value="'.$key['id'].'">'.$key['project_name'].'</option>'; 
            }?>
  </select>
  </div>
    <div class="float-left">
    <p class="reg-left-text">Form No.<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input value="<?php echo $plo['scode'].$plo['formno'].$plo['scode1'].$plo['Gserial'];?>" readonly="readonly" name="name" id="name" type="text" />
</p>
 </div>
   <div class="float-left">
    <p class="reg-left-text">Paid Amount<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
    <?php echo   ' <input  value="'.$formpayment['amount'].'" name="paidamount" id="paidamount" type="text" />';
	?>
</p>
 </div>
 
 
 <div class="float-left">
    <p class="reg-left-text">Paid As<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <select name="paidas" id="paidas" >
    <option value="">Select Payment Mode</option>
    <option value="cash">Cash</option>
    <option value="checue">Cheque</option>
    <option value="po">Pay Order</option>
     <option value="online">Online</option>
    </select>
</p>
 </div>
 <div class="float-left">
    <p class="reg-left-text">Reference(PO//DD/Cheque)<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
   <input name="detail"  type="text" placeholder="Enter detail"  id="detail">
    </p>
  </div>
  <div class="float-left">
      <p class="reg-left-text">Date<font color="#FF0000">*</font></p>
      <p class="reg-right-field-area margin-left-5">
        <input name="date" type="text" placeholder="Enter Date" class="hasDatepicker" id="todatepicker" value="<?php echo date('d-m-Y')?>"/>
      </p>
    </div>
 <div class="float-left">
    <p class="reg-left-text">Remarks / Certificate Serial # :<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input value="" name="remarks" id="remarks" type="text" />
</p>
 </div>
  <div class="float-left">
 <p class="reg-left-text">Mode<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <select name="typer" >
     <option value="">Select</option>
     <option value="Dealer">Dealer</option>
     <option value="Walk-in">Walk-in</option>
     </select>
 </p>
 </div>
 <div class="float-left">
 <p class="reg-left-text">Sub Dealer<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
    
     <select name="sdealer" >
     <option value="">Select Sub Dealer</option>
     <?php foreach($result_members1 as $row1){echo '<option value="'.$row1['id'].'">'.$row1['name'].'</option>';} ?>
     </select>
 </p>
 </div>

 
 
   <?php 
    $open=$plo['oc'];
   }?>
    <?php

	if($open==0){
	
	 echo CHtml::ajaxSubmitButton(
                         'Add Open Certificate',
    array('forms/addcertificate'),
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
												 alert("Successfully Certificate Opened");
												 	location.reload();
                                      }

														  else{
					
										$("#error-div").show();

                                                $("#error-div").html(data);$("#error-div").append("");

												return false;
                                             }
                                        }' ),
									 array("id"=>"login","class" => "btn-info pull-right")      ); }?>
  <?php $this->endWidget(); ?>
 </div>
 </section>
 
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

