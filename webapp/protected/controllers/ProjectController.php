<?php

class ProjectController extends Controller
{
        /**
         * access control filter
         */
        public function filters()
    	{
    		return array(
                			'accessControl', 
                		);
    	}
  	public function accessRules()
	{
		return array(
			array('allow', 
				'actions'=>array('index','Delete_Comment','Remove_Collaborator','Add_Collaborators','Dashboard','Create','Delete_project','Update_title'),
				'users'=>array('@'),
			),
			array('deny','users'=>array('*'),),
		);
	}
	public function actionIndex()
	{
            
    	if (!empty($_GET['id']))
		{
            if(isset(Yii::app()->session['uid']))
            $findproject = ProjectUser::model()->findByAttributes(array('projectId'=>$_GET['id'], 'userId'=>Yii::app()->session['uid']));
            if(Yii::app()->user->isGuest || !isset($findproject) || empty($findproject))
            {
                   $this->redirect('/');
            }
            $project = Project::model()->findByPk($_GET['id']);
			$authers_projects = ProjectUser::model()->findAllByAttributes(array('projectId' => $_GET['id']));
			$all_users = User::model()->findAll();
			foreach ($authers_projects as $user) {
				$authers[] = $user->user;
			}
			if ($project)
			{
				$this->render('index', array('project' => $project, 'authers' => $authers, 'all_users' => $all_users));
			}
		}
	}

	public function actionDelete_Comment()
    {
		if (!empty($_GET['id']))
        {
		  	$uid=Yii::app()->session['uid'];
			$activity=Activity::model()->find(array(
		    'condition'=>'userId=:userId AND id=:id',
		    'params'=>array(':userId'=>$uid, ':id' => $_GET['id']),
			));
			if ($activity) {
				$activity->delete();
			}
           	$this->redirect('/project/index/'.$activity->projectId);
			
		}
	}          

	public function actionRemove_Collaborator(){
		if(!empty($_GET['id'])){
			$project = Project::model()->findByPk($_GET['id']);
			$authers_projects = ProjectUser::model()->findByAttributes(array('projectId' => $_GET['id'], 'userId' => $_GET['userId'], 'role' => 'collaborator'));
			if($authers_projects){
				$authers_projects->delete();
				$this->redirect('/project/index/'.$_GET['id']);
			}
			else
				echo "Can't remove this user";
		}
	}

	public function actionAdd_Collaborators()
	{
		if (!empty($_POST['projectId'])) {
			$names = explode(',', $_POST['names']);
			foreach ($names as $name) {
				$splited_names = explode(' ', $name);
				if(count($splited_names) == 2)
					$user = User::model()->find(array('condition'=>'firstName=:firstName AND lastName=:lastName','params'=>array(':firstName'=>$splited_names[0], ':lastName' => $splited_names[1])));
				else
					$user = User::model()->find(array('condition'=>'firstName=:name or lastName=:name','params'=>array(':name'=>$splited_names[0])));
				if($user)
					$user->add_to_project($_POST['projectId']);
			}
			$this->redirect('/project/index/' . $_POST['projectId']);
		}
	}

	public function actionDashboard()
	{
            $uid=Yii::app()->session['uid'];
			$projects = array();
            $projects=Project::model()->findAllByAttributes(array('userId'=>$uid,'status'=>'active'));
            $this->render('dashboard', array('projects' => $projects,));
		
	}

	public function actionCreate()
	{
		
		$uid=Yii::app()->session['uid'];
		if ($uid)
		{
			if (!empty($_POST['title']))
			{
				//echo "2";
				$project = new Project;
				$project->userId = $uid;
				$project->title = $_POST['title'];
				$project->status = 'active';

				if ($project->save())
				{
					
				$this->redirect('/project/index/'.$project->id);
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
		}
	}
    
    public function actionDelete_project()
    {
           $uid=Yii::app()->session['uid'];
		if ($uid)
		{
		  if(isset($_GET['node']) && !empty($_GET['node']))
            {
                  
                  try{
                     $projectData=Project::model()->findByPk($_GET['node']);
                     $projectData->status='trash';
                     
<<<<<<< HEAD
                     if($projectData->update(false))
                     {
                        
                     
                        Yii::app()->session['msg']='Project has been moved to Trash .<a href="/project/undo_delete/node/'.$_GET['node'].'"> Undo? </a>';
	    
                     }
=======
                         if($projectData->update(false))
                        {
                          Yii::app()->session['msg']='Project has been moved to Trash .<a href="/project/undo_delete/node/'.$_GET['node'].'">Undo Delete</a>';
	                    }
>>>>>>> 02695f920fe3d4cc66fb25aa257ecf5b7176841e
                     }
                   catch(Exception $e)
                   {
                     
                     Yii::app()->session['msg']="Project deletion operation failed";   
                   }
               
                 $this->redirect('/dashboard');  
                
                
            }
            else
            {
                echo "Fail";
            }
           }
            else
            {
                echo "Fail";
            }
    }
    public function actionUndo_delete()
    {
         $uid=Yii::app()->session['uid'];
		if ($uid)
		{
		  if(isset($_GET['node']) && !empty($_GET['node']))
            {
                  
                  try{
                    $projectData=Project::model()->findByPk($_GET['node']);
                     $projectData->status='active';
                     if($projectData->update())
                     {
                        
                     
                        Yii::app()->session['msg']='Project recovered successfully';
	    
                     }
                     }
                   catch(Exception $e)
                   {
                     
                      Yii::app()->session['msg']='Project recovery operation failed'; 
                   }
               
                 $this->redirect('/dashboard');  
            }
            else
            {
                echo "Fail";
            }
           }
            else
            {
                echo "Fail";
            }
    }
    
    public function actionUpdate_title()
    {
           $uid=Yii::app()->session['uid'];
       	if ($uid)
		{
		  if(isset($_POST['node']) && !empty($_POST['node']))
            {
                  
                  try{
                     $projectData=Project::model()->findByPk($_POST['node']);
                     $projectData->title=$_POST['title'];
                     
                     if($projectData->update(false))
                     {
                        
                        echo 'Project Title updated successfully..';
	    
                     }
                     }
                   catch(Exception $e)
                   {
                      echo 'Project Title updation failed..';
                        
                   }
               
                exit;
                
                
            }
            else
            {
                echo "Project Title updation failed..";
            }
           }
            else
            {
                echo "Project Title updation failed..";
            }
    }
}