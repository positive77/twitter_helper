<?php

class SiteController extends Controller
{
        public $layout='//layouts/column2'; 
        public $searchModel;
        public $tagCloud =array();


        public function actionIndex()
	{                
		$this->searchModel = new SearchForm();
                $user = array();
                $twitts = array();
                if (isset($_POST['SearchForm']))
                {
                    $this->searchModel->attributes = $_POST['SearchForm'];
                    if ($this->searchModel->validate())
                    {
                        $user = Twitter::getUserInfo($this->searchModel->query);
                        if (isset($user->errors))
                        {
                           $this->render('error', array(
                                                'code'=>$user->errors[0]->code,
                                                'message'=>$user->errors[0]->message));
                           Yii::app()->end();                           
                        }
                        $twitts = Twitter::getUserTwitts($user->id);
                        Twitter::saveTwitts($user, $twitts);
                        $userModel = User::model()->find('out_id=:OUT_ID',array(':OUT_ID'=>$user->id_str));
                        $this->tagCloud = Tag::model()->findAll('user=:USER',array(':USER'=>$userModel->id));
                    }
                    else{
                        foreach ($this->searchModel->errors as $k=>$v)
                        {
                        $this->render('error', array(
                                                'code'=>$k,
                                                'message'=>$v[0]));
                        break;
                        }
                           Yii::app()->end();
                        
                    }
                }
                
                                
		$this->render('index',array('user'=>$user));
	}
         
	
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
	
	
}