    google.charts.setOnLoadCallback(draw_my_chart);
    console.log('teste')
    function draw_my_chart() {
    //var model = <?=json_encode($model)?>;
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Tipo de eventos');
    data.addColumn('number', 'pulseiras vendidas');
    

    //model.forEach(element => console.log(element));

    //foreach ($model as $row) {
    //    data.addRows([[$row['item_name'], $row['quantidade_item_name']]]);
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
    var chart2 = new google.visualization.PieChart(document.getElementById('chart_div2'));
    chart2.draw(data, options);
    }