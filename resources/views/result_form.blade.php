@extends('template')
@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Form Input Hasil Test</title>
    </head>

    <body>
        <div class="container-fluid dashboard-content">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="section-block" id="basicform">
                        <h3 class="section-title">Form Input Hasil Test</h3>
                        <p>Pastikan data yang dimasukkan sesuai</p>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-body">
                                <form action="{{ route('results.store') }}" method="post">
                                    <div class="form-group">
                                        @csrf
                                        <label for="nama" class="col-form-label">Nama</label>
                                        <input id="nama" name="nama" type="text" class="form-control" required>

                                        <label for="kelas" class="col-form-label">Sekolah/Instansi/Grub</label>
                                        <input id="kelas" name="kelas" type="text" class="form-control" required>

                                        <label for="opm_tambah" class="col-form-label">OPM Tambah:</label>
                                        <input type="text" step="any" min="0" id="opm_tambah"
                                            name="opm_tambah" class="form-control" formnovalidate>

                                        <label for="opm_kurang" class="col-form-label">OPM Kurang:</label>
                                        <input type="text" step="any" min="0" id="opm_kurang"
                                            name="opm_kurang" class="form-control" formnovalidate>

                                        <label for="opm_kali" class="col-form-label">OPM Kali:</label>
                                        <input type="text" step="any" min="0" id="opm_kali" name="opm_kali"
                                            class="form-control" formnovalidate>

                                        <label for="opm_bagi" class="col-form-label">OPM Bagi:</label>
                                        <input type="text" step="any" min="0" id="opm_bagi" name="opm_bagi"
                                            class="form-control" formnovalidate>

                                        <br></br>
                                        <input class="btn btn-sm btn-outline-warning" type="reset" value="Reset">
                                        <br></br>
                                        <button class="btn btn-sm btn-outline-primary" type="submit">Simpan</button>
                                        <a href="/result" class="btn btn-sm btn-outline-secondary">Kembali</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>
@endsection
