<style>
.black-bg {
	background: #333;
	color: #fff;
	width: 21%;
	float: left;
	padding: 5px 10px;
	margin: 2px 0px;
}
.grey-bg {
	background: #CCC;
	color: #000;
	width: 69%;
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
	height: 265px;
	margin: 30px auto;
	padding: 20px;
	position: relative;
	top: 30px;
	width: 55%;
}
.new-box-01 {
	float: left;
	width: 50%;
	margin-bottom: 40px;
}
</style>

<div class="shadow">
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

            foreach($plotdetails as $key){

$connection = Yii::app()->db;
$fstatus=$key['fstatus'];
 	$comment=$key['comment'];
$sql_details1  = "SELECT * FROM members where id=".$key['transferfrom_id']."";
$result_details1 = $connection->createCommand($sql_details1)->queryRow();
$imges=Yii::app()->baseUrl.'/upload_pic/'.$result_details1['image'];
            echo '
<div class="span12" style="">

  <h5 style="text-align:left;">Plot Details</h5> 	

  
  	<div class="black-bg">Plot Address:</div><div class="grey-bg">'.$key['plot_detail_address'].'</div><br>

    <input type="hidden" value="" name="plot_id" id="plot_id" class="f-left span4 clearfix" />

  	<div class="black-bg">Street:</div><div class="grey-bg">'.$key['street'].'</div>

    <br>

  	<div class="black-bg">Plot Size:</div><div class="grey-bg">'.$key['plot_size'].'</div>

    <br>

  	<div class="black-bg">Project Name:</div><div class="grey-bg">'.$key['project_name'].'</div>

    <br>


<div class="span5 left-box">

  <h5 style="text-align:left;">Transfer From(Transferor) </h5>

  


      <input type="hidden" value="" name="transfer_from_memberid" id="member_id" class="reg-login-text-field" />

      <div class="black-bg">First Name :</div><div class="grey-bg">'.$result_details1['name'].'</div><br>

    <div class="black-bg">SODOWO:    </div><div class="grey-bg">'.$result_details1['sodowo'].'</div><br>

    <div class="black-bg">CNIC:   </div><div class="grey-bg"> '.$result_details1['cnic'].'</div><br>

    <div class="black-bg">Address:</div><div class="grey-bg">'.substr($result_details1['address'],0,40).'</div><br>

    <div class="black-bg">Email:</div><div class="grey-bg">'.$result_details1['email'].'</div><br>

    

    <div class="black-bg">State:</div><div class="grey-bg">'.$result_details1['state'].'</div><br>
<div><img src="'.$imges.'"/></div>
</div>';

$connection = Yii::app()->db; 	
$sql_details  = "SELECT * FROM members where id=".$key['transferto_id']."";
$result_details = $connection->createCommand($sql_details)->queryRow();
$imgesr=Yii::app()->baseUrl.'/upload_pic/'.$result_details['image'];
echo '<div class="span6 left-box">

  <h5 style="text-align:left;">Transfer To(Transferee)</h5>

   		<div class="black-bg">First Name :</div><div class="grey-bg">'.$result_details['name'].'</div><br>

    <div class="black-bg">SODOWO:    </div><div class="grey-bg">'.$result_details['sodowo'].'</div><br>

    <div class="black-bg">CNIC:   </div><div class="grey-bg"> '.$result_details['cnic'].'</div><br>

    <div class="black-bg">Address:</div><div class="grey-bg">'.substr($result_details['address'],0,40).'</div><br>

    <div class="black-bg">Email:</div><div class="grey-bg">'.$result_details['email'].'</div><br>

    
    <div class="black-bg">State:</div><div class="grey-bg">'.$result_details['state'].'</div><br>
	<div><img src="'.$imgesr.'"/></div>
	</div>';?>
	
    <?php 
	$connection = Yii::app()->db; 	
$sql_details2  = "SELECT * FROM plots where id=".$key['plot_id']."";
$result_details2 = $connection->createCommand($sql_details2)->queryRow();
$sql_details3  = "SELECT * FROM memberplot where plot_id=".$key['plot_id']."";
$result_details3 = $connection->createCommand($sql_details3)->queryRow();
$old_date = $key['create_date'];            
$middle = strtotime($old_date);             
$new_date = date('d-m-y', $middle); 
	?>
   <div class="clearfix"></div>
    <br />
    <div class="span5 left-box">
    <h5 style="text-align:left;">Price/Installments:</h5>
    <div class="black-bg">Cost Of Plot:</div><div class="grey-bg"><?php echo $result_details2['price'];  ?></div><br>
     <div class="black-bg">Installment:</div><div class="grey-bg"><?php echo $result_details3['noi'];  ?></div><br>
      <div class="black-bg">Balance:</div><div class="grey-bg"></div><br>
    </div>
	<div class="span5 left-box">
    <h5 style="text-align:left;">Request Details:</h5>
    <div class="black-bg">Request Date:</div><div class="grey-bg"><?php echo $new_date  ?></div><br>
    <div class="black-bg">User Name:</div><div class="grey-bg"><?php echo $key['firstname'] ?></div><br>
    <div class="black-bg">Email.:</div><div class="grey-bg"><?php echo $key['email'] ?></div><br>
    </div>
	<div class="span5 left-box">
    <h5 style="text-align:left;">Admin Status:</h5>
    <div class="black-bg">Comment:</div><div class="grey-bg"><?php echo $key['cmnt']  ?></div><br>
    <div class="black-bg"> Status:</div><div class="grey-bg"><?php echo $key['status']?></div><br>
    </div> 
    <?php
	$stat=$result_details['status'];
	$plotid=$_REQUEST['id'];
	if($stat==0){echo '<h4>Transfer to member is not active register member please update<br/><a target="_blank"  href="'.$this->CreateAbsoluteUrl("user/update_member?id=".$key['transferto_id']."").'" >Update Member</a></h4> ';}
 }if($key['status']!='Approved'){
if($stat==1){?>
   <div class="bot-box">
   <a target="_blank" href="<?php 
   $timge=Yii::app()->baseUrl.'/images/imagetransfer/'.$key['image'];
	  if(!empty($key['image'])){
	  echo'<a href="'.$timge.'"><img src="'.$timge.'" style="height:200px;"></a>';
	  
	echo'<form action="proceed"  enctype="multipart/form-data" method="post"  >
     <input type="hidden" name="tid" value="'. $_GET['id'].'" />
	 <input type="submit" name="proceed" value="Proceed">
     </form>';
   
	  
	  }
	  
	 elseif(empty($key['image'])){
   
    
echo '
<div class="span5 left-box">';
 
   
   echo'<a href="'. Yii::app()->request->baseUrl; ?>/capture/demos/hd.html?id=<?php echo $_GET['id']; ?>" target="_blank" style="color:#FFF;">Upload Image</a>
  	<form action="timage"  enctype="multipart/form-data" method="post"  >
     <input type="hidden" name="tid" value="<?php echo $_GET['id'];?>" />
	 <input type="file" name="image"  />
     <input type="submit" name="upload" value="Upload">
    

	
	<?php }?>

  
  <?php } }?>
  </div>
  <div class="clearfix"></div>
</section>

<!-- section 3 -->

<div class="clearfix"></div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> 
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
	listItems+= "<option value='" + val.id + "'>Membership number Already in DB</option>";
      
});listItems+="";

$("#memerror").html(listItems);
          }
});
}
function validateForm(){
	$("#error-pending").hide();
	$("#error-cmnt").hide();
	$("#error-image").hide();
	//	var x=document.forms["form"]["firstname"].value;
	var a = $("#status").val();
	var d = $("#cmnt").val();
	
	var counter=0;



if (a==null || a=="" )

  {

  $("#error-pending").html("Select Status");

  $("#error-pending").show();

  counter =1;

  }


  if (d==null || d=="")

  {

  $("#error-cmnt").html("Please Give Some Comments");

  $("#error-cmnt").show();

  counter =1;

  }
 
 

  if(counter==1)

  	return false;

  

}

 <!--VALIDATION END-->
 

 </script> 
