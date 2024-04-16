
<div class="shadow">
   <h3>Summary Sheet</h3>
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
<?php 
$connection = Yii::app()->db;
$list_sql13 = "select * from size_cat";
$result_details13 = $connection->createCommand($list_sql13)->queryAll();



?>
<hr noshade="noshade" class="hr-5">
<table >
<thead style="color:#FFF;">
<th>Size</th>
<th>Total Plot</th>
<th>HRL Reserved</th><th>Total Plot(Balloting)</th>

<th>Total Members</th>
<th>Difference </th>

</thead>
<tbody style="text-align: center;">


<?php 
$connection = Yii::app()->db; 
$a1=0;$a2=0;$a3=0;$a4=0;$a5=0;$a6=0;
// All Membership(Files) With Status Open
$sql_size  = "SELECT * FROM size_cat";
$result_size = $connection->createCommand($sql_size)->queryAll();
foreach($result_size as $size){ 
$sql_ploto  = "SELECT * FROM plots where type='plot'   and project_id='1' and size2='".$size['id']."'";
$result_ploto = $connection->createCommand($sql_ploto)->queryAll();
$sql_plotr  = "SELECT * FROM plots where type='plot' and ctag=''  and project_id='1' and size2='".$size['id']."'";
$result_plotr = $connection->createCommand($sql_plotr)->queryAll();

$sql_memr  = "SELECT memberplot.*,plots.size2 FROM memberplot 
Left join plots on (memberplot.plot_id=plots.id)
where  plots.size2='".$size['id']."' and plots.project_id='1'";
$result_memr = $connection->createCommand($sql_memr)->queryAll();

$sql_memo  = "SELECT memberplot.*,plots.size2 FROM memberplot 
Left join plots on (memberplot.plot_id=plots.id)
where plots.size2='".$size['id']."' and plots.project_id='1'";
$result_memo = $connection->createCommand($sql_memo)->queryAll();
$a1=$a1+count($result_ploto);
$a2=$a2+count($result_plotr);
$a3=$a3+(count($result_ploto)-count($result_plotr));
$a4=$a4+count($result_memr);
$a5=$a5+(count($result_plotr)-count($result_memr));
echo '<tr><td><b>';
echo $size['size'];
echo '</b></td>
<td>'.count($result_ploto).'</td>
<td>'.(count($result_ploto)-count($result_plotr)).'</td><td>'.count($result_plotr).'</td>

<td>'.count($result_memr).'</td>
<td>'.(count($result_plotr)-count($result_memr)).'</td>

</tr>

';
}
echo '
<tr style="background-color:#000; color:#fff;">
<td><b>Total</b></td>
<td><b>'.$a1.'</b></td>
<td><b>'.$a3.'</b></td><td><b>'.$a2.'</b></td>

<td><b>'.$a4.'</b></td>
<td><b>'.$a5.'</b></td>
</tr>

';
?>

</tbody>

</table>