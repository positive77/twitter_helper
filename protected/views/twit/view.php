<?php
/* @var $this TwitController */
/* @var $model Twit */

$this->breadcrumbs=array(
	'Twits'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Список твитов', 'url'=>array('index')),
	//array('label'=>'Create Twit', 'url'=>array('create')),
	//array('label'=>'Update Twit', 'url'=>array('update', 'id'=>$model->id)),
	//array('label'=>'Delete Twit', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Управление твитами', 'url'=>array('admin')),
);
?>

<h1>View Twit #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'created_at',
		'text',
		'user',
		'out_id',
		'retweet_count',
		'favorite_count',
	),
)); ?>
