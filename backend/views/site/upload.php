<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
//use dosamigos\fileinput\FileInput;


?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
<p>Indique el archivo en excel de sus tiempos a cargar:</p>

<?= $form->field($model, 'excelFile')->fileInput(['options' => ['class' => 'btn btn-primary']]) ?>

<?= Html::submitButton(Yii::t('app', 'Upload'), ['class' => 'btn btn-primary']) ?>

<?php ActiveForm::end() ?>