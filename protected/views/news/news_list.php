

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



<span style="float:right"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/news/news"  class="btn-info button">Add News</a></span>

</div>

  <h3>News List</h3>

</div>
<!-- shadow -->

<hr noshade="noshade" class="hr-5 ">

<?php 

$user_data = Yii::app()->session['user_array'];

 ?>

 







<form action="news_list" method="post"> 

  

<div class="">

    <p class="reg-right-field-area margin-left-5">

     <table class="table-striped table-bordered table span12"><thead>

     	

        	<td style="width:5%;"><b>Id</b></td>

            <td style="width:20%;"><b>Teaser</b></td>

            <td style="width:40%;"><b>Details</b></td>

             <td style="width:10%;"><b>Status</b></td>

             <td style="width:20%;"><b>Create Date</b></td>

            <td style="width:20%;"><b>Action</b></td>

        </thead>

    <?php	

            $res=array();

            foreach($news as $key){

            echo '<tr><td>'.$key['id'].'</td><td>'.$key['teaser'].'</td><td>'.$key['details'].'</td><td>'.$key['status'].'</td><td>'.$key['create_date'].'</td><td><a href="'.Yii::app()->request->baseUrl.'/index.php/news/detail_news?id='.$key['id'].'">Detail</a><a href="'.Yii::app()->request->baseUrl.'/index.php/news/update_news?id='.$key['id'].'">/Edit</a></td></tr>'; 

            }?>

</table> 			

  	

    </p>

    <div class="clearfix"></div>

  </div>

  

 </div>



  