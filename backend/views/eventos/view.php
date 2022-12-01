<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Eventos $model */

$this->title = '';
\yii\web\YiiAsset::register($this);
?>
<div class="eventos-view">

    <h1><?= Html::encode($model->nome) ?></h1>

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
                'label' => 'Nome',
                'value' => function ($data) {
                    return $data->nome;
                },
            ],
            [
                'label' => 'Descricao',
                'value' => function ($data) {
                    return $data->descricao;
                },
            ],
            [
                'format' => 'html',
                'label' => 'Cartaz',
                'value' => function ($data) {
                    return Html::img('cartaz/' . $data->cartaz,
                    ['width' => '260px','height' => '350px']);
                },
            ],
            [
                'label' => 'Data do evento',
                'format' => ['date', 'd/m/Y h:m'],
                'value' => function ($data) {
                    return $data->dataevento;
                },
            ],
            [
                'label' => 'Bilhetes disponiveis',
                'value' => function ($data) {
                    return $data->numbilhetesdisp;
                },
            ],
            [
                'label' => 'Preço',
                'value' => function ($data) {
                    return number_format( $data->preco, 2 ) . '€';
                },
            ],
            [
                'label' => 'Criador',
                'value' => function ($data) {
                    return $data->idcriador0->nome . ' ' . $data->idcriador0->apelido;
                },
            ],
            [
                'label' => 'Tipo de evento',
                'value' => function ($data) {
                    return $data->idtipoevento0->tipo;
                },
            ],
        ],
    ]) ?>

</div>
