<?php 
$address= $_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl;;
?>
<script>	
 $(function(){
	  var project_name=$("#project_name").val();	
 $.ajax({
	     url:"http://<?php echo $address ?>/index.php/memberplot/searchposs",
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
	     url:"http://<?php echo $address ?>/index.php/memberplot/searchposs",
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
<div class="shadow">

  <h3>Possession Payment List</h3>

</div>

<!-- shadow -->

<hr noshade="noshade" class="hr-5 float-left">

<section class="reg-section margin-top-30">

<?php 
$pages_data = Yii::app()->session['pages_array'];
$form=$this->beginWidget('CActiveForm', array(

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

 <input type="text" value="" name="plotno" id="plotno" class="new-input" placeholder="Membeship #" />

 <input type="text" value="" name="name1" id="name" class="new-input" placeholder="Enter Name" />

 
    
	    	<select name="project_name" id="project_name" style="width:180px;"><?php	
	if(!empty($pro)){echo '<option value="'.$pro.'">'.$pro.'</option>'; }else{
				}
            $res=array();
            foreach($projects as $key){
            echo '<option value="'.$key['id'].'">'.$key['project_name'].'</option>'; 
            }?></select> 
 
                  
 <?php echo CHtml::ajaxSubmitButton(

                                'Search',

     array('memberplot/searchposs/?page=1'),

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

                         array("id"=>"login","class" => "login-btn")      

                ); ?>

  



<!--  </form>-->

<?php $this->endWidget(); ?>


	
  <div class="float-left">

	<table class="table table-striped table-new table-bordered">

    <thead style="background:#666; border-color:#ccc; color:#fff;"><tr><th width="3%">id</th><th width="6%">MS No.</th><th width="12%">Name</th><th width="5%">Plot Size</th><th width="5%">Plot No.</th><th  width="6%">Lane/Street</th><th width="3%">Block</th><th width="9%">Project Name</th><th width="5%">Possession Fee</th><th width="5%">Action</th><tr></thead>

			 <tbody id="error-div">

			<?php

			/*	

            $res=array();
			$i=0;
            foreach($plotdetails as $key){

				
		$i++;
            echo '<tr><td>'.$i.'</td><td>'.$key['plotno'].'</td><td><a href="memhistory?id='.$key['plot_id'].'">'.$key['name'].'</a></td><td>'.$key['size'].'&nbsp;('.$key['plot_size'].')</td><td><a href="plothistory?id='.$key['plot_id'].'">'.$key['plot_detail_address'].'</a></td><td>'.$key['street'].'</td><td>'.$key['sector_name'].'</td><td>'.$key['project_name'].'</td><td>'.$key['paidamount'].'</td><td><a href="req_detail?id='.$key['id'].'">View Request</a></td></tr>'; 

            }*/ ?>

            

  	</table>

  </div>

 

 

 

 

 </section>

<!-- section 3 --> 

