
		<html lang="en">

<script src='https://www.google.com/recaptcha/api.js'></script>
<head>
    <meta http-equiv="Content-Security-Policy" content="block-all-mixed-content">

<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Royal Developers & Builders</title>

		<!---Start:CSS/Style---->
        <link href="<?php echo Yii::app()->baseUrl; ?>/css/login/bootstrap.min.css" rel="stylesheet" />
		<link href="<?php echo Yii::app()->baseUrl; ?>/css/login/bootstrap-responsive.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/css/login/font-awesome.min.css" />
		<link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/css/login/custom.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/css/login/jquery-ui-1.10.2.custom.min.css" />
		<link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/css/login/chosen.css" />
		<link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/css/login/datepicker.css" />
		<link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/css/login/bootstrap-timepicker.css" />
		<link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/css/login/daterangepicker.css" />
		<link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/css/login/colorpicker.css" />
        <link href="<?php echo Yii::app()->baseUrl; ?>/css/login/ace.min.css" rel="stylesheet" media="screen">
		<link href="<?php echo Yii::app()->baseUrl; ?>/css/login/ace-responsive.min.css" rel="stylesheet" media="screen">
        <link href="<?php echo Yii::app()->baseUrl; ?>/css/login/font-awesome.css" rel="stylesheet" media="screen">
        <!---END:CSS/Style---->


<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<!-----JS FIles---->
		<!-- basic scripts -->
		<script src="<?php echo Yii::app()->baseUrl; ?>/js/memberjs/jquery.min.js"></script>
		<script src="<?php echo Yii::app()->baseUrl; ?>/js/memberjs/bootstrap.min.js"></script>
		<!-- page specific plugin scripts -->

		<!--[if lt IE 9]>
		<script type="text/javascript" src="assets/js/excanvas.min.js"></script>
		<![endif]-->
		<link rel="stylesheet" href="//code.jquery.com/ui/1.8.10/themes/smoothness/jquery-ui.css" type="text/css">
<script type="text/javascript" src="//ajax.aspnetcdn.com/ajax/jquery.ui/1.8.10/jquery-ui.min.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/memberjs/jquery-ui-1.10.2.custom.min.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/memberjs/jquery.ui.touch-punch.min.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/memberjs/jquery.slimscroll.min.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/memberjs/jquery.easy-pie-chart.min.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/memberjs/jquery.sparkline.min.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/memberjs/jquery.flot.min.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/memberjs/jquery.flot.pie.min.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/memberjs/jquery.flot.resize.min.js"></script>
		<!-- ace scripts -->
		<script src="<?php echo Yii::app()->baseUrl; ?>/js/memberjs/ace-elements.min.js"></script>
		<script src="<?php echo Yii::app()->baseUrl; ?>/js/memberjs/ace.min.js"></script>

		<meta charset="utf-8" />
		<title>RDLPK-Asset Management System</title>
		<meta name="description" content="overview & stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<style>
