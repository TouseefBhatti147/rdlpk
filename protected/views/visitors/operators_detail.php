<style>
.alert {
	background: none repeat scroll 0 0 #f00;
	border: medium none #000;
	border-radius: 25px;
	color: #fff;
	position: fixed;
	width: 0;
	float: right;
	padding:8px 86px 8px 14px;
	position: unset;
}
td {
	height:30px;
	vertical-align:middle !important
}
th {
	text-align:center !important;
	height:30px;
	vertical-align:middle !important
}
.new {
	text-align:center;
	border: 3px solid #eeeeee;
	border-radius: 24px;
	float: left;
	height: 155px;
	margin: 50px;
	padding: 5px;
	width: 146px;
}
</style>

<div class="dropdown" style="width:15px;" ></div>
<?php 

$address= $_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl;;

?>

<div class="shadow">
  <h3>Size Wise Detail</h3>
</div>
<span style="float:right; font-size:14px;">Date:<?php echo date('d-m-Y');?></span> 
<!-- shadow -->

<hr noshade="noshade" class="hr-5">

<section class="login-section margin-top-30">
<div id="" class="errorMessage" style="display: none; color:#F00; font-weight:bold;"></div>
<div class="clearfix"></div>
<div class="">
  <table class="table-new table-bordered" style="font-size:12px;">
    <thead style="background:#666; border-color:#ccc; color:#fff;">
      <tr>
        <th width="4%">Serial #</th>
        <th width="20%">Size</th>
        <th width="20%">Commercial</th>
        <th width="20%">Residential</th>
        <th width="20%"> No Of Plots</th>
            </tr>
    </thead><?php 
	
	$trec=0;
	$i=1;
	$totalcom=0;
	$totalres=0;
	$tnoofplots=0;
    $tcomrow=0;
	$tresrow=0;
	$tnorow=0;
	
	
	$connection = Yii::app()->db; 
      
		  
		    $tresrow=$totalres+$tresrow;
	     	
			$tnoofplots=$totalcom+$totalres;
			$tnorow=$tnoofplots+$tnorow;
		 
			
			$sql_com="Select
  rdlpk_db1.size_cat.size,
  Sum(rdlpk_db1.interest_booking.no_of_plots) as tcom,
  rdlpk_db1.interest_booking.com_res,
  rdlpk_db1.interest_booking.deal_by
From
  rdlpk_db1.size_cat Inner Join
  rdlpk_db1.interest_booking On rdlpk_db1.interest_booking.size2 =
    rdlpk_db1.size_cat.id
Where
  rdlpk_db1.interest_booking.com_res = 'Commercial' And
  rdlpk_db1.interest_booking.deal_by = ".$_GET['id']."
Group By
  rdlpk_db1.size_cat.size, rdlpk_db1.interest_booking.com_res,
  rdlpk_db1.interest_booking.deal_by";  
  
            $rescom = $connection->createCommand($sql_com)->query();
		  foreach($rescom as $com){
			  
			  $totalcom=$com['tcom'];
		 $sql_res="Select
  rdlpk_db1.size_cat.size as size,
  Sum(rdlpk_db1.interest_booking.no_of_plots) as tres,
  rdlpk_db1.interest_booking.com_res,
  rdlpk_db1.interest_booking.deal_by
From
  rdlpk_db1.size_cat Inner Join
  rdlpk_db1.interest_booking On rdlpk_db1.interest_booking.size2 =
    rdlpk_db1.size_cat.id
Where
  rdlpk_db1.interest_booking.com_res = 'Residential' And
  rdlpk_db1.interest_booking.deal_by = ".$_GET['id']."
Group By
  rdlpk_db1.size_cat.size, rdlpk_db1.interest_booking.com_res,
  rdlpk_db1.interest_booking.deal_by";
				 
  
            $res = $connection->createCommand($sql_res)->query();
		  foreach($res as $res){
			  
			  $totalres=$res['tres'];
		  }
		  // $tnoofresidentials=$tnoofresidentials+$totalres;
             echo'<tr><td>'.$i.'</td><td>'.$com['size'].'</td><td><b>'.$totalcom.'</b></td><td> <b>'.$totalres.'</b></td><td> <b></b></td></tr>'; 
	 $i++; 
		}
	 
	
    ?>
    </tbody>
  </table>
</div>
<hr noshade="noshade" class="hr-5 float-left">
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