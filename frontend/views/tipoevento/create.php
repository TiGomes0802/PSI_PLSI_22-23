<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Tipoevento $model */

$this->title = 'Create Tipoevento';
$this->params['breadcrumbs'][] = ['label' => 'Tipoeventos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipoevento-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
