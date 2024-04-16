
<div class="shadow">
  <h3>Edit Applicant</h3>
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
<?php $form=$this->beginWidget('CActiveForm', array(

 'id'=>'user_login_form',

 'enableAjaxValidation'=>false,

  'enableClientValidation'=>true,

                'method' => 'POST',
				'clientOptions'=>array(
			    'validateOnSubmit'=>true,
		        'validateOnChange'=>true,
	            'validateOnType'=>false,),
)); ?>
<div id="error-div" class="errorMessage" style="display: none; color:#F00;"></div>

<?php foreach($plot as $list1)
			{?>
<b>Project:</b><?php echo $list1['project_name']; ?><br />
<b>Size</b><?php echo $list1['size']; ?><br />
<b>MS #:</b><?php echo $list1['plotno']; ?><br />
<b>Name:</b><?php echo $list1['name']; ?><br />

<b>CNIC:</b><?php echo $list1['cnic']; ?><br />
<b>Email:</b><?php echo $list1['email']; ?><br />
<b>Phone #:</b><?php echo $list1['phone']; ?><br /><br /><br />
  <div class="clearfix"></div>
  <input type="hidden" name="mid" value="<?php echo $_REQUEST['mid']; ?>"  />   
   <input type="hidden" name="pid" value="<?php echo $_REQUEST['pid']; ?>"  />   
  <div class="float-left">
    <p class="left-text">Status:</p>
    <p class="right-field-area margin-left-5">
      <select name="status" >
      <option value="<?php echo $list1['bstatus']; ?>"><?php echo $list1['bstatus']; ?></option>
      <option value="open">Open</option>
     <option value="reserve">Reserve</option>
      </select>
    
    </p>
  </div>
  <div class=s"float-left">
    <p class="left-text">Sectors:</p>
    <p class="right-field-area margin-left-5">
    <select name="sector_id" >
    <option value="<?php echo $list1['sid']; ?>"><?php echo $list1['sector_name']; ?></option> 
	<?php }?>
	<?php 
		$connection = Yii::app()->db;  
		$sector  = "SELECT * from sectors";
		$sectors = $connection->createCommand($sector)->queryAll();
		foreach($sectors as $row){
		echo '<option value="'.$row['id'].'">'.$row['sector_name'].'</option>';
		}
    ?>
    </select>
    </p>
  </div>
   <p class="reg-left-text">Category<font color="#FF0000">*</font></p>


  <div class="float-left" >
<?php $plotcat=array(); 
//$plotcat='new';
?>
<span style="font-weight:bold;"><?php foreach($cat as $row5){ $plotcat[]= $row5['name']; }
//echo $plotcat;exit;

?></span> 
   <!--<input type="text" value="" name="category" id="category" class="reg-login-text-field" />-->




  </div>


 <?php 
 
	

	$res=array();

	$i = 1;

	foreach($categories as $key1)

	{

	if(in_array($key1['name'],$plotcat)){

	echo'<div class="cat">

    <input id="cat" name="'.$i.'" type="checkbox" value="'.$key1['id'].' " checked/>

	<label for="checkbox">'.$key1['name'].'</label>

	<label><img src="'.Yii::app()->request->baseUrl.'/images/category/'.$key1['sign'].'"></label>

	



	</div>';
	}else{
		
	echo'<div class="cat">

    <input id="cat" name="'.$i.'" type="checkbox" value="'.$key1['id'].' " />

	<label for="checkbox">'.$key1['name'].'</label>

	<label><img src="'.Yii::app()->request->baseUrl.'/images/category/'.$key1['sign'].'"></label>

	



	</div>';
		}
	

	$i++;

	}

	?>

 



  
  <?php echo CHtml::ajaxSubmitButton(

                                'Edit Applicant',

    array('editmemberform'),

                                array(  

                'beforeSend' => 'function(){ 

                                             $("#submit").attr("disabled",true);

            }',

                                        'complete' => 'function(){ 

                                             $("#user_login_form").each(function(){ });

                                             $("#submit").attr("disabled",false);

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

                         array("id"=>"login","class" => "btn-info pull-right")      

                ); ?>

  <?php $this->endWidget(); ?>
</section>

