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
                        <a href="{{ route('paket.create') }}" class="btn btn-info pull-right">
                            <i class="material-icons" style="padding-right: 8px;">article</i>Buat Report
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
                                                <i class="pull-right material-icons text-success"
                                                    style="padding-right: 8px;">account_circle</i>
                                                User
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <h2 class="card-title">
                                    {!! $dataPaket->count_all_user . ' <b style="font-size: 18px;"></b>' !!}
                                </h2>
                                <a href="{{ route('user.index') }}"
                                    class="btn btn-success btn-round">Cek Sekarang</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection