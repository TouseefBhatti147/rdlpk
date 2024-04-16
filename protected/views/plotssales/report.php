<div class="shadow">

  <h3>Detail Report</h3>

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

                        <th width="10%">Plot Categories</th>

                        

                        <th width="6%">Total Plots</th>

                        <th width="7%">File Alloted</th>

                        <th width="7%">Plot Alloted</th>

                        <th width="7%">Balance(Open)</th>

                        <th width="5%">Remarks</th>

                        

                        </tr>

                        <tr><b>::  Residential</b></tr>

                </thead>

                <tbody>

                

           <?php

$total_no_plots=0;

$t_f_alloted=0;

$t_p_alloted=0;

$to_rem=0;

$connection = Yii::app()->db;  

$sql_street  = "SELECT * from plots where com_res='Residential' and project_id='".$_POST['project']."'";

$result_streets = $connection->createCommand($sql_street)->query();
foreach($result_streets as $row)
{

	$total_no_plots ++;

	}

	//echo $total_no_plots;exit;
$sql_plots  = "SELECT DISTINCT size2,size FROM plots
	Left JOIN size_cat ON (plots.size2 = size_cat.id)
";
$result_plots = $connection->createCommand($sql_plots)->query();	

foreach($result_plots as $row1)
{
$size2_ftnumber=0;
$size2_ptnumber=0;
$size2_ftnumbers=0;
$size2_ptnumbers=0;
$total=0;
echo '<tr><td>'.$row1['size'].'</td>';
	$sql_plots1  = "SELECT * from plots
	 where size2='".$row1['size2']."' AND com_res='Residential' and project_id='".$_POST['project']."'";
	$result_plots1 = $connection->createCommand($sql_plots1)->query();
	foreach($result_plots1 as $row3)
	{
	if($row3['type']=='file' && $row3['status']=='Alotted'){$size2_ftnumber++;$t_f_alloted++;}
	if($row3['type']=='Plot' && $row3['status']=='Alotted'){$size2_ptnumber++;$t_p_alloted++;}
	if($row3['type']=='file'){$size2_ftnumbers++;}
	if($row3['type']=='Plot'){$size2_ptnumbers++;}
	$total++;
	}
$totals2=$size2_ftnumbers+$size2_ptnumbers;
$totals3=$size2_ftnumber+$size2_ptnumber;	
$rem=$total-$totals3;
$to_rem=$to_rem+$rem;
//echo '<td></td>';
echo '<td>'.$totals2.'</td>';
echo '<td>'.$size2_ftnumber.'</td>';
echo '<td>'.$size2_ptnumber.'</td>';
echo '<td>'.$rem.'</td>';	
echo '<td></td></tr>';	
}
//echo '<td class="bgd"><b></b></td>';
echo '<tr><td class="bgd" ><b style="float:right;">Total</b></td>';
echo '<td class="bgd"><b>'.$total_no_plots.'</b></td>';
echo '<td class="bgd"><b>'.$t_f_alloted.'</b></td>';
echo '<td class="bgd"><b>'.$t_p_alloted.'</b></td>';
echo '<td class="bgd"><b>'.$to_rem.'</b></td>';	
echo '<td class="bgd"></td></tr>';
$t_f_allotedn=$t_f_alloted/$total_no_plots*100;
$t_p_allotedn=$t_p_alloted/$total_no_plots*100;
$to_remn=$to_rem/$total_no_plots*100;
echo '<tr><td class="bgd"><b style="float:right;">%age</b></td>';
echo '<td class="bgd"><b></b></td>';
echo '<td class="bgd"><b>'.number_format($t_f_allotedn).'%</b></td>';
echo '<td class="bgd"><b>'.number_format($t_p_allotedn).'%</b></td>';
echo '<td class="bgd"><b>'.number_format($to_remn).'%</b></td>';	
echo '<td class="bgd"></td></tr>';	
 ?>                 </tbody>
            </table>
