<?php 
$address= $_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl;;
?>


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  

<script>	
 $(function(){
	  var project_name=$("#project_name").val();	
 $.ajax({
	     url:"http://<?php echo $address ?>/index.php/recovery/search_recoveries_cutdate_graph",
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
	     url:"http://<?php echo $address ?>/index.php/recovery/search_recoveries_cutdate_graph",
                  type:"POST",
                  data:$("#user_login_form").serialize()+"&&page="+$page,
				//  data:"actionfunction=showData&page="+$page,
        cache: false,
        success: function(response){
		  $('#error-div').html(response);    
		}
	   });
	return false;
	});
	   
});
</script>
<?php header('Cache-Control: max-age=900'); ?>

<div class="shadow">
  <h3>Recoveries Uptodate Graphical Reports</h3>
</div>

<!-- shadow -->

<hr noshade="noshade" class="hr-5">
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
  <select name="project_name" id="project_id" style="width:180px;">
  <option value="">Select Project</option>
    <?php	
	if(!empty($pro)){echo '<option value="'.$pro.'">'.$pro.'</option>'; }else{
				}
            $res=array();
            foreach($projects as $key){
            echo '<option value="'.$key['id'].'">'.$key['project_name'].'</option>'; 
            }?></select>
            Cut Date:<select name="cut_date" id="cut_date" style="width:180px;">
      <option value="">Select Cut Date</option>
    </select>
  <?php echo CHtml::ajaxSubmitButton(

                                'Search',

     array('recovery/search_recoveries_cutdate_graph/?page=1'),

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

												   $("#error-div1").show();

                                                $("#error-div1").html(data);$("#error-div1").append("");

												return false;

                                             }

 

                                        }' 

    ),

                         array("id"=>"login","class" => "login-btn")      

                ); ?> 
  
  
  <style>
  td{
	font-weight:bold;
	  
	  }
  </style>
  <?php $this->endWidget(); ?>
  </section>
<table class="table">
     <tbody id="error-div">
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</tbody>

</table>  
 <script>
//  $(document).ready(function()
  //   {  	
       $("#project_id").change(function()
           {
		   	select_cdate($(this).val());

		   });
		//});
		
function select_cdate(id)
{
	var project_id=$("#project_id").val();
$.ajax({
      type: "POST",
      url:    "ajaxRequestdate?project_id="+project_id,
	   // url:    "ajaxRequest2?pro="+pro+"&&sec="+sec,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
	var listItems='';
	//listItems+= "<option value=''>Select Cut Date</option>";
	$(json).each(function(i,val){
	listItems+= "<option value='" + val.cut_date + "'>" + val.cut_date + "</option>";


	//$(json).each(function(i,val){
	//alert(JSON.stringify(val));
//	$('#cut_date').val(val.cut_date);

	//listItems+= "<option value='" + val.id + "'>" + val.id + "</option>";
});listItems+="";
$("#cut_date").html(listItems);
          }
    });

}


</script> 

<!-- section 3 --> 

