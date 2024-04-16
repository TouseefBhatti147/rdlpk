

<div class="shadow">

  <h3>Schema List</h3>

</div>
<a href="schema" class="btn-info pull-right" > Add Schema</a>
<?php
 $connection = Yii::app()->db; 
$projects  = "SELECT * from `schema`
left join projects on schema.project_id=projects.id
";
$result_projects = $connection->createCommand($projects)->query();

?>
 <table class="table table-striped table-new table-bordered " style="font-size:12px;">



            	<thead style="background:#666; border-color:#ccc; color:#fff;">
<th>ID</th>
<th>Project Name</th>
<th>Pre-Fix Code</th>
<th>Suffix Code</th>
<th>Group Serial</th>
<th>Action</th>

</thead>
<tbody>
<?php
foreach($result_projects as $row){
	echo '<tr><td>'.$row['id'].'</td><td>'.$row['project_name'].'</td><td>'.$row['scode'].'</td><td>'.$row['scode1'].'</td><td>'.$row['Gserial'].'</td><td><a href="updatesch?id='.$row['id'].'" >Update</a><a href="deletesch?id='.$row['id'].'" >/Delete</a></td></tr>';
	}?>
</tbody>
</table>