@extends('layouts.app', [
'class' => '',
'activePage' => 'dashboard',
'titlePage' => __('Sistem Penerimaan Paket Barang')
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
                        <p class="card-category">Total Paket</p>
                        <h2 class="card-title font-weight-bold">{{ $dataPaket->count_all }}</h2>
                        <h6 class="card-title font-weight-normal">
                            {{ $dataPaket->count_all - $dataPaket->count_all_pickedup . ' paket belum diambil' }}</h6>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">check</i>
                            <a href="{{ route('paket.index') }}" class="font-weight-bold text-warning">Lihat Semua Paket
                                Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats" style="margin-top: 8px;">
                    <div class="card-header card-header-success card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">shopping_bag</i>
                        </div>
                        <p class="card-category">Paketku</p>
                        <h2 class="card-title font-weight-bold">{{ $dataPaket->count_user }}</h2>
                        <h6 class="card-title font-weight-normal">
                            {{ $dataPaket->count_user - $dataPaket->count_user_pickedup . ' paket belum diambil' }}</h6>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">check</i>
                            <a href="{{ route('paket.index', ['status' => 'unpickedup']) }}"
                                class="font-weight-bold text-success">Lihat Paketku Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection