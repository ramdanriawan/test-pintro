
@extends('layouts.app')

@section('content')
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="active">Dashboard</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Dashboard</h1>
        </div>
    </div>

    <div class="panel panel-container">
        <div class="row col-md-offset-1">

            <div class="col-xs-6 col-md-2 col-lg-2 no-padding">
                <div class="panel panel-teal panel-widget border-right">
                    <div class="row no-padding"><em class="fa fa-xl fa-table color-blue"></em>
                        <div class="large">{{ $jabatan_count }}</div>
                        <div class="text-muted">Jabatan</div>
                    </div>
                </div>
            </div>

            <div class="col-xs-6 col-md-2 col-lg-2 no-padding">
                <div class="panel panel-blue panel-widget border-right">
                    <div class="row no-padding"><em class="fa fa-xl fa-table color-orange"></em>
                        <div class="large">{{ $pegawai_count }}</div>
                        <div class="text-muted">Pegawai</div>
                    </div>
                </div>
            </div>

            <div class="col-xs-6 col-md-2 col-lg-2 no-padding">
                <div class="panel panel-orange panel-widget border-right">
                    <div class="row no-padding"><em class="fa fa-xl fa-table color-teal"></em>
                        <div class="large">{{ $penggajian_count }}</div>
                        <div class="text-muted">Penggajian</div>
                    </div>
                </div>
            </div>

            <div class="col-xs-6 col-md-2 col-lg-2 no-padding">
                <div class="panel panel-red panel-widget ">
                    <div class="row no-padding"><em class="fa fa-xl fa-table color-red"></em>
                        <div class="large">{{ $absensi_count }}</div>
                        <div class="text-muted">Absensi</div>
                    </div>
                </div>
            </div>

            <div class="col-xs-6 col-md-2 col-lg-2 no-padding">
                <div class="panel panel-red panel-widget ">
                    <div class="row no-padding"><em class="fa fa-xl fa-table color-gray"></em>
                        <div class="large">{{ $cuti_count }}</div>
                        <div class="text-muted">Cuti</div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class='panel panel-container'>
        <div id='chart_div' style='widht: 100%; height: 400px;'>
            
        </div>
    </div>
@endsection

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script>
    google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);

      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
            ['Jabatan', 'Total', { role: 'style' }],
            ['Jabatan', {{ $jabatan_count }}, '#017071'],
            ['Pegawai', {{ $pegawai_count }}, '#A2220D'],
            ['Riwayat Jabatan', {{ $riwayat_jabatan_count }}, '#410162'],
            ['Cuti', {{ $cuti_count }}, '#A39700'],
            ['Penggajian', {{ $penggajian_count }}, '#061967'],
            ['Absensi', {{ $absensi_count }}, '#A66400']
        ]);

        var options = {
          title : 'Informasi Penggajian Dan Absensi',
          vAxis: {title: 'Total'},
          hAxis: {title: ''},
          seriesType: 'bars',
          series: {6: {type: 'line'}}        
        };

        var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }

    </script>