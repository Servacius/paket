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
                <form action="{{ route('user.update.custom', ['id' => $user->id]) }}" id="formUpdateUser" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card" style="margin-top: 8px;">
                        <div class="card-header card-header-info">
                            <h4 class="card-title">
                                <b>{{ __('Form Ubah Hak Akses User') }}</b>
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
                                                <input type="text" class="form-control" name="nama"
                                                    id="nama" style="padding-left: 8px;" value="{{ ($user->name != "") ? $user->name : "" }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-3 col-form-label" style="margin-block: auto;">
                                            {!! __('NIK<sup class="text-danger">*</sup> :') !!}</label>
                                        <div class="col-sm-9">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="nik"
                                                    id="nik" style="padding-left: 8px;" value="{{ ($user->nik != "") ? $user->nik : "" }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-3 col-form-label"
                                            style="margin-block: auto;">{!! __('Email<sup class="text-danger">*</sup> :') !!}</label>
                                        <div class="col-sm-9">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="email" id="email"
                                                    style="padding-left: 8px;" value="{{ ($user->email != "") ? $user->email : "" }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-3 col-form-label" style="margin-block: auto;">
                                            {!! __('No. Telepon<sup class="text-danger">*</sup> :') !!}</label>
                                        <div class="col-sm-9">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="no_telepon" id="telp"
                                                    style="padding-left: 8px;" value="{{ ($user->no_telp != "") ? $user->no_telp : "" }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-3 col-form-label"
                                            style="margin-block: auto;">{{ __('Direktorat :') }}</label>
                                        <div class="col-sm-9">
                                            <div class="form-group">
                                                <select class="selectpicker form-control"
                                                    data-style="btn btn-link bg-white text-dark" name="direktorat"
                                                    id="direktorat" title="" >
                                                    <option value="0">{{ "None" }}</option>
                                                    @foreach ($direktorat as $d)
                                                        <option value="{{ $d->id }}" {{ ($user->direktorat_id == $d->id) ? "selected" : "" }}>{{ $d->name }}</option>
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
                                                <select class="selectpicker form-control"
                                                    data-style="btn btn-link bg-white text-dark" name="divisi"
                                                    id="divisi" title="">
                                                    <option value="0">{{ "None" }}</option>
                                                    @foreach ($divisi as $d)
                                                        <option value="{{ $d->id }}" {{ ($user->divisi_id == $d->id) ? "selected" : "" }}>{{ $d->name }}</option>
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
                                                <select class="selectpicker form-control"
                                                    data-style="btn btn-link bg-white text-dark" name="department"
                                                    id="department" title="">
                                                    <option value="0">{{ "None" }}</option>
                                                    @foreach ($department as $d)
                                                        <option value="{{ $d->id }}" {{ ($user->department_id == $d->id) ? "selected" : "" }}>{{ $d->name }}</option>
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
                                                <select class="selectpicker form-control"
                                                    data-style="btn btn-link bg-white text-dark" name="unit"
                                                    id="unit" title="">
                                                    <option value="0">{{ "None" }}</option>
                                                    @foreach ($unit as $u)
                                                        <option value="{{ $u->id }}" {{ ($user->unit_id == $u->id) ? "selected" : "" }}>{{ $u->name }}</option>
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
                                                <select class="selectpicker form-control"
                                                    data-style="btn btn-link bg-white text-dark" name="role"
                                                    id="role" title="">
                                                    <option value="2" {{ ($user->role_id == 2) ? "selected" : "" }}>{{ "Karyawan" }}</option>
                                                    <option value="3" {{ ($user->role_id == 3) ? "selected" : "" }}>{{ "Petugas" }}</option>
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
                                            <button class="submit btn btn-info" type="submit" name="action" value="update-user-role">Update</button>
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
    $('#nama').attr('disabled', true);
    $('#nik').attr('disabled', true);
    $('#email').attr('disabled', true);
    $('#telp').attr('disabled', true);
    $('#direktorat').attr('disabled', true);
    $('#department').attr('disabled', true);
    $('#divisi').attr('disabled', true);
    $('#unit').attr('disabled', true);

    jQuery.validator.addMethod("phoneIDN", function(phone_number, element) {
        return phone_number.match(/^(\+62|62)?[\s-]?0?8[1-9]{1}\d{1}[\s-]?\d{3,8}$/);
    }, "No. Telepon Penerima tidak valid.");
</script>
@endpush