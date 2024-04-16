<?php
////////////////////////////////// BEGIN SETUP
  //  $filename ="document.xls";
  
////////////////////////////////// END SETUP
////////////////////////////////// BEGIN GATHER ?>
           <table class="table table-striped table-new table-bordered" style="font-size:12px;">
            	<thead style="background:#666; border-color:#ccc; color:#fff;">
<tr>
                        <th width="5%">MS No.</th>
                         <th width="7%">Name</th>
						   <th width="7%">Father/Spouse</th>
							<th width="5%">CNIC</th>
  						 <th width="4%">Plot Size</th>
                        <th width="4%">Phone</th>
                        <th width="8%">Email</th>
                        <th width="3%">Code</th>
                        <th width="4%">Discount</th>
                       <th width="3%">Due Amount</th>
                       <th width="5%">Received Amount</th>
                       </tr> </thead>
              
<?php 
$content='';
 foreach($members as $key){

             $content='<tr><td>'.$key['plotno'].'</td><td>'.$key['name'].'</td><td>'.$key['sodowo'].'</td><td>'.$key['cnic'].'</td><td>'.$key['size'].'&nbsp;('.$key['plot_size'].')</td><td><strong>'.$key['phone'].'</strong><td>'.$key['email'].'</td><td>'.$key['code'].'</td><td>'.$key['discount'].'</td><td>'.$key['Due_Amount'].'</td><td>'.$key['Received_Amount'].'</td>
			 '; 


			 
echo $content;
header("Content-Type: application/xls");    
header("Content-Disposition: attachment; filename=Sheet.xls");  
header("Pragma: no-cache"); 
header("Expires: 0");} 
?> 
</table>
<?php
/*
error_reporting(E_ALL);
set_time_limit(0);

date_default_timezone_set('Europe/London');


$data = array(
    1 => array ('Name', 'Surname'),
    array('Schwarz', 'Oliver'),
    array('Test', 'Peter')
);
//echo Yii::import('application.vendors.phpexcel.classes.*');


Yii::import('application.vendors.PHPExcel.PHPExcel.IOFactory.php');


echo Yii::import('application.vendors.PHPExcel.PHPExcel.*');      
//$phpExcel = XPHPExcel::createPHPExcel();
//XPHPExcel::init();
$xls = new JPhpExcel('UTF-8', false, 'My Test Sheet');
//$xls->addArray($data);
//$xls->generateXML('my-test');
?>
<body>
</html>*/?>
