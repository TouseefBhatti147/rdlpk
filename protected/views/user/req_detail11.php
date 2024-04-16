<style>
.black-bg {
	background: #333;
	color: #fff;
	width: 34%;
	float: left;
	padding: 5px 10px;
	margin: 2px 0px;
}
.grey-bg {
	background: #CCC;
	color: #000;
	width: 57%;
	padding: 5px 10px;
	float: left;
	margin: 2px 0px;
	height: 20px;
}
.left-box {
	float: left;
	border: 1px solid #ccc;
	padding: 0 5px;
	margin: 0 5px;
}
.bot-box {
	background: none repeat scroll 0 0 #6699FF;
	border-radius: 10px;
	clear: both;
	color: #FFFFFF;
	height: 280px;
	margin: 30px auto;
	padding: 20px;
	position: relative;
	top: 30px;
	width: 70%;
}
.new-box-01 {
	float: left;
	width: 50%;
	margin-bottom: 40px;
}
</style>

<div class="shadow">
  <h3>Plot Transfer Request</h3>
</div>

<!-- shadow -->

<hr noshade="noshade" class="hr-5 float-left">
<section class="reg-section margin-top-30">
  <?php 

$plotdetails_data = Yii::app()->session['plotdetails_array'];



?>
  <?php	

            $res=array();

            foreach($plotdetails as $key){

$connection = Yii::app()->db; 	
$sql_details3  = "SELECT * FROM memberplot where plot_id=".$key['plot_id']."";
$result_details3 = $connection->createCommand($sql_details3)->queryRow();
$sql_details1  = "
SELECT m.*,c.city FROM members m
			Left JOIN tbl_city c ON c.id=m.city_id where m.id=".$key['transferfrom_id']."";
$result_details1 = $connection->createCommand($sql_details1)->queryRow();
$imges=Yii::app()->baseUrl.'/upload_pic/'.$result_details1['image'];
            echo '
<div class="span12" style="">

  <h5 style="text-align:left;">Plot Details</h5> 	

  
  	<div class="black-bg">Plot No:</div><div class="grey-bg">'.$key['plot_detail_address'].'</div><br>

    <input type="hidden" value="" name="plot_id" id="plot_id" class="f-left span4 clearfix" />

  	<div class="black-bg">Street:</div><div class="grey-bg">'.$key['street'].'</div>

    <br>

  	<div class="black-bg">Plot Size:</div><div class="grey-bg">'.$key['size'].'('.$key['plot_size'].')'.'</div>

    <br>

  	<div class="black-bg">Project Name:</div><div class="grey-bg">'.$key['project_name'].'</div>

    <br>


<div class="span5 left-box">

  <h5 style="text-align:left;">Transfer From(Transferor) </h5>

  


      <input type="hidden" value="" name="transfer_from_memberid" id="member_id" class="reg-login-text-field" />

      <div class="black-bg">First Name :</div><div class="grey-bg">'.$result_details1['name'].'</div><br>

    <div class="black-bg">SODOWO:    </div><div class="grey-bg">'.$result_details1['sodowo'].'</div><br>

    <div class="black-bg">CNIC:   </div><div class="grey-bg"> '.$result_details1['cnic'].'</div><br>

    <div class="black-bg">Address:</div><div class="grey-bg">'.$result_details1['address'].'</div><br>

    <div class="black-bg">Email :</div><div class="grey-bg">'.$result_details1['email'].'</div><br>

    <div class="black-bg">City:</div><div class="grey-bg">'.$result_details1['city'].'</div><br>

    <div class="black-bg">State:</div><div class="grey-bg">'.$result_details1['state'].'</div><br>';
if($result_details1['mtype']=='Dealer'){ echo '<div class="black-bg" style="background-color:red;">Member Type:</div><div class="grey-bg">Dealer</div><br>';}
if($result_details3['mmtype']=='Dealer'){
echo '<div class="black-bg" style="background-color:red;">Purchased for:</div><div class="grey-bg">Plot Purchased for Resale</div><br>
';}
//echo '</div>';
	
echo '<div><img src="'.$imges.'"/></div>';
$connection = Yii::app()->db;
$ass  = "SELECT * FROM associates 
left join members on(associates.mid=members.id)
where associates.msid=".$key['mssid']."";
$result_res = $connection->createCommand($ass)->queryAll();
?>
<h5 style="text-align:left;">Associates Members</h5>
 <table class="table table-striped table-new table-bordered">
 <tbody>
 <?php foreach($result_res as $result_ass){
	 
$imgesAss=Yii::app()->baseUrl.'/upload_pic/'.$result_ass['image'];
	 ?>
<tr><td rowspan="3"> <img width="50px" src="<?php echo $imgesAss?>"/></td></tr>
<tr><td>	Member Name :</td><td><?php echo $result_ass['name']?></td></tr>
<tr><td>    CNIC:    </td><td><?php echo $result_ass['cnic']?></td></tr>
<?php }?>
</tbody></table>
<?php
echo '</div>';

$connection = Yii::app()->db; 	
$sql_details  = "SELECT m.*,c.city FROM members m
			Left JOIN tbl_city c ON c.id=m.city_id

 where m.id=".$key['transferto_id']."";
$result_details = $connection->createCommand($sql_details)->queryRow();
$imgesr=Yii::app()->baseUrl.'/upload_pic/'.$result_details['image'];
echo '<div class="span6 left-box">

  <h5 style="text-align:left;">Transfer To(Transferee)</h5>

   		<div class="black-bg">First Name :</div><div class="grey-bg">'.$result_details['name'].'</div><br>

    <div class="black-bg">SODOWO:    </div><div class="grey-bg">'.$result_details['sodowo'].'</div><br>

    <div class="black-bg">CNIC:   </div><div class="grey-bg"> '.$result_details['cnic'].'</div><br>

    <div class="black-bg">Address:</div><div class="grey-bg">'.$result_details['address'].'</div><br>

    <div class="black-bg">Email :</div><div class="grey-bg">'.$result_details['email'].'</div><br>

    <div class="black-bg">City:</div><div class="grey-bg">'.$result_details['city'].'</div><br>

    <div class="black-bg">State:</div><div class="grey-bg">'.$result_details['state'].'</div><br>
	<div><img src="'.$imgesr.'"/></div>
	</div>';?>
	
    <?php 
	$connection = Yii::app()->db; 	
$sql_details2  = "SELECT * FROM plots where id=".$key['plot_id']."";
$result_details2 = $connection->createCommand($sql_details2)->queryRow();

$old_date = $key['create_date'];            
$middle = strtotime($old_date);             
$new_date = date('d-m-y', $middle); 
	?>
   <div class="clearfix"></div>
    <br />
    <div class="span5 left-box">
    <h5 style="text-align:left;">Price/Installments:</h5>
    <div class="black-bg">Cost Of Plot:</div><div class="grey-bg"><?php echo $result_details2['price'];  ?></div><br>
     <div class="black-bg">Installment:</div><div class="grey-bg"><?php echo $result_details3['insplan'].'&nbsp; Months';  ?></div><br>
      <div class="black-bg">Balance:</div><div class="grey-bg"></div><br>
    </div>
	<div class="span5 left-box">
    <h5 style="text-align:left;">Request Details:</h5>
    <div class="black-bg">Request Date:</div><div class="grey-bg"><?php echo $new_date  ?></div><br>
    <div class="black-bg">User Name:</div><div class="grey-bg"><?php echo $key['firstname'] ?></div><br>
    <div class="black-bg">Email.:</div><div class="grey-bg"><?php echo $key['email'] ?></div><br>
    </div>
	<div class="span5 left-box">
    <h5 style="text-align:left;">Finance User Status:</h5>
    <div class="black-bg">Finance User Status:</div><div class="grey-bg"><?php echo $key['fstatus'];  ?></div><br>
     <div class="black-bg">Finance User Comment:</div><div class="grey-bg"><?php echo $key['fcomment'];  ?></div><br>
      
    </div>
	<div class="span5 left-box">
    <h5 style="text-align:left;">Security User Status:</h5>
    <div class="black-bg">Member Status:</div><div class="grey-bg"><?php if(!empty($key['fp'])){ echo '<b style="color:green";>Verified</b>';} else{ echo'<b style="color:red";>Not Verified</b>';}  ?></div><br>
      
    </div>	
	<?php 
	$stat=$result_details['status'];
	$plotid=$_REQUEST['id'];
	if($stat==0){echo '<h4>Transfer to member is not active register member please update<br/><a href="'.$this->CreateAbsoluteUrl("user/update_member?id=".$key['transferto_id']."").'">Update Member</a></h4> ';}
	?>
  <?php }?>


  <?php 

if($stat==1){
	if($key['status']!='Approved'){echo' <div class="bot-box">
  <form action="submitstatus" onsubmit="return validateForm()" enctype="multipart/form-data" method="post"  >
  <input type="hidden" value="'.$plotid.'" name="plot_id" id="plot_id" class="f-left span4 clearfix" /> 
    <div class="new-box-01">
      <label>
      <h5>Action</h5>
      </label>
      <select name="status" id="status" style="width:250px;">
        <option value="">Select Status</option>
        <option value="Approved">Approved</option>
        <option value="Rejected">Rejected</option>
      </select>
    </div>
    <div class="new-box-01">
      <label>
      <h5>Membership No:</h5>
      </label>
      <input type="text" name="plotno" value="'.$result_details3['tempms'].'" id="plotno" style="width:250px;">
    </div>
    <div class="new-box-01">
      <div class="new-box-01">
      <label>
      <h5>Image:</h5>
      </label>';
       
	  
	   $timge=Yii::app()->baseUrl.'/images/imagetransfer/'.$key['image'].'.jpg';
	  if(!empty($key['image'])){
	  
	  echo'<a href="'.$timge.'"><img src="'.$timge.'" style="height:100px"></a>';}
	  else{
		  echo 'No Image Found';
		  }
		  
		
	  ?>
    </div>
    <div class="new-box-01" style="float:right;">
      <label>
      <h5>Comment By Administrator</h5>
      </label>
      <textarea  class="cmnt" name="cmnt" id="cmnt" style=" float:left;" ></textarea>
      <input name="submit" value="Update Action" type="submit" class="btn-info pull-right" style="padding:5px 10px; float:left; clear:both; border:1px solid #fff;" /> </form>
    </div><?php   }}?>
    </div>
    <div style="height:600px;

    padding: 0 0 0 32px;

    width:300px;"> <span style="color:#FF0000; display:block;" id="error-pending"></span>
     <span style="color:#FF0000;display:block;" id="error-cmnt"></span>
      <span style="color:#FF0000; display:block;" id="memerror"></span>
       <span style="color:#FF0000; display:block;" id="error-plotno"></span> 
       
  
  </div>
  <div class="clearfix"></div>
</section>
<script>

  $(document).ready(function()
     {   $("#plotno").change(function()
           {
         	select_mem($(this).val());
		   });
		    });


function select_mem(id)
{
$.ajax({
      type: "POST",
      url:    "ajaxRequest6?val1="+id,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
	  
var listItems='';
	$(json).each(function(i,val){
	listItems+= "<option value='" + val.id + "'>Membership number already exists </option>";
      
});listItems+="";

$("#memerror").html(listItems);
          }
});
}
function validateForm(){
	$("#error-pending").hide();
	$("#error-cmnt").hide();
	
	$("#error-plotno").hide();
	//	var x=document.forms["form"]["firstname"].value;
	var a = $("#status").val();
	var d = $("#cmnt").val();
	var e = $("#plotno").val();

	var counter=0;



if (a==null || a=="" )

  {

  $("#error-pending").html("Please Select Status");

  $("#error-pending").show();

  counter =1;

  }


  if (d==null || d=="")

  {

  $("#error-cmnt").html("Please Give Some Comments");

  $("#error-cmnt").show();

  counter =1;

  }
 if (e==null || e=="")

  {

  $("#error-plotno").html("Please Enter Membership No");

  $("#error-plotno").show();

  counter =1;

  }

 

  if(counter==1)

  	return false;

  

}

 <!--VALIDATION END-->
 

 </script>
