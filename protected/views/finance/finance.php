<div class="shadow">

  <h3>Finance Management System</h3>

</div>

<!-- shadow -->
<hr noshade="noshade" class="hr-5 ">

<style>.alert{  background: none repeat scroll 0 0 #f00;
    border: medium none #000;
    border-radius: 25px;
    color: #fff;
    position: fixed;
    width: 0;
	float: right;
    position: absolute;
	} td{ width:200px;}
    .new {
text-align:center;
    border: 3px solid #eeeeee;
    border-radius: 24px;
    float: left;
    height: 155px;
    margin: 50px;
    padding: 5px;
    width: 146px;
}</style>

<?php if(Yii::app()->session['user_array']['id']==1){?>
<div class="new"><a href="Extra_land"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/money.png" width="128" height="128"  />
<p> Extra Land</p></a></div><?php }?>
<?php if(Yii::app()->session['user_array']['per9']==1){?>
<div class="new"><a href="financial_reports"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/money.png" width="128" height="128"  />
<p> Financial Reports</p></a></div><?php }?>

<div class="new"><a href="installment_lis"><div class="alert"><?php echo $installments;  ?></div><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/p_veri.jpg" width="128" height="128"  /><p>Payment Verifications (installment)</p></a></div>
<div class="new"><a href="unsup_list"><div class="alert"><?php echo $unsup;  ?></div><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/p_veri.jpg" width="128" height="128"  /><p>Unsupervised Receipt</p></a></div>

<div class="new"><a href="payment_lis"><div class="alert"><?php echo $payments;  ?></div><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/p_veri.jpg" width="128" height="128"  /><p>Payment Verifications (Charges)</p></a></div>

<div class="new">
<a href="alotment_lis"><div class="alert"><?php /* echo $transfer;*/ echo $allot;  ?></div><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/trans.jpg"  width="150"  /><p>Allotment Requests</p></a></div>

<div class="new">
<a href="transfer_lis"><div class="alert"><?php /* echo $allot;*/ echo $transfer;  ?></div><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/tr.jpg" width="128" height="128" /><p>Transfer Requests</p></a></div>

<div class="new"><a href="/index.php/reciept/reciept_lis"><div class="alert"><?php /* echo $inst;*/ echo $instr;  ?></div><img src="/images/p_veri.jpg" width="128" height="128"><p>Payments Verifications (Instruments)</p></a></div>
<div class="new">
<a href="prop_alotment_lis"><div class="alert"><?php /* echo $transfer;echo $property; */  ?></div><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/property-icon.png"  width="150"  /><p>Property Allotment Requests</p></a></div>

<div class="new">
<a href="payment_sheet"><?php /* echo $allot; echo $transfer; */ ?><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/payment_sheet.png" width="128" height="128" /><p>Payment Sheet</p></a></div>

<div class="new">
<a href="/index.php/reciept/report"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/payment_sheet.png" width="128" height="128" /><p>Daily Receipts</p></a></div>

<!--<div class="new">
<a href="recajax"><?php /* echo $allot; echo $transfer; */ ?><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/receiveable.png" width="128" height="128" /><p>Receivable AJax</p></a></div>-->

<div class="new"><a href="cancellation_lis"><div class="alert"><?php /* echo $inst;*/ echo $cancelplot;  ?></div><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/cancelled.png" width="128" height="128"><p>Cancelled Request</p></a></div>

