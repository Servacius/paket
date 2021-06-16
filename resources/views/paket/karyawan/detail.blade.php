@extends('layouts.app', [
'class' => '',
'activePage' => '',
'titlePage' => 'Detail Paket'
])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card" style="margin-top: 8px;">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">{{ __('Detail Paket ') . $paketDetail->id }}</h4>
                    </div>
                    <div class="card-body text-right">
                        <div class="row">
                            <div class="col-md-4 offset-lg-4 text-center" style="margin-bottom: 16px;">
                                <img src="{{ ($paketDetail->picture == "") ? asset('default-image.jpeg') : asset('storage/' . $paketDetail->picture) }}"
                                    style="width:15rem; height:11rem;">
                            </div>
                        </div>
                        <div class="row" style="margin-top: 16px;">
                            <label class="col-sm-2 col-form-label">{{ __('NIK Penerima :') }}</label>
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <input type="text" class="form-control" style="background-color:#fff;"
                                        value="{{ ($paketDetail->nik_penerima == "") ? "-" : $paketDetail->nik_penerima }}"
                                        readonly />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">{{ __('Nama Penerima :') }}</label>
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <input type="text" class="form-control" style="background-color:#fff;"
                                        value="{{ ($paketDetail->nama_penerima == "") ? "-" : $paketDetail->nama_penerima }}"
                                        readonly />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">{{ __('Email :') }}</label>
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <input type="email" class="form-control" style="background-color:#fff;"
                                        value="{{ ($paketDetail->email == "") ? "-" : $paketDetail->email }}"
                                        readonly />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">{{ __('No. Telepon Penerima :') }}</label>
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <input type="text" class="form-control" style="background-color:#fff;"
                                        value="{{ ($paketDetail->telp == "") ? "-" : $paketDetail->telp }}" readonly />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">{{ __('Direktorat :') }}</label>
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <input type="text" class="form-control" style="background-color:#fff;"
                                        value="{{ ($paketDetail->direktorat == "") ? "-" : $paketDetail->direktorat }}"
                                        readonly />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">{{ __('Divisi :') }}</label>
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <input type="text" class="form-control" style="background-color:#fff;"
                                        value="{{ ($paketDetail->divisi == "") ? "-" : $paketDetail->divisi }}"
                                        readonly />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">{{ __('Departemen :') }}</label>
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <input type="text" class="form-control" style="background-color:#fff;"
                                        value="{{ ($paketDetail->department == "") ? "-" : $paketDetail->department }}"
                                        readonly />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">{{ __('Unit :') }}</label>
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <input type="text" class="form-control" style="background-color:#fff;"
                                        value="{{ ($paketDetail->unit == "") ? "-" : $paketDetail->unit }}" readonly />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">{{ __('Jenis Barang :') }}</label>
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <input type="text" class="form-control" style="background-color:#fff;"
                                        value="{{ ($paketDetail->jenis_barang == "") ? "-" : $paketDetail->jenis_barang }}"
                                        readonly />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">{{ __('Barang Berbahaya :') }}</label>
                            <div class="col-sm-9 text-left">
                                <div class="form-group">
                                    <div class="form-check form-check-radio form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" id="inlineRadioOptionYa"
                                                value="ya"
                                                {{ ($paketDetail->barang_berbahaya == "ya") ? "checked" : "" }}
                                                disabled> Ya
                                            <span class="circle">
                                                <span class="check"></span>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="form-check form-check-radio form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" id="inlineRadioOptionTidak"
                                                value="tidak"
                                                {{ ($paketDetail->barang_berbahaya == "tidak") ? "checked" : "" }}
                                                disabled> Tidak
                                            <span class="circle">
                                                <span class="check"></span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">{{ __('Tanggal Barang Sampai :') }}</label>
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <input type="text" class="form-control" style="background-color:#fff;"
                                        value="{{ ($paketDetail->tanggal_sampai == "") ? "-" : $paketDetail->tanggal_sampai }}"
                                        readonly />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">{{ __('Tanggal Barang Diambil/Diantar :') }}</label>
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <input type="text" class="form-control" style="background-color:#fff;"
                                        value="{{ ($paketDetail->tanggal_ambil == "") ? "-" : $paketDetail->tanggal_ambil }}"
                                        readonly />
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 4rem;">
                            <div class="col-md-9 text-left">
                                <a href="{{ route('paket.index', ['status' => 'unpickedup']) }}"
                                    class="btn btn-info btn-round" role="button" aria-pressed="true">Kembali</a>
                            </div>
                            <div class="col-md-3">
                                <div class="form-row">
                                    <div class="col-md-7 text-center">
                                        <a href="#" class="btn btn-primary btn-block btn-round" role="button"
                                            data-toggle="modal" data-target="#modalPenerimaanAmbilSendiri"
                                            aria-pressed="true">Ambil
                                            Sendiri</a>
                                    </div>
                                    <div class="col-md-5 text-center">
                                        <a href="#" class="btn btn-success btn-block btn-round" role="button"
                                            data-toggle="modal" data-target="#modalPenerimaanDiantar"
                                            aria-pressed="true">Diantar</a>
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

<!-- List of modals -->
@include('paket/karyawan/modal_penerimaan_diantar', ['paketDetail' => $paketDetail])
@include('paket/karyawan/modal_penerimaan_ambil_sendiri', ['paketDetail' => $paketDetail])