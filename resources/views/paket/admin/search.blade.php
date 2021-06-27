<div class="col-md-10 offset-md-1">
    <h4 class="font-weight-bold">Filter Report Paket</h4>
    <br>
    <form action="{{ route('paket.export') }}" id="formSearch" method="GET" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="inputNama">{{ __('Nama:') }}</label>
            <input type="text" class="form-control" style="height: 45px; padding: 8px; 0px;" id="inputNama" name="nama"
                placeholder="" value="{{ ($filter->nama != "") ? $filter->nama : "" }}">
        </div>
        <div class="form-row" style="margin-top: 16px;">
            <div class="form-group col-md-6">
                <label for="inputTanggalSampaiFrom">{{ __('Tanggal Barang Sampai (From):') }}</label>
                <input type="text" class="form-control datetimepicker" style="height: 45px; padding: 8px; 0px;"
                    id="inputTanggalSampaiFrom" name="tanggal_sampai_from"
                    value="{{ ($filter->tanggal_sampai_from != "") ? $filter->tanggal_sampai_from : "" }}">
            </div>
            <div class="form-group col-md-6">
                <label for="inputTanggalSampaiTo">{{ __('Tanggal Barang Sampai (To):') }}</label>
                <input type="text" class="form-control datetimepicker" style="height: 45px; padding: 8px; 0px;"
                    id="inputTanggalSampaiTo" name="tanggal_sampai_to"
                    value="{{ ($filter->tanggal_sampai_to != "") ? $filter->tanggal_sampai_to : "" }}">
            </div>
        </div>
        <div class="form-row" style="margin-top: 16px;">
            <div class="form-group col-md-6">
                <label for="inputTanggalDiambilFrom">{{ __('Tanggal Barang Diambil (From):') }}</label>
                <input type="text" class="form-control datetimepicker" style="height: 45px; padding: 8px; 0px;"
                    id="inputTanggalDiambilFrom" name="tanggal_diambil_from"
                    value="{{ ($filter->tanggal_diambil_from != "") ? $filter->tanggal_diambil_from : "" }}">
            </div>
            <div class="form-group col-md-6">
                <label for="inputTanggalDiambilTo">{{ __('Tanggal Barang Diambil (To):') }}</label>
                <input type="text" class="form-control datetimepicker" style="height: 45px; padding: 8px; 0px;"
                    id="inputTanggalDiambilTo" name="tanggal_diambil_to"
                    value="{{ ($filter->tanggal_diambil_to != "") ? $filter->tanggal_diambil_to : "" }}">
            </div>
        </div>
        <div class="form-row pull-right">
            <div class="btn-group" role="group" aria-label="Action Button">
                <button type="button" class="btn btn-info" id="btnSearch" name="action" value="search">Search</button>
            </div>
            <div class="btn-group">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Export
                </button>
                <div class="dropdown-menu">
                    <button type="submit" class="dropdown-item" style="width: 95%;" name="action"
                        value="export-csv">.csv</button>
                    <button type="submit" class="dropdown-item" style="width: 95%;" name="action"
                        value="export-xslx">.xslx</button>
                </div>
            </div>
        </div>
    </form>
</div>
