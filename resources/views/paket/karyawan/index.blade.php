@extends('layouts.app', [
'class' => '',
'activePage' => 'listSemuaPaket',
'titlePage' => __('Sistem Penerimaan Paket Barang'),
])

@section('content')
<div class="content" style="padding-top: 0px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h3>
                    <b>List Semua Paket</b>
                </h3>
            </div>
            <div class="w-100"></div>
            <br>
            @foreach ($pakets as $paket)
            @include('paket/karyawan/card', ['paket' => $paket])
            @endforeach
        </div>
    </div>
</div>
@endsection