<div class="modal fade" id="modalPenerimaanDiantar" tabindex="-1" role="dialog" aria-labelledby="modalDiantar"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLongTitle">Konfirmasi Penerimaan Paket</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('penerimaan.store') }}" id="formUpdatePenerimaanDiantar" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <input name="cara_penerimaan" type="hidden" value="diantar">
                            <input name="paket_id" type="hidden" value="{{ $paketDetail->id }}">
                            <div class="col-sm-12">
                                <div class="row">
                                    <label class="col-sm-3 col-form-label">{{ __('Tanggal Pengantaran :') }}</label>
                                    <div class="col-sm-9">
                                        <div class="form-group">
                                            <input type="text" class="form-control datetimepicker"
                                                style="padding-left: 8px;" name="tanggal_pengantaran"
                                                id="datepickerTanggalPengantaran" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-3 col-form-label">{{ __('Waktu Pengantaran :') }}</label>
                                    <div class="col-sm-9">
                                        <div class="form-group">
                                            <select class="selectpicker form-control show-tick"
                                                data-style="btn btn-link bg-white text-dark" name="waktu_pengantaran"
                                                id="selectWaktuPengantaran" title="">
                                                <option>09:00 - 11:00 WIB</option>
                                                <option>14:00 - 16:00 WIB</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-3 col-form-label">{{ __('Lantai :') }}</label>
                                    <div class="col-sm-9">
                                        <div class="form-group">
                                            <input type="number" class="form-control" style="padding-left: 8px;"
                                                name="lantai" min="1" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-3 col-form-label">{{ __('Keterangan :') }}</label>
                                    <div class="col-sm-9">
                                        <div class="form-group">
                                            <textarea class="form-control" style="padding-left: 8px;" name="keterangan"
                                                rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary btn-round" value="Ya" />
                    <button type="button" class="btn btn-default btn-round" data-dismiss="modal">Tidak</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('js')
<script>
    $('#datepickerTanggalPengantaran').datetimepicker({
        icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-chevron-up",
            down: "fa fa-chevron-down",
            previous: 'fa fa-chevron-left',
            next: 'fa fa-chevron-right',
            today: 'fa fa-screenshot',
            clear: 'fa fa-trash',
            close: 'fa fa-remove'
        },
        format: 'DD-MM-YYYY',
    });

    $().ready(function() {
        $('#formUpdatePenerimaanDiantar').validate({
            rules: {
                tanggal_pengantaran: {
                    required: true
                },
                waktu_pengantaran: {
                    required: true
                },
            },
            messages: {
                tanggal_pengantaran: {
                    required: "Tanggal pengantaran tidak boleh kosong."
                },
                waktu_pengantaran: {
                    required: "Waktu pengantaran tidak boleh kosong."
                }
            },
            errorPlacement: function (error, element) {
                if ( element.is('input') ) {
                    error.insertAfter(element.parents('.form-group'));
                } else if ( element.is('select') ) {
                    error.insertAfter(element.parents('.form-group'));
                } else {
                    error.insertAfter(element);
                }
            },
        });
    });
</script>
@endpush