@extends('layouts.app', [
'class' => '',
'activePage' => 'daftarPaket',
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
            setTimeout(() => {
                var message = '{!! $errors->first() !!}';
                showNotification('top', 'right', message, 'danger');
            }, 2000);
        }

        var isSuccess = '{{ session()->has("success") }}';
        if (isSuccess) {
            var message = '{!! session()->get("success") !!}';
            showNotification('top', 'right', message, 'success');
        }
    });

    function showNotification(from, align, message, type){
        $.notify({
            icon: "",
            message: message
        },{
            type: type,
            timer: 4000,
            placement: {
                from: from,
                align: align
            }
        });
    };
</script>
@endpush