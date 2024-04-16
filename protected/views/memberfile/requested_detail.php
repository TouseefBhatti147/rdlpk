<style>
.black-bg {
	background:#333; color:#fff; width:21%; float:left; padding:5px 10px; margin:2px 0px;
	}
.grey-bg {
	background:#CCC; color:#000; width:69%; padding:5px 10px; float:left; margin:2px 0px; height:20px;
	}
.left-box {
	float:left;
	border:1px solid #ccc;
	padding:0 5px;
	margin:0 5px;
	}
.bot-box {
	background: none repeat scroll 0 0 #6699FF;
    border-radius: 10px;
    clear: both;
    color: #FFFFFF;
    height: 164px;
    margin: 30px auto;
    padding: 20px;
    position: relative;
    top: 30px;
    width: 55%;
	}
.new-box-01 {
    float: left;
    width: 50%;
	margin-bottom:40px;
}
</style>
<div class="shadow">
  <h3>Allot File Request Detail</h3>
</div>
<!-- shadow -->

<hr noshade="noshade" class="hr-5 ">

<section class="reg-section margin-top-30">

<?php 

$plotdetails_data = Yii::app()->session['plotdetails_array'];



?>



<?php


            $res=array();

            foreach($plotdetails as $key){
$imgesr=Yii::app()->baseUrl.'/upload_pic/'.$key['image'];
            echo '

           
 



<div class="span12" style="">
 	<div class="black-bg">Project Name:</div><div class="grey-bg"><input type="text" style="height:16px;" readonly=readonly() name="project_name" id="project_name" value="'.$key['project_name'].'"></div>
<div class="black-bg">Plot category:</div><div class="grey-bg"><input type="text" readonly=readonly() style="height:16px; " name="com_res" id="com_res" value="'.$key['com_res'].'"></div>
<div class="span6 left-box">
  <h5 style="text-align:left;">File Details</h5> 	

  <div class="">

  
  	

	<div class="black-bg">';
	if($key['type']=='file'){
		echo 'File No:';
		} 
		else{
			echo 'Plot No:';
			}
			echo'</div><div class="grey-bg"><input type="text" readonly=readonly() style="height:16px;" name="plot_detail_address" id="plot_detail_address" value="'.$key['plot_detail_address'].'"></div><br>

    <input type="hidden" value='.$key['id'].' name="plot_id" id="plot_id" class="f-left span4 clearfix" /> <input type="hidden" value="'.$key['member_id'].'" name="member_id" id="member_id" class="f-left span4 clearfix" />

  	<div class="black-bg">Street:</div><div class="grey-bg"><input type="text" style="height:16px;" name="street" id="street" readonly=readonly() value="'.$key['street'].'"></div>

    <br>

  	<div class="black-bg">Plot Size:</div><div class="grey-bg"><input type="text" style="height:16px;" name="plot_size" readonly=readonly() id="plot_size" value="'.$key['size'].'"></div>

    <br>



    <br>

	<div class="black-bg">Price:</div><div class="grey-bg"><input type="text" style="height:16px;" name="price" readonly=readonly() id="price" value="'.$key['price'].'"></div>

    <br>

	<div class="black-bg">Allotment Date:</div><div class="grey-bg"><input type="text" style="height:16px;" readonly=readonly() name="create_date" id="create_date" value="'.$key['create_date'].'"></div>

    <br>

	<div class="black-bg">Plot Status:</div><div class="grey-bg"><input type="text" style="height:16px;" readonly=readonly() name="status" id="status" value="'.$key['status'].'"></div>

    <br>

	

    <br>

	<div class="black-bg">Dimension:</div><div class="grey-bg"><input type="text" style="height:16px;" readonly=readonly() name="size2" id="size2" value="'.$key['plot_size'].'"></div>

    <br>

	

	<div class="black-bg">No. of Installment:</div><div class="grey-bg"><input type="text" readonly=readonly() style="height:16px;" name="noi" id="noi" value='.$key['noi'].'></div>
<div class="black-bg">Membership No.</div><div class="grey-bg"><input type="text" readonly=readonly() style="height:16px;" name="noi" id="noi" value='.$key['plotno'].'></div>
    <br> 

	

  </div>
   <br>  	

</div>
<div class="span5 left-box">
<h5 style="text-align:left;">Member Detail</h5> 	
<div class="black-bg">Name:</div><div class="grey-bg">'.$key['name'].'</div>
<div class="black-bg">CNIC:</div><div class="grey-bg">'.$key['cnic'].'</div>
<div><img src="'.$imgesr.'" width="170" height="200"/></div>
</div>';
?>
 <?php 
	$connection = Yii::app()->db; 	
$sql_details2  = "SELECT * FROM plots where id=".$key['id']."";
$result_details2 = $connection->createCommand($sql_details2)->queryRow();
$sql_details3  = "SELECT * FROM memberplot where plot_id=".$key['id']."";
$result_details3 = $connection->createCommand($sql_details3)->queryRow();
$old_date = $key['create_date'];            
$middle = strtotime($old_date);             
$new_date = date('d-m-Y', $middle); 
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
    <div class="black-bg">User Name:</div><div class="grey-bg"><?php echo $key['firstname']  ?></div><br>
    <div class="black-bg"> Email:</div><div class="grey-bg"><?php echo $key['email']?></div><br>
    </div>  <div class="span5 left-box">
  <h5 style="text-align:left;">Payment Details Link:</h5>
    <div class="black-bg">Link:</div><div class="grey-bg">
    <a href="<?php echo $this->createAbsoluteUrl('memberplot/payment_details?id='.$key['id'].'')?>">Payment Detail Link</a></div><br>
   
    </div>
<div style="width:660px" margin-top:52px; class="span6">  
<div class="bot-box" style="width:900px; height:290px;;">
    <div class="new-box-01">

	<label><h5>Finance User Status</h5></label>
  <input type="text" name="status" style="width:250px;" value="<?php echo $result_details3['fstatus']?>" readonly="readonly" /></div>
 
     <div class="new-box-01">
    <label><h5>Finance User Comments</h5></label>
<input type="text" name="comment" value="<?php echo $result_details3['fcomment']?>" readonly="readonly" />  	
    </div>
    <div class="new-box-01">

	<label><h5>Admin Status</h5></label>
  <input type="text" name="status" style="width:250px;" value="<?php echo $result_details3['status']?>" readonly="readonly" />
  	</div>
     <div class="new-box-01">
    <label><h5>Admin Comments</h5></label>
<input type="text" name="comment" value="<?php echo $result_details3['comment']?>" readonly="readonly" />
  
  	
    </div>
    
   <form action="Cancelreq" method="post"  >
   <input type="hidden" name="pid" value="<?php echo $key['id'] ?>" />

    <input type="submit" name="submit" class="btn-info pull-right" style="padding:5px 10px; float:right; clear:both; border:1px solid #fff;" value="Cancel Request" />
    </form>
    
  
    
    <div style="height: 600px;

    padding: 0 0 0 32px;

    width: 300px;">

  <span style="color:#FF0000; display:block;" id="error-statusapp"></span>
  <span style="color:#FF0000;display:block;" id="error-cmnt"></span>
 
</div>

 <?php } ?>



 </div>

 

 <div class="clearfix"></div>



 

 </section>

<!-- section 3 --> 

 <div class="clearfix"></div>
 <script>
 function validateForm(){
	$("#error-statusapp").hide();
	$("#error-cmnt").hide();
	
	//	var x=document.forms["form"]["firstname"].value;
	var a = $("#statusapp").val();
	var d = $("#cmnt").val();
	
	var counter=0;




  if (d==null || d=="")

  {

  $("#error-cmnt").html("Please Give Some Comments");

  $("#error-cmnt").show();

  counter =1;

  }
  if (a==null || a=="")

  {

  $("#error-statusapp").html("Select Approved Or Rejected");

  $("#error-statusapp").show();

  counter =1;

  }
 

  if(counter==1)

  	return false;

  

}

 
 </script>