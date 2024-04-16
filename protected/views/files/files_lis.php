<?php
$address = $_SERVER['HTTP_HOST'] . Yii::app()->request->baseUrl;;
?>
<script>
  $(function() {

    $.ajax({
      url: "https://<?php echo $address ?>/index.php/files/searchreq",
      type: "POST",
      data: $("#user_login_form").serialize() + "&&page=1",
      cache: false,
      success: function(response) {

        $('#error-div').html(response);
      }
    });
    $('#error-div').on('click', '.page-numbers', function() {
      $page = $(this).attr('href');
      $pageind = $page.indexOf('page=');
      $page = $page.substring(($pageind + 5));
      $.ajax({
        url: "https://<?php echo $address ?>/index.php/files/searchreq",
        type: "POST",
        //  data:"actionfunction=showData&page="+$page,
        data: $("#user_login_form").serialize() + "&&page=" + $page,
        cache: false,
        success: function(response) {
          $('#error-div').html(response);
        }
      });
      return false;
    });
  });
</script>

<div class="shadow">
  <h3>Advance Search:Files</h3>
</div>

<!-- shadow -->

<hr noshade="noshade" class="hr-5">
<section class="login-section margin-top-30">

  <!--<form name="login-form" method="post" action="">-->

  <?php $form = $this->beginWidget('CActiveForm', array(

    'id' => 'user_login_form',

    'enableAjaxValidation' => false,
    'enableClientValidation' => true,
    'method' => 'POST',
    'clientOptions' => array(
      'validateOnSubmit' => true,
      'validateOnChange' => true,
      'validateOnType' => false,
    ),
  )); ?>
  <div id="" class="errorMessage" style="display: none; color:#F00; font-weight:bold;"></div>
  <span>Project:</span>
  <select name="project_id" id="project" style="width:180px;">
    <option value="">Select Project</option>
    <?php
    $res = array();
    foreach ($projects as $key) {
      echo '<option value="' . $key['id'] . '">' . $key['project_name'] . '</option>';
    } ?>
  </select>
  <span>Block:</span>
  <select name="block" id="block" style="width:180px;">
    <option value="">Block</option>
  </select>
  <span>Sector:</span>
  <select name="sector" id="sector" style="width:180px;">
    <option value="">Sector</option>
  </select>
  <span>Street:</span>
  <select style="width:180px;" name="street_id" id="street_id">
    <?php

    if ($st != '') {
      echo '<option value="' . $st . '">' . $st . '</option>';
    }
    ?>
    <option value="">Select Street</option>
    <option value="street">street</option>
  </select>
  <span>Type:</span>
  <select style="width:180px;" id="com_res" name="com_res">
    <option value="">Select Property Type</option>
    <option value="R">Residential</option>
    <option value="C">Commercial</option>
  </select>
  <span>Size:</span>
  <select name="size" id="size" style="width:180px;">
    <?php







    if (!empty($size)) {
      echo '<option value="' . $size . '">' . $size . '</option>';
    } else {



      echo '<option value="">Select Size</option>';
    }



    $res = array();



    foreach ($sizes as $siz) {







      echo '<option value="' . $siz['id'] . '">' . $siz['size'] . '</option>';
    } ?>
  </select>
  <span>File #:</span>
  <input type="text" value="" name="plot_detail_address" id="plot_detail_address" class="new-input" placeholder="Enter File No" />
  <span>Filter:</span>
  <select name="stat" id="stat" style="width:180px;">
    <option value="">Select filter</option>

    <!--  <option value="1">Re-allocated</option>-->

    <option value="2">Alloted</option>
    <option value="3">Not Alloted</option>
    <option value="4">Reserved</option>
    <option value="5">Requested for Transfer</option>
    <option value="6">Against Land</option>
  </select>
  <input type="hidden" value="" name="procode" id="procode" class="reg-login-text-field" style="width:60px;" readonly />
  <span>Membership No:</span>
  <input type="text" value="" name="plotno" id="plotno" class="new-input" placeholder="Membeship #" />
  <?php echo CHtml::ajaxSubmitButton(



    'Search',



    array('/files/searchreq/?page=1'),



    array(



      'beforeSend' => 'function(){ 



                                             $("#login").attr("disabled",true);



            }',



      'complete' => 'function(){ 



                                             $("#user_login_form").each(function(){});



                                             $("#login").attr("disabled",false);



                                        }',



      'success' => 'function(data){  



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



    array("id" => "login", "class" => "btn-info pull-right")



  ); ?>

  <!--  </form>-->

  <?php $this->endWidget(); ?>
</section>
</div>

<!-- section 3 -->

<div class="clear-fix"></div>

<!--      <input type="text" value="" name="cnic" id="cnic" class="new-input" placeholder="Enter Project Name" />



    -->

