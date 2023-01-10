<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Noticias $model */

$this->title = '';
?>
<section class="u-align-center u-clearfix u-custom-color-2 u-section-1" id="sec-1a0b">
    <div class="u-clearfix u-sheet u-sheet-1">
        <h2 class="u-text u-text-default u-text-1"><?= 'Atualizar notícia: ' . $model->id ?></h2>

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>

    </div>
</section>