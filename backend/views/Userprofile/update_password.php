<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Userprofile $model */

$this->title = '';
?>

<section class="u-align-center u-clearfix u-custom-color-2 u-section-1" id="sec-1a0b">
    <div class="u-clearfix u-sheet u-sheet-1">
        <h2 class="u-text u-text-default u-text-1"><?= 'Atualizar password: ' . $model->nome . ' ' . $model->apelido?></h2>

        <?= $this->render('_form_update_password', [
            'model' => $model,
        ]) ?>

    </div>
</section>