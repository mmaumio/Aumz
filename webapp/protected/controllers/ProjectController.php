<?php

class ProjectController extends Controller
{
	public function actionIndex()
	{
		if (!empty($_GET['id']))
		{
			$project = Project::model()->findByPk($_GET['id']);
			$authers_projects = ProjectUser::model()->findAllByAttributes(array('projectId' => $_GET['id']));
			foreach ($authers_projects as $user) {
				$authers[] = $user->user;
			}
			// print_r($project);
			if ($project)
			{
				$this->render('index', array('project' => $project, 'authers' => $authers));
			}
		}
	}

	public function actionDelete_Comment(){
		if (!empty($_GET['id'])){
			$uid=Yii::app()->session['uid'];
			$activity=Activity::model()->find(array(
		    'condition'=>'userId=:userId AND id=:id',
		    'params'=>array(':userId'=>$uid, ':id' => $_GET['id']),
			));
			// $activity= Activity::model()->findByPk($_GET['id']); 
			if ($activity) {
				$activity->delete();
			}
			$this->redirect('/project/index/'.$activity->projectId);
			
		}
	}

	public function actionAdd_Collaborators()
	{
		if (!empty($_POST['projectId'])) {
			$names = explode(',', $_POST['names']);
			foreach ($names as $name) {
				$splited_names = explode(' ', $name);
				$user = User::model()->find(array('condition'=>'firstName=:firstName AND lastName=:lastName','params'=>array(':firstName'=>$splited_names[0], ':lastName' => $splited_names[1])));
				$user->add_to_project($_POST['projectId']);
			}
			$this->redirect('/project/index/' . $_POST['projectId']);
		}
	}

	public function actionDashboard()
	{
                        $uid=Yii::app()->session['uid'];
			$projects = array();
			$userProjects = ProjectUser::model()->findAllByAttributes(array('userId' => $uid));
			foreach ($userProjects as $project) {
				$projects[] = $project->project;
			}
			$this->render('dashboard', array('projects' => $projects));
		
	}

	public function actionCreate()
	{
		
		$uid=Yii::app()->session['uid'];
		if ($uid)
		{
		//echo "1";
		
			if (!empty($_POST['title']))
			{
				//echo "2";
				$project = new Project;
				$project->userId = $uid;
				$project->title = $_POST['title'];
				$project->status = 'active';

				if ($project->save())
				{
					
				$this->redirect('/dashboard');
				}
				else
				{
					Yii::log(json_encode($project->getErrors()), 'error', 'ProjectController.actionCreate');
				}
			}
		
		}
		else
		{
			echo "fail";
			// redirect to login page
		}
	}
}