<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
<link rel="stylesheet" href="//code.jquery.com/ui/1.8.10/themes/smoothness/jquery-ui.css" type="text/css">
<script type="text/javascript" src="//ajax.aspnetcdn.com/ajax/jquery.ui/1.8.10/jquery-ui.min.js"></script>
<?php
$address= $_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl;;
?>
<script>
 $(function(){
        $('#loading').hide();
	  var project=$("#project").val();
  //$("#loading").show();
	   $.ajax({
	         
	     url:"https://<?php echo $address ?>/index.php/plots/searchunsoldr1",
                  type:"POST",
                data:$("#user_login_form").serialize() + "&&page=1&project="+project,
        cache: false,
       
        success: function(response){
        
		  $('#error-div').html(response);
		 //   $("#loading").hide();
		}
	   });
    $('#error-div').on('click','.page-numbers',function(){
       $page = $(this).attr('href');
	   $pageind = $page.indexOf('page=');
	   $page = $page.substring(($pageind+5));
	   $.ajax({
	     url:"https://<?php echo $address ?>/index.php/plots/searchunsoldr1",
                  type:"POST",
                //  data:"actionfunction=showData&page="+$page,
          data:$("#user_login_form").serialize()+"&&page="+$page,
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
<h3>Summary of Unsold Plots/Villas</h3>
</div>

<!-- shadow -->

<hr noshade="noshade" class="hr-5">
<section class="login-section margin-top-30">

<!--<form name="login-form" method="post" action="">-->
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
<span>Project:</span>
<select name="project" id="project" style="width:180px;">
<option value=""> Select Project</option>
<?php

            $res=array();
			foreach($projects as $key){
            echo '<option value="'.$key['id'].'">'.$key['project_name'].'</option>';
            }?>
</select>
<select name="com_res" id="com_res" style="width:180px;">
<option value="Residential">Residential</option>
<option value="Commercial">Commercial</option>
</select>
<img id="loading"  src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif">

<?php echo CHtml::ajaxSubmitButton(

                                'Search',

     array('/plots/searchunsoldr/?page=1'),
                                array(

                'beforeSend' => 'function(){

                                             $("#login").attr("disabled",true);
                                                $("#loading").show()

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
</section>
</div>

<!-- section 3 -->

<!--      <input type="text" value="" name="cnic" id="cnic" class="new-input" placeholder="Enter Project Name" />

    -->

</form>
<div class="clearfix"></div>
<div class="">
<table class="table table-striped table-new table-bordered">
<thead style="background:#666; border-color:#ccc; color:#fff;">
<tr>
<th rowspan="2" width="5%" style="text-align:center">S.No</th>
<th rowspan="2" width="15%" style="text-align:center">Plot Categories</th>
<th rowspan="2" style="text-align:center">Total Unsold</th>
<th colspan="3" style="text-align:center">Reserved </th>
<th rowspan="2" style="text-align:center">Net Balance(Open)</th>
<th rowspan="2" width="20%" style="text-align:center;">Remarks</th>
</tr>
<tr>

<th style="text-align:center">HRL Reserved Plots</th>
<th style="text-align:center">Against Land Plots</th>
<th style="text-align:center">Villas</th>
</tr>
</thead>
<tbody id="error-div">
</tbody>
</table>
</div>
<hr noshade="noshade" class="hr-5 float-left">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
