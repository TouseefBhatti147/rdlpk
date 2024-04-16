  
   
  
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
    <!--<form name="login-form" method="post" action="">-->
   
    <table class="table table-striped table-new" style="width:100%; font-size:14px; float:left;">
<tbody>  
</tbody>

<div class="row-fluid my-wrapper">
<h4 style="color:#428BCA;">
   Plot Status Update
    </h4>    
<input value="<?php echo $_REQUEST['msid']; ?>" name="msid"  type="hidden"  />
<input value="<?php echo $_REQUEST['plot_id']; ?>" name="plot_id"  type="hidden"  />
<lable>Select status</lable></br>
<select name="msstatus" id="msstatus">
<option value="0">Normal   </option>
<option value="1">Warning  </option>
<option value="2">Blocked  </option>


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
    array('msstupdate123'),
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
<div class="span6">
    <table class="table table-striped table-new table-bordered" style="width:100%; font-size:14px;">
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

WHERE mp.id =".$_REQUEST['msid']." ";
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
          
<div class="span12">
  <h3>Plot Status History</h3>
<table class="table table-striped table-new table-bordered" style="font-size:13px; font-weight:bold;">
            	<thead style="background:#666; border-color:#ccc; color:#fff;">
               
                    <tr>
                          <th width="1%">#</th>
						 <th width="5%">Membership/App No.</th>
                           <th width="5%">Status</th>
 						
                        <th width="5%">Type</th>
                        <th width="10%">Detail</th>
                        <th width="5%">User name</th>
                           <th width="5%">Date/Time</th>
                    </tr>
                </thead>
                <tbody>

             <?php 
			 $connection = Yii::app()->db;
 $mshistory  = "SELECT sh.user_id,u.username,sh.status,sh.detail,sh.status_date,mp.plotno,mp.plot_id,mp.app_no,sh.type,p.plot_detail_address,p.plot_size,p.image
FROM status_history sh
left join user u on sh.user_id=u.id
left join plots p on sh.plot_id=p.id
left join memberplot mp on p.id=mp.plot_id
left join streets s on p.street_id=s.id
left join size_cat size_cat on p.size2=size_cat.id
left join sectors sectors on p.sector=sectors.id 
 

WHERE sh.plot_id =".$_REQUEST['plot_id']." ORDER BY sh.id DESC";
	$result = $connection->createCommand($mshistory)->queryAll(); 
	$co=0;
	 foreach($result as $sh){
		$co++;	 echo '<tr><td width="1%">'.$co.'</td><td>';if(empty($key['plotno'])){echo 'Application # :'. $key['app_no'];}else{echo $key['plotno'];}echo'</td><td>';
		if($sh['status']==0)
		{ echo'<span style="color:green">Normal</span>';}
		elseif($sh['status']==1)
		{echo'<span style="color:orange">Warning</span>';}
		elseif($sh['status']==2){echo'<span style="color:red"> Blocked</span>';}
		elseif($sh['status']==3){echo'<span style="color:red">Cancelled</span>';}
		
		
		echo'</td><td>';
		if($sh['type']==1){echo'Non Payment';}elseif($sh['type']==2){echo'Overdue Payment';}
		echo'</td><td>'.$sh['detail'].'</td><td>'.$sh['username'].'</td><td>'.date('d-F-Y',strtotime($sh['status_date'])).'</td></tr>';
	}
            ?>

                </tbody>

            </table>
</div>
  </div>
 