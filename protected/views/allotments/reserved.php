<div class="">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.js"></script>

<div class="shadow">
  <h3>Allot Plot  (Selections) </h3>
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
.none{ width:200px; height:30px; margin:0px; padding:0px; }
select{ width:255px;}
input, textarea, .uneditable-input {
width: 244px;
}
</style>
<!-- shadow -->

<section class="login-section margin-top-30" style="height:120px;">

<!--<form name="login-form" method="post" action="">-->

<?php foreach($plot as $list1)
			{$status= $list1['status'];?>
            <input type="hidden" value="<?php echo $_REQUEST['bid']; ?>" id="bid" name="bid"/>
<div id="error-div" class="errorMessage" style="display: none; color:#F00; font-weight:bold;"></div>
 <input type="hidden" value="<?php echo $list1['project']; ?>" id="project" name="project" readonly="readonly" />

  <b>Project:</b><?php echo $list1['project_name']; ?><br />
  
 <b>Status:</b><?php echo $list1['status']; ?><br />
<b>Description:</b><?php echo $list1['desc1']; ?><br />
<b>Draw Date:</b> <?php echo $list1['ddate']; ?><br />
  
</section>
<?php }?>
<form action="Reserve?bid=<?php echo $_REQUEST['bid']?>" method="post">
<input type="text" name="plot_no" placeholder="Plot No"/>
<select id="bloock" name="block">
<option value="">Select Sector</option>
<?php 
$connection = Yii::app()->db;  
		$sql_city  = "SELECT * from sectors";
		$result_city = $connection->createCommand($sql_city)->query();
foreach($result_city as $row){
	echo '<option value="'.$row['id'].'">'.$row['sector_name'].'</option>';
	}
?>
</select>
<select id="street" name="street">
</select>
<input type="submit" name="Search" Value="Search" class="btn"/>
</form>
<hr noshade="noshade" class="hr-5">


          
            <table class="table table-striped table-new table-bordered">
            	<thead style="background:#666; border-color:#ccc; color:#fff;">
                    <tr>
                        <th width="4%">Plot no.</th>
                        <th width="4%">Street #</th>
                        <th width="10%">Block</th>
                       
                        <th width="11%">Membership No.</th>
                        <th width="7%">Allotment</th>
                       
                        
                        
                        </tr>
                </thead>
                <tbody>
 <form method="post" action="resdrow?bid=<?php echo $_REQUEST['bid'] ?>">               
		<?php 
		$i=0;
		
		foreach($plots as $row8)	
			 {?>

<div class="" id="#error-div"></div>

<?php echo '<tr><td>
'.$row8['plot_detail_address'].' </td><td> '.$row8['street'].' </td><td> '.$row8['sector_name'].'('.$row8['code'].')</td>';?>
			
			<?php echo '<td>';?>
			<?php
			 echo '<select class="none" name="appno'.$i.'">';
			 echo '<option value="0">Select Member</option>';
			 foreach($app as $row)	
			 {
			 echo '<option value="'.$row['msid'].'">'.$row['plotno'].'</option>';
			 }
			echo '</select>'; 
			?></td><td>
			<input name="plot_id<?php echo $i; ?>" id="plot_id<?php echo $i; ?>" type="text" value="<?php echo $row8['id'];?>"  />
           
            
          
			<?php 
			$i++;
            }?>
            <input name="tno1" id="tno1" type="hidden" value="<?php echo $i;?>"  />
              <button type="submit" class="btn btn-success" id="login">Save</button>
              </form>
              </td></tr>
                </tbody>
            </table>

 		
<script>
$(document).ready(function()
     {  	
	 $("#bloock").change(function()
           {
         	select_street($(this).val());
		   });
		   });
		   function select_street(id)

{
	var sec=$("#bloock").val();
$.ajax({
      type: "POST",
      url:    "ajaxRequest?sec="+sec,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var listItems='';
listItems+= "<option value=''>Select Street</option>";

	$(json).each(function(i,val){

	listItems+= "<option value='" + val.id + "'>" + val.street + "</option>";
});listItems+="";
$("#street").html(listItems);
          }

    });}</script>
  	
  </div>
<!-- section 3 --> 

