<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Userprofile $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Userprofiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="userprofile-view">

    <h1><?= array_keys(Yii::$app->authManager->getRolesByUser($model->userid))[0] ?></h1>

    <br>

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

</div>
