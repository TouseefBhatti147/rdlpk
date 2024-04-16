<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.js"></script>
<style>
    @media (max-width:450px) {
        .show-on-mobile {
            display: table-row;
        }
		
		

    }
	body
		{
			overflow:scroll;
			height:100px;
		}
</style>
<div class="page-content">
	<div class="page-header">
		<h1>My Transaction</h1>
	</div><!-- /.page-header -->
	<div class="space-6"></div>
	<div class="">
<!-- PAGE CONTENT BEGINS HERE -->

<div class="row-fluid">
<div class="span12">
<table id="table_bug_report" class="table table-striped table-bordered table-hover">
<thead>
<tr>
<th class="center">Sr #</th>
<th class="">Dated</th>
<th class="">Membership No.</th>
<th class="hidden-480">Type</th>
<th class="hidden-480">Description</th>
<th>Amount (PKR)</th>
<th>Receipt No</th>
<th>Deposit By</th>
<th class="hidden-480">Status</th>

</tr>
</thead>
<tbody id="data">
 
</tbody>
</table>
 

</div>
<div class="span4">

</div>
<div class="span4">
<img style="float:center" id="loading" src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading1.gif">
</div>
<div class="span12">

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
        url: "Mytransaction",             
        dataType: "html",                  
        success: function(data){ 
		                   
            $("#data").html(data); 
			$('#loading').hide();
           
        }
    });	
});
</script>