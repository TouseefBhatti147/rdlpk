<?php
include "../new.php";
$connection = Yii::app()->db;
if(isset($_POST['search'])){
$key=$_POST['search'];
$array = array();
$sql  = "SELECT * FROM members where name like '%".$key."%'";
$result = $connection->createCommand($sql)->queryAll();
foreach ($result as $row){
  ?>
   <div class="show" align="left">
<img width="70px" src="../upload_pic/<?php echo $row['image']?>" style="float:left;"/>
<span class="name"><?php echo  $row['cnic']?></span><br/>
<?php echo $row['name']?></br><?php echo  $row['sodowo']?></br><?php echo  $row['email']?></br>
</div>
  <?php 
}
}
if(isset($_POST['search1'])){
$key=$_POST['search1'];
$array = array();
$sql  = "SELECT * FROM members
left join memberplot on(members.id=memberplot.member_id)
 where memberplot.plotno like '%".$key."%'";
$result = $connection->createCommand($sql)->queryAll();
foreach ($result as $row){
  ?>
   <div class="show" align="left">
<img width="70px" src="../upload_pic/<?php echo $row['image']?>" style="float:left;"/>
<span class="name"><?php echo  $row['plotno']?></span><br/>
<?php echo $row['name']?></br><?php echo  $row['sodowo']?></br><?php echo  $row['email']?></br>
</div>
  <?php 
}
}

?>