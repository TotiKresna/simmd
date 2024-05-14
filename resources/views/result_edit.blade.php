@extends('template')
@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>

    <body>
        <div class="container-fluid dashboard-content">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="section-block" id="basicform">
                        <h3 class="section-title">Form Edit Hasil Test</h3>
                        <p>Pastikan data yang dimasukkan sesuai</p>
                    </div>
                    <div class="card">
                        <h5 class="card-header">Hasil Test</h5>
                        <div class="card-body">
                            <form action="{{ route('results.update', $testResult->id) }}" method="POST">
                                <div class="form-group">
                                    @csrf
                                    @method('PUT')
                                    <!-- <label for="nama">Nama Siswa:</label>
                            <select name="nama" id="nama">
                                <option value="">Pilih Nama Siswa</option>
                                <option value="manual">* Default *</option>
                                @foreach ($students as $student)
    <option value="{{ $student->nama }}" {{ $testResult->nama == $student->nama ? 'selected' : '' }}>{{ $student->nama }}</option>
    @endforeach
                                <option value="manual">Default</option>
                            </select> -->

                                    <!-- <label for="kelas">Sekolah/Instansi/Grub:</label>
                            <select name="kelas" id="kelas">
                                <option value="">Pilih Sekolah</option>
                                <option value="manual">* Default *</option>
                                @foreach ($students as $student)
    <option value="{{ $student->kelas }}" {{ $testResult->kelas == $student->kelas ? 'selected' : '' }}>{{ $student->kelas }}</option>
    @endforeach
                                
                            </select> -->

                                    <label for="nama">Nama :</label>
                                    <input type="text" id="nama" name="nama"
                                        value="{{ $testResult->student->nama }}" class="form-control">

                                    <label for="kelas">Kelas :</label>
                                    <input type="text" id="kelas" name="kelas"
                                        value="{{ $testResult->student->kelas }}" class="form-control">

                                    <label for="opm_tambah">OPM Tambah:</label>
                                    <input type="text" step="0.01" min="0" id="opm_tambah" name="opm_tambah"
                                        value="{{ $testResult->opm_tambah }}" class="form-control">

                                    <label for="opm_kurang">OPM Kurang:</label>
                                    <input type="text" step="0.01" min="0" id="opm_kurang" name="opm_kurang"
                                        value="{{ $testResult->opm_kurang }}" class="form-control">

                                    <label for="opm_kali">OPM Kali:</label>
                                    <input type="text" step="0.01" min="0" id="opm_kali" name="opm_kali"
                                        value="{{ $testResult->opm_kali }}" class="form-control">

                                    <label for="opm_bagi">OPM Bagi:</label>
                                    <input type="text" step="0.01" min="0" id="opm_bagi" name="opm_bagi"
                                        value="{{ $testResult->opm_bagi }}" class="form-control">
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
    </body>

    </html>
@endsection
