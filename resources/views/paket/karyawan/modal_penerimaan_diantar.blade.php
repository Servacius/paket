<div class="modal fade" id="modalPenerimaanDiantar" tabindex="-1" role="dialog" aria-labelledby="modalDiantar"
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
            </div>
            <div class="modal-footer">
                <form class="dropdown-item" action="{{ route('paket.update', ['id' => '34']) }}"
                    id="formUpdatePenerimaanAmbilSendiri" method="POST" style="display: none;">
                    @method('PUT')
                    @csrf
                    <input name="penerimaan" type="hidden" value="ambil_sendiri">
                </form>
                <button type="button" class="btn btn-primary btn-round"
                    onclick="document.getElementById('formUpdatePenerimaanAmbilSendiri').submit();">Ya</button>
                <button type="button" class="btn btn-default btn-round" data-dismiss="modal">Tidak</button>
            </div>
        </div>
    </div>
</div>