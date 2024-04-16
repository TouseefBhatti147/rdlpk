
<div class="shadow">
  <h3>Add New Balloting</h3>
</div>
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
<section class="login-section margin-top-30" style="height:120px;">

<!--<form name="login-form" method="post" action="">-->
<?php 
 require_once('db.php'); 
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

<div id="error-div" class="errorMessage" style="display: none; color:#F00; font-weight:bold;"></div>
  <div class="float-left">
    <p class="left-text">Project:</p>
    <p class="right-field-area margin-left-5">
       <select name="project" id="project" width="300">
      <?php
   $connection = Yii::app()->db; 
		$temp_projects_array = Yii::app()->session['projects_array'];
		$num_of_projects_counter = count($temp_projects_array);	
		$num_of_projects_counter2 = $num_of_projects_counter;
		$sql1 =   "select * from projects where";
		$num_of_projects_counter--;
		while($num_of_projects_counter>-1)
		{
			$sql2[$num_of_projects_counter] = " id=".Yii::app()->session['projects_array'][$num_of_projects_counter]['project_id'];
			$num_of_projects_counter--;
		}
		
		$sql_project = $sql1;
		$sql_project = $sql_project.implode(' or',$sql2);
		
		
		$result_projects = $connection->createCommand($sql_project)->query() or mysql_error();
	foreach($result_projects as $list)
    {  echo '<option value="'.$list['id'].'">'.$list['project_name'].'</option>';
	}
      ?>
      </select>
    </p>
  </div>
  <div class="float-left">
    <p class="left-text">Plot Size</p>
    <p class="right-field-area margin-left-5">
      <select name="plot_size" id="plot_size" width="300">
      <?php
	   $sql_details  = "select * from size_cat";
			$result_details = $connection->createCommand($sql_details)->query();
    foreach($result_details as $list)
	{
	  echo '<option value="'.$list['id'].'">'.$list['size'].'</option>';
	  
	}
      ?>
      </select>
    </p>
  </div>
  
  <div class="float-left">
    <p class="left-text">Status:</p>
    <p class="right-field-area margin-left-5">
       <select name="status" id="status" width="300">
      <option>Open</option>
      <option>Drawn</option>
      <option>Freezed</option>
      </select>
    </p>
  </div>
  
  <div class="float-left">
    <p class="left-text">Description:</p>
    <p class="right-field-area margin-left-5">
      <input type="text" id="desc" name="desc" />
    </p>
  </div>
  <button type="submit" class="btn btn-success" id="login">Save New Balloting</button>
 <?php echo CHtml::ajaxSubmitButton(
                                '',
    array('/allotments/newballott'),
                                array(  
                'beforeSend' => 'function(){ 
                                             $("#login").attr("disabled",true);
            }',
                                        'complete' => 'function(){ 
                                             $("#user_login_form").each(function(){ this.reset();});
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
												return true;
                                             }
 
                                        }' 
    ),
                         array("id"=>"login","class" => "login-btn")      
                ); ?>
  

<!--  </form>-->
<?php $this->endWidget(); ?>

</section>
<!-- section 3 --> 
