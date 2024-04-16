

<div class="shadow">

  <h3>Forms Management</h3>
  
  <div class="span8" ><?php if(Yii::app()->session['user_array']['per13']=='1' or Yii::app()->session['user_array']['per16']=='1')
			{?>
<span class="span2 main-icons" ><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/forms/forms_lis"  ><img src="/rdlpklive/images/charges-icon6.png"><br />Forms List</a></span><?php }?>
<?php if(Yii::app()->session['user_array']['per13']=='1' )
			{?>
<span class="span2 main-icons" ><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/forms/selectpr"  ><img src="/rdlpklive/images/charges-icon4.png"><br />Add New Form</a></span><span class="span2 main-icons"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/forms/schema_lis"  ><img src="/rdlpklive/images/charges-icon5.png"><br />Schema</a></span><span class="span2 main-icons" ><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/forms/formpayment_lis"  ><img src="/rdlpklive/images/charges-icon7.png"><br />Charges Management</a></span><span class="span2 main-icons" ><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/forms/allot"  ><img src="/rdlpklive/images/ch2.png"><br />Distributor forms Allocation </a></span>
<?php }?>



</div>
<div class="clearfix"></div>
<div class="span8" >
<?php if(Yii::app()->session['user_array']['per13']=='1' )
			{?>
<span class="span2 main-icons" ><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/forms/authorize" ><img src="/rdlpklive/images/ch2.png"><br />User form Allocation</a></span>
<span class="span2 main-icons" ><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/seller/seller_lis" ><img src="/rdlpklive/images/ch2.png"><br />Manage Distributor</a></span>
<span class="span2 main-icons"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/forms/finance"  ><img src="/rdlpklive/images/gallery-icon.png"><br />Finance form Allocation</a></span><?php }?>
<?php if(Yii::app()->session['user_array']['per13']=='1' or Yii::app()->session['user_array']['per14']=='1')
			{?>
<span class="span2 main-icons"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/forms/report"  ><img src="/rdlpklive/images/charges-icon1.png"><br />Reporting</a></span>
<?php }?>
<?php if(Yii::app()->session['user_array']['per13']=='1' or Yii::app()->session['user_array']['per15']=='1')
			{?>
<span class="span2 main-icons"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/forms/financedb"  ><img src="/rdlpklive/images/gallery-icon.png"><br />Finance Administration</a></span>
<?php }?>

</div>

</div>
<style>
.btn{
	line-height: 12px;
    margin-bottom: 0;
    padding: 3px 12px;
	}
	.main-icons{ height:120px;}
</style>
<!-- shadow -->

<hr noshade="noshade" class="hr-5">


