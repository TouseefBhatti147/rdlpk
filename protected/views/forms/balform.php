<div class="shadow">

  <h3>Search: balloting</h3>
  
</div><style>
.btn{
	line-height: 12px;
    margin-bottom: 0;
    padding: 3px 12px;}
</style>
<!-- shadow -->

<hr noshade="noshade" class="hr-5">

<section class="login-section margin-top-30">
<form action="searchreqbal?id=<?php echo $_REQUEST['id']; ?>" method="post">

<div id="" class="errorMessage" style="display: none; color:#F00; font-weight:bold;"></div>
<?php if(Yii::app()->session['user_array']['per13']=='1'){ ?>
    <span>Project:</span>

    	<select name="project_id" id="project_id" style="width:180px;"><?php	
	
            $res=array();
			foreach($projects as $key){
            echo '<option value="'.$key['id'].'">'.$key['project_name'].'</option>'; 
            }?></select> 

   <?php }?>

    
                <span>CNIC:</span>
     <input type="text" value="" name="cnic" id="cnic" class="new-input" placeholder="Enter CNIC No." />

               <span>Form No.:</span> 			 
<input type="text" value="" name="formno" id="formno" class="new-input" placeholder="Enter Form No" />
<input type="hidden" value="<?php echo $_REQUEST['id']?>" name="bbid" id="bbid" class="new-input" placeholder="Enter Form No" />
    

 <input class="btn" type="submit" value="Search" />

			</form>