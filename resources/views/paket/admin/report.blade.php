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
                            @include('paket/admin/search')
                        </div>
                        <br><br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr class="d-flex">
                                                <th class="text-center font-weight-bold col-1">NIK</th>
                                                <th class="text-center font-weight-bold col-2">Nama</th>
                                                <th class="text-center font-weight-bold col-2">No Telepon</th>
                                                <th class="text-center font-weight-bold col-2">Email</th>
                                                <th class="text-center font-weight-bold col-2">Direktorat</th>
                                                <th class="text-center font-weight-bold col-2">Divisi</th>
                                                <th class="text-center font-weight-bold col-2">Departemen</th>
                                                <th class="text-center font-weight-bold col-2">Unit</th>
                                                <th class="text-center font-weight-bold col-2">Jenis Barang</th>
                                                <th class="text-center font-weight-bold col-1">Barang Berbahaya</th>
                                                <th class="text-center font-weight-bold col-2">Tanggal Barang Sampai</th>
                                                <th class="text-center font-weight-bold col-2">Tanggal Barang Diambil/Diterima
                                                </th>
                                                <th class="text-center font-weight-bold col-2">Cara Penerimaan</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tablePaket">
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
    $('#formSearch').on('keyup keypress', function(e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) {
            e.preventDefault();
            return false;
        }
    });

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

                console.dir(data);

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

                    var row = '<tr class="d-flex">' +
                        '<td class="text-center col-1">' + data[i].nik_pemilik + ' </td>' +
                        '<td class="col-2">' + data[i].nama_pemilik + ' </td>' +
                        '<td class="col-2">' + data[i].no_telepon + ' </td>' +
                        '<td class="col-2">' + data[i].email + ' </td>' +
                        '<td class="col-2">' + data[i].direktorat + ' </td>' +
                        '<td class="col-2">' + data[i].divisi + ' </td>' +
                        '<td class="col-2">' + data[i].department + ' </td>' +
                        '<td class="col-2">' + data[i].unit + ' </td>' +
                        '<td class="col-2">' + data[i].jenis_paket + ' </td>' +
                        '<td class="text-center col-1">' + data[i].barang_berbahaya + ' </td>' +
                        '<td class="text-center col-2">' + data[i].tanggal_sampai + ' </td>' +
                        '<td class="text-center col-2">' + tanggalTerima + ' </td>' +
                        '<td class="text-center col-2">' + caraTerima + ' </td>' +
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