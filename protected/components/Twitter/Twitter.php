<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Twitter
 *
 * @author Jeka 06.07.13
 */

Yii::import('application.components.Twitter.ext.twitteroauth.*');

class Twitter {
    
    const CONSUMER_KEY = 'DcaGUfk1xwX36raBfQ9n1A';
    const CONSUMER_SECRET = 'uTu7563Jw8GJBkBOdtLoxAfacJHADJqRmIRhKADI';
    const ACCESS_TOKEN = '521776707-umoHVbvd7LcNBVDUwOXvkCQKIOFPhPI0tcH97H7W';
    const ACCESS_TOKEN_SECRET = 'o3hoqA60OPrU824sgO0b0ubGopd0LCTIU9YvcVpgW0';
    const MAX_COUNT_TWITTS = 200; // 200 мамксимум, который отдает апи (определено при поверхностном знакомстве с апи 1.1)
    const COUNT_TAGS = 25; // количество сохраняемых и выводимых тегов
    const API_URL = 'https://api.twitter.com/1.1/';
    
    public static function getConnection()
    {
        return new twitteroauth(self::CONSUMER_KEY,
                                self::CONSUMER_SECRET,
                                self::ACCESS_TOKEN,
                                self::ACCESS_TOKEN_SECRET);
    }
    
    // Возвращает все данные по юзеру через апи
    public static function getUserInfo($id)
    {
        if (preg_match('/[0-9]{1,20}/', $id))
        {
            $param = 'user_id='.$id;
        }
        else
        {
            $param = 'screen_name='.$id;
        }
        $connection = self::getConnection();
        $user = $connection->get(self::API_URL.'users/show.json?'.$param);
        return $user;
    }
    // Возвращает 200 последних твиттов юзера
    public static function getUserTwitts($id)
    {
        $connection = self::getConnection();
        $twitts = $connection->get(self::API_URL.'statuses/user_timeline.json?user_id='.$id.'&count='.self::MAX_COUNT_TWITTS);
        return $twitts;
    }
    // для сохранения твитов в бд
    public static function saveTwitts($user,$twitts)
    {
      $issetUser = User::model()->find('out_id=:OUT_ID', array(':OUT_ID'=>$user->id_str));
      if ($issetUser)
      {
          self::updateTwitts($issetUser, $twitts);
          return;
      }
        
        
      $transaction = Yii::app()->getDb()->beginTransaction();
      try{
            
            $userModel = new User();
            $userModel->setAttributes((array)$user);
            $userModel->out_id = $user->id_str;            
            $userModel->created_at = date('c', strtotime($user->created_at));
            $userModel->save();
            
            foreach ($twitts as $value)
            {
                $twitModel = new Twit();
                $twitModel->setAttributes((array)$value);
                $twitModel->created_at = date('c', strtotime($value->created_at));
                $twitModel->out_id = $value->id_str;
                $twitModel->user = $userModel->id;
                $twitModel->save();
            }
            
            self::generateTags($userModel,$twitts);
        
          }
        catch(Exception $e){
            return $transaction->rollback();
          }
        $transaction->commit();
    }
    // Обновление твитов чтоб не дублировать уже записанные
    public static function updateTwitts($userModel,$twitts)
    {
      $transaction = Yii::app()->getDb()->beginTransaction();
      try{
        foreach ($twitts as $value)
         {
            $issetTwitt = Twit::model()->find('out_id=:OUT_ID', array(':OUT_ID'=>$value->id_str));
            if(!$issetTwitt)
            {
                $twitModel = new Twit();
                $twitModel->setAttributes((array)$value);
                $twitModel->created_at = date('c', strtotime($value->created_at));
                $twitModel->out_id = $value->id_str;
                $twitModel->user = $userModel->id;
                $twitModel->save();
            }        
            
        }
        
        self::generateTags($userModel, $twitts);
        
      }
      catch(Exception $e){
            return $transaction->rollback();
          }
        $transaction->commit();
    }
    //Собирает теги из переданных твитов, и пересохраняет их в базу, по количеству повторений
    public static function generateTags($userModel,$twitts)
    {        
        $delTag = new Tag();
        $delTag->deleteAll('user='.$userModel->id);        
        //Вынесли все старые теги
        $tags = array();
        foreach ($twitts as $twit)
        {
            $words = array();
            $twit->text = preg_replace('/http:\/\/[\s\S]{5,40}/u',' ', $twit->text);
            $twit->text = preg_replace('/[^\w\s-]/u', ' ', $twit->text);            
            preg_match_all('/[\S]{4,30}/ui', $twit->text, $words);            
            foreach ($words[0] as $word)
           {           
             $tags[] = $word;  
           }               
        }
        $res = array_count_values($tags);
        arsort($res);
        $i=0;
        foreach($res as $key=>$val)
        {
           $tagModel = new Tag();
           $tagModel->name = $key;
           $tagModel->user = $userModel->id;
           $tagModel->weight = $val;
           $tagModel->save();
           $i++;
           if ($i>=self::COUNT_TAGS)
               break;
        }   
        
    }
}

?>
