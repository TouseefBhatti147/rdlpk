<style>

#plots1{ display:none;}

.head{    float: left;

    width: 177px;}

</style>

<div class="">



<div class="shadow">



  <h3>Open Certificate </h3>



</div>



<!-- shadow -->



<hr noshade="noshade" class="hr-5 ">

<h4> Applicant information :</h4>

<?php

date_default_timezone_set("Asia/Karachi");

$username=Yii::app()->session['user_array']['firstname'].'&nbsp;'.Yii::app()->session['user_array']['middelname'].'&nbsp;'.Yii::app()->session['user_array']['lastname'];

 foreach($plots as $plo){

?>

 <div style=" float:right; background-color:#000; color:#FFF; font-weight:bold; padding:5px; border:1px solid #000; "> <?php echo $plo['scode'].$plo['formno'].$plo['scode1'].$plo['Gserial'].'<br>';?></div><div style="float:right; background:#FFF; border:1px solid #000; color:#000; padding:5px;">Form No.:</div>

 

<h5 style="float:right;"><?php if($plo['paidamount']!=''){?>

	<div class="clearfix"></div>

	<form id="form1" action="<?php echo Yii::app()->baseUrl; ?>/dompdf/www/pdfgenerator.php" target="_blank" method="post">



 <input type="hidden" name="paper" value="legal">

  <input type="hidden" name="orientation" value="landscape">

<textarea style="visibility:hidden;" name="html" id="html">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>PDF Report</title>

<style>

td{ padding:0px;  border:none; }

.table-bordered{ border-right:1px solid #000; border-bottom:1px solid #000;}

body {

background-image: url('<?php //echo Yii::app()->baseUrl; ?>/dompdf/opencertificate.jpg');

background-size: cover;

background-repeat:no-repeat;

	}

html { margin: 0px}

@page { margin: 0px; }

body { margin: 0px; }

</style>

</head>



<table>



<tbody>

<tr>

<td>

<div style="font-family:segoepr; margin:60px 0 0 205px; position:absolute; font-size:12px;"><?php //echo $plo['code'].'-'.$plo['formno'];?></div>

<div style="font-family:segoepr; margin:360px 0 0 120px; position:absolute;"><?php echo $plo['date'];?></div>

<div style="font-family:segoepr; margin:400px 0 0 135px; position:absolute;"><?php echo $plo['scode'].$plo['formno'].$plo['scode1'].$plo['Gserial'];;?></div>

<div style="font-family:segoepr; margin:445px 0 0 110px; position:absolute;"><?php echo $plo['name'];?></div>

<div class="head" style="font-family:segoepr; margin:485px 0 0 110px; position:absolute;"><?php echo $plo['cnic'];?></div>

<div class="head" style="font-family:segoepr; margin:525px 0 0 110px; position:absolute;"><?php echo $plo['project_name'];?></div>

<div class="head" style="font-family:segoepr; margin:565px 0 0 110px; position:absolute;">Residential</div>

<div class="head" style="font-family:segoepr; margin:530px 0 0 110px; position:absolute;"><?php //echo $plo['paidamount'];?></div>

<div style="font-family:segoepr; margin:765px 0 0 40px; position:absolute; font-size:8px;">Printed By: <?php echo $username.' ('.date('d-m-Y h:i:s a', time()).')';?></div>

</td>



<td>

<div style="font-family:segoepr; margin:120px 0 0 835px; position:absolute; font-size:12px;"><?php //echo $plo['code'].'-'.$plo['formno'];?></div>

<div style="font-family:segoepr; margin:377px 0 0 245px; position:absolute;"><?php echo $plo['date'];?></div>

<div style="font-family:segoepr; margin:377px 0 0 763px; position:absolute;"><?php echo $plo['scode'].$plo['formno'].$plo['scode1'].$plo['Gserial'];;?></div>

<div style="font-family:segoepr; margin:415px 0 0 245px; position:absolute;"><?php echo $plo['name'];?></div>

<div style="font-family:segoepr; margin:415px 0 0 685px; position:absolute;"><?php echo $plo['sodowo'];?></div>

<div style="font-family:segoepr; margin:455px 0 0 245px; position:absolute;"><?php echo $plo['cnic'];?></div>

<div style="font-family:segoepr; margin:455px 0 0 640px; position:absolute;"><?php echo $plo['project_name'];?></div>

<div style="font-family:segoepr; margin:493px 0 0 245px; position:absolute;">Residential</div>

<div style="font-family:segoepr; margin:550px 0 0 800px; position:absolute;"><?php //echo $plo['paidamount'];?></div>

<div style="font-family:segoepr; margin:750px 0 0 100px; position:absolute; font-size:8px;">Printed By: <?php echo $username.' ('.date('d-m-Y h:i:s a', time()).')';?></div>

</td>

</tr>

</tbody>

</table>

</html>

</textarea>

<input style="float:left;" type="submit" name="submit" value="Print Certificate" /></form>



<?php }?></h5>



<div class="head">Applicant Name:</div><b><?php echo $plo['name'].'<br>';?></b>

<div class="head">Father/Spouse Name:</div><b><?php echo $plo['sodowo'].'<br>';?></b>

<div class="head">CNIC:</div><b><?php echo $plo['cnic'].'<br>';?></b>

<div class="head">Phone:</div><b><?php echo $plo['phone'].'<br>';?></b>







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

    <?php echo   ' <input readonly="readonly" value="'.$formpayment['amount'].'" name="paidamount" id="paidamount" type="text" />';

	?>

</p>

 </div>

 

 

 <div class="float-left">

    <p class="reg-left-text">Paid As<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <select name="paidas" id="paidas" >

    <?php echo'<option value="'.$plo['paidas'].'">'.$plo['paidas'].'</option>';?>

  

    <option value="cash">Cash</option>

    <option value="cheque">Cheque</option>

    <option value="po">Pay Order</option>

     <option value="online">Online</option>

    </select>

</p>

 </div>

 <div class="float-left">

    <p class="reg-left-text">Reference(PO/DD/Cheque)<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

   <input name="detail" value=" <?php echo $plo['detail'];?>"  type="text" placeholder="Enter detail"  id="detail">

    </p>

  </div>

  <div class="float-left">

      <p class="reg-left-text">Date<font color="#FF0000">*</font></p>

      <p class="reg-right-field-area margin-left-5">

        <input name="date" type="text" placeholder="Enter Date" class="hasDatepicker" id="todatepicker" value="<?php echo $plo['date'] ?>">

      </p>

    </div>

 <div class="float-left">

    <p class="reg-left-text">Remarks<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input value=" <?php echo $plo['remarks'];?>" name="remarks" id="remarks" type="text" />

</p>

 </div>

 <div class="float-left">

 <p class="reg-left-text">Mode<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

     <select name="typer" >

     <option value="<?php echo $plo['ststatus']; ?>"><?php echo $plo['ststatus']; ?></option>

     <option value="Dealer">Dealer</option>

     <option value="Walk-in">Walk-in</option>

     </select>

 </p>

 </div>

 <div class="float-left">

 <p class="reg-left-text">Sub Dealer<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

    <?php

   	$connection = Yii::app()->db;

	$cond='';

	//if($plo['seller_id']!==''){$cond="where mdealer='".$plo['seller_id']."'";}

    $sql_member1= "SELECT * FROM sdealer ";

		$result_members1 = $connection->createCommand($sql_member1)->query();

	$sql_membern= "SELECT * FROM installform where form_id='".$plo['id']."' and type='certificate'";

		$result_membern = $connection->createCommand($sql_membern)->queryRow();

	

   	 $sql_memberss= "SELECT * FROM sdealer where id='".$result_membern['sdid']."'";

		$result_membersss = $connection->createCommand($sql_memberss)->queryRow();

	

	?>

     <select name="sdealer" >

     <option value="<?php echo $result_membersss['id']; ?>"><?php echo $result_membersss['name']; ?></option>

     <?php foreach($result_members1 as $row1){echo '<option value="'.$row1['id'].'">'.$row1['name'].'</option>';} ?>

     </select>

 </p>

 </div>



   <?php }?>

    <?php

	

	

	 echo CHtml::ajaxSubmitButton(

                         'Add Open Certificate',

    array('forms/updatecertificate'),

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

