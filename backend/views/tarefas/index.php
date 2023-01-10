<?php

use common\models\Tarefas;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\TarefasSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Tarefas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tarefas-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Tarefas', ['create', 'iduser' => $userprofile->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'label' => 'Descrição',
                'value' => function ($data) {
                    return $data->descricao;                     
                },
            ],
            [
                'label' => 'Estado',
                'value' => function ($data) {
                    if($data->feito == 0){
                        return 'Não realizada';
                    }else{
                        return 'Realizada';
                    }
                    
                },
            ],
            [
                'label' => 'Tarefe associada',
                'value' => function ($data) {
                    return $data->user->nome . ' ' . $data->user->apelido;
                },
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Tarefas $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
