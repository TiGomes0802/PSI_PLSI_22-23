<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Userprofile $model */

$this->title = 'Update Userprofile: ' . $modelprofile->id;
$this->params['breadcrumbs'][] = ['label' => 'Userprofiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $modelprofile->id, 'url' => ['view', 'id' => $modelprofile->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="userprofile-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'modelprofile' => $modelprofile,
        'modeluser' => $modeluser,
        'modelrole' => $modelrole,
    ]) ?>

</div>
