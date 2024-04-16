
<div class="">
<div class="shadow">
  <h3>Balloting</h3>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5 ">
<?php require_once('db.php'); 
?>


<form action="Project_wise_list" method="post" name="generate_list">
<table width="200" class="table-striped table-bordered table span12">
  <tr>
   
      <td width="74">Project:</td>
    <td width="110"><label for="project"></label>
      <select name="project" id="project" width="300">
      <?php
    $list_sql = "select * FROM projects";
	$list_query = mysql_query($list_sql);
	while($list = mysql_fetch_array($list_query))
	{
	  echo '<option value="'.$list['id'].'">'.$list['project_name'].'</option>';
	 
	}
      ?>
      </select></td>
  </tr>
<tr>
    
<td><input type="submit" name="button" id="button" value="Submit" /></td>
<td><input type="submit" name="Clear" id="Clear" value="Clear" /></td>
  </tr>
</table>

</form>
