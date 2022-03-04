<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Proyectos;
use yii\jui\DatePicker;
use yii\jui\TimePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Bitacoratiempos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bitacoratiempos-form">

    <?php $form = ActiveForm::begin(); ?>
    
   <?=
    $form->field($model, 'Fecha')->widget(\yii\jui\DatePicker::classname(), [
        'dateFormat' => 'dd-MM-yyyy',
        'value' => date('d/m/Y'),
        'options' => ['style' => 'position: relative; x-index: 0', 'class' => 'form-control']
    ]
    )
   ?>



    <?= $form->field($model, 'HoraInicio')->textInput()?> 
    <?= $form->field($model, 'HoraFinal')->textInput()?>   
  

    <?= $form->field($model, 'Interrupcion')->textInput() ?>

    <?= $form->field($model, 'ActividadNoPlaneada')->textInput(['maxlength' => true]) ?>

    <?php
    $proyectos = ArrayHelper::map(Proyectos::find()->where(['Activo' => 1])->orderBy('NombreProyecto')->all(), 'idProyecto', 'NombreProyecto');
    ?>
    <?= $form->field($model, 'idProyecto')->dropDownList($proyectos) ?>

    <?= $form->field($model, 'Artefacto')->textInput(['maxlength' => true]) ?>



    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
