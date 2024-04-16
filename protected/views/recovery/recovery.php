<div class="shadow">

  <h3>Recovery Management System</h3>

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





<div class="new"><a href="defaulter_list"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/due-installment-icon.png" width="128" height="128"  /><p>Due Installments</p></a></div>

<div class="new"><a href="watch_list"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/watch-list-icon.png" width="128" height="128"  /><p>Watch List</p></a></div>
<div class="new"><a href="followup_list"><div class="alert"><?php echo $follow;  ?></div><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/watch-list-icon.png" width="128" height="128"  /><p>Followup List</p></a></div>

<div class="new"><a href="recovered_payment"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/recovered-payment-icon.png" width="128" height="128"  /><p>Recovered Payment</p></a>
</div>
<div class="new"><a href="mainreport"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/mainreport-icon.png" width="128" height="128"  /><p>Overall Report</p></a>
</div>
<div class="new"><a href="prevmonth_report"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/mainreport-icon.png" width="128" height="128"  /><p>Previous Month</p></a>
</div>
<div class="new">
<a href="plot_pricing"><?php /* echo $allot; echo $transfer; */ ?><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/plot-pricing.png" width="128" height="128" /><p>Plot Pricing</p></a></div>
<div class="new">
<a href="receivable"><?php /* echo $allot; echo $transfer; */ ?><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/receiveable.png" width="128" height="128" /><p>Receivable</p></a></div>
<div class="new"><a href="graphical_view"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/grahpical-view-icon.png" width="128" height="128"  /><p>Graphical Statistical View</p></a>
</div>
<!---<div class="new"><a href="blockprop_lis"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/blocked.png" width="128" height="128"  /><p>Blocked Property</p></a>
</div>--->

<?php 
	if(Yii::app()->session['user_array']['per32']=='1')
			{
?>
<div class="new"><a href="blockprop_lis123"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/blocked.png" width="128" height="128"  /><p>Blocked Property Updated</p></a>
</div>
<?php } ?>




