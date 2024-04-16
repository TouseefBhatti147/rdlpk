<style>
.box {
	color: #000;
	display: none;
	margin-top: 20px;
	margin-left: 15px;
}
</style>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<div class="my-content">
<div class="row-fluid my-wrapper">
<div class="span12"> 
<!-- breadcrumbs -->

<div class="shadow">
<h3>Plot Files</h3>
<h3 style="float:right"><a href="plots_lis">Back to List</a></h3>
</div>
<hr noshade="noshade" class="hr-5">
<section class="reg-section margin-top-30">
<div class="float-left">
<table class="table table-striped table-new table-bordered">
<thead style="background:#666; border-color:#ccc; color:#fff;">
<tr>
<td colspan="3" align="center"><h4> <strong>Plot Detail</strong></h4></td>
</tr>
</thead>
<tbody>
<?php 
	$connection = Yii::app()->db;
$plots ="SELECT
	plots.id
  , plots.street_id
	, plots.plot_size
	, plots.project_id
	, plots.com_res
	, plots.size2
	, plots.rstatus
	, plots.sector
	, plots.category_id
	, plots.status
	, plots.ctag
	, plots.price
	, memberplot.fstatus
	, plots.bstatus
	, plots.plot_detail_address
	, memberplot.plotno
	, projects.project_name
	, streets.street
	, size_cat.size
	, size_cat.typee
	, sector_name
	, plots.location
	, plots.sketch
	, plots.image
FROM
plots
Left JOIN streets  ON (plots.street_id = streets.id)
	Left JOIN projects  ON (plots.project_id = projects.id)
	Left JOIN sectors  ON (plots.sector = sectors.id)
	Left JOIN memberplot  ON (plots.id = memberplot.plot_id)
	Left JOIN size_cat  ON (size_cat.id = plots.size2)
where  plots.id='".$_REQUEST['id']."'";
$plot = $connection->createCommand($plots)->query();
foreach($plot as $key)
{
	 if($key['com_res']=='Commercial'){$type='C'; }else{$type='R';}
?>
<tr>
<td>Plot No.</td>
<td><?php echo $key['plot_detail_address'];?></td>
</tr>
<tr>
<td>Size</td>
<td><?php echo $key['size'].'&nbsp;('.$key['plot_size'].')';?></td>
</tr>
<tr>
<td>Street</td>
<td><?php echo $key['street'];?></td>
</tr>
<tr>
<td>Sector</td>
<td><?php echo $key['sector_name'];?></td>
</tr>
<?php }?>
</tbody>
</table>
<div class="clearfix"></div>
<table class="table table-striped table-new table-bordered">
<thead style="background:#666; border-color:#ccc; color:#fff;">
<tr>
<td colspan="3" align="center"><h4> <strong>Plot Image/Map/Sketch</strong></h4></td>
</tr>
</thead>
<tbody>
<tr>
<td>Plot Location</td>
<td><?php echo' <img  style="height:300px" src="'.Yii::app()->request->baseUrl.'/images/plots/'.$key['location'].'">';?></td>
</tr>
<tr>
<td>Plot Sketch</td>
<td><?php echo' <img style="height:300px"  src="'.Yii::app()->request->baseUrl.'/images/plots/'.$key['sketch'].'">';?></td>
</tr>
<tr>
<td>Plot Image</td>
<td><?php echo' <img style="height:300px"  src="'.Yii::app()->request->baseUrl.'/images/plots/'.$key['image'].'">';?></td>
</tr>
</tbody>
</table>
</div>
</div>
</section>
<!-- section 3 --> 
</div>
</div>
</div>
