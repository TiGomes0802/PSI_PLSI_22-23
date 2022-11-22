<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Pulseiras $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="pulseiras-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'estado')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'codigorp')->textInput() ?>

    <?= $form->field($model, 'idevento')->textInput() ?>

    <?= $form->field($model, 'idcliente')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
