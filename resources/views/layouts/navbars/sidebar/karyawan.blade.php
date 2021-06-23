<div class="sidebar" data-color="purple" data-background-color="black"
  data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
  <div class="logo">
    <a href="" class="simple-text logo-normal">
      {{ __('Karyawan') }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('index') }}">
          <i class="material-icons">dashboard</i>
          <p>{{ __('Dashboard') }}</p>
        </a>
      </li>
      <li class="nav-item {{ ($activePage == 'daftarPaket' || $activePage == 'paketku') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#paketMenu" aria-expanded="true">
          <i class="material-icons">inventory</i>
          <p>{{ __('Paket') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($activePage == 'daftarPaket' || $activePage == 'paketku') ? ' show' : '' }}"
          id="paketMenu">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'daftarPaket' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('paket.index') }}">
                <i class="material-icons">view_list</i>
                <span class="sidebar-normal">{{ __('Daftar Paket') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'paketku' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('paket.index', ['unpickedup' => 'true']) }}">
                <i class="material-icons">shopping_bag</i>
                <span class="sidebar-normal"> {{ __('Paketku') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
    </ul>
  </div>
</div>