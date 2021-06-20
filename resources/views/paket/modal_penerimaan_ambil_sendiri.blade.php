<div class="modal fade" id="modalPenerimaanAmbilSendiri" tabindex="-1" role="dialog" aria-labelledby="modalAmbilSendiri"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLongTitle">Konfirmasi Penerimaan Paket</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda Yakin Memilih Cara Penerimaan "Ambil Sendiri"?
                <form action="{{ route('penerimaan.store') }}" id="formUpdatePenerimaanAmbilSendiri" method="POST"
                    style="display: none;">
                    @csrf
                    <input name="cara_penerimaan" type="hidden" value="ambil_sendiri">
                    <input name="paket_id" type="hidden" value="{{ $paketDetail->id }}">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-round"
                    onclick="document.getElementById('formUpdatePenerimaanAmbilSendiri').submit();">Ya</button>
                <button type="button" class="btn btn-default btn-round" data-dismiss="modal"
                    data-backdrop="false">Tidak</button>
            </div>
        </div>
    </div>
</div>