<h3>Plot Information</h3>



<table class="table table-striped table-new table-bordered" style="width:40%;">



<tbody>

<h4> Plot Information</h4>

<?php	

$co=1;
$co1=1;

            $res=array();



            foreach($pages as $key){

  $image=$key['image'];

  

   ?>

  

<div style=" border:1px solid;float:right; height:200px;width:200px;">



<img alt="this plot has no image" src="<?php echo Yii::app()->request->baseUrl.'/images/plots/'.$key['image'];?>" /></div>



          <?php  echo '
		  <tr><td>Project Name</td><td><strong>'.$key['project_name'].'</strong></td></tr>
		  <tr><td> Plot Membership #:</td><td><strong>'.$key['plotno'].'</strong></td></tr>
		  <tr><td> Plot Size:</td><td><strong>'.$key['size'].'&nbsp;('.$key['plot_size'].')</strong></td></tr>
	
		  <tr><td> Plot No:</td><td><strong>'.$key['plot_detail_address'].'</strong></td></tr><tr><td>Street/Lane:</td><td><strong>'.$key['street'].'</strong></td></tr>
		  <tr><td> Block:</td><td><strong>'.$key['sector_name'].'</strong></td></tr>';
		  
		  echo'<tr><td> Plot Features:</td><td><strong>';foreach($primeloc as $prime){ 
			  if(empty($prime['title'])){
				   echo'Normal';
				   }else{ echo $prime['title'].',';
			  }} echo'</strong></td></tr>';
		  
		?>



</tbody>


 
</table>			

<table class="table table-striped table-new table-bordered" style="width:40%;">

<h4>Plot Information(Previous:Before Reallocation)</h4>

<tbody>

<?php

            $res1=array();

$image='';

            foreach($reallocate as $rea){

            echo '<tr><td> Plot Membership #:</td><td>'.$rea['plotno'].'</td></tr><tr><td> Plot No:</td><td>'.$rea['plot_detail_address'].'</td></tr><tr><td>Street No:</td><td>'.$rea['street'].'</td></tr><tr><td>Project Name</td><td>'.$rea['project_name'].'</td></tr>

			<tr><td> Create Date:</td><td>'.$rea['create_date'].'</td></tr>

			';?>

</tbody>



</table>

<?php }?>



			



<h3>Owner</h3>



<table class="table table-striped table-new table-bordered">

            	<thead style="background:#666; border-color:#ccc; color:#fff;">

                    <tr>



                          <th width="2%">#</th>

                     

                        <th width="4%">Name</th>

                        <th width="5%">SO/DO/WO</th>

                        <th width="5%">CNIC</th>

                        <th width="10%">Address</th>

                           <th width="11%">Date/Time</th>

                    </tr>

                </thead>

                <tbody>

             <?php echo '<tr><td width="1%">'.$co.'</td><td>'.$key['name'].'</td><td>'.$key['sodowo'].'</td><td>'.$key['cnic'].'</td><td>'.$key['address'].'</td><td>'.$key['create_date'].'</td></tr>';

            }?>

                </tbody>

            </table>

            <h3>History Of Previous Allotments</h3>

<table class="table table-striped table-new table-bordered">

            	<thead style="background:#666; border-color:#ccc; color:#fff;">

                              <tr>

                      <th width="2%">#</th>

                        <th width="7%">Name</th>

                        <th width="7%">Father/Spouse</th>

                        <th width="5%">CNIC</th>

                        <th width="10%">Address</th>

                        <th width="7%">Date/Time</th>

                    </tr>

                </thead>

                 <tbody>

     <?php	



            $res=array();



            foreach($history as $key){echo '<tr><td width="1%">'.$co1.'</td><td>'.$key['name'].'</td><td>'.$key['sodowo'].'</td><td>'.$key['cnic'].'</td><td>'.$key['address'].'</td><td>'.$key['transfer_date'].'</td></tr>';

$co++;
$co1++;

            }?>

            </table>