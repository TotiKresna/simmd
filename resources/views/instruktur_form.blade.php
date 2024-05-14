@extends('template')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Input Instruktur</title>
</head>
<body>
    <div class="container-fluid dashboard-content">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="section-block" id="basicform">
                    <h3 class="section-title">Form Input Instruktur</h3>
                    <p>Pastikan data yang dimasukkan sesuai</p>
                </div>
                <div class="card">
                    <h5 class="card-header">Instruktur</h5>
                    <div class="card-body">
                        <form action="{{ route('instructors.store') }}" method="post">
                            <div class="form-group">
                                @csrf
                                <label for="nama" class="col-form-label">Nama Instruktur</label>
                                <input id="nama" name="nama" type="text" class="form-control">
                                <label for="email">Email address</label>
                                <input id="email" name="email" type="email" placeholder="name@example.com"
                                    class="form-control">
                                <p>Kami tidak akan menyebarkan email anda kepada siapapun.</p>
                                <label for="whatsapp" class="col-form-label">WhatsApp </label>
                                <input id="whatsapp" name="whatsapp" type="number" class="form-control"
                                    placeholder="Numbers">
                                <br></br>
                                <input class="btn btn-sm btn-outline-warning" type="reset" value="Reset">
                                <br></br>
                                <button class="btn btn-sm btn-outline-primary" type="submit">Simpan</button>
                                <a href="/instructors"" class="btn btn-sm btn-outline-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function(e) {
            "use strict";
            $(".whatsapp-inputmask").inputmask("(999) 999-9999"),
                $(".email-inputmask").inputmask({
                    mask: "*{1,20}[.*{1,20}][.*{1,20}][.*{1,20}]@*{1,20}[*{2,6}][*{1,2}].*{1,}[.*{2,6}][.*{1,2}]",
                    greedy: !1,
                    onBeforePaste: function(n, a) {
                        return (e = e.toLowerCase()).replace("mailto:", "")
                    },
                    definitions: {
                        "*": {
                            validator: "[0-9A-Za-z!#$%&'*+/=?^_`{|}~/-]",
                            cardinality: 1,
                            casing: "lower"
                        }
                    }
                })
        });
    </script>
</body>
</html>
@endsection