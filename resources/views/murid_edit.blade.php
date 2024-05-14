@extends('template')
@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Edit Data Siswa</title>
    </head>

    <body>
        <div class="container-fluid dashboard-content">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="section-block" id="basicform">
                        <h3 class="section-title">Form Edit Siswa</h3>
                        <p>Pastikan data yang dimasukkan sesuai</p>
                    </div>
                    <div class="card">
                        <h5 class="card-header">Siswa</h5>
                        <div class="card-body">
                            <form action="{{ route('students.update', $student->id) }}" method="POST">
                                <div class="form-group">
                                    @csrf
                                    @method('PUT')
                                    <label for="nama">Nama:</label>
                                    <input type="text" id="nama" name="nama" value="{{ $student->nama }}"
                                        class="form-control" required>
                                    <label for="kelas">Kelas:</label>
                                    <input type="text" id="kelas" name="kelas" value="{{ $student->kelas }}"
                                        class="form-control" required><br>
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
