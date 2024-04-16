  
   
  
  <!-- shadow -->
<div class="row-fluid my-wrapper">
 <br />
     
      <hr noshade="noshade" class="hr-5 float-left">
 
    <!--<form name="login-form" method="post" action="">-->
   
  
                <?php $form=$this->beginWidget('CActiveForm', array(
 'id'=>'member_login_form',
 'enableAjaxValidation'=>false,
  'enableClientValidation'=>true,
                'method' => 'POST',
                'clientOptions'=>array(
                     'validateOnSubmit'=>true,
                     'validateOnChange'=>true,
                     'validateOnType'=>false,
  ),
)); 

?>
    <table class="table table-striped table-new table-bordered" style="width:60%; font-size:14px;">



<tbody>


<?php	
	$connection = Yii::app()->db;
 $sql_page  = "SELECT mp.app_no,mp.member_id,mp.create_date,mp.plotno, m.name,m.sodowo,m.cnic, m.address,p.id,mp.plot_id,p.type,p.plot_detail_address,p.plot_size,p.image,s.street, j.project_name,size_cat.size,sectors.sector_name
FROM memberplot mp
left join members m on mp.member_id=m.id
left join plots p on mp.plot_id=p.id
left join streets s on p.street_id=s.id
left join size_cat size_cat on p.size2=size_cat.id
left join sectors sectors on p.sector=sectors.id 
left join projects j on s.project_id=j.id 

WHERE mp.id =".$_REQUEST['msid']."";
			$result_pages = $connection->createCommand($sql_page)->queryAll();
            $res=array();
          foreach($result_pages as $key){

   ?>
          <?php  echo '<tr><td colspan="2"><h4> Plot Current Detail</h4>
</td></tr>
		  <tr><td>Member Name</td><td><strong>'.$key['name'].'</strong></td></tr>
		  <tr><td>Project Name</td><td><strong>'.$key['project_name'].'</strong></td></tr>
		  <tr><td> Plot Membership #:</td><td><strong>';if(empty($key['plotno'])){echo 'Application # :'. $key['app_no'];}else{echo $key['plotno'];} echo'</strong></td></tr>
		  <tr><td> Plot Size:</td><td><strong>'.$key['size'].'&nbsp;('.$key['plot_size'].')</strong></td></tr>
	
		  <tr><td> Plot No:</td><td><strong>'.$key['plot_detail_address'].'</strong></td></tr><tr><td>Street/Lane:</td><td><strong>'.$key['street'].'</strong></td></tr>
		  <tr><td> Block:</td><td><strong>'.$key['sector_name'].'</strong></td></tr>';
		 
			
		?>

<?php }?>

</tbody>


 
</table>
<h4 style="color:#428BCA;">
   Membership Status Update
    </h4>    
<input value="<?php echo $_REQUEST['msid']; ?>" name="msid"  type="hidden"  />
<lable>Select status</lable></br>
<select name="status" id="status">
<option value="0">Normal   </option>
<option value="1">Warning  </option>
<option value="2">Blocked  </option>
<option value="3">Cancelled</option>

</select></br>
<lable>Select Type</lable></br>
<select name="type" id="type">
<option value="1">Non Payment</option>
<option value="2">Over Due Payment</option>
</select></br>
<lable>Detail</lable></br>
<textarea name="det" id="det"></textarea>
   <div id="error-div" style=" color:#F00;"></div>
            <?php echo CHtml::ajaxSubmitButton(
                               'Update Status' ,
    array('/member/msstupdate'),
                                array(  
                'beforeSend' => 'function(){ 
                                             $("#login").attr("disabled",true);
            }',
                                        'complete' => 'function(){ 
                                             $("#member_login_form").each(function(){ this.reset();});
                                             $("#login").attr("disabled",false);
                                        }',
                   'success'=>'function(data){  
                                           //  var obj = jQuery.parseJSON(data); 
                                            // View login errors!
        
                                             if(data == 1){
												// alert("we are here");
                                         location.href ="dashboard";
                                      }
          else{
                                                $("#error-div").show();
                                                $("#error-div").html(data);$("#error-div").append("");
												return false;
                                             }
 
                                        }' 
    ),
                         array("id"=>"login","class" => "btn btn-success") ); ?> 
    
    <!--  </form>-->
    <?php $this->endWidget(); ?>
          </div>
          
   
 
  </div>
 