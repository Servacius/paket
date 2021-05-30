<div class="sidebar" data-color="white" data-active-color="danger">
    <div class="logo">
        <a href="{{ route('karyawan.home') }}" class="simple-text logo-mini">
            <div class="logo-image-small">
                <img src="{{ asset('paper') }}/img/logo-small.png">
            </div>
        </a>
        <a href="{{ route('karyawan.home') }}" class="simple-text logo-normal">
            {{ __('Karyawan') }}
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="{{ $elementActive == 'beranda' ? 'active' : '' }}">
                <a href="{{ route('karyawan.home') }}">
                    <i class="nc-icon nc-bank"></i>
                    <p>{{ __('Beranda') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'listSemuaPaket' ? 'active' : '' }}">
                <a href="#">
                    <i class="nc-icon nc-basket"></i>
                    <p>{{ __('List Semua Paket') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'barangku' ? 'active' : '' }}">
                <a href="#">
                    <i class="nc-icon nc-app"></i>
                    <p>{{ __('Barangku') }}</p>
                </a>
            </li>
        </ul>
    </div>
</div>