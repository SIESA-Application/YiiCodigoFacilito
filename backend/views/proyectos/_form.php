<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use backend\models\Actividades;
use backend\models\Proyectos;
use yii\grid\ActionColumn;


/* @var $this yii\web\View */
/* @var $model backend\models\Proyectos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proyectos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'NombreProyecto')->textInput(['maxlength' => true]) ?>
    
    <?php
        if(!$model->isNewRecord) {
            echo $form->field($model, 'Activo')->checkbox();
        
    ?>
    
    <h2>Actividades</h2>
        <?=
            \yii\grid\GridView::widget([
                
                'dataProvider' => new \yii\data\ActiveDataProvider(['query' => $model->getActividades(),
                    'pagination' => false]),
                
                'columns' => [                    
                    'NombreActividad',
                    'idActividad',
                    'idProyecto',
                    
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'controller' => 'actividades',
                        'header' => Html::a('<i class="glyphicon glyphicon-plus"></i>&nbsp;Agregar nueva', ['actividades/create-con-proyecto', 'idProyecto' => $model->idProyecto]),
                        'template' => '{update_con_proyecto} {delete}',
                        'buttons' => [
                            'update_con_proyecto' => function($url, $model){
                                return Html::a('<span>Edit</span>', $url);
                            }
                        ],
                        'urlCreator' => function($action, $model, $key, $index){
                            if($action === 'update_con_proyecto'){
                                
                                $url = Url::to(['actividades/update-con-proyecto', 'id' => $model->idActividad]);
                                
                                return $url;
                            }
                        },
                    ],
                                
                ]
                
            ]);
                    
        ?>
        <?php } ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
