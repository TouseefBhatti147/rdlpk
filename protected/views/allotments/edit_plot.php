
<div class="shadow">
  <h3>Edit Plot</h3>
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
<hr noshade="noshade" class="hr-5">
<section class="login-section margin-top-30" style="height:120px;">

<!--<form name="login-form" method="post" action="">-->
<form action="editplotform" method="post">
<?php foreach($plot as $list1)
			{?>
          
            <input type="hidden" value="<?php echo $_REQUEST['bid']; ?>" name="bid" readonly="readonly" />
            <input type="hidden" value="<?php echo $_REQUEST['pid']; ?>" name="pid" readonly="readonly" />
<div id="error-div" class="errorMessage" style="display: none; color:#F00; font-weight:bold;"></div>
  <div class="float-left">
    <p class="left-text">Project:</p>
    <p class="right-field-area margin-left-5">
    <input type="text" value="<?php echo $list1['project_name']; ?>" readonly="readonly" />
    </p>
  </div>
  <div class="float-left">
    <p class="left-text">Plot Size</p>
    <p class="right-field-area margin-left-5">
     <?php 
	$connection = Yii::app()->db; 	
	$list_sql = "select * FROM size_cat where id='".$list1['size2']."'";
	$result_details = $connection->createCommand($list_sql)->queryRow();
	
	?>
 	<input type="text" value="<?php echo $result_details['size']; ?>" readonly="readonly" />
    </p>
  </div>
  <div class="float-left">
    <p class="left-text">Plot No.</p>
    <p class="right-field-area margin-left-5">
 	<input type="text" value="<?php echo $list1['plot_detail_address']; ?>" readonly="readonly" />
    </p>
  </div>
  
  <div class="float-left">
    <p class="left-text">Status:</p>
    <p class="right-field-area margin-left-5">
      <select name="status" >
      <option value="<?php echo $list1['bstatus']; ?>"><?php echo $list1['bstatus']; ?></option>
      <option value="Open">Open</option>
      <option value="reserved">Reserved</option>
      </select>
    
    </p>
  </div>
  
  
 <input type="submit" name="submit" value="Submit"  class="btn btn-success"/>
 </form>
</section>
<?php }?>
<hr noshade="noshade" class="hr-5">
<div class="">
            
            
            

 			
  	
  </div>
<!-- section 3 --> 
