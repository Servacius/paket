<div class="row">
    <div class="col-md-12">
        <div class="card card-nav-tabs" style="margin-top: 0px; margin-bottom: 12px;">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="text-center" style="height: 7.5rem; line-height: 20px;">
                            <img class="rounded" src="{{ asset('storage/images/' . $paket->gambar) }}"
                                style="max-width: 100%; max-height: 100%;" />
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-12" style="margin-top: 8px;">
                                <h4 class="card-title">
                                    {{ ($paket->jenis_paket == '') ? $paket->nama_paket : $paket->jenis_paket }}</h4>
                                <!-- This information is not necessary for karyawan -->
                                {{-- <p class="card-category">
                                    <span class="material-icons text-success" style="margin-right: 8px;">
                                        local_phone
                                    </span> {{ $paket->no_telp }}
                                </p> --}}
                                <p class="card-category">
                                    @if ($paket->cara_penerimaan == "diantar")
                                        @if ($paket->telat_diantar)
                                            <div class="row">
                                                <div class="col-auto text-center" style="padding-right: 0px;">
                                                    <span class="material-icons text-danger" style="font-size: 28px;">
                                                        schedule
                                                    </span>
                                                </div>
                                                <div class="col-md-11">
                                                    {!! 'Paket Anda telah sampai dan seharusnya diantar pada: <b class="font-weight-bold">' .
                                                        $paket->tanggal_pengantaran . ' ' . $paket->waktu_pengantaran . ' </b>. Segera hubungi petugas untuk menerima paket.' !!}
                                                </div>
                                            </div>
                                        @else
                                            <div class="row">
                                                <div class="col-auto text-center" style="padding-right: 0px;">
                                                    <span class="material-icons text-success" style="font-size: 28px;">
                                                        schedule
                                                    </span>
                                                </div>
                                                <div class="col-md-11">
                                                    {!! 'Paket Anda telah sampai, akan diantar pada: <b class="font-weight-bold">' .
                                                        $paket->tanggal_pengantaran . ' ' . $paket->waktu_pengantaran . '</b>.' !!}
                                                </div>
                                            </div>
                                        @endif
                                    @elseif($paket->cara_penerimaan == "ambil_sendiri")
                                        @if ($paket->telat_diambil)
                                            <div class="row">
                                                <div class="col-auto text-center" style="padding-right: 0px;">
                                                    <span class="material-icons text-danger" style="font-size: 28px;">
                                                        alarm
                                                    </span>
                                                </div>
                                                <div class="col-md-11">
                                                    {!! 'Paket Anda belum diambil sejak <b class="font-weight-bold">' .
                                                        $paket->tanggal_sampai . '</b>, segera ambil paket.' !!}
                                                </div>
                                            </div>
                                        @else
                                            <div class="row">
                                                <div class="col-auto text-center" style="padding-right: 0px;">
                                                    <span class="material-icons text-success" style="font-size: 28px;">
                                                        schedule
                                                    </span>
                                                </div>
                                                <div class="col-md-11">
                                                    {{ 'Paket Anda telah sampai, segera ambil paket.' }}
                                                </div>
                                            </div>
                                        @endif
                                    @else
                                        @if ($paket->cara_penerimaan == "" && ($paket->telat_diambil || $paket->telat_diantar))
                                            <div class="row">
                                                <div class="col-auto text-center" style="padding-right: 0px;">
                                                    <span class="material-icons text-danger" style="font-size: 28px;">
                                                        alarm
                                                    </span>
                                                </div>
                                                <div class="col-md-11">
                                                    {!! 'Paket Anda telah sampai sejak <b class="font-weight-bold">' .
                                                        $paket->tanggal_sampai . '</b>, segera konfirmasi cara penerimaan paket.'
                                                    !!}
                                                </div>
                                            </div>
                                        @else
                                            <div class="row">
                                                <div class="col-auto text-center" style="padding-right: 0px;">
                                                    <span class="material-icons text-success" style="font-size: 28px;">
                                                        schedule
                                                    </span>
                                                </div>
                                                <div class="col-md-11">
                                                    {{ 'Paket Anda telah sampai, segera konfirmasi cara penerimaan paket.' }}
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 text-right">
                        <a href="{{ route('paket.detail', ['id' => $paket->id]) }}" class="btn btn-info btn-block"
                            style="margin-top: 0rem;">Lihat Detail</a>
                        @if ($paket->cara_penerimaan != "")
                            <a href="{{ route('paket.done', ['id' => $paket->id]) }}" class="btn btn-success btn-block"
                                style="margin-top: 0rem;">Selesai</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>