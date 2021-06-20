@extends('layouts.app', [
'class' => '',
'activePage' => 'report',
'titlePage' => __('Sistem Penerimaan Paket Barang'),
])

@section('content')
<div class="content" style="padding-top: 0px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                {{-- <div class="row">
                    <div class="col-md-12">
                        <a href="" class="btn btn-success pull-right">
                            <i class="material-icons" style="padding-right: 8px;">add_circle</i>Tambah
                            User
                        </a>
                    </div>
                </div> --}}
                <div class="row">
                    <div class="card">
                        <h4 class="card-header card-header-info">
                            <b>{{ __('Daftar Paket') }}</b>
                        </h4>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-10 offset-md-1">
                                    <h4>Filter</h4>
                                    <br>
                                    <form action="{{ route('penerimaan.store') }}" id="formUpdatePenerimaanDiantar"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="inputName">{{ __('Nama:') }}</label>
                                            <input type="text" class="form-control" id="inputName" name="name"
                                                placeholder="">
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label
                                                    for="inputTanggalSampaiFrom">{{ __('Tanggal Barang Sampai (From):') }}</label>
                                                <input type="text" class="form-control datetimepicker"
                                                    id="inputTanggalSampaiFrom" name="tanggal_sampai_from">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label
                                                    for="inputTanggalSampaiTo">{{ __('Tanggal Barang Sampai (From):') }}</label>
                                                <input type="text" class="form-control datetimepicker"
                                                    id="inputTanggalSampaiTo" name="tanggal_sampai_to">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label
                                                    for="inputTanggalDiambilFrom">{{ __('Tanggal Barang Diambil (From):') }}</label>
                                                <input type="text" class="form-control datetimepicker"
                                                    id="inputTanggalDiambilFrom" name="tanggal_diambil_from">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label
                                                    for="inputTanggalDiambilTo">{{ __('Tanggal Barang Diambil (From):') }}</label>
                                                <input type="text" class="form-control datetimepicker"
                                                    id="inputTanggalDiambilTo" name="tanggal_diambil_to">
                                            </div>
                                        </div>
                                        <div class="form-row pull-right">
                                            <input type="submit" class="btn btn-info" value="Search" />
                                            <input type="submit" class="btn btn-primary" value="Export" />
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <br><br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">NIK</th>
                                                    <th class="text-center">Nama</th>
                                                    <th class="text-center">No Telepon</th>
                                                    <th class="text-center">Jenis Barang</th>
                                                    <th class="text-center">Tanggal Barang Sampai</th>
                                                    <th class="text-center">Tanggal Barang Diambil/Diterima</th>
                                                    <th class="text-center">Cara Penerimaan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($pakets as $paket)
                                                @include('paket/admin/row', ['paket' => $paket])
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
    </div>
</div>
@endsection

@push('js')
<script>
    $('#inputTanggalSampaiFrom').datetimepicker({
        icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-chevron-up",
            down: "fa fa-chevron-down",
            previous: 'fa fa-chevron-left',
            next: 'fa fa-chevron-right',
            today: 'fa fa-screenshot',
            clear: 'fa fa-trash',
            close: 'fa fa-remove'
        },
        format: 'DD-MM-YYYY',
    });

    $('#inputTanggalSampaiTo').datetimepicker({
        icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-chevron-up",
            down: "fa fa-chevron-down",
            previous: 'fa fa-chevron-left',
            next: 'fa fa-chevron-right',
            today: 'fa fa-screenshot',
            clear: 'fa fa-trash',
            close: 'fa fa-remove'
        },
        format: 'DD-MM-YYYY',
    });

    $('#inputTanggalDiambilFrom').datetimepicker({
        icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-chevron-up",
            down: "fa fa-chevron-down",
            previous: 'fa fa-chevron-left',
            next: 'fa fa-chevron-right',
            today: 'fa fa-screenshot',
            clear: 'fa fa-trash',
            close: 'fa fa-remove'
        },
        format: 'DD-MM-YYYY',
    });

    $('#inputTanggalDiambilTo').datetimepicker({
        icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-chevron-up",
            down: "fa fa-chevron-down",
            previous: 'fa fa-chevron-left',
            next: 'fa fa-chevron-right',
            today: 'fa fa-screenshot',
            clear: 'fa fa-trash',
            close: 'fa fa-remove'
        },
        format: 'DD-MM-YYYY',
    });
</script>
@endpush