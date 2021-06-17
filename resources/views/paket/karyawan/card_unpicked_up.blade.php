<div class="col-12">
    <div class="card card-nav-tabs" style="margin-top: 0px;">
        <div class="card-body">
            <div class="row">
                <div class="col-md-2">
                    <img src="{{ asset('storage/images/' . $paket->picture) }}" style="width:100%; height:8rem;" />
                </div>
                <div class="col-md-7">
                    <p class="card-text"><b>Nama Penerima:</b> {{ $paket->name_karyawan }}
                    </p>
                    <p class="card-text"><b>No. Telp Penerima:</b> {{ $paket->no_telp }}
                    </p>
                    <p class="card-text"><b>Cara Penerimaan:</b>
                        {{ ($paket->cara_penerimaan == "") ? "-" : $paket->cara_penerimaan }}
                    </p>
                </div>
                <div class="col-md-3 text-right">
                    <a href="{{ route('paket.detail', ['id' => $paket->id]) }}" class="btn btn-primary btn-round"
                        style="margin-top: 0rem;">Lihat Detail</a>
                </div>
            </div>
        </div>
    </div>
</div>