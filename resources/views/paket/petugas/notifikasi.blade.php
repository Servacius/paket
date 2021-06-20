@extends('layouts.app', [
'class' => '',
'activePage' => 'notifikasi',
'titlePage' => 'Sistem Penerimaan Paket Barang'
])

@section('content')
<div class="content" style="padding-top: 0px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h3>
                    <b>Notifikasi</b>
                    <br>
                    <small class="font-weight-light">Daftar Paket yang Akan Diambil/Diantar</small>
                </h3>
                <br>

                @if ($errors->any())
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-danger fade show">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="material-icons">close</i>
                            </button>
                            <span>{!! $errors->first() !!}</span>
                        </div>
                    </div>
                </div>
                @endif

                @foreach ($pakets as $paket)
                @include('paket/petugas/card_notifikasi', ['paket' => $paket])
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection