@extends('template')
@section('content')
    <!doctype html>
    <html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Data Siswa</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ asset('concept/assets/vendor/bootstrap/css/bootstrap.min.css') }}">
        <link href="{{ asset('concept/assets/vendor/fonts/circular-std/style.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('concept/assets/libs/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('concept/assets/vendor/fonts/fontawesome/css/fontawesome-all.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('concept/assets/vendor/datatables/css/dataTables.bootstrap4.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('concept/assets/vendor/datatables/css/buttons.bootstrap4.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('concept/assets/vendor/datatables/css/select.bootstrap4.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('concept/assets/vendor/datatables/css/fixedHeader.bootstrap4.css') }}">
    </head>

    <body>
        <div class="container-fluid dashboard-content">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h2 class="pageheader-title">Student</h2>
                        <p class="pageheader-text"></p>
                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Category</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Student</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('students.murid_form') }}" class="btn btn-md btn-outline-primary">Tambah Data</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <form id="delete-selected-form" action="{{ route('students.deleteSelected') }}" method="POST">
                            @csrf
                            <table id="example" class="table table-striped table-bordered second" style="width:100%">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>No</th>
                                        <th>Nama Siswa</th>
                                        <th>Kelas/Group</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $student)
                                        <tr>
                                            <td><input type="checkbox" class="select-checkbox" name="ids[]"
                                                    value="{{ $student->id }}"></td>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $student->nama }}</td>
                                            <td>{{ $student->kelas }}</td>
                                            <td>
                                                <a class="btn btn-xs btn-outline-warning"
                                                    href="{{ route('students.murid_edit', $student->id) }}">Update</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th>No</th>
                                        <th>Nama Siswa</th>
                                        <th>Kelas/Group</th>
                                        <th>Opsi</th>
                                    </tr>
                                </tfoot>
                            </table>
                            <button type="button" class="btn btn-outline-primary" id="select-all-btn">Select All</button>
                            <button id="delete-selected-btn" class="btn btn-outline-danger">Hapus Terpilih</button>
                        </form>
                        @csrf
                        @method('POST')
                    </div>
                </div>
            </div>
        </div>
        <!-- Optional JavaScript -->
        <script src="{{ asset('concept/assets/vendor/jquery/jquery-3.3.1.min.js') }}"></script>
        <script>
            function confirmDelete(studentId) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You won\'t be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + studentId).submit();
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
        {{-- mengecek jika ada data yang sudah terpilih, ketika menekan tombol select all, data yang sudah dipilih tetap terceklis --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var selectAllBtn = document.getElementById('select-all-btn');
                var checkboxes = document.querySelectorAll('.select-checkbox');

                selectAllBtn.addEventListener('click', function() {
                    checkboxes.forEach(function(checkbox) {
                        checkbox.checked = !selectAllBtn.dataset.selected || selectAllBtn.dataset
                            .selected === 'false';
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
    </body>

    </html>
@endsection
