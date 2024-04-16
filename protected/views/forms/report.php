<style>
.btn{
	line-height: 12px;
    margin-bottom: 0;
    padding: 0px 12px;}
	td{ text-align:right !important}
</style>
<div class="shadow">
<a href="bookingreport" class="btn pull-right" style="padding:5px; margin-left:10px; ">Booking Status</a>
<a href="report" class="btn pull-right" style="padding:5px; margin-left:10px;">Mode Wise</a>
<a href="report4" class="btn pull-right" style="padding:5px; margin-left:10px;">City Wise</a>
<a href="report5" class="btn pull-right" style="padding:5px; margin-left:10px;">Prime Locations</a>

  <h3>Forms Status : Dealer Wise</h3>

</div>

<!-- shadow -->

<hr noshade="noshade" class="hr-5">

<section class="login-section margin-top-30">



<!--<form name="login-form" method="post" action="">-->



			

			<div class="clearfix"></div>
	
  			<div class="">
            <table class="table table-striped table-new table-bordered "  style="font-size:12px;">
            	<thead style="background:#666; border-color:#ccc; color:#fff;">
                    <tr>
                        <th width="4%"> Sr.NO.</th>
                          <th width="5%">Logo</th>
                          <th width="10%">Distributor Name</th>
                        <th width="6%">Total Forms</th>
                         <th width="5%">Mode</th>
                       <th width="5%">Issued</th>
                        <th width="10%">Open Membership</th>
                         <th width="9%">Open Certificate</th>
                        <th width="8%">Token Money</th>
                        <th width="8%">Token %</th>
                       
						
                        </tr>
                </thead>
                <tbody id="error-div">
<?php
 $connection = Yii::app()->db; 
