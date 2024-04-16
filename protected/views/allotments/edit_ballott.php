
<div class="shadow">
  <h3>Edit ballot</h3>
</div>
<style>

.float-left {
    float: left;
    height: 80px;
    margin: 2px 3px;
    width: 274px;
}
select{ width:255px;}
input, textarea, .uneditable-input {
width: 244px;
}
</style>
<!-- shadow -->
<hr noshade="noshade" class="hr-5">
<section class="login-section margin-top-30" style="height:120px;">

<!--<form name="login-form" method="post" action="">-->
<form action="editballotform" method="post">
<?php foreach($ballott as $list1)
			{?>
<div id="error-div" class="errorMessage" style="display: none; color:#F00; font-weight:bold;"></div>
   <input type="hidden" name="bid" value="<?php echo $_REQUEST['bid']; ?>" readonly="readonly" />
   <div class="float-left">
    <p class="left-text">Project Name</p>
    <p class="right-field-area margin-left-5">
    <input type="text" value="<?php echo $list1['project_name']; ?>" readonly="readonly" />
    </p>
  </div>
    <div class="float-left">
    <p class="left-text">Size:</p>
    <p class="right-field-area margin-left-5">
    <input type="text" value="<?php echo $list1['size']; ?>" readonly="readonly" />
    </p>
  </div>
     
  <div class="float-left">
    <p class="left-text">Description:</p>
    <p class="right-field-area margin-left-5">
    <input type="text" value="<?php echo $list1['desc1']; ?>" name="desc1" />
    </p>
  </div>
  
  <div class="float-left">
    <p class="left-text">Status:</p>
    <p class="right-field-area margin-left-5">
      <select name="status" >
      <option value="<?php echo $list1['status']; ?>"><?php echo $list1['status']; ?></option>
      <option value="Drawn">Drawn</option>
      <option value="Open">Open</option>
      <option value="Freezed">Closed</option>
      </select>
    
    </p>
  </div>
  
  
 <input type="submit" name="submit" value="Submit"  class="btn btn-success"/>
 </form>
</section>
<?php }?>
<hr noshade="noshade" class="hr-5">
<div class="">
            
            
            

 			
  	
  </div>
<!-- section 3 --> 
