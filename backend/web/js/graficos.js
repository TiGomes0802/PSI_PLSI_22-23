jQuery(document).ready(function () {
  google.charts.setOnLoadCallback(draw_my_chart);
  function draw_my_chart() {
    var data = new google.visualization.DataTable();
    data.addColumn("string", "Tipo de eventos");
    data.addColumn("number", "pulseiras vendidas");

    model.forEach((element) => {
      data.addRows([
        [element.item_name, parseInt(element.quantidade_item_name)],
      ]);
    });

    var data2 = new google.visualization.DataTable();
    data2.addColumn("string", "descricao");
    data2.addColumn("number", "numero");

    model2.forEach((element) => {
      data2.addRows([[element.sexo, parseInt(element.quantidade)]]);
    });

    var options = {
      titleFontSize: 30,
      titlePosition: "none",
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

    var chart = new google.visualization.PieChart(
      document.getElementById("chart_div")
    );
    chart.draw(data, options);
    var chart2 = new google.visualization.PieChart(
      document.getElementById("chart_div2")
    );
    chart2.draw(data2, options);
  }
});
