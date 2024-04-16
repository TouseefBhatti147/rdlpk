<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.js"></script>
<style>
body
		{
			overflow:scroll;
			height:100px;
		}
</style>
<div class="page-content">

	<div class="page-header">
		<h1>Member Message Inbox</h1>

	</div><!-- /.page-header -->

	<div class="space-6"></div>


	<div class="">
<div class="col-xs-12 no-padding-m">
<div>

<div class="widget-box widget-color-red">
<div class="widget-header">
<h5 class="widget-title"><a href="#" data-action="collapse"> <i class="1 ace-icon fa fa-chevron-up bigger-125 white"></i> </a> Inbox</h5>
<div class="widget-toolbar"> <a href="sendmessage" data-action="collapse" > <i class="1 ace-icon fa fa-chevron-up bigger-125"></i> <span style="font-color:black;">Send Message</span></a> </div>
</div>
        <div id="accordion2" class="accordion">
        <?php  foreach($inbox as $key){?>
                        <div class="accordion-group">
                          <div class="accordion-heading">
                            <a href="#<?php echo $key['id'];?>" data-parent="#accordion2" data-toggle="collapse" class="accordion-toggle collapsed">
                              <?php echo $key['title'];?>
                            </a>
                          </div>
                          <div class="accordion-body collapse" id="<?php echo $key['id'];?>" style="height: 0px;">
                            <div class="accordion-inner">
                               <?php echo $key['message'];?>
                            </div>
                          </div>
                        </div>
                        <!--<div class="accordion-group">
                          <div class="accordion-heading">
                            <a href="#collapseTwo" data-parent="#accordion2" data-toggle="collapse" class="accordion-toggle collapsed">
                              Collapsible Group Item #2
                            </a>
                          </div>
                          <div class="accordion-body collapse" id="collapseTwo">
                            <div class="accordion-inner">
                              Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                            </div>
                          </div>
                        </div>-->
           <?php  }?>             
        </div>
</div>

</div>
</div>
<!-- /.col --> 
</div>
<!-- /.row --> 

</div>
