@extends('template')
@section('content')
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Data Tables</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('concept/assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link href="{{ asset('concept/assets/vendor/fonts/circular-std/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('concept/assets/libs/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('concept/assets/vendor/fonts/fontawesome/css/fontawesome-all.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('concept/assets/vendor/datatables/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('concept/assets/vendor/datatables/css/buttons.bootstrap4.css') }}">
</head>
<body>
    <div class="container-fluid dashboard-content">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Tabel Hasil Test</h2>
                    <p class="pageheader-text"></p>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active" aria-current="page">Result & Analytics</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{ route('results.result_form') }}" class="btn btn-md btn-outline-primary">Tambah
                                Data</a>
                        </div>
                        <div class="col-md-6">
                            <form action="/import-excel" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile" name="file"
                                            required accept=".xlsx, .xls">
                                        <label class="custom-file-label" for="customFile">File input</label>
                                    </div>
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-outline-success"><i
                                                class="fas fa-file-excel"></i> Excel Import</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <form id="delete-selected-form" action="{{ route('results.deleteSelected') }}" method="POST">
                            @csrf
                            <table id="example" class="table table-striped table-bordered second" style="width:100%">
                                <thead>
                                    <tr>
                                        <th> </th>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Kelas</th>
                                        <th>OPM Tambah</th>
                                        <th>OPM Kurang</th>
                                        <th>OPM Kali</th>
                                        <th>OPM Bagi</th>
                                        <th>OPM Total</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $uniqueStudents = [];
                                    @endphp
                                    @foreach ($testResults as $testResult)
                                        @if (!in_array($testResult->student->nama, $uniqueStudents))
                                            <tr>
                                                <td>
                                                    <input class="select-checkbox" type="checkbox" name="selected_ids[]"
                                                        value="{{ $testResult->id }}">
                                                </td>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <a href="{{ route('results.sawang', $testResult->id) }}"
                                                        target="_blank">{{ $testResult->student->nama }}</a>
                                                </td>
                                                <td>{{ $testResult->student->kelas }}</td>
                                                <td>{{ $testResult->opm_tambah }}</td>
                                                <td>{{ $testResult->opm_kurang }}</td>
                                                <td>{{ $testResult->opm_kali }}</td>
                                                <td>{{ $testResult->opm_bagi }}</td>
                                                <td>{{ $testResult->opm_total }}</td>
                                                <td>
                                                    <a class="btn btn-xs btn-outline-warning"
                                                        href="{{ route('results.result_edit', $testResult->id) }}">Update</a>
                                                </td>
                                            </tr>
                                            @php
                                                $uniqueStudents[] = $testResult->student->nama;
                                            @endphp
                                        @endif
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Kelas</th>
                                        <th>OPM Tambah</th>
                                        <th>OPM Kurang</th>
                                        <th>OPM Kali</th>
                                        <th>OPM Bagi</th>
                                        <th>OPM Total</th>
                                        <th>Opsi</th>
                                    </tr>
                                </tfoot>
                            </table>
                            <button type="button" class="btn btn-outline-primary" id="select-all-btn">Select All</button>
                            <button type="submit" id="delete-selected-button"
                                class="btn btn-md btn-outline-danger">Hapus Terpilih</button>
                        </form>
                        @csrf
                        @method('POST')
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Optional JavaScript -->
        <script src="{{ asset('concept/assets/vendor/jquery/jquery-3.3.1.min.js') }}"></script>
        <script>
            function confirmDelete(testResultId) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You won\'t be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + testResultId).submit();
                    }
                });
            }
        </script>
        <script>
            $(document).ready(function() {
                $('#delete-selected-form').submit(function(event) {
                    // Cek apakah tidak ada kotak centang yang dicentang
                    if ($('.select-checkbox:checked').length === 0) {
                        event.preventDefault(); // Mencegah pengiriman formulir jika tidak ada data terpilih

                        // Tampilkan notifikasi SweetAlert untuk memilih setidaknya satu data
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Pilih setidaknya satu data untuk dihapus!',
                        });

                        // Hentikan eksekusi kode lebih lanjut
                        return false;
                    } else {
                        // Menampilkan notifikasi konfirmasi untuk menghapus data terpilih
                        event.preventDefault(); // Mencegah pengiriman formulir secara otomatis
                        Swal.fire({
                            title: 'Apakah Anda yakin?',
                            text: 'Data terpilih akan dihapus secara permanen!',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya, hapus!',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Lanjutkan dengan mengirimkan formulir jika pengguna mengonfirmasi
                                $(this).off('submit').submit();
                            }
                        });
                    }
                });
            });
        </script>
        {{-- mengubah nama field input excel --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelector('.custom-file-input').addEventListener('change', function(e) {
                    var fileName = document.getElementById("customFile").files[0].name;
                    var nextSibling = e.target.nextElementSibling;
                    nextSibling.innerText = fileName;
                });
            });
        </script>
        {{-- mengecek jika ada data yang sudah terpilih, ketika menekan tombol select all, data yang sudah dipilih tetap terceklis --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var selectAllBtn = document.getElementById('select-all-btn');
                var checkboxes = document.querySelectorAll('.select-checkbox');
        
                selectAllBtn.addEventListener('click', function() {
                    checkboxes.forEach(function(checkbox) {
                        checkbox.checked = !selectAllBtn.dataset.selected || selectAllBtn.dataset.selected === 'false';
                    });
                    selectAllBtn.dataset.selected = selectAllBtn.dataset.selected === 'true' ? 'false' : 'true';
                    updateButtonText();
                });
        
                checkboxes.forEach(function(checkbox) {
                    checkbox.addEventListener('change', function() {
                        updateButtonText();
                    });
                });
        
                function updateButtonText() {
                    var allChecked = true;
                    checkboxes.forEach(function(checkbox) {
                        if (!checkbox.checked) {
                            allChecked = false;
                        }
                    });
        
                    selectAllBtn.textContent = allChecked ? 'Unselect All' : 'Select All';
                }
            });
        </script>
        <script>
            @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
            });
            @endif
            @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
            });
            @endif
        </script>

</body>
</html>
@endsection
