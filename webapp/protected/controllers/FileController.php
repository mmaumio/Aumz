<?php

Yii::import('application.extensions.*');
// require_once('facebook/facebook.php');

class FileController extends Controller
{

	public function actionAjaxcreate()
	{
	// echo "enter";
	$uid = Yii::app()->session['uid'];
	// echo $uid;
		if ($uid)
		{
			// print_r($_POST['attachments']);

		
			$respArray = array();
			foreach ($_POST['attachments'] as $a)
			{
				$file = new File;
				
				// User Id
				$file->userId = Yii::app()->session['uid'];
				$file->projectId = $a['projectId'];			
				$file->name = $a['filename'];
				$file->mimetype = $a['mimetype'];
				$file->fpUrl = $a['url'];
				
				//print_r($file);
				
				//$attachment->save();
				// Save the attachment to the database
				//$file->save();
				$created = new CDbExpression('UTC_TIMESTAMP()');
				$conn = Yii::app()->db;
				//$sql="insert into `file` values(`$file->userId`,`$file->projectId`,`$file->name`,`$file->mimetype`,`$file->fpUrl`)";
				//$command=$conn->createCommand($sql);
				$sql = "insert into file (userId, projectId,name,mimetype,fpUrl,created) values (:userId, :projectId,:name,:mimetype,:fpUrl,UTC_TIMESTAMP())";
				$parameters = array(":userId"=>$file->userId, ':projectId' => $file->projectId, ':name' => $file->name, ':mimetype' => $file->mimetype, ':fpUrl' => $file->fpUrl);
				//var_dump($parameters);
                                Yii::app()->db->createCommand($sql)->execute($parameters);
                                $activity = new Activity();
        $activity->projectId = $a['projectId'];
        $activity->type      = "file_added";
        $activity->userId    = Yii::app()->session['uid'];
        $activity->save();
                                //var_dump(Yii::app()->db->createCommand($sql));
                                
			/*	if ($file->save())
				{
					echo "success";
			//	$this->redirect('/dashboard');
				}
				else 
				{
					Yii::log("Error saving attachment", 'error', 'FileController.actionAjaxcreate');
					Yii::log(json_encode($file->getErrors()), 'error', 'FileController.actionAjaxcreate');
				}	*/

			}

	//	$file = json_decode(json_encode($file), false);

	//	$this->_sendResponse(200, json_encode($file));
		}
	}
/*	public function actionDelete_Comment(){
		if (!empty($_GET['id'])){
			$uid=Yii::app()->session['uid'];
			$file=File::model()->find(array(
		    'condition'=>'userId=:userId AND id=:id',
		    'params'=>array(':userId'=>$uid, ':id' => $_GET['id']),
			));
			// $activity= Activity::model()->findByPk($_GET['id']); 
			if ($file) {
				$file->delete();
			}
			$this->redirect('/file/ajaxcreate'.$file->projectId);
			
		}
	}
	*/
	public function actionDownload($file)
	{

		if (Yii::app()->session['uid'] && !empty($file))
		{
			$file = File::model()->findByPk($file);
                        
                        $this->redirect($file->fpUrl.'?dl=true');

//                        $project = Project::model()->findByPk($file->projectId);
//                        var_dump($project);
//
//			if (!empty($file->boxId) && $project->isMemberOf())
//			{
//				$box = new Box_API(Yii::app()->params['boxclientid'], Yii::app()->params['boxclientsecret'], 'n/a');
//
//				if(!$box->load_token('protected/config/')){
//					$box->get_code();
//				}
//
//				$redirectUrl = $box->get_file_download_link($file->boxId);
//
//				$this->redirect($redirectUrl);
//			}
		}
	}
        

}