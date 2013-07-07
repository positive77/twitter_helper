<?php

/**
 * This is the model class for table "twit".
 *
 * The followings are the available columns in table 'twit':
 * @property integer $id
 * @property string $created_at
 * @property string $text
 * @property integer $user
 * @property string $out_id
 * @property integer $retweet_count
 * @property integer $favorite_count
 *
 * The followings are the available model relations:
 * @property User $user0
 */
class BaseTwit extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Twit the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'twit';
	}

	/**
	 * @return array validation rules for model attributes.
	 */ 
	 
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('created_at, text, user, out_id, retweet_count, favorite_count', 'required'),
			array('user, retweet_count, favorite_count', 'numerical', 'integerOnly'=>true),
			array('out_id', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, created_at, text, user, out_id, retweet_count, favorite_count', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'user0' => array(self::BELONGS_TO, 'User', 'user'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'created_at' => 'Created At',
			'text' => 'Text',
			'user' => 'User',
			'out_id' => 'Out',
			'retweet_count' => 'Retweet Count',
			'favorite_count' => 'Favorite Count',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('user',$this->user);
		$criteria->compare('out_id',$this->out_id,true);
		$criteria->compare('retweet_count',$this->retweet_count);
		$criteria->compare('favorite_count',$this->favorite_count);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}