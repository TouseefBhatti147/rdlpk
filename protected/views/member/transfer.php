<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.js"></script>
<style>
    @media (max-width:450px) {
        .show-on-mobile {
            display: table-row;
        }
		


    }
</style>
<div class="page-content">
	<div class="page-header">
		<h1>Transfer Property</h1>
	</div><!-- /.page-header -->
	<div class="space-6"></div>
	<div class="">
<!-- PAGE CONTENT BEGINS HERE -->

<div class="">
<div class="">
<table id="table_bug_report" class="table table-striped table-bordered table-hover">
<thead>
<tr>
<th class="center">Sr #</th>
<th class="">Project Name</th>
<th class="">Type</th>
<th class="">Membership No.</th>
<th class="hidden-480">Form No</th>
<th class="">Block Name</th>
<th>Transfer From</th>
<th>Transfer To</th>
<th class="hidden-480">Request Date</th>
<th></th>
</tr>
</thead>
<tbody id="data">


</tbody>
</table>
</div>
<!--/span--> 
</div>
<!--/row-->

<!-- PAGE CONTENT ENDS HERE --> 
</div>
<!--/row--> 

</div>
<script>
$(document).ready(function () 
{
$.ajax({    
        type: "GET",
        url: "Mytransfers",             
        dataType: "html",                  
        success: function(data){                    
            $("#data").html(data); 
           
        }
    });	
});
</script>