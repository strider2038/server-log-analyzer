<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\AccessLogSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="access-log-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'layout' => 'inline',
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'dateStart')->widget(DateTimePicker::className(), [
        'options' => ['placeholder' => 'Start date'],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd hh:ii:ss',
            'todayHighlight' => true,
        ]
    ]) ?>
    
    <?= $form->field($model, 'endStart')->widget(DateTimePicker::className(), [
        'options' => ['placeholder' => 'End date'],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd hh:ii:ss',
            'todayHighlight' => true,
        ]
    ]) ?>
    
    <?= $form->field($model, 'url')->textInput(['placeholder' => $model->getAttributeLabel('url')]) ?>

    <?= $form->field($model, 'headers')->textInput(['placeholder' => $model->getAttributeLabel('headers')]) ?>

    <?= $form->field($model, 'referrer')->textInput(['placeholder' => $model->getAttributeLabel('referrer')]) ?>

    <?= $form->field($model, 'user_agent')->textInput(['placeholder' => $model->getAttributeLabel('user_agent')]) ?>
    
    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
