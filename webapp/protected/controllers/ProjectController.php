<?php

class ProjectController extends Controller
{
	public function actionIndex()
	{
		if (!empty($_GET['id']))
		{
			$project = Project::model()->findByPk($_GET['id']);
			// print_r($project);
			if ($project)
			{
				$this->render('index', array('project' => $project));
			}
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