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
	     url:"http://<?php echo $address ?>/index.php/country/listreq",
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
	     url:"http://<?php echo $address ?>/index.php/country/listreq",
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
<span style="float:right"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/country/city"  class="btn-info button">Add New City</a></span>

</div>
<h3>Cities List</h3>



</div>
<!-- shadow -->



<hr noshade="noshade" class="hr-5 ">



<?php



$user_data = Yii::app()->session['user_array'];



?>
<div class="">
<p class="reg-right-field-area margin-left-5">

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
 	Country:<select name="country_id" id="country_id" style="width:250px;"><option value="">Select Country </option> 
	<?php	
            $res=array();
            foreach($country as $key){
            echo '<option value="'.$key['id'].'">'.$key['country'].'</option>'; 
            }?></select> 
    City:<input type="text" name="city_id" value="" placeholder="Enter City Name"  />
   
    
<?php echo CHtml::ajaxSubmitButton(

                                'Search',

     array('country/listreq/?page=1'),
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
<?php $this->endWidget(); ?>
 <table class="table table-striped table-new table-bordered">
            	<thead style="background:#666; border-color:#ccc; color:#fff;">
                  <tr>						
                        <th width="2%"> Id</th>
                         <th width="6%">Country Name</th>
                        <th width="6%">City Name</th>
                   
                        <th width="4%">Zip Code</th>                      
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







