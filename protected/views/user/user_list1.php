<?php header('Cache-Control: max-age=900'); ?>
<?php 
$address= $_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl;;
?>
<script>	
 $(function(){
	  var stat=$("#status").val();
 $.ajax({
	     url:"http://<?php echo $address ?>/index.php/user/searchuser",
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
	     url:"http://<?php echo $address ?>/index.php/user/searchuser",
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
<div class="span6">
  <h3>User List</h3>
 </div>
 <div  class="span6" style="margin-top:15px;">
 
<a href="<?php echo Yii::app()->baseUrl;?>/index.php/user/Add_user"><input style="float:right; height:35px;" class="btn" value="Add User" type="button"></a>&nbsp;

<a href="<?php echo Yii::app()->baseUrl;?>/index.php/user/active_lis"><input style="float:right; height:35px;" class="btn" value="Active User Directory" type="button"></a>&nbsp;

</div>
 <div class="span5 pull-right wc-text">




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
<input type="text" value="" name="username" id="username" class="new-input" placeholder="Enter Username" />

<select name="status" id="status">

<option value="1">Active</option>

<option value="0">In-active</option>

</select>


<?php echo CHtml::ajaxSubmitButton(
                                'Search',
    array('user/searchuser/?page=1'),
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
                                         location.href = "http://rdlpk.com/index.php/user/dashboard";
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

    <thead style="background:#666; border-color:#ccc; color:#fff;"><tr>
   
     <th width="2%">User Id</th>  
                        <th width="5%">Name</th>              
                        <th width="4%">Middle Name</th>
  						 <th width="4%">Last Name</th>
                        <th width="6%">Login Name</th>
                        <th width="9%">Father/Spouse</th>						
                        <th width="7%">Status</th>
                         <th width="4%">Create Date</th>
                         <th width="4%">Action</th>	
   <tr></thead>

			

		
  <tbody id="error-div">


  	</table>

  </div>


 

 

 

 

<!-- section 3 --> 

