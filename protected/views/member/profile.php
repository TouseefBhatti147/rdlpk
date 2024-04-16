<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.js"></script>
<style>
.space-18, [class*=vspace-18] {
max-height:1px;
min-height:1px;
overflow:hidden;
margin:18px 0 17px
}
.space-16, [class*=vspace-16] {
max-height:1px;
min-height:1px;
overflow:hidden;
margin:16px 0 15px
}
.space-14, [class*=vspace-14] {
max-height:1px;
min-height:1px;
overflow:hidden;
margin:14px 0 13px
}
.space-12, [class*=vspace-12] {
max-height:1px;
min-height:1px;
overflow:hidden;
margin:12px 0 11px
}
.space-10, [class*=vspace-10] {
max-height:1px;
min-height:1px;
overflow:hidden;
margin:10px 0 9px
}
.space-8, [class*=vspace-8] {
max-height:1px;
min-height:1px;
overflow:hidden;
margin:8px 0 7px
}
.space-6, [class*=vspace-6] {
max-height:1px;
min-height:1px;
overflow:hidden;
margin:6px 0 5px
}
.space-4, [class*=vspace-4] {
max-height:1px;
min-height:1px;
overflow:hidden;
margin:4px 0 3px
}
.space-2, [class*=vspace-2] {
max-height:1px;
min-height:1px;
overflow:hidden;
margin:2px 0 1px
}
.space-0, [class*=vspace-0] {
max-height:1px;
min-height:1px;
overflow:hidden;
margin:0
}
.page-content>.row .col-lg-12, .page-content>.row .col-md-12, .page-content>.row .col-sm-12, .page-content>.row .col-xs-12 {
	float: left;
	max-width: 100%
}
.table-detail td>.profile-user-info {
	width: 100%
}

.profile-user-info {
	display: table;
	width: 98%;
	width: calc(100% - 24px);
	margin: 0 auto
}
.profile-user-info-striped {
	border: 1px solid #DCEBF7
}
.profile-user-info-striped .profile-info-name {
	color: #336199;
	background-color: #EDF3F4;
	border-top: 1px solid #F7FBFF
}
.profile-info-name, .profile-info-value {
	display: table-cell;
	border-top: 1px dotted #D5E4F1
}
.profile-info-name {
    font-weight: 600;
	text-align: right;
	padding: 6px 10px 6px 4px;
	color: #667E99;
	background-color: transparent;
	width: 110px;
	vertical-align: middle
}
.profile-user-info-striped .profile-info-value {
	border-top: 1px dotted #DCEBF7;
	padding-left: 12px
}
.white {
	color: #fff!important;
	font-size:13px;
}
.profile-picture {
	border: 1px solid #CCC;
	background-color: #FFF;
	padding: 4px;
	margin-left:25px;
	display: inline-block;
	max-width: 100%;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
	box-shadow: 1px 1px 1px rgba(0,0,0,.15)
}
.profile-info-row {
	display: table-row
}
.profile-info-row:first-child .profile-info-name, .profile-info-row:first-child .profile-info-value {
	border-top: none
}
.badge-info, .badge.badge-info, .label-info, .label.label-info {
	background-color: #3a87ad
}
.label-xlg.arrowed, .label-xlg.arrowed-in {
	margin-left: 7px
}
.label-info.arrowed:before {
	border-right-color: #3a87ad;
	-moz-border-right-colors: #3a87ad
}
.label-info.arrowed-in:before {
	border-color: #3a87ad #3a87ad #3a87ad transparent;
	-moz-border-right-colors: #3a87ad
}
.label-info.arrowed-right:after {
	border-left-color: #3a87ad;
	-moz-border-left-colors: #3a87ad
}
.label-info.arrowed-in-right:after {
	border-color: #3a87ad transparent #3a87ad #3a87ad;
	-moz-border-left-colors: #3a87ad
}
.label-sm.arrowed-in-right:after {
	right: -4px;
	border-width: 9px 4px
}
.label-white.label-info {
	color: #4e7a8f;
	border-color: #7aa1b4;
	background-color: #eaf3f7
}
.profile-info-name, .profile-info-value {
	display: table-cell;
	border-top: 1px dotted #D5E4F1
}
.profile-info-value {
	padding: 6px 4px 6px 6px
}
.profile-info-value>span+span:before {
	display: inline;
	content: ",";
	margin-left: 1px;
	margin-right: 3px;
	color: #666;
	border-bottom: 1px solid #FFF
}
.profile-info-value>span+span.editable-container:before {
	display: none
}
.profile-info-row:first-child .profile-info-name, .profile-info-row:first-child .profile-info-value {
	border-top: none
}
.profile-user-info-striped .profile-info-value {
	border-top: 1px dotted #DCEBF7;
	padding-left: 12px
}
.label-info.arrowed:before {
	border-right-color: #3a87ad;
	-moz-border-right-colors: #3a87ad
}
.label-info.arrowed-in:before {
	border-color: #3a87ad #3a87ad #3a87ad transparent;
	-moz-border-right-colors: #3a87ad
}
.label-info.arrowed-right:after {
	border-left-color: #3a87ad;
	-moz-border-left-colors: #3a87ad
}
.label-info.arrowed-in-right:after {
	border-color: #3a87ad transparent #3a87ad #3a87ad;
	-moz-border-left-colors: #3a87ad
}
.width-75 {
	width: 75%!important
}
body
		{
			overflow:scroll;
			height:100px;
		}
