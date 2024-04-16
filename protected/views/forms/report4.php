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
  <h3>Report: Cities</h3>

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
                          <th width="5%">City</th>
                          <th width="10%">Membership</th>
                        <th width="6%">Certificate</th>
                       <th width="10%">Booking</th>
                     
                       
						
                        </tr>
                </thead>
                <tbody id="error-div">
<?php
$connection = Yii::app()->db; 
$i=0;
foreach($sizes as $cty){
	$i++;
	$mem=0; $cer=0; $bk=0; $tol=0;
	$sql_pay  ="SELECT * from forms where city='".$cty['id']."'";
	$res_pay = $connection->createCommand($sql_pay)->queryAll();	
foreach($res_pay as $new){
	if($new['mscharges']=='1'){$mem++;}
	if($new['oc']=='1'){$cer++;}
	if($new['tm']=='1'){$bk++;}
	}
echo '<tr><td>'.$i.'</td><td>'.$cty['city'].'</td>';
echo '<td>'.$mem.'</td><td>'.$cer.'</td><td>'.$bk.'</td></tr>';
}

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