<hr noshade="noshade" class="hr-5 float-left">
</div>
  <div class="float-left">
            <table class="table table-striped table-new table-bordered">

            	<thead style="background:#666; border-color:#ccc; color:#fff;">

                    <tr>

                        <th width="10%">Plot Categories</th>

                        

                        <th width="6%">Total Plots</th>

                        <th width="7%">File Alloted</th>

                        <th width="7%">Plot Alloted</th>

                        <th width="7%">Balance(Open)</th>

                        <th width="5%">Remarks</th>

                        

                        </tr>

                        <tr><b>::  Commercial</b></tr>

                </thead>

                <tbody>

                

           <?php

$total_no_plots=0;

$t_f_alloted=0;

$t_p_alloted=0;

$to_rem=0;

$connection = Yii::app()->db;  

$sql_street  = "SELECT * from plots where com_res='Commercial' and project_id='".$_POST['project']."'";

$result_streets = $connection->createCommand($sql_street)->query();

foreach($result_streets as $row)

{

	$total_no_plots++;

	}

	

$sql_plots  = "SELECT DISTINCT size2,size FROM plots

Left JOIN size_cat ON (plots.size2 = size_cat.id)

";

$result_plots = $connection->createCommand($sql_plots)->query();	

foreach($result_plots as $row1)

{$size2_ftnumber=0;

$size2_ptnumber=0;

$size2_ftnumbers=0;

$size2_ptnumbers=0;

$total=0;



echo '<tr><td>'.$row1['size'].'</td>';

	$sql_plots1  = "SELECT * from plots where size2='".$row1['size2']."' AND com_res='Commercial' and project_id='".$_POST['project']."'";

	$result_plots1 = $connection->createCommand($sql_plots1)->query();

	foreach($result_plots1 as $row3)

	{

	if($row3['type']=='file' && $row3['status']=='Alotted'){$size2_ftnumber++;$t_f_alloted++;}

	if($row3['type']=='Plot' && $row3['status']=='Alotted'){$size2_ptnumber++;$t_p_alloted++;}

	if($row3['type']=='file'){$size2_ftnumbers++;}

	if($row3['type']=='Plot'){$size2_ptnumbers++;}

	

	$total++;

	}

	//echo $size2_ftnumber.'1'.$size2_ftnumbers.'2'.$total;exit;

$totals2=$size2_ftnumbers+$size2_ptnumbers;

$totals3=$size2_ftnumber+$size2_ptnumber;	

$rem=$total-$totals3;

$to_rem=$to_rem+$rem;

//echo '<td></td>';

echo '<td>'.$totals2.'</td>';

echo '<td>'.$size2_ftnumber.'</td>';

echo '<td>'.$size2_ptnumber.'</td>';

echo '<td>'.$rem.'</td>';	

echo '<td></td></tr>';	

}







//echo '<td class="bgd"><b></b></td>';

echo '<tr><td class="bgd" ><b style="float:right;">Total</b></td>';

echo '<td class="bgd"><b>'.$total_no_plots.'</b></td>';

echo '<td class="bgd"><b>'.$t_f_alloted.'</b></td>';

echo '<td class="bgd"><b>'.$t_p_alloted.'</b></td>';

echo '<td class="bgd"><b>'.$to_rem.'</b></td>';	

echo '<td class="bgd"></td></tr>';

$t_f_allotedn=$t_f_alloted/$total_no_plots*100;

$t_p_allotedn=$t_p_alloted/$total_no_plots*100;

$to_remn=$to_rem/$total_no_plots*100;

echo '<tr><td class="bgd"><b style="float:right;">%age</b></td>';

echo '<td class="bgd"><b>'.number_format($total_no_plots).'</b></td>';

echo '<td class="bgd"><b>'.number_format($t_f_allotedn).'%</b></td>';

echo '<td class="bgd"><b>'.number_format($t_p_allotedn).'%</b></td>';

echo '<td class="bgd"><b>'.number_format($to_remn).'%</b></td>';	

