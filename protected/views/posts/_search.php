<?php
/* @var $this PostsController */
/* @var $model Posts */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'post_id'); ?>
		<?php echo $form->textField($model,'post_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'post_title'); ?>
		<?php echo $form->textField($model,'post_title',array('size'=>60,'maxlength'=>300)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'post_remarks'); ?>
		<?php echo $form->textArea($model,'post_remarks',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'post_status'); ?>
		<?php echo $form->textField($model,'post_status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->