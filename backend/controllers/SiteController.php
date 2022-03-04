<?php

namespace backend\controllers;

use common\models\LoginForm;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\web\UploadedFile;
use backend\models\UploadForm;
use backend\models\UpForm;
use backend\views\site\Up;
use backend\models\Graficas;

use backend\models\Bitacoratiempos;


/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'upload', 'up'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        $this->layout = 'Login';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionUpload() {
        $model = new UploadForm();
        $registro = new Bitacoratiempos();

        if(Yii::$app->request->isPost) {
            $model->excelFile = UploadedFile::getInstance($model, 'excelFile');
            if($model->upload()) {
                if($registro->guardaRegistro('uploads/'.$model->excelFile->name)) {
                    //return $this->goHome();
                } else {
                    return $this->render('error', ['message' => 'El archivo no tiene el formato deseado', 'name' => 'Error al guardar los datos']);
                }
            } else {
                return $this->render('error', ['message' => 'El archivo no pudo ser cargado o este ya existe', 'name' => 'Error al subir']);
            }
        }
        return $this->render('upload', ['model' => $model]);
    }

    public function actionUp()
    {
        $model = new UpForm();

        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->up()) {
                // el archivo se subió exitosamente
                return $this->render('up', ['model' => $model]);
            }
        }

        return $this->render('up', ['model' => $model]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