echo '<td class="bgd"></td></tr>';	

 ?>

                    

                </tbody>

            </table>

                        



    



<hr noshade="noshade" class="hr-5 float-left">
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
  <h3>Detail Report</h3>
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
<b>::  Residential</b>
            <table class="table table-striped table-new table-bordered">
            	<thead style="background:#666; border-color:#ccc; color:#fff;">
                    <tr>
                        <th width="10%">Plot Categories</th>
                        <th width="6%">Total Plots</th>
                        <th width="7%">File Alloted</th>
                        <th width="7%">Plot Alloted</th>
                        <th width="7%">Balance(Open)</th>
                        <th width="5%">Remarks</th>
                        </tr>
                </thead>
                <tbody>
           <?php
$total_no_plots=0;
$t_f_alloted=0;
$t_p_alloted=0;
$to_rem=0;
$connection = Yii::app()->db;  
$sql_street  = "SELECT * from plots where com_res='Residential' and project_id='".$_POST['project']."'";
$result_streets = $connection->createCommand($sql_street)->query();
foreach($result_streets as $row)
{
	$total_no_plots++;
	}
$sql_plots  = "SELECT DISTINCT size2,size FROM plots
Left JOIN size_cat ON (plots.size2 = size_cat.id)
";
$result_plots = $connection->createCommand($sql_plots)->query();	
foreach($result_plots as $row1)
{
$size2_ftnumber=0;
$size2_ptnumber=0;
$size2_ftnumbers=0;
$size2_ptnumbers=0;
$total=0;
echo '<tr><td>'.$row1['size'].'</td>';
	$sql_plots1  = "SELECT * from plots
	 where size2='".$row1['size2']."' AND com_res='Residential' and project_id='".$_POST['project']."'";
	$result_plots1 = $connection->createCommand($sql_plots1)->query();
	foreach($result_plots1 as $row3)
	{
	if($row3['type']=='file' && $row3['status']=='Alotted'){$size2_ftnumber++;$t_f_alloted++;}
	if($row3['type']=='Plot' && $row3['status']=='Alotted'){$size2_ptnumber++;$t_p_alloted++;}
	if($row3['type']=='file'){$size2_ftnumbers++;}
	if($row3['type']=='Plot'){$size2_ptnumbers++;}
	$total++;
	}
$totals2=$size2_ftnumbers+$size2_ptnumbers;
$totals3=$size2_ftnumber+$size2_ptnumber;	
$rem=$total-$totals3;
$to_rem=$to_rem+$rem;
//echo '<td></td>';
echo '<td>'.$totals2.'</td>';
echo '<td>'.$size2_ftnumber.'</td>';
echo '<td>'.$size2_ptnumber.'</td>';
echo '<td>'.$rem.'</td>';	
echo '<td></td></tr>';	
}
//echo '<td class="bgd"><b></b></td>';
echo '<tr><td class="bgd" ><b style="float:right;">Total</b></td>';
echo '<td class="bgd"><b>'.$total_no_plots.'</b></td>';
echo '<td class="bgd"><b>'.$t_f_alloted.'</b></td>';
echo '<td class="bgd"><b>'.$t_p_alloted.'</b></td>';
echo '<td class="bgd"><b>'.$to_rem.'</b></td>';	
echo '<td class="bgd"></td></tr>';
$t_f_allotedn=$t_f_alloted/$total_no_plots*100;
$t_p_allotedn=$t_p_alloted/$total_no_plots*100;
$to_remn=$to_rem/$total_no_plots*100;
echo '<tr><td class="bgd"><b style="float:right;">%age</b></td>';
echo '<td class="bgd"><b></b></td>';
echo '<td class="bgd"><b>'.number_format($t_f_allotedn).'%</b></td>';
echo '<td class="bgd"><b>'.number_format($t_p_allotedn).'%</b></td>';
echo '<td class="bgd"><b>'.number_format($to_remn).'%</b></td>';	
echo '<td class="bgd"></td></tr>';	

 echo		'</tbody>
            </table>
            <b>::  Commercial</b>
            <table class="table table-striped table-new table-bordered">
            	<thead style="background:#666; border-color:#ccc; color:#fff;">
                    <tr>
                        <th width="10%">Plot Categories</th>

                       <th width="6%">Total Plots</th>

                        <th width="7%">File Alloted</th>

                        <th width="7%">Plot Alloted</th>

                        <th width="7%">Balance(Open)</th>

                        <th width="5%">Remarks</th>               </tr>
               </thead>
                <tbody>';
