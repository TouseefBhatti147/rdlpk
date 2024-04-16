

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





<div class="my-content">

    	

        <div class="row-fluid my-wrapper">

<div class="shadow">

 <div class="span5 pull-right wc-text">



<span style="float:right"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/centers/centers"  class="btn-info button">Add New Center</a></span>

</div>

  <h3>Centers List</h3>

</div>
<!-- shadow -->

<hr noshade="noshade" class="hr-5">

<?php

$user_data = Yii::app()->session['user_array'];

 ?>

 







<form action="" method="post"> 

  

<div class="">

    <p class="reg-right-field-area margin-left-5">

     <table class="table-striped table-bordered table span12"><thead>

     	<td style="width:5%;"><b>Id</b></td>

        	<td style="width:10%;"><b>Name</b></td>

            <td style="width:10%;"><b>Image</b></td>

            <td style="width:20%;"><b>Detail</b></td>

          

             <td style="width:5%;"><b>Action</b></td>

        </thead>

    <?php	

            $res=array();

            foreach($centers as $key){

            echo '<tr><td>'.$key['id'].'</td><td>'.$key['name'].'</td><td><img width="150" height="130" src="'.Yii::app()->request->baseUrl.'/images/centers/'.$key['image'].'"></td><td>'.$key['detail'].'</td><td><a href="'.Yii::app()->request->baseUrl.'/index.php/centers/update_center?id='.$key['id'].'">Edit</a><a href="'.Yii::app()->request->baseUrl.'/index.php/centers/delete_center?id='.$key['id'].'">/Delete</a></td></tr>'; 

            }?>

</table> 			

  	

    </p>

    <div class="clearfix"></div>

  </div>

  

 </div>



 

 

 