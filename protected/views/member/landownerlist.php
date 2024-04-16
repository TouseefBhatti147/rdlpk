<?php header('Cache-Control: max-age=900'); ?>
<?php 
$address= $_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl;;
?>
<script>	
 $(function(){
	  var stat=$("#status").val();
 $.ajax({
	     url:"http://<?php echo $address ?>/index.php/member/landownersearch",
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
	     url:"http://<?php echo $address ?>/index.php/member/landownersearch",
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
  <div class="span4">
  <h3>Landowner List</h3>
 </div>
 <div class="span5 pull-right wc-text">
<span style="float:right"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/member/add_landowner"  class="btn-info button">Add Land Owner </a></span>
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
<select name="status" id="status">
<option value="1">Active</option>
<option value="0">In-active</option>
</select>

<?php echo CHtml::ajaxSubmitButton(
                                'Search',
    array('member/landownersearch/?page=1'),
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
    <thead style="background:#666; border-color:#ccc; color:#fff;"><tr><th width="2%">id</th><th width="8%">Name</th><th width="8%">Title</th><th width="9%">Phone</th><th width="8%">Email</th>
    <th width="12%">Image</th><th width="5%">Status</th><th width="8%">Remarks</th><th width="10%">Project</th><th width="8%">Create Date</th>
    <th width="6%">Action</th><tr></thead>
  <tbody id="error-div">
  	</table>
  </div>
 