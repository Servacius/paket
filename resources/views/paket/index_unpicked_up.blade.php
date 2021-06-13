@extends('layouts.app', [
'class' => '',
'activePage' => 'paketku',
'titlePage' => 'Paketku'
])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            @foreach ($pakets as $paket)
            @include('card_unpicked_up', ['paket' => $paket])
            @endforeach
        </div>
    </div>
</div>
@endsection