<div class="col-lg-3 col-md-6 col-sm-6">
    <div class="card card-stats">
        <div class="card-body ">
            <div class="row">
                <div class="col-12">
                    <img class="card" src="{{ asset('storage/' . $paket->picture) }}"
                        style="width:100%; height:12rem;" />
                </div>
            </div>
        </div>
        <div class="card-footer ">
            <div class="stats text-center">{{ $paket->name }}</div>
        </div>
    </div>
</div>