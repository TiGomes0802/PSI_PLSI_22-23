<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Disco $model */

$this->title = 'Create Disco';
$this->params['breadcrumbs'][] = ['label' => 'Discos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="disco-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
