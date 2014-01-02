<?php
/* @var $model User */

/**
 * This contains the content of the general tab.
 */
?>

<div class="control-group">
    <label class="control-label" for="textinput">First Name</label>
    <div class="controls">
        <?php echo CHtml::activeTextField($model,'firstName', array('class' => 'input-xlarge', 'required' => true,)) ?>
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="textinput">Last Name</label>
    <div class="controls">
        <?php echo CHtml::activeTextField($model,'lastName', array('class' => 'input-xlarge', 'required' => true,)) ?>
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="textinput">Email address</label>
    <div class="controls">
        <?php echo CHtml::activeTextField($model,'email', array('class' => 'input-xlarge', 'required' => true,)) ?>
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="textinput">Preferred contact email</label>
    <div class="controls">
        <?php echo CHtml::activeTextField($model,'contactEmail', array('class' => 'input-xlarge', 'required' => true,)) ?>
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="textinput">
        <?php echo CHtml::link('Forgot Password?', Yii::app()->createUrl('site/ForgotPassword')); ?>
    </label>
</div>