<style>
#plots1{ display:none;}
.head{    float: left;
    width: 177px;}
input{ margin-bottom:3px !important}
p{ margin:0px !important}

</style>

 <script src="//code.jquery.com/jquery-1.10.2.js"></script> 
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.js"></script> 
 <script type="text/javascript">  function testAmount(objNpt){
 var n=objNpt.value.replace(/[^\d]+/g,'');// replace all non digits
document.getElementById('rsp').innerHTML=""; 
 objNpt.value=n.replace(/(\d\d\d\d\d)(\d\d\d\d\d\d\d)(\d)/,'$1$2$3');// format the number
}</script>

<div class="shadow">

  <h3>Booking/Token Money Registration</h3>

</div>

<!-- shadow -->

<hr noshade="noshade" class="hr-5 ">
<h4> Applicant information</h4>

<?php
date_default_timezone_set("Asia/Karachi");
$username=Yii::app()->session['user_array']['firstname'].'&nbsp;'.Yii::app()->session['user_array']['middelname'].'&nbsp;'.Yii::app()->session['user_array']['lastname'];
 foreach($plots as $plo){
	 $connection = Yii::app()->db; 
 	$sql_formpayment1  = "SELECT * from installform 
	left join forms on installform.form_id=forms.id
	left join size_cat on forms.size=size_cat.id
	WHERE installform.form_id='".$_REQUEST['id']."' and installform.type='booking'";
	$result_formpayment1 = $connection->createCommand($sql_formpayment1)->queryRow();
 
?>
<div class="span7">
<div class="head">Applicant Name:</div><b><?php echo $plo['name'].'<br>';?></b>
<div class="head">Father/Spouse Name:</div><b><?php echo $plo['sodowo'].'<br>';?></b>
<div class="head">CNIC:</div><b><?php echo $plo['cnic'].'<br>';?></b>
<div class="head">Phone:</div><b><?php echo $plo['phone'].'<br>';?></b>
<?php if($plo['oc']=='1'){echo '<a href="changeapp?id='.$plo['id'].'" class="btn">Change Applicant </a><br>';}?></div>
<div class="span4">
<div style=" float:right; background-color:#000; color:#FFF; font-weight:bold; padding:5px; border:1px solid #000; "> <?php echo $plo['scode'].$plo['formno'].$plo['scode1'].$plo['Gserial'].'<br>';?></div><div style="float:right; background:#FFF; border:1px solid #000; color:#000; padding:5px;">Form No.:</div>
<?php if($plo['tm']=='1'){ ?>
<form id="form1" action="<?php echo Yii::app()->baseUrl; ?>/dompdf/www/pdfgenerator.php" target="_blank" method="post">

 <input type="hidden" name="paper" value="legal">
  <input type="hidden" name="orientation" value="portrat">
<textarea style="visibility:hidden;" name="html" id="html">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PDF Report</title>
<style>
td{ padding:0px;  border:none; }
.table-bordered{ border-right:1px solid #000; border-bottom:1px solid #000;}
body {
background-image: url('<?php echo Yii::app()->baseUrl; ?>/dompdf/rec.jpg');
background-size: cover;
background-repeat:no-repeat;
	}
html { margin: 0px}
@page { margin: 0px; }
body { margin: 0px; }
</style>
</head>




<table>
<thead>
</thead>
<tbody>
<tr>
<td>

<div style="font-family:segoepr; margin:170px 0 0 140px;"><?php echo $result_formpayment1['date'];?></div>
<div style="font-family:segoepr; margin:10px 0 0 250px;"><?php echo $plo['name'];?></div>
<div style="font-family:segoepr; margin:10px 0 0 180px;">Tokken Mony  (<?php echo $result_formpayment1['remarks'];?>)</div>

<div class="head" style="font-family:segoepr; margin:5px 0 0 180px; position:absolute;"><?php echo $plo['scode'].$plo['formno'].$plo['scode1'].$plo['Gserial'].'<br>';?></div>
<div class="head" style="font-family:segoepr; margin:0px 0 0 550px; position:absolute;"><?php echo $plo['size'];?></div>
<div class="head" style="font-family:segoepr; margin:25px 0 0 180px; position:absolute;"><?php echo $result_formpayment1['detail'];?></div>
<div class="head" style="font-family:segoepr; margin:30px 0 0 580px; position:absolute;"><?php echo $result_formpayment1['paidamount'];?></div>

<div class="head" style="font-family:segoepr; margin:60px 0 0 180px; position:absolute;"><?php echo convert_number_to_words($result_formpayment1['paidamount']);?></div>

<div style="font-family:segoepr; margin:130px 0 0 40px; position:absolute; font-size:8px;">Printed By: <?php echo $username.' ('.date('d-m-Y h:i:s a', time()).')';?></div>
</td></tr>
<tr>
<td>

<div style="font-family:segoepr; margin:340px 0 0 140px;"><?php echo $result_formpayment1['date'];?></div>
<div style="font-family:segoepr; margin:10px 0 0 250px;"><?php echo $plo['name'];?></div>
<div style="font-family:segoepr; margin:10px 0 0 180px;">Tokken Mony (<?php echo $result_formpayment1['remarks'];?>)</div>

<div class="head" style="font-family:segoepr; margin:5px 0 0 180px; position:absolute;"><?php echo $plo['scode'].$plo['formno'].$plo['scode1'].$plo['Gserial'].'<br>';?></div>
<div class="head" style="font-family:segoepr; margin:0px 0 0 550px; position:absolute;"><?php echo $plo['size'];?></div>
<div class="head" style="font-family:segoepr; margin:25px 0 0 180px; position:absolute;"><?php echo $result_formpayment1['detail'];?></div>
<div class="head" style="font-family:segoepr; margin:30px 0 0 580px; position:absolute;"><?php echo $result_formpayment1['paidamount'];?></div>

<div class="head" style="font-family:segoepr; margin:60px 0 0 180px; position:absolute;"><?php echo convert_number_to_words($result_formpayment1['paidamount']);?></div>

<div style="font-family:segoepr; margin:130px 0 0 40px; position:absolute; font-size:8px;">Printed By: <?php echo $username.' ('.date('d-m-Y h:i:s a', time()).')';?></div>
</td></tr>
<tr>
<td>

<div style="font-family:segoepr; margin:340px 0 0 140px;"><?php echo $result_formpayment1['date'];?></div>
<div style="font-family:segoepr; margin:10px 0 0 250px;"><?php echo $plo['name'];?></div>
<div style="font-family:segoepr; margin:10px 0 0 180px;">Tokken Mony  (<?php echo $result_formpayment1['remarks'];?>)</div>

<div class="head" style="font-family:segoepr; margin:5px 0 0 180px; position:absolute;"><?php echo $plo['scode'].$plo['formno'].$plo['scode1'].$plo['Gserial'].'<br>';?></div>
<div class="head" style="font-family:segoepr; margin:0px 0 0 550px; position:absolute;"><?php echo $plo['size'];?></div>
<div class="head" style="font-family:segoepr; margin:25px 0 0 180px; position:absolute;"><?php echo $result_formpayment1['detail'];?></div>
<div class="head" style="font-family:segoepr; margin:30px 0 0 580px; position:absolute;"><?php echo $result_formpayment1['paidamount'];?></div>

<div class="head" style="font-family:segoepr; margin:60px 0 0 180px; position:absolute;"><?php echo convert_number_to_words($result_formpayment1['paidamount']);?></div>

<div style="font-family:segoepr; margin:130px 0 0 40px; position:absolute; font-size:8px;">Printed By: <?php echo $username.' ('.date('d-m-Y h:i:s a', time()).')';?></div>
</td></tr>
</tbody>
</table>
  
</html>
</textarea>
<input style="float:right;" type="submit" name="submit" value="Print Receipt" />
</form>
<?php }?>
</div>
	<div class="clearfix"></div>
<?php	 
 }
 ?>
 <hr noshade="noshade" class="hr-5">
 
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


<?php 
		if(isset($_REQUEST['type']) && $_REQUEST['type']!=='' ){
			echo '  <input value="'.$_REQUEST['type'].'" name="ftype" id="ftype" type="hidden" />';
			}
	
	?>	
  <?php $res=array();
            foreach($plots as $plo){
				
     echo '
      <input type="hidden" value="'.$plo['id'].'" name="form_id" id="form_id" class="reg-login-text-field" />';?>
   <div class="float-left">
<p class="reg-left-text">Project<font color="#FF0000">*</font></p>
  <select name="project_id" disabled="disabled" id="project" >
<?php echo '<option value="'.$plo['project_id'].'">'.$plo['project_name'].'</option>';
            $res=array();
            foreach($projects as $key){
            echo '
			<option value="'.$key['id'].'">'.$key['project_name'].'</option>'; 
            }?>
  </select>
  </div>
   
      <input value="<?php echo $plo['scode'].$plo['formno'].$plo['scode1'].$plo['Gserial'];?>" readonly="readonly" name="name" id="name" type="hidden" />
   
 <?php
 $connection = Yii::app()->db; 
 	$sql_formpayment  = "SELECT *,forms.size as isize from installform 
	left join forms on installform.form_id=forms.id
	left join size_cat on forms.size=size_cat.id
	WHERE installform.form_id='".$_REQUEST['id']."' and installform.type='booking'";
	$result_formpayment = $connection->createCommand($sql_formpayment)->queryRow();
 
  if(!empty($result_formpayment)){?>
  <div class="float-left">
    <p class="reg-left-text">Paid Amount<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
    <?php echo   ' <input onBlur="testAmount(this)" value="'.$result_formpayment['paidamount'].'" name="paidamount" id="paidamount" type="text" />';
	?>
</p>
 </div>
 <div class="float-left">
    <p class="reg-left-text">Paid As<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <select name="paidas" id="paidas" >
      <option value="<?php echo $result_formpayment['paidas'] ?>"><?php echo $result_formpayment['paidas'] ?></option>
    <option value="cash">Cash</option>
    <option value="cheque">Cheque</option>
    <option value="po">Pay Order</option>
     <option value="online">Online</option>
    </select>
</p>
 </div>
 <div class="float-left">
    <p class="reg-left-text">ReferenceReference(PO/DO/Cheque)<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
   <input name="detail"  type="text" placeholder="Enter detail"  id="detail" value="<?php echo $result_formpayment['detail'] ?>">
    </p>
  </div>


 <div class="float-left">
      <p class="reg-left-text">Date<font color="#FF0000">*</font></p>
      <p class="reg-right-field-area margin-left-5">
        <input name="date" type="text" placeholder="Enter Date" class="hasDatepicker" id="todatepicker" value="<?php echo $result_formpayment['date'] ?>">
      </p>
    </div>
 <div class="float-left">
    <p class="reg-left-text">Remarks</p>
    <p class="reg-right-field-area margin-left-5">
      <input name="remarks" id="remarks" type="text"  value="<?php echo $result_formpayment['remarks'] ?>"/>
</p>
 </div>
  <div class="float-left">
    <p class="reg-left-text">Plot Size<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <select name="size" id="size">
     <option value="<?php echo $result_formpayment['isize'] ?>"><?php  echo $result_formpayment['size'] ?></option>
   
	 <?php foreach($size as $si){
     echo '<option value="'.$si['id'].'">'.$si['size'].'</option>';
     }?>
     </select>
</p>
 </div>
  <div class="float-left">
    <p class="reg-left-text">Type<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <select name="type" id="type">
      <option value="<?php $result_formpayment['type'] ?>"><?php  echo $result_formpayment['type'] ?></option>
      <option>Residential</option>
 			<option>Commercial</option>
            
  </select>
</p>
 </div>
 <div class="float-left">
 <p class="reg-left-text">Mode<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <select name="typer" >
     <option value="<?php echo $result_formpayment['ststatus']; ?>"><?php echo $result_formpayment['smode']; ?></option>
     <option value="Dealer">Dealer</option>
     <option value="Walk-in">Walk-in</option>
     </select>
 </p>
 </div>
 <div class="float-left">
 <p class="reg-left-text">Sub Dealer</p>
    <p class="reg-right-field-area margin-left-5">
    <?php
    $connection = Yii::app()->db; 
	$cond='';
	//if($plo['seller_id']!==''){$cond="where mdealer='".$plo['seller_id']."'";}
    $sql_member1= "SELECT * FROM sdealer ";
		$result_members1 = $connection->createCommand($sql_member1)->query();
		
	$sql_membern= "SELECT * FROM installform where form_id='".$plo['id']."' and type='booking'";
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

   <div class="float-left">
 <p class="reg-left-text">Confirm Booking<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <select name="confirm" >
     <option value=""><?php echo $plo['tmco'];?></option>
     <option value="Yes">Yes</option>
     <option value="No">No</option>
     </select>
 </p>
 </div>
 <div class="float-left" >
  <p class="reg-left-text">Category<font color="#FF0000">*</font></p>
  <div class="float-left" >
<?php $plotcat=array(); 
?>
<span style="font-weight:bold;"><?php foreach($cat as $row5){ $plotcat[]= $row5['name']; }
?></span> 
  </div>
 <?php 
	$res=array();
	$i = 1;
	foreach($categories as $key1)
	{
	if(in_array($key1['name'],$plotcat)){
	echo'<div class="cat">
    <input id="cat" name="'.$i.'" type="checkbox" value="'.$key1['id'].' " checked/>
	<label for="checkbox">'.$key1['name'].'</label>
	<label><img src="'.Yii::app()->request->baseUrl.'/images/category/'.$key1['sign'].'"></label>
	</div>';
	}else{
	echo'<div class="cat">
    <input id="cat" name="'.$i.'" type="checkbox" value="'.$key1['id'].' " />
	<label for="checkbox">'.$key1['name'].'</label>
	<label><img src="'.Yii::app()->request->baseUrl.'/images/category/'.$key1['sign'].'"></label>

	



	</div>';
		}
	

	$i++;

	}

	?>

 

  </div>
 
 <?php }else{?>
   <div class="float-left">
    <p class="reg-left-text">Paid Amount<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
    <?php echo   ' <input onBlur="testAmount(this)" value="'.$formpayment['amount'].'" name="paidamount" id="paidamount" type="text" />';
	?>
</p>
 </div>
 <div class="float-left">
    <p class="reg-left-text">Paid As<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <select name="paidas" id="paidas" >
    <option value="">Select Payment Mode</option>
    <option value="cash">Cash</option>
    <option value="cheque">Cheque</option>
    <option value="po">Pay Order</option>
     <option value="online">Online</option></select>
</p>
 </div>
 <div class="float-left">
    <p class="reg-left-text">Reference(PO/DO/Cheque)<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
   <input name="detail"  type="text" placeholder="Enter detail"  id="detail">
    </p>
  </div>

 <div class="float-left">
      <p class="reg-left-text">Date<font color="#FF0000">*</font></p>
      <p class="reg-right-field-area margin-left-5">
        <input name="date" type="text" placeholder="Enter Date" class="hasDatepicker" id="fromdatepicker" value="<?php echo date('d-m-Y');?>">
      </p>
    </div>
 <div class="float-left">
    <p class="reg-left-text">Remarks</p>
    <p class="reg-right-field-area margin-left-5">
      <input value="" name="remarks" id="remarks" type="text" />
</p>
 </div>
  <div class="float-left">
    <p class="reg-left-text">Plot Size<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <select name="size" id="size">
     <option value="">Select Plot Size</option>
	 <?php foreach($size as $si){
     echo '<option value="'.$si['id'].'">'.$si['size'].'</option>';
     }?>
     </select>
</p>
 </div>
  <div class="float-left">
    <p class="reg-left-text">Type<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <select name="type" id="type">
      <option>Residential</option>
 			
            
  </select>
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
 <p class="reg-left-text">Sub Dealer</p>
    <p class="reg-right-field-area margin-left-5">
    <?php
    $connection = Yii::app()->db; 
	$cond='';
	//if($plo['seller_id']!==''){$cond="where mdealer='".$plo['seller_id']."'";}
    $sql_member1= "SELECT * FROM sdealer ";
		$result_members1 = $connection->createCommand($sql_member1)->query();
	?>
     <select name="sdealer" >
     <option value=""><Select</option>
     <?php foreach($result_members1 as $row1){echo '<option value="'.$row1['id'].'">'.$row1['name'].'</option>';} ?>
     </select>
 </p>
 </div>
 
  <div class="float-left">
 <p class="reg-left-text">Confirm Booking<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
     <select name="confirm" >
      <option value="No">No</option>
     <option value="Yes">Yes</option>
   
     </select>
 </p>
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
   <?php }?>
   
 
 
<?php  $new1=$plo['tm'];  }?>
   
    <?php 
	if(isset($_REQUEST['type']) or $new1==0){
	echo CHtml::ajaxSubmitButton(
                         'Add Booking',
    array('forms/addbooking'),
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
												 alert("Successfully Booked");
												 	location.reload();
                                         
                                      }

														  else{
					
										$("#error-div").show();

                                                $("#error-div").html(data);$("#error-div").append("");

												return false;
                                             }
                                        }' ),
									 array("id"=>"submit","class" => "btn-info pull-right")      ); }?>
  <?php $this->endWidget(); ?>

 
 </section>
 



 <?php 
$address= $_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl;;
?>
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<script>


function myfunc(){
	if(document.getElementById("selecti").checked== true){
	document.getElementById("plots1").style.display = "block";}else{document.getElementById("plots1").style.display = "none";}
	
	}
	
	
	</script>
    <?PHP 
	function convert_number_to_words($number) {

    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'one',
        2                   => 'two',
        3                   => 'three',
        4                   => 'four',
        5                   => 'five',
        6                   => 'six',
        7                   => 'seven',
        8                   => 'eight',
        9                   => 'nine',
        10                  => 'ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'fourty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
        100                 => 'hundred',
        1000                => 'thousand',
        1000000             => 'million',
        1000000000          => 'billion',
        1000000000000       => 'trillion',
        1000000000000000    => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );

    if (!is_numeric($number)) {
        return false;
    }

    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }

    $string = $fraction = null;

    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }

    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }

    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }

    return $string;
}
	?>