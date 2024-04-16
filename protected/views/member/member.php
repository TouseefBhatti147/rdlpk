
<div class="row">
<div class=" col-sm-10 col-sm-offset-1 no-padding">
<div class="main-content-inner" style="bgcolor:#FFF;">
<div class="login-container" style="bgcolor:#FFF;">
<div class="space-20 no-margin-m"></div>
<div class="position-relative">
<div id="login-box" class="login-box visible widget-box no-border">
<div class="widget-body">
<div class="widget-main">
<div class="row center text-center" align="center"> <img src="http://rdlpk.com/images/logo.png" height="50px" width="auto">
<h3 class="green bolder  inline">Member Web Portal</h4>
</div>
<hr class="hr-4">
<div class="center">
<h4 class="blue bolder"> Login to Book Online</h4>
<small><strong>OR</strong></small> <a href="#">
<h6 class="blue bolder"> Register to proceed <i class="ace-icon fa fa-angle-double-right"></i></h6>
</a> </div>
<hr class="hr-4">

<div id="processing-msg" class="alert alert-info" hidden=""><img src="https://fdhlpk.com/property/web/images/45.gif" height="40px"> Processing your request...</div>
 <?php $form=$this->beginWidget('CActiveForm', array(
 'id'=>'member_login_form',
 'enableAjaxValidation'=>false,
  'enableClientValidation'=>true,
                'method' => 'POST',
                'clientOptions'=>array(
                     'validateOnSubmit'=>true,
                     'validateOnChange'=>true,
                     'validateOnType'=>false,
  ),
));

?>
<input type="hidden" name="_csrf" value="c25LekpRNEsxW3woJxYGACANKDlyfGE8QEM/PnkmBSYVHycIAD9aAw==">
<fieldset>
<label class="block clearfix">
<span class="block input-icon input-icon-right">
<input type="text" id="username" class="form-control width-100" name="username" placeholder="Email Address">


<div class="text-danger"></div>
<i class="ace-icon fa fa-user"></i> </span>
</label>
<label class="block clearfix">
<span class="block input-icon input-icon-right">
<input type="password" id="password" class="form-control width-100" name="password" placeholder="Password">
<div class="text-danger"></div>
<i class="ace-icon fa fa-lock"></i> </span>
</label>
<div id="error-div" class="errorMessage" style="display: none; color:#F00; font-weight:bold;"></div>

<div class="space"></div>
<div class="block clearfix"> 

<?php echo CHtml::ajaxSubmitButton(
                                'Login',
    array('/member/getLogin'),
                                array(  
                'beforeSend' => 'function(){ 
                                             $("#login").attr("disabled",true);
            }',
                                        'complete' => 'function(){ 
                                             $("#user_login_form").each(function(){ this.reset();});
                                             $("#login").attr("disabled",false);
                                        }',
                   'success'=>'function(data){  
                                           //  var obj = jQuery.parseJSON(data); 
                                            // View login errors!
        
                                             if(data == 1){
												// alert("we are here");
                                         location.href = "dashboard";
                                      }
          else{
                                                $("#error-div").show();
                                                $("#error-div").html(data);$("#error-div").append("");
												return false;
                                             }
 
                                        }' 
    ),
                         array("id"=>"login","class" => "btn btn-success")      
                ); ?>
    <?php $this->endWidget(); ?>

</div>
<div class="space-4"></div>
<br>
<div class="bolder"><i class=" icon-credit-card
"></i> Already a member? <a class="label label-pink" href="activate_account">
<i class="ace-icon fa fa-cog fa-spin white"></i> Click here to Request For Login Access</a></div>
</fieldset>
</form>
<div class="space-6"></div>
<div class="social-or-login center"> <span class="bigger-120 bolder">Need Help?</span> </div>
<div class="space-6"></div>
<div class="bolder"><i class="ace-icon fa fa-info-circle green"></i> For any assistance, please write us at <a target="_blank" href="mailto:sales@rdlpk.com">sales@rdlpk.com</a></div>
<div class="center" align="center">
<div class="btn-group btn-corner center"> <a target="_blank" href="https://multan.royalorchard.pk/bylaws/" class="btn btn-success btn-xs"> <i class="fa fa-question-circle "></i> FAQs </a> 
<a  href="https://multan.royalorchard.pk/bylaws/" class="btn btn-success btn-xs"> <i class=" fa fa-legal "></i> SOPs </a> 
 </div>
