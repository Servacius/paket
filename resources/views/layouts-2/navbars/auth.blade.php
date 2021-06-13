<div class="sidebar" data-color="white" data-active-color="danger">
    <div class="logo">
        <a href="../admin/home" class="simple-text logo-small">
            {{ __('Dashboard Admin') }}
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="{{ $elementActive == 'dashboard' ? 'active' : '' }}">
                <a href="../admin/home">
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'listSemuaPaket' ? 'active' : '' }}">
                <!-- <a href="{{ route('page.index', 'dashboard') }}"> -->
                <a href="#">
                    <p>{{ __('List Semua Paket') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'user' ? 'active' : '' }}">
                <!-- <a href="{{ route('page.index', 'dashboard') }}"> -->
                <a href="#">
                    <p>{{ __('User') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'report' ? 'active' : '' }}">
                <!-- <a href="{{ route('page.index', 'dashboard') }}"> -->
                <a href="#">
                    <p>{{ __('Report') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'user' || $elementActive == 'profile' ? 'active' : '' }}">
                <a data-toggle="collapse" aria-expanded="true" href="#laravelExamples">
                    <i class="nc-icon"><img src="{{ asset('paper/img/laravel.svg') }}"></i>
                    <p>
                            {{ __('Laravel examples') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse show" id="laravelExamples">
                    <ul class="nav">
                        <li class="{{ $elementActive == 'profile' ? 'active' : '' }}">
                            <a href="{{ route('profile.edit') }}">
                                <span class="sidebar-mini-icon">{{ __('UP') }}</span>
                                <span class="sidebar-normal">{{ __(' User Profile ') }}</span>
                            </a>
                        </li>
                        <li class="{{ $elementActive == 'user' ? 'active' : '' }}">
                            <a href="{{ route('page.index', 'user') }}">
                                <span class="sidebar-mini-icon">{{ __('U') }}</span>
                                <span class="sidebar-normal">{{ __(' User Management ') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="{{ $elementActive == 'icons' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'icons') }}">
                    <i class="nc-icon nc-diamond"></i>
                    <p>{{ __('Icons') }}</p>
                </a>
            </li>
        </ul>
    </div>
</div>
