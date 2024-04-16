<div class="shadow">
<h3>Allotment Request Details</h3>
</div>
<!-- shadow -->

<hr noshade="noshade" class="hr-5 ">
<section class="reg-section margin-top-30">
<?php 

$plotdetails_data = Yii::app()->session['plotdetails_array'];


            $res=array();

            foreach($plotdetails as $key){
$imgesr=Yii::app()->baseUrl.'/upload_pic/'.$key['image'];?>
<div class="span12">
<div class="span8 left-box">
<h5 style="text-align:left;">Member Detail</h5>
<table class="table table-striped table-new table-bordered">

<tbody>
<tr>
<td rowspan="4"><img src="<?php echo $imgesr ?>" width="100" style="border-radius:200px;"/></td>
</tr>
<tr>
<td> Id:</td>
<td><?php echo $key['member_id']?></td>
</tr>

<tr>
<td> Name:</td>
<td><?php echo $key['name']?></td>
</tr>
<tr>
<td> CNIC:</td>
<td><?php echo $key['cnic']?></td>
</tr>
</tbody>
</table>
</div>
</div>
<div class="span12">

<table class="table table-striped table-new table-bordered">
<tbody>
<tr><td colspan="2"><h5>Allotment Details</h5></td></tr>
<tr>
<td>Plot No.:</td>
<td><?php echo $key['plot_detail_address'] ?></td>
</tr>
<tr>
<td> Street/Lane:</td>
<td><?php echo $key['street']?></td>
</tr>
<tr>
<td> Block/Sector:</td>
<td><?php echo $key['sector_name']?></td>
</tr>
<tr>
<td> Plot category:</td>
<td><?php echo $key['com_res']?></td>
</tr>
<tr>
<td>Project Name:</td>
<td><?php echo $key['project_name']?></td>
</tr>
<tr>
<td>Plot Size:</td>
<td><?php echo $key['size']?></td>
</tr>
<tr>
<td>Allotment Date:</td>
<td><?php // echo  $key['create_date']?></td>
</tr>
<tr>
<td> Plot Status:</td>
<td><?php echo $key['status']?></td>
</tr>
<tr>
<td>Dimension:</td>
<td><?php echo $key['plot_size']?></td>
</tr>
<tr>
<td>Membership No.</td>
<td><?php // echo $key['plotno']?></td>
</tr>
</tbody>

</table>
</div>
<?php 
	$connection = Yii::app()->db; 	
$sql_details2  = "SELECT * FROM plots where id=".$key['id']."";
$result_details2 = $connection->createCommand($sql_details2)->queryRow();
$sql_details3  = "SELECT * FROM booking where plot_id=".$key['id']."";
$result_details3 = $connection->createCommand($sql_details3)->queryRow();
$sql_det1  = "SELECT * FROM discnt where ms_id=".$result_details3['id']."";
$result_dets1 = $connection->createCommand($sql_det1)->queryRow();

?>
<div class="span12">
<?php $home=Yii::app()->request->baseUrl.'/index.php'; ?>
<table class="table table-striped table-new table-bordered">
<tbody>
<tr><td colspan="2"><h5><a href="<?php echo $home?>/memberplotsales/payment_details?id=<?php echo $_GET['id']; ?>&&pid=">Payment Details</a></h5>
</td></tr>
<tr>
<td>Cost Of Plot:</td>
<td><?php echo number_format($result_details2['price']);  ?></td>
</tr>
<tr>
<td>Installment:</td>
<?php 
 $sql_details12  = "SELECT * FROM installpayment where plot_id=".$result_details2['id']."";
$result_details12 = $connection->createCommand($sql_details12)->queryAll();
 ?>
<td><?php echo count($result_details12);  ?></td>
</tr>
<tr>
<td>Discount:</td>
<td><?php echo $result_dets1['discount']?>%</td>
</tr>
<tr>
<td><strong style="text-align:left;">Request Details:</strong></td>
<td></td>
</tr>
<tr>
<td>Request Date:</td>
<td><?php  ?></td>
</tr>
<tr>
<td>User Name:</td>
<td><?php // echo $key['firstname'].' '.$key['middelname'].' '.$key['lastname']  ?></td>
</tr>
<tr>
<td> Sales Center:</td>
<td><?php echo '';?></td>
</tr>
<tr>
<td><strong style="text-align:left;">Finance User Status:</strong></td>
<td><?php //echo $key['fstatus'];  ?></td>
</tr>
<tr>
<td>Comment:</td>
<td><?php //echo $key['fcomment'];  ?></td>
</tr>
</tbody>
</table>
</div>
<div class="span12" style="background-color: rgba(91, 192, 222, 0.54);
    padding: 10px;
    float:right;
    border: 1px solid #000;
    border-radius: 15px;">
<?php }?>
<h5>Action</h5>
<?php 
  $type='';
 
	
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
<?php
   foreach($plotdetails as $key){
	   
?>
<input type="hidden" value="<?php  echo $key['id']?>" name="plot_id" id="plot_id" class="f-left span4 clearfix" />
<input type="hidden" value="<?php  echo $key['member_id']?>" name="member_id" id="member_id" class="f-left span4 clearfix" />
<input type="hidden" value="<?php  echo $_GET['pro']?>" name="project_id" id="project_id" class="f-left span4 clearfix" />
<input type="hidden" value="000" name="appnoo" id="appnoo" class="f-left span4 clearfix" />

<?php }?>
<div id="error-div" class="errorMessage" style=" color:#F00; font-weight:bold;"></div>
<div class="float-left">
<p class="reg-left-text">Application #<font color="#FF0000">*</font></p>
<p class="reg-right-field-area margin-left-5">
<input name="app_no" type="text" value="" class="reg-login-text-field"  />
</p>
</div>


<div class="float-left">
<p class="reg-left-text">Installment(After Months)<font color="#FF0000">*</font></p>
<p class="reg-right-field-area margin-left-5">
<input type="text" value="" name="noi" id="noi" class="reg-login-text-field" />
</p>
</div>
<div class="float-left">
<p class="reg-left-text">Discount %<font color="#FF0000">*</font></p>
<p class="reg-right-field-area margin-left-5">
<input type="number" value="" name="disc" id="disc" class="reg-login-text-field" />
</p>
</div>
<div class="float-left">
<p class="reg-left-text">Plan Start Date<font color="#FF0000">*</font></p>
<p class="reg-right-field-area margin-left-5">
<input name="start_date"  type="text" placeholder="Enter Date" class="new-input" id="todatepicker">
</p>
</div>
<div class="float-left">
<p class="reg-left-text">Installment Plan<font color="#FF0000">*</font></p>
<p class="reg-right-field-area margin-left-5">

<select name="insplan" id="insplan">
<option value="">Select Installment Plan</option>
<?php
     foreach($plan as $p)
	 {
	  echo'<option value="'.$p['id'].'">'.$p['tno'].'&nbsp;'.'Months'.'('.$p['description'].')</option>
';	 
		 }
	 ?>
</select>
</p>
</div>
<div class="float-left">
<p class="reg-left-text"><font color="#FF0000"></font></p>
<p class="reg-right-field-area margin-left-5">
<?php echo CHtml::ajaxSubmitButton('Submit For Booking',array('alotaplot'), array( 'beforeSend' => 'function(){ 
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
<?php $this->endWidget();
?></p></div>
</div>
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