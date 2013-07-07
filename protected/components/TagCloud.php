<?php

/**
 * @author Jeka
 */
class TagCloud extends CWidget
{
    public $tagList;

    public function init()
    {
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.js');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jqcloud.js');
        Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/jqcloud.css');        
        
        foreach ($this->tagList as $val)
        {
            $tagArr[] = array(
                 'text'=>$val->name,
                 'weight'=>$val->weight,
                 'target'=>'"_blank"',
                 'link'=>array(
                            'href'=>'https://twitter.com/search?q='.$val->name,
                            'target'=>'_blank', 
                        ),
             );
        }
        
        Yii::app()->clientScript->registerScript('cloud',
                ' var word_list ='.CJSON::encode($tagArr).';    
                  $(function() {
                  $("#tCloud").jQCloud(word_list);
               });
           ');
    }

    public function run()
    {
        echo '<div id="tCloud" style="width: 150px; min-height: 350px;"></div>
';
    }


}
