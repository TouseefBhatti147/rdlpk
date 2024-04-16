<style>
.row-fluid [class*="span"]{ margin-left:0px; margin:2px;}
.main-icons{ margin:0px; height:118px;}
.main-icons p{ font-size:12px; line-height:1px;}


</style>
<div class="span8">

<div role="tabpanel">

  <!-- Nav tabs -->
 


 
 

<?php if(Yii::app()->session['dealer_array'] )
			{?>
<h5>Property</a></h5>
<hr noshade="noshade" >
<div role="tabpanel" class="tab-pane" id="settings">
<div class="span12">


<div class="span2 main-icons">
<a href="<?php echo Yii::app()->request->baseUrl; ?>/gis/dealers.php?id=1">
<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/street-icon.png" />
<h6>View Map</h6>
</a>
</div>
<div class="span2 main-icons">
<a href="<?php echo $this->createAbsoluteUrl('dealer/allotments_lis')?>">
<img width="50px" src="<?php echo Yii::app()->request->baseUrl; ?>/images/leaders_icon.png" />
<h6>Reservation List</h6>
</a>
</div>
<div class="span2 main-icons">
<a href="<?php echo $this->createAbsoluteUrl('dealer/memberplot')?>">
<img width="50px" src="<?php echo Yii::app()->request->baseUrl; ?>/images/ForSaleIcon.jpg" />
<h6>Reserve New Plot</h6>
</a>
</div>


</div>
</div>
  <?php } ?>
</div>
</div>
</div>



</div>
<hr noshade="noshade" class="hr-5 float-left">

<!-- section 3 -->