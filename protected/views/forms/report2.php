<style>
<style>
.btn{
	line-height: 12px;
    margin-bottom: 0;
    padding: 0px 12px;}
	td{ text-align:center !important}
</style>
<div class="shadow">
<a href="bookingreport" class="btn pull-right" style="padding:5px; margin-left:10px; ">Booking Status</a>
<a href="report" class="btn pull-right" style="padding:5px; margin-left:10px;">Mode Wise</a>
<a href="report4" class="btn pull-right" style="padding:5px; margin-left:10px;">City Wise</a>
<a href="report5" class="btn pull-right" style="padding:5px; margin-left:10px;">Prime Locations</a>
  <h3>Report: Sub Dealer</h3>

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
                       <th width="10%">Mode</th>
<th width="5%">Issued</th> 
                        <th width="10%">Open Membership</th>
                         <th width="9%">Open Certificate</th>
                        <th width="8%">Token Money</th>
                        <th width="8%">Token %</th>
                       
						
                        </tr>
                </thead>
                <tbody id="error-div">
<?php
$where=''; 
if(isset($_REQUEST['sid']) && $_REQUEST['sid']!==''){$where='where id='.$_REQUEST['sid'].'';}
 $connection = Yii::app()->db; 
$sql_count  ="SELECT * from seller $where";
$res_count = $connection->createCommand($sql_count)->queryAll();
$sql_mem  ="SELECT * from formpayment where title='membership'";
$res_mem = $connection->createCommand($sql_mem)->queryRow();
$sql_oc  ="SELECT * from formpayment where title='open certificate'";
$res_oc = $connection->createCommand($sql_oc)->queryRow();
$sql_tm  ="SELECT * from formpayment where title='booking'";
$res_tm = $connection->createCommand($sql_tm)->queryRow();
$i=1;
$gco=0;$gmem=0;$gtm=0;$goc=0;$gti=0;
$totalip=0;
        foreach($res_count as $key){
			$co=0;$mem=0;$tm=0;$oc=0;
	$sql_pay  ="SELECT * from sdealer where mdealer='".$key['id']."'";
	$res_pay = $connection->createCommand($sql_pay)->queryAll();	
	$rows=count($res_pay)+1;	
		if(!empty($res_pay)){
			echo '<tr><td rowspan="'.$rows.'">'.$i.'</td><td rowspan="'.$rows.'"><img src="'.Yii::app()->request->baseUrl.'/images/seller/'.$key['logo'].'" width="100" height="130" /></td><td rowspan="'.$rows.'" style="text-align:left !important">'.$key['name'].'</td>';
$sql_forms='';
$res_forms='';
$sql_forms  ="SELECT * from installform 
left join forms on(installform.form_id=forms.id)
where forms.seller_id= '".$key['id']."'";
$res_forms = $connection->createCommand($sql_forms)->query();

$sql_forms1  ="SELECT * from forms where seller_id= '".$key['id']."'";
$res_forms1 = $connection->createCommand($sql_forms1)->query();
$co=0;
$co=count($res_forms1);
$gco=$gco+$co;
 foreach($res_forms as $key1){
	 if($key1['mscharges']==1 && $key1['sdid']=='0'){$mem++;}
	 if($key1['oc']==1){$oc++;}
	 if($key1['tm']==1){$tm++;}
	 }
	$per='';
	$gmem=$gmem+$mem;
	$goc=$goc+$oc;
	$gtm=$gtm+$tm;
	$gti=$gti+$key['issued'];
			echo '<td rowspan="'.$rows.'">'.$co.'</td><td style="text-align:left !important">Main Dealer : Self</tb><td>'.$key['issued'].'</td><td>'.$mem.'</td><td>'.$oc.'</td><td>'.$tm.'</td><td>'; 
			if($mem!==0){$per=($tm/$mem)*100;}
			echo $per.'</td>	</td>';}
			'</tr>';	

	
foreach($res_pay as $key2){	
 $ndmem=0;$ndtm=0;$ndoc=0;
$sql_pay  ="SELECT * from installform where sdid= '".$key2['id']."'";
	$res_pay = $connection->createCommand($sql_pay)->queryAll();
	 foreach($res_pay as $key3){
	if($key3['type']=='membership'){$ndmem++;}
	 if($key3['type']=='certificate'){$ndoc++;}
	 if($key3['type']=='booking'){$ndtm++;}
	
		 }
	$sdoc=0;	$sdtm=0;	$sdmem=0;
	$sql_forms1  ="SELECT * from forms where seller_id= '".$key['id']."'";
$res_forms1 = $connection->createCommand($sql_forms1)->query();
	 foreach($res_forms1 as $key3){
		 if($key1['sdealer']==$key3['id']){}
			if($key3['mscharges']==1){$sdmem++;}
	 		if($key3['oc']==1){$sdoc++;}
	 		if($key3['tm']==1){$sdtm++;}
	 
		 }
		 echo'<tr><td style="text-align:left !important">'.$key2['name'].'</td><td></tb><td>'.$ndmem.'</td><td>'.$ndoc.'</td><td>'.$ndtm.'</td><td></td></tr>';
		 $gmem=$gmem+$ndmem;
	$goc=$goc+$ndoc;
	$gtm=$gtm+$ndtm;	
	 }
			
		
			
			$totalip=$totalip+($key['issued']*$key['price']);
		
			
			}  
            
		echo '<tr><td colspan="3" style="text-align:right; background-color:#0CF;"><b>Total Forms</b></td>
		<td style="background-color:#0CF;">'.$gco.'</td>
		<td style="background-color:#0CF;"></tb>
		<td style="background-color:#0CF;">'.$gti.'</td>
		<td style="background-color:#0CF;">'.$gmem.'</td>
		<td style="background-color:#0CF;">'.$goc.'</td>
		<td style="background-color:#0CF;">'.$gtm.'</td>
		<td style="background-color:#0CF;"></td></tr>';
		$pmem=0;$ptm=0;$poc=0;$pti=0;
		if($gco!==0){$pti=($gti/$gco)*100;}
		if($gco!==0){$pmem=($gmem/$gco)*100;}
		if($gco!==0){$poc=($goc/$gco)*100;}
		if($gco!==0){$ptm=($gtm/$gco)*100;}
		
		echo '<tr><td colspan="3" style="text-align:right;"><b>%age</b></td><td><td></tb></td><td>'.ceil ($pti).'%</td><td>'.ceil ($pmem).'%</td><td>'.ceil ($poc).'%</td><td>'.ceil ($ptm).'%</td><td></td></tr>';
	
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
