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
                <div class="card" style="margin-top: 8px;">
                    <h4 class="card-header card-header-info">
                        <b>{{ __('Detail Informasi Paket dengan ID: ') . $paketDetail->id}}</b>
                    </h4>
                    <div class="card-body text-left">
                        <div class="row">
                            <div class="col-md-10 offset-md-1">
                                <div class="row">
                                    <div class="col-md-4 offset-lg-4 text-center" style="margin-bottom: 16px;">
                                        <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width: 15rem; height: 11rem;">
                                                <img src="{{ ($paketDetail->gambar == "") ? asset('default-image.jpeg') : asset('storage/images/' . $paketDetail->gambar) }}"
                                                    alt="..." style="max-width: 100%; max-height: 100%;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 16px;">
                                    <label class="col-sm-3 col-form-label"
                                        style="margin-block: auto;">{{ __('NIK Penerima :') }}</label>
                                    <div class="col-sm-9">
                                        <div class="form-group">
                                            <input type="text" class="form-control"
                                                style="background-color:#fff; padding-left: 8px;"
                                                value="{{ ($paketDetail->nik_penerima == "") ? "-" : $paketDetail->nik_penerima }}"
                                                readonly />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-3 col-form-label"
                                        style="margin-block: auto;">{{ __('Nama Penerima :') }}</label>
                                    <div class="col-sm-9">
                                        <div class="form-group">
                                            <input type="text" class="form-control"
                                                style="background-color:#fff; padding-left: 8px;"
                                                value="{{ ($paketDetail->nama_penerima == "") ? "-" : $paketDetail->nama_penerima }}"
                                                readonly />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-3 col-form-label"
                                        style="margin-block: auto;">{{ __('Email :') }}</label>
                                    <div class="col-sm-9">
                                        <div class="form-group">
                                            <input type="email" class="form-control"
                                                style="background-color:#fff; padding-left: 8px;"
                                                value="{{ ($paketDetail->email == "") ? "-" : $paketDetail->email }}"
                                                readonly />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-3 col-form-label"
                                        style="margin-block: auto;">{{ __('No. Telepon Penerima :') }}</label>
                                    <div class="col-sm-9">
                                        <div class="form-group">
                                            <input type="text" class="form-control"
                                                style="background-color:#fff; padding-left: 8px;"
                                                value="{{ ($paketDetail->no_telepon == "") ? "-" : $paketDetail->no_telepon }}"
                                                readonly />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-3 col-form-label"
                                        style="margin-block: auto;">{{ __('Direktorat :') }}</label>
                                    <div class="col-sm-9">
                                        <div class="form-group">
                                            <input type="text" class="form-control"
                                                style="background-color:#fff; padding-left: 8px;"
                                                value="{{ ($paketDetail->direktorat == "") ? "-" : $paketDetail->direktorat }}"
                                                readonly />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-3 col-form-label"
                                        style="margin-block: auto;">{{ __('Divisi :') }}</label>
                                    <div class="col-sm-9">
                                        <div class="form-group">
                                            <input type="text" class="form-control"
                                                style="background-color:#fff; padding-left: 8px;"
                                                value="{{ ($paketDetail->divisi == "") ? "-" : $paketDetail->divisi }}"
                                                readonly />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-3 col-form-label"
                                        style="margin-block: auto;">{{ __('Departement :') }}</label>
                                    <div class="col-sm-9">
                                        <div class="form-group">
                                            <input type="text" class="form-control"
                                                style="background-color:#fff; padding-left: 8px;"
                                                value="{{ ($paketDetail->department == "") ? "-" : $paketDetail->department }}"
                                                readonly />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-3 col-form-label"
                                        style="margin-block: auto;">{{ __('Unit :') }}</label>
                                    <div class="col-sm-9">
                                        <div class="form-group">
                                            <input type="text" class="form-control"
                                                style="background-color:#fff; padding-left: 8px;"
                                                value="{{ ($paketDetail->unit == "") ? "-" : $paketDetail->unit }}"
                                                readonly />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-3 col-form-label"
                                        style="margin-block: auto;">{{ __('Jenis Barang :') }}</label>
                                    <div class="col-sm-9">
                                        <div class="form-group">
                                            <input type="text" class="form-control"
                                                style="background-color:#fff; padding-left: 8px;"
                                                value="{{ ($paketDetail->jenis_paket == "") ? "-" : $paketDetail->jenis_paket }}"
                                                readonly />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-3 col-form-label"
                                        style="margin-block: auto;">{{ __('Barang Berbahaya :') }}</label>
                                    <div class="col-sm-9 text-left">
                                        <div class="form-group">
                                            <div class="form-check form-check-radio form-check-inline">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio"
                                                        id="inlineRadioOptionYa" value="ya"
                                                        {{ ($paketDetail->barang_berbahaya == "ya") ? "checked" : "" }}
                                                        disabled> Ya
                                                    <span class="circle">
                                                        <span class="check"></span>
                                                    </span>
                                                </label>
                                            </div>
                                            <div class="form-check form-check-radio form-check-inline">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio"
                                                        id="inlineRadioOptionTidak" value="tidak"
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
                                    <label class="col-sm-3 col-form-label"
                                        style="margin-block: auto;">{{ __('Tanggal Barang Sampai :') }}</label>
                                    <div class="col-sm-9">
                                        <div class="form-group">
                                            <input type="text" class="form-control"
                                                style="background-color:#fff; padding-left: 8px;"
                                                value="{{ ($paketDetail->tanggal_sampai == "") ? "-" : $paketDetail->tanggal_sampai }}"
                                                readonly />
                                        </div>
                                    </div>
                                </div>
                                @if ($paketDetail->tanggal_diambil != "")
                                <div class="row">
                                    <label class="col-sm-3 col-form-label"
                                        style="margin-block: auto;">{{ __('Tanggal Barang Diambil :') }}</label>
                                    <div class="col-sm-9">
                                        <div class="form-group">
                                            <input type="text" class="form-control"
                                                style="background-color:#fff; padding-left: 8px;"
                                                value="{{ ($paketDetail->tanggal_diambil == "") ? "-" : $paketDetail->tanggal_diambil }}"
                                                readonly />
                                        </div>
                                    </div>
                                </div>
                                @elseif ($paketDetail->tanggal_diantar != "")
                                <div class="row">
                                    <label class="col-sm-3 col-form-label"
                                        style="margin-block: auto;">{{ __('Tanggal Barang Diantar :') }}</label>
                                    <div class="col-sm-9">
                                        <div class="form-group">
                                            <input type="text" class="form-control"
                                                style="background-color:#fff; padding-left: 8px;"
                                                value="{{ ($paketDetail->tanggal_diantar == "") ? "-" : $paketDetail->tanggal_diantar }}"
                                                readonly />
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="row">
                                    <label class="col-sm-3 col-form-label"
                                        style="margin-block: auto;">{{ __('Cara Penerimaan :') }}</label>
                                    <div class="col-sm-9">
                                        <div class="form-group">
                                            <input type="text" class="form-control"
                                                style="background-color:#fff; padding-left: 8px;"
                                                value="{{ ($paketDetail->cara_penerimaan == "") ? "-" : $paketDetail->cara_penerimaan }}"
                                                readonly />
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 4rem;">
                                    <div class="col-md-8 text-left">
                                        <a href="{{ route('paket.index') }}" class="btn btn-default" role="button"
                                            aria-pressed="true">Kembali</a>
                                    </div>
                                    @if (auth()->user()->role_id == 2)
                                    <div class="col-md-4">
                                        <div class="form-row">
                                            @if ($paketDetail->cara_penerimaan != "" && $paketDetail->tanggal_diambil == "")
                                                <div class="col-md-12 text-right">
                                                    <a href="{{ route('paket.done', ['id' => $paketDetail->id]) }}" class="btn btn-success"
                                                        style="margin-top: 0rem;">Selesai</a>
                                                </div>
                                            @elseif ($paketDetail->cara_penerimaan == "" && $paketDetail->tanggal_diambil == "")
                                                <div class="col-md-7 text-center">
                                                    <button class="btn btn-primary btn-block" role="button"
                                                        data-toggle="modal" data-target="#modalPenerimaanAmbilSendiri"
                                                        aria-pressed="true"
                                                        {{ ($paketDetail->cara_penerimaan != "") ? "disabled" : "" }}>Ambil
                                                        Sendiri</button>
                                                </div>
                                                <div class="col-md-5 text-center">
                                                    <button class="btn btn-success btn-block" role="button"
                                                        data-toggle="modal" data-target="#modalPenerimaanDiantar"
                                                        aria-pressed="true"
                                                        {{ ($paketDetail->cara_penerimaan != "") ? "disabled" : "" }}>Diantar</button>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- List of modals -->
@include('paket/modal_penerimaan_diantar', ['paketDetail' => $paketDetail])
@include('paket/modal_penerimaan_ambil_sendiri', ['paketDetail' => $paketDetail])
@endsection