$sql_count  ="SELECT * from seller";
$res_count = $connection->createCommand($sql_count)->queryAll();
$sql_mem  ="SELECT * from formpayment where title='membership'";
$res_mem = $connection->createCommand($sql_mem)->queryRow();
$sql_oc  ="SELECT * from formpayment where title='open certificate'";
$res_oc = $connection->createCommand($sql_oc)->queryRow();
$sql_tm  ="SELECT * from formpayment where title='booking'";
$res_tm = $connection->createCommand($sql_tm)->queryRow();
$i=1;
$gco=0;$gmem=0;$gtm=0;$goc=0;$gti=0;
$gmema=0;$gtma=0;$goca=0;
$totalip=0;
        foreach($res_count as $key){
			 $dmem=0;$dtm=0;$doc=0;$wmem=0;$wtm=0;$woc=0;
			$co=0;$mem=0;$tm=0;$oc=0;
			$mema=0;$tma=0;$oca=0;
			$sql_forms='';
$res_forms='';
			echo '<tr><td rowspan="3" style="text-align:left !important;">'.$i.'</td><td rowspan="3"><a href="subdealer?sid='.$key['id'].'"><img src="'.Yii::app()->request->baseUrl.'/images/seller/'.$key['logo'].'" width="100" height="130" /></a></td><td rowspan="3" style="text-align:left !important;">'.$key['name'].'</td>';

$sql_forms  ="SELECT * from forms where seller_id= '".$key['id']."'";
$res_forms = $connection->createCommand($sql_forms)->query();
//echo '<td>123</td>';
$co=0;
$co=count($res_forms);
$i++;
$gco=$gco+$co;

 foreach($res_forms as $key1){
	$sql_pay  ="SELECT * from installform where form_id= '".$key1['id']."'";
	$res_pay = $connection->createCommand($sql_pay)->queryAll();
	 foreach($res_pay as $key2){
	if($key2['type']=='membership' && $key2['ststatus']=='Dealer' ){$dmem++;}
	 if($key2['type']=='certificate' && $key2['ststatus']=='Dealer' ){$doc++;}
	 if($key2['type']=='booking' && $key2['ststatus']=='Dealer' ){$dtm++;}
	 if($key2['type']=='membership' && $key2['ststatus']=='Walk-in' ){$wmem++;}
	 if($key2['type']=='certificate' && $key2['ststatus']=='Walk-in' ){$woc++;}
	 if($key2['type']=='booking' && $key2['ststatus']=='Walk-in' ){$wtm++;}
		 }
	 if($key1['mscharges']==1){$mema=$mema+$key2['paidamount'];}
	 if($key1['oc']==1){$oca=$oca+$key2['paidamount'];}
	 if($key1['tm']==1){$tma=$tma+$key2['paidamount'];}
	
	 if($key1['mscharges']==1){$mem++;}
	 if($key1['oc']==1){$oc++;}
	 if($key1['tm']==1){$tm++;}
	 }
	$per='';
	$gmema=$gmema+$mema;
	$goca=$goca+$oca;
	$gtma=$gtma+$tma;
	
	
	$gmem=$gmem+$mem;
	$goc=$goc+$oc;
	$gtm=$gtm+$tm;
	$gti=$gti+$key['issued'];
			echo '<td rowspan="3">'.number_format($co).'</td>
			<td>Dealer</tb>
			<td>'.number_format($key['issued']).'</td>
			<td>'.number_format($dmem).'</td>
			<td>'.number_format($doc).'</td>
			<td>'.number_format($dtm).'</td>
			<td rowspan="2">'; 
			if($mem!==0){$per=($tm/$mem)*100;}
			echo round($per,2).'%</td>	</td>';
			'</tr>';
			echo'<tr><td>Walk-in</td>
			<td></tb>
			<td>'.number_format($wmem).'</td>
			<td>'.number_format($woc).'</td>
			<td>'.round($wtm).'</td>
			</tr>';
			$totalip=$totalip+($key['issued']*$key['price']);
			echo'<tr><td>Amounts</tb><td>'.number_format($key['issued']*$key['price']).'</td><td>'.number_format($mema).'</td><td>'.number_format($oca).'</td><td>'.number_format($tma).'</td><td></td></tr>';
			
			}  
            
		echo '<tr>
		<td colspan="3" style="text-align:right; background-color:#0CF; "><b>Total Forms</b></td>
		<td style="background-color:#0CF;">'.number_format($gco).'</td><td style="background-color:#0CF;"></td>
		
		<td style="background-color:#0CF;">'.number_format($gti).'</td>
		<td style="background-color:#0CF;">'.number_format($gmem).'</td>
		<td style="background-color:#0CF;">'.number_format($goc).'</td>
		<td style="background-color:#0CF;">'.number_format($gtm).'</td>
		<td style="background-color:#0CF;"></td></tr>';
		$pmem=0;$ptm=0;$poc=0;$pti=0;
		if($gco!==0){$pti=($gti/$gco)*100;}
		if($gco!==0){$pmem=($gmem/$gco)*100;}
		if($gco!==0){$poc=($goc/$gco)*100;}
		if($gco!==0){$ptm=($gtm/$gco)*100;}
		
		echo '<tr><td colspan="3" style="text-align:right;"><b>%age</b></td><td></td><td></td><td>'.round($pti,2).'%</td><td>'.round($pmem,2).'%</td><td>'.round ($poc,2).'%</td><td>'.round ($ptm,2).'%</td><td></td></tr>';
		echo '<tr>
		<td colspan="3" style="text-align:right; background-color:#6C6 "><b>Total Amounts</b></td>
		<td style="background-color:#6C6"></td>
		<td style="background-color:#6C6"></td>
		<td style="background-color:#6C6">'.number_format($totalip).'</td>
		<td style="background-color:#6C6">'.number_format($gmema).'</td>
		<td style="background-color:#6C6">'.number_format($goca).'</td>
		<td style="background-color:#6C6">'.number_format($gtma).'</td>
		<td style="background-color:#6C6"></td></tr>';
			?>
            
                </tbody>



            </table>


 			



  	



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