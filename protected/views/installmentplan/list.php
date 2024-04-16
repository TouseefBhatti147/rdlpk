<?php 

$address= $_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl;

?>

<style>

.wc-text .btn-info {

padding:10px 15px;

border-radius:5px;

color:#fff;

text-decoration:none;

}

.wc-text .btn-info:hover {

background:#09F;

}

</style>

<script>	

 $(function(){

	  var project_name=$("#project").val();	

 $.ajax({

	     url:"http://<?php echo $address ?>/index.php/installmentplan/listreq",

                  type:"POST",

                data:"actionfunction=showData&page=1&project_name="+project_name,

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

	     url:"http://<?php echo $address ?>/index.php/installmentplan/listreq",

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

<div class="my-content">

<div class="row-fluid my-wrapper">

<div class="shadow">

<div class="span5 pull-right wc-text">

<span style="float:right"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/installmentplan/installmentplan"  class="btn-info button">Add New Plan</a></span>



</div>

<h3>Installment Plan List</h3>







</div>



 <?php /*



if($_REQUEST['note']!=''){echo '<div><p style="color: white;



background: rgb(94, 94, 255);



padding: 13px;



border-radius: 10px;



width: 387px;



opacity: 0.7;



font-weight: bold;">New Record Inserted Successfully</p></div>';}



*/



?>



<!-- shadow -->







<hr noshade="noshade" class="hr-5 ">







<?php







$user_data = Yii::app()->session['user_array'];







?>

<div class="">

<p class="reg-right-field-area margin-left-5">

<form action="list" method="post"> 

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









  <div class="clear-fix"></div>

 	Project:<select name="project_id" id="project_id" style="width:250px;"><option value="">Select Project </option> 

	<?php	

            $res=array();

            foreach($projects as $key1){

            echo '<option value="'.$key1['id'].'">'.$key1['project_name'].'</option>'; 

            }?></select> 

              <span>Size:</span>

    <select name="size" id="size"  style="width:180px;">

	

			<option value="">Select Size</option>

	<?php 

			

						$res=array();

            foreach($size as $siz){

            echo '<option value="'.$siz['id'].'">'.$siz['size'].'</option>'; 

            }?></select> 
 <select name="p_type" id="p_type"  style="width:180px;">
			<option value="">Select Property Type</option>
			<option value="R">Residential</option>
            <option value="C"> Commercial</option>
            </select> 



<?php echo CHtml::ajaxSubmitButton(



                                'Search',



     array('installmentplan/listreq/?page=1'),

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



                         array("id"=>"login","class" => "btn btn-info")      



                ); ?>



  







<!--  </form>-->



<?php $this->endWidget(); ?>

 <table class="table table-striped table-new table-bordered">

            	<thead style="background:#666; border-color:#ccc; color:#fff;">

                  <tr>						

                        <th width="2%"> Id</th>

                        <th width="6%">Project Name</th>

                        <th width="4%">Size</th>
						 <th width="5%">Property Type</th>
                        <th width="11%">Plan Description</th>

                        <th width="4%">Totaol No.</th>

                         <th width="4%">Total Amount</th>                           

						<th width="4%">Action</th>

                        </tr>

</thead>

 <tbody id="error-div">

                </tbody>



<?php

/*$res=array();

foreach($streets as $key){

echo '<tr><td>'.$key['id'].'</td><td>'.$key['project_name'].'</td><td>'.$key['size'].'</td><td>'.$key['description'].'</td><td>'.$key['tno'].'</td><td style="text-align:right;">'.$key['tamount'].'</td><td><a target="_blank" href="'.Yii::app()->request->baseUrl.'/index.php/installmentplan/update?id='.$key['id'].'">Edit</a><a  href="'.Yii::app()->request->baseUrl.'/index.php/installmentplan/Delete?id='.$key['id'].'">/Delete</a></td></tr>';

}*/



?>



</table>



</p>

<div class="clearfix"></div>

</div>

</div>

<script>

$(document).ready(function()

{

$("#project").change(function()

{

select_street($(this).val());

});

$("#street_id").change(function()

{

select_plot($(this).val());

});

});



function select_street(id)

{

$.ajax({







type: "POST",







url:    "ajaxRequest?val1="+id,







contenetType:"json",







success: function(jsonList){var json = $.parseJSON(jsonList);







var listItems='';







$(json).each(function(i,val){







listItems+= "<option value='" + val.id + "'>" + val.street + "</option>";















});listItems+="";















$("#street_id").html(listItems);







}







});







}















































function select_plot(id)







{







$.ajax({







type: "POST",







url:    "ajaxRequest1?val1="+id,







contenetType:"json",







success: function(jsonList){var json = $.parseJSON(jsonList);















var listItems='';







$(json).each(function(i,val){







listItems+= "<option value='" + val.id + "'>" + val.plot_detail_address +" ("+val.plot_size+")</option>";















});listItems+="";















$("#plot_id").html(listItems);







}







});







}















</script>















