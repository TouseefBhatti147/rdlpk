 <div class="span12">
   
   
<h3>Finger print Rigistration and verification </h3>


<a class="btn btn-success" href="<?php echo Yii::app()->request->baseUrl; ?>/uareuapplet/Register/Register.html">Register</a>
<a class="btn btn-warning" href="<?php echo Yii::app()->request->baseUrl; ?>/uareuapplet/Login/Login.html">Verify</a><br /><br />
<p>Transfer Verification From Here</p>
<a class="btn btn-success" href="<?php echo $this->createAbsoluteUrl('user/verreq_list')?>">Transfer Verification</a>


    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
  Help  
</button>

    </div>
    
    
    
    

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Help</h4>
      </div>
      <div class="modal-body">
       <div class="span12">
<h4>In order to utilize biometrics from this site you will need to meet the below criteria:
</h4>

<p><b>System Requirements:</b></p>
<ol>
<li>U.are.U for Windows RTE 2.2.0 or later must be installed</li>
<li>Java JRE 1.5 or later must be installed</li>
<li>A compatible DigitalPersona fingerprint scanner</li>
</ol>
<p><b>Browser Requirements:</b></p>
<ul>
<li>Firefox 12 or later with Java Pugin(TM) "enabled"</li>
<li>Internet Explorer 8 or later</li>
<li>Google Chrome</li>
</ul>
</div>
      </div>
      
    </div>
  </div>
</div>
   

   