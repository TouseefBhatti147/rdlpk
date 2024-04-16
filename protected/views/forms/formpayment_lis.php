
<style>
.btn{
	line-height: 12px;
    margin-bottom: 0;
    padding: 0px 12px;}
</style>
<div class="shadow">
  <h3>Advance Search:Form Payment</h3>
</div>
<span style="float:right; margin-left:5px;"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/forms/formpayment"  class="btn btn-info">Add Form Payment</a></span>
<!-- shadow -->
<hr noshade="noshade" class="hr-5">
<section class="login-section margin-top-30">
			<div class="clearfix"></div>	
  			<div class="">
            <table class="table table-striped table-new table-bordered "  style="font-size:12px;">
            	<thead style="background:#666; border-color:#ccc; color:#fff;">
                    <tr>
                        <th width="5%">ID.</th>
                        <th width="10%">Title</th>
                          <th width="10%">Amount</th>
                          <th width="10%">Action</th> 
                        </tr>
                </thead>
                <tbody id="error-div">
<?php
             foreach($members as $key){
				
            echo '<tr><td>'.$key['id'].'</td><td>'.$key['title'].'</td><td>'.$key['amount'].'</td><td><a href="formpayment_edit?id='.$key['id'].'">Edit</a>/<a href="delete?id='.$key['id'].'">Delete</a></td>';
				}
			'</tr>'; 
            ?>
                </tbody>
            </table>

  </div>
<hr noshade="noshade" class="hr-5 float-left">
</section>
</div>
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> 
