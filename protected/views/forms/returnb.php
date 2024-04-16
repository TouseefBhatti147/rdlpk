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

  <h3>Returned Booking/Token Money </h3>

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
</div>
<div class="span4">
<div style=" float:right; background-color:#000; color:#FFF; font-weight:bold; padding:5px; border:1px solid #000; "> <?php echo $plo['scode'].$plo['formno'].$plo['scode1'].$plo['Gserial'].'<br>';?></div><div style="float:right; background:#FFF; border:1px solid #000; color:#000; padding:5px;">Form No.:</div>

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
          ?>
  </select>
  </div>
   
      <input value="<?php echo $plo['scode'].$plo['formno'].$plo['scode1'].$plo['Gserial'];?>" readonly="readonly" name="name" id="name" type="hidden" />
   

   <div class="float-left">
    <p class="reg-left-text">Returned Amount<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
    <?php echo   ' <input onBlur="testAmount(this)" value="'.$formpayment['ret_amount'].'" name="paidamount" id="paidamount" type="text" />';
	?>
</p>
 </div>
 <div class="float-left">
    <p class="reg-left-text">Returned As<font color="#FF0000">*</font></p>
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
      <p class="reg-left-text">Returned Date<font color="#FF0000">*</font></p>
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
  
  
 
 
 
  
 
 
 
   <?php }?>
   
 
 

   
    <?php 

	echo CHtml::ajaxSubmitButton(
                         'Returned Booking',
    array('forms/bookingret'),
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
									 array("id"=>"submit","class" => "btn-info pull-right")      ); ?>
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