<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Юзеры'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Список юзеров', 'url'=>array('index')),
	//array('label'=>'Create User', 'url'=>array('create')),
	//array('label'=>'Update User', 'url'=>array('update', 'id'=>$model->id)),
	//array('label'=>'Delete User', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Управление юзерами', 'url'=>array('admin')),
);
?>

<h1>View User #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'out_id',
		'screen_name',
		'location',
		'description',
		'profile_image_url',
		'created_at',
	),
)); ?>
