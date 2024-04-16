 <div class="">
<div class="shadow">
  <h3>Edit Form Allocation</h3>
</div>
 
 <?php
 $connection = Yii::app()->db; 
$projects  = "SELECT disforms.*,seller.name from `disforms`
left join seller on disforms.dis_id=seller.id
where disforms.id='".$_REQUEST['id']."'";
$result_projects = $connection->createCommand($projects)->queryRow();

?>


<form action="disedit" method="post">
<label>Name</label>
<input type="hidden" name="did" value="<?php echo $_REQUEST['id']?>"  readonly/>
<input type="text" name="name" value="<?php echo $result_projects ['name']?>"  readonly/>
<label>From</label>
<input type="text" name="from" value="<?php echo $result_projects ['from']?>" />
<label>To</label>
<input type="text" name="to" value="<?php echo $result_projects ['to']?>" />
<label>Remarks</label>
<input type="text" name="remarks" value="<?php echo $result_projects ['remarks']?>" />
<button type="submit" class="btn" >Submit</button>
</form>