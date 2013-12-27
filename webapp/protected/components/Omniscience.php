<?php

class Omniscience extends CController
{
  /**
   * get users from a project
   */
    
    public static function getUsers($projectId){
        return CHtml::listData(ProjectUser::model()->findAll(array('condition' => 'projectId ='.$projectId)),'userId',function($model){
            return CHtml::encode($model->user->firstName.' '.$model->user->lastName);
        });
       }
}
?>
