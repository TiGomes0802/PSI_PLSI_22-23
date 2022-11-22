<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Faturas $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="faturas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'datahora_compra')->textInput() ?>

    <?= $form->field($model, 'idpulseira')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
