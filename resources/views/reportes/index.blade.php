@extends ('layout/admin')
@section ('contenido')
    <style>
        .bg-box-vendedores {
            background-color: #c70039;
            width: 100%;
            height: 150px;
            /* margin: 2px ; */
            padding-top : 5px; 
            color: #fff;
            border-right: 2px solid #fff;
        }
        .text-warning{
            font-size: 1.2em !important;
        }
    </style>

    <div class="row text-center block-center">
        <div class="col-sm-12 col-md-8 col-md-offset-2">
            {!! Form::open(array('url'=>'reportes','method'=>'GET','autocomplete'=>'off','role'=>'search','class'=>'form-inline'))!!}
                <div class="form-group">    
                    <label for="fecha_inicio" style="margin-right: 5px;">Fecha inicial</label> 
                    <input type="date" name="fecha_inicio" class="form-control">
                    <span style="margin-right: 10px;"></span>
                </div>
                <div class="form-group">    
                    <label for="fecha_final" style="margin-right: 5px;">Fecha final</label> 
                    <input type="date" name="fecha_final" class="form-control">
                </div>
                <div class="form-group">
                    <input type="submit" value="Aplicar filtro" class="btn btn-primary btn-round" style="margin-left: 10px;">
                </div>
            {{Form::close()}}
        </div>
    </div>

    <div class="row">
        <h1 class="text-center">Reporte General</h1>
    </div>
    <div class="row" style="margin: 0 auto !important;">
        <div class="col-sm-12 col-md-3 bg-box-vendedores text-center">
            <i class="fa fa-user fa-3x" aria-hidden="true"></i>
            <h3 class="h2">Clientes</h3>
            <h4><span class="text-warning">{{$num_clientes }}</span></h4>
        </div>
        <div class="col-sm-12 col-md-3 bg-box-vendedores text-center">
                <i class="fa fa-shopping-cart fa-3x" aria-hidden="true"></i>
            <h3 class="h2">Cotizaciones enviadas</h3>
            <h4><span class="text-warning">{{$num_cot }}</span></h4>
        </div>
        <div class="col-sm-12 col-md-3 bg-box-vendedores text-center">
            <i class="fa fa-file-text-o fa-3x" aria-hidden="true"></i>
            <h3 class="h2">Papeletas Registradas</h3>
            <h4><span class="text-warning">{{$num_papeletas }}</span></h4>
        </div>
        <div class="col-sm-12 col-md-3 bg-box-vendedores text-center">
            <i class="fa fa-thumbs-o-up fa-3x" aria-hidden="true"></i>
            <h3 class="h2">Vendedores</h3>
            <h4><span class="text-warning">{{$num_vendedores }}</span></h4>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 col-md-6">
            <h2>Reporte de cotizaciones por Vendedor</h2>
            <div id="donutchart" style="width: 900px; height: 620px;"></div>
        </div>
        <div class="col-sm-12 col-md-6">
            <h2>Reporte de papeletas por Vendedor</h2>
            <div id="columnchart_values" style="width: 900px; height: 300px;"></div>
        </div>
        <div class="col-sm-12 col-md-6">
            <h2>Reporte de ventas cerradas</h2>
            <div id="barchart_values" style="width: 900px; height: 300px;"></div>
        </div>
        <div class="col-sm-12 col-md-6">
            <h2>Top ten Productos</h2>
            <ul>
                @foreach($top_productos as $prod)
                <li><strong>{{ $prod->modelo}}</strong> - {{ $prod->descripcion}}</li>
                @endforeach
            </ul>
        </div>
    </div>






@endsection

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Vendedores', 'Id'],
            @foreach ($cotizaciones as $item)
            ['{{ $item->nombre }}',{{ $item->total }}],
            @endforeach
        ]);

        var options = {
            pieHole: 0.3,
            is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
        }
    </script>


    <script type="text/javascript">
        google.charts.load("current", {packages:['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ["Element", "Density", { role: "style" } ],
            @foreach ($papeletas as $item)
            ["{{$item->nombre}}",{{ $item->total }}, "#c70039"],
            @endforeach
        ]);

        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
                        { calc: "stringify",
                            sourceColumn: 1,
                            type: "string",
                            role: "annotation" },
                        2]);

        var options = {
            title: "Captura de papeletas",
            width: 600,
            height: 400,
            bar: {groupWidth: "95%"},
            legend: { position: "none" },
            is3D: true,
        };
        var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
        chart.draw(view, options);
    }
    </script>

    <script type="text/javascript">
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ["Element", "Density", { role: "style" } ],
            @foreach($ventas as $item)
            ["{{$item->nombre}}", {{$item->total}}, "#c70039"],
            @endforeach
        ]);

        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
                        { calc: "stringify",
                            sourceColumn: 1,
                            type: "string",
                            role: "annotation" },
                        2]);

        var options = {
            title: "Reporte de Ventas",
            bar: {groupWidth: "95%"},
            legend: { position: "none" },
        };
        var chart = new google.visualization.BarChart(document.getElementById("barchart_values"));
        chart.draw(view, options);
    }
    </script>


