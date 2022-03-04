<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\search\BitacoratiemposSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bitacoratiempos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idBitacoraTiempo') ?>

    <?= $form->field($model, 'Fecha') ?>

    <?= $form->field($model, 'HoraInicio') ?>

    <?= $form->field($model, 'HoraFinal') ?>

    <?= $form->field($model, 'Interrupcion') ?>

    <?php // echo $form->field($model, 'Total') ?>

    <?php // echo $form->field($model, 'ActividadNoPlaneada') ?>

    <?php // echo $form->field($model, 'idActividadPlaneada') ?>

    <?php // echo $form->field($model, 'idProyecto') ?>

    <?php // echo $form->field($model, 'Artefacto') ?>

    <?php // echo $form->field($model, 'idUsuario') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
