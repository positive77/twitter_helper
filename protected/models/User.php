<?php

Yii::import('application.models._base.BaseUser');

class User extends BaseUser
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
        
        public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Имя',
			'out_id' => 'Внешний ID',
			'screen_name' => 'Username',
			'location' => 'Место нахождения',
			'description' => 'Описание',
			'profile_image_url' => 'Изображение профиля',
			'created_at' => 'Дата регистрации',
		);
	}
}