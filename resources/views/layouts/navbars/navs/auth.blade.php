<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
  <div class="container-fluid">
    <div class="navbar-wrapper">
      <a class="navbar-brand" href="{{ route('index') }}">{{ $titlePage }}</a>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index"
      aria-expanded="false" aria-label="Toggle navigation">
      <span class="sr-only">Toggle navigation</span>
      <span class="navbar-toggler-icon icon-bar"></span>
      <span class="navbar-toggler-icon icon-bar"></span>
      <span class="navbar-toggler-icon icon-bar"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('index') }}">
            <i class="material-icons">dashboard</i>
            <p class="d-lg-none d-md-block">
              {{ __('Stats') }}
            </p>
          </a>
        </li>
        @if (auth()->user()->role_id == 2 || auth()->user()->role_id == 3)
          <li class="nav-item dropdown">
            <a class="nav-link" href="" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
              aria-expanded="false">
              <i class="material-icons">notifications</i>
              <span class="notification" id="totalNotifications"></span>
              <p class="d-lg-none d-md-block">
                {{ __('Notifikasi') }}
              </p>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
              <div id="notifications"></div>
              @if (auth()->user()->role_id == 2)
                <a class="dropdown-item btn btn-warning font-weight-normal text-white"
                  href="{{ route('paket.index', ['unpickedup' => 'true']) }}">{{ __('Cek Selengkapnya') }}</a>
              @elseif (auth()->user()->role_id == 3)
                <a class="dropdown-item btn btn-warning font-weight-normal text-white"
                  href="{{ route('paket.index', ['penerimaan' => 'true']) }}">{{ __('Cek Selengkapnya') }}</a>
              @endif
            </div>
          </li>
        @endif
        <li class="nav-item dropdown">
          <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <i class="material-icons">person</i>
            <p class="d-lg-none d-md-block">
              {{ __('Account') }}
            </p>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
            {{-- <a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Profile') }}</a>
            <div class="dropdown-divider"></div> --}}
            <a class="dropdown-item" href="{{ route('logout') }}"
              onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Log out') }}</a>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>

@push('js')
<script>
  $(document).ready(function () {
    var roleID = '{{ auth()->user()->role_id }}';
    console.dir(roleID);

    if (roleID == 2) {
      showNotifikasiKaryawan();
    } else if (roleID == 3) {
      showNotifikasiPetugas();
    }
  });

  function showNotifikasiKaryawan() {
    var elementTotalNotifications = document.getElementById("totalNotifications");
    var elementNotifications = document.getElementById("notifications");
    var url = '{{ route("notifikasi") }}';

    $.ajax({
        method: 'GET',
        url: url,
    })
    .done(function (notifications) {
      console.dir('data notifikasi: ' + notifications);

      for (var i = 0; i < notifications.length; i++) {
        const a = document.createElement("a");
        const node = document.createTextNode(notifications[i].tanggal_sampai + ' - Anda memiliki paket baru, segera lakukan konfirmasi cara penerimaan.');

        var detailURL = '{{ route("paket.detail", ["id" => ":paketID"]) }}';
        detailURL = detailURL.replace(':paketID', notifications[i].id);

        a.appendChild(node);
        a.title = notifications[i].tanggal_sampai + ' - Anda memiliki paket baru, segera lakukan konfirmasi cara penerimaan.';
        a.href = detailURL;
        a.classList = ['dropdown-item'];

        elementNotifications.appendChild(a);
      }

      elementTotalNotifications.textContent = "" + notifications.length;
    });
  }

  function showNotifikasiPetugas() {
    var elementTotalNotifications = document.getElementById("totalNotifications");
    var elementNotifications = document.getElementById("notifications");
    var url = '{{ route("notifikasi") }}';

    $.ajax({
        method: 'GET',
        url: url,
    })
    .done(function (notifications) {
      console.dir('data notifikasi: ' + notifications);
      for (var i = 0; i < notifications.length; i++) {
        const a = document.createElement("a");
        const node = document.createTextNode('Cara penerimaan paket dengan ID ' + notifications[i].id + ' telah dikonfirmasi.');

        var detailURL = '{{ route("paket.detail", ["id" => ":paketID"]) }}';
        detailURL = detailURL.replace(':paketID', notifications[i].id);

        a.appendChild(node);
        a.title = 'Cara penerimaan paket dengan ID ' + notifications[i].id + ' telah dikonfirmasi.';
        a.href = detailURL;
        a.classList = ['dropdown-item'];

        elementNotifications.appendChild(a);
      }

      elementTotalNotifications.textContent = "" + notifications.length;
    });
  }
</script>
@endpush
