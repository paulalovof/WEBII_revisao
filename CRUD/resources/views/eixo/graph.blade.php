<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="{{asset('js/google-chart-loader.js')}}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Gráfico Eixo</title>
</head>
<body>
    <header>Gráfico Eixo</header>
    <div class="row">
        <div class="col text-center" id="barra" style="width: 420px; height: 280px;"></div>
        <div class="col text-center" id="pizza" style="width: 420px; height: 280px;"></div>
    </div>

    <div class="row mt-2">
        <div class="col text-center" id="coluna" style="width: 420px; height: 280px;"></div>
        <div class="col text-center" id="linha" style="width: 420px; height: 280px;"></div>
    </div>

    <script type="text/javascript">
        var data_graph = <?php echo $data ?>;

        google.charts.load('current', {'packages':['corechart']})
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            // Dados do Gráfico
            let data = google.visualization.arrayToDataTable(data_graph);
            // GRÁFICO DE BARRAS
            // Opções de Configuração
            options = {
                title: 'TOTAL DE HORAS DOS ALUNOS',
                colors: ['#198754'],
                legend: 'none',
                hAxis: {
                    title: 'Horas Validadas',

                    titleTextStyle: {
                        fontSize: 12,
                        bold: true,
                    }
                },
                vAxis: {},
            };

            // DESENHA GRÁFICO DE BARRAS
            chart = new google.visualization.BarChart(document.getElementById('barra'));
            chart.draw(data, options);

            // ================================================= //
            // GRÁFICO DE PIZZA
            // Opções de Configuração
            options = {
                title: 'TOTAL DE HORAS DOS ALUNOS',
                is3D: true
            };

            // DESENHA GRÁFICO DE PIZZA
            chart = new google.visualization.PieChart(document.getElementById('pizza'));
            chart.draw(data, options);

            // ================================================= //
            // GRÁFICO DE COLUNA
            // Opções de Configuração
            options = {
                title: 'TOTAL DE HORAS DOS ALUNOS',
                colors: ['#198754'],
                legend: 'none',
                hAxis: {},
                vAxis: {
                    title: 'Horas Validadas',
                    titleTextStyle: {
                        fontSize: 12,
                        bold: true,
                    }
                }
            };

            // DESENHA GRÁFICO DE COLUNAS
            chart = new google.visualization.ColumnChart(document.getElementById('coluna'));
            chart.draw(data, options);

            // ================================================= //
            // GRÁFICO DE LINHA
            // Opções de Configuração
            options = {
                title: 'TOTAL DE HORAS DOS ALUNOS',
                colors: ['#198754'],
                curveType: 'function',
                legend: { position: 'bottom' }
            };

            chart = new google.visualization.LineChart(document.getElementById('linha'));
            chart.draw(data, options);
        }
    </script>
</body>
</html>