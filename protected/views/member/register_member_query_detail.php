<div class="container-fluid" style="font-size:12px; background:#FFF;">



<div class="row-fluid">
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
<hr noshade="noshade" class="hr-5 ">
<section class="reg-section margin-top-30" style="font-size:14px;">
<?php 

?>

<?php	
            $res=array();
            foreach($register_member_query_detail as $key){
            echo '
           


<div class="span12" style="">
   	
    <div class="">
  	<div class="black-bg">User Id:</div><div class="grey-bg">'.$key['user_id'].'</div>
	<br>
    <div class="black-bg">Subject:</div><div class="grey-bg">'.$key['title'].'</div>
    <br>
  	<div class="black-bg">Mesage:</div><div class="grey-bg">'.$key['message'].'</div>
    <br>
		<div class="black-bg">Date:</div><div class="grey-bg">'.$key['date'].'</div>
    <br>
	
  	 </div>
</div>
 <h5 style="text-align:right;">';}?>


   
 <div class="clearfix"></div>

 
 </section>
<!-- section 3 --> 
 <div class="clearfix"></div></div></div>