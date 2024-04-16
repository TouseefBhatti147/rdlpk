   <?php 
$servername = "localhost";
$username = "rdlpk_admin";
$password = "creative123admin";
$dbname = "rdlpk_db1";

// Create connection
   $db = include($_SERVER["DOCUMENT_ROOT"] . '/con_db/db.php');
   $conn=mysqli_connect($db['host'],$db['username'],$db['password'],$db['db_name']);

//   $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
	
				$sql = "select * from forms";
				//$result = mysql_query($sql) or die(mysql_error());

				$result = $conn->query($sql);


if(Yii::app()->session['user_array']['per13']=='1' or Yii::app()->session['user_array']['per15']=='1')
			{?>
            <div class="shadow">

  <h3 style="float:left;">Finance Payment Verification</h3> <a style="margin-top:20px; float:right;" href="financedb" class="btn" > Refresh</a>
 
</div>
  <div class="span12" style="    margin: 0;" >
<div class="">
<?php 
$memn=0;$memr=0;$memh=0;$memv=0;$memt=0;
$ocn=0;$ocr=0;$och=0;$ocv=0;$oct=0;
$bkn=0;$bkr=0;$bkh=0;$bkt=0;$bkv=0;
//print_r($payments);exit;
while($row = $result->fetch_assoc()){
	//echo $row['fsfstatus'].'</br>';
	//echo $row['mscharges'].'</br>';
	if($row['fsfstatus']==0 and $row['mscharges']==1){$memn++;}
	if($row['fsfstatus']==1){$memv++;}
	if($row['fsfstatus']==2){$memh++;}
	if($row['fsfstatus']==3){$memr++;}
	
	if($row['ocfstatus']==0 and $row['oc']==1){$ocn++;}
	if($row['ocfstatus']==1){$ocv++;}
	if($row['ocfstatus']==2){$och++;}
	if($row['ocfstatus']==3){$ocr++;}
	
	if($row['tmfstatus']==0 and $row['tm']==1){$bkn++;}
	if($row['tmfstatus']==1){$bkv++;}
	if($row['tmfstatus']==2){$bkh++;}
	if($row['tmfstatus']==3){$bkr++;}
	
	}
	$memt=$memn+$memr+$memh+$memv;
	$oct=$ocn+$ocr+$och+$ocv;
	$bkt=$bkn+$bkr+$bkh+$bkv;
$connection = Yii::app()->db; 
$sql_ret = "SELECT * from rtrn_form";
$result_ret = $connection->createCommand($sql_ret)->queryAll();
$rmemn=0;$rmemr=0;$rmemh=0;$rmemv=0;$rmemt=0;
$rbkn=0;$rbkr=0;$rbkh=0;$rbkt=0;$rbkv=0;
foreach($result_ret as $row){
	if($row['fstatus']=='0' && $row['type']=='membership'){$rbkn++;}
	if($row['fstatus']=='1' && $row['type']=='membership'){$rbkv++;}
	if($row['fstatus']=='2' && $row['type']=='membership'){$rbkh++;}
	if($row['fstatus']=='3' && $row['type']=='membership'){$rbkr++;}
	if($row['type']=='membership'){$rmemt++; $rmemn++;}
	if($row['fstatus']=='0' && $row['type']=='booking'){$rbkn++;}
	if($row['fstatus']=='1' && $row['type']=='booking'){$rbkv++;}
	if($row['fstatus']=='2' && $row['type']=='booking'){$rbkh++;}
	if($row['fstatus']=='3' && $row['type']=='booking'){$rbkr++;}
	if($row['type']=='booking'){$rbkt++;}
	}
?>
<style>
td{ text-align:center !important; height:30px; vertical-align:middle !important}
th{ text-align:center !important; height:30px; vertical-align:middle !important}
</style>
            <table class="table table-striped table-new table-bordered " style="font-size:16px;">
            	<thead style="background:#666; border-color:#ccc; color:#fff;">
                    <tr>
                        <th width="6%"></th>
                        <th colspan="2" width="10%">Membership </th>
                        <th width="5%">Open Certificate </th>
                        <th colspan="2" width="9%">Booking </th>
                       
						
                        </tr>
                </thead>
        <tbody>
        <tr>
         <td style="font-weight:bold; background:#CCC;">Status </td>
        <td style="font-weight:bold; background:#CCC;">Recieved </td>
        <td style="font-weight:bold; background:#CCC;">Returned </td>
        <td style="font-weight:bold; background:#CCC;">Recieved </td>
        <td style="font-weight:bold; background:#CCC;">Recieved </td>
        <td style="font-weight:bold; background:#CCC;">Returned </td>
        
        </tr>
               <tr>
               <td> <img width="50px" src="/images/new.png"><br /><b>New</b></td>
               <td><b style="color:#F00"><?php echo $memn?></b><br /><a  href="finacesc?type=membership">Go to Payments</a></td>
               <td><b style="color:#F00"><?php echo $rmemn?></b><br /><a  href="lispayret?type=membership">Go to Payments</a></td>
               <td><b style="color:#F00"><?php echo $ocn?></b><br /><a href="finacesc?type=certificate">Go to Payments</a></td>
               <td><b style="color:#F00"><?php echo $bkn?></b><br /><a  href="finacesc?type=booking">Go to Payments</a></td>
               <td><b style="color:#F00"><?php echo $rbkn?></b><br /><a  href="lispayret?type=Booking">Go to Payments</a></td>
               </tr>
               <tr>
               <td><img width="50px" src="/images/hold.png"><br /><b>Hold</b></td>
                <td><?php echo $memh?></td>
               <td><?php echo $rmemh?></td>
               <td><?php echo $och?></td>
               <td><?php echo $bkh?></td>
              <td><?php echo $rbkh?></td>
               </tr>
               <tr>
               <td><img width="50px" src="/images/rejct.png"><br /><b>Rejected</b></td>
               <td><?php echo $memr?></td>
               <td><?php echo $rmemr?></td>
               <td><?php echo $ocr?></td>
               <td><?php echo $bkr?></td>
               <td><?php echo $rbkr?></td>
               </tr>
               <td><img width="50px" src="/images/appr.png"><br /><b>Verified</b></td>
                <td><?php echo $memv?></td>
                <td><?php echo $rmemv?></td>
               <td><?php echo $ocv?></td>
               <td><?php echo $bkv?></td>
               <td><?php echo $rbkv?></td>
               </tr>
                <td style="background-color:#0CF;"><b>Total</b></td>
                <td style="background-color:#0CF;"><?php echo $memt?></td>
                 <td style="background-color:#0CF;"><?php echo $rmemt?></td>
               <td style="background-color:#0CF;"><?php echo $oct?></td>
               <td style="background-color:#0CF;"><?php echo $bkt?></td>
              <td style="background-color:#0CF;"><?php echo $rbkt?></td>
               </tr>
               
                </tbody>
            </table>
  </div>

<div class="span3">

</div>





</div>
  
<?php }?>
<style>
.icons{ height:20px;}
</style>