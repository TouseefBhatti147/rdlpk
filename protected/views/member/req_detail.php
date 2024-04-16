<div class="container-fluid" style="font-size:12px; background:#FFF;">
<style> .float-left1 {
    float: left;
    margin-left: 20px;
}</style>
<div class="row-fluid"><div class="shadow">
  <h3>Plot Transfer Form</h3>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5 float-left">
<section class="reg-section margin-top-30">
<?php 
$plotdetails_data = Yii::app()->session['plotdetails_array'];

?>

<?php	
            $res=array();
            foreach($plotdetails1 as $key){
            echo '
           


<div class="span6">
  <h4 style="text-align:left;">Plot Details</h4> 	
  <div class="float-left">
  	<b>Plot Address</b>:'.$key['plot_detail_address'].'<br>
    <input type="hidden" value="" name="plot_id" id="plot_id" class="f-left span4 clearfix" />
  	<b>Street</b>:'.$key['street'].'
    <br>
  	<b>Plot Size</b>:'.$key['plot_size'].'
    <br>
  	<b>Project Name</b>:'.$key['project_name'].'
    <br>
  </div>
<div class="span6">
  <h4 style="text-align:left;">Transfer From </h4>
  
  <div class="float-left">
      <input type="hidden" value="" name="transfer_from_memberid" id="member_id" class="reg-login-text-field" />
     
	  <b>Name</b>: '.$key['from_name'].'</br>
	  <b>CNIC</b>: '.$key['from_cnic'].'
  </div>
</div>

<div class="span6">
  <h4 style="text-align:left;">Transfer To</h4>
   	<li>	<b> Name</b> :'.$key['to_name'].'</li>
 	<li>	<b> S/o,D/O,W/O</b> :'.$key['to_sodowo'].'</li>
	<li>	<b> CNIC</b> :'.$key['to_cnic'].'</li>
	<li>	<b> Email</b> :'.$key['to_email'].'</li>
	<li>	<b> Address</b> :'.$key['to_address'].'</li>
	
	</div>' ;}			
	$F='';
	
	$M='';
	if(!empty($key['fstatus'])){$M='Under Admin Observation';}else{$F='Under Finance Review'; }
?>
    <div class="float-left">
  
	<label><b>Request Status:</b></label>
     <?php echo $M.$F;?></br>
		<label><b>Request Submitted Date:</b></label>
     <?php echo $key['create_date']?></br>

    </div>
    
   

 <div class="clearfix"></div>

 
 </section>
<!-- section 3 --> 
 <div class="clearfix"></div>
 </div>
 </div>