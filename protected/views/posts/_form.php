<?php
/* @var $this PostsController */
/* @var $model Posts */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'posts-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'post_title'); ?>
		<?php echo $form->textField($model,'post_title',array('size'=>60,'maxlength'=>300)); ?>
		<?php echo $form->error($model,'post_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'post_remarks'); ?>
		<?php echo $form->textArea($model,'post_remarks',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'post_remarks'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'post_status'); ?>
		<?php echo $form->textField($model,'post_status'); ?>
		<?php echo $form->error($model,'post_status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->