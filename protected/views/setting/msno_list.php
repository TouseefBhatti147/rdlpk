<?php
$address = $_SERVER['HTTP_HOST'] . Yii::app()->request->baseUrl;;
?>
<script>
  $(function() {
    $('#loading').hide();
    var project_name = $("#project").val();
    $.ajax({
      url: "https://<?php echo $address ?>/index.php/setting/searchreq",
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
        url: "https://<?php echo $address ?>/index.php/setting/searchreq",
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
  <h3>Advance Search:MS No
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

  <select name="project" id="project" style="width:180px;"><?php
                                                            //if($pro!=''){echo '<option value="'.$pro.'">'.$pro.'</option>'; }else{
                                                            //		}
                                                            $res = array();
                                                            foreach ($projects as $key) {
                                                              echo '<option value="' . $key['id'] . '">' . $key['project_name'] . '</option>';
                                                            } ?></select>

  <span>Type:</span>
  <select name="com_res" id="com_res" style="width:180px;">
    <option value="">Select Property Type</option>
    <option value="1">Residential</option>
    <option value="2">Villa</option>
    <option value="3">Commercial</option>
  </select>

  <span>Status:</span>
  <select name="status" id="status" style="width:180px;">
  <option value="">Select Status</option>
   <option value="00">Open</option>
    <option value="1">Active</option>
    <option value="2">Reserved</option>

  </select>


  <!--<span>Against Land: </span><input name="atype"  type="checkbox"  class="new-input" id="atype">---->
  <span>MS No. </span>
  <input type="hidden" value="" name="procode" id="procode" class="reg-login-text-field" style="width:60px;" readonly />
  <input type="text" value="" name="ms_no" id="ms_no" class="new-input" placeholder="MS NO" />
  <span>MS: </span>
  <input type="hidden" value="" name="procode" id="procode" class="reg-login-text-field" style="width:60px;" readonly />
  <input type="text" value="" name="ms" id="ms" class="new-input" placeholder="MS" />
  <span>Unique MS: </span>
  <input type="hidden" value="" name="procode" id="procode" class="reg-login-text-field" style="width:60px;" readonly />
  <input type="text" value="" name="uniq_ms" id="uniq_ms" class="new-input" placeholder="Unique MS" />


  <img id="loading" src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading.gif">
  <?php echo CHtml::ajaxSubmitButton(
    'Search',
    array('/setting/searchreq/?page=1'),
    array(
      'beforeSend' => 'function(){

                                             $("#login").attr("disabled",true);
                                              $("#loading").show()

            }',
      'complete' => 'function(){
                                             $("#user_login_form").each(function(){});
                                             $("#login").attr("disabled",false);
                                             $("#loading").hide();
                                        }',
      'success' => 'function(data){
                                           //  var obj = jQuery.parseJSON(data);
                                            // View login errors!
                                           ;
                                             if(data == 1){
												// alert("we are here");
                                         location.href = "https://rdlpk.com/index.php/user/dashboard";
                                      }
          else{
                                                $("#error-div").show();
                                                $("#error-div").html(data);$("#error-div").append("");
												return false;
                                             }
                                        }'
    ),
    array("id" => "login", "class" => "btn btn-info")
  ); ?>
  <?php $this->endWidget(); ?>
  <a href="generate_ms_list" style="float: right;"><strong> Create New MS List</strong> </a>
</section>
</div>
</form>
<div class="clearfix"></div>
<div class="">
  <table class="table table-striped table-new table-bordered">
    <thead style="background:#666; border-color:#ccc; color:#fff;">
      <tr>
        <th width="8%">Project</th>
        <th width="5%">Property Type</th>
        <th width="5%">MS.</th>
        <th width="6%">MS No</th>
        <th width="4%">Complete MS</th>
        <th width="8%">Unique MS (Project ID-MS NO)</th>
        <th width="4%">Status</th>
        <th width="5%">Created At</th>
        <th width="5%">Action</th>
      </tr>
    </thead>
    <tbody id="error-div">
    </tbody>
  </table>
</div>
<hr noshade="noshade" class="hr-5 float-left">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    $("#project").change(function() {
      select_sector($(this).val());
    });
    $("#com_res").change(function() {
      //  select_plan($(this).val());
      var pro = $("#project").val();
      var street = $("#street_id").val();
      var size = $("#size_id").val();
      var sector = $("#sector").val();
      var pptype = $('#pptype').val();
      select_size(this.value);
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
        listItems += "<option value=''>Select Size</option>";
        $(json).each(function(i, val) {
          listItems += "<option value='" + val.id + "'>" + val.size + " </option>";
        });
        listItems += "";
        $("#size").html(listItems);
      }
    });
  }

  function select_sector(id) {
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