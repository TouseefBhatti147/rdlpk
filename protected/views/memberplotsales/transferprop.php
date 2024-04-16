<div class="container-fluid" style="font-size:12px; background:#FFF;">

<style> .float-left1 {

	 width: 400px;

    float: left;

    margin-left: 20px;

}
input{width: 400px;
padding: 3px;}</style>

<div class="row-fluid">

<div class="shadow">

  <h3>Property Transfer Form</h3>

</div>

<!-- shadow -->
<script type="text/javascript">
$(document).ready(function (e){
$("#user_login_form").on('submit',(function(e){
e.preventDefault();
$.ajax({
url: "RequestTransfer",
type: "POST",
data:  new FormData(this),
contentType: false,
cache: false,
processData:false,
success: function(data){
$("#error-div").html(data);
},
error: function(){}          
});
}));
});
</script>

<div class="table table-bordered span5 pull-left">
 <table class="table table-bordered" style="font-size:16px;" >
  <thead >
  <tr>
      <th style="color:white; text-align: center;" scope="col" colspan="4">Plot Detail</th>
      
    </tr>  </thead>
    <tr>
      <td scope="col">Project Name</td>
     <td scope="col"><?php echo $plotdetails['project_name']?></td>
    </tr>
    <tr>
      <td scope="col"><?php echo $plotdetails['type']?> No</td>
     <td scope="col">1<?php echo $plotdetails['plot_detail_address']?></td>
    </tr>
  <tbody>
    <tr>
    <td scope="col">Street/Lane</td>
      <td><?php echo $plotdetails['bname']?></td>
    </tr>
    <tr>
    <td scope="col">Block/Sector</td>
      <td scope="col"><?php echo $plotdetails['fname']?></td>
    </tr>
    <tr>
      <td scope="col">Size</td>
      <td colspan="2"><?php echo  $plotdetails['size'].'&nbsp('.$plotdetails['plot_size'].')';?></td>
    </tr>
  </tbody>
</table>
</div>
<div class="table table-bordered span6 pull-right">
 <table class="table table-bordered" style="font-size:16px;" >
  <thead >
  <tr>
      <th style="color:white; text-align: center;" scope="col" colspan="4">Seller Detail</th>
      
    </tr>  </thead>
    <tr>
      <td scope="col">Buyer Name</td>
     <td scope="col"><?php echo $plotdetails['name'];?></td>
    </tr>
    <tr>
      <td scope="col">CNIC</td>
     <td scope="col"><?php echo $plotdetails['cnic'];?></td>
    </tr>
  <tbody>
    <tr>
    <td scope="col">Father/Spouse</td>
      <td><?php echo $plotdetails['sodowo'];?></td>
    </tr>
    <tr>
    <td scope="col">Phone</td>
      <td scope="col"><?php  echo $plotdetails['phone'];?></td>
    </tr>
    <tr>
      <td scope="col">Address</td>
      <td colspan="2"><?php  echo $plotdetails['address'];?></td>
    </tr>
  </tbody>
</table>
</div>


<form action="RequestTransferprop" id="user_login_form" method="post">
<div class="table table-bordered span12 pull-center">
 <table class="table table-bordered" style="font-size:16px;" >
  <thead >
  <tr>
      <th style="color:white; text-align: center;" scope="col" colspan="4">Buyer's Detail</th>
      
    </tr>  </thead>
    <tr>
      <td scope="col">CNIC</td>
     <td scope="col"> <input type="text" value="" name="cnic" id="cnic"  class="" />
    <span style="background-color:#9FF; width:300px; display: block;" id="error-cnic"></span>
    <span style="background-color:#9FF; width:300px; display: block;" id="error-cnic1"></span></td>
    </tr>
    <tr>
      <td scope="col">Form #</td>
     <td scope="col"> <input type="text" value="" name="app_no" id="app_no"  class="" /></td>
    </tr>
    <tr>
      <td scope="col">Comments</td>
     <td scope="col"> <input type="text" value="" name="sc_comment" id="sc_comment"  class="" /></td>
    </tr>
    <tr>
      <td scope="col" colspan="2"><input name="submit" value="Send Transfer Request" type="submit" class="btn-info pull-right" style="margin-right: 0px;" /></td>
     
    </tr>
    
  <tbody>
    
    
  </tbody>
</table>
</div>
<input type="hidden" value="<?php echo $plotdetails['member_id']?>" name="transfer_from_memberid" id="member_id" class="reg-login-text-field" />
<input type="hidden" value="<?php echo $_GET['plot_id']?>" name="plot_id" id="plot_id" class="reg-login-text-field" />


</form>


<div class="span12"><a target="_blank" href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/member/register" style="float:right;" class="btn">Add New Member</a>

<div id="error-div" style="font-size:12px; color:red;"></div>


<!-- section 3 --> 

 <div class="clearfix"></div>

 

 

 

 </div> 

 </div>