body {
  overflow: hidden; /* Hide scrollbars */
}
</style>
	</head>
    
	<body class="no-skin">
	<div class="loader-background"></div>
    <?php //include("header.php"); ?>
    	<!----Start: Header-->
		<div id="navbar" class="navbar navbar-default ace-save-state">
			<div class="navbar-container ace-save-state" id="navbar-container">
				
				<div class="navbar-header pull-left float-none-m text-center-m">
					<a href="dashboard" class="navbar-brand ajaxlink float-none-m">
						<small id="logo-text">
						<img width="140" height="100" src="<?php echo Yii::app()->request->baseUrl.'/css/avatars/rdbl-logo.png';?>"/>
						
						</small>	
					</a>
				
				</div>

				<div class="navbar-buttons navbar-header pull-right position-r" role="navigation">
					
				<div class="btn-toolbar">
			<div class="btn-group">
				<a href="news"><button class="btn btn-danger btn-large icon-bell"> News</button></a>
				<a href="inbox"><button class="btn btn-success btn-large icon-comment"> Inbox</button></a>
			
			</div>
			<div class="btn-group">
			<button   data-toggle="dropdown" class="btn btn-meduim btn-success dropdown-toggle">  <small>Welcome,
		    <?php echo Yii::app()->session['member_array']['name']?> <i class="icon-angle-down icon-on-right"></small></i></button>
			<img style="border-radius:250px;" class="nav-user-photo" src="<?php echo Yii::app()->request->baseUrl.'/upload_pic/'.Yii::app()->session['member_array']['image']; ?>">
			<ul class="dropdown-menu">
			  <li><a href="profile">Profile </a></li>
			  <li><a href="logout">Logout</a></li>
			</ul>
		  </div>
		</div>


				</div>
			</div><!-- /.navbar-container -->
		</div>
    	<!-----End:Header---->
		<div class="container-fluid" id="main-container">
		<?php //include("sidebar.php");?>
        <!----Start: sidebar-->
        			<a href="#" id="menu-toggler"><span></span></a><!-- menu toggler -->
			<div id="sidebar">
				<div id="sidebar-shortcuts">
					<div id="sidebar-shortcuts-large">
						<button class="btn btn-small btn-success"><i class="icon-signal"></i></button>
						<button class="btn btn-small btn-info"><i class="icon-pencil"></i></button>
						<button class="btn btn-small btn-warning"><i class="icon-group"></i></button>
						<button class="btn btn-small btn-danger"><i class="icon-cogs"></i></button>
					</div>
					<div id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>
						<span class="btn btn-info"></span>
						<span class="btn btn-warning"></span>
						<span class="btn btn-danger"></span>
					</div>
				</div><!-- #sidebar-shortcuts -->
				<ul class="nav nav-list">
					<li>
					  <a href="<?php echo $this->CreateAbsoluteUrl("member/dashboard");?>">
						<i class="icon-dashboard"></i>
						<span>Dashboard</span>

					  </a>
					</li>
					<li>
					  <a href="#" class="dropdown-toggle" >
						<i class="icon-building"></i>
						<span>Property</span>
						<b class="arrow icon-angle-down"></b>
					  </a>
					  <ul class="submenu">
						<li><a href="<?php echo $this->CreateAbsoluteUrl("member/booking");?>"><i class="icon-double-angle-right"></i> Booking</a></li>
						<li><a href="<?php echo $this->CreateAbsoluteUrl("member/allotments");?>"></i> Allotments/Transfer</a></li>
						<li><a href="<?php echo $this->CreateAbsoluteUrl("member/jointmembership");?>"></i> Joint Memberships</a></li>
						<li><a href="<?php echo $this->CreateAbsoluteUrl("member/transfer");?>"></i>Transfer in Process</a></li>
						<li><a href="<?php echo $this->CreateAbsoluteUrl("member/cancellation");?>"></i>Cancellation in Process</a></li>
						
					  </ul>
					</li>
					<li>
					  <a href="#" class="dropdown-toggle" >
						<i class="icon-group"></i>
						<span>Accounts</span>
						<b class="arrow icon-angle-down"></b>
					  </a>
					  <ul class="submenu">
					 <li><a href="paymentsummary"><i class="icon-double-angle-right"></i>Payment Summary</a></li>
					<li><a href="transaction"><i class="icon-double-angle-right"></i>Transaction History</a></li>
					  </ul>
					</li>
					<li>
					  <a href="#" class="dropdown-toggle" >
					  <i class="icon-user"></i>
						<span>Profile</span>
						<b class="arrow icon-angle-down"></b>
					  </a>
					  <ul class="submenu">
						<li><a href="profile"><i class="icon-double-angle-right"></i>My Profile</a></li>
						<li><a href="changepassword"><i class="icon-double-angle-right"></i>Change Password</a></li>
					  </ul>
					</li>
					
					<li class="">
					  <a href="news">
						<i class="icon-bell-alt"></i>
						<span>News Alerts</span>
						
					  </a>
					</li>	
					<li class="">
					  <a href="inbox">
						<i class="icon-comment"></i>
						<span>Inbox</span>
						
					  </a>
					</li>
					<li class="">
					  <a href="apps">
						<i class="icon-laptop"></i>
						<span>Mobile Apps</span>
						
					  </a>
					</li>
					
					<li>
					  <a href="#" class="dropdown-toggle" >
					  <i class="icon-question-sign"></i>
						<span>Faqs</span>
						<b class="arrow icon-angle-down"></b>
					  </a>
					  <ul class="submenu">
						<li><a target="_blank" href="https://www.royalorchard.pk/bylawsmultan"><i class="icon-double-angle-right"></i>Royal Orchard Multan</a></li>
						
					  </ul>
					</li>
					
					<li >
					  <a href="#" class="dropdown-toggle" >
						<i class="icon-legal"></i>
						<span>SOPs</span>
					
					  </a>
					 
					</li>

				</ul><!--/.nav-list-->
				<div id="sidebar-collapse"><i class="icon-double-angle-left"></i></div>
			</div><!--/#sidebar-->

        <!----END: Sidebar-->
		      <div id="main-content" class="clearfix">
					<!--<div id="breadcrumbs">
						<ul class="breadcrumb">
							<li><i class="icon-home"></i> <a href="#">Home</a><span class="divider"><i class="icon-angle-right"></i></span></li>
							<li class="active">Dashboard</li>
						</ul>
						
						
					</div>-->
					<?php echo $content; ?>
				<!--/#page-content-->
			</div><!-- #main-content -->
		</div><!--/.fluid-container#main-container-->
		<?php
			//include("scrolltop.php");
			//include("libs_js.php");
			//include("footer.php");
		?>
	</body>
</html>



























