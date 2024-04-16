 <!-- shadow -->
<div class="row-fluid my-wrapper">     
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

 <div class="span6" >
 <div id="error-div" class="errorMessage" style="display: none; color:#F00;"></div> 
    <table class="table table-striped table-new" style="width:100%; font-size:14px; float:left;">
<tbody>  
</tbody>
<div class="row-fluid my-wrapper">
<h4 style="color:#428BCA;">
   Add Family Detail
    </h4>  
    

   <div class="float-left">
    <p class="reg-left-text">Portion/Floor<font color="#FF0000">*</font></p>
  <p class="reg-right-field-area margin-left-5">  
   <select name="portion" id="portion"> 
   <option value="">Select Portion</option>
   <option value="Ground Floor">Ground Floor</option>
   <option value="1st Floor">1st Floor</option>
   </select>
   </p> 
   </div>
   <div class="float-left">
    <p class="reg-left-text">No. Of Members<font color="#FF0000">*</font></p>
  <p class="reg-right-field-area margin-left-5">  
     <input type="text" name="family_member" id="family_member" value="" />
   </p> 
   </div>
   <div class="float-left">
    <p class="reg-left-text">Living Type<font color="#FF0000">*</font></p>
  <p class="reg-right-field-area margin-left-5">  
   <select name="living_type" id="living_type"> 
   <option value="">Select Living Type</option>
   <option value="Rent">Rent</option>
   <option value="Self">Self</option>
   </select>
   </p> 
   </div>
    <br/>
<input value="<?php /// echo $_REQUEST['msid']; ?>" name="msid"  type="hidden"  />
<input value="<?php echo $_REQUEST['plot_id']; ?>" name="plot_id"  type="hidden"  />

   <div class="float-left">
    <p class="reg-left-text"><font color="#FF0000"></font></p>
  <p class="reg-right-field-area margin-left-5">  
     <?php echo CHtml::ajaxSubmitButton(
                               'Add Family' ,
    array('add_family_detail'),
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
   </p> 
   </div>
    
</table>
</div> 
<div class="span6">
    <table class="table table-striped table-new table-bordered" style="width:100%; font-size:14px;">
<tbody>
<?php	
	$connection = Yii::app()->db;
 $sql_page  = "SELECT mp.app_no,mp.member_id,mp.create_date,mp.plotno, m.name,m.sodowo,m.cnic, m.address,p.id,mp.plot_id,p.type,p.plot_detail_address,p.plot_size,p.image,s.street, j.project_name,size_cat.size,sectors.sector_name
FROM bcd bcd
left join plots p on bcd.plot_id=p.id
left join memberplot mp on mp.plot_id=p.id
left join members m on mp.member_id=m.id


left join streets s on p.street_id=s.id
left join size_cat size_cat on p.size2=size_cat.id
left join sectors sectors on p.sector=sectors.id 
left join projects j on s.project_id=j.id where p.id=".$_GET['plot_id']."";
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
         </div>
          
  </div>
 