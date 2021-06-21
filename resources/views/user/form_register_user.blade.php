@extends('layouts.app', [
'class' => '',
'activePage' => '',
'titlePage' => 'Sistem Penerimaan Paket Barang'
])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('user.store') }}" id="formCreateNewUser" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input name="nik_petugas" type="hidden" value="{{ auth()->user()->nik }}">
                    <div class="card" style="margin-top: 8px;">
                        <div class="card-header card-header-success">
                            <h4 class="card-title">
                                <b>{{ __('Form Tambah User Baru') }}</b>
                            </h4>
                        </div>
                        <div class="card-body text-left">
                            <div class="row">
                                <div class="col-md-10 offset-md-1">
                                    <div class="row" style="margin-top: 16px;">
                                        <label class="col-sm-3 col-form-label"
                                            style="margin-block: auto;">{{ __('Nama :') }}</label>
                                        <div class="col-sm-9">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="name"
                                                    id="nama" style="padding-left: 8px;" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-3 col-form-label" style="margin-block: auto;">
                                            {!! __('NIK<sup class="text-danger">*</sup> :') !!}</label>
                                        <div class="col-sm-9">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="nik"
                                                    id="nik" style="padding-left: 8px;" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-3 col-form-label"
                                            style="margin-block: auto;">{{ __('Email :') }}</label>
                                        <div class="col-sm-9">
                                            <div class="form-group">
                                                <input type="email" class="form-control" name="email" id="email"
                                                    style="padding-left: 8px;" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-3 col-form-label" style="margin-block: auto;">
                                            {!! __('No. Telepon<sup class="text-danger">*</sup> :') !!}</label>
                                        <div class="col-sm-9">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="no_telepon" id="telp"
                                                    style="padding-left: 8px;" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-3 col-form-label"
                                            style="margin-block: auto;">{{ __('Direktorat :') }}</label>
                                        <div class="col-sm-9">
                                            <div class="form-group">
                                                <select class="form-control selectpicker"
                                                    data-style="btn btn-link" name="direktorat"
                                                    id="direktorat" title="">
                                                    <option value="0">{{ "None" }}</option>
                                                    @foreach ($direktorat as $d)
                                                        <option value="{{ $d->id }}">{{ $d->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-3 col-form-label"
                                            style="margin-block: auto;">{{ __('Divisi :') }}</label>
                                        <div class="col-sm-9">
                                            <div class="form-group">
                                                <select class="form-control selectpicker"
                                                    data-style="btn btn-link" name="divisi"
                                                    id="divisi" title="">
                                                    <option value="0">{{ "None" }}</option>
                                                    @foreach ($divisi as $d)
                                                        <option value="{{ $d->id }}">{{ $d->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-3 col-form-label"
                                            style="margin-block: auto;">{{ __('Departement :') }}</label>
                                        <div class="col-sm-9">
                                            <div class="form-group">
                                                <select class="form-control selectpicker"
                                                    data-style="btn btn-link" name="department"
                                                    id="depeartment" title="">
                                                    <option value="0">{{ "None" }}</option>
                                                    @foreach ($department as $d)
                                                        <option value="{{ $d->id }}">{{ $d->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-3 col-form-label"
                                            style="margin-block: auto;">{{ __('Unit :') }}</label>
                                        <div class="col-sm-9">
                                            <div class="form-group">
                                                <select class="form-control selectpicker"
                                                    data-style="btn btn-link" name="unit"
                                                    id="unit" title="">
                                                    <option value="0">{{ "None" }}</option>
                                                    @foreach ($unit as $u)
                                                        <option value="{{ $u->id }}">{{ $u->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-3 col-form-label"
                                            style="margin-block: auto;">{{ __('Role :') }}</label>
                                        <div class="col-sm-9">
                                            <div class="form-group">
                                                <select class="form-control selectpicker"
                                                    data-style="btn btn-link" name="role"
                                                    id="role" title="">
                                                    <option value="2">{{ "Karyawan" }}</option>
                                                    <option value="3">{{ "Petugas" }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 4rem;">
                                        <div class="col-md-6 text-left">
                                            <a href="{{ route('user.index') }}" class="btn btn-default" role="button"
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
    $().ready(function() {
        $('#formCreateNewUser').validate({
            rules: {
                nik: {
                    required: true
                },
                no_telepon: {
                    required: true,
                    phoneIDN: true
                }
            },
            messages: {
                nik: {
                    required: "NIK tidak boleh kosong."
                },
                no_telepon: {
                    required: "No. Telepon tidak boleh kosong."
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
</script>
@endpush