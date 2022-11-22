<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\VipPulseira $model */

$this->title = 'Create Vip Pulseira';
$this->params['breadcrumbs'][] = ['label' => 'Vip Pulseiras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vip-pulseira-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
