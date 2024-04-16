<div class="container-fluid" style="font-size:12px; background:#FFF;">
  <div class="row-fluid"> 
    <?php 
function localize_us_number($phone) {
  $numbers_only = preg_replace("/[^\d]/", "", $phone);
  return preg_replace("/^1?(\d{5})(\d{7})(\d{1})$/", "$1-$2-$3", $numbers_only);
}
?>
    <div class="">
      <div class="col-lg-3 m-t-20"> 
           
        <div class="thumbnail">
          <?php
$res=array();
foreach($result_members as $key){
$image=$key['image'];
if($image=="")
{
echo '<a href="'.Yii::app()->request->baseUrl.'/index.php/member/upload_image1">Upload Image</a>';

}
else{?>
          <img src="<?php echo Yii::app()->request->baseUrl.'/upload_pic/'.$key['image']; ?>">
          <?php } 
$id=Yii::app()->session['user_array']['id'];
?>
        </div>
        <!-- /Thumbnails -->
        
        <ul class="list-group custom-set">
          <li class="list-group-item" > <a href="#" id="btn1">Profile </a></li>
          <li class="list-group-item" ><span class="badge" style="color:red;">
            <?php if(empty($rowspt)){ echo'0';} else{ echo $rowspt;}?>
            </span><a href="#" id="btn2">Plots</a></li>
          <li class="list-group-item" >
            <p class="glyphicon-friends" ></p>
            <span class="badge" style="color:blue;">
            <?php if(empty($rowsfl)){ echo'0';} else{ echo $rowsfl;}?>
            </span><a href="#" id="btn3">Files</a> </li>
            <li class="list-group-item" >
            <p class="glyphicon-friends" ></p>
            <span class="badge" style="color:blue;">
            <?php if(empty($rowsvilla)){ echo'0';} else{ echo $rowsvilla;}?>
            </span><a href="#" id="btn0">Villas</a> </li>
          <?php 
$connection = Yii::app()->db;  
	$id=(Yii::app()->session['member_array']['id']);
$sql_message  = "SELECT * from register_member_answer where status='0' AND user_id='".$id."' ";
$result_message = $connection->createCommand($sql_message)->queryAll();
$count=0;
$res=array();
foreach($result_message as $k){
$count++;
}
 ?>
          <li class="list-group-item"><a href="#" id="btnut">Under Transfer</a> <span class="badge" style="color:green;">
            <?php if(empty($utc)){ echo'0';} else{ echo $utc;}?>
            </span></li>
          <li class="list-group-item"><a href="#" id="btn8">Transferrd History</a></li>
          <li class="list-group-item" ><span class="badge">(<?php echo $count.'  ';?><a style="color:#FFF;" href="<?php echo $this->createAbsoluteUrl('member/mailbox');?>" >Unread</a>)</span> <a href="#" id="btn4">Queries</a></li>
          <li class="list-group-item" > <a href="<?php echo $this->createAbsoluteUrl('member/view_member_document');?>" id="btn7">View Documents</a></li>
          <li class="list-group-item" > <a href="<?php echo $this->createAbsoluteUrl('member/changepass');?>" id="btn7">Change Password</a></li>
          <li class="list-group-item" > <a href="<?php echo $this->createAbsoluteUrl('member/update_member');?>" id="btn7">Update Info</a></li>
        </ul>
      </div>
      <div class="col-lg-9 " id="profile">
        <div class="info-block">
          <div class="info-text">
            <h3>Member Profile</h3>
            <div class="content-text">
              <table class="table table-striped table-bordered table-hover">
                <tbody>
                  <?php echo
'<tr>
<td>Name</td>
<td>'.$key['name'].'</td>
</tr>
<tr>
<td>SO/DO/WO</td>
<td>'.$key['sodowo'].'</td>
</tr>
<tr>
<td>CNIC</td>
<td>';?>
                  <?php $phone= $key['cnic']; echo localize_us_number($phone) ?>
                  <?php echo '</td>
</tr>
<tr>
<td>Address</td>
<td>'.$key['address'].'</td>
</tr>
<tr>
<td>Member Since</td>
<td>'.$key['create_date'].'</td>
</tr>
<tr>
<td>Phone Number</td>
<td>'.$key['phone'].'</td>
</tr><td>Email Address</td>
<td>'.$key['email'].'</td>
</tr><tr><td><b>Nominee Information</b></td></tr>
<tr><td>Nominee Name</td>
<td>'.$key['nomineename'].'</td>
</tr>
<tr><td>Nominee CNIC</td>
<td>'.$key['nomineecnic'].'</td>
</tr>
<tr><td>Relation with Nominee</td>
<td>'.$key['rwa'].'</td>
</tr>

';}?>
                </tbody>
              </table>
              <div class="list">
                <ul class="list-group inverse-theme">
                  <li class="list-group-item">
                    <h4></h4>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-9" id="plot" style="display:none;">
        <div class="info-block">
          <div class="info-text">
            <div class="content-text">
              <h3> Plots List</h3>
              <table class="table table-striped table-bordered table-hover">
                <tbody>
                <thead>
                  <tr>
                    <td><b>MS No.</b></td>
                    <td><b>Plot Size</b></td>
                    <td><b>Diemension</b></td>
                    <td><b>Plot No</b></td>
                    <td><b>Street/Lane</b></td>
                    <td><b>Block</b></td>
                    <td><b>Project</b></td>
                    <td><b>Detail</b></td>
                    <td><b>Action</b></td>
                    <td><b>Payment</b></td>
                  </tr>
                </thead>
                <tr>
                  <?php
                
foreach($result as $key1)
{
   //$plotid=encode_base64($key1['plot_id']);
 echo'
<td>'.$key1['plotno'].'</td>
<td>'.$key1['size'].'</td>
<td>'.$key1['plot_size'].'</td>

<td>';if($key1['stst']==2){ echo'<span style="color:red">Blocked</span>';}else{ echo $key1['plot_detail_address'];}echo'</td>
<td>';if($key1['stst']==2){ echo'<span style="color:red">Blocked</span>';}else{ echo $key1['street'];}echo'</td>
<td>';if($key1['stst']==2){ echo'<span style="color:red">Blocked</span>';}else{ echo $key1['sector_name'];}echo'</td>
<td>'.$key1['project_name'].'</td>

<td><a href=" '.Yii::app()->request->baseUrl.'/index.php/member/plothistory?id='.$key1['plot_id'].'">History</a></td>
<td>';if($key1['stst']==2){ echo'<span style="color:red">Blocked</span>';}else{
	 echo '<a href=" '.Yii::app()->request->baseUrl.'/index.php/member/transferplot?plot_id='.$key1['plot_id'].'">Transfer</a></td>';}
echo'<td><a href=" '.Yii::app()->request->baseUrl.'/index.php/member/payment_details?id='.($key1['plot_id']).'&&pid='.$key1['project_id'].'">Payment Statement</a></td>
</tr> 
'; }?>
                  </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-9" id="file" style="display:none;">
        <div class="info-block">
          <div class="info-text">
            <h3> Files List</h3>
            <table class="table table-striped table-bordered table-hover">
              <tbody>
              <thead>
                <tr>
                  <td><b>Membership No</b></td>
                  <td><b>File No</b></td>
                  <td><b>File Size</b></td>
                  <td><b>Diemension</b></td>
                  <td><b>Street No</b></td>
                  <td><b>Sector</b></td>
                  <td><b>Project</b></td>
                  <td><b>Detail</b></td>
                  <td><b>Action</b></td>
                  <td><b>Payment</b></td>
                </tr>
              </thead>
              <tr>
                <?php
foreach($resultfile as $var)

{
echo '
<tr>
<td>'.$var['plotno'].'</td>
<td>';if($var['ststf']==2){ echo'<span style="color:red">Blocked</span>';}else{ echo $var['plot_detail_address'];}echo'</td>
<td>'.$var['size'].'</td>
<td>'.$var['plot_size'];echo'</td>
<td>';if($var['ststf']==2){ echo'<span style="color:red">Blocked</span>';}else{ echo $var['street'];}echo'</td>
<td>';if($var['ststf']==2){ echo'<span style="color:red">Blocked</span>';}else{ echo $var['sector_name'];}echo'</td>
<td>'.$var['project_name'].'</td>
<td><a href=" '.Yii::app()->request->baseUrl.'/index.php/member/plothistory?id='.$var['plot_id'].'">History</a></td><td>';if($var['ststf']==2){ echo'<span style="color:red">Blocked</span>';}else{
	 echo '<a href=" '.Yii::app()->request->baseUrl.'/index.php/member/transferplot?plot_id='.$var['plot_id'].'">Transfer</a></td>';}
echo'
<td><a href=" '.Yii::app()->request->baseUrl.'/index.php/member/payment_details?id='.$var['plot_id'].'&&pid='.$var['project_id'].'">Payment Statement</a></td>
</tr>
';}?>
                </tbody>
            </table>
          </div>
        </div>
      </div>
      <!---Start:Villa Code---->
      <div class="col-lg-9" id="villa" style="display:none;">
        <div class="info-block">
          <div class="info-text">
            <div class="content-text">
              <h3> Villas List</h3>
              <table class="table table-striped table-bordered table-hover">
                <tbody>
                <thead>
                  <tr>
                    <td><b>MS No.</b></td>
                    <td><b>Plot Size</b></td>
                    <td><b>Diemension</b></td>
                    <td><b>Plot No</b></td>
                    <td><b>Street/Lane</b></td>
                    <td><b>Block</b></td>
                    <td><b>Project</b></td>
                    <td><b>Detail</b></td>
                    <td><b>Action</b></td>
                    <td><b>Payment</b></td>
                  </tr>
                </thead>
                <tr>
                  <?php
                
foreach($resultvilla as $key2)
{
   //$plotid=encode_base64($key1['plot_id']);
 echo'
<td>'.$key2['plotno'].'</td>
<td>'.$key2['size'].'</td>
<td>'.$key2['plot_size'].'</td>

<td>';if($key2['stst']==2){ echo'<span style="color:red">Blocked</span>';}else{ echo $key2['plot_detail_address'];}echo'</td>
<td>';if($key2['stst']==2){ echo'<span style="color:red">Blocked</span>';}else{ echo $key2['street'];}echo'</td>
<td>';if($key2['stst']==2){ echo'<span style="color:red">Blocked</span>';}else{ echo $key2['sector_name'];}echo'</td>
<td>'.$key2['project_name'].'</td>

<td><a href=" '.Yii::app()->request->baseUrl.'/index.php/member/plothistory?id='.$key2['plot_id'].'">History</a></td>
<td>';if($key2['stst']==2){ echo'<span style="color:red">Blocked</span>';}else{
	 echo '<a href=" '.Yii::app()->request->baseUrl.'/index.php/member/transferplot?plot_id='.$key2['plot_id'].'">Transfer</a></td>';}
echo'<td><a href=" '.Yii::app()->request->baseUrl.'/index.php/member/payment_details?id='.($key2['plot_id']).'&&pid='.$key2['project_id'].'">Payment Statement</a></td>
</tr> 
'; }?>
                  </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!----End: Villa Code---->
      <div class="col-lg-9" id="under_transfer" style="display:none;">
        <div class="info-block">
          <div class="info-text">
            <h3> Under Transfer List</h3>
            <table class="table table-striped table-bordered table-hover">
              <tbody>
              <thead>
                <tr>
                  <td><b>Membership No</b></td>
                  <td><b>Transfer From</b></td>
                  <td><b>Transfer To</b></td>
                  <td><b>Size</b></td>
                   <td><b>Plot No.</b></td>
                  <td><b>Street</b></td>
                  <td><b>Sector</b></td>
                  <td><b>Project</b></td>
              
                 
                  <td><b>Payment</b></td>
                </tr>
              </thead>
              <tr>
                <?php
foreach($ut as $ut)
{
echo '
<tr>
<td>'.$ut['plotno'].'</td>
<td>'.$ut['from_name'].'</td>
<td>'.$ut['to_name'].'</td>
<td>'.$ut['size'].'</td>
<td>'.$ut['plot_detail_address'].'</td>
<td>'.$ut['street'].'</td>
<td>'.$ut['sector_name'].'</td>
<td>'.$ut['project_name'].'</td>
<td><a href=" '.Yii::app()->request->baseUrl.'/index.php/member/Undertransfer_payments?id='.$ut['tid'].'&&pid='.$ut['project_id'].'">Payment Statement</a></td>

</tr>
';}?>
                </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-9" id="transferplothistory" style="display:none;">
      <div class="info-block">
        <div class="info-text">
          <h3> Transferred History</h3>
          <table class="table table-striped table-bordered table-hover">
            <tbody>
            <thead>
              <tr>
                <td><b>Membership No</b></td>
                <td><b>Plot No</b></td>
                <td><b>Plot Size</b></td>
                <td><b>Diemension</b></td>
                <td><b>Street No</b></td>
                <td><b>Sector</b></td>
                <td><b>Project</b></td>
                <td><b>Transfer Date</b></td>
                <td><b>Detail</b></td>
              </tr>
            </thead>
            <tr>
              <?php
foreach($pages as $his)
{
echo '
<tr>

<td>'.$his['plotno'].'</td>
<td>'.$his['plot_detail_address'].'</td>
<td>'.$his['size'].'</td>
<td>'.$his['plot_size'].'</td>
<td>'.$his['street'].'</td>
<td>'.$his['sector'].'</td>
<td>'.$his['project_name'].'</td>
<td>'.$his['transfer_date'].'</td>
<td><a href=" '.Yii::app()->request->baseUrl.'/index.php/member/plothistory?id='.$his['plot_id'].'">History</a></td>





</tr>



';}?>
              </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-lg-9" id="query" style="display:none;">
      <div class="col-lg-11 col-lg-offset2 m-t-20 ">
        <h3> Submit Your Quries </h3>
        <span style="float:right; font-size:16px; font-weight:500; color:#00BFFF;"><a href="<?php echo $this->createAbsoluteUrl('member/mailbox');?>">Inbox</a></span>
        <form class="form-horizontal spacer10" action="<?php echo $this->createAbsoluteUrl('member/query');?>" method="post">
          <div class="form-group">
            <label for="" class="col-sm-2 control-label">Subject</label>
            <div class="col-sm-10">
              <input type="text" name="subject" class="form-control" id="" placeholder="Subject">
            </div>
          </div>
          <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Message</label>
            <div class="col-sm-10">
              <textarea class="form-control" name="message" id="inputPassword3" placeholder="Your message"></textarea>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
<script type="text/javascript">
$(function() {
$("#btn0").click(function(){
$("#villa").css("display","block");
$("#plot").css("display","none");
$("#file").css("display","none");
$("#query").css("display","none");
$("#editprofile").css("display","none");
$("#transferplothistory").css("display","none");
$("#under_transfer").css("display","none");
});
$("#btn1").click(function(){
$("#profile").css("display","block");
$("#plot").css("display","none");
$("#file").css("display","none");
$("#query").css("display","none");
$("#editprofile").css("display","none");
$("#transferplothistory").css("display","none");
$("#under_transfer").css("display","none");
});
$("#btn2").click(function(){
$("#profile").css("display","none");
$("#plot").css("display","block");
$("#file").css("display","none");
$("#query").css("display","none");
$("#editprofile").css("display","none");
$("#transferplothistory").css("display","none");
$("#under_transfer").css("display","none");
});
$("#btn3").click(function(){
$("#profile").css("display","none");
$("#plot").css("display","none");
$("#file").css("display","block");
$("#query").css("display","none");
$("#editprofile").css("display","none");
$("#transferplothistory").css("display","none");
$("#under_transfer").css("display","none");
});
$("#btn4").click(function(){
$("#profile").css("display","none");
$("#plot").css("display","none");
$("#file").css("display","none");
$("#query").css("display","block");
$("#editprofile").css("display","none");
$("#under_transfer").css("display","none");
$("#transferplothistory").css("display","none");
});
$("#btnep").click(function(){
$("#profile").css("display","none");
$("#plot").css("display","none");
$("#file").css("display","none");
$("#query").css("display","none");
$("#editprofile").css("display","block");
$("#under_transfer").css("display","none");
$("#transferplothistory").css("display","none");
});
$("#btn5").click(function(){
$("#profile").css("display","none");
$("#plot").css("display","none");
$("#file").css("display","none");
$("#query").css("display","none");
$("#under_transfer").css("display","none");
$("#editprofile").css("display","none");
$("#setting").css("display","block");
});
$("#btn8").click(function(){
$("#profile").css("display","none");
$("#plot").css("display","none");
$("#editprofile").css("display","none");
$("#file").css("display","none");
$("#query").css("display","none");
$("#under_transfer").css("display","none");
$("#transferplothistory").css("display","block");
});
$("#btnut").click(function(){
$("#profile").css("display","none");
$("#plot").css("display","none");
$("#editprofile").css("display","none");
$("#file").css("display","none");
$("#query").css("display","none");
$("#transferplothistory").css("display","none");
$("#under_transfer").css("display","block");

});

});



</script> 