</form>
<div class="float-left">
  <table class="table table-striped table-new table-bordered" style="font-size:12px;">
    <thead style="background:#666; border-color:#ccc; color:#fff;">
      <tr>
        <th width="6%">File Membership #</th>
        <th width="8%">Project</th>
        <th width="4%">Block</th>
        <th width="4%">Street</th>
        <th width="5%">File No</th>
        <th width="5%">Diemension</th>
        <th width="4%">Size</th>
        <th width="6%">Type</th>
        <th width="4%">Sector</th>
        <th width="4%">Convert</th>
        <?php
        if (Yii::app()->session['user_array']['per2'] == '1') {

          echo ' 


                        <th width="4%">Status</th>



						 <th width="4%">B.Status</th>                        

						  <th width="4%">Merge</th>
					
                         <th width="6%">Action</th>';
        } else {
          echo '';
        } ?>
      </tr>
    </thead>
    <tbody id="error-div">
    </tbody>
  </table>
</div>
<hr noshade="noshade" class="hr-5 float-left">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    $("#project").change(function() {
      select_block($(this).val());
    });
    $("#block").change(function() {
      select_sector($(this).val());
    });

    $("#com_res").change(function()

      {
        //  select_plan($(this).val());

        var pro = $("#project").val();
        var street = $("#street_id").val();
        var size = $("#size_id").val();
        var sector = $("#sector").val();
        var pptype = $('#pptype').val();
        select_size(this.value);
        /*		$.ajax({
      type: "POST",
      url:    "ajaxRequest1",
	 data:"pro="+pro+"&street="+street+"&size="+size+"&sector="+sector+"&pptype="+pptype,
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
		var listItems='';
		listItems+= "<option value=''>Select Plot</option>";
	$(json).each(function(i,val){
	 
	listItems+= "<option value='" + val.id + "'>" + val.plot_detail_address +" ("+val.plot_size+")</option>";

});listItems+="";

$("#plot_id").html(listItems);

 }

});*/

      });
  });

  var sid = $("#com_res").val();

  function select_size(id) {
    $.ajax({
      type: "POST",
      url: "ajaxRequest123?val1=" + id,
      contenetType: "json",
      success: function(jsonList) {
        var json = $.parseJSON(jsonList);
        var listItems = '';
        $(json).each(function(i, val) {
          listItems += "<option value='" + val.id + "'>" + val.size + " </option>";
        });
        listItems += "";
        $("#size").html(listItems);
      }
    });
  }

  function select_block(id) {
    $.ajax({
      type: "POST",
      url: "ajaxBlock?val1=" + id,
      contenetType: "json",
      success: function(jsonList) {
        var json = $.parseJSON(jsonList);
        var listItems = '';
        listItems += "<option value=''>Select Block</option>";
        $(json).each(function(i, val) {

          listItems += "<option value='" + val.id + "'>" + val.block_name + "</option>";
        });
        listItems += "";
        $("#block").html(listItems);
      }
    });
  }

  function select_sector(id) {
    var pro = $("#project").val();
    var blk = $("#block").val();
    $.ajax({
      type: "POST",
      //url:    "ajaxRequest?val1="+id,
      url: "ajaxRequest?pro=" + pro + "&&blk=" + blk,
      contenetType: "json",
      success: function(jsonList) {
        var json = $.parseJSON(jsonList);
        var listItems = '';
        listItems += "<option value=''>Select Sector</option>";
        $(json).each(function(i, val) {

          listItems += "<option value='" + val.id + "'>" + val.sector_name + "</option>";
        });
        listItems += "";
        $("#sector").html(listItems);
      }
    });
  }

  function select_sector111(id) {
    $.ajax({
      type: "POST",
      url: "ajaxRequest?val1=" + id,
      contenetType: "json",
      success: function(jsonList) {
        var json = $.parseJSON(jsonList);
        var listItems = '';
        listItems += "<option value=''>Select Sector</option>";
        $(json).each(function(i, val) {

          listItems += "<option value='" + val.id + "'>" + val.sector_name + "</option>";
        });
        listItems += "";
        $("#sector").html(listItems);
      }
    });
    $.ajax({
      type: "POST",
      url: "projectcode?val1=" + id,
      contenetType: "json",
      success: function(jsonList) {
        var json = $.parseJSON(jsonList);
        var newv = '';
        $(json).each(function(i, val) {

          newv = val.code;
        });

        var elem = document.getElementById("procode");
        elem.value = newv;
        //$("#plotno").value(newv);
      }
    });
  }
  $(document).ready(function() {
    $("#sector").change(function() {
      select_street($(this).val());
    });
  });

  function select_street(id) {
    var pro = $("#project").val();
    var sec = $("#sector").val();
    $.ajax({
      type: "POST",
      url: "ajaxRequest2?pro=" + pro + "&&sec=" + sec,
      contenetType: "json",
      success: function(jsonList) {
        var json = $.parseJSON(jsonList);
        var listItems = '<option value="">Select Street</option>';
        $(json).each(function(i, val) {
          listItems += "<option value='" + val.id + "'>" + val.street + "</option>";
        });
        listItems += "";
        $("#street_id").html(listItems);
      }
    });
  }
</script>