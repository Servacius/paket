@extends('layouts.app', [
'class' => '',
'activePage' => 'dashboard',
'titlePage' => __('Sistem Penerimaan Paket Barang')
])

@section('content')
<div class="content" style="padding-top: 0px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-pricing bg-warning">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-icon" style="padding-bottom: 8px;">
                                    <span style="display: block;">
                                        <i class="pull-right material-icons text-white"
                                            style="padding-right: 8px; font-size: 48px;">view_list</i>
                                    </span>
                                    <h4 style="font-size: 20px">Daftar Paket</h4>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{ route('paket.index') }}" class="btn btn-white btn-round">Cek Sekarang</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-pricing bg-info">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-icon" style="padding-bottom: 8px;">
                                    <span style="display: block;">
                                        <i class="pull-right material-icons text-white"
                                            style="padding-right: 8px; font-size: 48px;">shopping_bag
                                        </i>
                                    </span>
                                    <h4 style="font-size: 20px;">Paketku</h4>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{ route('paket.index', ['unpickedup' => 'true']) }}"
                                    class="btn btn-white btn-round">Cek Sekarang</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection