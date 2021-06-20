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
                    <b>{{ __('List Semua Paket') }}</b>
                </h3>
                <br>
            </div>

            <div class="w-100"></div>

            @foreach ($pakets as $paket)
            @include('paket/card', ['paket' => $paket])
            @endforeach
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function () {
        var isError = '{{ $errors->any() }}';
        if (isError) {
            var message = '{!! $errors->first() !!}';
            showNotification('top', 'center', message);
        }
    });

    function showNotification(from, align, message){
        $.notify({
            icon: "",
            message: message
        },{
            type: 'danger',
            timer: 4000,
            placement: {
                from: from,
                align: align
            }
        });
    };
</script>
@endpush