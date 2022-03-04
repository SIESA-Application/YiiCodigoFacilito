<?php

namespace backend\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;
use backend\models\Graficas;
use yii;

class GraficasController extends Controller {
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'actions' => ['index', 'view', 'create', 'delete', 'update'],
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ],
            ]
        );
    }

    const NUM_DIAS = 15;
    public function actionIndex() {
        $fechas = array();
        for ($i = 0; $i < self::NUM_DIAS; $i++)
            $fechas[$i] = date("d-m-Y", strtotime((self::NUM_DIAS - $i)." days ago"));
        $grafica = new Graficas();
        $datos = $grafica->obtenDatos(self::NUM_DIAS, date('Y-m-d'), Yii::$app->user->id);
        return $this->render('tiempos', ['fechas' => $fechas, 'series' => $datos]);
    }

    public function actionDatos() {
        $model = Yii::$app->db->createCommand("select NombreProyecto, coalesce(F11_08_2015, 0) F11_08_2015, coalesce(F21_092_015, 0) F21_092_015 ".
                        "from proyectos p left outer join ".
                        "(select idProyecto, sum(Total) F11_08_2015 ".
                        "from bitacoratiempos ".
                        "WHERE Fecha = '2015-08-11' ".
                        "group by idProyecto) F1 ".
                        "ON p.idProyecto = F1.idProyecto ".
                        "left outer join ".
                        "(select idProyecto, sum(Total) F21_092_015 ".
                        "from bitacoratiempos ".
                        "WHERE Fecha = '2015-09-21' group by idProyecto) F2 ".
                        "ON p.idProyecto = F2.idProyecto")
                    ->queryAll();
            $array = array_column($model, 'F11_08_2015');
            $array = array_map('floatval', $array);
            return json_encode($array);
    }
}