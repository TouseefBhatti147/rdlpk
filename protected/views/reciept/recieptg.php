<div class="">
<div class="shadow">
  <h3>Add Receipt No.</h3>
</div>
<script>function active(val){ document.getElementById(val).disabled = false;}</script>
<!-- shadow -->
<hr noshade="noshade" class="hr-5 ">
<section class="reg-section margin-top-30">
<div id="error-div" style="color:#F00; font-weight:700"></div>
<?php $form=$this->beginWidget('CActiveForm', array(
 'id'=>'user_login_form',
 'enableAjaxValidation'=>false,
  'enableClientValidation'=>true,
                'method' => 'POST',
                'clientOptions'=>array(
                     'validateOnSubmit'=>true,
                     'validateOnChange'=>true,
                     'validateOnType'=>false,),)); ?>
<?php 

				$connection = Yii::app()->db;
				$r  = "SELECT * FROM receipt where id='".$_REQUEST['id']."'";
				$result_r = $connection->createCommand($r)->queryRow();
				$r2  = "SELECT max(r_no) FROM rpt_print";
				$result_r2 = $connection->createCommand($r2)->queryRow();
				
				$sql_plot12  = "
				SELECT plot_id FROM installpayment where r_id='".$_REQUEST['id']."'
				UNION DISTINCT 
				SELECT plot_id FROM plotpayment where r_id='".$_REQUEST['id']."'";
				$result_plots12 = $connection->createCommand($sql_plot12)->queryAll();
				$i=0;
				
				echo '<h5>Please Provide '.count($result_plots12).' Receipts Serial No.  </h5>';
				$auto=$result_r2['max(r_no)'];
				foreach($result_plots12 as $new){
				$val='';
				$r1  = "SELECT * FROM rpt_print where msid='".$new['plot_id']."' and rid='".$_REQUEST['id']."'";
				$result_r1 = $connection->createCommand($r1)->queryRow();
				$val=$result_r1['r_no'];
				$sty='';
				if($val > 0){$sty='disabled="disabled"';}
				if($val==0){$auto=$auto+1;}
				$newno=0;
				if($val==0){$newno=$auto;}else{$newno=$val;}
				echo '<input type="text"  '.$sty.' value="'.$newno.'" name="'.$new['plot_id'].'" id="'.$new['plot_id'].'" placeholder="Please Enter Receipt No."/>';
				if($sty!==''){echo '<button type="button" onclick="active('.$new['plot_id'].')" class="btn" disabled="disabled">Edit</button>
				
				 ';}			
echo '</br>';	
				}
			echo '<input type="hidden" name="rid" value="'.$_REQUEST['id'].'"/>';
	
?>

 <?php echo CHtml::ajaxSubmitButton(
                                'Update Receipt No.', array('/reciept/Gensub'),
                                array(  
                							'beforeSend' => 'function(){ $("#login").attr("disabled",true); }',
                                        	'complete' => 'function(){ 
                                            $("#user_login_form").each(function(){});
                                            $("#login").attr("disabled",false); }',
                   							'success'=>'function(data){  if(data == 5){
					                   		location.href = "http://rdlpk.com/index.php/user/dashboard";
                                      		}else{
                                            $("#error-div").show();
                                            $("#error-div").html(data);$("#error-div").append("");
											return false;
                                            }}'),
                         array("id"=>"login","class" => "btn")); ?> 
<?php $this->endWidget(); ?>

<?php 

/* $connection = Yii::app()->db;
				$r  = "SELECT * FROM receipt where id='".$_REQUEST['id']."'";
				$result_r = $connection->createCommand($r)->queryRow();
				
				$sql_plot12  = "
				SELECT plot_id FROM installpayment where r_id='".$_REQUEST['id']."'
				UNION DISTINCT 
				SELECT plot_id FROM plotpayment where r_id='".$_REQUEST['id']."'";
				$result_plots12 = $connection->createCommand($sql_plot12)->queryAll();
				$rnumber  = "SELECT max(r_no) FROM rpt_print";
				$result_rnumber = $connection->createCommand($rnumber)->queryRow();
				$i=0;
				foreach($result_plots12 as $new){
				if($result_r['print']==''){
				
				$i++;
				$sql="INSERT into rpt_print SET msid='".$new['plot_id']."',rid='".$_REQUEST['id']."',r_no='".($result_rnumber['max(r_no)']+$i)."',create_date='".date('dd-mm-yy')."'";	 
        		$command = $connection -> createCommand($sql);
                $command -> execute();
					
					}else{
					$i++;
					$r1  = "SELECT * FROM rpt_print where msid='".$new['plot_id']."'";
					$result_r1 = $connection->createCommand($r1)->queryAll();
					//echo count($result_r1);exit;
					if(count($result_r1) == 0){
					$sql="INSERT into rpt_print SET msid='".$new['plot_id']."',rid='".$_REQUEST['id']."',r_no='".($result_rnumber['max(r_no)']+$i)."',create_date='".date('dd-mm-yy')."'";	 
        		$command = $connection -> createCommand($sql);
                $command -> execute();
				}}
				
						}
$sql1="Update receipt SET print=1 where id='".$_REQUEST['id']."'";	 
        		$command = $connection -> createCommand($sql1);
                $command -> execute(); 
 */?>			 
