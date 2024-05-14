@extends('template')
@section('content')

<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="section-block" id="basicform">
            <h3 class="section-title">Form Edit Instruktur</h3>
            <p>Pastikan data yang dimasukkan sesuai</p>
        </div>
        <div class="card">
            <h5 class="card-header">Instruktur</h5>
            <div class="card-body">
                <form action="{{ route('instructors.update', $instructor->id) }}" method="post">
                    <div class="form-group">
                        @csrf
                        @method('PUT')
                        <label for="nama" class="col-form-label">Nama Instruktur </label>
                        <input id="nama" name="nama" type="text" class="form-control" value="{{ $instructor->nama }}" required>
                        <label for="email" class="col-form-label">Email:</label>
                        <input type="email" id="email" name="email" class="form-control" value="{{ $instructor->email }}" required>
                        <label for="whatsapp" class="col-form-label">WhatsApp:</label>
                        <input type="text" id="whatsapp" name="whatsapp" class="form-control" value="{{ $instructor->whatsapp }}" required>
                        <br></br>
                        <button class="btn btn-sm btn-outline-primary" type="submit">Simpan</button>
                        <a href="/instructors"" class="btn btn-sm btn-outline-secondary">Cancel</a>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection