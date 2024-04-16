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
  <h3>Report: Prime Locations</h3>

</div>

<!-- shadow -->
<?php 
$connection = Yii::app()->db; 

$categories  ="SELECT * from categories";
	$categoriesr = $connection->createCommand($categories)->queryAll();
?>
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
                        <?php 
						foreach($categoriesr as $row33){
							echo '<th width="5%">'.$row33['name'].'</th>';
							}
						?>
                     
                       
						
                        </tr>
                </thead>
                <tbody id="error-div">
<?php
$i=0;
foreach($sizes as $cty){
	$i++;
	$mem=0; $cer=0; $bk=0; $tol=0;
	$categories  ="SELECT * from categories";
	$categoriesr = $connection->createCommand($categories)->queryAll();
	$sql_pay  ="SELECT * from forms where size='".$cty['id']."'";
	$res_pay = $connection->createCommand($sql_pay)->queryAll();	
echo '<tr><td>'.$i.'</td><td>'.$cty['size'].'</td>';

	$categoriesf  ="SELECT * from cat_forms 
	left join forms on cat_forms.form_id=forms.id
	where forms.size='".$cty['id']."'" ;
	$categoriesrf = $connection->createCommand($categoriesf)->queryAll();
foreach($categoriesr as $row2){	
		$new11=0;
	foreach($categoriesrf as $row1){
		
		if($row1['cat_id']==$row2['id'] && $cty['id']==$row1['size']){$new11++;}
		}
		echo '<td>'.$new11.'</td>'	;
		}
		echo '</tr>';
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
