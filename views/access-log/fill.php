<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AccessLogFillForm */
/* @var $form ActiveForm */
?>
<div class="access-log-fill">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'filename') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- access-log-fill -->
