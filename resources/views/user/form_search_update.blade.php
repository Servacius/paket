@extends('layouts.app', [
'class' => '',
'activePage' => 'daftarUser',
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
                            <b>{{ __('Daftar User') }}</b>
                        </h4>
                    </div>
                    <div class="card-body" style="margin-bottom: 16px;">
                        <div class="row">
                            <div class="col-md-10 offset-md-1">
                                <form id="formUpdateUser" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <input name="userID" id="userID" type="hidden">
                                    <div class="form-group">
                                        <label for="inputNama">{{ __('Cari Nama User') }}</label>
                                        <select class="form-control" id="userSearch" name="nama_penerima"
                                            style="padding-left: 0px"></select>
                                    </div>
                                    <div id="detailUserForm">
                                        <div class="row" id="accordion" style="margin-top: 16px; margin-bottom: 8px;">
                                            <button class="btn btn-primary" id="btnDetailUser" data-toggle="collapse" data-target="#collapseDetailUser" aria-expanded="true" aria-controls="collapseDetailUser" type="button">
                                                Detail User
                                            </button>
                                        </div>
                                        <div class="row">
                                            <label class="col-sm-3 col-form-label" style="margin-block: auto;">
                                                {!! __('NIK :') !!}</label>
                                            <div class="col-sm-9">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="nik"
                                                        id="nik" style="padding-left: 8px;" value="" />
                                                </div>
                                            </div>
                                        </div>
                                        <div id="collapseDetailUser" class="collapse" data-parent="#accordion">
                                            <div class="row">
                                                <label class="col-sm-3 col-form-label"
                                                    style="margin-block: auto;">{!! __('Email :') !!}</label>
                                                <div class="col-sm-9">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="email" id="email"
                                                            style="padding-left: 8px;" value="" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label class="col-sm-3 col-form-label" style="margin-block: auto;">
                                                    {!! __('No. Telepon :') !!}</label>
                                                <div class="col-sm-9">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="no_telepon" id="telp"
                                                            style="padding-left: 8px;" value="" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label class="col-sm-3 col-form-label"
                                                    style="margin-block: auto;">{{ __('Direktorat :') }}</label>
                                                <div class="col-sm-9">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="no_telepon" id="direktorat"
                                                            style="padding-left: 8px;" value="" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label class="col-sm-3 col-form-label"
                                                    style="margin-block: auto;">{{ __('Divisi :') }}</label>
                                                <div class="col-sm-9">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="no_telepon" id="divisi"
                                                            style="padding-left: 8px;" value="" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label class="col-sm-3 col-form-label"
                                                    style="margin-block: auto;">{{ __('Departement :') }}</label>
                                                <div class="col-sm-9">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="no_telepon" id="department"
                                                            style="padding-left: 8px;" value="" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label class="col-sm-3 col-form-label"
                                                    style="margin-block: auto;">{{ __('Unit :') }}</label>
                                                <div class="col-sm-9">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="no_telepon" id="unit"
                                                            style="padding-left: 8px;" value="" />
                                                    </div>
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
                                                        <option value="2">{{ "Karyawan" }}</option>
                                                        <option value="3">{{ "Petugas" }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 4rem;">
                                            <div class="col-md-6 text-left">
                                            </div>
                                            <div class="col-md-6 text-right">
                                                <button class="submit btn btn-info" id="btnUbah" type="submit" name="action" value="update-user-role">Ubah</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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
    $('#detailUserForm').hide();
    $('#btnDetailUser').attr('disabled', true);
    $('#nik').attr('disabled', true);
    $('#email').attr('disabled', true);
    $('#telp').attr('disabled', true);
    $('#direktorat').attr('disabled', true);
    $('#department').attr('disabled', true);
    $('#divisi').attr('disabled', true);
    $('#unit').attr('disabled', true);
    $('#btnUbah').attr('disabled', true);

    $().ready(function(){
        $('#roleUser').prop('disabled', true);
    });

    $('#userSearch').select2({
        placeholder: '',
        allowClear: true,
        style: 'padding-left: 0px;',
        ajax: {
            url: '/user/search?all=true',
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

        if (userID != "") {
            var url = '{{ route("user.detail.response", ":id") }}';
            url = url.replace(':id', userID);

            $.ajax({
                method: 'GET',
                url: url,
            })
            .done(function (userDetail) {
                console.dir(userDetail);
                $('#detailUserForm').show();

                $('#btnDetailUser').attr('disabled', false);
                $('#btnUbah').attr('disabled', false);

                $('#userID').val(userDetail.id);
                $('#nik').val(userDetail.nik);
                $('#email').val(userDetail.email);
                $('#telp').val(userDetail.telp);
                $('#direktorat').val(userDetail.direktorat);
                $('#divisi').val(userDetail.divisi);
                $('#department').val(userDetail.department);
                $('#unit').val(userDetail.unit);

                $('#role').val(userDetail.role);
                $('#role').selectpicker('refresh');
            })
        }
    });

    $('#userSearch').on('select2:clear', function (e) {
        $('#detailUserForm').hide();

        $('#btnDetailUser').attr('disabled', true);
        $('#btnUbah').attr('disabled', true);

        $('#nik').val("");
        $('#email').val("");
        $('#telp').val("");
        $('#direktorat').val("");
        $('#divisi').val("");
        $('#department').val("");
        $('#unit').val("");
    });

    $('#btnUbah').click(function(){
        var userID = $('#userID').val();

        var url = '{{ route("user.update.custom", ["id" => ":id"]) }}';
        url = url.replace(':id', userID)

        $('#formUpdateUser').attr('action', url);
    });

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