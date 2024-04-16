
<div class="">
<div class="shadow">
  <h3>List</h3>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5 ">
<?php require_once('db.php'); ?>

<?php

$sql="SELECT mp.member_name,mp.plot_id, mp.plot_size,p.project_id
FROM member_plot mp
left join plots p on mp.plot_id=p.id where p.project_id='". $_POST['project']."'";



//$list_sql = "select * from member_plot mp where plot_id='".$plotsize."'";
$list_query = mysql_query($sql);
echo '<table class="table-striped table-bordered table span12">
<thead>
<th>App-Name</th>
<th>CNIC</th>
<th>File No</th>
<th>Size</th>
<th>Project</th>
<th>Status</th>
<th>Action</th>
</thead>

';
while($list = mysql_fetch_array($list_query))
{
	echo "<tr>
	<td width='100'>".$list['member_name']."</td>
	<td>".$list['plot_id']."</td>
	<td>".$list['plot_size']."</td>
	<td>".$list['plot_size']."</td>
	<td>".$list['plot_size']."</td>
	<td>".$list['plot_size']."</td>
	<td>".$list['plot_size']."</td></tr>";
	
}echo "</table>";



 
 ?>
