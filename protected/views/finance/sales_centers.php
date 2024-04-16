
<!-- shadow -->
<hr noshade="noshade" class="hr-5 ">

 <style>
  th {background:#666; border-color:#ccc; color:#fff;}
  table{ font-size: 17px;}
  </style>

											
<div>
  <h2>Payments Receipts Status Summary</h2>
 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
                    <script type="text/javascript">google.load('visualization', '1.0', {'packages':['corechart']});</script>

					 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   </head>
  <body>   
   <ul class="nav nav-tabs">
    <li><a  href="financial_reports">Sales Summary</a></li>
    <li class="active"><a  href="sales_centers">Sales Center</a></li>
    <li><a href="daily">Daily</a></li>
    <li><a href="monthly">Monthly</a></li>
     <li><a href="yearly">Yearly</a></li>
  </ul>
 
  <!----Start:Slaes Sumary----->
  <style>
  th {background:#666; border-color:#ccc; color:#fff;}
  </style>
    <div id="salessummary" class="tab-pane fade in active">
      <h3>Sales Centers Summary</h3>
      <p>
      <div class="widget-body">
                <div class="widget-main no-padding">
                    <table class="table table-striped table-new table-bordered">
                        <thead>
                            <tr>
                                <th  colspan="7" class="report_title white bold no-padding">
                                    <span class="bg-black yellow text-center pull-left">&nbsp;&nbsp;Today:  <?php echo date('d-m-Y'); ?>&nbsp;&nbsp;</span>
                                    Amount (PKR  - Millions) Payment Mode Wise
                                </th></tr>
                                <tr>
                                    <th class="text-center bg-grey-3">Sales Center      </th>
                                    <th class="amount-width text-center bold  bg-grey-3">Cash      </th>
                                    <th class="amount-width text-center bold bg-grey-3">Cheque      </th>
                                    <th class="amount-width text-center bold bg-grey-3">PO      </th>
                                    <th class="amount-width text-center bold bg-grey-3">Online</th>
                                    <th class="amount-width text-center bold bg-grey-3">JV</th>
                                     <th class="amount-width text-center bold bg-grey-3">Total</th>
                                  
                                </tr>
                              
                            </thead>
                            <tbody>
                            <?php 
							$tcash=0;
								$tcheque=0;
								$tpo=0;
								$tonline=0;
								$tjv=0;
								$gt=0;
								$total=0;
								$t=0;
								$totalpp=0;
							 foreach($proj as $key){
								
								
								?>
                                <tr>
                                    <td align="left">
                                      <?php echo $key['project_name'];?>
                                    </td>
                                    <?php
									   $connection = Yii::app()->db; 
                                       $sql_test  ="SELECT SUM(total) as cash FROM (
                                            SELECT paidamount AS `total` FROM installpayment 
                                             inner JOIN plots on installpayment.plot_id=plots.id
                                             WHERE  (installpayment.payment_type LIKE 'Cash') and installpayment.paidamount>0 and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce')
                                             and plots.project_id='".$key['id']."'
                                            UNION ALL
                                            SELECT paidamount AS `total` FROM  plotpayment 
                                             inner JOIN plots on plotpayment.plot_id=plots.id
                                                WHERE  (plotpayment.paidas LIKE 'Cash') and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce') and plotpayment.paidamount>0
                                             and plots.project_id='".$key['id']."' 
                                        ) As installpayment";						
													$result_test = $connection->createCommand($sql_test)->query();
									  
									?>
                                    <td class="text-right" style="text-align:right">
                                   <?php 
								   foreach($result_test as $cash){
								   //echo  round($cash['cash']/1000000,2);
								   echo number_format($cash['cash']/1000000,2);
								   $tcash=$tcash+$cash['cash'];
								   }
								   
									$connection = Yii::app()->db; 
                                      $sql_cheque ="SELECT SUM(total) as cheque FROM (
                                            SELECT paidamount AS `total` FROM installpayment 
                                             inner JOIN plots on installpayment.plot_id=plots.id
                                             WHERE  (installpayment.payment_type LIKE 'cheque')and installpayment.paidamount>0 and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce')
                                             and plots.project_id='".$key['id']."'
                                            UNION ALL
                                            SELECT paidamount AS `total` FROM  plotpayment 
                                             inner JOIN plots on plotpayment.plot_id=plots.id
                                                WHERE  (plotpayment.paidas LIKE 'cheque')and plotpayment.paidamount>0 and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce')
                                             and plots.project_id='".$key['id']."') As installpayment";
										$result_cheque = $connection->createCommand($sql_cheque)->query();
										///$cheque=count ($result_cheque);
									?>                                                      </td>
                                    <td class="text-right" style="text-align:right">
                                      <?php
									    foreach($result_cheque as $cheque){
									   echo  number_format($cheque['cheque']/1000000,2);
									   $tcheque=$tcheque+$cheque['cheque'];
										}
									  $connection = Yii::app()->db; 
                                      $sql_po ="SELECT SUM(total) as po FROM (
                                            SELECT paidamount AS `total` FROM installpayment 
                                             inner JOIN plots on installpayment.plot_id=plots.id
                                             WHERE  (installpayment.payment_type LIKE'Pay Order' || installpayment.payment_type LIKE'PO') and installpayment.paidamount>0 and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce')
                                             and plots.project_id='".$key['id']."'
                                            UNION ALL
                                            SELECT paidamount AS `total` FROM  plotpayment 
                                             inner JOIN plots on plotpayment.plot_id=plots.id
                                                WHERE  (plotpayment.paidas LIKE'po' || plotpayment.paidas LIKE'Pay Order') and plotpayment.paidamount>0 and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce')
                                             and plots.project_id='".$key['id']."'
                                        ) As installpayment";
										$result_po = $connection->createCommand($sql_po)->query();
										
									
									  
									   ?>                                                         </td>
                                    <td class="text-right" style="text-align:right">
                                  <?php
								  foreach($result_po as $po){
								   echo  number_format($po['po']/1000000,2);
								  $tpo=$tpo+$po['po'];
								  
								  }
									
									  //echo $cheque;
									  $connection = Yii::app()->db; 
                                      $sql_online ="SELECT SUM(total) as online FROM (
                                            SELECT paidamount AS `total` FROM installpayment 
                                             inner JOIN plots on installpayment.plot_id=plots.id
                                             WHERE  (installpayment.payment_type LIKE'online') and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce')
                                             and plots.project_id='".$key['id']."'
                                            UNION ALL
                                            SELECT paidamount AS `total` FROM  plotpayment 
                                             inner JOIN plots on plotpayment.plot_id=plots.id
                                                WHERE  (plotpayment.paidas LIKE'online') and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce')
                                             and plots.project_id='".$key['id']."' 
                                        ) As installpayment";
										$result_online = $connection->createCommand($sql_online)->query();
										///$online=count ($result_online);
									  
									   ?>                   <td class="text-right" style="text-align:right"><?php 
									     foreach($result_online as $online){
									   echo  number_format($online['online']/1000000,2);
									   $tonline=$tonline+$online['online'];
									   
										 }
									 
									   ?></td>
									       <td class="text-right" style="text-align:right">
                                  <?php
								 
								
									  $connection = Yii::app()->db; 
                                       $sql_jv ="SELECT SUM(total) as jv FROM (
                                            SELECT paidamount AS `total` FROM installpayment 
                                             inner JOIN plots on installpayment.plot_id=plots.id
                                             WHERE  (installpayment.payment_type LIKE 'jv') and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce')
                                             and plots.project_id='".$key['id']."'
                                            UNION ALL
                                            SELECT paidamount AS `total` FROM  plotpayment 
                                             inner JOIN plots on plotpayment.plot_id=plots.id
                                                WHERE  (plotpayment.paidas LIKE 'jv') and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce')
                                             and plots.project_id='".$key['id']."' 
                                        ) As installpayment";
										$result_jv = $connection->createCommand($sql_jv)->query();
									     foreach($result_jv as $jv){
									   //echo $online['online']/1000000;
									    echo  number_format( ($jv['jv'])/1000000,2);
									   $tjv=$tjv+$jv['jv'];
									   
										 }
									 
									   ?></td>
                                   <td style="text-align:right">
                                <?php 
													$sql_d  ="SELECT
                                                                SUM(CASE When installpayment.payment_type LIKE'Cash' Then  installpayment.paidamount Else 0 End ) as cash1,
                                                                SUM(CASE When installpayment.payment_type LIKE'Online' Then  installpayment.paidamount Else 0 End ) as online1,
                                                                SUM(CASE When installpayment.payment_type LIKE'Pay Order' || installpayment.payment_type LIKE 'PO' Then  installpayment.paidamount Else 0 End ) as po1,
                                                                SUM(CASE When installpayment.payment_type LIKE'Cheque' Then  installpayment.paidamount Else 0 End ) as cheque1,
                                                                SUM(CASE When installpayment.payment_type LIKE'JV' Then  installpayment.paidamount Else 0 End ) as jv1
                                                                from installpayment
                                                                LEFT JOIN plots on installpayment.plot_id=plots.id
                                                                where plots.project_id='".$key['id']."'and 
                                                                installpayment.fstatus !='Cancelled' and (installpayment.fstatus !='Bounce')";  
															$result_d = $connection->createCommand($sql_d)->query();
													foreach($result_d as $tt)
													{
													  $tcash1 = ($tt['cash1']+$tt['online1']+$tt['cheque1']+$tt['po1']+$tt['jv1'])/1000000;
													  $total=($total+($tt['cash1']+$tt['online1']+$tt['cheque1']+$tt['po1']+$tt['jv1']));
												//	echo  round($tcash1,2);	
													}
													$sql_p  ="SELECT
                                                                SUM(CASE When plotpayment.paidas LIKE 'Cash' Then  plotpayment.paidamount Else 0 End ) as cash2,
                                                                SUM(CASE When plotpayment.paidas LIKE 'Online' Then  plotpayment.paidamount Else 0 End ) as online2,
                                                                SUM(CASE When plotpayment.paidas LIKE 'Pay Order' || plotpayment.paidas LIKE'PO' Then  plotpayment.paidamount Else 0 End ) as po2,
                                                                SUM(CASE When plotpayment.paidas LIKE 'Cheque' Then  plotpayment.paidamount Else 0 End ) as cheque2,
                                                                SUM(CASE When plotpayment.paidas LIKE 'JV' Then  plotpayment.paidamount Else 0 End ) as jv2
                                                                from plotpayment
                                                                LEFT JOIN plots on plotpayment.plot_id=plots.id
                                                                where plots.project_id='".$key['id']."' && plotpayment.fstatus !='Cancelled' and (plotpayment.fstatus !='Bounce')";  
															$result_p = $connection->createCommand($sql_p)->query();
													foreach($result_p as $pp)
													{
													  $tcash2 = ($pp['cash2']+$pp['online2']+$pp['cheque2']+$pp['po2']+$pp['jv2'])/1000000;
													  $totalpp=($totalpp+($pp['cash2']+$pp['online2']+$pp['cheque2']+$pp['po2']+$pp['jv2']));
												//	echo  round($tcash2,2);	
													}
													
                                                      echo  number_format(($tcash1+$tcash2),2);
														 $gt=$t+$gt;
														$gt=($total+$totalpp)/1000000;
														 ?>
                                   </td>
                                   </tr>
                                <?php 
							
								}?> 	
                           <tr style="background-color: #84e2e2;"><td><strong>Total</strong></td><td style="text-align:right"><strong><?php echo  number_format($tcash/1000000,2);?></strong></td><td style="text-align:right"><strong><?php echo  number_format($tcheque/1000000,2);?></strong></td><td style="text-align:right"><strong><?php echo  number_format($tpo/1000000,2);?></strong></td>
                           <td style="text-align:right"><strong><?php echo  number_format($tonline/1000000,2);?></strong></td>
                           <td style="text-align:right"><strong><?php echo  number_format($tjv/1000000,2);?></strong></td>
                           <td style="text-align:right"><strong><?php echo number_format($gt,2);?></strong></td>
                           </tr>
                           <tr><td colspan="7" >
                   <table width="100%">
				
                    <tr><td>
                  
                     <script type="text/javascript">
					 google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
 var data = google.visualization.arrayToDataTable([
   ['Year', 'Cash', 'Cheque', 'PO','Online','JV'],
        <?php  
		 foreach($proj as $key1){?>  
		
          ['<?php echo $key1['project_name'];?>', 
		  <?php
		   $sql_cash="SELECT SUM(total) as cash FROM (
                                            SELECT paidamount AS `total` FROM installpayment 
                                             inner JOIN plots on installpayment.plot_id=plots.id
                                             WHERE  (installpayment.payment_type LIKE 'Cash') and installpayment.paidamount>0 and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce')
                                             and plots.project_id='".$key1['id']."'
                                            UNION ALL
                                            SELECT paidamount AS `total` FROM  plotpayment 
                                             inner JOIN plots on plotpayment.plot_id=plots.id
                                                WHERE  (plotpayment.paidas LIKE 'Cash') and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce') and plotpayment.paidamount>0
                                             and plots.project_id='".$key1['id']."' 
                                        ) As installpayment";       
										$rescash = $connection->createCommand($sql_cash)->queryAll();
												foreach($rescash as $csh)
												 {
                                                         echo ($csh['cash']);
														
												 }
		  ?>, 
		  <?php
		  $sql_cheque="SELECT SUM(total) as cheque FROM (
                                            SELECT paidamount AS `total` FROM installpayment 
                                             inner JOIN plots on installpayment.plot_id=plots.id
                                             WHERE  (installpayment.payment_type LIKE 'cheque')and installpayment.paidamount>0 and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce')
                                             and plots.project_id='".$key1['id']."'
                                            UNION ALL
                                            SELECT paidamount AS `total` FROM  plotpayment 
                                             inner JOIN plots on plotpayment.plot_id=plots.id
                                                WHERE  (plotpayment.paidas LIKE 'cheque')and plotpayment.paidamount>0 and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce')
                                             and plots.project_id='".$key1['id']."') As installpayment";
																											
										$reschq = $connection->createCommand($sql_cheque)->queryAll();
												foreach($reschq as $chq)
												 {
                                                         echo ($chq['cheque']);
														
												 }
		  ?>
		  ,
		  <?php
		   $sql_po="SELECT SUM(total) as po FROM (
                                            SELECT paidamount AS `total` FROM installpayment 
                                             inner JOIN plots on installpayment.plot_id=plots.id
                                             WHERE  (installpayment.payment_type LIKE'Pay Order' || installpayment.payment_type LIKE'PO') and installpayment.paidamount>0 and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce')
                                             and plots.project_id='".$key1['id']."'
                                            UNION ALL
                                            SELECT paidamount AS `total` FROM  plotpayment 
                                             inner JOIN plots on plotpayment.plot_id=plots.id
                                                WHERE  (plotpayment.paidas LIKE'po' || plotpayment.paidas LIKE'Pay Order') and plotpayment.paidamount>0 and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce')
                                             and plots.project_id='".$key1['id']."'
                                        ) As installpayment";
										$respo = $connection->createCommand($sql_po)->queryAll();
												foreach($respo as $po)
												 {
                                                         echo ($po['po']);
														 
												 }
		  ?>
		  , <?php
		   $sql_online="SELECT SUM(total) as online FROM (
                                            SELECT paidamount AS `total` FROM installpayment 
                                             inner JOIN plots on installpayment.plot_id=plots.id
                                             WHERE  (installpayment.payment_type LIKE'online') and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce')
                                             and plots.project_id='".$key1['id']."'
                                            UNION ALL
                                            SELECT paidamount AS `total` FROM  plotpayment 
                                             inner JOIN plots on plotpayment.plot_id=plots.id
                                                WHERE  (plotpayment.paidas LIKE'online') and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce')
                                             and plots.project_id='".$key1['id']."' 
                                        ) As installpayment";
		   $resonline = $connection->createCommand($sql_online)->queryAll();
												foreach($resonline as $online)
												 {
                                                         echo $online['online'];
														
												 }
		  ?>,<?php
		   $sql_jv="SELECT SUM(total) as jv FROM (
                                            SELECT paidamount AS `total` FROM installpayment 
                                             inner JOIN plots on installpayment.plot_id=plots.id
                                             WHERE  (installpayment.payment_type LIKE'jv') and (installpayment.fstatus !='Cancelled') and (installpayment.fstatus !='Bounce')
                                             and plots.project_id='".$key1['id']."'
                                            UNION ALL
                                            SELECT paidamount AS `total` FROM  plotpayment 
                                             inner JOIN plots on plotpayment.plot_id=plots.id
                                                WHERE  (plotpayment.paidas LIKE'jv') and (plotpayment.fstatus !='Cancelled') and (plotpayment.fstatus !='Bounce')
                                             and plots.project_id='".$key1['id']."' 
                                        ) As installpayment";
		   $resjv = $connection->createCommand($sql_jv)->queryAll();
												foreach($resjv as $jv)
												 {
                                                         echo $jv['jv'];
														
												 }
		  ?>,],
		  <?php }?>
          
        ]);

        var options = {
          chart: {
            title: 'Daily Receipt Summary',
            
          },
          bars: 'vertical', // Required for Material Bar Charts.
          hAxis: {format: 'decimal'},
          height: 400,
          colors: ['#1b9e77', '#d95f02', '#7570b3','#99FF66','#ff0000']
        };

     var chart = new google.charts.Bar(document.getElementById('sales'));
     chart.draw(data, google.charts.Bar.convertOptions(options));
    }
					 
					 
									
									</script>
                                    <div id="sales"></div>
                                  
                                    </td>
                    </tr>
                        
                        </table></td></tr>
                           
                           
                           
                            </tbody>
                        </table>
                    </div>
                </div>
        <br>
        <br>
        
      </p>
   
    
  </div>
</div>
