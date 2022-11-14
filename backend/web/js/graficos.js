jQuery(document).ready(function () {

  google.charts.setOnLoadCallback(draw_my_chart);
  google.charts.setOnLoadCallback(draw_my_chart2);

  google.charts.load('current', {'packages':['bar']});
  google.charts.setOnLoadCallback(draw_my_chart3);

  function draw_my_chart() {

    var options = {
      legend: {
        alignment: "center",
        textStyle: { color: "black", fontSize: 20 },
      },
      //legend: 'none',
      pieSliceText: "value",
      width: 590,
      height: 350,
      pieHole: 0.5,
      sliceVisibilityThreshold: 0.05,
      //is3D: true
    };

    //------------ grafico1 ------------------//
    console.log('teste');
    var data = new google.visualization.DataTable();
    data.addColumn("string", "Tipo de eventos");
    data.addColumn("number", "pulseiras vendidas");

    model.forEach((element) => {
      data.addRows([[element.item_name, parseInt(element.quantidade_item_name)]]);
    });

    var chart = new google.visualization.PieChart(
      document.getElementById("chart_div")
    );
    chart.draw(data, options);
  }

  function draw_my_chart2() {
    var options = {
      legend: {
        alignment: "center",
        textStyle: { color: "black", fontSize: 20 },
      },
      //legend: 'none',
      pieSliceText: "value",
      width: 590,
      height: 350,
      pieHole: 0.5,
      //is3D: true,
      colors: ['pink','lightblue']
    };

    //------------ grafico ------------------//

    console.log('teste');
    var data = new google.visualization.DataTable();
    data.addColumn("string", "descricao");
    data.addColumn("number", "numero");

    model2.forEach((element) => {
      data.addRows([[element.sexo, parseInt(element.quantidade)]]);
    });

    
    var chart = new google.visualization.PieChart(document.getElementById("chart_div2"));
    chart.draw(data, options);
  }

  function draw_my_chart3() {
    //------------ grafico ------------------//
    var data = google.visualization.arrayToDataTable([
      ['mes', 'Sales', 'Expenses', 'Profit', 'teste', 'test2'],
      ['Janeiro', 1000, 400, 200, 123, 200],
      ['Fevereiro', 1170, 460, 250, 123, 250],
      ['Março', 660, 1120, 300, 123, 300],
      ['Abril', 660, 1120, 300, 123, 300],
      ['Maio', 660, 1120, 300, 123, 300],
      ['Junho', 660, 1120, 300, 123, 300],
      ['Julho', 660, 1120, 300, 123, 300],
      ['Agosto', 660, 1120, 300, 123, 300],
      ['Setembro', 660, 1120, 300, 123, 300],
      ['Outobro', 660, 1120, 300, 123, 300],
      ['Novembro', 660, 1120, 300, 123, 300],
      ['Dezembro', 1030, 540, 350, 350, 123]
    ]);

    var options = {
      chart: {

      }
    };

    var chart = new google.charts.Bar(document.getElementById('chart_div3'));

    chart.draw(data, google.charts.Bar.convertOptions(options));
  }
  
});