<!-- Generate PDF start -->
<form id="form1" action="<?php echo Yii::app()->baseUrl; ?>/dompdf/www/pdfgenerator.php" target="_blank" method="post">

 <input type="hidden" name="paper" value="a4">
  <input type="hidden" name="orientation" value="portrait">
<textarea style="visibility:hidden;" name="html" id="html">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PDF Report</title>
<style>
	
	@page { margin: 0px; }
	
	body {
		
	
margin: 0px;
background-image: url('<?php echo Yii::app()->baseUrl; ?>/dompdf/specimen.jpg');
background-size: cover;
background-repeat:no-repeat;
height:1234px;
	}


</style>
</head>

<body>

<section class="reg-section margin-top-30">
  <?php 

$plotdetails_data = Yii::app()->session['plotdetails_array'];





            $res=array();

            foreach($plotdetails as $key){

$connection = Yii::app()->db; 	
$sql_details1  = "
SELECT m.*,c.city FROM members m
			Left JOIN tbl_city c ON c.id=m.city_id where m.id=".$key['transferfrom_id']."";
$result_details1 = $connection->createCommand($sql_details1)->queryRow();

?>
              <br>

<?php
$connection = Yii::app()->db; 	
$sql_details  = "SELECT m.*,c.city FROM members m
			Left JOIN tbl_city c ON c.id=m.city_id

 where m.id=".$key['transferto_id']."";
$result_details = $connection->createCommand($sql_details)->queryRow();
?>
<img  style="margin:220px 0 0 70px; position:absolute;"  src="<?php echo Yii::getPathOfAlias('webroot')."/upload_pic/".$result_details1['image'];  ?>" width="238px" height="217px">
<img  style="margin:220px 0 0 390px; position:absolute;"  src="<?php echo Yii::getPathOfAlias('webroot')."/upload_pic/".$result_details['image'];  ?>" width="238px" height="217px">
     <div style="margin:555px 0px 0px 140px; position:absolute; font-weight:bold;" ><?php echo $key['project_name'];?></div>
     <div style="margin:585px 0px 0px 445px; position:absolute; font-weight:bold;" ><?php echo $key['street'];?></div>
 	   <div style="margin:585px 0px 0px 140px; position:absolute; font-weight:bold;" class="grey-bg"><?php echo $key['com_res'];?></div>
     <div style="margin:615px 0px 0px 140px; position:absolute; font-weight:bold;" class="grey-bg"><?php echo $key['plot_detail_address'];?></div>
  	 <div style="margin:640px 0px 0px 140px; position:absolute; font-weight:bold;" ><?php echo $key['size'].'('.$key['plot_size'].')';?></div>
       <div style="margin:615px 0px 0px 445px; position:absolute; font-weight:bold;" class="grey-bg"><?php echo $key['sector'];?></div>
     <div style="margin:740px 0px 0px 140px; position:absolute; font-weight:bold;" ><?php echo $result_details1['name'];?></div>
     <div style="margin:775px 0px 0px 140px; position:absolute; font-weight:bold;"  > <?php echo $result_details1['cnic'];?></div>
     <div style="margin:740px 0px 0px 440px; position:absolute; font-weight:bold;" ><?php echo $result_details['name'];?></div>
     <div style="margin:775px 0px 0px 440px; position:absolute; font-weight:bold;" ><?php echo $result_details['cnic'];?></div>
  <?php }?>
    </section>
    </body>
</html>
</textarea>
<input style="float:left;" type="submit" name="submit" value="Generate PDF" /></form>