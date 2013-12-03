<?php

class ProjectController extends Controller
{
	public function actionIndex()
	{
		if (!empty($_GET['id']))
		{
			$project = Project::model()->findByPk($_GET['id']);

			if ($project)
			{
				$this->render('index', array('project' => $project));
			}
		}
	}

	public function actionDashboard()
	{
		if (!Yii::app()->user->isGuest)
		{
			$projects = array();
			$userProjects = ProjectUser::model()->findAllByAttributes(array('userId' => Yii::app()->user->id));
			foreach ($userProjects as $project) {
				$projects[] = $project->project;
			}
			$this->render('dashboard', array('projects' => $projects));
		}
		else
		{
			// redirect to login page
		}
	}

	public function actionCreate()
	{
		if (!Yii::app()->user->isGuest)
		{
			if (!empty($_POST['title']))
			{
				$project = new Project;
				$project->userId = Yii::app()->user->id;
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
			// redirect to login page
		}
	}
}