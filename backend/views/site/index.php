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

<?php
use common\models\AuthAssignment;

//$model = AuthAssignment::find()->all();
//$sql = 'SELECT COUNT(item_name), item_name FROM auth_assignment GROUP BY item_name';
$model = AuthAssignment::findBySql('SELECT COUNT(item_name), item_name FROM auth_assignment GROUP BY item_name');
var_dump($model);
die;
foreach ($model as $row) {


    var_dump($row['item_name']);

}
die;
?>
        <script>
        google.charts.setOnLoadCallback(draw_my_chart);
        function draw_my_chart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Tipo de eventos');
        data.addColumn('number', 'pulseiras vendidas');
        
        //foreach ($model as $role) {
        //    data.addRows([[$row['item_name'], $row['count']]]);
        //}
        data.addRows([['teste', 250]]);
        data.addRows([['MySQL', 110]]);
        data.addRows([['JavaScript', 200]]);
        data.addRows([['JQuery', 200]]);
        data.addRows([['HTML', 200]]);
        data.addRows([['ASP', 50]]);
        
        var options = {
            titleFontSize:30,   
            titlePosition: 'none',
            legend: {alignment: 'center', textStyle: {color: 'black', fontSize: 20}},
            //legend: 'none',
            pieSliceText: 'value',
            width:650,
            height:550,
            pieHole: 0.5,
            sliceVisibilityThreshold: .05,
            //is3D: true
        };

        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
        }
        </script>

        <div class="card card-olive">
            <div class="card-header">
                <h3 class="card-title">Tipo de eventos</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div id="chart_div"></div>
            </div>
        </div>
    </div>
</div>
