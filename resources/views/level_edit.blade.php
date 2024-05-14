@extends('template')
@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Edit Data Level</title>
    </head>

    <body>
        <div class="container-fluid dashboard-content">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="section-block" id="basicform">
                        <h3 class="section-title">Form Edit Level</h3>
                        <p>Pastikan data yang dimasukkan sesuai</p>
                    </div>
                    <div class="card">
                        <h5 class="card-header">Level</h5>
                        <div class="card-body">
                            <form action="{{ route('levels.update', $level->id) }}" method="POST">
                                <div class="form-group">
                                    @csrf
                                    @method('PUT')
                                    <label for="level">Level:</label>
                                    <input type="text" id="level" name="level" value="{{ $level->level }}"
                                        class="form-control" required>
                                    <br></br>
                                    <button class="btn btn-sm btn-outline-primary" type="submit">Simpan</button>
                                    <a href="/levels"" class="btn btn-sm btn-outline-secondary">Cancel</a>
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
