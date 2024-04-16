<?php 
include "../new.php";
$connection = Yii::app()->db;




$sql3  = "SELECT *,p.id as pid,p.status as pstatus,pr.comm as rcomm
	,pr.name as rname
	,pr.type as rtype
	,m.name as mname
	 FROM plots p 
        left join memberplot mp on(mp.plot_id=p.id)
		left join members m on(mp.member_id=m.id)
	left join projects pro on(p.project_id=pro.id)
	left join sectors sec on(p.sector=sec.id)
	left join streets s on(p.street_id=s.id)
	left join plot_reserved pr on(p.id=pr.plot_id)
	where p.id='".$_REQUEST['id']."' ";
$res3 = $connection->createCommand($sql3)->queryRow();	
	
$sohaib++;
?>

<table>
<tbody>
<?php  
echo '<style>td {
    height: 10px;
    /* border: 1px solid; */
    padding: 1px;
    width: 133px;
    border: none;
}</style>';
if($res3['member_id'] > 0){
echo '<tr><td rowspan="5" style=" width: 79px;"><img src="/upload_pic/'.$res3['image'].'" width="50" height="70" /></td></tr>
<tr><td style="width: 200px;"><span style= "font-size:12px; white-space:nowrap;overflow:hidden; text-overflow: ellipsis;">'.$res3['mname'].'</span></td></tr>
<tr><td style="width: 200px; font-size:12px;">'.$res3['title'].'&nbsp;'.$res3['sodowo'].'</td></tr>
<tr><td style="width: 200px; font-size:12px;">'.$res3['cnic'].'</td></tr>
<tr><td style="width: 200px; font-size:12px;"> <b style=color:red;>'.$res3['plotno'].'</b></td></tr></tbody>
</table>
';}else{
	echo '<table>
<tbody>
<tr><td style="width: 200px; font-size:12px;">Plot No :</td><td style="width: 200px; font-size:12px;">' .$res3['plot_detail_address'].'</td></tr>
<tr><td style="width: 200px; font-size:12px;">Street/Lane :</td><td style="width: 200px; font-size:12px;">' .$res3['street'].'</td></tr>
<tr><td style="width: 200px; font-size:12px;">Block/Sector :</td><td style="width: 200px; font-size:12px;">' .$res3['sector_name'].'</td></tr>
<tr><td style="width: 200px; font-size:12px;">Reserved for :</td><td style="width: 200px; font-size:12px;">' .$res3['rname'].'</td></tr>
</tbody>
</table>
';

	
	}

?>
