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
 <div class="span8" >
    <table class="table table-striped table-new" style="width:100%; font-size:14px; float:left;">
<tbody>
</tbody>
<div class="row-fluid my-wrapper">
<h4 style="color:#428BCA;">
Remove Mortgage Request
    </h4>
<input value="<?php /// echo $_REQUEST['msid']; ?>" name="msid"  type="hidden"  />
<input value="<?php echo $_REQUEST['plot_id']; ?>" name="plot_id"  type="hidden"  />
<div class="float-left">
  <p class="reg-left-text">Status: <font color="#FF0000">*</font></p>
  <p class="reg-right-field-area margin-left-5">
  <select name="status" id="status" disabled="true" >
<?php
$connection=yii::app()->db;
 $qry="Select status,noc_nec from mortgaged_plots where plot_id='".$_REQUEST['plot_id']."'";
$res=$connection->CreateCommand($qry)->QueryRow();
if(!empty($res)){
	echo'<option value="'.$res['status'].'">';if($res['status']==1){ echo 'Mortgaged';}if($res['status']==2){ echo 'Under Process';}echo'</option>';
	}?>
<option value="1">Mortgaged</option>
<option value="2">Under Process</option>
</select>
  </p>
</div>
<div class="float-left">
  <p class="reg-left-text">NOC-NEC Staus: <font color="#FF0000">*</font></p>
  <p class="reg-right-field-area margin-left-5">
  <select name="noc_nec" id="noc_nec" disabled="true">
<?php

if(!empty($res)){
	echo'<option value="'.$res['noc_nec'].'">';if($res['noc_nec']==1){ echo 'Yes';}if($res['noc_nec']==2){ echo 'No';}echo'</option>';
	}?>
<option value="1">Yes</option>
<option value="2">No</option>
</select>
  </p>
</div>
<div class="float-left">
  <p class="reg-right-field-area margin-left-5">
  <div id="error-div" style=" color:#F00;"></div>
  </p>
</div>
</br>

     <?php echo CHtml::ajaxSubmitButton(
                               'Remove Request' ,
    array('rmv_mortg_req'),
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
</table>
</div>
<div class="span4">
    <table class="table table-striped table-new table-bordered" style="width:100%; font-size:14px;">
<tbody>
<?php
	$connection = Yii::app()->db;
 $sql_page  = "SELECT mortg.status,mortg.noc_nec,mortg.remarks,assoc.id as associd,mp.member_id,mp.app_no,mp.mstatus as stst,mp.plotno,mp.create_date,p.com_res,p.id,p.type,p.project_id,m.name,mp.plotno,m.image,m.sodowo,m.cnic,p.plot_detail_address,mp.plot_id,p.plot_size,p.project_id,p.street_id,p.status as pstatus,mp.id as msid,s.street,s.id,j.id,j.project_name,sec.sector_name,size_cat.size FROM mortgaged_plots mortg
 left join plots p on mortg.plot_id=p.id
 left join memberplot mp on mp.plot_id=p.id
 left join members m on mp.member_id=m.id
 left join associates assoc on mp.id=assoc.msid
 left join sectors sec on sec.id=p.sector
 left join size_cat size_cat on size_cat.id=p.size2
 left join streets s on p.street_id=s.id
 left join projects j on p.project_id=j.id

WHERE mortg.plot_id =".$_REQUEST['plot_id']." ";
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
