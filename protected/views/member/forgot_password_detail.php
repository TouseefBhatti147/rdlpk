

<style>



.black-bg {

	background:#333; color:#fff; width:20%; float:left; padding:5px 10px; margin:2px 0px;

	}



.grey-bg {

	background:#CCC; color:#000; width:71%; padding:5px 10px; float:left; height:20px; margin:2px 0px;

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

  <h3>Forgot Account Password Detail</h3>

</div>

<!-- shadow -->

<hr noshade="noshade" class="hr-5">

<section class="reg-section margin-top-30">



<?php	

            $res=array();

            foreach($forgot_password_detail as $key){

            echo '

           





<div class="span12" style="">

  <h5 style="text-align:left;">Query</h5> 	

  <div class="">

  	<div class="black-bg">Email:</div><div class="grey-bg">'.$key['email'].'</div><br>

  
  <div class="black-bg">CNIC:</div><div class="grey-bg">'.$key['cnic'].'</div>

    <br>
 	<div class="black-bg">Mesage:</div><div class="grey-bg">'.$key['message'].'</div>
    <br>
 	<div class="black-bg">Date:</div><div class="grey-bg">'.$key['create_date'].'</div>
    <br>

  	 </div>



</div>' ;?>

<span><a href="<?php echo Yii::app()->request->baseUrl ?>/index.php/member/fp_send_mail?mid=<?php echo $_REQUEST['mid'];?>&&id=<?php echo $key['id']; ?>">Reply</h5></a></span>

<?php }?>



   

 <div class="clearfix"></div>



 

 </section>

<!-- section 3 --> 

 <div class="clearfix"></div>