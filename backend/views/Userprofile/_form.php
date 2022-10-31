<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Userprofile $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="userprofile-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apelido')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'datanascimento')->textInput() ?>

    <?= $form->field($model, 'codigoRP')->textInput() ?>

    <?= $form->field($model, 'userid')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
