<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.js"></script>

<div class="page-content">
<div class="page-header">
<h1>Dashboard</h1>
</div>
<!-- /.page-header -->

<div>
<div class="col-xs-12">

<div class="widget-box widget-color-dark ">
<div class="widget-header">
<h5 class="widget-title bigger lighter yellow"> <i class="ace-icon fa fa-table"></i> Property Summary </h5>
</div>
<div class="widget-body">
<div class="widget-main ">
<div>
<div class="col-xs-12 ">

<div class="infobox-container">

<a  class="infobox-icon ajaxlink pointer" href="<?php echo $this->CreateAbsoluteUrl("member/booking");?>">
<div class="infobox infobox-green" href="#">
    <div class="infobox-icon"> <i class="ace-icon fas fa-file-signature"></i> </div>
        <div class="infobox-data"> <span id="booking1" class="infobox-data-number"></span>
            <div class="infobox-content font-12 bolder">Bookings</div>
        </div>
</div>
</a>
<a  class="infobox-icon ajaxlink pointer" href="<?php echo $this->CreateAbsoluteUrl("member/allotments");?>">
<div class="infobox infobox-green" href="#">
    <div class="infobox-icon"> <i class="ace-icon fas fa-file-signature"></i> </div>
        <div class="infobox-data"> <span id="alt" class="infobox-data-number"></span>
            <div class="infobox-content font-12 bolder">Allotments/Transfers</div>
        </div>
</div>
</a>
<a  class="infobox-icon ajaxlink pointer" href="<?php echo $this->CreateAbsoluteUrl("member/jointmembership");?>">
    <div class="infobox infobox-green ajaxlink pointer" href="#">
        <div class="infobox-icon"> <i class="ace-icon fas fa-users"></i> </div>
            <div class="infobox-data"> <span id="jm" class="infobox-data-number"></span>
                <div class="infobox-content font-12 bolder">Joint Memberships</div>
            </div>
    </div>
</a>
<a  class="infobox-icon ajaxlink pointer" href="<?php echo $this->CreateAbsoluteUrl("member/transfer");?>">
<div class="infobox infobox-pink ajaxlink pointer" href="#">
    <div class="infobox-icon"> <i class="ace-icon fas fa-exchange-alt"></i> </div>
        <div class="infobox-data"> <span id="trans" class="infobox-data-number"></span>
        <div class="infobox-content font-12 bolder">Transfer in Process</div>
    </div>
</div>
</a>
<a  class="infobox-icon ajaxlink pointer" href="<?php echo $this->CreateAbsoluteUrl("member/transfer");?>">
<div class="infobox infobox-red ajaxlink pointer" href="#">
    <div class="infobox-icon"> <i class="ace-icon fas fa-ban"></i> </div>
    <div class="infobox-data"> <span id="cancel" class="infobox-data-number"></span>
    <div class="infobox-content font-12 bolder">Cancellations in Process</div>
    </div>
</div>
</a>

<div class="space-8"></div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div>
<div class="col-xs-12" id="properties-counts-div">
<hr>
<br>
<div class="alert alert-info">
<button class="btn btn-primary" onclick="$('.load-property-info-loading').show(); loadajaxdata('https://fdhlpk.com/property/web/index.php?r=portal/members/default/getpcounts','properties-counts-div');"><i class="ace-icon glyphicon glyphicon-repeat"></i> Click here to load Property Info</button>

</div>
<!--<img src="https://fdhlpk.com/property/web/images/45.gif" height="40px" class="load-property-info-loading" hidden=""> --> 

<div class="load-property-info-loading" hidden="" id="data">

</div>

<!-- /.col --> 

