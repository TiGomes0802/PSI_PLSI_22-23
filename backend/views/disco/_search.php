<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\DiscoSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="disco-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nome') ?>

    <?= $form->field($model, 'nif') ?>

    <?= $form->field($model, 'localidade') ?>

    <?= $form->field($model, 'codpostal') ?>

    <?php // echo $form->field($model, 'morada') ?>

    <?php // echo $form->field($model, 'lotacao') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
