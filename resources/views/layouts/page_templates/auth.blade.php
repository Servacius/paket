<div class="wrapper ">
  {{-- Admin --}}
  @if(auth()->user()->role_id === 1)
  @include('layouts.navbars.sidebar.admin')
  {{-- Karyawan --}}
  @elseif(auth()->user()->role_id === 2)
  @include('layouts.navbars.sidebar.karyawan')
  {{-- Petugas --}}
  @elseif(auth()->user()->role_id === 3)
  @include('layouts.navbars.sidebar.petugas')
  {{-- Guest --}}
  @else
  @include('layouts.navbars.sidebar')
  @endif
  <div class="main-panel">
    @include('layouts.navbars.navs.auth')
    @yield('content')
    @include('layouts.footers.auth')
  </div>
</div>