<?php

class UserController extends Controller
{

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	public function actionProfile()
	{
		if (!Yii::app()->user->isGuest)
		{
			$user = User::model()->findByPk(Yii::app()->user->id);

			if ($user)
			{
				$this->render('profile', array('user' => $user, 'readonly' => false));
				return;
			}
		}

		$this->redirect('/login');
	}

	public function actionPublicProfile()
	{

		if (!Yii::app()->user->isGuest && !empty($_GET['id']))
		{

			$user = User::model()->findByPk($_GET['id']);

			if ($user)
			{
				$this->render('profile', array('user' => $user, 'readonly' => true));
				return;
			}
		}

		//todo: render user not found
		$this->render('notfound');
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new User;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{

		if (!Yii::app()->user->isGuest && $id === Yii::app()->user->id)
		{
			$model=$this->loadModel($id);

			// Uncomment the following line if AJAX validation is needed
			// $this->performAjaxValidation($model);

			if(isset($_POST['User']))
			{
				$model->attributes=$_POST['User'];
				Yii::log(json_encode($_POST['User']), 'error');

				if(!empty($_POST['currentPassword']) || empty($model->password))
				{ 
					if(User::hashPassword($_POST['currentPassword']) != $model->password && !empty($model->password))
					{
						$msg = 'Current Password is incorrect';
						$this->render('profile', array('user' => $model, 'errorMsg' => $msg, 'readonly'=>false));
						return;
					}

					if($_POST['newPassword'] != $_POST['repeatPassword'])
					{
						$msg = 'New and Repeat passwords don\'t match';
						$this->render('profile', array('user' => $model, 'errorMsg' => $msg, 'readonly'=>false));
						return;
					}

					$model->password = User::hashPassword($_POST['newPassword']);
				}
				if($model->save())
				{
					$msg = 'Your updates have been saved successfully';

					$this->render('profile', array('user' => $model, 'alertMsg' => $msg, 'readonly'=>false));
					return;
				}
			}
			$msg = 'Error saving profile';
			$this->render('profile', array('user' => $model, 'errorMsg' => $msg, 'readonly'=>false));
		}
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('User');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new User('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['User']))
			$model->attributes=$_GET['User'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return User the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param User $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
