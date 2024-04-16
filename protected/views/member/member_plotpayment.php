

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

</style>





<div class="my-content" style="font-size:12px; background:#FFF;">

    	

        <div class="row-fluid my-wrapper">

<div class="shadow">

 <div class="span5 pull-right wc-text">





</div>

  <h3>Plot Payment</h3>

</div>

<!-- shadow -->

<hr noshade="noshade" class="hr-5 float-left">

<?php 

$user_data = Yii::app()->session['member_array'];



$name = Yii::app()->session['member_array']['name'];





 ?>

<div class="span12">

   <div class="span8">

    <h4>Member Info</h4>

    Member ID: <?php echo $user_data['id']; ?></br>

    Member Name: <?php echo $name; ?></br>

    

    <?php

     $connection = Yii::app()->db;

	 $p="select * From plots where id='".$_GET['plot_id']."'";

	 $resp = $connection->createCommand($p)->query();

			

	 foreach($resp as $key2)

	 { echo'

    

    <h4>Plot Info</h4>

    Plot Address:'.$key2['plot_detail_address'].' </br>

    Plot Size:' .$key2['plot_size'].'</br>

	'; }?>

    

</div>

<div class="span4">



</div>

</div>

<div class="span12">



 <h4>Payment Detail</h4>  
<span style="float:right;"><a href="payment_details?id=<?php echo $_GET['plot_id'];?>">Payment Detail</a></span>  

<div class="float-left">

    <p class="reg-right-field-area margin-left-5">

     <table class="table table-striped table-bordered table-hover"><thead>

     		<th style="width:5%;"><b>Id</b></th>

            <th style="width:10%;"><b>Account Head</b></th>

            <th style="width:5%;"><b>Inst No</b></th>

            <th style="width:5%;"><b>Due Amount</b></th>

            <th style="width:5%;"><b>Due Date</b></th>

            <th style="width:5%;"><b>Received Amount</b></th>

            <th style="width:5%;"><b>Recev Date</b></th>

            <th style="width:5%;"><b>Vouch No</b></th>

            <th style="width:5%;"><b>Outstanding Inst</b></th>

            <th style="width:5%;"><b>Surcharge</b></th>

            <th style="width:5%;"><b>Others</b></th>

            <th style="width:5%;"><b>Remarks</b></th>

        </thead>

    <?php	

            $res=array();

            foreach($members as $key){

            echo '<tr><td>'.$key['id'].'</td><td>'.$key['payment_type'].'</td><td>Inst no</td><td>Due Amount</td><td>Due Date</td><td>'.$key['amount'].'</td><td>'.$key['date'].'</td><td>'.$key['detail'].'</td><td>Outstanding inst</td><td>'.$key['surcharge'].'</td><td>'.$key['others'].'</td><td>'.$key['remarks'].'</td></tr>'; 

            }?>

</table> 			

  	

    </p>

    <div class="clearfix"></div>

  </div>

  

 </div>

</div>

  

 <!-- <a href="#" class="register-btn margin-left-144"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/register-btn.png" alt="nav" title="Register"></a>-->



 

































































