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





<div class="new"><a href="installment_lis"><div class="alert"><?php echo $installments;  ?></div><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/p_veri.jpg" width="128" height="128"  /><p>Payment Verifications (installment)</p></a></div>

<div class="new"><a href="payment_lis"><div class="alert"><?php echo $payments;  ?></div><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/p_veri.jpg" width="128" height="128"  /><p>Payment Verifications (Charges)</p></a></div>

<div class="new">
<a href="alotment_lis"><div class="alert"><?php /* echo $transfer;*/ echo $allot;  ?></div><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/trans.jpg"  width="150"  /><p>Allotment Requests</p></a></div>

<div class="new">
<a href="transfer_lis"><div class="alert"><?php /* echo $allot;*/ echo $transfer;  ?></div><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/tr.jpg" width="128" height="128" /><p>Transfer Requests</p></a></div>


