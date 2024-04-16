
<div class="shadow">
  <h3>Add Payment By Member</h3>
</div>
<!-- shadow -->
<hr noshade="noshade" class="hr-5 float-left">
<section class="reg-section margin-top-30">
<form action="create" method="post">
<div id="error-div" class="errorMessage" style="display: none;"></div>
 
  
 
  <div class="float-left">
    <p class="reg-left-text">Plot ID<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" name="plot_id" id="plot_id" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Payment Type<font color="#FF0000">*</font></p>
   
   
   
    <p class="reg-right-field-area margin-left-5">
    <select name="payment_type" id="payment_type">
  <option value="payment_type"></option>
   <option value="payment_type">type-1</option>
    <option value="payment_type">type-2</option>
     <option value="payment_type">type-3</option>
  </select>
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Amount<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value=".$key['plot_id']." name="amount" id="amount" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">By Member ID<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" name="by_mem_id" id="by_mem_id" class="reg-login-text-field" />
    </p>
  </div>
  <div class="float-left">
    <p class="reg-left-text">Date<font color="#FF0000">*</font></p>
    <p class="reg-right-field-area margin-left-5">
      <input type="text" value="" name="date" id="date" class="reg-login-text-field" />
      <input type="text" id="datepicker">
       

      
    </p>
  </div>
  
  
  
  
  
  

  
  
  
 <input name="submit" type="submit" class="btn btn-success" />
