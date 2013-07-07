<?php
/* @var $this TwitController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Твиты',
);

$this->menu=array(
	//array('label'=>'Create Twit', 'url'=>array('create')),
	array('label'=>'Управление твитами', 'url'=>array('admin')),
);
?>

<h1>Twits</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
