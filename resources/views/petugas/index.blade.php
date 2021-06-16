@extends('layouts.app', [
'class' => '',
'activePage' => 'dashboard',
'titlePage' => __('Dashboard')
])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats" style="margin-top: 8px;">
                    <div class="card-header card-header-warning card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">view_list</i>
                        </div>
                        <p class="card-category">Lihat Semua Paket</p>
                        <h3 class="card-title">{{ "..." }}</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">check</i>
                            <a href="{{ route('paket.index') }}" class="font-weight-bold text-warning">Cek Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats" style="margin-top: 8px;">
                    <div class="card-header card-header-success card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">add_circle</i>
                        </div>
                        <p class="card-category">Tambah Paket</p>
                        <h3 class="card-title">{{ "..." }}</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">check</i>
                            <a href="" class="font-weight-bold text-success">Cek Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats" style="margin-top: 8px;">
                    <div class="card-header card-header-info card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">notifications</i>
                        </div>
                        <p class="card-category">Notifikasi</p>
                        <h3 class="card-title">{{ "..." }}</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">check</i>
                            <a href="" class="font-weight-bold text-info">Cek Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection