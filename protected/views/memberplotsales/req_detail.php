<div class="shadow">
  <h3>Allotment Request Details</h3>
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
$imgesr=Yii::app()->baseUrl.'/upload_pic/'.$key['image'];?>
  <div class="span12">
  <div class="span5 left-box">
    <h5 style="text-align:left;">Member Detail</h5>
    <table class="table table-striped table-new table-bordered">
 <tbody>
 <tr><td rowspan="4"><img src="<?php echo $imgesr ?>" width="60" style="border-radius:200px;"/></td></tr>
 <tr><td>
    Name:</td><td>
    <?php echo $key['name']?></td></tr>
 <tr><td>    Id:</td><td>
    <?php echo $key['member_id']?></td></tr>
    <tr><td> CNIC:</td><td>
    <?php echo $key['cnic']?></td></tr>
     
 </tbody></table>
<?php 
$connection = Yii::app()->db; 	
$ass  = "SELECT * FROM associates 
left join members on(associates.mid=members.id)
where associates.msid=".$key['sid']."";
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
  <div class="span6" style="background-color: rgba(91, 192, 222, 0.54);
    padding: 10px;
    float:right;
    border: 1px solid #000;
    border-radius: 15px;">
  <div class="bot-box" >
   <?php if(Yii::app()->session['user_array']['per2']=='1')
			{ 
  ?>
    <label> <a onclick="return confirm('Are you sure you want to delete this ?');" href="cancelallot?plot_id=<?php echo $key['plot_id'];?>&&mem_id=<?php echo $key['member_id'];?>" class="btn" style="float:right"> Cancel(Remove Request)</a>
   <?php }?>
   
    <h5>Action</h5>
    </label>
    <?php 
  $type='';
 if($key['com_res']=='Commercial'){$type='C'; }else{$type='R';}

	if(Yii::app()->session['user_array']['per20']==1 and $key['plotno']==''){
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
    <div id="error-div" class="errorMessage" style=" color:#F00; font-weight:bold;"></div>
    <label>New MS #</label>
    <input name="plot_id" type="hidden" value="<?php echo $key['plot_id'] ?>" />
    <input type="text" value="<?php echo $key['code'] ?>" name="procode" id="procode" class="reg-login-text-field" style="width:60px;"  readonly/>

    <input type="text" value="" name="tempms" id="tempms" class="reg-login-text-field" style="width:140px;" />
    <input type="text" value="<?php echo $type.$key['scode']; ?>" name="sizecode" id="sizecode" class="reg-login-text-field" style="width:60px;" readonly/>
    <?php echo CHtml::ajaxSubmitButton('Submit For Approvel',array('Submit'), array( 'beforeSend' => 'function(){ 
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
  <div class="span12" style="">
  
  
  <div class="span5">
 <h5>Allotment Details</h5>
 <table class="table table-striped table-new table-bordered">
 <tbody>
 <tr><td>Plot No.:</td><td>
 <?php echo $key['plot_detail_address'] ?></td></tr>
      <input type="hidden" value="<?php echo $key['id']?>" name="plot_id" id="plot_id" class="f-left span4 clearfix" />
      <input type="hidden" value="<?php echo $key['member_id']?>" name="member_id" id="member_id" class="f-left span4 clearfix" />
      
      <tr>
          <?php if($key['is_property']==1){?><td> Building:</td><td><?php echo $key['building_name']; ?></td><?php }?>
       <?php if( $key['is_property']==0){?><td> Street/Lane:</td><td><?php echo $key['street']?></td><?php }?>
      </tr>
      <tr><?php if($key['is_property']==1){?><td> Floor:</td><td><?php echo $key['floor_name']; ?></td><?php }?>
       <?php if($key['is_property']==0){?><td> Sector/Block:</td><td><?php echo $key['sector_name']?></td><?php }?>
      </tr>
      <tr><td> Plot category:</td><td>
       <?php echo $key['com_res']?></td></tr>
       <tr><td>Project Name:</td><td>
       <?php echo $key['project_name']?></td></tr>
      <tr><td>Plot Size:</td><td>
	  <?php echo $key['size']?></td></tr>
     
      <tr><td>Allotment Date:</td><td>
	  <?php echo $key['create_date']?></td></tr>
     <tr><td> Plot Status:</td><td>
	  <?php echo $key['status']?></td></tr>
      <tr><td>Dimension:</td><td>
	  <?php echo $key['plot_size']?></td></tr>
      <tr><td>Membership No.</td><td>
      <?php echo $key['plotno']?></td></tr>
   </tbody>
   </table> 
      </div>
  <?php 
	$connection = Yii::app()->db; 	
$sql_details2  = "SELECT * FROM plots where id=".$key['id']."";
$result_details2 = $connection->createCommand($sql_details2)->queryRow();
$sql_details3  = "SELECT * FROM memberplot where plot_id=".$key['id']."";
$result_details3 = $connection->createCommand($sql_details3)->queryRow();
$sql_det1  = "SELECT * FROM discnt where ms_id=".$result_details3['id']."";
$result_dets1 = $connection->createCommand($sql_det1)->queryRow();
$old_date = $key['create_date'];            
$middle = strtotime($old_date);             
$new_date = date('d-m-Y', $middle); 
	?>
    <div class="span5">
    
 <?php $home=Yii::app()->request->baseUrl.'/index.php'; ?>
 <h5><a href="<?php echo $home?>/memberplotsales/payment_details?id=<?php echo $key['plot_id']; ?>&&pid=">Payment Details</a></h5>
    <table class="table table-striped table-new table-bordered">
 <tbody>
 <tr>
 <td>Cost Of Plot:</td>
 <td><?php echo number_format($result_details2['price']);  ?></td></tr>
 <tr>
 <td>Installment:</td>
 <?php 
 $sql_details12  = "SELECT * FROM installpayment where plot_id=".$result_details2['id']."";
$result_details12 = $connection->createCommand($sql_details12)->queryAll();
 ?>
 <td><?php echo count($result_details12);  ?></td></tr>
 <tr>
 <td>Discount:</td>
 <td><?php echo $result_dets1['discount']?>%</td></tr>
 <tr>
 <td><strong style="text-align:left;">Request Details:</strong></td><td></td></tr>
 <tr>
 <td>Request Date:</td>
 <td><?php echo $new_date  ?></td></tr>
 <tr>
 <td>User Name:</td>
 <td><?php echo $key['firstname'].' '.$key['middelname'].' '.$key['lastname']  ?></td></tr>
 <tr>
 <td> Sales Center:</td>
 <td><?php echo $key['scname']?></td></tr>
 <tr>
 <td><strong style="text-align:left;">Finance User Status:</strong></td>
 <td><?php echo $key['fstatus'];  ?></td></tr>
 <tr>
 <td>Comment:</td>
 <td><?php echo $key['fcomment'];  ?></td></tr>
 
 </tbody></table>
 </div>
  <?php } ?>
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