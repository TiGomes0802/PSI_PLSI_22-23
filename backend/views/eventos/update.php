<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Eventos $model */

$this->title = 'Update Eventos: ' . $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Eventos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<section class="u-align-center u-clearfix u-custom-color-2 u-section-1" id="sec-1a0b">
    <div class="u-clearfix u-sheet u-sheet-1">
        <h2 class="u-text u-text-default u-text-1">Update Evento</h2>

        <?= $this->render('_formUpdate', [
            'model' => $model,
        ]) ?>

    </div>
</section>
