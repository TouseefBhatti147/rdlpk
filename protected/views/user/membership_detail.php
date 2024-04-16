
<style>

.black-bg {
	background:#333; color:#fff; width:20%; float:left; padding:5px 10px; margin:2px 0px;
	}

.grey-bg {
	background:#CCC; color:#000; width:71%; padding:5px 10px; float:left; margin:2px 0px; height:20px;
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
  <h3>Membership Request  Detail</h3>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5 float-left">
<section class="reg-section margin-top-30">


 <form action="<?php echo $this->createAbsoluteUrl('user/Memberupdate');?>" method="post">
   <?php	
            $res=array();
            foreach($membershipdetail as $key){
            echo '
           

<input style="visibility:hidden;" type="text" id="memreq_id" name="memreq_id" value="'.$key['id'].'"/>
<div class="span12" style="">
 
  <div class="float-left">
 	
  	<div class="black-bg">Id:</div><div class="grey-bg">'.$key['id'].'</div><br>

   <div class="black-bg">Name:</div><div class="grey-bg">'.$key['name'].'</div>
    <br>
  	<div class="black-bg">Username:</div><div class="grey-bg">'.$key['username'].'</div>
    <br>
  	<div class="black-bg">SODOWO:</div><div class="grey-bg">'.$key['sodowo'].'</div>
    <br>
  	<div class="black-bg">CNIC:</div><div class="grey-bg">'.$key['cnic'].'</div>
    <br>
  	<div class="black-bg">Email:</div><div class="grey-bg">'.$key['email'].'</div>
    <br>
  	<div class="black-bg">City:</div><div class="grey-bg">'.$key['city'].'</div>
    <br>
  	<div class="black-bg">Address:</div><div class="grey-bg">'.$key['address'].'</div>
     <br>
  	<div class="black-bg">Country:</div><div class="grey-bg" style:>'.$key['country'].'</div>
    <br>
  	<div class="black-bg">Image:</div><div class="grey-bg">Profile Image</div>
	 <br>
<div class="black-bg">Action:</div><div class="grey-bg"><select name="status"><option value="0">Delete</option><option value="1">Active</option></select></div>
'; ?>
   <input type="submit" name="update" value="Submit" />
    </form>
    
 <?php echo '
</div>
</div>

' ;}?>

 <div class="clearfix"></div>

 
 </section>
<!-- section 3 --> 
 <div class="clearfix"></div>
