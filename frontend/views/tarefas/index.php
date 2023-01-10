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

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    
    <?php foreach ($tarefas as $tarefa) { ?>
        
        <li>
            <ul>
                <p>Id Tarefa: <?= $tarefas->id ?></p>
            </ul>
            <ul>
                <p>descricao: <?= $tarefas->Descricao ?></p>
            </ul>
            <ul>
                <select name="tarefas" id="tarefasreal">
                    <option value="Feito">Feito</option>
                    <option value="NaoFeito">Nao Feito</option>
                </select>
            </ul>
            <ul>
                <p>Utilizador: <?= $tarefas->id_utilizador ?></p>
            </ul>
        </li>

    <?php } ?>


</div>
