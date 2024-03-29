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
				'actions'=>array('index','Delete_Comment','Remove_Collaborator','Add_Collaborators','Dashboard','Create','Delete_project','Undo_delete','Update_title','ajaxTaskCreate','getAssignee','fetchNewTask', 'Updateactivity', 'ajaxProjects','updateflash','updatewelcomeflash'),
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
            $task = new Task;
            $modeluser = User::model()->findByPk(Yii::app()->session['uid']);
            $tasks = Task::model()->findAllByAttributes(array('ownerId'=>Yii::app()->session['uid'], 'projectId'=>$_GET['id']));
            
            $authers_projects = ProjectUser::model()->findAllByAttributes(array('projectId' => $_GET['id']));
            $all_users = User::model()->findAll();
            foreach ($authers_projects as $user) {
                    $authers[] = $user->user;
            }
            if ($project)
            {
                if(isset($_GET['da']))
                {
                $userData=User::model()->findByPk(Yii::app()->session['uid']);
              
                $act='useDashboardLink';
                $description=$userData->email.'useDashboardLink from Project : '.$project->title;
                $initiator=$userData->email;
                Yii::app()->session['event']=array('0'=>array('activity'=>$act,
                                                                        'description'=>$description,
                                                                        'initiator'=>$initiator
                                                                      ) );
               }          
                    $this->render('index', array('project' => $project, 'authers' => $authers, 'all_users' => $all_users,'task'=>$task, 'modeluser'=>$modeluser,'tasks'=>$tasks));
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
			   	$userData=User::model()->findByPk(Yii::app()->session['uid']);
               
                $act='Remove Collab';
                $description=$authers_projects->user->email.' remove from project : '.$authers_projects->title;
                $initiator=$userData->email;
                Yii::app()->session['event']=array('0'=>array('activity'=>$act,
                                                                        'description'=>$description,
                                                                        'initiator'=>$initiator
                                                                      ) );    
             
                
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
                {
				//	$user->add_to_project($_POST['projectId']);
                    $userData=User::model()->findByPk(Yii::app()->session['uid']);
                $ProjectData=Project::model()->findByPk($_POST['projectId']);
                $user->add_to_project($_POST['projectId']);
                $act='Add Collab';
                $description=$user->email.' added on project : '.$ProjectData->title.' By '.$userData->email;
                $initiator=$userData->email;
                Yii::app()->session['event']=array('0'=>array('activity'=>$act,
                                                                        'description'=>$description,
                                                                        'initiator'=>$initiator
                                                                      ) ); 
                }    
			}
			$this->redirect('/project/index/' . $_POST['projectId']);
		}
	}

	public function actionDashboard()
	{
            $uid=Yii::app()->session['uid'];
            $user_projects = ProjectUser::model()->findAllByAttributes(array('userId'=>$uid));
			$projects = array();
            foreach ($user_projects as $user_project) {
                $projects[] =  $user_project->project;
            }
            // $projects = Project::model()->findAllByAttributes(array('userId'=>$uid,'status'=>'active'));
            $activities  = Activity::model()->findAllBySql("SELECT * FROM `activity` WHERE projectId in (SELECT projectId FROM `project_user` WHERE userId = ".Yii::app()->session['uid']." ) ORDER BY created DESC LIMIT 10");
            $this->render('dashboard', array('projects' => $projects, 'activities' => $activities));
		
	}

    public function actionUpdateactivity()
    {
        $lastId = $_POST['last_id'];
        $activities  = Activity::model()->findAllBySql('SELECT * FROM `activity` WHERE id > '.$lastId.' AND  projectId in (SELECT projectId FROM `project_user` WHERE userId = '.Yii::app()->session["uid"].' ) ORDER BY created DESC LIMIT 10');
        $this->renderPartial('/activity/_activity_streams', array('activities' => $activities));
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
					$userData=User::model()->findByAttributes(array('id'=>$uid));
                 $act='CreateProject';
                $description=$userData->email.' created new project : '.$project->title;
                $initiator=$userData->email;
                Yii::app()->session['event']=array('0'=>array('activity'=>$act,
                                                                        'description'=>$description,
                                                                        'initiator'=>$initiator
                                                                      ) );  
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
                     

                     if($projectData->update(false))
                     {
                $userData=User::model()->findByPk(Yii::app()->session['uid']);
                $act='deleteProject';
                $description=$userData->email.' has delete project  : '.$projectData->title;
                $initiator=$userData->email;
                Yii::app()->session['event']=array('0'=>array('activity'=>$act,
                                                                        'description'=>$description,
                                                                        'initiator'=>$initiator
                                                                      ) );    
                     
                        Yii::app()->session['msg']='Project has been moved to Trash .<a href="/project/undo_delete/node/'.$_GET['node'].'"> Undo? </a>';
	    
                     }

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
    
     /**
     * Ajax Call on Creating New Task
     */
    public function actionAjaxTaskCreate(){
		//TODO: check to make sure user is logged in
                $task = new Task;
                if(isset($_POST['ajax']) && $_POST['ajax']==='task-form')
		{
			echo CActiveForm::validate($task);
			Yii::app()->end();
		}
		if (isset($_POST['Task']))
		{
                        Yii::log(json_encode($_POST['Task']), 'error');
            $task->attributes = $_POST['Task'];
			$task->ownerId = Yii::app()->user->id;
                        
			$respArray = array();
                        if ( $task->validate() && $task->save())
			{
                                $activity = new Activity;
				$activity->userId = Yii::app()->user->id;
				$activity->relatedObjectId = $task->id;
				$activity->relatedObjectType = 'task';
				$activity->type = 'task';
                                $activity->projectId = $_POST['Task']['projectId'];
				$activity->content = $task->owner->firstName . ' added a new task: "' . $task->subject . '"';

				if($activity->save()){
                                    ob_end_clean();
                                    echo CJSON::encode(array(
                                       'status'=>'success',
                                    ));
                                    Yii::app()->end();
                                }
                        }
			else
			{
                                ob_end_clean();
                                echo CActiveForm::validate($task);
                                Yii::app()->end();
                        }
                        $resp = json_decode(json_encode($respArray), false);
                }
                
    }

    public function actionAjaxProjects()
    {
        $uid=Yii::app()->session['uid'];
        $projects=Project::model()->findAllByAttributes(array('userId'=>$uid,'status'=>'active', 'studyboardId' => null));
        $studyboards=Studyboard::model()->findAllByAttributes(array('userId'=>$uid,'status'=>'active'));
        $activities  = Activity::model()->findAllBySql("SELECT * FROM `activity` WHERE projectId in (SELECT projectId FROM `project_user` WHERE userId = ".Yii::app()->session['uid']." ) ORDER BY created DESC LIMIT 10");
        $this->renderPartial('_ajaxProjects', array('projects' => $projects,'studyboards' => $studyboards, 'activities' => $activities));
    }
    public function actionUpdateflash()
    {
        $cookie = new CHttpCookie('flash','flash');
        $cookie->expire = time()+3600*24*365;
        Yii::app()->request->cookies['flash'] = $cookie;
        
        exit;
    }
    
     public function actionUpdatewelcomeflash()
    {
        /*$cookie = new CHttpCookie('welcomeflash','welcomeflash');
        $cookie->expire = time()+3600*24*365;
        Yii::app()->request->cookies['welcomeflash'] = $cookie;
        
        exit;*/
    }

}