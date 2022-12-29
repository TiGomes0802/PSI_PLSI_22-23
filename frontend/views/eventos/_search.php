<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\EventosSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="eventos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nome') ?>

    <?= $form->field($model, 'descricao') ?>

    <?= $form->field($model, 'cartaz') ?>

    <?= $form->field($model, 'dataevento') ?>

    <?php // echo $form->field($model, 'numbilhetesdisp') ?>

    <?php // echo $form->field($model, 'preco') ?>

    <?php // echo $form->field($model, 'estado') ?>

    <?php // echo $form->field($model, 'id_criador') ?>

    <?php // echo $form->field($model, 'id_tipo_evento') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
