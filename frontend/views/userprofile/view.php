<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
/** @var yii\web\View $this */
/** @var common\models\Userprofile $model */

$this->title = $model->nome . " " . $model->apelido;
\yii\web\YiiAsset::register($this);
?>

<style>
    table {
    border-collapse: collapse;
    border-spacing: 0;
    width: 100%;
    border: 1px solid #ddd;
    }

    th, td {
    text-align: left;
    padding: 20px;
    width:33.33%;
    }

    tr:nth-child(even) {
    background-color: #f2f2f2;
    }
</style>

<div class="row g-0">
    <div class="col-2"></div>
    <div class="col-8">
        <div class="userprofile-view">
            <br>
            <h2><?= $model->nome . ' ' . $model->apelido ?></h2>
            <br>
            <p>
                <?= Html::a('Update', ['update', 'id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Update Password', ['update_password', 'id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
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
                        'format' => ['date', 'php:d/m/Y'],
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
            <?php if(\Yii::$app->user->can('verTarefas')) {?>
                <div class="u-clearfix u-sheet u-sheet-1">
        <h2 class="u-text u-text-default u-text-1">Escolher&nbsp; pulseira</h2>
        <br><br><br>
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
                <table>
                    <tr>
                        <th>Descrição</th>
                        <th>Preço</th>
                    </tr>
                    <?php foreach ($tarefas as $tarefa) { ?>
                        <tr>
                            <td style="width:40%"><?=$tarefa->descricao?></td>
                            <?php if($tarefa->feito == 1) {?>
                                <td style="width:10%"><input type="button" class="btn btn-danger" value="Realizada" disabled ></td>
                            <?php } else {?>
                                <td style="width:10%"><a href='index.php?r=tarefas%2Fupdate&id=<?=$tarefa->id?>'><input type="button" class="btn btn-success" value="Não realizado"></a></td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </table>
            </div>
            <div class="col-2"></div>
        </div>
    </div>
            <?php } ?>
            <?php if(\Yii::$app->user->can('verdadosEstatisticosCodigo')) {?>
                <script>
                    var model = <?php print json_encode($grafico); ?>;
                    var model2 = <?php print json_encode($grafico2); ?>;
                </script>
                <div class="row">
                    <div class="col-6">
                        <div class="card card-olive">
                            <div class="card-header">
                                <h4 class="card-title">Número dos tipos de eventos que usam o código</h4>
                            </div>
                            <div class="card-body">
                                <div id="chart_div"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card card-olive">
                            <div class="card-header">
                                <h4 class="card-title">Género das pessoas que usam o código</h4>
                            </div>
                            <div class="card-body">
                                <div id="chart_div2"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-12">
                        <div class="card card-olive">
                            <div class="card-header">
                                <h4 class="card-title">Eventos</h4>
                            </div>
                            <div class="card-body">
                                <table>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Data</th>
                                        <th>Número de codigos usados</th>
                                    </tr>
                                    <?php foreach ($listaeventos as $evento) { ?>
                                        <tr>
                                            <td><?=$evento['nome']?></td>
                                            <td><?=date("d/m/Y", strtotime($evento['dataevento'])); ?></td>
                                            <td><?=$evento['quantidade_codigos']?></td>
                                        </tr>
                                    <?php } ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <br>
        </div>
    </div>
</div>
