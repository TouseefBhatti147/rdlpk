
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> 
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
<link rel="stylesheet" href="//code.jquery.com/ui/1.8.10/themes/smoothness/jquery-ui.css" type="text/css">
<script type="text/javascript" src="//ajax.aspnetcdn.com/ajax/jquery.ui/1.8.10/jquery-ui.min.js"></script>
<?php
$address= $_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl;;
?>

<div style="margin-top:35px;">


    <h3>Paid Percentage Wise Files</h3>
     

<div class="clearfix"></div>
<div class="">
<table class="table table-striped table-new table-bordered">
<thead style="background:#666; border-color:#ccc; color:#fff;">
<tr>
<th rowspan="2" width="5%" style="text-align:center">S.No</th>
<th rowspan="2" width="15%" style="text-align:center">Plot Categories</th>
<th rowspan="2" style="text-align:center">Total</th>
<th colspan="7" style="text-align:center">Booking by Paid %age </th>


</tr>
<tr>
<th style="text-align:center">(100%)</th>
<th style="text-align:center">(91-99%)</th>
<th style="text-align:center">(80-90%)</th>
<th style="text-align:center">(71-79%)</th>
<th style="text-align:center">(61-70%)</th>
<th style="text-align:center">(50-60%)</th>
<th style="text-align:center">(41-49%)</th>
</tr>
</thead>
<tbody>
      <?php
      $connection = Yii::app()->db;
					$count = 0;
					$home = Yii::app()->request->baseUrl;
					$check = 1;
					$res = array();
					$count++;
					//echo $count . ' result found';
					$home = "";
					$home = Yii::app()->request->baseUrl;
					$inc = 0;
					$open = 0;
					$total = 0;
					$totalplots=0;
					$totalequal100 = 0;
					$total91to99 = 0;
					$total80to90 = 0;
					$total71to79=0;
					$total61to70 = 0;
					$total50to60 = 0;
					$total41to49 = 0;
					$total20 = 0;
					$totalless20 = 0;
					$total1001 = 0;
					$total81to901 = 0;
					$total71to801 = 0;
					$total61to701 = 0;
					$total50to601 = 0;
					$total21to491 = 0;
					$total201 = 0;
					$totalless201 = 0;
					$op = 0;
					$com_res = '';
					$block = '';
					$and='';
					$where='';
					$and=true;
				

					if (!empty($_POST['block'])) {
						if ($and == true) {
							$where .= " and block_id LIKE '%" . $_POST['block'] . "%'";
						} else {
							$where .= " and block_id LIKE '%" . $_POST['block'] . "%'";
						}
						$and = true;
					}
					
					 if (!empty($_POST['atype'])) {
						$atype = '';
						if ($_POST['atype'] == "AL") {
							if ($and == true) {
								$where .= " and plots.atype NOT LIKE '%Against Land%'";
							} else {
								$where .= "plots.atype NOT LIKE '%Against Land%'";
							}
						}
						if ($_POST['atype'] == "FOC") {
							if ($and == true) {
								$where .= " and plots.atype NOT LIKE '%FOC%'";
							} else {
								$where .= " plots.atype NOT LIKE '%FOC%'";
							}
						}
						
			
						$and = true;
					}
					//if(empty($_POST['block'])){$block = "1";}else{$block = $_POST['block'];}
				
					$sql_plots  = "SELECT * from size_cat where typee='R'  Order by size_cat.size_sorting";
					$result_plots = $connection->createCommand($sql_plots)->queryAll();
					foreach ($result_plots as $row1) {
	   
						$inc++;
						echo '<tr><td>' . $inc . '</td><td>' . $row1['size'];
						
						echo '</td>';
						
						    $opensql  = "SELECT Count(id) as total  from files_balloting_data
		 where size2='" . $row1['id'] . "' AND com_res='Residential' and project_id='1' and files_balloting_data.type='file'";
				
						$openres = $connection->createCommand($opensql)->query();
						foreach($openres as $total){
							
							$totalplots=$total['total']+$totalplots;
						 }
						echo '<td style="text-align:right">';
					
						if(($total)==0){ echo'';}else{ echo ($total['total']);
						}
						echo'</td>'; 
          //}
						
						$resvsql='';
						$and='';
						$res71to80='';
						
						
					     $sqlequal100  = "SELECT Count(id) as total,paid_perc  FROM `files_balloting_data` 
					   where size2='" . $row1['id'] . "' AND com_res='Residential' and project_id='1' and files_balloting_data.type='file' and (paid_perc>= 100)"; 					
					   $ressqlequal100 = $connection->createCommand($sqlequal100)->query();
						echo '<td style="text-align:right">';
						foreach($ressqlequal100 as $equal100){
							
							$totalequal100=$equal100['total']+$totalequal100;
						 }
						if(($equal100)==0){ echo'';}else{ echo ($equal100['total']);
							
						}
					
						echo'</td>'; 
					
					
          $sql91to99  = "SELECT Count(id) as total,id as tid,paid_perc  FROM `files_balloting_data` 
          where size2='" . $row1['id'] . "' AND com_res='Residential' and project_id='1' and files_balloting_data.type='file' and (paid_perc>90 and paid_perc<100)"; 					
          $ressql91to99 = $connection->createCommand($sql91to99)->query();
         echo '<td style="text-align:right">';
		 foreach($ressql91to99 as $key91to99){
							
			$total91to99=$key91to99['total']+$total91to99;
		 }
		 if(($key91to99)==0){ echo'';}else{ echo ($key91to99['total']);
		 }
         echo'</td>'; 
         $sql80to90  = "SELECT Count(id) as total,paid_perc  FROM `files_balloting_data` 
         where size2='" . $row1['id'] . "' AND com_res='Residential' and project_id='1' and files_balloting_data.type='file' and (paid_perc>79 and paid_perc<90)"; 					
         $res80to90 = $connection->createCommand($sql80to90)->query();
        echo '<td style="text-align:right">';
		foreach($res80to90 as $key80to90){
							
			$total80to90=$key80to90['total']+$total80to90;
		 }
		 if(($key80to90)==0){ echo'';}else{ echo ($key80to90['total']);
		 }
      
        echo'</td>'; 
        $sql71to79  = "SELECT Count(id) as total,paid_perc  FROM `files_balloting_data` 
        where size2='" . $row1['id'] . "' AND com_res='Residential' and project_id='1' and files_balloting_data.type='file' and (paid_perc>70 and paid_perc<80)"; 					
        $ressql71to79 = $connection->createCommand($sql71to79)->query();
       echo '<td style="text-align:right">';
       foreach($ressql71to79 as $key71to79){
							
		$total71to79=$key71to79['total']+$total71to79;
	 }
	 if(($key71to79)==0){ echo'';}else{ echo ($key71to79['total']);
	 }
     
       echo'</td>'; 
       $sql61to70  = "SELECT Count(id) as total,paid_perc  FROM `files_balloting_data` 
        where size2='" . $row1['id'] . "' AND com_res='Residential' and project_id='1' and files_balloting_data.type='file' and (paid_perc>60 and paid_perc<=70)"; 					
        $ressql61to70 = $connection->createCommand($sql61to70)->query();
       echo '<td style="text-align:right">';
       foreach($ressql61to70 as $key61to70){
							
		$total61to70=$key61to70['total']+$total61to70;
	 }
	 if(($key61to70)==0){ echo'';}else{ echo ($key61to70['total']);
	 }
     
       echo'</td>'; 
       $sql50to60  = "SELECT Count(id) as total,paid_perc  FROM `files_balloting_data` 
       where size2='" . $row1['id'] . "' AND com_res='Residential' and project_id='1' and files_balloting_data.type='file' and (paid_perc>=50 and paid_perc<=60)"; 					
       $ressql50to60 = $connection->createCommand($sql50to60)->query();
      echo '<td style="text-align:right">';
      foreach($ressql50to60 as $key50to60){
							
		$total50to60=$key50to60['total']+$total50to60;
	 }
	 if(($key50to60)==0){ echo'';}else{ echo ($key50to60['total']);
	 }
    
      echo'</td>'; 
      $sql41to49  = "SELECT Count(id) as total,paid_perc  FROM `files_balloting_data` 
      where size2='" . $row1['id'] . "' AND com_res='Residential' and project_id='1' and files_balloting_data.type='file' and (paid_perc>41 and paid_perc<50)"; 					
      $ressql41to49 = $connection->createCommand($sql41to49)->query();
     echo '<td style="text-align:right">';
     foreach($ressql41to49 as $key41to49){
							
		$total41to49=$key41to49['total']+$total41to49;
	 }
	 if(($key41to49)==0){ echo'';}else{ echo ($key41to49['total']);
	 }
   
     echo'</td>'; 
            }
						
			
					echo '<tr><td></td><td><strong>Total</strong></td><td style="text-align:right"><strong>'.($totalplots).'</srong></td><td style="text-align:right"><strong>'.($totalequal100).'</srong></td><td style="text-align:right"><strong>'.$total91to99.'</srong></td><td style="text-align:right"><strong>'.$total80to90.'</srong></td><td style="text-align:right"><strong>'.$total71to79.'</srong></td><td style="text-align:right"><strong>'.$total61to70.'</srong></td><td style="text-align:right"><strong>'.$total50to60.'</srong></td><td style="text-align:right"><strong>'.$total41to49.'</srong></td></tr>
					<tr><td colspan="10">';?>
					 

</tbody>
</table>
</div>
    </div>
