<div class="row">
    <div class="col-md-12">
        <div class="card card-nav-tabs" style="margin-top: 0px; margin-bottom: 8px;">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-2">
                        <img src="{{ asset('storage/images/' . $paket->picture) }}"
                            style="width:11rem; height:7.5rem;" />
                    </div>
                    <div class="col-md-7">
                        <div class="row">
                            <div style="margin-top: 8px;">
                                <h4 class="card-title">{{ ($paket->jenis_barang == '') ? $paket->nama_paket : $paket->jenis_barang }}</h4>
                                <!-- This information is not necessary for karyawan -->
                                {{-- <p class="card-category">
                                    <span class="material-icons text-success" style="margin-right: 8px;">
                                        local_phone
                                    </span> {{ $paket->no_telp }}
                                </p> --}}
                                <p class="card-category">
                                    @if ($paket->cara_penerimaan == "diantar")
                                        <span class="material-icons text-success" style="margin-right: 8px;">
                                            schedule
                                        </span>
                                        {!! 'Paket Anda telah sampai, akan diantar pada: <b class="font-weight-bold">' . $paket->tanggal_pengantaran . '</b>.' !!}
                                    @elseif($paket->cara_penerimaan == "ambil_sendiri")
                                        @if ($paket->selisih_waktu_sampai > 0)
                                            <span class="material-icons text-danger" style="margin-right: 8px;">
                                                alarm
                                            </span>
                                            {!! 'Paket Anda belum diambil sejak <b class="font-weight-bold">' . $paket->tanggal_sampai . '</b>, segera ambil paket.' !!}
                                        @elseif($paket->selisih_waktu_sampai == 0)
                                            <span class="material-icons text-success" style="margin-right: 8px;">
                                                schedule
                                            </span>
                                            {{ 'Paket Anda telah sampai, segera ambil paket.' }}
                                        @endif
                                    @else
                                        @if ($paket->selisih_waktu_sampai < 0)
                                            <span class="material-icons text-danger" style="margin-right: 8px;">
                                                alarm
                                            </span>
                                            {!! 'Paket Anda telah sampai sejak <b class="font-weight-bold">' . $paket->tanggal_sampai . '</b>, segera konfirmasi cara penerimaan paket.' !!}
                                        @elseif($paket->selisih_waktu_sampai == 0)
                                            <span class="material-icons text-success" style="margin-right: 8px;">
                                                schedule
                                            </span>
                                            {{ 'Paket Anda telah sampai, segera konfirmasi cara penerimaan paket.' }}
                                        @endif
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 text-right">
                        <a href="{{ route('paket.detail', ['id' => $paket->id]) }}" class="btn btn-info"
                            style="margin-top: 0rem;">Lihat Detail</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>