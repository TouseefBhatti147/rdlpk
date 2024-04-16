
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
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<div class="my-content" style="font-size:14px;">
    	
        <div class="row-fluid my-wrapper">
<div class="shadow">
 <div class="span5 pull-right wc-text">


</div>
  <h3>Pubic Notices List</h3>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5 float-left">
<?php 
$user_data = Yii::app()->session['user_array'];
 ?>
 



<form action="" method="post"> 
  
<div class="float-left">
    <p class="reg-right-field-area margin-left-5">
     <table class="table-striped table-bordered table span12"><thead>
     		<td style="width:5%;"><b>Sr.No</b></td>
            <td style="width:10%;"><b>Heading</b></td>
             <td style="width:10%;"><b>Detail</b></td>
              <td style="width:10%;"><b>Image</b></td>
            
        </thead>
            <?php
            $i=0;
            $res=array();
            foreach($splash as $key){
                $i++;
            echo '<tr><td>'.$i.'</td><td>'.$key['heading'].'</td><td>'.$key['details'].'</td>
            <td>
                   
                   <a data-fancybox="gallery" href="'.Yii::app()->request->baseUrl.'/images/splash/'.$key['images'].'" class="pop">
                   <img style="width:100%;" src="'.Yii::app()->request->baseUrl.'/images/splash/'.$key['images'].'" alt="5-A1of2.jpg" draggable="false"></a>
                   
                   </td>
           
            </tr>'; 
            }?>
</table> 			
  	
    </p>
    <div class="clearfix"></div>
  </div>
  
 </div>

  
 <!-- <a href="#" class="register-btn margin-left-144"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/register-btn.png" alt="nav" title="Register"></a>-->

 