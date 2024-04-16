

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



<span style="float:right"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/country/country"  class="btn-info button">Add Country</a></span><span style="float:right"></span>

<span  style="float:right; margin:0  10px; 0 0"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/country/city"  class="btn-info button">Add City</a></span>





</div>

  <h3>Cities List</h3>

</div>

<!-- shadow -->

<hr noshade="noshade" class="hr-5 ">

<?php 

$user_data = Yii::app()->session['user_array'];

 ?>

 






<form action="" method="post"> 

  

<div class="">

    <p class="reg-right-field-area margin-left-5">

     <table class="table- table-bordered table span12"><thead>

     		<td style="width:5%;"><b>Id</b></td>

            <td style="width:5%;"><b>Country</b></td>

            <td style="width:5%;"><b>City</b></td>

            <td style="width:5%;"><b>Zip Code</b></td>

            <td style="width:5%;"><b>Action</b></td>

            

        </thead>

    <?php	

            $res=array();

            foreach($city as $key){

            echo '<tr><td>'.$key['id'].'</td><td>'.$key['country_id'].'</td><td>'.$key['city'].'</td><td>'.$key['zipcode'].'</td><td><a href="'.Yii::app()->request->baseUrl.'/index.php/country/delete_city?id='.$key['id'].'">Delete</a></td></tr>'; 

            }?>

</table> 			

  	

    </p>

    <div class="clearfix"></div>

  </div>

  

 </div>



 