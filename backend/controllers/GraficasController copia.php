<?php

namespace backend\controllers;

use yii\web\controllers;
use yii\base\Controller;
use backend\models\Graficas;
use Yii;
use yii\filters\AccessControl;

// También se puede ver este código en video 19. ControlleresAccessControl minuto 12
class GraficasController extends Controller {
    
/*     public function behaviors() {
        return array_merge(
                parent::behaviors(),// en el video 28 no aparece.
                [//falta return video 28 min: 5:47
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
    } */

    public function behaviors() {
        return array_merge(
                parent::behaviors(),
                [
                    'access' => [
                        'class' => AccessControl::className(),
                        'rules' => [
                            [
                                'actions' => ['index', 'view', 'create', 'delete', 'update', 'datos'],
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
        for ($i = 0; $i < self::NUM_DIAS; $i++) {
            $fechas[$i] = date("d-m-Y", strtotime((self::NUM_DIAS - $i) . " days ago"));
        }
/*         $fechas2 = array();
        for ($i = 0; $i < self::NUM_DIAS; $i++) {
            $fechas2['f' . $i] = $fechas[$i];
        } */
        $grafica = new Graficas();
        $datos = $grafica->obtenDatos(self::NUM_DIAS, date('Y-m-d'), Yii::$app->user->id);
        return $this->render('tiempos', ['fechas' => $fechas, 'series' => $datos]);
    }

/*     public function actionDatos() {
        $model = Yii::$app->db->createCommand("select NombreProyecto, coalesce(F11_02_2022, 0) F11_02_2022, coalesce(F25_02_2022, 0) F25_02_2022 " .  
                    "from proyectos p left outer join " . 
                    "(select idProyecto, sum(Total) F11_02_2022 " . 
                    "from bitacoratiempos " . 
                    "WHERE Fecha = '2022-02-11' " . 
                    "group by idProyecto ) F1 " . 
                    "ON p.idProyecto = F1.idProyecto " . 
                    "left outer join " . 
                    "(select idProyecto, sum(Total) F25_02_2022 " . 
                    "from bitacoratiempos " . 
                    "WHERE  Fecha = '2022-02-25' group by idProyecto) F2 " . 
                    "ON p.idProyecto = F2.idProyecto ")
                ->queryAll();
        $array = array_column($model, 'F11_02_2022');
        $array = array_map('floatval', $array);
        return json_encode($array); 
    } */

    
}