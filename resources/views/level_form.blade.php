@extends('template')
@section('content')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="section-block" id="basicform">
            <h3 class="section-title">Tambah Data Level</h3>
            <p>Pastikan data yang dimasukkan sesuai</p>
        </div>
        <div class="card">
            <h5 class="card-header">Level</h5>
            <div class="card-body">
                <form action="{{ route('levels.store') }}" method="post">
                    <div class="form-group">
                        @csrf
                        <label for="level" class="col-form-label">Level ex.(A,B..dll.)</label>
                        <input id="level" name="level" type="text" class="form-control">
                        <br></br>
                        <input class="btn btn-sm btn-outline-warning" type="reset" value="Reset">
                        <br></br>
                        <button class="btn btn-sm btn-outline-primary" type="submit">Simpan</button>
                        <a href="/levels" class="btn btn-sm btn-outline-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection