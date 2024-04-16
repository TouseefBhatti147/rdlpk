<?php 
$address= $_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl;
?><script>	
 $(function(){
	  var project_name=$("#project").val();	
 $.ajax({
	     url:"http://<?php echo $address ?>/index.php/banks/bankslistreq",
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
	     url:"http://<?php echo $address ?>/index.php/banks/bankslistreq",
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





<div class="my-content">

    	

        <div class="row-fluid my-wrapper">

<div class="shadow">

 <div class="span5 pull-right wc-text">



<span style="float:right"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/banks/bank"  class="btn-info button">Add New Bank</a></span>

</div>

  <h3>Banks List</h3>

</div>

<!-- shadow -->

<hr noshade="noshade" class="hr-5 float-left">

<?php

$user_data = Yii::app()->session['user_array'];

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


 <div class="clear-fix"></div>
 	Project:<select name="project_id" id="project_id" style="width:250px;"><option value="">Select Project </option> 
	<?php	
            $res=array();
            foreach($projects as $key1){
            echo '<option value="'.$key1['id'].'">'.$key1['project_name'].'</option>'; 
            }?></select> 
<?php echo CHtml::ajaxSubmitButton(

                                'Search',

     array('banks/bankslistreq/?page=1'),
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

  
<div class="float-left">

    <p class="reg-right-field-area margin-left-5">

    <table class="table table-striped table-new table-bordered">
<thead style="background:#666; border-color:#ccc; color:#fff;">
                  <tr>						
                        <th width="2%"> Id</th>
                         <th width="4%">Bank Name</th>
                        <th width="6%">Project Name</th>
                        <th width="4%">Code</th>
                           <th width="11%">Detail</th>    
						<th width="4%">Action</th>
                        </tr>
</thead>
 <tbody id="error-div">  

                </tbody>
                
                
     	
  
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

 