
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


<div class="my-content" style="font-size:14px;">
    	
        <div class="row-fluid my-wrapper">
<div class="shadow">
 <div class="span5 pull-right wc-text">


</div>
  <h3>Email Box</h3>
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
     		<td style="width:5%;"><b>Id</b></td>
            <td style="width:10%;"><b>Title</b></td>
             <td style="width:10%;"><b>Message</b></td>
             <td style="width:10%;"><b>Date</b></td>
            <td style="width:5%;"><b>Action</b></td>
                 <td style="width:5%;"><b>Status</b></td>
        </thead>
    <?php	
            $res=array();
            foreach($mailbox as $key){
            echo '<tr><td>'.$key['id'].'</td><td>'.$key['title'].'</td><td>'.$key['message'].'</td><td>'.$key['date'].'</td><td><a href="'.Yii::app()->request->baseUrl.'/index.php/member/register_member_query_detail?id='.$key['id'].'">Detail/<a href="'.Yii::app()->request->baseUrl.'/index.php/member/Remove_mail?id='.$key['id'].'">Delete</a></td><td>';if($key['status']=='1'){ echo 'Read';} else { echo 'Unread';} echo '</td></tr>'; 
            }?>
</table> 			
  	
    </p>
    <div class="clearfix"></div>
  </div>
  
 </div>

  
 <!-- <a href="#" class="register-btn margin-left-144"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/register-btn.png" alt="nav" title="Register"></a>-->

 