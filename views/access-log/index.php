<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AccessLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Apache Access Log';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="access-log-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'date',
            'status_code',
            'ip',
            'url:url',
            'headers',
            // 'size',
            'referrer',
            'user_agent',
        ],
    ]); ?>
</div>
