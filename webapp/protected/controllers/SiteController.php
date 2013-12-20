<?php

class SiteController extends Controller
{
        
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
                $this->layout='//layouts/columnfull';
                $model=new LoginForm;
                //collect user input
                if(isset($_POST['LoginForm']))
                {  
                        if(isset(Yii::app()->request->cookies['user_trails'])){
                            $val = Yii::app()->request->cookies['user_trails']->value;
                            Yii::app()->request->cookies['user_trails'] =new CHttpCookie('user_trails', (1 + $val));
                        }else{
                             Yii::app()->request->cookies['user_trails'] = new CHttpCookie('user_trails', 1);
                        }
                        
			$model->attributes=$_POST['LoginForm'];
                            // validate user input
                           if($model->validate() && $model->login()){
                                $user = User::model()->findByPk(Yii::app()->user->id);
				{	
                                        {
                                            $this->redirect('/dashboard');
                                        }
				}
                         }
                }
		$this->render('index',array('model'=>$model));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
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

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
        $model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}

        //require_once 'google/appengine/api/users/UserService.php';
        $googleLoginUrl = \google\appengine\api\users\UserService::createLoginURL('/site/googleLogin');
		// display the login form
		$this->render('login',array('model'=>$model, 'googleLoginUrl'=>$googleLoginUrl));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

    public function actionGoogleLogin()
    {
        $identity=new GUserIdentity('test','test');
        $identity->authenticate();
        if($identity->errorCode===GUserIdentity::ERROR_NONE) {
            Yii::app()->user->login($identity,$duration=0);
            $this->redirect('/');
        } else {
            $this->redirect('/site/login');
        }

    }
    /*
     * 
     * About Us Page
     *
    */
    public function actionAboutus()
	{
	
				$this->render('aboutus',array());
	
	}
     public function actionfaq()
	{
	
				$this->render('faq',array());
	
	}

    public function actionBlog()
	{
	
				$this->render('blog',array());
	
	}
    public function actionPrivacy()
	{
	
				$this->render('privacy',array());
	
	}
        
        /**
         * Forgot password 
         * Accepts an email and sends a change password link to the user
         */
       
    public function actionForgotPassword(){
            $model=new User;
            
            if(isset($_POST['User']))
            {
                    $records =  User::model()->findByAttributes(array('email'=>$_POST['User']['email']));
                    if($records){
                        $message = new YiiMailMessage;
                        $message->view = 'forgotpassmail';
                        $message->setBody(array('records'=>$records), 'text/html');
                        $message->subject = 'Request to change password';
                        $message->addTo('arvind@sprytechies.com');
                        $message->from = Yii::app()->params['adminEmail'];
                        Yii::app()->mail->send($message);
                        
                        Yii::app()->user->setFlash('success', "Please check your mails");

                        $this->redirect('ForgotPassword');
                    }else{
                        Yii::app()->user->setFlash('error', "Invalid Email");
                    }
            }
            $this->render('forgotpass',array('model'=>$model));
        }
        
        /**
         * Change password 
         */
        public function actionChangepass()
	{       
                $model = new User;
                $records=  User::model()->findAll();
                if(isset($_POST) && isset($_POST['k'])){
                    foreach ($records as $value) {
                            if(md5($value->id).md5(strtotime($value->created))==$_POST['k']){
                                if(isset($_POST['newpassword']) && isset($_POST['confirmpassword']) && !empty(trim($_POST['newpassword'])) && !empty(trim($_POST['confirmpassword']))){
                                        $data=User::model()->findByPk($value->idusers);
                                        if($_POST['newpassword']!= $_POST['confirmpassword']){
                                                    Yii::app()->user->setFlash('error', "Passwords don't match. Please try again.");
                                            }else{
                                                    $data->password=$_POST['newpassword'];
                                                    $data->save();
                                                    Yii::app()->user->setFlash('success', "Password is changed. Please login with your new password.");
                                            }
                                }else{
                                    Yii::app()->user->setFlash('error', "Please check entered values.");
                                }
                            }
                    }
                }else{
                        Yii::app()->user->setFlash('error', "Invalid Request.");
                    }
                if(isset($_GET['k'])){
                    $this->render('changepass',array('model'=>$model, 'k'=>$_GET['k']));
                }else{
                    $this->render('changepass',array('model'=>$model));
                }
	}

}