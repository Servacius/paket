<div class="wrapper">
    @if (auth()->user()->role_id === 1)
    @include('layouts.navbars.auth')
    @elseif(auth()->user()->role_id === 2)
    @include('layouts.navbars.auth.karyawan')
    @elseif(auth()->user()->role_id === 3)
    @include('layouts.navbars.auth_petugas')
    @endif

    <div class="main-panel">
        @include('layouts.navbars.navs.auth')
        @yield('content')
        @include('layouts.footer')
    </div>
</div>