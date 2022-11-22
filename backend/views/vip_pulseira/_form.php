<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\VipPulseira $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="vip-pulseira-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idvip')->textInput() ?>

    <?= $form->field($model, 'idpulseira')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
