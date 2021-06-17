<div class="sidebar" data-color="orange" data-background-color="white"
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
      <li class="nav-item{{ $activePage == 'listSemuaPaket' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('paket.index') }}">
          <i class="material-icons">view_list</i>
          <p>{{ __('List Semua Paket') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'paketku' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('paket.index', ['status' => 'unpickedup']) }}">
          <i class="material-icons">shopping_bag</i>
          <p>{{ __('Paketku') }}</p>
        </a>
      </li>
    </ul>
  </div>
</div>