<?php 
$address= $_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl;;
?>
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> 

<script>	
$(function(){
	  var project_name=$("#project").val();	
 $.ajax({
	     url:"http://<?php echo $address ?>/index.php/web/searchreq",
                  type:"POST",
                data:$("#user_login_form").serialize() + "&&page=1",
        cache: false,
        success: function(response){
		     $('#loading').hide();
		  $('#error-div').html(response);
		}
	   });
    $('#error-div').on('click','.page-numbers',function(){
       $page = $(this).attr('href');
	   $pageind = $page.indexOf('page=');
	   $page = $page.substring(($pageind+5));
	   $.ajax({
	     url:"http://<?php echo $address ?>/index.php/web/searchreq",
                  type:"POST",
                //  data:"actionfunction=showData&page="+$page,
          data:$("#user_login_form").serialize()+"&&page="+$page,
		cache: false,
        success: function(response){
			  $('#loading').hide();
		  $('#error-div').html(response);
		}
	   });
	return false;
	});
}); 
</script>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <div class="my-content">
    <div class="row-fluid">
      <div class="span12">
                <!-- breadcrumbs --> 
        
        
<div class="shadow">
  <h3>Available Plots List </h3>
</div>

<!-- shadow -->
<hr noshade="noshade" class="hr-5">

<section class="reg-section margin-top-30">
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

  <table style="font-size:16px;" class="table table-striped table-new table-bordered">

<tr><td>

<select class="form-control"  name="project" id="project" style="float:left;">
<?php	
	if($pro!=''){echo '<option value="'.$pro.'">'.$pro.'</option>'; }else{
				}
            $res=array();
			foreach($projects as $key){
            echo '<option value="'.$key['id'].'">'.$key['project_name'].'</option>'; 
            }?>
</select>
</td><td>
<select name="com_res" class="form-control" id="com_res"  style="float:left;">
<option value="">Select Property Type</option>
<option value="Res">Residential</option>
<option value="Com">Commercial</option>
</select>
</td>
<td>
<select class="form-control" name="size" id="size"  style="float:left;">
<?php 
			if(!empty($size)){echo '<option value="'.$size.'">'.$size.'</option>'; }else{
				echo '<option value="">Select Size</option>';
				}
			$res=array();
            foreach($sizes as $siz){
            echo '<option value="'.$siz['id'].'">'.$siz['size'].'</option>'; 
            }?>
</select>
</td>
<!--<img id="loading"  src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif">
--> 
<td>
<?php echo CHtml::ajaxSubmitButton(

                                'Search',

     array('/web/searchreqbook/?page=1'),
                                array(  

                'beforeSend' => 'function(){ 

                                             $("#login").attr("disabled",true);
											  $("#loading").show();

            }',

                                        'complete' => 'function(){ 

                                             $("#user_login_form").each(function(){});
												 
                                             $("#login").attr("disabled",false);
											 $("#loading").hide();

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

                         array("id"=>"login","class" => "btn btn-info")      

                ); ?> 

<!--  </form>-->

<?php $this->endWidget(); ?>
</td>
</tr>
</table>


</div>

<div class="">
<table style="font-size:14px;" class="table table-striped table-new table-bordered">
<thead style="background:#666; border-color:#ccc; color:#fff;">
<tr>
<th width="3%"> Sr. No</th>
<th width="7%"> Membership #</th>
<th width="8%">Project</th>
<th width="5%">Plot Size</th>
<th width="6%">Type</th>
<th width="4%">Plot No</th>
<th width="4%">Street</th>
<th width="4%">Sector</th>
<th width="4%">Price</th>
<th width="5%">Status</th>
<th width="5%">Sketch/Map/Image</th>
<th width="7%">Action</th>
</tr>
</thead>
<tbody id="error-div">
</tbody>
</table>
</section>
<!-- section 3 --> 
 </div>
    </div>
  </div>