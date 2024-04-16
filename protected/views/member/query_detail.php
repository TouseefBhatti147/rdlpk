
<style>

.black-bg {
	background:#333; color:#fff; width:20%; float:left; padding:5px 10px; margin:2px 0px;
	}

.grey-bg {
	background:#CCC; color:#000; width:71%; padding:5px 10px; float:left; margin:2px 0px;
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
  <h3>Query Detail</h3>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5 float-left">
<section class="reg-section margin-top-30">
<

<?php	
            $res=array();
            foreach($querydetail as $key){
            echo '
           


<div class="span12" style="">
  <h5 style="text-align:left;">Query</h5> 	
  <div class="float-left">
  	<div class="black-bg">User Id:</div><div class="grey-bg">'.$key['user_id'].'</div><br>
   <div class="black-bg">Subject:</div><div class="grey-bg">'.$key['subject'].'</div>
    <br>
  	<div class="black-bg">Mesage:</div><div class="grey-bg">'.$key['message'].'</div>
    <br>
  	 </div>

</div>

' ;}?>
 <!-- <a href="#" class="register-btn margin-left-144"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/register-btn.png" alt="nav" title="Register"></a>-->

 <div class="clearfix"></div>

 
 </section>
<!-- section 3 --> 
 <div class="clearfix"></div>