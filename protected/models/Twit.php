<?php

Yii::import('application.models._base.BaseTwit');

class Twit extends BaseTwit
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
        
        public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'created_at' => 'Дата публикации',
			'text' => 'Текст твита',
			'user' => 'Автор',
			'out_id' => 'Внешний ID',
			'retweet_count' => 'Количество ретвитов',
			'favorite_count' => 'Количество избранных',
		);
	}
}