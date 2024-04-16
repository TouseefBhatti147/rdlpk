
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

<span style="float:right"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/gallery/gallery"  class="btn-info button">Add Gallery</a></span>
</div>
  <h3>Image Galleries List</h3>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5 ">
<?php 
$user_data = Yii::app()->session['user_array'];
 ?>
 



<form action="" method="post"> 
  
<div class="">
    <p class="reg-right-field-area margin-left-5">
     <table class="table-striped table-bordered table span12"><thead>
     		<td style="width:5%;"><b>Id</b></td>
            <td style="width:10%;"><b>Title</b></td>
             <td style="width:10%;"><b>Dscription</b></td>
            <td style="width:5%;"><b>Action</b></td>
        </thead>
    <?php	
            $res=array();
            foreach($gallery as $key){
            echo '<tr><td>'.$key['id'].'</td><td>'.$key['title'].'</td><td>'.$key['description'].'</td><td><a href="'.Yii::app()->request->baseUrl.'/index.php/gallery/view_gallery?id='.$key['id'].'&title='.$key['title'].'">Detail</a><a href="'.Yii::app()->request->baseUrl.'/index.php/gallery/delete_gallery?id='.$key['id'].'&title='.$key['title'].'">/Delete</a></td></tr>'; 
            }?>
</table> 			
  	
    </p>
    <div class="clearfix"></div>
  </div>
  
 </div>

 