</div>
</div>
<!-- /.widget-main -->

<div class="toolbar clearfix">
<div style="width:100%"> <a href="forgot_password" class="white"> <i class="ace-icon fa fa-angle-double-left"></i> Forgot password? (click here) </a> </div>

</div>
</div>
<!-- /.widget-body --> 

</div>
<!-- /.login-box --> 

</div>
<!-- /.position-relative --> 

</div>
<hr>


</div>

<!--  
                            <div class="text-center block">
                                    <p class="text-muted">Smart Future Technologies &copy; < ?=date('Y')?> - All rights reserved.  </p>
                            </div>--> 

</div>
</div>
<div class="position-center-fixed" align="center">
<div id="processing-request" class="alert alert-info" hidden=""> <img src="https://fdhlpk.com/property/web/images/45.gif" height="40px"> Processing your request.. </div>
</div>


<!------START:Flash News---------->
<div id="important-notices" class="modal fade" role="dialog" style="display: none;">
<div class="modal-dialog"> 

<!-- Modal content-->
<div class="modal-content">
<div class="modal-header label-primary">
<button type="button" class="close white" data-dismiss="modal">×</button>
<h3 class="modal-title text-left label-primary yellow bolder">Flash News</h3>
</div>
<div class="modal-body no-padding">
<div class="alert label-inverse mb-0">
<h5 class=" yellow"><i class="fa fa-star fa-spin"></i> Increase in the Price of One Capital Residences</h5>
</div>
<div class="alert alert-info position-relative">
<div class="text-right label label-info position-absolute top-0 right-0 opacity-5"><strong>Published On:</strong> 14-Jun-2022 </div>
<div>
<div style="background:#eeeeee none repeat scroll 0% 0%; border:1px solid #cccccc; padding:5px 10px; text-align:center"><span style="color:#c0392b"><strong><span style="font-size:20px">IMPORTANT!</span></strong></span><br>
</div>
<p><span style="color:#000000"><span style="font-size:16px">Due to exponential surge in construction material prices, management has decided to increase the price of <strong>One Capital Residences</strong> to </span></span><span style="color:#990000"><span style="font-size:16px">Rs. <strong>13,500</strong>/SFT</span></span><span style="color:#000000"><span style="font-size:16px"> from <u><strong>1st week of July 2022</strong></u>.<br>
<br>
New payment plans will be shared in due course of time.</span></span></p>
</div>
<div> <img src="https://fdhlpk.com/property/web/uploads/newsalert/IvgQgZxfpaVZ_F0yEtGSH08NmgGiJH_s.jpg" width="100%" height="auto" class="img-thumbnail img-responsive"> </div>
<div> <a class="btn btn-info " href="https://www.smartcitypk.com" target="_blank"> Read More <i class="fa fa-external-link"></i></a> </div>
</div>
<hr>
<div class="alert label-inverse mb-0">
<h5 class=" yellow"><i class="fa fa-star fa-spin"></i> Payment Plan for One Capital - Jade Tower</h5>
</div>
<div class="alert alert-info position-relative">
<div class="text-right label label-info position-absolute top-0 right-0 opacity-5"><strong>Published On:</strong> 21-May-2022 </div>
<div> </div>
<div> <img src="https://fdhlpk.com/property/web/uploads/newsalert/NwJKgO23p0f5PzqkJzQumrDS4x65v7pm.jpg" width="100%" height="auto" class="img-thumbnail img-responsive"> </div>
<div> <a class="btn btn-info " href="https://www.smartcitypk.com/one-capital" target="_blank"> Read More <i class="fa fa-external-link"></i></a> </div>
</div>
<hr>
<div class="alert label-inverse mb-0">
<h5 class=" yellow"><i class="fa fa-star fa-spin"></i> Allotment Announcement for Residential &amp; Commercial Plots </h5>
</div>
<div class="alert alert-info position-relative">
<div class="text-right label label-info position-absolute top-0 right-0 opacity-5"><strong>Published On:</strong> 21-May-2022 </div>
<div> </div>
<div> <img src="https://fdhlpk.com/property/web/uploads/newsalert/OnuyWJjte136QIm5D_EpDPFDzXaIOfku.jpg" width="100%" height="auto" class="img-thumbnail img-responsive"> </div>
<div> <a class="btn btn-info " href="https://www.lahoresmartcitypk.com/" target="_blank"> Read More <i class="fa fa-external-link"></i></a> </div>
</div>
<hr>
</div>
<div class="modal-footer"> <span class="pull-left">
<input type="radio" class="donotshow-notice " onchange="createCookie('donotshow-notice','1',1);">
Don't show me again for rest of the day </span>
<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
<!------END:Flash News---------->
<div id="yii-debug-toolbar" data-url="/property/web/index.php?r=debug%2Fdefault%2Ftoolbar&amp;tag=62fc99b861011" style="display:none" class="yii-debug-toolbar-bottom"></div>

