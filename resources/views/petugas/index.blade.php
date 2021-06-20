@extends('layouts.app', [
'class' => '',
'activePage' => 'dashboard',
'titlePage' => __('Sistem Penerimaan Paket Barang')
])

@section('content')
<div class="content" style="padding-top: 0px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ route('paket.create') }}" class="btn btn-success pull-right">
                            <i class="material-icons" style="padding-right: 8px;">add_circle</i>Tambah
                            Paket
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-pricing">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card-icon" style="padding-bottom: 8px;">
                                            <span style="display: block; font-size: 18px;">
                                                <i class="pull-right material-icons text-warning"
                                                    style="padding-right: 8px;">view_list</i>
                                                List Semua Paket
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <h2 class="card-title">
                                    {!! $dataPaket->count_all . '/<b style="font-size: 18px;">' . ($dataPaket->count_all
                                        -
                                        $dataPaket->count_all_pickedup) . ' belum diambil</b>' !!}
                                </h2>
                                <a href="{{ route('paket.index') }}" class="btn btn-warning btn-round">Cek Sekarang</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-pricing">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card-icon" style="padding-bottom: 8px;">
                                            <span style="display: block; font-size: 18px;">
                                                <i class="pull-right material-icons text-info"
                                                    style="padding-right: 8px;">notifications</i>
                                                Notifikasi
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <h2 class="card-title">
                                    {!! $dataPaket->count_all_notifikasi . ' <b style="font-size: 18px;"></b>'!!}
                                </h2>
                                <a href="{{ route('paket.index', ['penerimaan' => 'true']) }}"
                                    class="btn btn-info btn-round">Cek Sekarang</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection