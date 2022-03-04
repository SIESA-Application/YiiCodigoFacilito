<?php

namespace backend\controllers;

use yii\rest\ActiveController;
use \yii\helpers\ArrayHelper;
use \yii\filters\auth\HttpBasicAuth;
use yii\filters\AccessControl;

class ApibtController extends ActiveController
{

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
        return $actions;
    }

    public $modelClass = 'backend\models\BitacoraTiempos';


    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                'authenticator' => [
                    'class' => HttpBasicAuth::class,
                ],
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'actions' => ['index', 'view', 'create', 'delete', 'update'],
                            'allow' => true,
                            'roles' => ['@'],
                        ]
                    ]
                ]
            ]
        );
    }

    public function actionIndex($inicio, $final)
    {
        $query = \backend\models\Bitacoratiempos::find();
        $query->andWhere("Fecha>='" . $inicio . "'");
        $query->andWhere("Fecha<='" . $final . "'");
        return $query->all();
    }
}
