<?php 
$address= $_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl;;
?>
<script>	
/* $(function(){
	  var project_name=$("#project_name").val();	
 $.ajax({
	     url:"http://<?php // echo $address ?>/index.php/finance/searchsheet",
                  type:"POST",
                 data:"actionfunction=showData&page=1&project_name="+project_name,
        cache: false,
        success: function(response){
		   
		  $('#error-div').html(response);
		}
	   });
    $('#error-div').on('click','.page-numbers',function(){
       $page = $(this).attr('href');
	   $pageind = $page.indexOf('page=');
	   $page = $page.substring(($pageind+5));
	   $.ajax({
	     url:"http://<?php //echo $address ?>/index.php/finance/searchsheet",
                  type:"POST",
                  data:$("#user_login_form").serialize()+"&&page="+$page,
				//  data:"actionfunction=showData&page="+$page,
        cache: false,
        success: function(response){
		  $('#error-div').html(response);
		}
	   });
	return false;
	});
});*/
</script>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.js"></script>
<script>

$(function() {

$( "#from" ).datepicker({ dateFormat: 'dd-mm-yy' });

});

$(function() {

$( "#to" ).datepicker({ dateFormat: 'dd-mm-yy' });

});

</script>



<div class="shadow">

  <h3>Receivable Sheet</h3>

</div>

<!-- shadow -->

<hr noshade="noshade" class="hr-5">

<section class="reg-section margin-top-30">

<form action="receivable1" method="post">

<div id="" class="errorMessage" style="display: none; color:#F00; font-weight:bold;"></div>
 	<select name="project_name" id="project_name" style="width:180px;"><?php	
	if(!empty($pro)){echo '<option value="'.$pro.'">'.$pro.'</option>'; }else{
				}
            $res=array();
            foreach($projects as $pro){
            echo '<option value="'.$pro['id'].'">'.$pro['project_name'].'</option>'; 
            }?></select> 
 
<input type="text" value="" name="plotno" id="plotno" class="new-input" placeholder="Membeship #" />
 Cut Date: <input name="cut_date" placeholder="Enter Cut Date" type="text" class="new-input" id="to">     


  <input type="submit" name="submit" value="Search" class="login-btn" />
                 
 

</form>


  <div class="">

    <p class="reg-left-textResult For"></p>

     
<h4 style="float:right;"><a href="receivableexl">Export To Excel</a></h4>
            <table class="table table-striped  table-bordered" style="font-size:12px;">
            	<thead style="background:#666; border-color:#ccc; color:#fff;">
                    <tr> 
                        <th width="5%">MS No.</th>
                         <th width="7%"> Name</th>
						   <th width="7%"> Father/Spouse</th>
							<th width="5%"> CNIC</th>
  						 <th width="4%"> Plot Size</th>
                        <th width="4%">Phone</th>
                        <th width="8%">Email</th>
                        <th width="6%">Plot Price</th>
                        <th width="4%">Discount</th>
                       <th width="3%">Due Amount</th>
                       <th width="5%">Received Amount</th>
                       </tr>
                </thead>
              <?php  
			  $due=0;
			  $received=0;
			  $discount=0;
			    foreach($cmdrow1 as $key){
			 $rowtotal = floatval($key['Due_Amount']);
			 $due=$key['Due_Amount']+$due;
			  $received=$key['Received_Amount']+$received;
			  $discount=$key['discount']+$discount;
			  
			 $colcount=-1;
			 
			 foreach($model as $modelt){
				 $colcount++;
				 $totals[$colcount] +=floatval($key["due".$modelt['id'].$modelt['secid']]);
				 $rowtotal += floatval($key["due".$modelt['id'].$modelt['secid']]); 
			 }

         //  print_r($cmdrow1);exit;
		 	if($rowtotal>0){
			 echo '<tr><td>'.$key['plotno'].'</td><td>'.$key['name'].'</td><td>'.$key['sodowo'].'</td><td>'.$key['cnic'].'</td><td>'.$key['size'].'&nbsp;('.$key['plot_size'].')</td><td><strong>'.$key['phone'].'</strong><td>'.$key['email'].'</td><td>'.$key['price'].'</td><td>'.$key['discount'].'</td><td>'.$key['Due_Amount'].'</td><td>'.$key['Received_Amount'].'</td>
			 '; 
		//	 echo'<tr><td>'.$due.'</td></tr>';
			 //for($i=15;$i<$count;$i++){
				//echo'<td>'.$key['Due_Amount'].'</td>'; 
				//print_r($key);
			 //}
			}}
			
			 echo'<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td><strong>'.$discount.'</strong></td><td><strong>'.$due.'</strong></td><td><strong>'.$received.'</strong></td></tr>';
			?>
            <tr>
                        <td width="5%">MS No.</td>
                         <td width="7%"> Name</td>
						   <td width="7%"> Father/Spouse</td>
							<td width="5%"> CNIC</td>
  						 <td width="4%"> Plot Size</td>
                        <td width="4%">Phone</td>
                        <td width="8%">Email</td>
                        <td width="6%">Plot Price</td>
                        <td width="4%">Discount</td>
                       <td width="3%">Due Amount</td>
                       <td width="5%">Received Amount</td>
                       </tr>
</table>

  </div>
  

 

 

 <script>

 

  $(document).ready(function()

     {  	

		

       $("#project").change(function()

           {

         	select_street($(this).val());

		   });

		   

		   $("#street_id").change(function()

           {

         	select_plot($(this).val());

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

 

 

 



	 

function select_plot(id)

{

$.ajax({

      type: "POST",

      url:    "ajaxRequest1?val1="+id,

	  contenetType:"json",

      success: function(jsonList){var json = $.parseJSON(jsonList);

	  

var listItems='';

	$(json).each(function(i,val){

	listItems+= "<option value='" + val.id + "'>" + val.plot_detail_address +" ("+val.plot_size+")</option>";

      



});listItems+="";



$("#plot_id").html(listItems);

          }

    });

}



</script>

 

 </section>

<!-- section 3 --> 

