<head>
 
    <!-- This will refresh page in every 5 seconds, change content= x to refresh page after x seconds -->
</head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  
<style>
.td {
	text-align:right;
}
</style>
 

<?php 
	if(empty($_GET['mp_id'])){
		  echo $mp_id;
		  }else{ 
		  $mp_id= $_GET['mp_id'];
		  }
		  if(empty($_GET['plotid'])){
		  echo $plotid;
		  }else{ 
		  $plotid= $_GET['plotid'];
		  }
	 ?>
    <div id="error-div" class="errorMessage" style="display: none; color:#F00;"></div>

<div id="content">
<table  class="table table-striped table-new table-bordered" style="font-size:12px;">
            	<thead style="background:#666; border-color:#ccc; color:#fff;">
                    <tr>
                        <th width="3%">S.No.</th>
						<th width="4%">Username</th>
                       <th width="8%">Comment</th>
                       <th width="5%">Contact Date</th>
                        <th width="5%">Reminder Date</th>
                       <th width="5%">Mode Of Contact</th>
                       </tr>
                </thead>
              <tbody><?php $connection = Yii::app()->db; 
 $sql="SELECT user.firstname,user.middelname,user.lastname,memberplot.plotno,memberplot.id,memberplot.member_id,members.name,members.cnic,recovery_comments.date as rdate,recovery_comments.comments,recovery_comments.user_id,recovery_comments.moc,recovery_comments.next_reminder from recovery_comments  
 left join memberplot on memberplot.id=recovery_comments.mp_id
 left join members on memberplot.member_id=members.id
 left join user on recovery_comments.user_id=user.id
  where recovery_comments.mp_id='".$mp_id."'";
	
	   $result=$connection->createCommand($sql)->query();

				$i=1;
				foreach($result as $key){
					echo'<tr><td>'.$i.'</td>';
					echo'<td>'.$key['firstname'].'&nbsp;'.$key['middelname'].'&nbsp'.$key['lastname'].'</td>';
					echo'<td>'.$key['comments'].'</td>';
					echo'<td>'.$key['rdate'].'</td>';
					echo'<td>'.$key['next_reminder'].'</td>';
					echo'<td>'.$key['moc'].'</td>';
					echo'</tr>';
					$i++;
					}?>
</tbody></table>
</div>


