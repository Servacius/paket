@extends('layouts.app', [
'class' => '',
'activePage' => 'report',
'titlePage' => __('Sistem Penerimaan Paket Barang'),
])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card" style="margin-top: 8px;">
                    <div class="card-header card-header-info">
                        <h4 class="card-title">
                            <b>{{ __('Report Paket') }}</b>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-10 offset-md-1">
                                <h4>Filter</h4>
                                <br>
                                <form action="{{ route('paket.report') }}" id="formReport" method="GET"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="inputNama">{{ __('Nama:') }}</label>
                                        <input type="text" class="form-control" id="inputNama" name="nama"
                                            placeholder="" value="{{ ($filters->nama != "") ? $filters->nama : "" }}">
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label
                                                for="inputTanggalSampaiFrom">{{ __('Tanggal Barang Sampai (From):') }}</label>
                                            <input type="text" class="form-control datetimepicker"
                                                id="inputTanggalSampaiFrom" name="tanggal_sampai_from"
                                                value="{{ ($filters->tanggal_sampai_from != "") ? $filters->tanggal_sampai_from : "" }}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label
                                                for="inputTanggalSampaiTo">{{ __('Tanggal Barang Sampai (To):') }}</label>
                                            <input type="text" class="form-control datetimepicker"
                                                id="inputTanggalSampaiTo" name="tanggal_sampai_to"
                                                value="{{ ($filters->tanggal_sampai_to != "") ? $filters->tanggal_sampai_to : "" }}">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label
                                                for="inputTanggalDiambilFrom">{{ __('Tanggal Barang Diambil (From):') }}</label>
                                            <input type="text" class="form-control datetimepicker"
                                                id="inputTanggalDiambilFrom" name="tanggal_diambil_from"
                                                value="{{ ($filters->tanggal_diambil_from != "") ? $filters->tanggal_diambil_from : "" }}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label
                                                for="inputTanggalDiambilTo">{{ __('Tanggal Barang Diambil (To):') }}</label>
                                            <input type="text" class="form-control datetimepicker"
                                                id="inputTanggalDiambilTo" name="tanggal_diambil_to"
                                                value="{{ ($filters->tanggal_diambil_to != "") ? $filters->tanggal_diambil_to : "" }}">
                                        </div>
                                    </div>
                                    <div class="form-row pull-right">
                                        <div class="btn-group" role="group" aria-label="Action Button">
                                            <button type="button" class="btn btn-info" id="btnSearch" name="action"
                                                value="search">Search</button>
                                        </div>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Export
                                            </button>
                                            <div class="dropdown-menu">
                                                <a href="" class="dropdown-item" name="action"
                                                    value="export-csv">.csv</a>
                                                <a href="" class="dropdown-item" name="action"
                                                    value="export-xslx">.xslx</a>
                                            </div>
                                        </div>
                                        {{-- <div class="btn-group" role="group" aria-label="Action Button">
                                            <button type="submit" class="btn btn-primary" name="action" value="export-csv">Export .csv</button>
                                            <button type="submit" class="btn btn-warning" name="action" value="export-xslx">Export .xslx</button>
                                        </div> --}}
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
                                                <th class="text-center font-weight-bold">NIK</th>
                                                <th class="text-center font-weight-bold">Nama</th>
                                                <th class="text-center font-weight-bold">No Telepon</th>
                                                <th class="text-center font-weight-bold">Jenis Barang</th>
                                                <th class="text-center font-weight-bold">Tanggal Barang Sampai</th>
                                                <th class="text-center font-weight-bold">Tanggal Barang Diambil/Diterima
                                                </th>
                                                <th class="text-center font-weight-bold">Cara Penerimaan</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tablePaket">
                                            {{-- @foreach ($pakets as $paket)
                                            @include('paket/admin/row', ['paket' => $paket])
                                            @endforeach --}}
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
        showClear: true,
        showClose: true,
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
        showClear: true,
        showClose: true,
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
        showClear: true,
        showClose: true,
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
        showClear: true,
        showClose: true,
    });

    $().ready(function(){
        loadDataUser();
    })

    $('#btnSearch').click(function(){
        loadDataUser();
    })

    function loadDataUser() {
        $('tbody#tablePaket').empty();

        var nama = $("#inputNama").val();
        var tanggalSampaiFrom = $("#inputTanggalSampaiFrom").val();
        var tanggalSampaiTo = $("#inputTanggalSampaiTo").val();
        var tanggalDiambilFrom = $("#inputTanggalDiambilFrom").val();
        var tanggalDiambilTo = $("#inputTanggalDiambilTo").val();
        var _token = $('meta[name="csrf-token"]').attr('content');

        var baseURL = "{{ route('paket.search') }}";

        $.ajax({
            type: "GET",
            url: baseURL,
            data: {
                nama: nama,
                tanggal_sampai_from: tanggalSampaiFrom,
                tanggal_sampai_to: tanggalSampaiTo,
                tanggal_diambil_from: tanggalDiambilFrom,
                tanggal_diambil_to: tanggalDiambilTo,
                _token: _token
            },
            success: function (data) {
                var tableBody = $('tbody#tablePaket');

                for (var i = 0; i < data.length; i++) {
                    var tanggalTerima = "";
                    if (data[i].tanggal_pengantaran != "") {
                        tanggalTerima = data[i].tanggal_pengantaran;
                    } else if (data[i].tanggal_diambil != "") {
                        tanggalTerima = data[i].tanggal_diambil;
                    }

                    var caraTerima = "";
                    if (data[i].cara_penerimaan == "ambil_sendiri") {
                        caraTerima = "Ambil Sendiri";
                    } else if (data[i].cara_penerimaan == "diantar") {
                        caraTerima = "Diantar";
                    }

                    var row = '<tr>' +
                        '<td class="text-center">' + data[i].nik_pemilik + ' </td>' +
                        '<td>' + data[i].nama_pemilik + ' </td>' +
                        '<td>' + data[i].no_telepon + ' </td>' +
                        '<td>' + data[i].jenis_paket + ' </td>' +
                        '<td class="text-center">' + data[i].tanggal_sampai + ' </td>' +
                        '<td class="text-center">' + tanggalTerima + ' </td>' +
                        '<td class="text-center">' + caraTerima + ' </td>' +
                        '</tr>';

                    tableBody.append(row);
                }
            },
            error: function (error) {
                console.error(error)
                showNotification('top', 'center', 'Data user tidak dapat ditampilkan.', 'danger');
            }
        });
    }

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
    }
</script>
@endpush