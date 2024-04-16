<style>
.btn{
	line-height: 12px;
    margin-bottom: 0;
    padding: 0px 12px;}
	td{ text-align:right !important}
	th{text-align:center !important; vertical-align:middle !important;}
</style>
<div class="shadow">

<h3>Balloting Reprt:</h3>
</div>
<?php 
$connection = Yii::app()->db; 
$sql_memd  ="SELECT bplot_details.*,size_cat.size as sname from bplot_details  
LEFT JOIN size_cat ON (size_cat.id=bplot_details.size)
where bid='".$_REQUEST['id']."'
";
$res_memd = $connection->createCommand($sql_memd)->queryAll();





?>


<hr noshade="noshade" class="hr-5">
<section class="login-section margin-top-30">
			<div class="clearfix">
            </div>
  			<div class="">
            <table class="table table-striped table-new table-bordered "  style="font-size:12px;">
            	<thead style="background:#666; border-color:#ccc; color:#fff;">
                    <tr>
                        <th width="4%" rowspan="2" > Sr.NO.</th>
                          <th width="5%" rowspan="2">Plot Size</th>
                          <th width="10%" rowspan="2">Plots Availablefor Balloting</th>
                        <th width="30%" colspan="3">Tokens / Booking</th>
                         <th width="5%"rowspan="2">Variance(Diff.)</th>
                       <th width="5%"rowspan="2">Remarks</th>
                        </tr>
                    <tr>
                       
                        <th width="6%" >Confirm Bookings</th>
                         <th width="6%" >Normal Bookings</th>
                          <th width="6%" >Total</th>
                         
                        </tr>
                       
                </thead>
                <tbody id="error-div">
<?php

foreach($res_memd as $row){

$conbook=0;$norbook=0;$total=0;
$sql_ocd ="SELECT * from forms where size='".$row['size']."' ";
$res_ocd = $connection->createCommand($sql_ocd)->queryAll();
foreach($res_ocd as $row1){
	if($row1['tmco']==1){$conbook=$conbook+1;}
	if($row1['tm']=='yes'){$norbook=$norbook+1;}
	$total=$total+1;}

?>
<tr>
<td>1</td>
<td><?php echo $row['sname'] ?></td>
<td><?php echo $row['tno'] ?></td>
<td><?php echo $conbook ?></td>
<td><?php echo $norbook ?></td>
<td><?php echo $total ?></td>
<td><?php echo $row['tno']-$total?></td>
<td></td>
</tr>
<?php }?>
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