<script type="text/javascript">
</script> 
</div>
<!-- /.col --> 
</div>
<div class="space-8"></div>
<!--
                        <div>
                            <div class="col-xs-12" id="dashboard-amounts">
                            <div class="alert alert-danger">
                                  <button class="btn btn-danger" onclick="$('.load-fin-data-loading').show(); loadajaxdata('https://fdhlpk.com/property/web/index.php?r=portal/members/default/getfcounts','dashboard-amounts');"><i class="ace-icon glyphicon glyphicon-repeat"></i>  Click here to Load Financial Data</button>
                            </div>
                                  <img src="https://fdhlpk.com/property/web/images/45.gif" height="40px" class="load-fin-data-loading" hidden="">
                                  <strong class="load-fin-data-loading" hidden="">Loading Financial Data ..</strong>
                                  <script type="text/javascript">
                                 </script>
                            </div>
                        </div>---> 
</div>
<script>
  //  $(document).ready(function() {
   // window.setInterval(function() { loadData('Member/Mybooking', $('.booking')); }, 1000);
   // window.setInterval(function() { loadData('Myalt', $(".rx")); }, 1000);
//});
/* var loadData = function(page, booking) {
    $.ajax({
        type: "GET",
        url: page,
        dataType: "html",
        success: function(response){
           // booking.html(response);
            $("#booking").html('booking');
            $(json).each(function(i,val)
            {
	listItems+= "<option value='" + val.id + "'>" + val.street + "</option>";
            });
        }

    });
}; */
$(document).ready(function () {
    function load(id)
{
$.ajax({
      type: "POST",
      url:    "Booking1",
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var listItems='';
	$(json).each(function(i,val){
	listItems+= "<option value='" + val.id + "'>" + val.booking + "</option>";
});listItems+="";
$("#booking1").html(listItems);
//setTimeout(load, 1000)
          }
    });

	$.ajax({
      type: "POST",
      url:    "Alt",
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var listItems='';
	$(json).each(function(i,val){
	listItems+= "<option value='" + val.id + "'>" + val.alt + "</option>";
});listItems+="";
$("#alt").html(listItems);
//setTimeout(load, 1000)
          }
    });
	$.ajax({
      type: "POST",
      url:    "Jm",
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var listItems='';
	$(json).each(function(i,val){
	listItems+= "<option value='" + val.id + "'>" + val.jm + "</option>";
});listItems+="";
$("#jm").html(listItems);
//setTimeout(load, 1000)
          }
    });
	$.ajax({
      type: "POST",
      url:    "Trans",
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var listItems='';
	$(json).each(function(i,val){
	listItems+= "<option value='" + val.id + "'>" + val.trans + "</option>";
});listItems+="";
$("#trans").html(listItems);
//setTimeout(load, 1000)
          }
    });
	$.ajax({
      type: "POST",
      url:    "Cancelplot",
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var listItems='';
	$(json).each(function(i,val){
	listItems+= "<option value='" + val.id + "'>" + val.cancel + "</option>";
});listItems+="";
$("#cancel").html(listItems);
//setTimeout(load, 1000)
          }
    });
	
	/*$.ajax({
      type: "GET",
      url:    "Propertydata",
	  contenetType:"json",
      success: function(jsonList){var json = $.parseJSON(jsonList);
var listItems='';
	$(json).each(function(i,val){
	 
	listItems+= "<table border=1><tr><td>" + val.tplots + "</td></tr></table>";
});
//alert(listItems);
 $("#data").html(listItems);
//listItems+="";

//setTimeout(load, 1000)
          }
    });
	*/
	$.ajax({    
        type: "GET",
        url: "Propertydata",             
        dataType: "html",                  
        success: function(data){                    
            $("#data").html(data); 
           
        }
    });
	
	
	
}
/* function load() {
    $.ajax({ //create an ajax request to load_page.php
        type: "GET",
        url: "Member/Mybooking",
       // dataType: "html", //expect html to be returned
        contenetType:"json",
        //success: function (jsonList) {
         success: function(jsonList){ var json = $.parseJSON(jsonList);
            var json = $.parseJSON(jsonList);
            $("#booking1212").val(response);
            setTimeout(load, 1000)
        }
    });
} */

load(); //if you don't want the click

});




</script>