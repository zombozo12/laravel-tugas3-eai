<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="row text-center">
        <div class="col-6">
            <h3 class="text-center">Statistik mahasiswa terkendala tunggakan pembayaran selama masa pandemi</h3>
            <canvas id="tunggakan"></canvas>
        </div>
        <div class="col-6">
            <h3 class="text-center">Statistik kesehatan mahasiswa selama masa pandemi</h3>
            <canvas id="covid_pie"></canvas>
        </div>
    </div>
    <div class="row text-center">
        <div class="col-6">
            <h3 class="text-center">Statistik mahasiswa yang menerima beasiswa</h3>
            <canvas id="beasiswa"></canvas>
        </div>
        <div class="col-6">
        </div>
    </div>
</div>
<script src="{{ asset('js/app.js') }}"></script>
<script>
    $(document).ready(function(){

        let chartColors = {
            pink: 'rgb(255, 99, 132)',
            red: 'rgb(255, 0, 0)',
            orange_s: 'rgb(255, 159, 64)',
            orange: 'rgb(255, 105, 86)',
            green: 'rgb(0, 192, 0)',
            green_s: 'rgb(75, 192, 192)',
            blue: 'rgb(54, 162, 235)',
            purple: 'rgb(153, 102, 255)',
            grey: 'rgb(201, 203, 207)',
            black: 'rgb(0, 0, 0)'
        };

        let pie_tunggakan_config = {
            type: 'pie',
            data: {
                datasets: [{
                    data: [
                        {{ $data_tunggakan->where('alasan_tunggakan', 'PHK')->count() }},
                        {{ $data_tunggakan->where('alasan_tunggakan', 'Orang Tua Meninggal')->count() }},
                        {{ $data_tunggakan->where('alasan_tunggakan', 'Telat Registrasi')->count() }},
                        {{ $data_tunggakan->where('alasan_tunggakan', 'Covid-19')->count() }},
                    ],
                    backgroundColor: [
                        chartColors.green_s,
                        chartColors.orange,
                        chartColors.grey,
                        chartColors.red
                    ],
                    label: 'Dataset 1'
                }],
                labels: [
                    'PHK',
                    'Orang Tua Meninggal',
                    'Telat Registrasi',
                    'Covid-19',
                ],
            },
            options: {
                responsive: true
            }
        }

        let hbar_beasiswa = {
            type: 'horizontalBar',
            data: {
                datasets: [{
                    data: [
                        {{ $data_beasiswa->where('jenis_beasiswa', 'Beasiswa BRI')->count() }},
                        {{ $data_beasiswa->where('jenis_beasiswa', 'Beasiswa YPT')->count() }},
                        {{ $data_beasiswa->where('jenis_beasiswa', 'Beasiswa Djarum')->count() }},
                        {{ $data_beasiswa->where('jenis_beasiswa', 'Beasiswa Prestasi')->count() }},
                        {{ $data_beasiswa->where('jenis_beasiswa', 'Beasiswa BCA')->count() }},
                        {{ $data_beasiswa->where('jenis_beasiswa', 'Beasiswa Kemendikbud')->count() }},
                        {{ $data_beasiswa->where('jenis_beasiswa', 'Beasiswa Bidikmisi')->count() }},
                    ],
                    backgroundColor: chartColors.orange
                }],
                labels: [
                    'Beasiswa BRI',
                    'Beasiswa YPT',
                    'Beasiswa Djarum',
                    'Beasiswa Prestasi',
                    'Beasiswa BCA',
                    'Beasiswa Kemendikbud',
                    'Beasiswa Bidikmisi',
                ],
            },
            options: {
                responsive: true,
                scales: {
                    xAxes: [{
                        ticks:{
                            beginAtZero: true
                        }
                    }]
                }
            }
        }

        let pie_zona_config = {
            type: 'pie',
            data: {
                datasets: [{
                    data: [
                        {{ $data_covid->where('zona_tinggal', 'Merah')->where('kondisi', 'Sehat')->count() }},
                        {{ $data_covid->where('zona_tinggal', 'Merah')->where('kondisi', 'Sakit')->count() }},
                        {{ $data_covid->where('zona_tinggal', 'Orange')->where('kondisi', 'Sehat')->count() }},
                        {{ $data_covid->where('zona_tinggal', 'Orange')->where('kondisi', 'Sakit')->count() }},
                        {{ $data_covid->where('zona_tinggal', 'Hitam')->where('kondisi', 'Sehat')->count() }},
                        {{ $data_covid->where('zona_tinggal', 'Hitam')->where('kondisi', 'Sakit')->count() }},
                        {{ $data_covid->where('zona_tinggal', 'Hijau')->where('kondisi', 'Sehat')->count() }},
                        {{ $data_covid->where('zona_tinggal', 'Hijau')->where('kondisi', 'Sakit')->count() }},
                    ],
                    backgroundColor: [
                        chartColors.pink,
                        chartColors.red,
                        chartColors.orange_s,
                        chartColors.orange,
                        chartColors.grey,
                        chartColors.black,
                        chartColors.green_s,
                        chartColors.green
                    ],
                    label: 'Dataset 2'
                }],
                labels: [
                    'Zona Merah - Sehat',
                    'Zona Merah - Sakit',
                    'Zona Orange - Sehat',
                    'Zona Orange - Sakit',
                    'Zona Hitam - Sehat',
                    'Zona Hitam - Sakit',
                    'Zona Hijau - Sehat',
                    'Zona Hijau - Sakit',
                ],
            },
            options: {
                responsive: true
            }
        }

        let covid_pie = $('#covid_pie')[0].getContext('2d');
        new Chart(covid_pie, pie_zona_config);
        let tunggakan_pie = $('#tunggakan')[0].getContext('2d');
        new Chart(tunggakan_pie, pie_tunggakan_config);
        let beasiswa_hbar = $('#beasiswa')[0].getContext('2d');
        new Chart(beasiswa_hbar, hbar_beasiswa);

    });

</script>
</body>
</html>
