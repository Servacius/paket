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
                            <div class="col-md-12" style="padding-top: 8px;">
                                <div class="row">
                                    <div class="col-auto text-center" style="padding-right: 0px;">
                                        <span class="material-icons text-default" style="font-size: 20px;">
                                            shopping_bag
                                        </span>
                                    </div>
                                    <div class="col-md-11">
                                        {{ 'Paket milik ' . $paket->nama_pemilik }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-auto text-center" style="padding-right: 0px;">
                                        <span class="material-icons text-info" style="font-size: 20px;">
                                            local_phone
                                        </span>
                                    </div>
                                    <div class="col-md-11">
                                        {{ $paket->no_telepon }}
                                    </div>
                                </div>
                                @if ($paket->cara_penerimaan == "diantar")
                                    @if ($paket->telat_diantar)
                                        <div class="row">
                                            <div class="col-auto text-center" style="padding-right: 0px;">
                                                <span class="material-icons text-danger" style="font-size: 20px;">
                                                    schedule
                                                </span>
                                            </div>
                                            <div class="col-md-11">
                                                {!! 'Penerimaan paket dengan cara <b class=font-weight-bold>Diantar</b> telah dinkonfirmasi. ' .
                                                    'Pengantaran paket telah melewati batas waktu: <b class="font-weight-bold text-danger">' .
                                                    $paket->tanggal_pengantaran . ' ' . $paket->waktu_pengantaran . '</b>.' !!}
                                            </div>
                                        </div>
                                    @else
                                        <div class="row">
                                            <div class="col-auto text-center" style="padding-right: 0px;">
                                                <span class="material-icons text-success" style="font-szie: 20px;">
                                                    schedule
                                                </span>
                                            </div>
                                            <div class="col-md-11">
                                                {!! 'Penerimaan paket dengan cara <b class=font-weight-bold>Diantar</b> pada tanggal ' .
                                                    $paket->tanggal_pengantaran . ' ' . $paket->waktu_pengantaran . ' </b> telah dikonfirmasi.' !!}
                                            </div>
                                        </div>
                                    @endif
                                @elseif($paket->cara_penerimaan == "ambil_sendiri")
                                    @if ($paket->telat_diambil)
                                        <div class="row">
                                            <div class="col-auto text-center" style="padding-right: 0px;">
                                                <span class="material-icons text-danger" style="font-size: 20px;">
                                                    alarm
                                                </span>
                                            </div>
                                            <div class="col-md-11">
                                                {!! 'Penerimaan paket dengan cara <b class="font-weight-bold">Ambil Sendiri</b> telah dikonfirmasi. ' .
                                                    '<b class="font-weight-bold text-danger">(Paket belum diambil sejak ' .
                                                    $paket->tanggal_sampai . ')</b>' !!}
                                            </div>
                                        </div>
                                    @else
                                        <div class="row">
                                            <div class="col-auto text-center" style="padding-right: 0px;">
                                                <span class="material-icons text-success" style="font-size: 8px;">
                                                    schedule
                                                </span>
                                            </div>
                                            <div class="col-md-11">
                                                {!! 'Penerimaan paket dengan cara <b class="font-weight-bold">Ambil Sendiri</b> telah dikonfirmasi.' !!}
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 text-right">
                        <a href="{{ route('paket.detail', ['id' => $paket->id]) }}" class="btn btn-info"
                            style="margin-top: 0rem;">Lihat Detail</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>