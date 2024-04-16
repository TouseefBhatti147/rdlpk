<div class="">
  <div class="shadow">
    <h3>Create MS No(s) Lists (Bulk Assignment)</h3>
  </div>
  <!-- shadow -->
  <hr noshade="noshade" class="hr-5 ">
  <section class="reg-section margin-top-30">
    <?php $form = $this->beginWidget('CActiveForm', array(
      'id' => 'plots',
      'enableAjaxValidation' => false,
      'htmlOptions' => array('enctype' => 'multipart/form-data'),
      'enableClientValidation' => true,
      'method' => 'POST',
      'clientOptions' => array(
        'validateOnSubmit' => true,
        'validateOnChange' => true,
        'stateful' => true,
        'validateOnType' => false,
      ),
    )); ?>
    <?php
    if (isset($_REQUEST['id']) && $_REQUEST['id'] !== '') {
      echo '<input name="corg" id="corg" type="hidden" value="' . $_REQUEST['id'] . '" />';
    }
    ?>
    <input value="Plot" name="type" id="type" type="hidden" />
    <div id="error-div" class="errorMessage" style="display: none; color:#F00;"></div>
    <div style="display:none;" class="float-left">
      <p class="reg-left-text">Plot ID <font color="#FF0000">*</font>
      </p>
      <p class="reg-right-field-area margin-left-5">
        <input type="text" value="" name="id" id="id" class="reg-login-text-field" />
      </p>
    </div>
    <div class="float-left">
      <p class="reg-left-text">Project<font color="#FF0000">*</font>
      </p>
      <select name="project_id" id="project">
        <option value="">Select Project</option>
        <?php
        $res = array();
        foreach ($projects as $key) {
          echo '
			<option value="' . $key['id'] . '">' . $key['project_name'] . '</option>';
        } ?>
      </select>
    </div>

    <div class="float-left">
      <p class="reg-left-text">Type<font color="#FF0000">*</font>
      </p>
      <p class="reg-right-field-area margin-left-5">
        <select name="property_type" id="property_type">
          <option value="">Select Type</option>
          <?php
          $res = array();
          foreach ($types as $key1) {
            echo '
			<option value="' . $key1['property_type_id'] . '">' . $key1['title'] . '</option>';
          } ?>
        </select>
    </div>

    <div class="float-left">
      <p class="reg-left-text">Range From<font color="#FF0000">*</font>
      </p>
      <p class="reg-right-field-area margin-left-5">
        <input type="number" name="startfrom" id="startfrom" value="">
    </div>
    <div class="float-left">
      <p class="reg-left-text">Range To<font color="#FF0000">*</font>
      </p>
      <p class="reg-right-field-area margin-left-5">
        <input type="number" name="endto" id="endto" value="">
    </div>


    <?php echo CHtml::ajaxSubmitButton(
      'Create MS List',
      array('setting/CreateMsList'),
      array(
        'beforeSend' => 'function(){
                                             $("#submit").attr("disabled",true);
            }',

        'complete' => 'function(){
                                             $("#plots").each(function(){ });
                                             $("#submit").attr("disabled",false);
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
    <?php $this->endWidget(); ?>
</div>
</section>

<div class="col-md-4 col-xs-12" id="ms-ranges">
  <table class="table table-bordered">
    <thead style="color:white;">
      <tr><th colspan="4" class="alert-danger" style="color:white;">Current MS No. Ranges </th></tr>
        <tr><th>Project</th><th>Property Type</th><th>Start </th><th>End</th></tr>
        </thead>
          <tbody>
            <?php
            foreach($msnos as $ms){
            ?>
            <tr><td><?php echo $ms['project_name'];?></td><td><?php echo $ms['title'];?></td><td><?php echo $ms['start'];?></td><td><?php echo $ms['end'];?></td></tr>

         <?php }?>
        </tbody>
 </table></div>