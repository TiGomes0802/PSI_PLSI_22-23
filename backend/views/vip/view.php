<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Vip $model */

$this->title = '';
\yii\web\YiiAsset::register($this);
?>
<div class="vip-view">

    <h1><?= Html::encode($model->id) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'Número de Pessoas',
                'value' => function ($data) {
                    return $data->npessoas;
                },
            ],
            [
                'label' => 'Descrição',
                'format' => 'html',
                'value' => function ($data) {
                    return $data->descricao;
                },
            ],
            [
                'label' => 'Número de bebidas',
                'value' => function ($data) {
                    return $data->nbebidas;
                },
            ],
            [
                'label' => 'Preço',
                'value' => function ($data) {
                    return number_format( $data->preco, 2 ) . '€';
                },
            ],
        ],
    ]) ?>

</div>
