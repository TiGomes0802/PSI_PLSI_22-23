<br>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Userprofile $model */

$this->title = $model->nome . " " . $model->apelido;
\yii\web\YiiAsset::register($this);
?>
<div class="row g-0">
    <div class="col-2"></div>
    <div class="col-8">
        <div class="userprofile-view">

            <h2><?= $model->nome . ' ' . $model->apelido ?></h2>

            <br>

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
                ],
            ]) ?>


            <p>
                <?= Html::a('Update', ['update', 'id' => $model->userid], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Update Password', ['update_password', 'id' => $model->userid], ['class' => 'btn btn-primary']) ?>
            </p>


        </div>
    </div>
</div>