<script type="text/javascript">jQuery(document).ready(function () {
try{jQuery('#w0').yiiActiveForm([], []);}catch(err){console.log(err.message);}
});</script> 
<script type="text/javascript">

                 
                     document.addEventListener("DOMContentLoaded", function(event) {    
                         var shownotice = 1;    
                         if(readCookie('donotshow-notice') == '1'){    
                             console.log('will not show news alert for 24 hours');    
                         }else{
    						  $('#important-notices').modal({
                        	     backdrop: 'static'//,
                        	    // keyboard: false
                        	  });    
                         }
    				});
                  
         
               /*
            	$.gritter.add({
            		title: 'Important Notice',
            		text: $('#members_notice').html(),
            		class_name: 'gritter-info gritter-center gritter-transparent',
            		time: 10000,
            		fade: true,
            		fade_in_speed: 'medium',
            	});
                */

            	

            	       	

    </script> 

<!--Start of Tawk.to Script--> 
<script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/592416778028bb7327047533/default';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
        })();
    </script> 
<!--End of Tawk.to Script-->

<iframe frameborder="0" scrolling="no" style="background-color: transparent; border: 0px; display: none;"></iframe>
<div id="GOOGLE_INPUT_CHEXT_FLAG" input="" input_stat="{&quot;tlang&quot;:true,&quot;tsbc&quot;:true,&quot;pun&quot;:true,&quot;mk&quot;:true,&quot;ss&quot;:true}" style="display: none;"></div>
<script async="" charset="UTF-8" src="https://embed.tawk.to/_s/v4/app/62f5afe5f63/languages/en.js"></script>
<div id="pciats602b281660721597392" class="widget-visible">
<iframe src="about:blank" frameborder="0" scrolling="no" width="324px" height="44px" style="outline:none !important; visibility:visible !important; resize:none !important; box-shadow:none !important; overflow:visible !important; background:none !important; opacity:1 !important; filter:alpha(opacity=100) !important; -ms-filter:progid:DXImageTransform.Microsoft.Alpha(Opacity 1}) !important; -mz-opacity:1 !important; -khtml-opacity:1 !important; top:auto !important; right:10px !important; bottom:0px !important; left:auto !important; position:fixed !important; border:0 !important; min-height:44px !important; min-width:324px !important; max-height:44px !important; max-width:324px !important; padding:0 !important; margin:0 !important; -moz-transition-property:none !important; -webkit-transition-property:none !important; -o-transition-property:none !important; transition-property:none !important; transform:none !important; -webkit-transform:none !important; -ms-transform:none !important; width:324px !important; height:44px !important; display:block !important; z-index:1000001 !important; background-color:transparent !important; cursor:none !important; float:none !important; border-radius:unset !important; pointer-events:auto !important; clip:auto !important; color-scheme:light !important;" id="uh62bg9iul0o1660721597769" class="" title="chat widget"></iframe>
<iframe src="about:blank" frameborder="0" scrolling="no" width="350px" height="520px" style="outline:none !important; visibility:visible !important; resize:none !important; box-shadow:none !important; overflow:visible !important; background:none !important; opacity:1 !important; filter:alpha(opacity=100) !important; -ms-filter:progid:DXImageTransform.Microsoft.Alpha(Opacity 1}) !important; -mz-opacity:1 !important; -khtml-opacity:1 !important; top:auto !important; right:0px !important; bottom:0px !important; left:auto !important; position:fixed !important; border:0 !important; min-height:520px !important; min-width:350px !important; max-height:520px !important; max-width:350px !important; padding:0 !important; margin:0 !important; -moz-transition-property:none !important; -webkit-transition-property:none !important; -o-transition-property:none !important; transition-property:none !important; transform:none !important; -webkit-transform:none !important; -ms-transform:none !important; width:350px !important; height:520px !important; display:none !important; z-index:auto !important; background-color:transparent !important; cursor:none !important; float:none !important; border-radius:5px 5px  0 0 !important; pointer-events:auto !important; clip:auto !important; color-scheme:light !important;" id="timu7d3g99bg1660721598119" class="" title="chat widget"></iframe>
<iframe src="about:blank" frameborder="0" scrolling="no" width="360px" height="55px" style="outline:none !important; visibility:visible !important; resize:none !important; box-shadow:none !important; overflow:visible !important; background:none !important; opacity:1 !important; filter:alpha(opacity=100) !important; -ms-filter:progid:DXImageTransform.Microsoft.Alpha(Opacity 1}) !important; -mz-opacity:1 !important; -khtml-opacity:1 !important; top:auto !important; right:10px !important; bottom:60px; left:auto !important; position:fixed !important; border:0 !important; min-height:55px !important; min-width:360px !important; max-height:55px !important; max-width:360px !important; padding:0 !important; margin:0 !important; -moz-transition-property:none !important; -webkit-transition-property:none !important; -o-transition-property:none !important; transition-property:none !important; transform:none !important; -webkit-transform:none !important; -ms-transform:none !important; width:360px !important; height:55px !important; display:none !important; z-index:auto !important; background-color:transparent !important; cursor:none !important; float:none !important; border-radius:unset !important; pointer-events:auto !important; clip:auto !important; color-scheme:light !important;" id="fa9gis3ql5r81660721597600" class="" title="chat widget"></iframe>
<iframe src="about:blank" frameborder="0" scrolling="no" width="180px" height="108px" style="outline:none !important; visibility:visible !important; resize:none !important; box-shadow:none !important; overflow:visible !important; background:none !important; opacity:1 !important; filter:alpha(opacity=100) !important; -ms-filter:progid:DXImageTransform.Microsoft.Alpha(Opacity 1}) !important; -mz-opacity:1 !important; -khtml-opacity:1 !important; top:auto !important; right:80px !important; bottom:40px !important; left:auto !important; position:fixed !important; border:0 !important; min-height:108px !important; min-width:180px !important; max-height:108px !important; max-width:180px !important; padding:0 !important; margin:0px 0 0 0 !important; -moz-transition-property:none !important; -webkit-transition-property:none !important; -o-transition-property:none !important; transition-property:none !important; transform:rotate(0deg) translateZ(0); -webkit-transform:rotate(0deg) translateZ(0); -ms-transform:rotate(0deg) translateZ(0); width:180px !important; height:108px !important; display:none !important; z-index:1000000 !important; background-color:transparent !important; cursor:none !important; float:none !important; border-radius:unset !important; pointer-events:auto !important; clip:auto !important; color-scheme:light !important; -moz-transform:rotate(0deg) translateZ(0); -o-transform:rotate(0deg) translateZ(0); transform-origin:0; -moz-transform-origin:0; -webkit-transform-origin:0; -o-transform-origin:0; -ms-transform-origin:0;" id="b2clmuap1o681660721597785" class="" title="chat widget"></iframe>
</div>
