<?php
$this->title = '';
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-success alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fas fa-check"></i> Login!</h4>
                <h3>Olá <?php echo "$model->nome $model->apelido" ?><h3>
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
                    <span class="info-box-number">dinheiro dos eventos</span>
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
                    <span class="info-box-number">dinheiro dos eventos</span>
                </div>
                <span class="info-box-icon bg-olive"><i class="fa fa-ticket"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">pulseiras</span>
                    <span class="info-box-number">nºde pulseiras vendidas</span>
                </div>
            </div>
        </div>

        <script>
            var model = <?php print json_encode($grafico); ?>;
            var model2 = <?php print json_encode($grafico2); ?>;
        </script>
        
        <div class="col-6">
            <div class="card card-olive">
                <div class="card-header">
                    <h3 class="card-title">Tipo de eventos</h3>
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
            <div class="card card-olive">
                <div class="card-header">
                    <h3 class="card-title">Clientes</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div id="chart_div2"></div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card card-olive">
                <div class="card-header">
                    <h3 class="card-title">Ano 2022</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    
                    <div id="chart_div3" style=" height: 450px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
