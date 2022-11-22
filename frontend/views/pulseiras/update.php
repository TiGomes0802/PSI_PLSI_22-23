<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Pulseiras $model */

$this->title = 'Update Pulseiras: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pulseiras', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pulseiras-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
