<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Userprofile $model */

$this->title = 'Create Userprofile';
$this->params['breadcrumbs'][] = ['label' => 'Userprofiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="u-align-center u-clearfix u-custom-color-2 u-section-1" id="sec-1a0b">
    <div class="u-clearfix u-sheet u-sheet-1">
        <h2 class="u-text u-text-default u-text-1">Adicionar Empregado</h2>

        <?= $this->render('form_add_empregado', [
            'modelprofile' => $modelprofile,
            'modeluser' => $modeluser,
            'modelrole' => $modelrole,
        ]) ?>

    </div>
</section>
