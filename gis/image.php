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
echo '"<tr><td rowspan="5" style="width: 79px;"><img src="/upload_pic/'.$res3['image'].'" width="70" height="100" /></td></tr>
<tr><td style="width: 200px;"><span style=white-space:nowrap;overflow:hidden; text-overflow: ellipsis;>'.$res3['mname'].'</span></td></tr>
<tr><td style="width: 200px;">'.$res3['title'].'&nbsp;'.$res3['sodowo'].'</td></tr>
<tr><td style="width: 200px;">'.$res3['cnic'].'</td></tr>
<tr><td style="width: 200px;"> <b style=color:red;>'.$res3['plotno'].'</b></td></tr></tbody>
</table>

<table>
<tbody><tr><td>Property Type :</td><td>'.$res3['com_res'].'</td></tr>
<tr><td>Allotment Status :</td><td>'.$res3['pstatus'].'</td></tr>
<tr><td>Status :</td><td>'.$res3['ctag'].'</td></tr>
<tr><td>Plot No :</td><td>' .$res3['plot_detail_address'].'</td></tr>
<tr><td>Street/Lane :</td><td>' .$res3['street'].'</td></tr>
<tr><td>Block/Sector :</td><td>' .$res3['sector_name'].'</td></tr>
<tr><td>Reserver for :</td><td>' .$res3['rname'].'</td></tr>
<tr><td>Name :</td><td>' .$res3['for'].'</td></tr>
<tr><td>Comments :</td><td>' .$res3['rcomm'].'</td></tr>
<tr><td>Type :</td><td>' .$res3['rtype'].'</td></tr>
 <tr><td></td><td><p><a href='.'http://localhost/ams/index.php/memberplot/payment_details?id='.$_REQUEST['id'].'&&pid=>F-Details</a></p></td></tr>"
';

?>
</tbody>
</table>
