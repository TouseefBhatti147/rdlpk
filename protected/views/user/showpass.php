<style>
.black-bg {
	background: #333;
	color: #fff;
	width: 20%;
	float: left;
	padding: 5px 10px;
	margin: 2px 0px;
}
.grey-bg {
	background: #CCC;
	color: #000;
	width: 71%;
	height: 20px;
	padding: 5px 10px;
	float: left;
	margin: 2px 0px;
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
	margin-bottom: 40px;
}
</style>

<div class="shadow">
  <h3>User Detail</h3>
</div>

<!-- shadow -->

<hr noshade="noshade" class="hr-5">
<section class="reg-section margin-top-30">
  <div style="

    padding: 0 0 0 32px;

    width: 300px;"> <span style="color:#FF0000; display:block;" id="error-password"></span> <span style="color:#FF0000; display:block;" id="error-mobile"></span> <span style="color:#FF0000; display:block;" id="error-address"></span> <span style="color:#FF0000; display:block;" id="error-city"></span> <span style="color:#FF0000; display:block;" id="error-country"></span> <span style="color:#FF0000; display:block;" id="error-pic"></span> </div>
  <?php	
            $res=array();

            foreach($user_detail as $key){
				 $password_e = $key['skey'];

        $password_e = base64_decode($password_e);
       
        $password_e = str_replace('orchard', '', $password_e);
 		
        $password_e = base64_decode($password_e);
		
	//	echo $password_e.'<br>';
				?>
  <div class="" style="">
    <div class="span12">
      <div class="black-bg">User ID:</div>
      <div class="grey-bg"><?php echo $key['id'];?></div>
      <br>
      <div class="black-bg">Name:</div>
      <div class="grey-bg"><?php echo $key['firstname'].$key['middelname'].'&nbsp;'.$key['lastname'];?></div>
      <br>
      <div class="black-bg">Login Name:</div>
      <div class="grey-bg"><?php echo $key['username'];?></div>
      <br>
      <div class="black-bg">My Password:</div>
      <div class="grey-bg"><?php echo $password_e;?></div>
      <br>
      <div class="black-bg">SO,DO,WO:</div>
      <div class="grey-bg"><?php echo $key['sodowo'];?></div>
      <br>
      <div class="black-bg">Email:</div>
      <div class="grey-bg"><?php echo $key['email'];?></div>
      <br>
      <div class="black-bg">CNIC:</div>
      <div class="grey-bg"><?php echo $key['cnic'];?></div>
      <br>
    
    </div>
    
  </div>
   <?php } ?>
  <div class="clearfix"></div>
</section>

<!-- section 3 -->

<div class="clearfix"></div>
