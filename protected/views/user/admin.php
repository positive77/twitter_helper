<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Юзеры'=>array('index'),
	'Управление',
);

$this->menu=array(
	array('label'=>'Список юзеров', 'url'=>array('index')),
	//array('label'=>'Create User', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('user-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Users</h1>

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
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'out_id',
		'screen_name',
		'location',
		'description',		
		//'profile_image_url',
                array(
                'name' => 'profile_image_url',                
                'value' => 'CHtml::image($data->profile_image_url);',
                'type' => 'html',
                 ),
		'created_at',
		
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
