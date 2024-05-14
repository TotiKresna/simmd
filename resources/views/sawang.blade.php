@extends('template')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
    <title>Lihat Data</title>
</head>
<body>
    <div class="container-fluid dashboard-content">
        <div class="row row-cols-2">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Informasi Pengguna:</h3>
                        <p><strong>Nama:</strong> {{ $testResult->student->nama }}</p>
                        <p><strong>Sekolah / Universitas / Instansi:</strong> {{ $testResult->student->kelas }}</p>
                    </div>
                </div>
            </div>
            {{-- <div class="colmd-4">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Grafik OPM:</h3>
                        <canvas id="opmChart" width="300" height="200"></canvas>
                    </div>
                </div>
            </div> --}}
            <div class="col-md-8 ">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Riwayat Test Siswa:</h3>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal Test</th>
                                        <th>OPM Tambah</th>
                                        <th>OPM Kurang</th>
                                        <th>OPM Kali</th>
                                        <th>OPM Bagi</th>
                                        <th>OPM Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($testResults as $index => $result)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $result->created_at->format('d-m-Y H:i:s') }}</td>
                                        <td>{{ $result->opm_tambah }}</td>
                                        <td>{{ $result->opm_kurang }}</td>
                                        <td>{{ $result->opm_kali }}</td>
                                        <td>{{ $result->opm_bagi }}</td>
                                        <td>{{ $result->opm_total }}</td>
                                    </tr>
                                    @endforeach
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
    var ctx = document.getElementById('opmChart').getContext('2d');
    var opmChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Tambah', 'Kurang', 'Kali', 'Bagi'],
            datasets: [{
                label: 'Nilai OPM',
                data: [{{ $testResult->opm_tambah }}, {{ $testResult->opm_kurang }}, {{ $testResult->opm_kali }}, {{ $testResult->opm_bagi }}],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>


@endsection