
<div class="shadow">
    <h3>Member Registration</h3>
</div>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.js"></script>

<!-- shadow -->

<hr noshade="noshade" class="hr-5">
<section class="reg-section margin-top-30">
    <div id="error-div" class="errorMessage" style="display: none; color:#F00;"></div>   
    <?php $form=$this->beginWidget('CActiveForm', array(
 'id'=>'plots',
 'enableAjaxValidation'=>false,
  'enableClientValidation'=>true,

                'method' => 'POST',
				'clientOptions'=>array(
			    'validateOnSubmit'=>true,
		        'validateOnChange'=>true,
	            'validateOnType'=>false,),

)); ?>
    <div class="float-left">
        <p class="reg-left-text">Name<font color="#FF0000">*</font>
        </p>
        <p class="reg-right-field-area margin-left-5">
            <input type="text" value="" name="name" id="name" class="reg-login-text-field" />
        </p>
    </div>
    <div class="float-left">
        <p class="reg-left-text">Date Of Birth<font color="#FF0000">*</font>
        </p>
        <p class="reg-right-field-area margin-left-5">

            <input type="text" value="" name="dob" id="dob" class="reg-login-text-field" class="new-input" />
        </p>
    </div>
    <div class="float-left">
        <p class="reg-left-text">Father/Spouse<font color="#FF0000">*</font>
        </p>
        <p class="reg-right-field-area margin-left-5">
            <select name="title" style="width:60px;">
                <option value="">---</option>
                <option value="s/o">s/o</option>
                <option value="d/o">d/o</option>
                <option value="w/o">w/o</option>
            </select>
            <input type="text" value="" name="sodowo" id="sodowo" class="reg-login-text-field" style="width:238px;" />
        </p>
    </div>
    <div class="float-left">
        <p class="reg-left-text">CNIC<font color="#FF0000">*</font>
        </p>
        <p class="reg-right-field-area margin-left-5">
            <input type="text" value="" onBlur="testPhone(this)" name="cnic" id="cnic" class="reg-login-text-field" />
        <p id="rsp"></p>
        </p>
    </div>
    <div class="float-left">
        <p class="reg-left-text">Address<font color="#FF0000">*</font>
        </p>
        <p class="reg-right-field-area margin-left-5">
            <input type="text" value="" name="address" id="address" class="reg-login-text-field" />
        </p>
    </div>
    <div class="float-left">
        <p class="reg-left-text">Email<font color="#FF0000">*</font>
        </p>
        <p class="reg-right-field-area margin-left-5">
            <input type="email" value="" name="email" id="email" class="reg-login-text-field" />
        </p>
    </div>
    <div class="float-left">
        <p class="reg-left-text">Country<font color="#FF0000">*</font>
        </p>
        <p class="reg-right-field-area margin-left-5">
            <select name="country" id="country">
                <option value="country">Please Select Country </option>
                <?php	
            $res=array();
            foreach($country as $key){
            echo '<option value="'.$key['id'].'">'.$key['country'].'</option>'; 
            }?>
            </select>
        </p>
    </div>
    <div class="float-left">
        <p class="reg-left-text">City<font color="#FF0000">*</font>
        </p>
        <p class="reg-right-field-area margin-left-5">
            <select name="city_id" id="city_id">
                <option value="city">please Select City </option>
            </select>
        </p>
    </div>
    <div class="float-left">
        <p class="reg-left-text">Mobile<font color="#FF0000">*</font>
        </p>
        <p class="reg-right-field-area margin-left-5">
            <input type="text" value="" name="phone" id="phone" class="reg-login-text-field" />
        </p>
    </div>
    <div class="float-left">
        <p class="reg-left-text">Nominee Name<font color="#FF0000">*</font>
        </p>
        <p class="reg-right-field-area margin-left-5">
            <input type="text" value="" name="nomineename" id="nomineename" class="reg-login-text-field" />
        </p>
    </div>
    <div class="float-left">
        <p class="reg-left-text">Nominee CNIC<font color="#FF0000">*</font>
        </p>
        <p class="reg-right-field-area margin-left-5">
            <input type="text" value="" name="nomineecnic" id="nomineecnic" class="reg-login-text-field" />
        </p>
    </div>
    <div class="float-left">
        <p class="reg-left-text">Relation With Applicant<font color="#FF0000">*</font>
        </p>
        <p class="reg-right-field-area margin-left-5">
            <input type="text" value="" name="rwa" id="rwa" class="reg-login-text-field" />
        </p>
    </div><br>
    <div class="float-left">
        <p class="reg-right-field-area margin-left-5">
        <lable>Member</lable>
            <input type="radio" name="mtype" value="member" onclick="show1();" checked="checked" />
              <lable>Dealer</lable>
            <input type="radio" name="mtype" value="Dealer" onclick="show2();" />


        </p>
    </div>
    <div class="float-left" id="div1">
        <p class="reg-left-text">Business Title<font color="#FF0000">*</font>
        </p>
        <p class="reg-right-field-area margin-left-5">
            <input type="text" value="" name="business_title" id="business_title" class="reg-login-text-field" />
        </p>
    </div>
    <?php echo CHtml::ajaxSubmitButton(
                                'Add Member',
    array('member/create'),
                                array(  
                'beforeSend' => 'function(){ 
                                             $("#submit").attr("disabled",true);
            }',
                                        'complete' => 'function(){ 
                                             $("#plots").each(function(){ });
                                             $("#submit").attr("disabled",false);
                                        }',
                   'success'=>'function(data){  
                                           //  var obj = jQuery.parseJSON(data); 
                                            // View login errors!
                                             if(data == 1){
												// alert("we are here");
                                         location.href = "http://rdlpk.com/index.php/user/dashboard";
                                      }
          else{
                                                $("#error-div").show();
                                                $("#error-div").html(data);$("#error-div").append("");
												return false;
                                             }
                                       }' 
    ),
                         array("id"=>"login","class" => "btn-info pull-right")      
                ); ?>
    <?php $this->endWidget(); ?>
    <div class="float-left">
        <p class="reg-right-field-area margin-left-5">
            <span style="float:left; color:red;">Note: If City not found in city list click "Other" for add new City
            </span>
        </p>
              </div>
    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form action="addcity" method="post" enctype="multipart/form-data">
                    <div class="float-left">
                        <p class="reg-left-text">City Name<font color="#FF0000">*</font>
                        </p>
                        <p class="reg-right-field-area margin-left-5">
                            <input type="text" value="" name="city" id="city" class="form-control"
                                placeholder="Enter City name" />
                        </p>
              </div>
                    <div class="float-left">
                        <p class="reg-left-text">Country</p>
                        <p class="reg-right-field-area margin-left-5">
                            <select name="country_id" id="country_id">
                                <?php
                                foreach($country as $key1)
                                {
                                echo ' 	<option value="'.$key1['id'].'">'.$key1['country'].'</option>';   
                                } 
                                ?>
                            </select>
                        </p>
                    </div>
                    <div class="float-left">
                        <p class="reg-left-text">Zip Code</p>
                        <p class="reg-right-field-area margin-left-5">
                            <input id="zipcode" type="text" name="zipcode">
                        </p>
                    </div>
                    <div class="float-left">
                        <p class="reg-right-field-area margin-left-5">
                            <button type="submit" class="btn btn-info">Add City</button>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
    $(document).ready(function() {
        $("#project").change(function() {
            select_street($(this).val());
        });
        $("#street_id").change(function() {
            select_plot($(this).val());
        });
        $("#country").change(function() {
            select_city($(this).val());
        });
    });
    document.getElementById('div1').style.display ='none'; 
    function show1(){
  document.getElementById('div1').style.display ='none';
}
function show2(){
  document.getElementById('div1').style.display = 'block';
}
    
    function select_street(id) {
        $.ajax({
            type: "POST",
            url: "ajaxRequest?val1=" + id,
            contenetType: "json",
            success: function(jsonList) {
                var json = $.parseJSON(jsonList);
                var listItems = '';
                $(json).each(function(i, val) {
                    listItems += "<option value='" + val.id + "'>" + val.street + "</option>";
                });
                listItems += "";

                $("#street_id").html(listItems);
            }
        });
    }

    function select_plot(id) {
        $.ajax({
            type: "POST",
            url: "ajaxRequest1?val1=" + id,
            contenetType: "json",
            success: function(jsonList) {
                var json = $.parseJSON(jsonList);
                var listItems = '';
                $(json).each(function(i, val) {
                    listItems += "<option value='" + val.id + "'>" + val.plot_detail_address +
                        " (" + val.plot_size + ")</option>";
                });
                listItems += "";
                $("#plot_id").html(listItems);
            }
        });
    }

    function select_city(id) {
        $.ajax({
            type: "POST",
            url: "ajaxRequest3?val1=" + id,
            contenetType: "json",
            success: function(jsonList) {
                var json = $.parseJSON(jsonList);
                var listItems = '';
                $(json).each(function(i, val) {
                    listItems += "<option value='" + val.id + "'>" + val.city + " </option>";
                });
                listItems +=
                    "<option value='' data-toggle=modal data-target=.bs-example-modal-sm  >Other</option>";
                $("#city_id").html(listItems);
            }
        });
    }
    </script>
    <script type="text/javascript">
    function testPhone(objNpt) {
        var n = objNpt.value.replace(/[^\d]+/g, ''); // replace all non digits
        if (n.length != 13) {
            document.getElementById('rsp').innerHTML = "Please Enter 13 Digit CNIC Number without spaces/Slashes !";

            return;
        }
        document.getElementById('rsp').innerHTML = "";
        objNpt.value = n.replace(/(\d\d\d\d\d)(\d\d\d\d\d\d\d)(\d)/, '$1$2$3'); // format the number
    }
    </script>
</section>

<!-- section 3 -->