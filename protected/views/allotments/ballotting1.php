
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

<hr noshade="noshade" class="hr-5">
<a href="newballott" class="btn btn-success"> Create Balloting</a>


<hr noshade="noshade" class="hr-5">
<div class="">          
            <table class="table table-striped table-new table-bordered" style="font-size:12px;">
            	<thead style="background:#666; border-color:#ccc;  color:#fff;">
                    <tr>
                        <th width="3%">ID</th>
                      <th width="7%">Project</th>
                      <th width="4%">Sector</th>            
                      <th width="9%">Description</th> 
                      <th width="4%">Status</th>
                        <th width="6%">Balloting Status</th>
                        <th width="4%">Create Date</th>
                        <th width="4%">Action</th>
                        <th width="8%">Plots Data</th>
                         <th width="8%">Files Data</th>
                         <th width="15%">Manages</th>
                        </tr>
                </thead>
                <tbody>
                <?php
				$count1=0;
		    $connection = Yii::app()->db; 	
			$list_sql = "select sec.sector_name,sec.id as secid,ballotting1.*, p.project_name FROM ballotting1
			Left JOIN projects p ON p.id=ballotting1.project_id
      Left JOIN sectors sec ON sec.id=ballotting1.sector
			";
			$result_details = $connection->createCommand($list_sql)->query();
            $res=array();
            foreach($result_details as $key){
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
</script>   ';
            echo '<tr><td>'.$key['id'].'</td><td>'.$key['project_name'].'</td><td>'.$key['sector_name'].'</td><td>'.$key['desc1'].'</td><td>';
            if($key['status']==1){echo'Active';}else{ echo'In-Active';}
            echo'</td><td>';if($key['balloting_status']==1){echo'In Process/Pending';}elseif($key['balloting_status']==0){ echo'Created/Not Assigned';}elseif($key['balloting_status']==2){ echo'Processed/<a href="view_result?pid='.$key['project_id'].'&sector='.$key['secid'].'&bid='.$key['id'].'">View Result</a>';}echo'</td>
            <td>'.$key['create_date'].'</td>
            <td><a href="edit_ballott?bid='.$key['id'].'">Edit</a>/<a Onclick="return ConfirmDelete();" href="#?bid='.$key['id'].'&pid=">Delete</a></td>
            <td>';if($key['balloting_status']==1){echo'<a href="Plotsballot?pid='.$key['project_id'].'&sector='.$key['secid'].'&bid='.$key['id'].'">Show Ballotable Plots';}
            if($key['balloting_status']==0){echo'<a href="plotsdata?project_id='.$key['project_id'].'&sector='.$key['secid'].'&bid='.$key['id'].'">Generate Data';}
        echo'</td>
			<td><a href="Filesballot?pid='.$key['project_id'].'&sector='.$key['secid'].'&bid='.$key['id'].'">Files Data</a></td>
      <td>';
				if(isset(Yii::app()->session['user_array']['username'] )&& Yii::app()->session['user_array']['per7']=='1')
			{
				echo '<div class="dropdown">
                 <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                  Dropdown
                  <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
			<li role="presentation"><a href="drawballoting?pid='.$key['project_id'].'&sector='.$key['secid'].'&bid='.$key['id'].'">Draw Balloting</a></li>
      <li role="presentation"><a href="rand?pid='.$key['project_id'].'&bid='.$key['id'].'">Result List</a></li>
	
			</ul></div>';	
			}
			echo'</td></tr>'; 
            }?>
                    
                </tbody>
            </table>

 			
  	
  </div>