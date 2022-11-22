<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Eventos $model */

$this->title = 'Create Eventos';
$this->params['breadcrumbs'][] = ['label' => 'Eventos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eventos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
