<?php

use common\models\Eventos;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\EventosSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Eventos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eventos-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Eventos', ['create'], ['class' => 'btn btn-success']) ?>

        <?= Html::a('Tipo eventos', ['tipoevento/index'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
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
                    ['width' => '80px','height' => '100px']);
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
                    return $data->preco . '€';
                },
            ],
            [
                'label' => 'Criador',
                'value' => function ($data) {
                    return $data->idcriador0->nome;
                },
            ],
            [
                'label' => 'Tipo de evento',
                'value' => function ($data) {
                    return $data->idtipoevento0->tipo;
                },
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Eventos $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
