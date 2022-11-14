<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\UserprofileSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="userprofile-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nome') ?>

    <?= $form->field($model, 'apelido') ?>

    <?= $form->field($model, 'datanascimento') ?>

    <?= $form->field($model, 'codigoRP') ?>

    <?php // echo $form->field($model, 'userid') ?>

    <?php // echo $form->field($model, 'sexo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
