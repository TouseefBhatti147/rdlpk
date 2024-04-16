<?php
/* @var $this PostsController */
/* @var $data Posts */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('post_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->post_id), array('view', 'id'=>$data->post_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('post_title')); ?>:</b>
	<?php echo CHtml::encode($data->post_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('post_remarks')); ?>:</b>
	<?php echo CHtml::encode($data->post_remarks); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('post_status')); ?>:</b>
	<?php echo CHtml::encode($data->post_status); ?>
	<br />


</div>