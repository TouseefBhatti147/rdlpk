<style>
.btn-info { font-size:14px;}
</style>

<div class="row-fluid my-wrapper">
  <div class="shadow">
    <h3>
    Downloads
    </h1>
  </div>

<?php
$i=1;
foreach($projects as $row){
	echo '<h4>'.$row['project_name'].'</h4><br>';
	foreach($downloads as $row1){
		if($row['id']==$row1['project_id']){
		
	
	echo '<table class="table-striped table-bordered table" style="font-size:14px;">
	    <thead>
		<th width="10%">S.No.</th>
		<th width="25%">Title</th>
		<th width="25%">Detail</th>
		<th width="25%">Action</th>
		</thead><tbody>';
			
			
			echo '<tr><td>'.$i.'</td>';
			echo '<td>'.$row1['title'].'</td>';
			echo '<td>'.$row1['detail'].'</td>';
		echo '<td><a style="margin-left:10px;  "target="new"  href="'.Yii::app()->request->baseUrl."/images/downloads/".$row1['image'].'" class="btn-info">Download</a></td>';
		$i++;	
		}
		echo '</tbody></table>';
		
	}
	}






?></div>
<hr  />
<hr />
<hr />