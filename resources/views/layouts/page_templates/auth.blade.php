<div class="wrapper ">
  @if(auth()->user()->role_id === 2)
  @include('layouts.navbars.sidebar.karyawan')
  @else
  @include('layouts.navbars.sidebar')
  @endif
  <div class="main-panel">
    @include('layouts.navbars.navs.auth')
    @yield('content')
    @include('layouts.footers.auth')
  </div>
</div>