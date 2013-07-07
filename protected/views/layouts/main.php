<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Главная', 'url'=>array('/site/index')),
				array('label'=>'Юзеры', 'url'=>array('/user/admin')),
				array('label'=>'Твиты', 'url'=>array('/twit/admin')),				
			),
		)); ?>
	</div><!-- mainmenu -->
	
        
       <!-- форма -->
       <div class="search-form">
<?php   if (isset($this->searchModel))
         {
            $model = $this->searchModel;
         }
         else
         {
             $model = new SearchForm();
         }
        $form=$this->beginWidget('CActiveForm', array(
	'id'=>'search-form-index-form',
        'action'=>array('site/index'),
	'enableAjaxValidation'=>false,
)); ?>	
		
		<?php echo 'ID или Username: '; ?>
		<?php echo $form->textField($model,'query',
                        array(
                            'style'=>'width:640px;',
                            'onkeydown'=>'if (event.keyCode == 13) 
                                             { 
                                                this.form.submit(); 
                                                return false;
                                             }'
                             )); ?>
		
       <?php echo CHtml::button('Искать пользователя',
               array(
                   'onClick'=>'submit("'.Yii::app()->createUrl('site/index').'");'
                   )); ?>
       <?php $this->endWidget(); ?>           
       </div>
       <?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>
      <!-- <div class="form">
       <?php echo $form->errorSummary($model); ?>
       </div> -->


	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by Jeka.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
