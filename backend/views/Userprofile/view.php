<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Userprofile $model */

$this->title = $model->nome . ' ' . $model->apelido;
\yii\web\YiiAsset::register($this);
?>
<div class="userprofile-view">

    <h2><?= array_keys(Yii::$app->authManager->getRolesByUser($model->user_id))[0] ?></h2>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Update password', ['update_password', 'id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->user_id], [
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
                    return $data->nome .' '. $data->apelido;;
                },
            ],
            [
                'label' => 'Username',
                'value' => function ($data) {
                    return $data->user->username;
                },
            ],
            [
                'label' => 'Email',
                'value' => function ($data) {
                    return $data->user->email;
                },
            ],
            [
                'label' => 'Data de Nascimento',
                'format' => ['date', 'php:d-m-Y'],
                'value' => function ($data) {
                    return $data->datanascimento;
                },
            ],
            [
                'label' => 'Sexo',
                'value' => function ($data) {
                    return $data->sexo;
                },
            ],
            [
                'label' => 'codigo RP',
                'value' => function ($data) {
                    if($data->codigoRP != null){
                        return $data->codigoRP;
                    }
                    return '--------------';
                },
            ],
        ],
    ]) ?>

    
    <br>
    <?php if(array_keys(Yii::$app->authManager->getRolesByUser($model->user_id))[0] == 'gestor' or array_keys(Yii::$app->authManager->getRolesByUser($model->user_id))[0] == 'admin') {?>
        <script>
            var model = <?php print json_encode($grafico); ?>;
        </script>
        <div class="row">
            <div class="col-6">
                <div class="card card-olive">
                    <div class="card-header">
                        <h3 class="card-title">Número dos tipos de eventos criados</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="chart_div"></div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="info-box">
                    <span class="info-box-icon bg-olive">
                        <i class="far fa-calendar-alt"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Eventos</span>
                        <span class="info-box-number"><?=$numeventosuser?></span>
                    </div>
                    <span class="info-box-icon bg-olive"><i class="fa fa-money"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Retorno</span>
                        <span class="info-box-number"><?=number_format($valorfaturadouser,2).'€'?></span>
                    </div>
                    <span class="info-box-icon bg-olive"><i class="fa fa-ticket"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Pulseiras</span>
                        <span class="info-box-number"><?=$bilhetesveendidosuser?></span>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
