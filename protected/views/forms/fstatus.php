
<div class="shadow">
  <h3>Form Status</h3>
</div>
<hr noshade="noshade" class="hr-5 ">
<style>
.new{ width:170px; float: left;}
.tokn{    border: 1px solid;
    padding: 11px;
    border-radius: 13px;
        margin-right: 11px;}
</style>

<div class="new">Project Name:</div><?php echo $formde['project_name']?></br>
<div class="new">Form/Reg #:</div><b><?php echo $formde['scode'].$formde['formno'].$formde['scode1'].$formde['Gserial']?></b></br>
<div class="new">Distributor's:</div><?php echo $formde['sname']?></br>
<div class="new">Distributor's Logo:</div><img width="70" src="<?php echo Yii::app()->request->baseUrl.'/images/seller/'.$formde['logo']?>"/></br>


<hr noshade="noshade" class="hr-5 ">
<div class="span12">
<?php if($formde['mscharges']==1){?>
<div class="span4 tokn" style="background-color: antiquewhite;">
<h5>Membership Details</h5>
<hr noshade="noshade" class="hr-5 ">
<?php $connection = Yii::app()->db; 
$sql_member1= "SELECT * FROM installform
left join sdealer on installform.sdid=sdealer.id
 Left JOIN user ON installform.user_id = user.id
 where form_id='".$formde['id']."' and type='membership'";
$result_members1 = $connection->createCommand($sql_member1)->queryRow();?>

<div class="new">Applicant Name:</div><b><?php echo $formde['name']?></b></br>
<div class="new">Father Name:</div><b><?php echo $formde['sodowo']?></b></br>
<div class="new">CNIC:</div><b><?php echo $formde['cnic']?></b></br>
<div class="new">Fee</div><b><?php if($formde['mscharges']==1){echo 'Paid';}else{echo 'Not Paid';}?></b></br>
<div class="new">Finance Approval</div><b><?php if($formde['fsfstatus']==1){echo 'Approved';}elseif($formde['fsfstatus']==2){echo 'Pending';}elseif($formde['fsfstatus']==3){echo 'Rejected';}else{echo 'Not Verified';}?></b></br>

<div class="new">Mode</div> <b><?php echo $result_members1['ststatus']?></b></br>
<div class="new">Amount</div> <b><?php echo $result_members1['paidamount']?></b></br>
<div class="new">Sub Dealer</div> <b><?php echo $result_members1['name']?></b></br>
<div class="new">User Details</div> <b><?php echo $result_members1['firstname'].' '.$result_members1['middelname'].' '.$result_members1['lastname']?></b></br>
</div>
<?php }if($formde['oc']==1){?>
<div class="span4 tokn" style="    background-color: aquamarine;">
<h5>Certificate Detail</h5><hr noshade="noshade" class="hr-5 ">
<?php $connection = Yii::app()->db; 
$sql_member2= "SELECT * FROM installform
left join sdealer on installform.sdid=sdealer.id
Left JOIN user ON installform.user_id = user.id
 where form_id='".$formde['id']."' and type='certificate'";
$result_members2 = $connection->createCommand($sql_member2)->queryRow();?>
<div class="new">Applicant Name:</div><b><?php echo $formde['name']?></b></br>
<div class="new">Father Name:</div><b><?php echo $formde['sodowo']?></b></br>
<div class="new">CNIC:</div><b><?php echo $formde['cnic']?></b></br>
<div class="new">Fee</div><?php if($formde['oc']==1){echo 'Paid';}else{echo 'Not Paid';}?></b></br>
<div class="new">Finance Approval</div><b><?php if($formde['ocfstatus']==1){echo 'Approved';}elseif($formde['ocfstatus']==2){echo 'Pending';}elseif($formde['ocfstatus']==3){echo 'Rejected';}else{echo 'Not Verified';}?></b></br>

<div class="new">Mode</div> <b><?php echo $result_members2['ststatus']?></b></br>
<div class="new">Amount</div> <b><?php echo $result_members2['paidamount']?></b></br>
<div class="new">Sub Dealer</div> <b><?php echo $result_members2['name']?></b></br>
<div class="new">User Details</div> <b><?php echo $result_members2['firstname'].' '.$result_members2['middelname'].' '.$result_members2['lastname']?></b></br>
</div>
<?php }if($formde['tm']==1){?>
<div class="span4 tokn" style="background-color: chartreuse;">
<h5>Token Detail</h5><hr noshade="noshade" class="hr-5 ">
<?php $connection = Yii::app()->db; 
$sql_member3= "SELECT * FROM installform
left join sdealer on installform.sdid=sdealer.id
Left JOIN user ON installform.user_id = user.id
 where form_id='".$formde['id']."' and type='booking'";
$result_members3 = $connection->createCommand($sql_member3)->queryRow();?>
<div class="new">Applicant Name:</div><b><?php echo $formde['name']?></b></br>
<div class="new">Father Name:</div><b><?php echo $formde['sodowo']?></b></br>
<div class="new">CNIC:</div><b><?php echo $formde['cnic']?></b></br>
<div class="new">Fee</div><b><?php if($formde['tm']==1){echo 'Paid';}else{echo 'Not Paid';}?></b></br>
<div class="new">Finance Approval</div><b><?php if($formde['tmfstatus']==1){echo 'Approved';}elseif($formde['tmfstatus']==2){echo 'Pending';}elseif($formde['tmfstatus']==3){echo 'Rejected';}else{echo 'Not Verified';}?></b></br>

<div class="new">Mode</div> <b><?php echo $result_members3['ststatus']?></b></br>
<div class="new">Amount</div> <b><?php echo $result_members3['paidamount']?></b></br>
<div class="new">Sub Dealer</div> <b><?php echo $result_members3['name']?></b></br>
<div class="new">User Details</div> <b><?php echo $result_members3['firstname'].' '.$result_members3['middelname'].' '.$result_members3['lastname']?></b></br>
</div>
<?php }?>
</div>

<div class="shadow">
  <h3>History</h3>
</div>