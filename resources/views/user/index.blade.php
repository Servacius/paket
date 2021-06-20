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
                        <a href="" class="btn btn-success pull-right">
                            <i class="material-icons" style="padding-right: 8px;">add_circle</i>Tambah
                            User
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="card">
                        <h4 class="card-header card-header-info">
                            <b>{{ __('Daftar Petugas dan Karyawan') }}</b>
                        </h4>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">NIK</th>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Posisi</th>
                                        <th class="text-center">No. Telepon</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Actions</th>
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
@endsection

@push('js')
<script>
</script>
@endpush