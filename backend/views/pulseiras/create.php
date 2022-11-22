<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Pulseiras $model */

$this->title = 'Create Pulseiras';
$this->params['breadcrumbs'][] = ['label' => 'Pulseiras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pulseiras-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
