<script src="//code.jquery.com/jquery-1.10.2.js"></script>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.js"></script>



<script>

$(function() {

$( "#fromdatepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });

});

$(function() {

$( "#todatepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });

});

</script>
<div class="shadow">

  <h3>Update Charges</h3>

</div>


<!-- shadow -->
<b>Payment submit by</b><br />
<hr noshade="noshade" class="hr-5">
<span class="btn-info pull-right" ><a href="<?php echo $this->createAbsoluteUrl('reciept/payment_lis');?>" style="color:#FFF;">Back To List</a></span>
<section class="reg-section margin-top-30">




  <?php	

//            $res=array();

  //          foreach($pla as $key){
				


foreach($charges as $row){
?>

<b>Name:</b><?php echo $row['name']?><br />
<b>CNIC:         </b><?php echo $row['cnic']?><br />
 <b>Phone Number:</b><?php echo $row['amount']?><br /><span style="float:right;">
 <b> Project:     </b><?php echo $row['project_name']?><br />
 <b> Street:       </b><?php echo $row['street']?><br />
 <b> Plot No.:      </b><?php echo $row['plot_detail_address']?>
 <br />
 <b>Membership No.:      </b><?php echo $row['plotno']?>
 </span>
  <br /><br />
 <b>Payment Details</b> 
 <hr noshade="noshade" class="hr-5"> 
<div class="float-left">

    <p class="reg-left-text">Payment Mode<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">
  <input type="text" value="<?php  echo $row['paidas'];?>" readonly/>

    </p>

  </div>
  <div class="float-left">

    <p class="reg-left-text">Due Amount. <font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" value="<?php  echo $row['amount'];?>" name="amount" id="amount" class="reg-login-text-field" readonly/>

    </p>

  </div>

  <div class="float-left">

    <p class="reg-left-text">Paid Amount<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      
     <input name="paidamount"  type="text" value="<?php  echo $row['paidamount'];?>" class="reg-login-text-field" id="paidamount" readonly/>
    </p>

  </div>
  <div class="float-left">

    <p class="reg-left-text">Remarks<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      
     <input name="remarks"  type="text" value="<?php  echo $row['remarks'];?>" class="reg-login-text-field" id="remarks"readonly/>
    </p>

  </div>
  
  
  <div class="float-left">

    <p class="reg-left-text">Voucher No.<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      
     <input name="detail"  type="text" value=" <?php  echo $row['detail'];?>" class="reg-login-text-field" id="detail" readonly/>
    </p>

  </div>
  <div class="float-left">

    <p class="reg-left-text">Surcharge<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      
     <input name="surcharge"  type="text" value=" <?php  echo $row['surcharge'];?>" class="reg-login-text-field" id="surcharge"readonly/>
    </p>

  </div>
  <div class="float-left">
  <p class="reg-left-text">Payment Type<font color="#FF0000">*</font></p>
  <p class="reg-right-field-area margin-left-5">
  
    <input type="text" value="<?php  echo $row['payment_type'];?>" readonly/>
  </p>
</div>
  <div class="float-left">

    <p class="reg-left-text">Paid Date<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      
    <input name="date" value="<?php  echo $row['date'];?>"  type="text" placeholder="Enter To Date" class="reg-login-text-field" id="todatepicker" readonly/>
    </p>

  </div>
  
<div class="float-left">

    <p class="reg-left-text">Due Date<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      
    <input name="duedate"  type="text" value="<?php echo $row['duedate']; ?>" class="reg-login-text-field" id="duedate" readonly/>
    </p>

  </div>

  <div class="">


<input type="hidden" id="mem_id" name="mem_id" value="<?php  echo $row['mem_id']; } ?>"/>

</div>

   </section>
   <div class="clearfix"></div>
   
	

 



<!-- section 3 --> 
