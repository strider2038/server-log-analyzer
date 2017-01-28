<?php

namespace app\controllers;

use Yii;
use app\models\AccessLogSearch;
use app\models\AccessLogFillForm;
use app\models\AccessLogParser;

class AccessLogController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $searchModel = new AccessLogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionFill()
    {
        $model = new AccessLogFillForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                set_time_limit(600);
                $parser = new AccessLogParser();
                $parser->run($model->filename);
                return $this->redirect(['index']);
            }
        }

        return $this->render('fill', [
            'model' => $model,
        ]);
    }

    public function actionErase()
    {
        Yii::$app->db->createCommand()->truncateTable('access_log')->execute();
        return $this->redirect(['index']);
    }

}
