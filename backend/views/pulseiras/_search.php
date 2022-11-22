<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\PulseirasSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="pulseiras-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'estado') ?>

    <?= $form->field($model, 'tipo') ?>

    <?= $form->field($model, 'codigorp') ?>

    <?= $form->field($model, 'idevento') ?>

    <?php // echo $form->field($model, 'idcliente') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
