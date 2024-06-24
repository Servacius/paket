@extends('layouts.app', [
'class' => '',
'elementActive' => 'listSemuaPaket'
])

@section('content')
<div class="content">
    <div class="row">
        @foreach ($pakets as $paket)
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-12">
                            <img class="card" src="{{ asset('storage/' . $paket->picture) }}"
                                style="width: 100%;height: 10vw;" />
                        </div>
                    </div>
                </div>
                <div class="card-footer ">
                    <div class="stats text-center">{{ $paket->name }}</div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
            // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
            demo.initChartsPages();
        });
</script>
@endpush