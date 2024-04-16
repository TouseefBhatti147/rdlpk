<style>
#plots1{ display:none;}
.abc{ width:170px; float:left}
</style>
<div class="">
<div class="shadow">
  <h3>Returned Payment Details </h3>
</div>
<div class="span12"><hr noshade="noshade" class="hr-5 ">
<div class="span5">

<h4> Applicant information</h4>
<?php
$sp='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
foreach($payments as $plo){
?>
<div style="float:left; background:#FFF; border:1px solid #000; color:#000; padding:5px;">Form No.:</div>
<div style=" float:left; background-color:#000; color:#FFF; font-weight:bold; padding:5px; border:1px solid #000; "> <?php echo $plo['scode'].$plo['formno'].$plo['scode1'].$plo['Gserial'].'<br>';?></div><br /><br />
<div class="abc">Applicant Name:</div><b><?php echo $sp.$plo['name'].'<br>';?></b>
<div class="abc">Father/Spouse Name:</div><b><?php echo $sp.$plo['sodowo'].'<br>';?></b>
<div class="abc">CNIC:</div><b><?php echo $sp.$plo['cnic'].'<br>';?></b>
<div class="abc">Phone:</div><b><?php echo $sp.$plo['phone'].'<br>';?></b>
<h4>Returned Payment information:</h4>
<div class="abc">Returned Date:</div><b><?php echo $sp.$plo['paid_date'].'<br>';?></b>
<div class="abc">Returned Amount:</div><b><?php echo $sp.$plo['paidamount'].'<br>';?></b>
<div class="abc">Returned As:</div><b><?php echo $sp.$plo['paidas'].'<br>';?></b>
<div class="abc">Refrence:</div><b><?php echo $sp.$plo['detail'].'<br>';?></b>
<div class="abc">Remarks:</div><b><?php echo $sp.$plo['remarks'].'<br>';?></b>
</div>
<div class="span6">
<h4>Dealer information:</h4>
<div class="abc">Mode:</div><b><?php echo $sp.$plo['ststatus'].'<br>';?></b>
<div class="abc">Dealer:</div><b><?php echo $sp.$plo['dname'].'<br>';?></b>
<div class="abc">Sub Dealer</div><b><?php echo $sp.$plo['sdname'].'<br>';?></b>
<h4>User information:</h4>
<div class="abc">Name:</div><b><?php echo $sp.$plo['firstname'].'&nbsp;'.$plo['middelname'].'&nbsp;'.$plo['lastname'].'<br>';?></b>

<div class="abc">Cell No.:</div><b><?php echo $sp.$plo['umobile'].'<br>';?></b>

</div>

</div>

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
 <input name="payid" type="hidden" value="<?php echo $_REQUEST['id'] ?>"/>
  <input name="fid" type="hidden" value="<?php echo $plo['form_id'] ?>"/>
  <input name="paytype" type="hidden" value="<?php echo $plo['ftype'] ?>"/>
 <?php	 
 }
 
 ?>
 Approval Status:
<?php 
$sts='';
$sns='';

if($plo['fstatus']==1){$sts='Approved';}
if($plo['fstatus']==2){$sts='On Hold';}
if($plo['fstatus']==3){$sts='Rejected';} ?>
 <select id="status" name="status">
 <?php if($sts==''){echo '<option>Select Status</option>';}else{echo '<option value="1">'.$sts.'</option>';}?> 
 <option value="1">Approved</option>
 <option value="2">On Hold</option>
 <option value="3">Rejected</option>
 </select>
    <?php
	
	
	 echo CHtml::ajaxSubmitButton(
                         'Update',
    array('forms/Payapprove1'),
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
 
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

