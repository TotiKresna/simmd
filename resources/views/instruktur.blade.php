@extends('template')
@section('content')
    <!doctype html>
    <html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Data Instruktur</title>
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
                        <h2 class="pageheader-title">Instructor</h2>
                        <p class="pageheader-text"></p>
                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Category</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Instructor</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('instructors.instruktur_form') }}" class="btn btn-md btn-outline-primary">Tambah
                        Data</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered second" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Instruktur</th>
                                    <th>Email</th>
                                    <th>WhatsApp</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($instructors as $instructor)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $instructor->nama }}</td>
                                        <td>{{ $instructor->email }}</td>
                                        <td>{{ $instructor->whatsapp }}</td>
                                        <td>
                                            <form id="delete-form-{{ $instructor->id }}"
                                                action="{{ route('instructors.destroy', $instructor->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-xs btn-outline-danger" type="button"
                                                    onclick="confirmDelete('{{ $instructor->id }}')">Delete</button>
                                            </form>
                                            <a class="btn btn-xs btn-outline-warning"
                                                href="{{ route('instructors.instruktur_edit', $instructor->id) }}">Update</a>
                                        </td>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Instruktur</th>
                                    <th>Email</th>
                                    <th>WhatsApp</th>
                                    <th>Opsi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Optional JavaScript -->
        <script src="{{ asset('concept/assets/vendor/jquery/jquery-3.3.1.min.js') }}"></script>
        <script>
            function confirmDelete(instructorId) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You won\'t be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + instructorId).submit();
                    }
                });
            }
        </script>
    </body>

    </html>
@endsection
