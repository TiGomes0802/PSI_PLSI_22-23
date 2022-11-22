<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Disco $model */

$this->title = 'Update Disco: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Discos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="disco-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
