<div class="sidebar" data-color="purple" data-background-color="black"
    data-image="{{ asset('material') }}/img/sidebar-1.jpg">
    <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
    <div class="logo">
        <a href="" class="simple-text logo-normal">
            {{ __('Admin') }}
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
            <li class="nav-item{{ $activePage == 'daftarPaket' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('paket.index') }}">
                    <i class="material-icons">view_list</i>
                    <p>{{ __('Daftar Paket') }}</p>
                </a>
            </li>
            <li class="nav-item {{ ($activePage == 'daftarUser' || $activePage == 'tambahUser') ? ' active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#userMenu" aria-expanded="true">
                    <i class="material-icons">account_circle</i>
                    <p>{{ __('User') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse {{ ($activePage == 'daftarUser' || $activePage == 'tambahUser') ? ' show' : '' }}"
                    id="userMenu">
                    <ul class="nav">
                        <li class="nav-item{{ $activePage == 'daftarUser' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('user.index') }}">
                                <i class="material-icons">group</i>
                                <span class="sidebar-normal">{{ __('Daftar User') }} </span>
                            </a>
                        </li>
                        <li class="nav-item{{ $activePage == 'tambahUser' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('user.register') }}">
                                <i class="material-icons">person_add_alt_1</i>
                                <span class="sidebar-normal"> {{ __('Tambah User') }} </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item{{ $activePage == 'report' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('paket.report') }}">
                    <i class="material-icons">article</i>
                    <p>{{ __('Report') }}</p>
                </a>
            </li>
        </ul>
    </div>
</div>