$total_no_plots=0;

$t_f_alloted=0;

$t_p_alloted=0;

$to_rem=0;

$connection = Yii::app()->db;  

$sql_street  = "SELECT * from plots where com_res='Commercial' and project_id='".$_POST['project']."'";

$result_streets = $connection->createCommand($sql_street)->query();

foreach($result_streets as $row)

{

	$total_no_plots++;

	}

	

$sql_plots  = "SELECT DISTINCT size2,size FROM plots

Left JOIN size_cat ON (plots.size2 = size_cat.id)

";

$result_plots = $connection->createCommand($sql_plots)->query();	

foreach($result_plots as $row1)

{$size2_ftnumber=0;

$size2_ptnumber=0;

$size2_ftnumbers=0;

$size2_ptnumbers=0;



$total=0;

echo '<tr><td>'.$row1['size'].'</td>';

	$sql_plots1  = "SELECT * from plots where size2='".$row1['size2']."' AND com_res='Commercial' and project_id='".$_POST['project']."'";

	$result_plots1 = $connection->createCommand($sql_plots1)->query();

	foreach($result_plots1 as $row3)

	{

	if($row3['type']=='File' && $row3['status']=='Alotted'){$size2_ftnumber++;$t_f_alloted++;}

	if($row3['type']=='Plot' && $row3['status']=='Alotted'){$size2_ptnumber++;$t_p_alloted++;}

	if($row3['type']=='File'){$size2_ftnumbers++;}

	if($row3['type']=='Plot'){$size2_ptnumbers++;}

	

	$total++;

	}

$totals2=$size2_ftnumbers+$size2_ptnumbers;

$totals3=$size2_ftnumber+$size2_ptnumber;	

$rem=$total-$totals3;

$to_rem=$to_rem+$rem;

//echo '<td></td>';

echo '<td>'.$totals2.'</td>';

echo '<td>'.$size2_ftnumber.'</td>';

echo '<td>'.$size2_ptnumber.'</td>';

echo '<td>'.$rem.'</td>';	

echo '<td></td></tr>';	

}

//echo '<td class="bgd"><b></b></td>';

echo '<tr><td class="bgd" ><b style="float:right;">Total</b></td>';

echo '<td class="bgd"><b>'.$total_no_plots.'</b></td>';

echo '<td class="bgd"><b>'.$t_f_alloted.'</b></td>';

echo '<td class="bgd"><b>'.$t_p_alloted.'</b></td>';

echo '<td class="bgd"><b>'.$to_rem.'</b></td>';	

echo '<td class="bgd"></td></tr>';

$t_f_allotedn=$t_f_alloted/$total_no_plots*100;

$t_p_allotedn=$t_p_alloted/$total_no_plots*100;

$to_remn=$to_rem/$total_no_plots*100;

echo '<tr><td class="bgd"><b style="float:right;">%age</b></td>';

echo '<td class="bgd"><b></b></td>';

echo '<td class="bgd"><b>'.number_format($t_f_allotedn).'%</b></td>';

echo '<td class="bgd"><b>'.number_format($t_p_allotedn).'%</b></td>';

echo '<td class="bgd"><b>'.number_format($to_remn).'%</b></td>';	

echo '<td class="bgd"></td></tr>';	

 ?>

                    

                </tbody>

            </table>

                       



            

            

            

            </body>

</html>

</textarea>

<input style="float:left;" type="submit" name="submit" value="Generate PDF" /></form>

</form> 

       

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