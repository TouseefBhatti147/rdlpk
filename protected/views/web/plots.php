



<style>







.wc-text .btn-info {



	padding:10px 15px;



	border-radius:5px;



	color:#fff;



	text-decoration:none;



	}



	



.wc-text .btn-info:hover {



	background:#09F;



	}



.box{ background:#CCC; width:800px; min-height:300px;}

.head{ background:#999; color:#FFF;}

.pad{ padding:5px 10px; font-size:14px;}

.info{ text-decoration:underline; font-weight:bold; padding:0 8px; }

.info1{ width:350px; float:left;}

.info2{ width:250px; }

</style>











<div class="my-content" style="font-size:14px;">



    	



        <div class="row-fluid my-wrapper">



<div class="shadow">



 <div class="span5 pull-right wc-text">











</div>



  <h3>Property Verification</h3>







<!-- shadow -->



<hr noshade="noshade" class="hr-5 float-left">



<?php 



$user_data = Yii::app()->session['user_array'];



 ?>



  <?php	



            $res=array();



            foreach($plots as $key){?>







<div class="box" id="printableArea">

<div class="head"><h3 style="color:#FFF; padding:5px;">Membership Details</h3></div>

<div class="pad">

Property Category &nbsp;&nbsp;&nbsp;: <span class="info"><?php echo $key['type'];?></span><br />

Property Type &nbsp;&nbsp;&nbsp;:<span class="info"><?php echo $key['com_res'];?></span>

</div>

<hr />

<div class="pad">

<h4>Property Detail</h4>

<div class="info1"><span class="info2">Project Name:</span> <span class="info"><?php echo $key['project_name'];?></span></div><br />

<div class="info1"><span class="info2">Plot No. :</span> <span class="info"><?php echo $key['plot_detail_address'];?></span></div>

<div class="info1"><span class="info2">Size: </span><span class="info"><?php echo $key['size'];?></span></div><br />

<div class="info1"><span class="info2">Street No. :</span> <span class="info"><?php echo $key['street'];?></span></div>

<div class="info1"><span class="info2">Sector: </span><span class="info"><?php echo $key['sector'];?></span></div><br />

<div class="info1"><span class="info2">Dimension : </span><span class="info"><?php echo $key['plot_size'];?></span></div>




</div>

<hr />

<div class="pad">

<h4>Owner Detail</h4>

<div style="width:120px; height:120px;"><img width="120" height="120" src="<?php echo Yii::app()->request->baseUrl; ?>/upload_pic/<?php echo $key['image'];?>" /></div>

<div class="info1"><span class="info2">Owner's Name : </span><span class="info"><?php echo $key['name'];?></span></div><br />

<div class="info1"><span class="info2">SO/DO/WO :</span> <span class="info"><?php echo $key['sodowo'];?></span></div><br />

<div class="info1"><span class="info2">Membership No. : </span><span class="info"><?php echo $key['plotno'];?></span></div><br />



</div>

</div>





<?php }?>





  







  </div>

<input type="button" onclick="printDiv('printableArea')" value="Print Verification Slip>>>" />

 </div>





<script>

function printDiv(divName) {

     var printContents = document.getElementById(divName).innerHTML;

     var originalContents = document.body.innerHTML;



     document.body.innerHTML = printContents.fontsize(12);



     window.print();



     document.body.innerHTML = originalContents;

}

</script>



 