<?php
/* @var $this Controller */
/* @var $model User */
/* @var $form CActiveForm */
?>

<?php
if (Yii::app()->user->hasFlash('update')) {
    if (Yii::app()->user->getFlash('update') === Yii::app()->params['SUCCESS'])
        echo '<div class="' . 'alert-success' . '">Successfully updated.</div>';
    elseif (Yii::app()->user->getFlash('update') === Yii::app()->params['FAILURE'])
        echo '<div class="' . 'alert-warning' . '">Unsuccessful.</div>';
    Yii::app()->user->setFlash('update', 0);
}
?>
<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'user-form',
    'enableAjaxValidation' => true,
    'enableClientValidation' => true,
    'focus' => array($model, 'firstName'),
)); ?>

<?php echo $form->errorSummary($model); ?>
    <ul class="nav nav-tabs" id="tab-panel">
        <li class="active"><a href="#general-tab" data-toggle="tab">General</a></li>
        <li><a href="#lab-tab" data-toggle="tab">Lab</a></li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="general-tab">
            <?php $this->renderPartial('_general', array('form' => $form, 'model' => $model)); ?>
        </div>
        <div class="tab-pane" id="lab-tab">
            <?php $this->renderPartial('_lab', array('form' => $form, 'model' => $model)); ?>
        </div>
    </div>

    <script>
        $(function () {
            $('#tab-panel').find('a:first').tab('show');
        })
    </script>
<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
<?php $this->endWidget(); ?>