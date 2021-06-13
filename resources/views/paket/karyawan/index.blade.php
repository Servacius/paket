@extends('layouts.app', [
'class' => '',
'activePage' => 'listSemuaPaket',
'titlePage' => __('List Semua Paket'),
])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            @foreach ($pakets as $paket)
            @include('paket/karyawan/card', ['paket' => $paket])
            @endforeach
        </div>
    </div>
</div>
@endsection