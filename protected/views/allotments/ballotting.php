
<div class="shadow">
  <h3>Balloting</h3>
</div>
<style>

.float-left {
    float: left;
    height: 80px;
    margin: 2px 3px;
    width: 274px;
}
select{ width:255px;}
input, textarea, .uneditable-input {
width: 244px;
}

</style>
<!-- shadow -->
<?php /*?>
<?php
$today = date('Y-m-d');
$months=3;
$next_due_date = strtotime($today.' + '.$months.' Months');
echo date('Y-m-d', $next_due_date);exit;

 ?><?php */?>
<hr noshade="noshade" class="hr-5">
<a href="addballott" class="btn btn-success">Add New Balloting</a>
<div class="">
            
            
            <table class="table table-striped table-new table-bordered" style="font-size:12px;">
            	<thead style="background:#666; border-color:#ccc;  color:#fff;">
                    <tr>
                        <th width="3%">ID</th>
                        <th width="9%">Project</th>
                        
                        <th width="5%">Status</th>
                        <th width="7%">Create Date</th>
                        <th width="5%">Drawn Date</th>
                        <th width="7%">Action</th>
                        
                        <th width="5%">Plots</th>
                        
                         <th width="8%">Applicants</th>
                        
                         <th width="15%">Manages</th>
                        
                        </tr>
                </thead>
                <tbody>
                <?php
				$count1=0;
		    $connection = Yii::app()->db; 	
			$list_sql = "select ballotting.*, p.project_name FROM ballotting
			Left JOIN projects p ON p.id=ballotting.project
			";
			$result_details = $connection->createCommand($list_sql)->query();
            $res=array();
            foreach($result_details as $key){
			$list_sql1 = "select * from plots where size2='".$key['size']."' AND project_id='".$key['project']."' AND bstatus='reserved'";
			$result_details1 = $connection->createCommand($list_sql1)->query();
			foreach($result_details1 as $key1){$count1++;}
			$list_sql2 = "select * from size_cat where id='".$key['size']."' ";
			$result_details2 = $connection->createCommand($list_sql2)->query();
			
			echo'
	<script>
    function ConfirmDelete()
    {
      var x = confirm("Are you sure you want to cancel?");
      if (x)
          return true;
      else
        return false;
    }
</script>    
	
	';
            echo '<tr><td>'.$key['id'].'</td><td>'.$key['project_name'].'</td>';?><?php echo '<td>'.$key['status'].'</td><td>'.$key['createdate'].'</td><td>'.$key['ddate'].'</td><td><a href="edit_ballott?bid='.$key['id'].'">Edit</a>/<a Onclick="return ConfirmDelete();" href="delete_ballott?bid='.$key['id'].'&pid='.$key['project'].'">Delete</a></td><td><a href="plots?pid='.$key['project'].'&size='.$key['size'].'&bid='.$key['id'].'">Plots List</a></td>
			<td><a href="add_members?pid='.$key['project'].'&size='.$key['size'].'&bid='.$key['id'].'">Applicants List</a></td><td>';
				if(isset(Yii::app()->session['user_array']['username'] )&& Yii::app()->session['user_array']['per7']=='1')
			{
				echo '<div class="dropdown">
                 <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                  Dropdown
                  <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
			<li role="presentation"><a href="rand?pid='.$key['project'].'&size='.$key['size'].'&bid='.$key['id'].'">Manage (Open)</a></li>
		<li role="presentation"><a href="reserve?pid='.$key['project'].'&size='.$key['size'].'&bid='.$key['id'].'">Manage (Reserved)</a></li>
		<li role="presentation"><a href="reslist?pid='.$key['project'].'&size='.$key['size'].'&bid='.$key['id'].'&cdate='.$key['createdate'].'&ddate='.$key['ddate'].'">Result List</a></li>
		<li role="presentation"><a href="managelist?pid='.$key['project'].'&size='.$key['size'].'&bid='.$key['id'].'&cdate='.$key['createdate'].'&ddate='.$key['ddate'].'">Manage Result</a></li>
		<li role="presentation"><a href="blockedlist?bid='.$key['id'].'">Blocked List</a></li>
			<li role="presentation"><a href="consheet?bid='.$key['id'].'">Balloting Status</a></li>
			</ul></div>';
				
			
			}
			echo'</td></tr>'; 
            }?>
                    
                </tbody>
            </table>

 			
  	
  </div>
<!-- section 3 --> 
