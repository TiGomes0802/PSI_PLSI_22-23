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

        <script>
        google.charts.setOnLoadCallback(draw_my_chart);
        function draw_my_chart() {
        var model = <?php print json_encode($grafico); ?>;
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Tipo de eventos');
        data.addColumn('number', 'pulseiras vendidas');

        model.forEach((element) => {
            data.addRows([[element.item_name, parseInt(element.quantidade_item_name)]]);
        });

        var options = {
            titleFontSize:30,   
            titlePosition: 'none',
            legend: {alignment: 'center', textStyle: {color: 'black', fontSize: 20}},
            //legend: 'none',
            pieSliceText: 'value',
            width:550,
            height:350,
            pieHole: 0.5,
            sliceVisibilityThreshold: .05,
            //is3D: true
        };

        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
        var chart2 = new google.visualization.PieChart(document.getElementById('chart_div2'));
        chart2.draw(data, options);
        }
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
                    <h3 class="card-title">Outro grafico</h3>
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
    </div>
</div>
