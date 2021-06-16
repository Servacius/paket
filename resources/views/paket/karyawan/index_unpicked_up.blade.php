@extends('layouts.app', [
'class' => '',
'activePage' => 'paketku',
'titlePage' => 'Paketku'
])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            @if ($errors->any())
            <div class="col-12">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {!! $errors->first() !!}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            @endif

            @foreach ($pakets as $paket)
            @include('paket/karyawan/card_unpicked_up', ['paket' => $paket])
            @endforeach
        </div>
    </div>
</div>
@endsection