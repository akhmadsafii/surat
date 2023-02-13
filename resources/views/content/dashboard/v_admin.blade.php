@extends('layout.admin.v_main')
@section('content')
    <div class="text-center mb-3">
        <h2>Selamat Datang di Aplikasi E Surat</h2>
        <div>Aplikasi ini memudahkan dalam pengolahan surat dan disposisi</div>
    </div>
    <div class="m-portlet m-portlet--bordered-semi m-portlet--space m-portlet--full-height ">
        <div class="m-portlet__body">
            <div class="row">
                <div class="col-xl-2 col-sm-4 col-6">
                    <div class="card my-1">
                        <div class="card-body">
                            <center>
                                <h3 class="primary"><i class="flaticon-feed fa-3x"></i></h3>
                                <span>Surat Masuk</span>
                            </center>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-sm-4 col-6">
                    <div class="card my-1">
                        <div class="card-body">
                            <center>
                                <h3 class="primary"><i class="flaticon-mail fa-3x"></i></h3>
                                <span>Surat Keluar</span>
                            </center>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-sm-4 col-6">
                    <div class="card my-1">
                        <div class="card-body">
                            <center>
                                <h3 class="primary"><i class="flaticon-list fa-3x"></i></h3>
                                <span>Draft</span>
                            </center>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-sm-4 col-6">
                    <div class="card my-1">
                        <div class="card-body">
                            <center>
                                <h3 class="primary"><i class="flaticon-file-1 fa-3x"></i></h3>
                                <span>Buat Pesan</span>
                            </center>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-sm-4 col-6">
                    <div class="card my-1">
                        <div class="card-body">
                            <center>
                                <h3 class="primary"><i class="flaticon-folder-2 fa-3x"></i></h3>
                                <span>Disposisi Masuk</span>
                            </center>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-sm-4 col-6">
                    <div class="card my-1">
                        <div class="card-body">
                            <center>
                                <h3 class="primary"><i class="flaticon-folder-3 fa-3x"></i></h3>
                                <span>Disposisi Keluar</span>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6 col-sm-6 col-12">
            <div class="card my-1">
                <div class="card-body d-flex">
                    <div class="description">
                        <h5 class="card-title">Inventarisasi Surat</h5>
                        <p class="card-text">Total Surat yang dimasukan ke sistem bulan ini.</p>
                    </div>
                    <h1 style="font-size: 3rem" class="my-auto">10</h1>

                </div>
                <div class="card-footer text-muted">
                    <a href="">Lihat Detail</a>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-sm-6 col-12">
            <div class="card my-1">
                <div class="card-body d-flex">
                    <div class="description">
                        <h5 class="card-title">Verifikasi</h5>
                        <p class="card-text">Total Surat yang harus diverifikasi bulan ini.</p>
                    </div>
                    <h1 style="font-size: 3rem" class="my-auto">6</h1>

                </div>
                <div class="card-footer text-muted">
                    <a href="">Lihat Detail</a>
                </div>
            </div>
        </div>
    </div>
@endsection
