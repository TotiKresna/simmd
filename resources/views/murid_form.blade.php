@extends('template')
@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Tambah Data Siswa</title>
    </head>

    <body>
        <div class="container-fluid dashboard-content">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="section-block" id="basicform">
                        <h3 class="section-title">Form Input Siswa</h3>
                        <p>Pastikan data yang dimasukkan sesuai</p>
                    </div>
                    <div class="card">
                        <h5 class="card-header">Siswa</h5>
                        <div class="card-body">
                            <form action="{{ route('students.store') }}" method="post">
                                <div class="form-group">
                                    @csrf
                                    <label for="nama" class="col-form-label">Nama</label>
                                    <input id="nama" name="nama" type="text" class="form-control">
                                    <label for="kelas" class="col-form-label">Kelas</label>
                                    <input id="kelas" name="kelas" type="text" class="form-control">
                                    <br></br>
                                    <input class="btn btn-sm btn-outline-warning" type="reset" value="Reset">
                                    <br></br>
                                    <button class="btn btn-sm btn-outline-primary" type="submit">Simpan</button>
                                    <a href="/students" class="btn btn-sm btn-outline-secondary">Kembali</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>
@endsection
