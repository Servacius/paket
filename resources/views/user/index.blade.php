@extends('layouts.app', [
'class' => '',
'activePage' => 'user',
'titlePage' => __('Sistem Penerimaan Paket Barang'),
])

@section('content')
<div class="content" style="padding-top: 0px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ route('user.register') }}" class="btn btn-success pull-right">
                            <i class="material-icons" style="padding-right: 8px;">add_circle</i>Tambah
                            User
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <h4 class="card-header card-header-info">
                                <b>{{ __('Daftar Petugas dan Karyawan') }}</b>
                            </h4>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center font-weight-bold">NIK</th>
                                            <th class="text-center font-weight-bold">Nama</th>
                                            <th class="text-center font-weight-bold">Posisi</th>
                                            <th class="text-center font-weight-bold">No. Telepon</th>
                                            <th class="text-center font-weight-bold">Email</th>
                                            <th class="text-center font-weight-bold">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                        @include('user/row', ['user' => $user])
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
            showNotification('top', 'center', message, 'danger');
        }

        var isSuccess = '{{ session()->has("success") }}';
        if (isSuccess) {
            var message = '{!! session()->get("success") !!}';
            showNotification('top', 'center', message, 'success');
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