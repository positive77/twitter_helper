<?php
/* @var $this TwitController */
/* @var $data Twit */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_at')); ?>:</b>
	<?php echo CHtml::encode($data->created_at); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('text')); ?>:</b>
	<?php echo CHtml::encode($data->text); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user')); ?>:</b>
	<?php echo CHtml::encode($data->user); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('out_id')); ?>:</b>
	<?php echo CHtml::encode($data->out_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('retweet_count')); ?>:</b>
	<?php echo CHtml::encode($data->retweet_count); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('favorite_count')); ?>:</b>
	<?php echo CHtml::encode($data->favorite_count); ?>
	<br />


</div>