@extends('layouts.app', [
'class' => '',
'activePage' => 'paketku',
'titlePage' => 'Sistem Penerimaan Paket Barang'
])

@section('content')
<div class="content" style="padding-top: 0px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h3>
                    <b>Paketku</b>
                    <br>
                    <small class="font-weight-light">Daftar Paket Anda yang Belum Diambil/Diantar</small>
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
                @include('paket/karyawan/card_unpicked_up', ['paket' => $paket])
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection