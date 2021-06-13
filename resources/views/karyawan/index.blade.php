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
                <div class="card card-stats">
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
                            <a href="" class="font-weight-bold text-warning">Cek Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-success card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">shopping_bag</i>
                        </div>
                        <p class="card-category">Paketku</p>
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
        </div>
    </div>
</div>
@endsection