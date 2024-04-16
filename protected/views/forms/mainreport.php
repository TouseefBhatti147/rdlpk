<style>
.btn{
	line-height: 12px;
    margin-bottom: 0;
    padding: 0px 12px;}
th{ text-align:center !important;}
	
</style>
<div class="shadow">
<a href="mainreport" class="btn pull-right" style="padding:5px; margin-left:10px;"> Overall Status  </a>
<a href="bookingreport" class="btn pull-right" style="padding:5px; margin-left:10px;"> Booking Status  </a>
<a href="report"        class="btn pull-right" style="padding:5px; margin-left:10px;"> Mode Wise       </a>
<a href="report4"       class="btn pull-right" style="padding:5px; margin-left:10px;"> City Wise       </a>
<a href="report5"       class="btn pull-right" style="padding:5px; margin-left:10px;"> Prime Locations </a>
<h3>Overall Status</h3>
</div>
<?php 
$connection = Yii::app()->db; 
$sql_memd  ="SELECT * from forms where mscharges='1' ";
$res_memd = $connection->createCommand($sql_memd)->queryAll();
$sql_ocd ="SELECT * from forms where oc='1' ";
$res_ocd = $connection->createCommand($sql_ocd)->queryAll();
$sql_tmd  ="SELECT * from forms where tm='1' ";
$res_tmd = $connection->createCommand($sql_tmd)->queryAll();


$mem=0;$oc=0;$bo=0;
$sql_mem  ="SELECT * from installform where type='membership'";
$res_mem = $connection->createCommand($sql_mem)->queryAll();
$sql_oc  ="SELECT * from installform where type='certificate'";
$res_oc = $connection->createCommand($sql_oc)->queryAll();
$sql_tm  ="SELECT * from installform where type='booking'";
$res_tm = $connection->createCommand($sql_tm)->queryAll();

foreach($res_mem  as $row){$mem=$mem+$row['paidamount'];}
foreach($res_oc  as $row1){$oc=$oc+$row1['paidamount'];}
foreach($res_tm  as $row1){$bo=$bo+$row1['paidamount'];}

$sql_memrr  ="SELECT * from rtrn_form where type='membership'";
$res_memrr = $connection->createCommand($sql_memrr)->queryAll();
$sql_ocrr  ="SELECT * from rtrn_form where type='certificate'";
$res_ocrr = $connection->createCommand($sql_ocrr)->queryAll();
$sql_tmrr  ="SELECT * from rtrn_form where type='booking'";
$res_tmrr = $connection->createCommand($sql_tmrr)->queryAll();
$memrr=0;$ocrr=0; $borr=0;
foreach($res_memrr  as $rowrr){$memrr=$memrr+$rowrr['paidamount'];}
foreach($res_ocrr  as $row1rr){$ocrr=$ocrr+$row1rr['paidamount'];}
foreach($res_tmrr  as $row1rr){$borr=$borr+$row1rr['paidamount'];}

?>

<div class="span12">
<hr noshade="noshade" class="hr-5">
<section class="login-section margin-top-30">
			<div class="clearfix">
            </div>
  			<div class="">
            <table class="table table-striped table-new table-bordered "  style="font-size:12px;">
            	<thead style="background:#666; border-color:#ccc; color:#fff;">
                    <tr>
                        <th width="4%"> Sr.No.</th>
                          <th width="8%">Type</th>
                          <th width="8%">Total (Sale)</th>
                        <th width="10%">Total Amount (Sale)</th>
                        <th width="8%">Total (Returned)</th>
                         <th width="10%">Total Amount (Returned)</th>
                         <th width="8%">Net Sales</th>
                         <th width="10%">Net Sales Amount</th>
                        </tr>
                </thead>
                <tbody id="error-div">
<tr>
<td>1</td>
<td>Membership</td>
<td style="text-align:right !important"><?php echo number_format(count($res_memd));?></td>
<td style="text-align:right !important"><?php echo number_format($mem);?></td>
<td style="text-align:right !important"><?php echo number_format(count($res_memrr));?></td>
<td style="text-align:right !important"><?php echo number_format($memrr);?></td>
<td style="text-align:right !important"><?php echo number_format( count($res_memd)- count($res_memrr));?></td>
<td style="text-align:right !important"><?php echo number_format($mem-$memrr);?></td>

</tr>
<tr>
<td>2</td>
<td>Open Certificate</td>
<td style="text-align:right !important"><?php echo number_format(count($res_ocd));?></td>
<td style="text-align:right !important"><?php echo number_format($oc);?></td>
<td style="text-align:right !important"><?php echo number_format(count($res_ocrr));?></td>
<td style="text-align:right !important"><?php echo number_format($ocrr);?></td>
<td style="text-align:right !important"><?php echo number_format(count($res_ocd)-count($res_ocrr));?></td>
<td style="text-align:right !important"><?php echo number_format($oc-$ocrr);?></td>

</tr>
<tr>
<td>3</td>
<td>Booking</td>
<td style="text-align:right !important"><?php echo number_format(count($res_tmd));?></td>
<td style="text-align:right !important"><?php echo number_format($bo);?></td>
<td style="text-align:right !important"><?php echo number_format(count($res_tmrr));?></td>
<td style="text-align:right !important"><?php echo number_format($borr);?></td>
<td style="text-align:right !important"><?php echo number_format(count($res_tmd)-count($res_tmrr));?></td>
<td style="text-align:right !important"><?php echo number_format($bo-$borr);?></td>

</tr>
<tr style="background:#F9BABA;">
<td></td>
<td><strong>Total</strong></td>
<td style="text-align:right !important"><strong><?php //echo number_format(count($res_tmd)+count($res_memd)+count($res_ocd));?></strong></td>
<td style="text-align:right !important"><strong><?php echo number_format($bo+$oc+$mem);?></strong></td>
<?php $tamount=$bo+$oc+$mem; ?>
<td style="text-align:right !important"><strong><?php //echo count($res_memrr)+count($res_ocrr)+count($res_tmrr) ?></strong></td>
<td style="text-align:right !important"><strong><?php echo number_format($memrr+$ocrr+$borr) ; ?></strong></td>
<td></td>
<td style="text-align:right !important"><strong><?php echo number_format(($bo+$oc+$mem) - ($memrr+$ocrr+$borr));?></strong></td>
</tr>
<?php 
$Gtotal=($bo+$oc+$mem) - ($memrr+$ocrr+$borr);
?>

                </tbody>
            </table>
</div>
</div>
<h5 style="margin-left:20px;">Total Booking (Size wise)</h5>
<div class="span12">
<div class="span6">
<table class="table table-striped table-new table-bordered "  style="font-size:12px;">
            	<thead style="background:#666; border-color:#ccc; color:#fff;">
                    <tr>
                        <th width="4%"> Sr.No.</th>
                          <th width="8%">Size</th>
                          <th width="8%">Total Booked</th>
                           <th width="8%">Total Confirmed</th>
                            <th width="12%">Total Advance Alloted </th>
                          </tr></thead><tbody>
<?php 
$i=1;
//$sql_memt  ="SELECT * from forms where tmco='yes'";
//$res_memt = $connection->createCommand($sql_memt)->queryAll();
//echo count($res_memt);
$sql_memts  ="SELECT * from size_cat";
$res_memts = $connection->createCommand($sql_memts)->queryAll();
$total=0;$totalc=0; $totalaa=0;
foreach($res_memts as $row23){
echo '<tr>';
echo '<td>'.$i.'</td>';
echo '<td>'.$row23['size'].'</td>';
$allf  ="SELECT * from forms where size='".$row23['id']."'";
$allfss = $connection->createCommand($allf)->queryAll();
$allf1  ="SELECT * from forms where size='".$row23['id']."' and tmco='yes'";
$allfss1 = $connection->createCommand($allf1)->queryAll();
$allf2  ="SELECT * from forms where size='".$row23['id']."' and aatt='1'";
$allfss2 = $connection->createCommand($allf2)->queryAll();
echo '<td style="text-align:right !important">'.count($allfss).'</td>';
echo '<td style="text-align:right !important">'.count($allfss1).'</td>';
echo '<td style="text-align:right !important">'.count($allfss2).'</td>';
echo '<tr>';
$i++;
$total=$total+count($allfss);
$totalc=$totalc+count($allfss1);
$totalaa=$totalaa+count($allfss2);
}
?>
<tr style="background:#F9BABA !important;">
<td></td>
<td><strong>Total</strong></td>
<td style="text-align:right !important"><strong><?php echo $total;?></strong></td>
<td style="text-align:right !important"><strong><?php echo $totalc;?></strong></td>
<td style="text-align:right !important"><strong><?php echo $totalaa;?></strong></td>

</tr>
</tbody>
</table>
</div>
<div class="span6">
<table class="table table-striped table-new table-bordered "  style="font-size:12px;">
            	<thead style="background:#666; border-color:#ccc; color:#fff;">
                    <tr>
                       
                          <th width="8%">Total Forms Issued </th>
                          <th width="8%" >Total Amount Received</th>
                        
                           
                          </tr></thead><tbody>
<?php 
$i=1;
//$sql_memt  ="SELECT * from forms where tmco='yes'";
//$res_memt = $connection->createCommand($sql_memt)->queryAll();
//echo count($res_memt);

$Totalf  ="SELECT * from seller";
$Totalf_res = $connection->createCommand($Totalf)->queryAll();
$totalff=0;
$totalcc=0;
foreach($Totalf_res as $rowa){
	$totalff=$totalff+$rowa['issued'];
	$totalcc=$totalcc+($rowa['price']*$rowa['issued']);
	}

?>
<tr>
<td  style="text-align:right !important"><strong><?php echo number_format($totalff);?></strong></td>
<td  style="text-align:right !important; "><strong><?php echo number_format($totalcc);?></strong></td>
</tr><tr>
<td style="
    font-size: 16px;
    height: 30px;
    padding-top: 14px;"><strong>Grand Total Amount (PKR)</strong></td>
<td  style="text-align: right !important;
    font-size: 25px;
    background:#F9BABA !important;
    height: 30px;
    padding-top: 14px;"><strong><?php echo number_format($Gtotal+$totalcc); ?></strong></td>


</tr>
</tbody>
</table>
</div>

</div>

<hr noshade="noshade" class="hr-5 float-left">
</section>
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

	listItems+="<option value=''>Select Street</option>";



	$(json).each(function(i,val){



	listItems+= "<option value='" + val.id + "'>" + val.street + "</option>";



      







});listItems+="";







$("#street_id").html(listItems);



          }



    });



}



</script>