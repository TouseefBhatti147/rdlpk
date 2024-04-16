<div class="shadow">
  <h3>Transfer Report<b> </b></h3>
</div>
           <?php
  $connection = Yii::app()->db;  
 $sql  = "SELECT * from projects where id='".$_POST['project']."'"; 
$result = $connection->createCommand($sql)->query();
foreach($result as $ro)
{
echo '<b>Project Name:</b>'.$ro['project_name']; 
}
?>
<!-- shadow -->
<hr noshade="noshade" class="hr-5">
<style>
.bgd { background-color:#999; }
.float-left{ height:auto;}

</style>
<section class="reg-section margin-top-30">


<div>
 
 </div>
  <div class="float-left">
          
            
            <table class="table table-striped table-new table-bordered">
            	<thead style="background:#666; border-color:#ccc; color:#fff;">
                   		<tr>
                        <th width="3%">Sr #</th>
                        <th width="5%">Date</th>
                        <th width="7%">Plot Type</th>
                        <th width="6%">Plot Size</th>
                        <th width="6%">Plot No</th>
                        <th width="5%">Dimension</th>
                        <th width="4%">Cost</th>
                        <th width="4%">Downpayment</th>
                        <th width="4%">No. of inst</th>
                        <th width="6%">Trnsfer From</th>
                        <th width="8%">Transfer To</th>
                        <th width="5%">Remarks </th>
                        </tr>
                        
                </thead>
                <tbody>
                
           <?php
		   //$_POST['project']=1;
		   $connection = Yii::app()->db;  
	$count=0;
	$sql_plots1  = "SELECT * FROM transferplot
	Left JOIN plots ON (transferplot.plot_id = plots.id)
	Left JOIN projects ON (plots.project_id = projects.id)
	Left JOIN size_cat ON (plots.size2 = size_cat.id)
	Left JOIN memberplot ON (transferplot.plot_id = memberplot.plot_id)
	 where plots.project_id='".$_POST['project']."'";
$result_plots1 = $connection->createCommand($sql_plots1)->queryAll();	
foreach($result_plots1 as $row2){
	$count++;
	
$sql_from  = "SELECT * from members where id='".$row2['transferfrom_id']."'";
$result_froms = $connection->createCommand($sql_from)->queryRow();

$sql_to  = "SELECT * from members where id='".$row2['transferto_id']."'";
$result_tos = $connection->createCommand($sql_to)->queryRow();
	
	//$sql_plots3  = "SELECT * FROM payment
	//Left JOIN members ON (memberplot.member_id = members.id)
	 //where plot_id='".$row2['id']."'";
//echo $sql_plots3;exit;
//$result_plots3 = $connection->createCommand($sql_plots3)->queryRow();	

$old_date = $row2['create_date'];            
$middle = strtotime($old_date);             
$new_date = date('d-m-y', $middle); 
	
	echo '<tr><td></td>
	<td>'.$new_date.'</td>
	<td>'.$row2['com_res'].'</td>
	<td>'.$row2['size'].'</td>
	<td>'.$row2['plot_detail_address'].'</td>
	<td>'.$row2['plot_size'].'</td>
	<td>'.$row2['price'].'</td>
	<td></td>
	<td>'.$row2['noi'].'</td>
	<td>'.$result_froms['name'].'</td>
	<td>'.$result_tos['name'].'</td>
	<td></td>
	</tr>';
	
	}
	
 ?>
                    
                </tbody>
            </table>
              <form id="form1" action="<?php echo Yii::app()->baseUrl; ?>/dompdf/www/pdfgenerator.php" target="_blank" method="post">

 <input type="hidden" name="paper" value="a4">
  <input type="hidden" name="orientation" value="landscape">
<textarea style="visibility:hidden;" name="html" id="html">
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PDF Report</title>
<style>
td{ padding:0px; border-top:1px solid #000; border-left:1px solid #000;}
.table-bordered{ border-right:1px solid #000; border-bottom:1px solid #000;}
</style>
</head>

<body>

<section class="reg-section margin-top-30">


<div>
  <h3>Transfer Report<b> </b></h3>
</div>
           <?php
  $connection = Yii::app()->db;  
 $sql  = "SELECT * from projects where id='".$_POST['project']."'"; 
$result = $connection->createCommand($sql)->query();
foreach($result as $ro)
{
echo '<p><b>Project Name:</b>'.$ro['project_name'].'</p>'; 
}
?>
 </div>
  <table class="table table-striped table-new table-bordered">
            	<thead style="background:#666; border-color:#ccc; color:#fff;">
                   		<tr>
                        <th width="3%">Sr #</th>
                        <th width="5%">Date</th>
                        <th width="7%">Plot Type</th>
                        <th width="6%">Plot Size</th>
                        <th width="6%">Plot No</th>
                        <th width="5%">Dimension</th>
                        <th width="4%">Cost</th>
                        <th width="4%">Downpayment</th>
                        <th width="4%">No. of inst</th>
                        <th width="6%">Trnsfer From</th>
                        <th width="8%">Transfer To</th>
                        <th width="5%">Remarks </th>
                        </tr>
                        
                </thead>
                <tbody>
                
           <?php
		   //$_POST['project']=1;
		   $connection = Yii::app()->db;  
	$count=0;
	$sql_plots1  = "SELECT * FROM transferplot
	Left JOIN plots ON (transferplot.plot_id = plots.id)
	Left JOIN projects ON (plots.project_id = projects.id)
	Left JOIN size_cat ON (plots.size2 = size_cat.id)
	Left JOIN memberplot ON (transferplot.plot_id = memberplot.plot_id)
	 where plots.project_id='".$_POST['project']."'";
$result_plots1 = $connection->createCommand($sql_plots1)->queryAll();	
foreach($result_plots1 as $row2){
	$count++;
	
$sql_from  = "SELECT * from members where id='".$row2['transferfrom_id']."'";
$result_froms = $connection->createCommand($sql_from)->queryRow();

$sql_to  = "SELECT * from members where id='".$row2['transferto_id']."'";
$result_tos = $connection->createCommand($sql_to)->queryRow();
	
	//$sql_plots3  = "SELECT * FROM payment
	//Left JOIN members ON (memberplot.member_id = members.id)
	 //where plot_id='".$row2['id']."'";
//echo $sql_plots3;exit;
//$result_plots3 = $connection->createCommand($sql_plots3)->queryRow();	

$old_date = $row2['create_date'];            
$middle = strtotime($old_date);             
$new_date = date('d-m-y', $middle); 
	
	echo '<tr><td></td>
	<td>'.$new_date.'</td>
	<td>'.$row2['com_res'].'</td>
	<td>'.$row2['size'].'</td>
	<td>'.$row2['plot_detail_address'].'</td>
	<td>'.$row2['plot_size'].'</td>
	<td>'.$row2['price'].'</td>
	<td></td>
	<td>'.$row2['noi'].'</td>
	<td>'.$result_froms['name'].'</td>
	<td>'.$result_tos['name'].'</td>
	<td></td>
	</tr>';
	
	}
	
 ?>
                    
                </tbody>
            </table>
        
            </body>
</html>
</textarea>
<input style="float:left;" type="submit" name="submit" value="Generate PDF" /></form>
</form> 
      
<hr noshade="noshade" class="hr-5 float-left">
 			
  	
  </div>
  
  
  
  
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> 
 
 <script>
 
 
 

  $(document).ready(function()

     {  	

		

       $("#project").change(function()

           {

         	select_street($(this).val());

		   });

		   

		  

     });

 

 

function select_street(id)

{

$.ajax({

      type: "POST",

      url:    "ajaxRequest?val1="+id,

	  contenetType:"json",

      success: function(jsonList){var json = $.parseJSON(jsonList);

var listItems='';

	$(json).each(function(i,val){

	listItems+= "<option value='" + val.id + "'>" + val.street + "</option>";

      



});listItems+="";



$("#street_id").html(listItems);

          }

    });

}

</script>