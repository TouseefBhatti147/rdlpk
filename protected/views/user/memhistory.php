<h3>Personal Information</h3>
<table class="table table-striped table-new table-bordered" style="width:40%; float:left;">
<tbody>
<?php	
            $res=array();
            foreach($member as $key){
            echo '<tr><td>Name:</td><td style="width:346px;">'.$key['name'].'</td></tr><tr><td> User Name:</td><td>'.$key['username'].'</td></tr><tr><td>SODOWO:</td><td>'.$key['sodowo'].'</td></tr><tr><td>CNIC:</td><td>'.$key['cnic'].'</td></tr><tr><td >Address</td><td >'.$key['address'].'</td></tr><tr><td>Email:</td><td>'.$key['email'].'</td></tr></tr><tr><td>Contact No.:</td><td>'.$key['phone'].'</td></tr><tr><td>Create Date:</td><td>'.$key['create_date'].'</td></tr>
			<tr><td><strong>Login Name/Username:</strong></td><td><strong style="color:#FF0000">'.$key['username'].'</strong></td></tr>
			<tr><td><strong>Password:</strong></td><td><strong style="color:#060">'.$key['password'].'</strong></td></tr>
			<tr><td><strong>Nominee Name:</strong></td><td><strong>'.$key['nomineename'].'</strong></td></tr>
			<tr><td><strong>Nominee Nominee CNIC:</strong></td><td><strong>'.$key['nomineecnic'].'</strong></td></tr>
			'; 
            }?>
          
            </tbody></table>
<table class="table table-striped table-new table-bordered" style="width:11%; float:left;">
<tbody>
<tr><td><?php if($key['image']==''){?>
  <form action="<?php echo $this->createAbsoluteUrl('member/updateimg');?>" enctype="multipart/form-data" method="post" >
  
   <div class="float-left">
    <p class="reg-left-text">Image<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
    <input id="image" type="file" name="image" accept="image/*">
     <input type="hidden" value="<?php echo $key['id']; ?> "    name="id" id="id" class="reg-login-text-field" />
<input type="hidden" value="1"    name="from" id="from" class="reg-login-text-field" />

</p>
</div>

   <div class="float-left">
    <p class="reg-right-field-area margin-left-5">
   <input type="submit" class="btn-info button" name="update" value="Update Image" /></p>		
</div></div>

  </form>

<?php }else{ echo '<img src="'.Yii::app()->request->baseUrl.'/upload_pic/'.$key['image'].'" width="150" />';}?></td></tr>
</tbody></table>

<table class="table table-striped table-new table-bordered">
            	<thead style="background:#666; border-color:#ccc; color:#fff;">
                   <tr><th width="18%"><h3>Current Plots Detail</h3></th></tr>
                    <tr>
                     <th width="2%">#</th>
                          <th width="7%">Project Name</th>
                          <th width="6%">MS No.</th>
                            <th width="5%">Plot Size</th>
                          <th width="4%">Plot No.</th>
                         <th width="5%">Street/Lane</th>
                         <th width="5%">Block</th>            
                          <th width="8%">Date/Time</th>
                        </tr>
                </thead>
                
                <tbody>
                    <?php	
            $res=array();
			$count=1;
            foreach($pages as $key1){
            echo '<tr><td width="1%">'.$count.'</td><td>'.$key1['project_name'].'</td><td>'.$key1['plotno'].'</td><td>'.$key1['size'].'&ensp;('.$key1['plot_size'].')</td><td>'.$key1['plot_detail_address'].'</td><td>'.$key1['street'].'</td><td>'.$key1['sector_name'].'</td><td>'.$key1['create_date'].'</td></tr>'; 
            $count++;
			}?>
                </tbody>
            </table>

<h3>History</h3>
<table class="table table-striped table-new table-bordered">
            	<thead style="background:#666; border-color:#ccc; color:#fff;">
                    <tr>
                     <th width="2%">#</th>
                          <th width="7%">Project Name</th>
                          <th width="6%">MS No.</th>
                            <th width="5%">Plot Size</th>
                          <th width="4%">Plot No.</th>
                         <th width="5%">Street/Lane</th>
                         <th width="5%">Block</th>            
                          <th width="8%">Date/Time</th>
                        </tr>
                </thead>

                
                <tbody>
              <?php	
            $res=array();
			$count1=1;
            foreach($projects as $key2){
            echo '<tr><td width="1%">'.$count.'</td><td>'.$key2['project_name'].'</td><td>'.$key2['plotno'].'</td><td>'.$key2['size'].'&ensp;('.$key2['plot_size'].')</td><td>'.$key2['plot_detail_address'].'</td><td>'.$key2['street'].'</td><td>'.$key2['sector_name'].'</td><td>'.$key2['create_date'].'</td></tr>'; 
            $count1++;
			}?>
                </tbody>
            </table>