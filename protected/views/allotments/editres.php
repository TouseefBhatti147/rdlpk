<div class="shadow">
   <h3>Edit Result</h3>
</div>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.js"></script>

<style>

.float-left {
    float: left;
    height: 80px;
    margin: 2px 3px;
    width: 274px;
}
select{ width:255px;}
input, textarea, .uneditable-input {
width: 244px;
}
</style>
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


<?php 
$connection = Yii::app()->db; 
$sql_memberas = "select p.*,projects.project_name,a.name,sectors.sector_name,a.cnic,a.sodowo,streets.street,size_cat.size,member_plot.id as resid,member_plot.plot_id FROM member_plot
	Left JOIN memberplot mp ON member_plot.ms_id=mp.id
	Left JOIN plots p ON p.id=member_plot.plot_id 
	Left JOIN projects ON projects.id=p.project_id
	Left JOIN streets ON streets.id=p.street_id
	Left JOIN sectors ON p.sector=sectors.id
	Left JOIN size_cat ON size_cat.id=p.size2
	Left JOIN members a ON a.id=mp.member_id
where member_plot.id='".$_REQUEST['resid']."'"; 
 $co = $connection->createCommand($sql_memberas)->queryRow();

?>






<div id="errorMessage" class="errorMessage" style="display: none; color:#F00; font-weight:bold;"></div>
  
<input type="hidden" name="resid" value="<?php echo $_REQUEST['resid'];?>" /></br>			 
<input type="text" value="<?php echo  $co['name'];?>" readonly="readonly" /></br>
<input type="text" value="<?php echo  $co['cnic'];?>" readonly="readonly"/></br>
<input type="text" value="<?php echo  $co['sodowo'];?>" readonly="readonly" /></br>

<select id="block" name="block" class="new-input">
<option value="">Select Sector</option>
<?php 
$connection = Yii::app()->db;  
		$sql_city  = "SELECT * from sectors";
		$result_city = $connection->createCommand($sql_city)->query();
foreach($result_city as $row){
	echo '<option value="'.$row['id'].'">'.$row['sector_name'].'</option>';
	}
?>
</select>
<select id="street" name="street" class="new-input">
</select>
<select id="plotss" name="plotss" class="new-input">
</select>
	 
 

 <?php echo CHtml::ajaxSubmitButton(

                                'Search',

     array('/allotments/editresq/'),
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

                                                $("#errorMessage").show();

                                                $("#errorMessage").html(data);$("#errorMessage").append("");

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









 

  


  </div>

  



 



 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> 

 

 
<script>
$(document).ready(function()
     {  	
	 $("#block").change(function()
           {
         	select_street($(this).val());
		   });
		   });
		   function select_street(id)

{
	var sec=$("#block").val();
$.ajax({
      type: "POST",
      url:    "ajaxRequest?sec="+sec,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var listItems='';
listItems+= "<option value=''>Select Street</option>";

	$(json).each(function(i,val){

	listItems+= "<option value='" + val.id + "'>" + val.street + "</option>";
});listItems+="";
$("#street").html(listItems);
          }

    });}
//select plot

$(document).ready(function()
     {  	
	 $("#street").change(function()
           {
         	select_plot($(this).val());
		   });
		   });
		   function select_plot(id)

{
	var sec=$("#street").val();
$.ajax({
      type: "POST",
      url:    "ajaxplot?sec="+sec,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var listItems='';
listItems+= "<option value=''>Select Plot</option>";

	$(json).each(function(i,val){

	listItems+= "<option value='" + val.id + "'>" + val.plot_detail_address + "</option>";
});listItems+="";
$("#plotss").html(listItems);
          }

    });}


</script>
 


<!-- section 3 --> 
