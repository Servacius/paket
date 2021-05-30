@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'tambahbarang'
])

@section('content')
    <div class="content">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        @if (session('password_status'))
            <div class="alert alert-success" role="alert">
                {{ session('password_status') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-12 text-left">
                <form class="col-md-12" action="{{ route('petugas.addBarang') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                            <div class="col-md-12 text-center">
                                    <div class="form-group">
                                        <!-- <label for="picture" class="custom-file-upload text-success"> -->
                                            <img id="preview-image" src="https://www.riobeauty.co.uk/images/product_image_not_found.gif" alt="preview image" style="max-height: 250px;">
                                        <!-- </label> -->
                                    </div>
                                </div>
                                <div class="col-md-12 text-center">
                                    <div class="form-group">
                                        <label for="picture" class="custom-file-upload text-success">
                                            <i class="nc-icon nc-cloud-upload-94" style="font-size:40px"></i>
                                        </label>
                                        <input type="file" name="picture" id="image" required>
                                    </div>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-2 col-form-label">{{ __('Nama Penerima') }}</label>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="name" class="typeahead form-control" placeholder="Name" value="" required>
                                    </div>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-2 col-form-label">{{ __('NIK Penerima') }}</label>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="nik" class="form-control" placeholder="NIK Penerima" value="" readonly="true">
                                    </div>
                                    @if ($errors->has('nik'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-2 col-form-label">{{ __('Email') }}</label>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control" placeholder="Email" value="" disabled>
                                    </div>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-2 col-form-label">{{ __('No Telepon Penerima') }}</label>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="notelp" class="form-control" placeholder="No Telp Penerima" value="" required>
                                    </div>
                                    @if ($errors->has('notelp'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-2 col-form-label">{{ __('Direktorat') }}</label>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="direktorat" class="form-control" placeholder="Direktorat" value="" disabled>
                                    </div>
                                    @if ($errors->has('direktorat'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-2 col-form-label">{{ __('Divisi') }}</label>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="divisi" class="form-control" placeholder="Divisi" value="" disabled>
                                    </div>
                                    @if ($errors->has('divisi'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-2 col-form-label">{{ __('Departemen') }}</label>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="departemen" class="form-control" placeholder="Departemen" value="" disabled>
                                    </div>
                                    @if ($errors->has('departemen'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-2 col-form-label">{{ __('Unit') }}</label>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="unit" class="form-control" placeholder="Unit" value="" disabled>
                                    </div>
                                    @if ($errors->has('unit'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-2 col-form-label">{{ __('Jenis Barang') }}</label>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="jenisbarang" class="form-control" placeholder="Jenis Barang" value="" required>
                                    </div>
                                    @if ($errors->has('jenisbarang'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-2 col-form-label">{{ __('Barang Berbahaya') }}</label>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="radio" name="barangberbahaya"  value="Ya">
                                            <label for="Yes">Ya</label>
                                        <input type="radio" name="barangberbahaya"  value="Tidak">
                                            <label for="Tidak">Tidak</label>
                                    </div>
                                    @if ($errors->has('barangberbahaya'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-2 col-form-label">{{ __('Tanggal Barang Sampai') }}</label>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="tglsampai" class="date form-control" placeholder="Tanggal Barang Sampai" value="" required>
                                    </div>
                                    @if ($errors->has('tglsampai'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-2 col-form-label">{{ __('Tanggal Barang Diambil/Diantar') }}</label>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="tgldiambil" class="form-control date" placeholder="Tanggal Barang Diambil/Diantar" value="" disabled>
                                    </div>
                                    @if ($errors->has('tgldiambil'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-2 col-form-label">{{ __('Cara Penerimaan') }}</label>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="carapenerimaan" class="form-control" placeholder="Cara Penerimaan" value="" disabled>
                                    </div>
                                    @if ($errors->has('carapenerimaan'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <div class="row">
                                <div class="col-md-6 text-left">
                                    <a href="../petugas/home" class="btn btn-danger">{{ __('Kembali') }}</a>
                                </div>
                                <div class="col-md-6 text-left">
                                    <button type="submit" class="btn btn-info">{{ __('Tambah') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection