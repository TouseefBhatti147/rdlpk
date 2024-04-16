<div class="shadow">
  <h3>Cancel Request Details</h3>
</div>
<section class="reg-section margin-top-30" style="font-size=12px;">
  <?php	            $res=array();
             $key=$plotdetails;
$connection = Yii::app()->db;
$fstatus=$key['fstatus'];
 	$comment=$key['comment'];
$sql_details1  = "SELECT * FROM members where id=".$key['mid']."";
$result_details1 = $connection->createCommand($sql_details1)->queryRow();
$imges=Yii::app()->baseUrl.'/upload_pic/'.$result_details1['image'];?>
<?php 
	if(Yii::app()->session['user_array']['per33']==1 ){
	$form=$this->beginWidget('CActiveForm', array(
 'id'=>'user_login_form',
 'enableAjaxValidation'=>false,
  'enableClientValidation'=>true,
                'method' => 'POST',
                'clientOptions'=>array(
                     'validateOnSubmit'=>true,
                     'validateOnChange'=>true,
                     'validateOnType'=>false,
  ),
)); ?>
<div class="span12" style="">
<div class="span8 left-box">
  <h5 style="text-align:left;">Owner </h5>
 <table class="table table-striped table-new table-bordered">
 <tbody>
<tr><td rowspan="7"> <img width="150px" src="<?php echo $imges?>"/></td></tr>
  
<tr><td>    MS #:</td><td><?php  if(empty($plotdetails['plotno'])){ echo $plotdetails['app_no'];
echo'<input type="hidden" value="'.$plotdetails['app_no'].'" name="app_no" id="app_no" class="reg-login-text-field" />';
}else{ echo $plotdetails['plotno'];
echo'<input type="hidden" value="'.$plotdetails['plotno'].'" name="plotno" id="plotno" class="reg-login-text-field" />';
}?></td></tr>
<tr><td>	Name :</td><td><?php echo $result_details1['name']?></td></tr>
<tr><td>    SODOWO:    </td><td><?php echo $result_details1['sodowo']?></td></tr>
<tr><td>    CNIC:    </td><td><?php echo $result_details1['cnic']?></td></tr>
<tr><td>    Address:</td><td><?php echo substr($result_details1['address'],0,40)?></td></tr>
<tr><td>    Email:</td><td><?php $result_details1['email']?></td></tr>
</tbody></table>
<?php 
$connection = Yii::app()->db; 	
$ass  = "SELECT * FROM associates 
left join members on(associates.mid=members.id)
where associates.msid=".$plotdetails['mpid']."";
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

</div>
<?php 
$sql_details  = "SELECT * FROM members where id=".$key['mid']."";
$result_details = $connection->createCommand($sql_details)->queryRow();
$imgesr=Yii::app()->baseUrl.'/upload_pic/'.$result_details['image'];
?>
<div class="span4 left-box">

  

	</div>
    
</div>    
<div class="span12">
<div class="span6">
  <h5 style="text-align:left;">Plot Details</h5> 
   <table class="table table-striped table-new table-bordered">
 <tbody>	
<tr><td>	File/Plot No.</td><td><?php echo $key['plot_detail_address']?></td></tr>
<input type="hidden" value="" name="plot_id" id="plot_id" class="f-left span4 clearfix" />
<tr><td>  	File/Plot Address:</td><td><?php echo $key['street']?>,<?php echo $key['sector_name']?></td></tr>
<tr><td>  	Plot Size:</td><td><?php echo $key['size']?>(<?php echo $key['plot_size']?>)</td></tr>
<tr><td>  	Project Name:</td><td><?php echo $key['project_name']?></td></tr>
</tbody></table>
    <?php
	$memmm=$key['mid'];
	$memmm1=$key['mid'];
//$memmm1=$key['transferfrom_id'];	
	$ppid=	$key['plot_id'];
	$connection = Yii::app()->db; 	
$sql_details2  = "SELECT * FROM plots where id=".$key['plot_id']."";
$result_details2 = $connection->createCommand($sql_details2)->queryRow();

$sql_install  = "SELECT * FROM installpayment where plot_id=".$key['plot_id']."";
$result_install= $connection->createCommand($sql_install)->queryAll();
$pai=0;
$rem=0;
foreach($result_install as $row5){if(empty($row5['paidamount'])){$rem=$rem+$row5['dueamount'];}
if(!empty($row5['paidamount'])){$pai=$pai+$row5['paidamount'];}
}
$sql_details3  = "SELECT * FROM memberplot where plot_id=".$key['plot_id']."";
$result_details3 = $connection->createCommand($sql_details3)->queryRow();
$old_date = $key['create_date'];            
$middle = strtotime($old_date);             
$new_date = date('d-m-y', $middle); 
	?>
    
    <?php $home=Yii::app()->request->baseUrl.'/index.php'; ?>
    <h5 style="text-align:left;">Price/Installments: <a style="float:right;" href="<?php echo $home?>/memberplot/payment_details?id=<?php echo $key['plot_id']; ?>&&pid=">Payment Details List</a><br></h5>
   <table  class="table table-striped table-new table-bordered">
 <tbody>	
<tr><td>    Cost Of Plot:</td><td><strong><?php echo number_format($result_details2['price']);  ?></strong></td></tr>
<tr><td>     Paid:</td><td><strong><?php echo number_format($pai);  ?></strong></td></tr>
<tr><td>      Balance:</td><td><strong><?php echo number_format($rem);?></strong></td></tr>
<tr><td>      Deduction Amount:</td><td><strong><?php echo $key['damount'];?></strong></td></tr>
</tbody></table>

    <h5 style="text-align:left;">Request Details:</h5>
   <table class="table table-striped table-new table-bordered">
 <tbody>	
<tr><td width="5%">    Request Date:</td><td><?php echo date('d-F-Y',strtotime($key['cancel_date']));  ?></td></tr>
<tr><td width="5%">    Request Type:</td><td><?php if($key['type']==1) {echo 'Merging Plot ';}elseif($key['type']==2) {echo'Return Plot';}  ?></td></tr>
<tr><td width="15%">    Request Detail:</td><td><?php echo $key['detail']; ?></td></tr>
<tr><td>    User Name:</td><td><?php echo $key['firstname'].'&nbsp;'.$key['middelname'].'&nbsp;'.$key['lastname']; ?></td></tr>

</tbody></table>
  <h5 style="text-align:left;">Sales User Details:</h5>
   <table class="table table-striped table-new table-bordered">
 <tbody>	
<tr><td width="5%">    Sales User Status:</td><td><?php echo $key['cpstatus'];  ?></td></tr>
<tr><td width="5%">    Comments:</td><td><?php echo $key['sucomment'];  ?></td></tr>

</tbody></table>
  <h5 style="text-align:left;">Finance User Details:</h5>
   <table class="table table-striped table-new table-bordered">
 <tbody>	
<tr><td width="5%">    Finance User Status:</td><td><?php echo $key['cpfstatus'];  ?></td></tr>
<tr><td width="5%">    Comments:</td><td><?php echo $key['cpfcomment'];  ?></td></tr>

</tbody></table>
  <!--  <h5 style="text-align:left;">Admin Status:</h5>
   <table class="table table-striped table-new table-bordered">
 <tbody>	
<tr><td>    Comment:</td><td><?php // echo $key['cmnt']  ?></td></tr>
<tr><td>     Status:</td><td><?php echo $key['status']?></td></tr>
</tbody></table>-->
    </div>
	<div class="span6 left-box" style=" background-color: #4cd6d4; padding: 20px; border: 1px solid #000; border-radius: 25px;">  
    <h4>Approved for Cancellation</h4>


<div id="error-div" class="errorMessage" style="display: none; color:#F00; font-weight:bold;"></div>

    
        <input type="hidden" value="<?php echo $plotdetails['mid'];?>" name="member_id" id="member_id" class="reg-login-text-field" />
	
   <input type="hidden" name="plot_id"  value="<?php echo $_REQUEST['plot_id'];?>" />
    <!-- <label>Deduction Amount</label>
    
	<input type="text" value="" name="damount" id="damount" class="reg-login-text-field" style="width:240px;" />-->
    <label>Status</label>
    
	<select name="status" id="status">
    <option value="">Select Status</option>
    <option value="approved">Approved</option>
   
     <option value="rejected">Rejected</option>
    </select>
       <label>Admin Comment</label>
    
	<input type="text" value="" name="comment" id="comment" class="reg-login-text-field" style="width:240px;" />
     <?php echo CHtml::ajaxSubmitButton('Submit Cancel',array('Cancelled'), array( 'beforeSend' => 'function(){ 
                                             $("#login").attr("disabled",true);
       										     }',
                                        'complete' => 'function(){ 
                                             $("#user_login_form").each(function(){});
                                             $("#login").attr("disabled",false);
                                        }',
					                   'success'=>'function(data){  
                                             if(data == 1){
                                         location.href = "http://rdlpk.com/index.php/user/dashboard";
                                      }
          									else{
                                                $("#error-div").show();
                                                $("#error-div").html(data);$("#error-div").append("");
												return false;
                                             }}'     ),
                         array("id"=>"login","class" => "btn")      
                ); ?>
<?php $this->endWidget(); }
?>
   
  
    </div>
    </div>
   
 
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