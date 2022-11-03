<?php
$this->title = 'Starter Page';
$this->params['breadcrumbs'] = [['label' => $this->title]];
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
            <div class="alert alert-success alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fas fa-check"></i> Login!</h4>
                <h3>Olá <?= Yii::$app->user->identity->username ?><h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="info-box">
                <span class="info-box-icon bg-olive"><i class="far fa-calendar-alt"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Eventos</span>
                    <span class="info-box-number">nºdeeventos</span>
                </div>
                <span class="info-box-icon bg-olive"><i class="fa fa-money"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">retorno</span>
                    <span class="info-box-number">dinheiro do evento</span>
                </div>
                <span class="info-box-icon bg-olive"><i class="fa fa-ticket"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">pulseiras</span>
                    <span class="info-box-number">nºde pulseiras vendidas</span>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="info-box">
                <span class="info-box-icon bg-olive"><i class="far fa-calendar-alt"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Eventos</span>
                    <span class="info-box-number">nºdeeventos</span>
                </div>
                <span class="info-box-icon bg-olive"><i class="fa fa-money"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">retorno</span>
                    <span class="info-box-number">dinheiro do evento</span>
                </div>
                <span class="info-box-icon bg-olive"><i class="fa fa-ticket"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">pulseiras</span>
                    <span class="info-box-number">nºde pulseiras vendidas</span>
                </div>
            </div>
        </div>
    </div>
</div>
