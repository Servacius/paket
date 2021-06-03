@extends('layouts.app', [
'class' => '',
'elementActive' => 'paketku'
])

@section('content')
<div class="content">
    <div class="row">
        @foreach ($pakets as $paket)
        @include('card_not_taken', ['paket' => $paket])
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