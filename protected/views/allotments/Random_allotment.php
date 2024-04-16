
<div class="">
<div class="shadow">
  <h3>Balloting Draw</h3>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5 ">

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

<section class="login-section margin-top-30" style="height:120px;">

<!--<form name="login-form" method="post" action="">-->
<form action="Generate" method="post" name="generate_list">
<?php foreach($plot as $list1)
			{$status= $list1['bbstatus'];?>
            <input type="hidden" value="<?php echo $_REQUEST['bid']; ?>" id="bid" name="bid"/>
<div id="error-div" class="errorMessage" style="display: none; color:#F00; font-weight:bold;"></div>
 <input type="hidden" value="<?php echo $list1['project']; ?>" id="project" name="project" readonly="readonly" />

  <div class="float-left">
    <p class="left-text">Project:</p>
    <p class="right-field-area margin-left-5">
    <input type="text" value="<?php echo $list1['project_name']; ?>" id="project1" name="project1" readonly="readonly" />
    </p>
  </div>
  
  <div class="float-left">
    <p class="left-text">Status:</p>
    <p class="right-field-area margin-left-5">
      <input type="text" value="<?php echo $list1['status']; ?>" readonly="readonly" />
    
    </p>
  </div>
  <div class="float-left">
    <p class="left-text">Create Date:</p>
    <p class="right-field-area margin-left-5">
      <input type="text" id="desc" name="desc" value="<?php echo $list1['createdate']; ?>"  readonly="readonly"  />
    </p>
  </div>
 
  <div class="float-left">
    <p class="left-text">Description:</p>
    <p class="right-field-area margin-left-5">
      <input type="text" id="desc" name="desc" value="<?php echo $list1['desc1']; ?>"  readonly="readonly"  />
    </p>
  </div>
  
  <div class="float-left">
    <p class="left-text">Draw Date</p>
    <p class="right-field-area margin-left-5">
      <input type="text" id="desc" name="desc" value="<?php echo $list1['ddate']; ?>"  readonly="readonly"  />
    </p>
  </div>
   <div class="float-left"><p class="left-text">Action</p> <p class="right-field-area margin-left-5">
  <?php if($status=='Open'){
 echo '<input type="submit" name="submit" value="Draw" class="btn btn-success" /></p></div></form>';}
 echo '</form>';
 if($status=='Drawn'){
	   echo'
	   <form action="Refreshdraw" method="post">
	    <input type="hidden" value="'. $_REQUEST['bid'].'" id="bid" name="bid"/>
		 <input type="hidden" value="'. $list1['status'].'" readonly="readonly" />
		  <input type="hidden" value="'. $list1['project'].'" id="project" name="project" readonly="readonly" />
        <input type="hidden" value="'. $list1['size'].'" id="plot_size" name="plot_size" readonly="readonly" />
  	   <button type="submit"  class="btn btn-success" id="login">Refresh Draw</button>
	  	   </form>';
	   }
	   
?>
</section>
<?php }?>
<div class="clearfix"></div>
<hr noshade="noshade" class="hr-5">

           <?php if($status=='Drawn'){?> 
            <table class="table table-striped table-new table-bordered">
            	<thead style="background:#666; border-color:#ccc; color:#fff;">
                    <tr>
                        <th width="4%">S.No.</th>
                        <th width="4%">App. No.</th>
                        <th width="10%">App. Name</th>
                        <th width="8%">CNIC</th>
                        <th width="7%">Plot No.</th>
                        <th width="7%">Allotment</th>
                        <th width="7%">Edit</th>
                        
                        
                        </tr>
                </thead>
                <tbody>
                
		<?php foreach($list as $row8)	
			 {echo '<tr><td>'.$row8['id'].'</td><td>'.$row8['app_no'].'</td><td>'.$row8['member_name'].'</td><td>'.$row8['CNIC'].'</td><td>'.$row8['plot_detail_address'].'</td><td></td><td></td>
			</tr>'; 
            }?>
                    
                </tbody>
            </table>

 			<?php }?>
  	
  </div>
<!-- section 3 --> 





<?php require_once('db.php'); 
if (isset($_GET['plotsize'])){
$plotsize = $_GET['plotsize'];
$sql = "delete from member_plot where plot_size='".$plotsize."'";
mysql_query($sql);
echo "<h4>List of Plot Size ".$plotsize." are Cleared Successfully</h4>";}
?>



