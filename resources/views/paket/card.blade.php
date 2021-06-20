<div class="col-lg-2 col-md-6 col-sm-6">
    <div class="card" style="height: 14rem; margin-top: 0px;">
        <div class="card-img-top text-center" style="height: 10rem; line-height: 20px;">
            <img class="rounded-top" src="{{ asset('storage/images/' . $paket->gambar) }}"
                style="max-width: 100%; max-height: 100%;" />
        </div>
        <div class="card-body text-center" style="padding: 8px;">
            <p class="card-title font-weight-bold crop-text-2">
                <a href="{{ route('paket.detail', ['id' => $paket->id]) }}" class="text-dark">{{ $paket->nama_paket }}</a>
        </div>
    </div>
</div>