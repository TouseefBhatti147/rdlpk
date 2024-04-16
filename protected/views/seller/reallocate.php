 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<style>
.black-bg {
	background:#333; color:#fff; width:20%; height:25px; float:left; padding:5px 10px; margin:2px 0px;
	}
.grey-bg {

	background:#CCC; color:#000; width:32%; padding:5px 10px; float:left; margin:2px 0px; height:25px;
	}
.grey-bg1 {
	background:#CCC; color:#000; width:37%; padding:5px 10px; float:left; margin:2px 0px; height:25px;
	}	
input{ margin:0;}
select{margin:0;
color:#000;
height:27px;
 padding:5px;
 }		
.left-box {
	float:left;
	border:1px solid #ccc;
	padding:0 5px;
	margin:0 5px;
	}
.bot-box {
	background: none repeat scroll 0 0 #6699FF;
    border-radius: 10px;
    clear: both;
    color: #FFFFFF;
    height: 164px;
    margin: 30px auto;
    padding: 20px;
    position: relative;
    top: 30px;
    width: 55%;
	}
.new-box-01 {
    float: left;
    width: 50%;
	margin-bottom:40px;
}
</style>
<div class="shadow">
  <h4>Reallocate Plot</h4>
</div>
<!-- shadow -->
<hr noshade="noshade" class="">
 
<section class="reg-section margin-top-30">
<h5>Previous Information</h5>
<div id="error-div" class="errorMessage" style="display: none; color:#F00;"></div>

 
<?php $form=$this->beginWidget('CActiveForm', array(

 'id'=>'user_login_form',

 'enableAjaxValidation'=>false,

  'enableClientValidation'=>true,

                'method' => 'POST',
				'clientOptions'=>array(
			    'validateOnSubmit'=>true,
		        'validateOnChange'=>true,
	            'validateOnType'=>false,),
)); 

	$connection = Yii::app()->db;
			            $res=array();
            foreach($plots as $key){ ?>
			<input  type="hidden" id="project_id" name="project_id" value="<?php echo $key['project_id'];?>"/>
<input  type="hidden" id="id" name="id" value="<?php echo $key['id']; ?>"/>
 <div class="black-bg">Project Name:</div><div class="grey-bg"> <?php echo $key['project_name'];?></div>
 <div class="grey-bg1"></div>     
<div class="black-bg">Street:</div>
<div class="grey-bg"><?php echo $key['street'];?></div>
<div class="grey-bg1">
<select  name="street_id" id="street_id">
		    <?php $sql  = "SELECT * from streets where project_id='".$key['project_id']."'";
			$result = $connection->createCommand($sql)->query();
			foreach($result as $street){
echo '<option value="'.$street['id'].'">'.$street['street'].'
</option>';
      	}?>
</select></div>
 <div class="black-bg">Plot No:</div>
 <div class="grey-bg"> <?php echo $key['plot_detail_address'];?> </div>
 <div class="grey-bg1"><input placeholder="Enter Plot No" style="height:25px; padding:0;" type="text" name="plot_detail_address" id="plot_detail_address" class="reg-login-text-field" /></div>
 <div class="black-bg">Plot Diemension:</div>
 <div class="grey-bg"> <?php echo $key['plot_size'];?> </div>
<div class="grey-bg1"> <input style=" height:25px; padding:0;" type="text" placeholder="Enter Plot Size"  value="" name="plot_size" id="plot_size" class="reg-login-text-field" /></div>
 <div class="black-bg">Plot size:</div>
 <div class="grey-bg">  <?php echo $key['size'];?></div>
 <div class="grey-bg1"></div>
 <div class="black-bg">Plot Type:</div><div class="grey-bg"><?php echo $key['com_res'];?></div>
 <div class="grey-bg1"></div>
 <div class="black-bg">Sector:</div><div class="grey-bg"> <?php echo $key['sector'];?></div>
<div class="grey-bg1"> <input placeholder="Enter Plot Sector" style="height:25px; padding:0;"  id="sector" type="text" value="" name="sector"  class="reg-login-text-field" /></div>
 <div class="black-bg">Plot Price:</div>
 <div class="grey-bg"> <?php echo $key['price'];?> </div>
<div class="grey-bg1"> <input placeholder="Enter Plot Price"  style="height:25px; padding:0;"  id="price"  style="height:16px;" type="text" value="" name="price"  class="reg-login-text-field" /></div>
 <div class="black-bg">Construction Status:</div><div class="grey-bg"> <?php echo $key['cstatus'];?></div>
 <div class="grey-bg1"></div>
 <div class="black-bg">Plot Status:</div><div class="grey-bg"> <?php echo$key['status'];?></div>
 <div class="grey-bg1"></div>
 <?php }?> 
  <?php echo CHtml::ajaxSubmitButton(
                                'Reallocate',
    array('reallocation'),
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
      </div>



 </section>



<!-- section 3 --> 



