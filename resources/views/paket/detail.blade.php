@extends('layouts.app', [
'class' => '',
'elementActive' => ''
])

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12 text-right">
            <div class="card">
                <div class="card-header text-center">
                    <h5 class="title">{{ __('Detail Paket') }}</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 offset-lg-4 text-center" style="margin-bottom:16px;">
                            <img src="{{ ($paketDetail->picture == "") ? asset('default-image.jpeg') : asset('storage/' . $paketDetail->picture) }}"
                                style="width:15rem; height:11rem;">
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-md-3 col-form-label">{{ __('NIK Penerima :') }}</label>
                        <div class="col-md-9">
                            <div class="form-group">
                                <input type="text" name="nik_penerima" class="form-control"
                                    style="background-color:#fff;" placeholder="NIK Penerima"
                                    value="{{ ($paketDetail->nik_penerima == "") ? "-" : $paketDetail->nik_penerima }}"
                                    readonly />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-md-3 col-form-label">{{ __('Nama Penerima :') }}</label>
                        <div class="col-md-9">
                            <div class="form-group">
                                <input type="text" name="nama_penerima" class="form-control"
                                    style="background-color:#fff;" placeholder="Nama Penerima"
                                    value="{{ ($paketDetail->nama_penerima == "") ? "-" : $paketDetail->nama_penerima }}"
                                    readonly />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-md-3 col-form-label">{{ __('Email :') }}</label>
                        <div class="col-md-9">
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" style="background-color:#fff;"
                                    placeholder="Email"
                                    value="{{ ($paketDetail->email == "") ? "-" : $paketDetail->email }}" readonly />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-md-3 col-form-label">{{ __('No. Telepon Penerima :') }}</label>
                        <div class="col-md-9">
                            <div class="form-group">
                                <input type="text" name="no_telepon_penerima" class="form-control"
                                    style="background-color:#fff;" placeholder="No. Telepon Penerima"
                                    value="{{ ($paketDetail->telp == "") ? "-" : $paketDetail->telp }}" readonly />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-md-3 col-form-label">{{ __('Direktorat :') }}</label>
                        <div class="col-md-9">
                            <div class="form-group">
                                <input type="text" name="direktorat" class="form-control" style="background-color:#fff;"
                                    placeholder="Direktorat"
                                    value="{{ ($paketDetail->direktorat == "") ? "-" : $paketDetail->direktorat }}"
                                    readonly />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-md-3 col-form-label">{{ __('Divisi :') }}</label>
                        <div class="col-md-9">
                            <div class="form-group">
                                <input type="text" name="divisi" class="form-control" style="background-color:#fff;"
                                    placeholder="Divisi"
                                    value="{{ ($paketDetail->divisi == "") ? "-" : $paketDetail->divisi }}" readonly />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-md-3 col-form-label">{{ __('Departemen :') }}</label>
                        <div class="col-md-9">
                            <div class="form-group">
                                <input type="text" name="departemen" class="form-control" style="background-color:#fff;"
                                    placeholder="Departemen"
                                    value="{{ ($paketDetail->department == "") ? "-" : $paketDetail->department }}"
                                    readonly />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-md-3 col-form-label">{{ __('Unit :') }}</label>
                        <div class="col-md-9">
                            <div class="form-group">
                                <input type="text" name="unit" class="form-control" style="background-color:#fff;"
                                    placeholder="Unit"
                                    value="{{ ($paketDetail->unit == "") ? "-" : $paketDetail->unit }}" readonly />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-md-3 col-form-label">{{ __('Jenis Barang :') }}</label>
                        <div class="col-md-9">
                            <div class="form-group">
                                <input type="text" name="jenis_barang" class="form-control"
                                    style="background-color:#fff;" placeholder="Jenis Barang"
                                    value="{{ ($paketDetail->jenis_barang == "") ? "-" : $paketDetail->jenis_barang }}"
                                    readonly />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-md-3 col-form-label">{{ __('Barang Berbahaya :') }}</label>
                        <div class="col-md-9 text-left">
                            <div class="form-group">
                                @if ($paketDetail == "ya")
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inline_radio_paket"
                                        id="inlineRadioYa" value="ya" checked disabled>
                                    <label class="form-check-label" for="inlineRadioYa"
                                        style="padding-left:4px;">Ya</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inline_radio_paket"
                                        id="inlineRadioTidak" value="tidak" disabled>
                                    <label class="form-check-label" for="inlineRadioTidak"
                                        style="padding-left:4px;">Tidak</label>
                                </div>
                                @else
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inline_radio_paket"
                                        id="inlineRadioYa" value="ya" disabled>
                                    <label class="form-check-label" for="inlineRadioYa"
                                        style="padding-left:4px;">Ya</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inline_radio_paket"
                                        id="inlineRadioTidak" value="tidak" checked disabled>
                                    <label class="form-check-label" for="inlineRadioTidak"
                                        style="padding-left:4px;">Tidak</label>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-md-3 col-form-label">{{ __('Tanggal Barang Sampai :') }}</label>
                        <div class="col-md-9">
                            <div class="form-group">
                                <input type="text" name="tanggal_barang_sampai" class="form-control"
                                    style="background-color:#fff;" placeholder="Tanggal Barang Sampai"
                                    value="{{ ($paketDetail->tanggal_sampai == "") ? "-" : $paketDetail->tanggal_sampai }}"
                                    readonly />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-md-3 col-form-label">{{ __('Tanggal Barang Diambil/Diantar :') }}</label>
                        <div class="col-md-9">
                            <div class="form-group">
                                <input type="text" name="tanggal_barang_diambil" class="form-control"
                                    style="background-color:#fff;" placeholder="Tanggal Barang Diambil/Diantar"
                                    value="{{ ($paketDetail->tanggal_ambil == "") ? "-" : $paketDetail->tanggal_ambil }}"
                                    readonly />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer ">
                    <div class="row">
                        <div class="col-md-9 text-left">
                            <a href="#" class="btn btn-info btn-round" role="button" aria-pressed="true">Kembali</a>
                        </div>
                        <div class="col-md-3">
                            <div class="form-row">
                                <div class="col-md-7 text-center">
                                    <a href="#" class="btn btn-primary btn-block btn-round" role="button"
                                        aria-pressed="true">Ambil
                                        Sendiri</a>
                                </div>
                                <div class="col-md-5 text-center">
                                    <a href="#" class="btn btn-success btn-block btn-round" role="button"
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
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
            // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
            demo.initChartsPages();
        });
</script>
@endpush