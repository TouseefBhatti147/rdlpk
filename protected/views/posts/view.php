<?php
/* @var $this PostsController */
/* @var $model Posts */

$this->breadcrumbs=array(
	'Posts'=>array('index'),
	$model->post_id,
);

$this->menu=array(
	array('label'=>'List Posts', 'url'=>array('index')),
	array('label'=>'Create Posts', 'url'=>array('create')),
	array('label'=>'Update Posts', 'url'=>array('update', 'id'=>$model->post_id)),
	array('label'=>'Delete Posts', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->post_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Posts', 'url'=>array('admin')),
);
?>

<h1>View Posts #<?php echo $model->post_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'post_id',
		'post_title',
		'post_remarks',
		'post_status',
	),
)); ?>
