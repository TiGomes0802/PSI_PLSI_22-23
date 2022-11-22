<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Vip $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="vip-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'npessoas')->textInput() ?>

    <?= $form->field($model, 'descricao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nbebidas')->textInput() ?>

    <?= $form->field($model, 'preco')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