</style>
<div class="page-content">

	<div class="page-header">
		<h1>My Profile</h1>

	</div><!-- /.page-header -->

	<div class="space-6"></div>

<div class="">
<div class="col-xs-12 no-padding-m">
<div>
<?php foreach($member as $key){?>
<div id="user-profile-1" class="user-profile row">
<div class="col-xs-12 span3 center">
<div> <span class="profile-picture">
 <img id="avatar" class="editable img-responsive" alt="Profile Picture missing" src="<?php echo Yii::app()->request->baseUrl.'/upload_pic/'.$key['image']?>"> </span>
<div class="space-4"></div>
<div class="width-75 label label-info label-xlg arrowed-in arrowed-in-right">
<div class="inline position-relative"> <a href="#" class="user-title-label dropdown-toggle" data-toggle="dropdown"> <span class="white"><?php echo $key['name'];?></span> </a> </div>
</div>
</div>
<div class="hr hr12 dotted"></div>
</div>
<div class="col-xs-12 span9">
<div class="profile-user-info profile-user-info-striped">
<div class="profile-info-row label-info">
<div class=" label-info hide-on-mobile">&nbsp; </div>
<div class="profile-info-value label-info white no-border"> <span class="editable" id="about">Personal Information</span> </div>
</div>
<div class="profile-info-row">
<div class="profile-info-name"> CNIC/NICOP </div>
<div class="profile-info-value"> <span class="editable" id="username"><?php echo $key['cnic'];?></span> </div>
</div>
<div class="profile-info-row">
<div class="profile-info-name"> Father/Spouse </div>
<div class="profile-info-value"> <span class="editable" id="username"> <strong class="green"><?php echo $key['title'];?>:</strong> <?php echo $key['sodowo'];?> </span> </div>
</div>
<div class="profile-info-row label-info">
<div class=" label-info hide-on-mobile">&nbsp; </div>
<div class="profile-info-value label-info white no-border"> <span class="editable" id="about">Location</span> </div>
</div>
<div class="profile-info-row">
<div class="profile-info-name"> Address </div>
<div class="profile-info-value"> <span class="editable" id="about"><?php echo $key['address'];?></span> </div>
</div>
<div class="profile-info-row">
<div class="profile-info-name"> Country, City </div>
<div class="profile-info-value"> <i class="fa fa-map-marker green bigger-110"></i> <span class="editable" id="country"><?php echo $key['country'].','.$key['city'];?></span> <span class="editable" id="city">Rawalpindi</span> </div>
</div>
<div class="profile-info-row label-info">
<div class=" label-info hide-on-mobile">&nbsp; </div>
<div class="profile-info-value label-info white no-border"> <span class="editable" id="about">Contact Information</span> </div>
</div>
<div class="profile-info-row">
<div class="profile-info-name"> Email </div>
<div class="profile-info-value"> <span class="editable" id="about"><i class="fa fa-envelope blue"></i> <?php echo $key['email'];?></span> </div>
</div>
<div class="profile-info-row">
<div class="profile-info-name"> Phone </div>
<div class="profile-info-value"> <span class="editable" id="about"> <i class="fa fa-mobile-alt blue"></i><?php echo $key['phone'];?></span> </div>
</div>
<div class="profile-info-row">
<div class="profile-info-name"> Alternative Phone </div>
<div class="profile-info-value"> <span class="editable" id="about"><i class="fa fa-mobile-alt blue"></i> <?php echo $key['phone'];?></span> </div>
</div>
<div class="profile-info-row label-info">
<div class=" label-info hide-on-mobile">&nbsp; </div>
<div class="profile-info-value label-info white no-border"> <span class="editable" id="about">Activity</span> </div>
</div>
<div class="profile-info-row">
<div class="profile-info-name"> Joined </div>
<div class="profile-info-value"> <span class="editable" id="signup"><?php echo date('d-m-Y',strtotime($key['create_date']));?></span> </div>
</div>
</div>
</div>
</div>
<?php }?>
</div>
</div>
<!-- /.col --> 
</div>
<!-- /.row -->



</div>
