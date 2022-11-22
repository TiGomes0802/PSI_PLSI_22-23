<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Vip $model */

$this->title = 'Create Vip';
$this->params['breadcrumbs'][] = ['label' => 'Vips', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vip-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