<script type="text/javascript">
$(document).ready(function() {

   //// $('nav').easyPie();
});
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#carouselh').jsCarousel();

    });
</script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=6Lc9_ZoUAAAAADVUGv915pJEh04Fb-brTeQShciR

&callback=initMap"
type="text/javascript"></script>
	<script type="text/javascript">
$(function() {
	$('.dialogs,.comments').slimScroll({
        height: '300px'
    });
	$('#tasks').sortable();
	$('#tasks').disableSelection();
	$('#tasks input:checkbox').removeAttr('checked').on('click', function(){
		if(this.checked) $(this).closest('li').addClass('selected');
		else $(this).closest('li').removeClass('selected');
	});
	var oldie = $.browser.msie && $.browser.version < 9;
	$('.easy-pie-chart.percentage').each(function(){
		var $box = $(this).closest('.infobox');
		var barColor = $(this).data('color') || (!$box.hasClass('infobox-dark') ? $box.css('color') : 'rgba(255,255,255,0.95)');
		var trackColor = barColor == 'rgba(255,255,255,0.95)' ? 'rgba(255,255,255,0.25)' : '#E2E2E2';
		var size = parseInt($(this).data('size')) || 50;
		$(this).easyPieChart({
			barColor: barColor,
			trackColor: trackColor,
			scaleColor: false,
			lineCap: 'butt',
			lineWidth: parseInt(size/10),
			animate: oldie ? false : 1000,
			size: size
		});
	})
	$('.sparkline').each(function(){
		var $box = $(this).closest('.infobox');
		var barColor = !$box.hasClass('infobox-dark') ? $box.css('color') : '#FFF';
		$(this).sparkline('html', {tagValuesAttribute:'data-values', type: 'bar', barColor: barColor , chartRangeMin:$(this).data('min') || 0} );
	});
  var data = [
	{ label: "social networks",  data: 38.7, color: "#68BC31"},
	{ label: "search engines",  data: 24.5, color: "#2091CF"},
	{ label: "ad campaings",  data: 8.2, color: "#AF4E96"},
	{ label: "direct traffic",  data: 18.6, color: "#DA5430"},
	{ label: "other",  data: 10, color: "#FEE074"}
  ];
 var placeholder = $('#piechart-placeholder').css({'width':'90%' , 'min-height':'150px'});
 $.plot(placeholder, data, {
	series: {
        pie: {
            show: true,
			tilt:0.8,
			highlight: {
				opacity: 0.25
			},
			stroke: {
				color: '#fff',
				width: 2
			},
			startAngle: 2

        }
    },
    legend: {
        show: true,
		position: "ne",
	    labelBoxBorderColor: null,
		margin:[-30,15]
    }
	,
	grid: {
		hoverable: true,
		clickable: true
	},
	tooltip: true, //activate tooltip
	tooltipOpts: {
		content: "%s : %y.1",
		shifts: {
			x: -30,
			y: -50
	}
	}
 });
  var $tooltip = $("<div class='tooltip top in' style='display:none;'><div class='tooltip-inner'></div></div>").appendTo('body');
  placeholder.data('tooltip', $tooltip);
  var previousPoint = null;
  placeholder.on('plothover', function (event, pos, item) {
	if(item) {
		if (previousPoint != item.seriesIndex) {
			previousPoint = item.seriesIndex;
			var tip = item.series['label'] + " : " + item.series['percent']+'%';
			$(this).data('tooltip').show().children(0).text(tip);
		}
		$(this).data('tooltip').css({top:pos.pageY + 10, left:pos.pageX + 10});
	} else {
		$(this).data('tooltip').hide();
		previousPoint = null;
	}

 });
		var d1 = [];
		for (var i = 0; i < Math.PI * 2; i += 0.5) {
			d1.push([i, Math.sin(i)]);
		}
		var d2 = [];
		for (var i = 0; i < Math.PI * 2; i += 0.5) {
			d2.push([i, Math.cos(i)]);
		}
		var d3 = [];
		for (var i = 0; i < Math.PI * 2; i += 0.2) {
			d3.push([i, Math.tan(i)]);
		}
		var sales_charts = $('#sales-charts').css({'width':'100%' , 'height':'220px'});
		$.plot("#sales-charts", [
			{ label: "Domains", data: d1 },
			{ label: "Hosting", data: d2 },
			{ label: "Services", data: d3 }
		], {
			hoverable: true,
			shadowSize: 0,
			series: {
				lines: { show: true },
				points: { show: true }
			},
			xaxis: {
				tickLength: 0
			},
			yaxis: {
				ticks: 10,
				min: -2,
				max: 2,
				tickDecimals: 3
			},
			grid: {
				backgroundColor: { colors: [ "#fff", "#fff" ] },
				borderWidth: 1,
				borderColor:'#555'
			}
		});


		$('[data-rel="tooltip"]').tooltip();
})
		</script>