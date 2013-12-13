<?php

Yii::import('application.extensions.*');

class FileController extends Controller
{
	public function actionAjaxCreate()
	{
		if (!Yii::app()->user->isGuest && isset($_POST['attachments']) && is_array($_POST['attachments']))
		{

			$respArray = array();

			foreach ($_POST['attachments'] as $a)
			{
				$attachment = new File;
			
				$attachment->projectId = $a['projectId'];
							
				$attachment->name = $a['filename'];
				$attachment->mimetype = $a['mimetype'];
				$attachment->fpUrl = $a['url'];
				
				// User Id
				$attachment->userId = Yii::app()->user->id;
				
				// Save the attachment to the database
				if (!$attachment->save()) 
				{
					Yii::log("Error saving attachment", 'error', 'FileController.actionAjaxCreate');
					Yii::log(json_encode($attachment->getErrors()), 'error', 'FileController.actionAjaxCreate');
				}

			}

			$resp = json_decode(json_encode($respArray), false);

			$this->_sendResponse(200, json_encode($resp));
		}
	}

	public function actionDownload()
	{
		if (!Yii::app()->user->isGuest && !empty($_GET['id']))
		{
			$file = File::model()->findByPk($_GET['id']);

			$project = Project::model()->findByPk($file->projectId);

			if (!empty($file->boxId) && $project->isMemberOf())
			{
				$box = new Box_API(Yii::app()->params['boxclientid'], Yii::app()->params['boxclientsecret'], 'n/a');

				if(!$box->load_token('protected/config/')){
					$box->get_code();
				}

				$redirectUrl = $box->get_file_download_link($file->boxId);

				$this->redirect($redirectUrl);
			}
		}
	}
}