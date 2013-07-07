<?php
/* @var $this TwitController */
/* @var $model Twit */

$this->breadcrumbs=array(
	'Твиты'=>array('index'),
	'управление',
);

$this->menu=array(
	array('label'=>'Список твитов', 'url'=>array('index')),
	//array('label'=>'Create Twit', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('twit-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Twits</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'twit-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'created_at',
		'text',
		array(
                'name' => 'user',                
                'value' => 'CHtml::link($data->user0->name, Yii::app()->createUrl("user/view", array("id" => $data->user0->id)))',
                'type' => 'html',
                 ),
		'out_id',
		'retweet_count',
                'favorite_count',
		/*
		'favorite_count',
		*/
		array(
                'class'=>'CButtonColumn',
                'template' => '{view}',
                'buttons' => array(
                     'view' => array(
                         'label'=>'Просмотр',                         
                      ),
                   ),
              ),      
	),
)); ?>
