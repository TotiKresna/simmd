@extends('template')
@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ asset('concept/assets/vendor/bootstrap/css/bootstrap.min.css') }}">
        <link href="{{ asset('concept/assets/vendor/fonts/circular-std/style.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('concept/assets/libs/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('concept/assets/vendor/fonts/fontawesome/css/fontawesome-all.css') }}">
        <!-- Include Chart.js library -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    </head>

    <body>

        <div class="container-fluid dashboard-content">
            <div class="row">
                <!-- Grafik OPM -->
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <h4 class="text-mb-4">Histogram Skor OPM (Operation per Minute)</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="text-center">Operasi Tambah</h4>
                                    <canvas id="opmTambahChart" style="width: 100%; height: auto;"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="text-center">Operasi Kurang</h4>
                                    <canvas id="opmKurangChart" style="width: 100%; height: auto;"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="text-center">Operasi Kali</h4>
                                    <canvas id="opmKaliChart" style="width: 100%; height: auto;"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="text-center">Operasi Bagi</h4>
                                    <canvas id="opmBagiChart" style="width: 100%; height: auto;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Statistik OPM -->
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="text-mb-3">Statistik OPM</h2>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered second">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Total Peserta</th>
                                            <th>Rata-rata</th>
                                            <th>Nilai Terendah & Tertinggi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>OPM Tambah</td>
                                            <td>{{ $totalPesertaTambah }}</td>
                                            <td>{{ $averageTambah }}</td>
                                            <td>{{ $minTambah }} & {{ $maxTambah }}</td>
                                        </tr>
                                        <tr>
                                            <td>OPM Kurang</td>
                                            <td>{{ $totalPesertaKurang }}</td>
                                            <td>{{ $averageKurang }}</td>
                                            <td>{{ $minKurang }} & {{ $maxKurang }}</td>
                                        </tr>
                                        <tr>
                                            <td>OPM Kali</td>
                                            <td>{{ $totalPesertaKali }}</td>
                                            <td>{{ $averageKali }}</td>
                                            <td>{{ $minKali }} & {{ $maxKali }}</td>
                                        </tr>
                                        <tr>
                                            <td>OPM Bagi</td>
                                            <td>{{ $totalPesertaBagi }}</td>
                                            <td>{{ $averageBagi }}</td>
                                            <td>{{ $minBagi }} & {{ $maxBagi }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>







    </body>

    </html>
    <script>
        var ctxTambah = document.getElementById("opmTambahChart").getContext('2d');
        var ctxKurang = document.getElementById("opmKurangChart").getContext('2d');
        var ctxKali = document.getElementById("opmKaliChart").getContext('2d');
        var ctxBagi = document.getElementById("opmBagiChart").getContext('2d');

        var opmTambahChart = new Chart(ctxTambah, {
            type: 'bar',
            data: {
                labels: ['0-10', '10-20', '20-30', '30-40', '40-50', '50-60', '60-70', '70+'],
                datasets: [{
                    label: 'Jumlah siswa',
                    data: <?php echo json_encode($opmTambahDataHist); ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: {
                        title: {
                            display: true,
                            text: 'Jumlah Siswa'
                        },
                        beginAtZero: true

                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Rentang Skor'
                        }
                    }

                },
                // legend: {
                //     display: false,
                // },
                // responsive: true
            }
        });

        var opmKurangChart = new Chart(ctxKurang, {
            type: 'bar',
            data: {
                labels: ['0-10', '10-20', '20-30', '30-40', '40-50', '50-60', '60-70', '70+'],
                datasets: [{
                    label: 'Jumlah siswa',
                    data: <?php echo json_encode($opmKurangDataHist); ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        title: {
                            display: true,
                            text: 'Jumlah Siswa'
                        },
                        beginAtZero: true
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Rentang Skor'
                        }
                    },
                    // legend: {
                    //     display: false,
                    //     position: 'bottom',
                    // }
                }
            }
        });

        var opmKaliChart = new Chart(ctxKali, {
            type: 'bar',
            data: {
                labels: ['0-10', '10-20', '20-30', '30-40', '40-50', '50-60', '60-70', '70+'],
                datasets: [{
                    label: 'Jumlah siswa',
                    data: <?php echo json_encode($opmKaliDataHist); ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        title: {
                            display: true,
                            text: 'Jumlah Siswa'
                        },
                        beginAtZero: true
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Rentang Skor'
                        }
                    },
                    legend: {
                        display: false,
                    }
                }
            }
        });

        var opmBagiChart = new Chart(ctxBagi, {
            type: 'bar',
            data: {
                labels: ['0-10', '10-20', '20-30', '30-40', '40-50', '50-60', '60-70', '70+'],
                datasets: [{
                    label: 'Jumlah siswa',
                    data: <?php echo json_encode($opmBagiDataHist); ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        title: {
                            display: true,
                            text: 'Jumlah Siswa'
                        },
                        beginAtZero: true
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Rentang Skor'
                        }
                    },
                    legend: {
                        display: false,
                    },
                }
            }
        });
    </script>
@endsection
