<?php

class StudyboardController extends Controller
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
                'actions'=>array('dashboard', 'index','Create','Delete','Update',
                    'ajaxStudyboards','addProjectsToStudyBoard', 'updateTitle'),
                'users'=>array('@'),
            ),
            array('deny','users'=>array('*'),),
        );
    }

    public function actionAjaxStudyboards(){
        $uid=Yii::app()->session['uid'];
        $studyboards=Studyboard::model()->findAllByAttributes(array('userId'=>$uid,'status'=>'active'));
        $activities  = Activity::model()->findAllBySql("SELECT * FROM `activity` WHERE projectId in (SELECT projectId FROM `project_user` WHERE userId = ".Yii::app()->session['uid']." ) ORDER BY created DESC LIMIT 10");
        $this->renderPartial('_ajaxStudyboards', array('studyboards' => $studyboards,'activities' => $activities));
    }

    public function actionCreate()
    {
        $uid=Yii::app()->session['uid'];
        if ($uid)
        {
            if (!empty($_POST['title']))
            {
                $studyboard = new Studyboard;
                $studyboard->userId = $uid;
                $studyboard->title = $_POST['title'];
                $studyboard->status = 'active';

                if ($studyboard->save())
                {
                    
                $userData=User::model()->findByPk(Yii::app()->session['uid']);
                $act='addStudyboard';
                $description=$userData->email.' has add a study board : '.$studyboard->title;
                $initiator=$userData->email;
                Yii::app()->session['event']=array('0'=>array('activity'=>$act,
                                                                        'description'=>$description,
                                                                        'initiator'=>$initiator
                                                                      ) );    
                    $this->redirect('/studyboard/index/'.$studyboard->id);
                }
                else
                {
                    Yii::log(json_encode($studyboard->getErrors()), 'error', 'StudyboardController.actionCreate');
                }
            }
        }
        else
        {
            echo "fail";
        }
    }

    public function actionIndex()
    {

        if (!empty($_GET['id']))
        {
            if(Yii::app()->user->isGuest)
            {
                $this->redirect('/');
            }

            $projects=Project::model()->findAllByAttributes(array('studyboardId'=>$_GET['id'],'status'=>'active'));
            $studyboard = Studyboard::model()->findByPk($_GET['id']);
            $this->render('index', array('studyboardId' => $_GET['id'],'projects' => $projects, 'studyboard' => $studyboard));
        }else{
            echo 'Id empty';
        }
    }

    public function actionDashboard()
    {
        if(Yii::app()->user->isGuest)
        {
            $this->redirect('/');
        }
        $this->render('dashboard');
    }

    public function actionAddProjectsToStudyBoard(){
        if(!empty($_POST)){
            if(!empty($_POST['projects'])){
                foreach($_POST['projects'] as $project){
                    if(!empty($_POST['add_project'][$project]) && $_POST['add_project'][$project] == 'on'){
                        // Project is selected
                        $project = Project::model()->findByPk($project);
                        $project->studyboardId = $_POST['studyboardId'];
                        $project->save();
                $userData=User::model()->findByPk(Yii::app()->session['uid']);
                $act='addProjectToStudyboard';
                $description=$userData->email.' has move project to study board';
                $initiator=$userData->email;
                Yii::app()->session['event']=array('0'=>array('activity'=>$act,
                                                                        'description'=>$description,
                                                                        'initiator'=>$initiator
                                                                      ) );   
                    }
                }
                $this->redirect('/studyboard/index/'.$_POST['studyboardId']);
                //echo "Project successfully added to the study board";
            }else{
                echo "fail";
            }
        }else{
            $uid=Yii::app()->session['uid'];
            $projects=Project::model()->findAllByAttributes(array('userId'=>$uid,'status'=>'active', 'studyboardId' => null));
            $records=Studyboard::model()->findAll(array("select" => "id, title"));
            $study_boards = array();
            foreach($records as $record){
                $study_boards[$record->id] = $record->title;
            }
            $this->render('addProjectsToStudyBoard', array('projects' => $projects, 'study_boards' => $study_boards));
        }
    }

    public function actionUpdateTitle()
    {
        $uid=Yii::app()->session['uid'];
        if ($uid)
        {
            if(isset($_POST['node']) && !empty($_POST['node']))
            {

                try{
                    $data=Studyboard::model()->findByPk($_POST['node']);
                    $data->title=$_POST['title'];

                    if($data->update(false))
                    {

                        echo 'Studyboard Title updated successfully..';

                    }
                }
                catch(Exception $e)
                {
                    echo 'Studyboard Title updation failed..';

                }
                exit;
            }
            else
            {
                echo "Studyboard Title updation failed..";
            }
        }
        else
        {
            echo "Studyboard Title updation failed..";
        }
    }
}