

<div class="shadow">

  <h3>Payment</h3>

</div>

<!-- shadow -->

<hr noshade="noshade" class="hr-5">

<section class="reg-section margin-top-30">

<form action="instalment" method="post">

			<div class="float-left">

    <p class="reg-left-text">Payment Type<font color="#FF0000">*</font></p>

   	<p class="reg-right-field-area margin-left-5">

    <select name="payment_type" id="payment_type-type">

   <?php

   foreach($charges as $key1)

   {

	echo ' 	<option value="'.$key1['name'].'">'.$key1['name'].' ('.$key1['project_name'].')</option>';  

   }

   

   ?>



  	</select>

    </p>

  	</div>

    

<?php	

            $res=array();

            foreach($pages as $key){

            echo '

	<div class="float-left">

    <p class="reg-left-text">Plot ID<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" readonly="readonly" value="'.$key['plot_id'].'" name="plot_id" id="plot_id" class="reg-login-text-field" />

    </p>

  	</div>

  	<div class="float-left">

    <p class="reg-left-text">Member ID<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text"  readonly="readonly" value="'.$key['member_id'].'" name="member_id" id="member_id" class="reg-login-text-field" />

    </p>

  </div>

  <div class="float-left">

    <p class="reg-left-text">Amount<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" value="" name="amount" id="amount" class="reg-login-text-field" />

    </p>

  </div>

   <div class="float-left">

    <p class="reg-left-text">Discount<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" value="" name="discount" id="discount" class="reg-login-text-field" />

    </p>

  </div>

  

<div class="float-left">

    <p class="reg-left-text">Payment Mode<font color="#FF0000">*</font></p>

   	<p class="reg-right-field-area margin-left-5">

    <select name="paid-as" id="paid-as">

  	<option value="payment_type">Select Payment Mode</option>

   	<option value="cash">Cash</option>

    <option value="checque">Checque</option>

    <option value="Po">Pay Order</option>

	

  	</select>

    </p>

  	</div>

  <div class="float-left">

    <p class="reg-left-text">Detail<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" value="" name="detail" id="detail" class="reg-login-text-field" />

    </p>

  </div>

  <div class="float-left">

    <p class="reg-left-text">Surcharge<font color="#FF0000">*</font></p>

    <p class="reg-right-field-area margin-left-5">

      <input type="text" value="" name="surcharge" id="surcharge" class="reg-login-text-field" />

    </p>

  </div>

   <div class="input-append date" id="dp3" data-date="12-02-2012" data-date-format="dd-mm-yyyy">

    <input class="span8" name="date" id="date" size="16" type="date" value="12-02-2012">

    <span class="add-on"><i class="icon-th"></i></span>

    </div>

  <input name="submit" type="submit" class="btn btn-success" />

  </form>

      

  ';

            }?>

			

          