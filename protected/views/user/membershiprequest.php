<?php header('Cache-Control: max-age=900'); ?>
<?php 
$address= $_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl;;
?>
<script>	
 $(function(){
	  var stat=$("#status").val();
 $.ajax({
	     url:"https://<?php echo $address ?>/index.php/user/membershiprequest1",
                  type:"POST",
                  data:"actionfunction=showData&page=1&status="+stat,
        cache: false,
        success: function(response){
		   
		  $('#error-div').html(response);
		}
	   });
    $('#error-div').on('click','.page-numbers',function(){
       $page = $(this).attr('href');
	   $pageind = $page.indexOf('page=');
	   $page = $page.substring(($pageind+5));
	   $.ajax({
	     url:"https://<?php echo $address ?>/index.php/user/membershiprequest1",
                  type:"POST",
                data:$("#user_login_form").serialize()+"&&page="+$page,
			  //    data:"actionfunction=showData&page="+$page+"&status="+stat,
        cache: false,
        success: function(response){
		  $('#error-div').html(response);
		}
	   });
	return false;
	});
});
</script>
<div class="shadow">

  <div class="span5">
  <h3>Membership Request List</h3>
 </div>
 <div  class="span7" style="margin-top:15px;">
 
<a href="<?php echo Yii::app()->baseUrl;?>/index.php/member/newsletter_lis1"><input style="float:right; height:35px;" class="btn" value="Members Directory(With No Property)" type="button"></a>
<a href="<?php echo Yii::app()->baseUrl;?>/index.php/member/newsletter_lis"><input style="float:right; height:35px;" class="btn" value="Members Directory(With Property)" type="button"></a>&nbsp;
<a href="<?php echo Yii::app()->baseUrl;?>/index.php/member/active_lis"><input style="float:right; height:35px;" class="btn" value="Active Members Directory" type="button"></a>&nbsp;
<a href="<?php echo Yii::app()->baseUrl;?>/index.php/member/associate_lis"><input style="float:right; height:35px;" class="btn" value="Associate Members" type="button"></a>&nbsp;
</div>
 <div class="span5 pull-right wc-text">



<span style="float:right"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/member/register"  class="btn-info button">Add New Member </a></span>

</div>

</div>


<style>
.btn{
	line-height: 12px;
    margin-bottom: 0;
    padding: 3px 12px;
	}
</style>
<!-- shadow -->

<hr noshade="noshade" class="hr-5 ">



<section class="reg-section margin-top-30">

<?php 

$pages_data = Yii::app()->session['pages_array'];

?>



		
<?php $form=$this->beginWidget('CActiveForm', array(

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
<div id="" class="errorMessage" style="display: none; color:#F00; font-weight:bold;"></div>


<div class="float-left">
<input type="text" value="" name="name" id="name" class="new-input" placeholder="Enter Name" />
 <input type="text" value="" name="cnic" id="cnic" class="new-input" placeholder="CNIC" />

<select name="status" id="status">
<option value="1">Active</option>

<option value="0">In-active</option>

<option value="2">Transfer Request(Members)</option>



</select>
<lable>Dealers</lable>
<input type="checkbox" value="Dealer" name="mtype" id="mtype" class="new-input" />



<?php echo CHtml::ajaxSubmitButton(
                                'Search',
    array('user/membershiprequest1/?page=1'),
                                array(  
                'beforeSend' => 'function(){ 
                                             $("#login").attr("disabled",true);
            }',

                                        'complete' => 'function(){ 
                                             $("#user_login_form").each(function(){});
                                             $("#login").attr("disabled",false);
                                        }',
                   'success'=>'function(data){  
                                           //  var obj = jQuery.parseJSON(data); 
                                            // View login errors!
                                             if(data == 1){
												// alert("we are here");
                                         location.href = "https://rdlpk.com/index.php/user/dashboard";
                                      }
          else{
                                                $("#error-div").show();
                                                $("#error-div").html(data);$("#error-div").append("");
												return false;
                                             }
                                        }' 
    ),
                         array("id"=>"login","class" => "btn")      
                ); ?>

<?php $this->endWidget(); ?>

</div>


 

  <div class="float-left">

	<table class="table table-striped table-new table-bordered" style="font-size:12px;">

    <thead style="background:#666; border-color:#ccc; color:#fff;"><tr><th width="2%">id</th><th width="8%">Name</th><th width="8%">Father/Spouse</th><th width="9%">CNIC</th><th width="16%">Address</th><th width="12%">Image</th><th width="5%">Status</th><th width="8%">Security Status</th>
    <th width="4%">Action</th><th width="14%">Update Username/Password</th><tr></thead>

			

		
  <tbody id="error-div">


  	</table>

  </div>

 

 <!-- <a href="#" class="register-btn margin-left-144"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/register-btn.png" alt="nav" title="Register"></a>-->

 <?php //$this->endWidget(); ?>

 

 

 

 

<!-- section 3 --> 

