@extends('layouts.app', [
'class' => '',
'activePage' => 'tambahPaket',
'titlePage' => 'Sistem Penerimaan Paket Barang'
])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('paket.store') }}" id="formCreateNewPaket" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input name="nik_petugas" type="hidden" value="{{ auth()->user()->nik }}">
                    <div class="card" style="margin-top: 8px;">
                        <div class="card-header card-header-success">
                            <h4 class="card-title">
                                <b>{{ __('Form Tambah Paket') }}</b>
                            </h4>
                        </div>
                        <div class="card-body text-left">
                            <div class="row">
                                <div class="col-md-10 offset-md-1">
                                    <div class="row">
                                        <div class="col-md-4 offset-lg-4 text-center">
                                            <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail img-raised">
                                                    <img src="{{ asset('default-image.jpeg') }}" alt="..."
                                                        style="width: 15rem; height: 11rem;">
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail img-raised"
                                                    style="max-width: 15rem; max-height: 11rem; line-height: 20px;">
                                                </div>
                                                <div>
                                                    <span class="btn btn-raised btn-round btn-info btn-file">
                                                        <span class="fileinput-new">Pilih Gambar</span>
                                                        <span class="fileinput-exists">Change</span>
                                                        <input type="file" name="picture" />
                                                    </span>
                                                    <a href="" class="btn btn-danger btn-round fileinput-exists"
                                                        data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 16px;">
                                        <label class="col-sm-3 col-form-label"
                                            style="margin-block: auto;">{{ __('Nama Penerima :') }}</label>
                                        <div class="col-sm-9">
                                            <div class="form-group">
                                                <select class="form-control " id="userSearch" name="nama_penerima"
                                                    style="padding-left: 0px"></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-3 col-form-label" style="margin-block: auto;">
                                            {!! __('NIK Penerima<sup class="text-danger">*</sup> :') !!}</label>
                                        <div class="col-sm-9">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="nik_penerima"
                                                    id="nikPenerima" style="padding-left: 8px;" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-3 col-form-label"
                                            style="margin-block: auto;">{{ __('Email :') }}</label>
                                        <div class="col-sm-9">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="email" id="email"
                                                    style="padding-left: 8px;" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-3 col-form-label" style="margin-block: auto;">
                                            {!! __('No. Telepon Penerima<sup class="text-danger">*</sup> :') !!}</label>
                                        <div class="col-sm-9">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="telp" id="telp"
                                                    style="padding-left: 8px;" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-3 col-form-label"
                                            style="margin-block: auto;">{{ __('Direktorat :') }}</label>
                                        <div class="col-sm-9">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="direktorat"
                                                    id="direktorat" style="padding-left: 8px;" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-3 col-form-label"
                                            style="margin-block: auto;">{{ __('Divisi :') }}</label>
                                        <div class="col-sm-9">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="divisi"
                                                    style="padding-left: 8px;" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-3 col-form-label"
                                            style="margin-block: auto;">{{ __('Departement :') }}</label>
                                        <div class="col-sm-9">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="department"
                                                    id="department" style="padding-left: 8px;" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-3 col-form-label"
                                            style="margin-block: auto;">{{ __('Unit :') }}</label>
                                        <div class="col-sm-9">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="unit" id="unit"
                                                    style="padding-left: 8px;" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-3 col-form-label" style="margin-block: auto;">
                                            {!! __('Jenis Barang<sup class="text-danger">*</sup> :') !!}</label>
                                        <div class="col-sm-9">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="jenis_barang"
                                                    style="padding-left: 8px;" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-3 col-form-label">
                                            {!! __('Barang Berbahaya<sup class="text-danger">*</sup> :') !!}</label>
                                        <div class="col-sm-9 text-left">
                                            <div class="form-group">
                                                <div class="form-check form-check-radio form-check-inline">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="radio" value="ya"
                                                            name="barang_berbahaya" id="inlineRadioOptionYa"
                                                            style="padding-left: 8px;">
                                                        Ya
                                                        <span class="circle">
                                                            <span class="check"></span>
                                                        </span>
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-radio form-check-inline">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="radio" value="tidak"
                                                            name="barang_berbahaya" id="inlineRadioOptionTidak"
                                                            style="padding-left: 8px;"> Tidak
                                                        <span class="circle">
                                                            <span class="check"></span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-3 col-form-label"
                                            style="margin-block: auto;">{{ __('Tanggal Barang Sampai :') }}</label>
                                        <div class="col-sm-9">
                                            <div class="form-group">
                                                <input type="text" class="form-control datetimepicker"
                                                    name="tanggal_sampai" id="datepickerTanggalSampai"
                                                    style="padding-left: 8px;" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 4rem;">
                                        <div class="col-md-6 text-left">
                                            <a href="{{ route('paket.index') }}" class="btn btn-default" role="button"
                                                aria-pressed="true">Kembali</a>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <input class="submit btn btn-success" type="submit" value="Tambah" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $('#datepickerTanggalSampai').datetimepicker({
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

    $('#userSearch').select2({
        placeholder: '',
        allowClear: true,
        style: 'padding-left: 0px;',
        ajax: {
            url: '/user/search',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.name,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    });

    $('#userSearch').on('select2:selecting', function (e) {
        var userID = e.params.args.data.id;

        var url = '{{ route("user.detail.response", ":id") }}';
        url = url.replace(':id', userID);

        $.ajax({
            method: 'GET',
            url: url,
        })
        .done(function (userDetail) {
            document.getElementById('nikPenerima').value = userDetail.nik;
            document.getElementById('email').value = userDetail.email;
            document.getElementById('telp').value = userDetail.telp;
            document.getElementById('direktorat').value = userDetail.direktorat;
            document.getElementById('divisi').value = userDetail.divisi;
            document.getElementById('department').value = userDetail.department;
            document.getElementById('unit').value = userDetail.unit;
        })
    });

    $('#userSearch').on('select2:clear', function (e) {
        document.getElementById('nikPenerima').value = "";
        document.getElementById('email').value = "";
        document.getElementById('telp').value = "";
        document.getElementById('direktorat').value = "";
        document.getElementById('divisi').value = "";
        document.getElementById('department').value = "";
        document.getElementById('unit').value = "";
    });

    $().ready(function() {
        $('#formCreateNewPaket').validate({
            rules: {
                nik_penerima: {
                    required: true
                },
                telp: {
                    required: true,
                    phoneIDN: true
                },
                jenis_barang: {
                    required: true
                },
                barang_berbahaya: {
                    required: true
                },
                email: {
                    email: true
                },
                picture: {
                    required: true
                }
            },
            messages: {
                nik_penerima: {
                    required: "NIK Penerima tidak boleh kosong."
                },
                telp: {
                    required: "No. Telepon Penerima tidak boleh kosong."
                },
                jenis_barang: {
                    required: "Jenis Barang tidak boleh kosong."
                },
                barang_berbahaya: {
                    required: "Pilih salah satu."
                },
                email: {
                    email: "Format Email tidak valid."
                },
                picture: {
                    required: "Gambar tidak boleh kosong."
                }
            },
            errorPlacement: function(error, element) {
                if ( element.is(":radio") ) {
                    error.insertAfter( element.parents('.form-group') );
                } else if ( element.is(":text") ) {
                    error.insertAfter( element.parents('.form-group') );
                } else if ( element.is(":file") ) {
                    error.insertAfter( element.parents('.fileinput') );
                } else { // This is the default behavior
                    error.insertAfter( element );
                }
            }
        });
    });

    jQuery.validator.addMethod("phoneIDN", function(phone_number, element) {
        return phone_number.match(/^(\+62|62)?[\s-]?0?8[1-9]{1}\d{1}[\s-]?\d{3,8}$/);
    }, "No. Telepon Penerima tidak valid.");

    $(document).ready(function () {
        var isError = '{{ $errors->any() }}';
        if (isError) {
            var message = '{!! $errors->first() !!}';
            showNotification('top', 'center', message);
        }
    });

    function showNotification(from, align, message) {
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